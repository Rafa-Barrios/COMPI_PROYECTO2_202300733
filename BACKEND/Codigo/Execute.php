<?php

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../ANTLR/GolampiLexer.php';
require_once __DIR__ . '/../ANTLR/GolampiParser.php';
require_once __DIR__ . '/../ANTLR/GolampiVisitor.php';
require_once __DIR__ . '/../ANTLR/GolampiBaseVisitor.php';

// P2: CodeGenerator en lugar de Interpreter
require_once __DIR__ . '/../Visitor/CodeGenerator.php';

require_once __DIR__ . '/../Tablas/ErrorTable.php';
require_once __DIR__ . '/../Tablas/ErrorListener.php';
require_once __DIR__ . '/../Tablas/SymbolTable.php';

// P2: Runtime para ensamblar, enlazar y ejecutar
require_once __DIR__ . '/Runtime.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Visitor\CodeGenerator;

ErrorTable::clear();
SymbolTable::clear();

//////////////////////////////
// COMPILACION NORMAL
//////////////////////////////

header("Content-Type: application/json");

$code = $_POST["code"] ?? "";

// ── 1. LEX + PARSE ──────────────────────────────────────
$input  = InputStream::fromString($code);

$lexer  = new GolampiLexer($input);
$lexer->removeErrorListeners();
$lexer->addErrorListener(new ErrorListener());

$tokens = new CommonTokenStream($lexer);

$parser = new GolampiParser($tokens);
$parser->removeErrorListeners();
$parser->addErrorListener(new ErrorListener());

$tree = $parser->program();

// Si ya hay errores léxicos/sintácticos graves no generamos código
// pero igual devolvemos el JSON para mostrar los errores en la GUI
if (ErrorTable::hasErrors()) {
    echo json_encode([
        "asm"     => "",
        "output"  => "",
        "errors"  => ErrorTable::getErrors(),
        "symbols" => SymbolTable::getSymbols()
    ]);
    exit;
}

// ── 2. GENERACION DE CODIGO ARM64 ───────────────────────
$generator = new CodeGenerator();

try {

    $generator->visit($tree);

} catch (\Throwable $e) {

    $msg = $e->getMessage();

    if ($msg === null || $msg === "") {
        $msg = "Error en generacion de codigo";
    }

    ErrorTable::add("Semantico", $msg, 0, 0);
}

// Obtener el codigo ARM64 generado
$asmCode = $generator->getCode();

// ── 3. ENSAMBLAR, ENLAZAR Y EJECUTAR CON QEMU ───────────
$programOutput = "";

if ($asmCode !== "" && !ErrorTable::hasErrors()) {
    $programOutput = Runtime::run($asmCode);
} elseif ($asmCode !== "") {
    // Hay errores semánticos pero igual guardamos el .s
    // para que el usuario pueda descargarlo e inspeccionarlo
    Runtime::saveAsm($asmCode);
}

// ── 4. RESPUESTA JSON ────────────────────────────────────
echo json_encode([
    "asm"     => $asmCode,
    "output"  => $programOutput,
    "errors"  => ErrorTable::getErrors(),
    "symbols" => SymbolTable::getSymbols()
]);