<?php
// ============================================================
// CodeGenerator.php  —  PARTE 1 / 6
// Clase base, propiedades, constructor, helpers, visitProgram
// ============================================================

namespace Visitor;

use GolampiBaseVisitor;

require_once "Environment.php";
require_once "FlowTypes.php";
require_once "Invocable.php";
require_once "UserFunction.php";
require_once "Pointer.php";
require_once __DIR__ . "/../Tablas/ErrorTable.php";
require_once __DIR__ . "/../Tablas/SymbolTable.php";

class CodeGenerator extends GolampiBaseVisitor
{
    // ── Salida final de código ARM64 ─────────────────────────
    private $code = "";

    // ── Sección .data (strings literales) ────────────────────
    private $dataSection = "";

    // ── Contador para etiquetas únicas ───────────────────────
    private $labelCounter = 0;

    // ── Contador para strings en .data ───────────────────────
    private $strCounter = 0;

    // ── Entorno de variables (scopes anidados) ────────────────
    private $environment;

    // ── Nombre del scope actual (para SymbolTable) ───────────
    private $currentScope = "global";

    // ── Offset actual en el stack frame de la función ────────
    // Crece negativamente desde x29
    private $stackOffset = 0;

    // ── Tamaño total reservado en el stack frame actual ──────
    private $frameSize = 0;

    // ── Mapa nombre→offset para variables locales ────────────
    private $localVars = [];

    // ── Etiqueta de salida del break más cercano ─────────────
    private $breakLabel = null;

    // ── Etiqueta de continue más cercano ─────────────────────
    private $continueLabel = null;

    // ── Registro temporal en uso (x9–x15) ────────────────────
    private $tempReg = 9;

    // ── Lista de funciones declaradas (hoisting) ─────────────
    private $functions = [];

    // Agregar 
    private $helperCode = "";

    /*
    ========================
    CONSTRUCTOR
    ========================
    */
    public function __construct()
    {
        $this->environment = new Environment();
    }
  
    /*
    ========================
    EMITIR LÍNEA DE CÓDIGO
    ========================
    */
    private function emit(string $line): void
    {
        $this->code .= $line . "\n";
    }

    /*
    ========================
    EMITIR ETIQUETA
    ========================
    */
    private function emitLabel(string $label): void
    {
        $this->code .= $label . ":\n";
    }

    /*
    ========================
    EMITIR EN SECCIÓN .data
    ========================
    */
    private function emitData(string $line): void
    {
        $this->dataSection .= $line . "\n";
    }

    /*
    ========================
    GENERAR ETIQUETA ÚNICA
    ========================
    */
    private function newLabel(string $prefix = "L"): string
    {
        return $prefix . "_" . ($this->labelCounter++);
    }

    /*
    ========================
    AGREGAR STRING AL .data
    Retorna el nombre de la etiqueta
    ========================
    */
    private function addString(string $str): string
    {
        $label = "str_" . ($this->strCounter++);
        // Escapar caracteres especiales para .ascii
        $escaped = addcslashes($str, "\\\"\n\t\r");
        $this->emitData("{$label}: .ascii \"{$escaped}\"");
        $this->emitData("{$label}_len = . - {$label}");
        return $label;
    }

    /*
    ========================
    SIGUIENTE REGISTRO TEMP
    Cicla entre x9 y x15
    ========================
    */
    private function nextReg(): string
    {
        $reg = "x" . $this->tempReg;
        $this->tempReg++;
        if ($this->tempReg > 15) {
            $this->tempReg = 9;
        }
        return $reg;
    }

    /*
    ========================
    RESERVAR SLOT EN STACK
    Retorna el offset (negativo)
    ========================
    */
    private function allocStack(): int
    {
        $this->stackOffset -= 8;
        return $this->stackOffset;
    }

    // ==========================================================
    //  VISITORS
    // ==========================================================

    /*
    ========================
    PROGRAM
    ========================
    */
    public function visitProgram($ctx)
    {
        // PASO 1: registrar todas las funciones (hoisting)
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl()) {
                $funcCtx  = $decl->functionDecl();
                $funcName = $funcCtx->ID()->getText();
                $this->functions[$funcName] = $funcCtx;
            }
        }

        // PASO 2: verificar que exista main
        if (!isset($this->functions["main"])) {
            \ErrorTable::add(
                "Semantico",
                "El programa debe contener exactamente una funcion main.",
                0, 0
            );
            return null;
        }

        // PASO 3: generar _start que llama a main y luego exit(0)
        $this->emitLabel("_start");
        $this->emit("    bl      main");
        $this->emit("    mov     x0, #0");
        $this->emit("    mov     x8, #93        // syscall exit");
        $this->emit("    svc     #0");
        $this->emit("");

        // PASO 4: generar código de cada función
        foreach ($this->functions as $name => $funcCtx) {
            $this->visitFunctionDecl($funcCtx);
        }

        $this->flushHelpers();
        return null;
    }

    /*
    ========================
    DECLARATION
    ========================
    */
    public function visitDeclaration($ctx)
    {
        // Las funciones ya se procesaron en visitProgram (hoisting)
        // Aquí solo procesamos declaraciones globales de variables/const
        if ($ctx->functionDecl()) {
            return null; // ya procesado
        }

        if ($ctx->varDecl()) {
            return $this->visit($ctx->varDecl());
        }

        if ($ctx->constDecl()) {
            return $this->visit($ctx->constDecl());
        }

        if ($ctx->statement()) {
            return $this->visit($ctx->statement());
        }

        return null;
    }

    /*
    ========================
    FUNCTION DECLARATION
    Prólogo y epílogo ARM64
    ========================
    */
    public function visitFunctionDecl($ctx)
    {
        $name = $ctx->ID()->getText();
        $line = $ctx->getStart()->getLine();
        $col  = $ctx->getStart()->getCharPositionInLine();

        // Validaciones de main
        if ($name === "main" && $ctx->parameters() !== null) {
            \ErrorTable::add("Semantico", "La funcion main no puede recibir parametros.", $line, $col);
        }
        if ($name === "main" && $ctx->returnType() !== null) {
            \ErrorTable::add("Semantico", "La funcion main no puede retornar valores.", $line, $col);
        }

        // Registrar en tabla de símbolos
        \SymbolTable::add($name, "funcion", $this->currentScope, "—", $line, $col);

        // ── Guardar estado del scope anterior ──────────────────
        $prevScope      = $this->currentScope;
        $prevEnv        = $this->environment;
        $prevOffset     = $this->stackOffset;
        $prevFrameSize  = $this->frameSize;
        $prevLocalVars  = $this->localVars;
        $prevTempReg    = $this->tempReg;

        // ── Inicializar nuevo scope ─────────────────────────────
        $this->currentScope = $name;
        $this->environment  = $prevEnv->createChild();
        $this->stackOffset  = 0;
        $this->localVars    = [];
        $this->tempReg      = 9;

        // ── Pre-calcular tamaño del frame ───────────────────────
        // x29 (fp) + x30 (lr) = 16 bytes fijos
        // + 8 bytes por cada parámetro y variable local
        // Usamos estimación: 16 + (params * 8) + margen
        $paramCount = 0;
        if ($ctx->parameters() !== null) {
            $paramCount = count($ctx->parameters()->parameter());
        }
        // LÍNEA CORRECTA:
        $estimatedFrame = 512; // frame fijo conservador, alineado a 16
        $this->frameSize = $estimatedFrame;

        // ── Emitir etiqueta de la función ──────────────────────
        $this->emit("// ── Función: $name ──────────────────────────");
        $this->emitLabel($name);

        // ── PRÓLOGO ────────────────────────────────────────────
        // REEMPLAZAR línea 288 (prólogo completo):
        $this->emit("    stp     x29, x30, [sp, #-16]!");
        $this->emit("    mov     x29, sp");
        $this->emit("    sub     sp, sp, #496          // reservar frame local");

        // ── Parámetros: cargar de x0..x7 al stack ─────────────
        if ($ctx->parameters() !== null) {
            $params = $ctx->parameters()->parameter();
            foreach ($params as $i => $param) {
                $paramName = $param->ID()->getText();
                $this->stackOffset -= 8;
                $offset = $this->stackOffset;
                $this->localVars[$paramName] = $offset;
                $reg = "x$i";
                $this->emit("    str     {$reg}, [x29, #{$offset}]   // param: {$paramName}");
                $this->environment->define($paramName, $offset);
                \SymbolTable::add($paramName, "parametro", $name, "—", $param->getStart()->getLine(), $param->getStart()->getCharPositionInLine());
            }
        }

        // ── Cuerpo de la función ───────────────────────────────
        $stmts = $ctx->block()->statement();
        foreach ($stmts as $stmt) {
            $this->visit($stmt);
        }

        // ── EPÍLOGO ───────────────────────────────────────────
        // REEMPLAZAR línea 314 (epílogo completo):
        $this->emitLabel("{$name}_end");
        $this->emit("    add     sp, sp, #496          // liberar frame local");
        $this->emit("    ldp     x29, x30, [sp], #16");
        $this->emit("    ret");
        $this->emit("");

        // ── Restaurar estado del scope anterior ────────────────
        $this->currentScope = $prevScope;
        $this->environment  = $prevEnv;
        $this->stackOffset  = $prevOffset;
        $this->frameSize    = $prevFrameSize;
        $this->localVars    = $prevLocalVars;
        $this->tempReg      = $prevTempReg;

        return null;
    }

    /*
    ========================
    VARIABLE DECLARATION
    var x int32 = 10
    var a, b int32 = 1, 2
    ========================
    */
    public function visitVarDecl($ctx)
    {
        $ids    = $ctx->idList()->ID();
        $values = [];

        // Evaluar lista de expresiones si existe
        if ($ctx->exprList() !== null) {
            foreach ($ctx->exprList()->expression() as $expr) {
                $values[] = $this->visit($expr); // retorna registro con el valor
            }
        }

        // AGREGAR después del if ($ctx->exprList()) en visitVarDecl:
        $arrayReg = null;
        if ($ctx->arrayLiteral() !== null) {
            $arrayReg = $this->visit($ctx->arrayLiteral());
        }

        foreach ($ids as $i => $id) {
            $varName = $id->getText();
            $line    = $id->getSymbol()->getLine();
            $col     = $id->getSymbol()->getCharPositionInLine();

            // Reservar slot en stack
            $offset = $this->allocStack();
            $this->localVars[$varName] = $offset;
            $this->environment->define($varName, $offset, $line, $col);
            
            // LÍNEA CORRECTA:
            if ($arrayReg !== null) {
                $this->emit("    str     {$arrayReg}, [x29, #{$offset}]   // array {$varName}");
            } elseif (isset($values[$i])) {
                // Guardar el registro con el valor en el slot del stack
                $reg = $values[$i];
                $this->emit("    str     {$reg}, [x29, #{$offset}]   // var {$varName}");
            } else {
                // Valor por defecto: 0
                $this->emit("    str     xzr, [x29, #{$offset}]   // var {$varName} = default");
            }

            \SymbolTable::add(
                $varName,
                $this->resolveTypeName($ctx->type()),
                $this->currentScope,
                "—",
                $line,
                $col
            );
        }

        return null;
    }

    /*
    ========================
    SHORT VAR DECLARATION
    x := 10
    x, y := 1, 2
    ========================
    */
    public function visitShortVarDecl($ctx)
    {
        $ids    = $ctx->idList()->ID();
        $values = [];

        foreach ($ctx->exprList()->expression() as $expr) {
            $values[] = $this->visit($expr);
        }

        $hasNew = false;

        foreach ($ids as $i => $id) {
            $varName = $id->getText();
            $line    = $id->getSymbol()->getLine();
            $col     = $id->getSymbol()->getCharPositionInLine();
            $reg     = $values[$i] ?? "xzr";

            // ¿Ya existe en el scope actual?
            if (isset($this->localVars[$varName])) {
                // Reasignar
                $offset = $this->localVars[$varName];
                $this->emit("    str     {$reg}, [x29, #{$offset}]   // reassign {$varName}");
            } else {
                // Nueva variable
                $offset = $this->allocStack();
                $this->localVars[$varName] = $offset;
                $this->environment->define($varName, $offset, $line, $col);
                $this->emit("    str     {$reg}, [x29, #{$offset}]   // decl {$varName}");
                \SymbolTable::add($varName, "auto", $this->currentScope, "—", $line, $col);
                $hasNew = true;
            }
        }

        if (!$hasNew) {
            \ErrorTable::add(
                "Semantico",
                "Short declaration requiere al menos una variable nueva.",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
        }

        return null;
    }

    /*
    ========================
    CONSTANT DECLARATION
    const PI float32 = 3.14
    ========================
    */
    public function visitConstDecl($ctx)
    {
        $name  = $ctx->ID()->getText();
        $line  = $ctx->getStart()->getLine();
        $col   = $ctx->getStart()->getCharPositionInLine();

        // Evaluar la expresión constante
        $reg = $this->visit($ctx->expression());

        // Guardar en stack igual que una variable (inmutabilidad se valida semánticamente)
        $offset = $this->allocStack();
        $this->localVars[$name] = $offset;
        $this->environment->defineConst($name, $offset, $line, $col);
        $this->emit("    str     {$reg}, [x29, #{$offset}]   // const {$name}");

        \SymbolTable::add(
            $name,
            $this->resolveTypeName($ctx->type()),
            $this->currentScope,
            "—",
            $line,
            $col
        );

        return null;
    }

    /*
    ========================
    HELPER: Nombre del tipo
    a partir del nodo type()
    ========================
    */
    private function resolveTypeName($typeCtx): string
    {
        if ($typeCtx === null) return "auto";
        if ($typeCtx->primitiveType() !== null) {
            return $typeCtx->primitiveType()->getText();
        }
        if ($typeCtx->arrayType() !== null) {
            return "arreglo";
        }
        return "auto";
    }

    /*
    ========================
    BLOCK
    { statements* }
    ========================
    */
    public function visitBlock($ctx)
    {
        // Guardar estado del scope actual
        $prevEnv       = $this->environment;
        $prevLocalVars = $this->localVars;
        $prevOffset    = $this->stackOffset;

        // Crear scope hijo
        $this->environment = $prevEnv->createChild();

        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }

        // Restaurar scope anterior
        // Nota: el stack pointer NO se restaura aquí porque ARM64
        // maneja el frame completo en el prólogo/epílogo de la función
        $this->environment = $prevEnv;
        $this->localVars   = $prevLocalVars;
        $this->stackOffset = $prevOffset;

        return null;
    }

    /*
    ========================
    IF STATEMENT
    if cond { } else { }
    ========================
    */
    public function visitIfStmt($ctx)
    {
        $labelElse = $this->newLabel("if_else");
        $labelEnd  = $this->newLabel("if_end");

        // ── Evaluar condición ──────────────────────────────────
        $condReg = $this->visit($ctx->expression());

        // La condición debe ser booleana (0 = false, 1 = true)
        $this->emit("    cmp     {$condReg}, #0");

        // Si es false (== 0) saltamos al else
        if ($ctx->getChildCount() > 3) {
            // Hay else o else-if
            $this->emit("    b.eq    {$labelElse}");
        } else {
            // No hay else, saltamos directo al final
            $this->emit("    b.eq    {$labelEnd}");
        }

        // ── Bloque IF verdadero ────────────────────────────────
        $this->visit($ctx->block(0));

        if ($ctx->getChildCount() > 3) {
            // Saltar el else al terminar el bloque if
            $this->emit("    b       {$labelEnd}");

            // ── Bloque ELSE ────────────────────────────────────
            $this->emitLabel($labelElse);

            if ($ctx->ifStmt() !== null) {
                // else if → visitar recursivamente
                $this->visitIfStmt($ctx->ifStmt());
            } elseif ($ctx->block(1) !== null) {
                // else normal
                $this->visit($ctx->block(1));
            }
        }

        // ── Fin del if ─────────────────────────────────────────
        $this->emitLabel($labelEnd);

        return null;
    }

    /*
    ========================
    SWITCH STATEMENT
    switch exp { case: ... }
    ========================
    */
    public function visitSwitchStmt($ctx)
    {
        $labelEnd = $this->newLabel("switch_end");

        // Guardar breakLabel anterior y establecer el nuevo
        $prevBreak       = $this->breakLabel;
        $this->breakLabel = $labelEnd;

        // ── Evaluar expresión del switch ───────────────────────
        $switchReg = $this->visit($ctx->expression());

        // Guardar el valor en un registro fijo para comparaciones
        // usamos x19 (callee-saved) para no perderlo entre cases
        $this->emit("    mov     x19, {$switchReg}   // switch value");

        $labelDefault = null;

        // AGREGAR antes del primer foreach (línea 592):
        $caseLabels = [];

        // ── Generar saltos para cada case ─────────────────────
        foreach ($ctx->caseClause() as $i => $case) {

            $labelCase = $this->newLabel("case");

            // Guardar la etiqueta del case en el contexto para usarla abajo
            // PHP no tiene forma nativa de anotar el ctx, usamos array
            $caseLabels[] = $labelCase;

            // Evaluar cada valor del case (puede ser lista: case 1, 2:)
            foreach ($case->exprList()->expression() as $caseExpr) {
                $caseReg = $this->visit($caseExpr);
                $this->emit("    cmp     x19, {$caseReg}");
                $this->emit("    b.eq    {$labelCase}");
            }
        }

        // Si hay default, saltar a él; si no, saltar al final
        if ($ctx->defaultClause() !== null) {
            $labelDefault = $this->newLabel("case_default");
            $this->emit("    b       {$labelDefault}");
        } else {
            $this->emit("    b       {$labelEnd}");
        }

        // ── Generar cuerpo de cada case ───────────────────────
        foreach ($ctx->caseClause() as $i => $case) {

            $this->emitLabel($caseLabels[$i]);

            foreach ($case->statement() as $stmt) {
                $this->visit($stmt);
            }

            // Al terminar un case saltamos al final (no hay fallthrough en Golampi)
            $this->emit("    b       {$labelEnd}");
        }

        // ── Bloque default ────────────────────────────────────
        if ($ctx->defaultClause() !== null) {
            $this->emitLabel($labelDefault);
            foreach ($ctx->defaultClause()->statement() as $stmt) {
                $this->visit($stmt);
            }
        }

        // ── Fin del switch ────────────────────────────────────
        $this->emitLabel($labelEnd);

        // Restaurar breakLabel anterior
        $this->breakLabel = $prevBreak;

        return null;
    }

    /*
    ========================
    FOR STATEMENT
    3 formas:
    for init; cond; update { }
    for cond { }
    for { }
    ========================
    */
    public function visitForStmt($ctx)
    {
        $labelStart  = $this->newLabel("for_start");
        $labelUpdate = $this->newLabel("for_update");
        $labelEnd    = $this->newLabel("for_end");

        // Guardar labels anteriores de break/continue
        $prevBreak    = $this->breakLabel;
        $prevContinue = $this->continueLabel;

        $this->breakLabel    = $labelEnd;
        $this->continueLabel = $labelUpdate;

        // ── FOR CLÁSICO: for init; cond; update { } ───────────
        if ($ctx->forClause() !== null) {

            $clause = $ctx->forClause();

            // Init
            if ($clause->forInit() !== null) {
                $this->visit($clause->forInit());
            }

            // Inicio del bucle
            $this->emitLabel($labelStart);

            // Condición
            if ($clause->expression(0) !== null) {
                $condReg = $this->visit($clause->expression(0));
                $this->emit("    cmp     {$condReg}, #0");
                $this->emit("    b.eq    {$labelEnd}");
            }

            // Cuerpo
            $this->visit($ctx->block());

            // Update (i++, i--, etc.)
            $this->emitLabel($labelUpdate);
            if ($clause->expression(1) !== null) {
                $this->visit($clause->expression(1));
            }

            $this->emit("    b       {$labelStart}");

        // ── FOR TIPO WHILE: for cond { } ──────────────────────
        } elseif ($ctx->expression() !== null) {

            $this->emitLabel($labelStart);

            $condReg = $this->visit($ctx->expression());
            $this->emit("    cmp     {$condReg}, #0");
            $this->emit("    b.eq    {$labelEnd}");

            $this->visit($ctx->block());

            // continue salta aquí (re-evalúa condición)
            $this->emitLabel($labelUpdate);
            $this->emit("    b       {$labelStart}");

        // ── FOR INFINITO: for { } ─────────────────────────────
        } else {

            $this->emitLabel($labelStart);

            $this->visit($ctx->block());

            // continue salta aquí (vuelve al inicio)
            $this->emitLabel($labelUpdate);
            $this->emit("    b       {$labelStart}");
        }

        // Fin del bucle
        $this->emitLabel($labelEnd);

        // Restaurar labels anteriores
        $this->breakLabel    = $prevBreak;
        $this->continueLabel = $prevContinue;

        return null;
    }

    /*
    ========================
    FOR INIT
    shortVarDecl | assignment
    ========================
    */
    public function visitForInit($ctx)
    {
        if ($ctx->shortVarDecl() !== null) {
            return $this->visit($ctx->shortVarDecl());
        }
        if ($ctx->assignment() !== null) {
            return $this->visit($ctx->assignment());
        }
        return null;
    }

    /*
    ========================
    BREAK
    ========================
    */
    public function visitBreakStmt($ctx)
    {
        if ($this->breakLabel !== null) {
            $this->emit("    b       {$this->breakLabel}   // break");
        } else {
            \ErrorTable::add(
                "Semantico",
                "break fuera de bucle o switch.",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
        }
        return null;
    }

    /*
    ========================
    CONTINUE
    ========================
    */
    public function visitContinueStmt($ctx)
    {
        if ($this->continueLabel !== null) {
            $this->emit("    b       {$this->continueLabel}   // continue");
        } else {
            \ErrorTable::add(
                "Semantico",
                "continue fuera de bucle.",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
        }
        return null;
    }

    /*
    ========================
    RETURN
    return exp?
    return exp1, exp2
    ========================
    */
    public function visitReturnStmt($ctx)
    {
        if ($ctx->exprList() !== null) {

            $exprs = $ctx->exprList()->expression();

            if (count($exprs) === 1) {
                // Retorno simple: resultado en x0
                $reg = $this->visit($exprs[0]);
                $this->emit("    mov     x0, {$reg}   // return value");

            } else {
                // Múltiples retornos: x0, x1, ...
                foreach ($exprs as $i => $expr) {
                    $reg = $this->visit($expr);
                    $this->emit("    mov     x{$i}, {$reg}   // return value[$i]");
                }
            }
        }

        // Saltar al epílogo de la función
        $this->emit("    b       {$this->currentScope}_end   // return");

        return null;
    }

    /*
    ========================
    ASSIGNMENT
    x = exp
    x += exp
    x[i] = exp
    ========================
    */
    public function visitAssignment($ctx)
    {
        $leftExpr = $ctx->expression(0);
        $leftText = $leftExpr->getText();
        $operator = $ctx->assignOp()->getText();

        // Evaluar el lado derecho
        $rightReg = $this->visit($ctx->expression(1));

        // ── ASIGNACIÓN A ARRAY: a[i] = exp ────────────────────
        if (preg_match('/^([a-zA-Z_][a-zA-Z0-9_]*)\[(.+)\]$/', $leftText, $m)) {

            $arrName  = $m[1];
            $idxText  = $m[2];

            // Obtener base del array en stack
            if (!isset($this->localVars[$arrName])) {
                \ErrorTable::add("Semantico", "Variable '$arrName' no declarada.", $ctx->getStart()->getLine(), $ctx->getStart()->getCharPositionInLine());
                return null;
            }

            $baseOffset = $this->localVars[$arrName];



            // REEMPLAZAR con esto:
            if (is_numeric($idxText)) {
                // Índice constante: cargarlo directamente
                $idxReg = $this->nextReg();
                $this->emit("    mov     {$idxReg}, #{$idxText}   // índice constante");
            } elseif (isset($this->localVars[$idxText])) {
                // Índice es una variable local
                $idxReg = $this->nextReg();
                $idxOff = $this->localVars[$idxText];
                $this->emit("    ldr     {$idxReg}, [x29, #{$idxOff}]   // índice {$idxText}");
            } else {
                // Fallback: emitir 0
                $idxReg = $this->nextReg();
                $this->emit("    mov     {$idxReg}, #0   // índice desconocido");
            }

            // Calcular dirección: base + index * 8
            $baseReg = $this->nextReg();
            $addrReg = $this->nextReg();
            $this->emit("    add     {$baseReg}, x29, #{$baseOffset}   // base de {$arrName}");
            $this->emit("    add     {$addrReg}, {$baseReg}, {$idxReg}, lsl #3   // addr {$arrName}[i]");
            
            // Aplicar operador compuesto si corresponde
            if ($operator !== "=") {
                $oldReg = $this->nextReg();
                $this->emit("    ldr     {$oldReg}, [{$addrReg}]");
                $rightReg = $this->applyCompoundOp($operator, $oldReg, $rightReg, $ctx);
            }

            $this->emit("    str     {$rightReg}, [{$addrReg}]   // {$arrName}[i] = val");
            return null;
        }

        // ── ASIGNACIÓN A PUNTERO: *p = exp ────────────────────
        if (strlen($leftText) > 1 && $leftText[0] === '*') {

            $ptrName = substr($leftText, 1);

            if (!isset($this->localVars[$ptrName])) {
                \ErrorTable::add("Semantico", "Puntero '$ptrName' no declarado.", $ctx->getStart()->getLine(), $ctx->getStart()->getCharPositionInLine());
                return null;
            }

            $ptrOffset = $this->localVars[$ptrName];
            $ptrReg    = $this->nextReg();

            // Cargar la dirección guardada en el puntero
            $this->emit("    ldr     {$ptrReg}, [x29, #{$ptrOffset}]   // load ptr addr");

            if ($operator !== "=") {
                $oldReg = $this->nextReg();
                $this->emit("    ldr     {$oldReg}, [{$ptrReg}]");
                $rightReg = $this->applyCompoundOp($operator, $oldReg, $rightReg, $ctx);
            }

            $this->emit("    str     {$rightReg}, [{$ptrReg}]   // *{$ptrName} = val");
            return null;
        }

        // ── ASIGNACIÓN A VARIABLE NORMAL ──────────────────────
        if (!isset($this->localVars[$leftText])) {
            \ErrorTable::add(
                "Semantico",
                "Variable '$leftText' no declarada.",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            return null;
        }

        $offset = $this->localVars[$leftText];

        // Operador compuesto: cargar valor actual, operar, guardar
        if ($operator !== "=") {
            $oldReg = $this->nextReg();
            $this->emit("    ldr     {$oldReg}, [x29, #{$offset}]   // load {$leftText}");
            $rightReg = $this->applyCompoundOp($operator, $oldReg, $rightReg, $ctx);
        }

        $this->emit("    str     {$rightReg}, [x29, #{$offset}]   // {$leftText} = val");

        return null;
    }

    /*
    ========================
    HELPER: Operador compuesto
    +=  -=  *=  /=
    ========================
    */
    private function applyCompoundOp($op, $leftReg, $rightReg, $ctx): string
    {
        $destReg = $this->nextReg();

        switch ($op) {
            case "+=":
                $this->emit("    add     {$destReg}, {$leftReg}, {$rightReg}");
                break;
            case "-=":
                $this->emit("    sub     {$destReg}, {$leftReg}, {$rightReg}");
                break;
            case "*=":
                $this->emit("    mul     {$destReg}, {$leftReg}, {$rightReg}");
                break;
            case "/=":
                $this->emit("    sdiv    {$destReg}, {$leftReg}, {$rightReg}");
                break;
            default:
                $destReg = $rightReg;
        }

        return $destReg;
    }

    /*
    ========================
    EXPRESSION STATEMENT
    expr usado como sentencia
    (llamadas a función, i++, etc.)
    ========================
    */
    public function visitExprStmt($ctx)
    {
        $this->visit($ctx->expression());
        return null;
    }

    /*
    ========================
    STATEMENT
    dispatcher general
    ========================
    */
    public function visitStatement($ctx)
    {
        if ($ctx->block())         return $this->visit($ctx->block());
        if ($ctx->varDecl())       return $this->visit($ctx->varDecl());
        if ($ctx->constDecl())     return $this->visit($ctx->constDecl());
        if ($ctx->shortVarDecl())  return $this->visit($ctx->shortVarDecl());
        if ($ctx->assignment())    return $this->visit($ctx->assignment());
        if ($ctx->ifStmt())        return $this->visit($ctx->ifStmt());
        if ($ctx->switchStmt())    return $this->visit($ctx->switchStmt());
        if ($ctx->forStmt())       return $this->visit($ctx->forStmt());
        if ($ctx->breakStmt())     return $this->visit($ctx->breakStmt());
        if ($ctx->continueStmt())  return $this->visit($ctx->continueStmt());
        if ($ctx->returnStmt())    return $this->visit($ctx->returnStmt());
        if ($ctx->exprStmt())      return $this->visit($ctx->exprStmt());
        return null;
    }

    /*
    ========================
    EXPRESSION
    dispatcher
    ========================
    */
    public function visitExpression($ctx)
    {
        return $this->visit($ctx->logicalOr());
    }

    /*
    ========================
    LOGICAL OR  ||
    cortocircuito
    ========================
    */
    public function visitLogicalOr($ctx)
    {
        $ands = $ctx->logicalAnd();

        if (count($ands) === 1) {
            return $this->visit($ands[0]);
        }

        $labelTrue = $this->newLabel("or_true");
        $labelEnd  = $this->newLabel("or_end");
        $destReg   = $this->nextReg();

        foreach ($ands as $i => $and) {
            $reg = $this->visit($and);
            $this->emit("    cmp     {$reg}, #0");
            $this->emit("    b.ne    {$labelTrue}   // cortocircuito ||");
        }

        // Todos false
        $this->emit("    mov     {$destReg}, #0");
        $this->emit("    b       {$labelEnd}");

        $this->emitLabel($labelTrue);
        $this->emit("    mov     {$destReg}, #1");

        $this->emitLabel($labelEnd);

        return $destReg;
    }

    /*
    ========================
    LOGICAL AND  &&
    cortocircuito
    ========================
    */
    public function visitLogicalAnd($ctx)
    {
        $eqs = $ctx->equality();

        if (count($eqs) === 1) {
            return $this->visit($eqs[0]);
        }

        $labelFalse = $this->newLabel("and_false");
        $labelEnd   = $this->newLabel("and_end");
        $destReg    = $this->nextReg();

        foreach ($eqs as $eq) {
            $reg = $this->visit($eq);
            $this->emit("    cmp     {$reg}, #0");
            $this->emit("    b.eq    {$labelFalse}   // cortocircuito &&");
        }

        // Todos true
        $this->emit("    mov     {$destReg}, #1");
        $this->emit("    b       {$labelEnd}");

        $this->emitLabel($labelFalse);
        $this->emit("    mov     {$destReg}, #0");

        $this->emitLabel($labelEnd);

        return $destReg;
    }

    /*
    ========================
    EQUALITY  == !=
    ========================
    */
    public function visitEquality($ctx)
    {
        $rels = $ctx->relational();

        if (count($rels) === 1) {
            return $this->visit($rels[0]);
        }

        $result = $this->visit($rels[0]);

        for ($i = 1; $i < count($rels); $i++) {
            $right   = $this->visit($rels[$i]);
            $op      = $ctx->getChild(2 * $i - 1)->getText();
            $destReg = $this->nextReg();
            $labelT  = $this->newLabel("eq_true");
            $labelE  = $this->newLabel("eq_end");

            $this->emit("    cmp     {$result}, {$right}");

            if ($op === "==") {
                $this->emit("    b.eq    {$labelT}");
            } else {
                $this->emit("    b.ne    {$labelT}");
            }

            $this->emit("    mov     {$destReg}, #0");
            $this->emit("    b       {$labelE}");
            $this->emitLabel($labelT);
            $this->emit("    mov     {$destReg}, #1");
            $this->emitLabel($labelE);

            $result = $destReg;
        }

        return $result;
    }

    /*
    ========================
    RELATIONAL  > >= < <=
    ========================
    */
    public function visitRelational($ctx)
    {
        $adds = $ctx->additive();

        if (count($adds) === 1) {
            return $this->visit($adds[0]);
        }

        $result = $this->visit($adds[0]);

        for ($i = 1; $i < count($adds); $i++) {
            $right   = $this->visit($adds[$i]);
            $op      = $ctx->getChild(2 * $i - 1)->getText();
            $destReg = $this->nextReg();
            $labelT  = $this->newLabel("rel_true");
            $labelE  = $this->newLabel("rel_end");

            $this->emit("    cmp     {$result}, {$right}");

            switch ($op) {
                case ">":  $this->emit("    b.gt    {$labelT}"); break;
                case ">=": $this->emit("    b.ge    {$labelT}"); break;
                case "<":  $this->emit("    b.lt    {$labelT}"); break;
                case "<=": $this->emit("    b.le    {$labelT}"); break;
            }

            $this->emit("    mov     {$destReg}, #0");
            $this->emit("    b       {$labelE}");
            $this->emitLabel($labelT);
            $this->emit("    mov     {$destReg}, #1");
            $this->emitLabel($labelE);

            $result = $destReg;
        }

        return $result;
    }

    /*
    ========================
    ADDITIVE  + -
    ========================
    */
    public function visitAdditive($ctx)
    {
        $muls = $ctx->multiplicative();

        if (count($muls) === 1) {
            return $this->visit($muls[0]);
        }

        $result = $this->visit($muls[0]);

        for ($i = 1; $i < count($muls); $i++) {
            $right   = $this->visit($muls[$i]);
            $op      = $ctx->getChild(2 * $i - 1)->getText();
            $destReg = $this->nextReg();

            if ($op === "+") {
                $this->emit("    add     {$destReg}, {$result}, {$right}");
            } else {
                $this->emit("    sub     {$destReg}, {$result}, {$right}");
            }

            $result = $destReg;
        }

        return $result;
    }

    /*
    ========================
    MULTIPLICATIVE  * / %
    ========================
    */
    public function visitMultiplicative($ctx)
    {
        $uns = $ctx->unary();

        if (count($uns) === 1) {
            return $this->visit($uns[0]);
        }

        $result = $this->visit($uns[0]);

        for ($i = 1; $i < count($uns); $i++) {
            $right   = $this->visit($uns[$i]);
            $op      = $ctx->getChild(2 * $i - 1)->getText();
            $destReg = $this->nextReg();

            switch ($op) {
                case "*":
                    $this->emit("    mul     {$destReg}, {$result}, {$right}");
                    break;
                case "/":
                    $this->emit("    sdiv    {$destReg}, {$result}, {$right}");
                    break;
                case "%":
                    // ARM64 no tiene mod directo: a % b = a - (a/b)*b
                    $divReg = $this->nextReg();
                    $this->emit("    sdiv    {$divReg}, {$result}, {$right}");
                    $this->emit("    msub    {$destReg}, {$divReg}, {$right}, {$result}");
                    break;
            }

            $result = $destReg;
        }

        return $result;
    }

    /*
    ========================
    UNARY  ! - & *
    ========================
    */
    public function visitUnary($ctx)
    {
        // Sin operador unario → pasar a postfix
        if ($ctx->getChildCount() === 1) {
            return $this->visit($ctx->postfix());
        }

        $op      = $ctx->getChild(0)->getText();
        $destReg = $this->nextReg();

        switch ($op) {

            // Negación lógica: !bool
            case "!":
                $reg = $this->visit($ctx->unary());
                $labelT = $this->newLabel("not_true");
                $labelE = $this->newLabel("not_end");
                $this->emit("    cmp     {$reg}, #0");
                $this->emit("    b.eq    {$labelT}");
                $this->emit("    mov     {$destReg}, #0");
                $this->emit("    b       {$labelE}");
                $this->emitLabel($labelT);
                $this->emit("    mov     {$destReg}, #1");
                $this->emitLabel($labelE);
                break;

            // Negación aritmética: -x
            case "-":
                $reg = $this->visit($ctx->unary());
                $this->emit("    neg     {$destReg}, {$reg}");
                break;

            // Referencia: &x → obtener dirección en stack
            case "&":
                $varName = $ctx->unary()->getText();
                if (!isset($this->localVars[$varName])) {
                    \ErrorTable::add("Semantico", "Variable '$varName' no declarada.", $ctx->getStart()->getLine(), $ctx->getStart()->getCharPositionInLine());
                    return $destReg;
                }
                $offset = $this->localVars[$varName];
                $this->emit("    add     {$destReg}, x29, #{$offset}   // &{$varName}");
                break;

            // Desreferencia: *p → cargar valor de la dirección
            case "*":
                $reg = $this->visit($ctx->unary());
                $this->emit("    ldr     {$destReg}, [{$reg}]   // *ptr");
                break;

            default:
                $destReg = $this->visit($ctx->postfix());
        }

        return $destReg;
    }

    /*
    ========================
    POSTFIX
    llamadas, índices, ++/--
    ========================
    */
    public function visitPostfix($ctx)
    {
        // Evaluar primary
        $value   = $this->visit($ctx->primary());
        $varName = null;

        if ($ctx->primary()->ID() !== null) {
            $varName = $ctx->primary()->ID()->getText();
        }

        for ($i = 1; $i < $ctx->getChildCount(); $i++) {

            $child = $ctx->getChild($i);

            // ── LLAMADA A FUNCIÓN ──────────────────────────────
            if ($child instanceof \Context\CallContext) {

                if ($varName === "main") {
                    \ErrorTable::add("Semantico", "La funcion main no puede invocarse explicitamente.", $ctx->getStart()->getLine(), $ctx->getStart()->getCharPositionInLine());
                    return "xzr";
                }

                // Evaluar argumentos y cargarlos en x0..x7
                if ($child->exprList() !== null) {
                    $args = $child->exprList()->expression();
                    foreach ($args as $j => $arg) {
                        $argReg = $this->visit($arg);
                        $this->emit("    mov     x{$j}, {$argReg}   // arg[$j]");
                    }
                }

                $this->emit("    bl      {$varName}   // call {$varName}");

                // El resultado queda en x0
                $destReg = $this->nextReg();
                $this->emit("    mov     {$destReg}, x0   // return value");
                $value = $destReg;

            // ── ÍNDICE DE ARRAY ────────────────────────────────
            } elseif ($child instanceof \Context\IndexContext) {

                $idxReg  = $this->visit($child->expression());
                $destReg = $this->nextReg();

                // value contiene la dirección base del array
                // Calcular: base + index * 8
                $this->emit("    add     {$destReg}, {$value}, {$idxReg}, lsl #3   // array[i]");
                $loadReg = $this->nextReg();
                $this->emit("    ldr     {$loadReg}, [{$destReg}]   // load array[i]");
                $value = $loadReg;

            // ── ++ / -- ────────────────────────────────────────
            } elseif ($child instanceof \Context\IncrementOpContext) {

                $op      = $child->getText();
                $destReg = $this->nextReg();

                if ($op === "++") {
                    $this->emit("    add     {$destReg}, {$value}, #1   // {$varName}++");
                } else {
                    $this->emit("    sub     {$destReg}, {$value}, #1   // {$varName}--");
                }

                // Guardar el nuevo valor en la variable
                if ($varName !== null && isset($this->localVars[$varName])) {
                    $offset = $this->localVars[$varName];
                    $this->emit("    str     {$destReg}, [x29, #{$offset}]");
                }

                $value = $destReg;
            }
        }

        return $value;
    }

    /*
    ========================
    PRIMARY
    literal | ID | builtin | array | (expr)
    ========================
    */
    public function visitPrimary($ctx)
    {
        // Literal
        if ($ctx->literal() !== null) {
            return $this->visit($ctx->literal());
        }

        // Builtin
        if ($ctx->builtinCall() !== null) {
            return $this->visit($ctx->builtinCall());
        }

        // Array literal
        if ($ctx->arrayLiteral() !== null) {
            return $this->visit($ctx->arrayLiteral());
        }

        // Identificador → cargar desde stack
        if ($ctx->ID() !== null) {
            $name    = $ctx->ID()->getText();
            $destReg = $this->nextReg();

            // REEMPLAZAR el bloque completo (líneas 1433-1440) con esto:
            if (!isset($this->localVars[$name])) {
                // Verificar si es una función conocida (no reportar error)
                if (!isset($this->functions[$name])) {
                    \ErrorTable::add(
                        "Semantico",
                        "Identificador '$name' no declarado.",
                        $ctx->ID()->getSymbol()->getLine(),
                        $ctx->ID()->getSymbol()->getCharPositionInLine()
                    );
                }
                // Para funciones: no emitir ldr, el bl lo maneja visitPostfix
                $this->emit("    mov     {$destReg}, #0   // ref a {$name}");
                return $destReg;
            }

            $offset = $this->localVars[$name];
            $this->emit("    ldr     {$destReg}, [x29, #{$offset}]   // load {$name}");
            return $destReg;
        }

        // Expresión entre paréntesis
        if ($ctx->expression() !== null) {
            return $this->visit($ctx->expression());
        }

        $r = $this->nextReg();
        $this->emit("    mov     {$r}, #0");
        return $r;
    }

    /*
    ========================
    LITERAL
    int | float | string | rune | bool | nil
    ========================
    */
    public function visitLiteral($ctx)
    {
        $text    = $ctx->getText();
        $destReg = $this->nextReg();

        // INT
        if (preg_match('/^-?\d+$/', $text)) {
            $val = intval($text);
            $this->emit("    mov     {$destReg}, #{$val}");
            return $destReg;
        }

        // FLOAT (guardado como entero escalado x1000 por simplicidad)
        if (preg_match('/^-?\d+\.\d+$/', $text)) {
            $val = intval(floatval($text) * 1000);
            $this->emit("    mov     {$destReg}, #{$val}   // float {$text} x1000");
            return $destReg;
        }

        // STRING
        if ($text[0] === '"') {
            $str   = substr($text, 1, -1);
            $label = $this->addString($str);
            $this->emit("    adrp    {$destReg}, {$label}");
            $this->emit("    add     {$destReg}, {$destReg}, :lo12:{$label}");
            return $destReg;
        }

        // RUNE → valor ASCII
        if ($text[0] === "'") {
            $char = substr($text, 1, -1);
            $val  = ord($char);
            $this->emit("    mov     {$destReg}, #{$val}   // rune '{$char}'");
            return $destReg;
        }

        // BOOL
        if ($text === "true") {
            $this->emit("    mov     {$destReg}, #1   // true");
            return $destReg;
        }
        if ($text === "false") {
            $this->emit("    mov     {$destReg}, #0   // false");
            return $destReg;
        }

        // NIL
        if ($text === "nil") {
            $this->emit("    mov     {$destReg}, #0   // nil");
            return $destReg;
        }

        $this->emit("    mov     {$destReg}, #0");
        return $destReg;
    }

    /*
    ========================
    ARRAY LITERAL
    [3]int32{1, 2, 3}
    ========================
    */
    public function visitArrayLiteral($ctx)
    {
        // Evaluar tamaño
        $sizeReg = $this->visit($ctx->expression());

        // Reservar espacio en stack para el array
        // Retornamos la dirección base del array
        $baseReg = $this->nextReg();

        // Cada elemento ocupa 8 bytes
        // Ajustamos el stack pointer manualmente
        $this->emit("    // array literal: reservar espacio en stack");
        $this->emit("    sub     sp, sp, {$sizeReg}, lsl #3   // size * 8 bytes");
        $this->emit("    mov     {$baseReg}, sp   // base del array");

        // Inicializar elementos si se proporcionaron
        if ($ctx->arrayElements() !== null) {
            $elements = $ctx->arrayElements()->arrayElement();
            foreach ($elements as $i => $elem) {
                $valReg  = $this->visit($elem->expression());
                $elemOffset = $i * 8;
                $this->emit("    str     {$valReg}, [{$baseReg}, #{$elemOffset}]   // arr[{$i}]");
            }
        }

        return $baseReg;
    }

    /*
    ========================
    EXPR LIST
    retorna array de registros
    ========================
    */
    public function visitExprList($ctx)
    {
        $regs = [];
        foreach ($ctx->expression() as $expr) {
            $regs[] = $this->visit($expr);
        }
        return $regs;
    }

    /*
    ========================
    BUILTIN CALLS
    dispatcher
    ========================
    */
    public function visitBuiltinCall($ctx)
    {
        $text = $ctx->getText();

        if (str_starts_with($text, "fmt.Println")) {
            return $this->emitPrintln($ctx);
        }

        if (str_starts_with($text, "len")) {
            return $this->emitLen($ctx);
        }

        if (str_starts_with($text, "now")) {
            return $this->emitNow($ctx);
        }

        if (str_starts_with($text, "substr")) {
            return $this->emitSubstr($ctx);
        }

        if (str_starts_with($text, "typeOf")) {
            return $this->emitTypeOf($ctx);
        }

        return "xzr";
    }

    /*
    ========================
    fmt.Println(v1, v2, ...)
    ========================
    */
    private function emitPrintln($ctx): string
    {
        // Asegurarnos de tener las rutinas helper en el código
        $this->requireHelper("__print_int");
        $this->requireHelper("__print_str");
        $this->requireHelper("__print_bool");
        $this->requireHelper("__print_newline");

        if ($ctx->exprList() !== null) {
            $exprs = $ctx->exprList()->expression();

            foreach ($exprs as $i => $expr) {

                // Evaluar la expresión
                $reg = $this->visit($expr);

                // Detectar el tipo del literal/expresión para saber
                // qué rutina de impresión usar
                $typeHint = $this->detectTypeHint($expr);

                $this->emit("    // fmt.Println arg[$i] tipo={$typeHint}");

                switch ($typeHint) {

                    case "string":
                        // reg contiene dirección del string en .data
                        // Necesitamos también la longitud
                        $lenLabel = $this->getStringLenLabel($expr);
                        if ($lenLabel !== null) {
                            $this->emit("    mov     x0, {$reg}         // str addr");
                            $this->emit("    mov     x1, #{$lenLabel}    // str len");
                        } else {
                            // Longitud desconocida: usar __strlen helper
                            $this->requireHelper("__strlen");
                            $this->emit("    mov     x0, {$reg}");
                            $this->emit("    bl      __strlen");
                            $this->emit("    mov     x1, x0");
                            $this->emit("    mov     x0, {$reg}");
                        }
                        $this->emit("    bl      __print_str");
                        break;

                    case "bool":
                        $this->emit("    mov     x0, {$reg}");
                        $this->emit("    bl      __print_bool");
                        break;

                    case "rune":
                        // Imprimir como carácter ASCII via syscall write
                        $this->emit("    // print rune (1 byte ASCII)");
                        $this->emit("    sub     sp, sp, #16");
                        $this->emit("    strb    w{$this->regNum($reg)}, [sp]");
                        $this->emit("    mov     x0, #1          // stdout");
                        $this->emit("    mov     x1, sp          // addr");
                        $this->emit("    mov     x2, #1          // len = 1");
                        $this->emit("    mov     x8, #64         // syscall write");
                        $this->emit("    svc     #0");
                        $this->emit("    add     sp, sp, #16");
                        break;

                    default:
                        // int32 / float / default → imprimir como entero
                        $this->emit("    mov     x0, {$reg}");
                        $this->emit("    bl      __print_int");
                        break;
                }

                // Separador espacio entre argumentos (excepto el último)
                if ($i < count($exprs) - 1) {
                    $this->requireHelper("__print_space");
                    $this->emit("    bl      __print_space");
                }
            }
        }

        // Salto de línea al final
        $this->emit("    bl      __print_newline");

        return "xzr";
    }

    /*
    ========================
    HELPER: detectar tipo
    de una expresión para
    elegir rutina de impresión
    ========================
    */
    private function detectTypeHint($expr): string
    {
        $text = $expr->getText();

        // String literal
        if (strlen($text) >= 2 && $text[0] === '"') {
            return "string";
        }

        // Rune literal
        if (strlen($text) >= 3 && $text[0] === "'") {
            return "rune";
        }

        // Bool literal
        if ($text === "true" || $text === "false") {
            return "bool";
        }

        // Número
        if (preg_match('/^-?\d+$/', $text)) {
            return "int";
        }

        // Variable: intentar inferir por nombre en localVars
        // Por defecto tratamos como int (el más común)
        return "int";
    }

    /*
    ========================
    HELPER: obtener etiqueta
    de longitud de un string
    literal en .data
    ========================
    */
    private function getStringLenLabel($expr): ?string
    {
        $text = $expr->getText();
        if (strlen($text) >= 2 && $text[0] === '"') {
            // El último string agregado al .data tiene índice strCounter-1
            $idx = $this->strCounter - 1;
            return "str_{$idx}_len";
        }
        return null;
    }

    /*
    ========================
    HELPER: número de registro
    "x9" → 9
    ========================
    */
    private function regNum(string $reg): int
    {
        return intval(ltrim($reg, "xw"));
    }

    /*
    ========================
    RUTINAS HELPER ARM64
    Se emiten UNA sola vez
    al final del .text
    ========================
    */

    // Conjunto de helpers ya emitidos
    private $helpers = [];

    private function requireHelper(string $name): void
    {
        if (isset($this->helpers[$name])) {
            return; // ya fue emitido
        }
        $this->helpers[$name] = true;

        switch ($name) {

            // ──────────────────────────────────────────────────
            // __print_int
            // Imprime el entero en x0 como string decimal
            // ──────────────────────────────────────────────────
            case "__print_int":
                $this->emitHelper("// ── Helper: __print_int ──────────────────────────");
                $this->emitHelperLabel("__print_int");
                $this->emitHelper("    stp     x29, x30, [sp, #-64]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    mov     x9,  x0            // valor a imprimir");
                $this->emitHelper("    mov     x10, #0            // contador dígitos");
                $this->emitHelper("    add     x11, x29, #16      // buffer en stack");
                $this->emitHelper("    // Caso especial: 0");
                $this->emitHelper("    cbnz    x9, __pi_neg_check");
                $this->emitHelper("    mov     w12, #48           // '0'");
                $this->emitHelper("    strb    w12, [x11]");
                $this->emitHelper("    mov     x0, #1             // stdout");
                $this->emitHelper("    mov     x1, x11");
                $this->emitHelper("    mov     x2, #1");
                $this->emitHelper("    mov     x8, #64");
                $this->emitHelper("    svc     #0");
                $this->emitHelper("    b       __pi_done");
                $this->emitHelperLabel("__pi_neg_check");
                $this->emitHelper("    // Negativo?");
                $this->emitHelper("    cmp     x9, #0");
                $this->emitHelper("    b.ge    __pi_loop");
                $this->emitHelper("    mov     w12, #45           // '-'");
                $this->emitHelper("    strb    w12, [x11, x10]");
                $this->emitHelper("    add     x10, x10, #1");
                $this->emitHelper("    neg     x9, x9");
                $this->emitHelperLabel("__pi_loop");
                $this->emitHelper("    cbz     x9, __pi_reverse");
                $this->emitHelper("    mov     x13, #10");
                $this->emitHelper("    udiv    x14, x9, x13       // cociente");
                $this->emitHelper("    msub    x15, x14, x13, x9  // resto = x9 - cociente*10");
                $this->emitHelper("    add     x15, x15, #48      // ASCII");
                $this->emitHelper("    strb    w15, [x11, x10]");
                $this->emitHelper("    add     x10, x10, #1");
                $this->emitHelper("    mov     x9,  x14");
                $this->emitHelper("    b       __pi_loop");
                $this->emitHelperLabel("__pi_reverse");
                $this->emitHelper("    // Invertir dígitos en buffer");
                $this->emitHelper("    mov     x16, #0            // inicio");
                $this->emitHelper("    sub     x17, x10, #1       // fin");
                $this->emitHelperLabel("__pi_rev_loop");
                $this->emitHelper("    cmp     x16, x17");
                $this->emitHelper("    b.ge    __pi_print");
                $this->emitHelper("    ldrb    w12, [x11, x16]");
                $this->emitHelper("    ldrb    w13, [x11, x17]");
                $this->emitHelper("    strb    w13, [x11, x16]");
                $this->emitHelper("    strb    w12, [x11, x17]");
                $this->emitHelper("    add     x16, x16, #1");
                $this->emitHelper("    sub     x17, x17, #1");
                $this->emitHelper("    b       __pi_rev_loop");
                $this->emitHelperLabel("__pi_print");
                $this->emitHelper("    mov     x0, #1             // stdout");
                $this->emitHelper("    mov     x1, x11            // buffer");
                $this->emitHelper("    mov     x2, x10            // longitud");
                $this->emitHelper("    mov     x8, #64            // syscall write");
                $this->emitHelper("    svc     #0");
                $this->emitHelperLabel("__pi_done");
                $this->emitHelper("    ldp     x29, x30, [sp], #64");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;

            // ──────────────────────────────────────────────────
            // __print_str
            // x0 = dirección del string
            // x1 = longitud
            // ──────────────────────────────────────────────────
            case "__print_str":
                $this->emitHelper("// ── Helper: __print_str ──────────────────────────");
                $this->emitHelperLabel("__print_str");
                $this->emitHelper("    stp     x29, x30, [sp, #-16]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    mov     x2,  x1            // longitud");
                $this->emitHelper("    mov     x1,  x0            // dirección");
                $this->emitHelper("    mov     x0,  #1            // stdout");
                $this->emitHelper("    mov     x8,  #64           // syscall write");
                $this->emitHelper("    svc     #0");
                $this->emitHelper("    ldp     x29, x30, [sp], #16");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;

            // ──────────────────────────────────────────────────
            // __print_bool
            // x0 = 0 (false) o 1 (true)
            // ──────────────────────────────────────────────────
            case "__print_bool":
                $this->emitHelper("// ── Helper: __print_bool ─────────────────────────");
                // Agregar strings true/false al .data
                $this->emitHelperData("__str_true:  .ascii \"true\"");
                $this->emitHelperData("__str_true_len = . - __str_true");
                $this->emitHelperData("__str_false: .ascii \"false\"");
                $this->emitHelperData("__str_false_len = . - __str_false");
                $this->emitHelperLabel("__print_bool");
                $this->emitHelper("    stp     x29, x30, [sp, #-16]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    cbnz    x0, __pb_true");
                $this->emitHelper("    adrp    x1, __str_false");
                $this->emitHelper("    add     x1, x1, :lo12:__str_false");
                $this->emitHelper("    mov     x2, #5             // len('false')");
                $this->emitHelper("    b       __pb_write");
                $this->emitHelperLabel("__pb_true");
                $this->emitHelper("    adrp    x1, __str_true");
                $this->emitHelper("    add     x1, x1, :lo12:__str_true");
                $this->emitHelper("    mov     x2, #4             // len('true')");
                $this->emitHelperLabel("__pb_write");
                $this->emitHelper("    mov     x0, #1             // stdout");
                $this->emitHelper("    mov     x8, #64            // syscall write");
                $this->emitHelper("    svc     #0");
                $this->emitHelper("    ldp     x29, x30, [sp], #16");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;

            // ──────────────────────────────────────────────────
            // __print_newline
            // ──────────────────────────────────────────────────
            case "__print_newline":
                $this->emitHelper("// ── Helper: __print_newline ──────────────────────");
                $this->emitHelperData("__newline: .ascii \"\\n\"");
                $this->emitHelperLabel("__print_newline");
                $this->emitHelper("    stp     x29, x30, [sp, #-16]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    adrp    x0, __newline");
                $this->emitHelper("    add     x0, x0, :lo12:__newline");
                $this->emitHelper("    // reordenar para syscall: x0=fd, x1=buf, x2=len");
                $this->emitHelper("    mov     x2, #1");
                $this->emitHelper("    mov     x1, x0");
                $this->emitHelper("    mov     x0, #1");
                $this->emitHelper("    mov     x8, #64");
                $this->emitHelper("    svc     #0");
                $this->emitHelper("    ldp     x29, x30, [sp], #16");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;

            // ──────────────────────────────────────────────────
            // __print_space
            // ──────────────────────────────────────────────────
            case "__print_space":
                $this->emitHelper("// ── Helper: __print_space ────────────────────────");
                $this->emitHelperData("__space: .ascii \" \"");
                $this->emitHelperLabel("__print_space");
                $this->emitHelper("    stp     x29, x30, [sp, #-16]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    adrp    x1, __space");
                $this->emitHelper("    add     x1, x1, :lo12:__space");
                $this->emitHelper("    mov     x0, #1             // stdout");
                $this->emitHelper("    mov     x2, #1             // len");
                $this->emitHelper("    mov     x8, #64            // syscall write");
                $this->emitHelper("    svc     #0");
                $this->emitHelper("    ldp     x29, x30, [sp], #16");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;

            // AGREGAR antes del cierre del switch en requireHelper() (antes de línea 1925):
            case "__strlen":
                $this->emitHelper("// ── Helper: __strlen ────────────────────────────");
                $this->emitHelperLabel("__strlen");
                $this->emitHelper("    stp     x29, x30, [sp, #-16]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    mov     x1, x0");
                $this->emitHelperLabel("__strlen_loop");
                $this->emitHelper("    ldrb    w2, [x1]");
                $this->emitHelper("    cbz     w2, __strlen_done");
                $this->emitHelper("    add     x1, x1, #1");
                $this->emitHelper("    b       __strlen_loop");
                $this->emitHelperLabel("__strlen_done");
                $this->emitHelper("    sub     x0, x1, x0");
                $this->emitHelper("    ldp     x29, x30, [sp], #16");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;

            case "__memcpy":
                $this->emitHelper("// ── Helper: __memcpy ────────────────────────────");
                $this->emitHelperLabel("__memcpy");
                $this->emitHelper("    stp     x29, x30, [sp, #-16]!");
                $this->emitHelper("    mov     x29, sp");
                $this->emitHelper("    cbz     x2, __memcpy_done");
                $this->emitHelperLabel("__memcpy_loop");
                $this->emitHelper("    ldrb    w3, [x1], #1");
                $this->emitHelper("    strb    w3, [x0], #1");
                $this->emitHelper("    subs    x2, x2, #1");
                $this->emitHelper("    b.ne    __memcpy_loop");
                $this->emitHelperLabel("__memcpy_done");
                $this->emitHelper("    ldp     x29, x30, [sp], #16");
                $this->emitHelper("    ret");
                $this->emitHelper("");
                break;
        }
    }

    /*
    ========================
    len(s) / len(arr)
    Retorna longitud en registro
    ========================
    */
    private function emitLen($ctx): string
    {
        $destReg = $this->nextReg();
        $exprs   = $ctx->expression();
        $expr    = $exprs[0];
        $text    = $expr->getText();

        // ── String literal: longitud conocida en compilación ──
        if (strlen($text) >= 2 && $text[0] === '"') {
            $str = substr($text, 1, -1);
            $len = strlen($str);
            $this->emit("    mov     {$destReg}, #{$len}   // len(\"{$str}\")");
            return $destReg;
        }

        // ── Variable ──────────────────────────────────────────
        $varName = trim($text);
        if (isset($this->localVars[$varName])) {
            $offset  = $this->localVars[$varName];
            $ptrReg  = $this->nextReg();

            // Cargar el valor de la variable
            $this->emit("    ldr     {$ptrReg}, [x29, #{$offset}]   // load {$varName} for len");

            // Si es un string (puntero a .data) → usar __strlen
            // Si es un array → el tamaño debería estar almacenado
            // Por simplicidad usamos __strlen para ambos casos
            $this->requireHelper("__strlen");
            $this->emit("    mov     x0, {$ptrReg}");
            $this->emit("    bl      __strlen");
            $this->emit("    mov     {$destReg}, x0   // len result");
            return $destReg;
        }

        // Fallback: evaluar la expresión y usar __strlen
        $reg = $this->visit($expr);
        $this->requireHelper("__strlen");
        $this->emit("    mov     x0, {$reg}");
        $this->emit("    bl      __strlen");
        $this->emit("    mov     {$destReg}, x0");

        return $destReg;
    }

    /*
    ========================
    now()
    Retorna dirección de string
    con fecha hardcodeada
    (en compilador académico
    la fecha se fija al compilar)
    ========================
    */
    private function emitNow($ctx): string
    {
        // Generar la fecha actual al momento de compilar
        date_default_timezone_set("America/Guatemala");
        $dateStr  = date("Y-m-d H:i:s");
        $label    = $this->addString($dateStr);
        $destReg  = $this->nextReg();

        $this->emit("    // now() → \"{$dateStr}\"");
        $this->emit("    adrp    {$destReg}, {$label}");
        $this->emit("    add     {$destReg}, {$destReg}, :lo12:{$label}");

        return $destReg;
    }

    /*
    ========================
    substr(s, start, length)
    Retorna puntero a subcadena
    en un buffer en stack
    ========================
    */
    private function emitSubstr($ctx): string
    {
        $exprs   = $ctx->expression();
        $destReg = $this->nextReg();

        if (count($exprs) !== 3) {
            \ErrorTable::add(
                "Semantico",
                "substr() requiere exactamente 3 argumentos.",
                $ctx->getStart()->getLine(),
                $ctx->getStart()->getCharPositionInLine()
            );
            $this->emit("    mov     {$destReg}, xzr");
            return $destReg;
        }

        $strReg    = $this->visit($exprs[0]);   // dirección del string
        $startReg  = $this->visit($exprs[1]);   // índice inicial
        $lengthReg = $this->visit($exprs[2]);   // longitud deseada

        $this->emit("    // substr(str, start, length)");

        // Calcular puntero al inicio de la subcadena: str + start
        $ptrReg = $this->nextReg();
        $this->emit("    add     {$ptrReg}, {$strReg}, {$startReg}   // ptr = str + start");

        // Reservar buffer en stack para la subcadena + null terminator
        // Usamos length + 1 bytes, alineado a 16
        $bufReg = $this->nextReg();
        $this->emit("    sub     sp, sp, #64             // buffer para substr");
        $this->emit("    mov     {$bufReg}, sp            // destino");

        // Copiar 'length' bytes del origen al destino
        $this->requireHelper("__memcpy");
        $this->emit("    mov     x0, {$bufReg}            // destino");
        $this->emit("    mov     x1, {$ptrReg}            // origen = str + start");
        $this->emit("    mov     x2, {$lengthReg}         // bytes a copiar");
        $this->emit("    bl      __memcpy");

        // Agregar null terminator
        $this->emit("    add     x9, {$bufReg}, {$lengthReg}");
        $this->emit("    strb    wzr, [x9]               // null terminator");

        $this->emit("    mov     {$destReg}, {$bufReg}    // retornar ptr subcadena");

        return $destReg;
    }

    /*
    ========================
    typeOf(expr)
    Retorna dirección a string
    con nombre del tipo
    ========================
    */
    private function emitTypeOf($ctx): string
    {
        $exprs   = $ctx->expression();
        $expr    = $exprs[0];
        $text    = $expr->getText();
        $destReg = $this->nextReg();

        // Inferir tipo del literal directamente
        if (preg_match('/^-?\d+$/', $text)) {
            $label = $this->addString("int32");
        } elseif (preg_match('/^-?\d+\.\d+$/', $text)) {
            $label = $this->addString("float32");
        } elseif ($text === "true" || $text === "false") {
            $label = $this->addString("bool");
        } elseif (strlen($text) >= 3 && $text[0] === "'") {
            $label = $this->addString("rune");
        } elseif (strlen($text) >= 2 && $text[0] === '"') {
            $label = $this->addString("string");
        } else {
            // Variable: intentar inferir desde el nombre
            // En un compilador real requeriría tabla de tipos
            // Por ahora emitimos el tipo como "int32" por defecto
            $label = $this->addString("int32");
        }

        $this->emit("    // typeOf({$text})");
        $this->emit("    adrp    {$destReg}, {$label}");
        $this->emit("    add     {$destReg}, {$destReg}, :lo12:{$label}");

        return $destReg;
    }

    /*
    ========================
    FLUSH HELPERS
    Vuelca todos los helpers
    acumulados al final del
    buffer de código
    ========================
    */
    private function flushHelpers(): void
    {
        if ($this->helperCode !== "") {
            $this->code .= "\n" . $this->helperCode;
            $this->helperCode = "";
        }
    }

    /*
    ========================
    getCode() — VERSIÓN FINAL
    Reemplaza el de Parte 1
    Orden: .data → .text →
    código usuario → helpers
    ========================
    */
    public function getCode(): string
    {
        $out = "// ================================================\n";
        $out .= "// Generado por Golampi Compiler\n";
        $out .= "// Universidad San Carlos de Guatemala\n";
        $out .= "// Arquitectura: ARM64 (AArch64)\n";
        $out .= "// ================================================\n\n";

        // Sección .data (strings y constantes)
        if ($this->dataSection !== "") {
            $out .= ".section .data\n";
            $out .= ".align 3\n";
            $out .= $this->dataSection;
            $out .= "\n";
        }

        // Sección .text (código ejecutable)
        $out .= ".section .text\n";
        $out .= ".align 2\n";
        $out .= ".global _start\n\n";

        // Código de usuario (_start + funciones)
        $out .= $this->code;

        return $out;
    }

    /*
    ========================
    HELPER: emitHelper
    Versión correcta de emit
    para usar dentro de
    requireHelper()
    ========================
    */
    private function emitHelper(string $line): void
    {
        $this->helperCode .= $line . "\n";
    }

    private function emitHelperLabel(string $label): void
    {
        $this->helperCode .= $label . ":\n";
    }

    private function emitHelperData(string $line): void
    {
        // Los datos de helpers también van a .data
        $this->dataSection .= $line . "\n";
    }


    /*
    ========================
    MANEJO DE ARRAYS
    Acceso multidimensional
    a[i][j]
    ========================
    */
    private function emitArrayAccess(string $arrName, array $indices): string
    {
        if (!isset($this->localVars[$arrName])) {
            \ErrorTable::add("Semantico", "Array '$arrName' no declarado.", 0, 0);
            $r = $this->nextReg();
            $this->emit("    mov     {$r}, #0");
            return $r;
        }

        $offset  = $this->localVars[$arrName];
        $baseReg = $this->nextReg();

        // Cargar dirección base del array
        $this->emit("    add     {$baseReg}, x29, #{$offset}   // base {$arrName}");

        foreach ($indices as $idxReg) {
            $addrReg = $this->nextReg();
            $this->emit("    add     {$addrReg}, {$baseReg}, {$idxReg}, lsl #3");
            $baseReg = $addrReg;
        }

        $destReg = $this->nextReg();
        $this->emit("    ldr     {$destReg}, [{$baseReg}]   // load array elem");

        return $destReg;
    }

    /*
    ========================
    HELPER FINAL: formatear
    valor para SymbolTable
    ========================
    */
    private function formatValueForSymbol($value): string
    {
        if ($value === null)   return "—";
        if (is_bool($value))  return $value ? "true" : "false";
        if (is_array($value)) return "{...}";
        return (string)$value;
    }

    /*
    ========================
    HELPER: alinear frame
    a múltiplo de 16
    (requerimiento ARM64)
    ========================
    */
    private function alignTo16(int $size): int
    {
        return ($size + 15) & ~15;
    }

    /*
    ========================
    HELPER: calcular frame
    size real de una función
    contando todas sus vars
    ========================
    */
    private function calcFrameSize(int $varCount): int
    {
        // 16 bytes fijos para x29/x30
        // + 8 bytes por cada variable local/parámetro
        // + margen de 16 bytes para registros temporales
        $raw = 16 + ($varCount * 8) + 16;
        return $this->alignTo16($raw);
    }
}