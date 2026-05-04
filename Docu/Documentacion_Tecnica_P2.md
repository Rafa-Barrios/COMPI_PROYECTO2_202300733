# Documentación Técnica — Golampi Compiler

> **Curso:** Organización de Lenguajes y Compiladores 2  
> **Universidad:** San Carlos de Guatemala — Facultad de Ingeniería  
> **Estudiante:** Angel Rafael Barrios González — 202300733  
> **Tecnologías:** PHP · ANTLRv4 · HTML/CSS/JavaScript · ARM64 Assembly  
> **Proyecto:** 2 — Compilador con generación de código ARM64

---

## Índice

1. [Descripción General](#1-descripción-general)
2. [Arquitectura del Sistema](#2-arquitectura-del-sistema)
3. [Gramática Formal de Golampi](#3-gramática-formal-de-golampi)
4. [Diagrama de Clases](#4-diagrama-de-clases)
5. [Flujo de Compilación](#5-flujo-de-compilación)
6. [Generación de Código ARM64](#6-generación-de-código-arm64)
7. [Runtime — Ensamblaje y Ejecución](#7-runtime--ensamblaje-y-ejecución)
8. [Sistema de Reportes de Errores](#8-sistema-de-reportes-de-errores)
9. [Estructura de Carpetas](#9-estructura-de-carpetas)

---

## 1. Descripción General

Golampi Compiler es la evolución del intérprete Golampi del Proyecto 1. En lugar de interpretar el AST directamente, este proyecto **compila** el código fuente Golampi a código ensamblador ARM64 (AArch64), el cual es ensamblado, enlazado y ejecutado mediante herramientas GNU cross-compilation y QEMU.

**Características principales:**

- Tipos estáticos: `int32`, `float32`, `bool`, `rune`, `string`
- Variables, constantes, arreglos multidimensionales
- Estructuras de control: `if/else`, `for`, `switch`
- Funciones con parámetros por valor y por referencia (punteros)
- Funciones recursivas y con múltiple retorno
- Hoisting de funciones
- Generación de código ensamblador ARM64 válido
- Comentarios `#` (línea) y `/* */` (multilínea) en el ensamblador generado
- Ensamblaje con `aarch64-linux-gnu-as`
- Enlazado con `aarch64-linux-gnu-ld`
- Ejecución con `qemu-aarch64`
- Descarga del archivo `.s` generado

---

## 2. Arquitectura del Sistema

```
┌──────────────────────────────────────────────────────────────┐
│                    NAVEGADOR (Cliente)                        │
│                                                              │
│   ┌─────────────┐    HTTP POST     ┌──────────────────────┐  │
│   │  index.html │ ──────────────►  │    Execute.php       │  │
│   │  (Editor +  │ ◄──────────────  │    (Backend)         │  │
│   │   ARM64)    │   JSON Response  └──────────┬───────────┘  │
│   └─────────────┘                             │              │
└───────────────────────────────────────────────┼──────────────┘
                                                │
                            ┌───────────────────▼──────────────────┐
                            │              BACKEND PHP              │
                            │                                      │
                            │  GolampiLexer  (ANTLR)               │
                            │       ↓                              │
                            │  GolampiParser (ANTLR)               │
                            │       ↓                              │
                            │  AST (Árbol Sintáctico)              │
                            │       ↓                              │
                            │  CodeGenerator (Visitor)             │
                            │       ↓                              │
                            │  Código ARM64 (.s)                   │
                            │       ↓                              │
                            │  Runtime::run()                      │
                            │    ├─ aarch64-linux-gnu-as           │
                            │    ├─ aarch64-linux-gnu-ld           │
                            │    └─ qemu-aarch64                   │
                            │       ↓                              │
                            │  ErrorTable + SymbolTable            │
                            └──────────────────────────────────────┘
```

---

## 3. Gramática Formal de Golampi

La gramática está definida en `Golampi.g4` y es procesada por ANTLRv4. Es la misma gramática del Proyecto 1, reutilizada sin modificaciones.

### 3.1 Programa

```antlr
program
    : declaration* EOF
    ;

declaration
    : varDecl
    | constDecl
    | functionDecl
    | statement
    ;
```

### 3.2 Declaraciones

```antlr
varDecl
    : 'var' idList type ('=' (exprList | arrayLiteral))?
    ;

constDecl
    : 'const' ID type '=' expression
    ;

shortVarDecl
    : idList ':=' exprList
    ;
```

### 3.3 Funciones

```antlr
functionDecl
    : 'func' ID '(' parameters? ')' returnType? block
    ;

parameter
    : ID pointer? type
    ;

pointer : '*' ;

returnType
    : type
    | '(' typeList ')'
    ;
```

### 3.4 Tipos

```antlr
type
    : primitiveType
    | arrayType
    ;

primitiveType
    : 'int32' | 'float32' | 'bool' | 'rune' | 'string'
    ;

arrayType
    : '[' expression ']' type
    ;
```

### 3.5 Sentencias y Control de Flujo

```antlr
statement
    : block | varDecl | constDecl | shortVarDecl | assignment
    | ifStmt | switchStmt | forStmt
    | breakStmt | continueStmt | returnStmt | exprStmt
    ;

ifStmt
    : 'if' expression block ('else' (ifStmt | block))?
    ;

switchStmt
    : 'switch' expression '{' caseClause* defaultClause? '}'
    ;

forStmt
    : 'for' forClause block
    | 'for' expression block
    | 'for' block
    ;
```

### 3.6 Expresiones

```antlr
expression   : logicalOr ;
logicalOr    : logicalAnd ('||' logicalAnd)* ;
logicalAnd   : equality ('&&' equality)* ;
equality     : relational (('==' | '!=') relational)* ;
relational   : additive (('>' | '>=' | '<' | '<=') additive)* ;
additive     : multiplicative (('+' | '-') multiplicative)* ;
multiplicative : unary (('*' | '/' | '%') unary)* ;

unary
    : ('!' | '-' | '&' | '*') unary
    | postfix
    ;

postfix
    : primary (index | call | incrementOp)*
    ;
```

### 3.7 Array Literal

```antlr
arrayLiteral
    : '[' expression ']' type '{' arrayElements? '}'
    ;

arrayElements
    : arrayElement (',' arrayElement)* ','?
    ;

arrayElement
    : expression
    | '{' exprList? '}'
    ;
```

### 3.8 Funciones Embebidas

```antlr
builtinCall
    : 'fmt' '.' 'Println' '(' exprList? ')'
    | 'len' '(' expression ')'
    | 'now' '(' ')'
    | 'substr' '(' expression ',' expression ',' expression ')'
    | 'typeOf' '(' expression ')'
    ;
```

---

## 4. Diagrama de Clases

```
┌─────────────────────────────────────────────────────────────────────┐
│                         BACKEND/Visitor                             │
│                                                                     │
│  ┌─────────────────────────────────────────────────────────────┐   │
│  │                   CodeGenerator                             │   │
│  │─────────────────────────────────────────────────────────────│   │
│  │ - code: string          // código ARM64 acumulado           │   │
│  │ - dataSection: string   // sección .data                    │   │
│  │ - helperCode: string    // helpers emitidos al final        │   │
│  │ - labelCounter: int     // contador de etiquetas            │   │
│  │ - strCounter: int       // contador de strings              │   │
│  │ - environment: Env      // scopes de variables              │   │
│  │ - stackOffset: int      // offset actual en el stack        │   │
│  │ - frameSize: int        // tamaño del frame de la función   │   │
│  │ - localVars: array      // nombre → offset en stack         │   │
│  │ - varTypes: array       // nombre → tipo                    │   │
│  │ - strLengths: array     // label → longitud del string      │   │
│  │ - functions: array      // hoisting de funciones            │   │
│  │ - tempReg: int          // cicla x9..x15                    │   │
│  │─────────────────────────────────────────────────────────────│   │
│  │ + visit($tree)                                              │   │
│  │ + visitProgram($ctx)    // hoisting + _start + flushHelpers │   │
│  │ + visitFunctionDecl()   // prólogo/epílogo ARM64            │   │
│  │ + visitVarDecl()        // larga: con/sin valor             │   │
│  │ + visitShortVarDecl()   // corta: :=                        │   │
│  │ + visitConstDecl()                                          │   │
│  │ + visitAssignment()     // =, +=, -=, *=, /=               │   │
│  │ + visitIfStmt()                                             │   │
│  │ + visitSwitchStmt()                                         │   │
│  │ + visitForStmt()        // 3 formas                         │   │
│  │ + visitReturnStmt()     // simple y múltiple                │   │
│  │ + visitLogicalOr/And()  // cortocircuito                    │   │
│  │ + visitRelational()     // con save/reload                  │   │
│  │ + visitAdditive()                                           │   │
│  │ + visitMultiplicative() // con save/reload para recursión   │   │
│  │ + visitUnary()          // !, -, &, *                       │   │
│  │ + visitPostfix()        // call, index, ++/--               │   │
│  │ + visitPrimary()        // literal, ID, builtin, array      │   │
│  │ + visitArrayLiteral()   // arrays 1D y 2D                   │   │
│  │ + emitPrintln()         // fmt.Println con tipo dinámico    │   │
│  │ + emitLen()             // len() para strings y arrays      │   │
│  │ + emitNow()             // now() → syscall fecha            │   │
│  │ + emitSubstr()          // substr()                         │   │
│  │ + emitTypeOf()          // typeOf()                         │   │
│  │ + requireHelper()       // helpers ARM64 bajo demanda       │   │
│  │ + flushHelpers()        // vuelca helperCode al final       │   │
│  │ + getCode()             // ensambla .data + .text + helpers │   │
│  │ + detectTypeHint()      // infiere tipo para impresión      │   │
│  │ + inferTypeFromExpr()   // infiere tipo de una expresión    │   │
│  └─────────────────────────────────────────────────────────────┘   │
│                                                                     │
│  ┌──────────────┐  ┌────────────────┐  ┌────────────────────────┐  │
│  │ Environment  │  │  UserFunction  │  │     FlowTypes          │  │
│  │──────────────│  │────────────────│  │────────────────────────│  │
│  │ scopes[]     │  │ declaration    │  │ BreakSignal            │  │
│  │ define()     │  │ closure: Env   │  │ ContinueSignal         │  │
│  │ get()        │  │ arity()        │  │ ReturnSignal           │  │
│  │ assign()     │  │ invoke()       │  └────────────────────────┘  │
│  └──────────────┘  └────────────────┘                              │
└─────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────┐
│                         BACKEND/Codigo                              │
│                                                                     │
│  ┌─────────────────────────────────────────────────────────────┐   │
│  │                       Runtime                               │   │
│  │─────────────────────────────────────────────────────────────│   │
│  │ - outputDir: string   // BACKEND/output/                    │   │
│  │ - asmFile:   string   // output/program.s                   │   │
│  │ - objFile:   string   // output/program.o                   │   │
│  │ - binFile:   string   // output/program                     │   │
│  │─────────────────────────────────────────────────────────────│   │
│  │ + saveAsm($code)      // guarda el .s en disco              │   │
│  │ + assemble()          // aarch64-linux-gnu-as               │   │
│  │ + link()              // aarch64-linux-gnu-ld               │   │
│  │ + execute()           // qemu-aarch64                       │   │
│  │ + run($asmCode)       // pipeline completo                  │   │
│  │ + getAsmContent()     // lee el .s para descarga            │   │
│  │ + clean()             // elimina .o y binario               │   │
│  └─────────────────────────────────────────────────────────────┘   │
│                                                                     │
│  ┌─────────────────────────────────────────────────────────────┐   │
│  │                      Execute.php                            │   │
│  │─────────────────────────────────────────────────────────────│   │
│  │ 1. Lex + Parse (ANTLRv4)                                    │   │
│  │ 2. CodeGenerator->visit($tree)                              │   │
│  │ 3. Runtime::run($asmCode)                                   │   │
│  │ 4. json_encode({asm, output, errors, symbols})              │   │
│  └─────────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────┐
│                         BACKEND/Tablas                              │
│                                                                     │
│  ┌───────────────┐  ┌───────────────┐  ┌─────────────────────┐     │
│  │  ErrorEntry   │  │  ErrorTable   │  │    ErrorListener    │     │
│  │───────────────│  │───────────────│  │─────────────────────│     │
│  │ + id          │  │ - errors[]    │  │ syntaxError()       │     │
│  │ + type        │  │ - counter     │  │ Léxico vs Sintáctico│     │
│  │ + description │  │ + add()       │  └─────────────────────┘     │
│  │ + line        │  │ + getErrors() │                              │
│  │ + column      │  │ + hasErrors() │  ┌─────────────────────┐     │
│  └───────────────┘  │ + clear()     │  │    SymbolTable      │     │
│                     └───────────────┘  │ + add()             │     │
│                                        │ + getSymbols()      │     │
│                                        │ + clear()           │     │
│                                        └─────────────────────┘     │
└─────────────────────────────────────────────────────────────────────┘
```

---

## 5. Flujo de Compilación

```
  Código fuente Golampi (string)
         │
         ▼
┌─────────────────────┐
│   InputStream       │  ← InputStream::fromString($code)
└────────┬────────────┘
         │
         ▼
┌─────────────────────┐
│   GolampiLexer      │  ← Tokenización
│   + ErrorListener   │  ← Captura errores LÉXICOS
└────────┬────────────┘
         │ CommonTokenStream
         ▼
┌─────────────────────┐
│   GolampiParser     │  ← Análisis sintáctico
│   + ErrorListener   │  ← Captura errores SINTÁCTICOS
└────────┬────────────┘
         │ AST (Parse Tree)
         ▼
┌─────────────────────┐
│   CodeGenerator     │  ← Recorre el AST con patrón Visitor
│   visitProgram()    │
│       │             │
│   Fase 1: Hoisting  │  ← Registra funciones antes de generar código
│       │             │
│   Fase 2: Generar   │  ← Emite instrucciones ARM64
│       │             │
│   Fase 3: getCode() │  ← Ensambla .data + .text + helpers
└────────┬────────────┘
         │ Código ARM64 (string)
         ▼
┌─────────────────────┐
│   Runtime::run()    │
│   ├─ saveAsm()      │  ← Guarda program.s
│   ├─ assemble()     │  ← aarch64-linux-gnu-as → program.o
│   ├─ link()         │  ← aarch64-linux-gnu-ld → program
│   └─ execute()      │  ← qemu-aarch64 → output
└────────┬────────────┘
         │ JSON Response
         ▼
┌─────────────────────┐
│   index.html        │  ← Muestra ARM64 en consola azul
│   (Frontend JS)     │  ← Botones: Descargar ARM64, Errores, Símbolos
└─────────────────────┘
```

---

## 6. Generación de Código ARM64

### 6.1 Convención de registros utilizada

| Registro | Uso |
|---|---|
| `x0–x7` | Parámetros de función y valor de retorno |
| `x9–x15` | Registros temporales (caller-saved, ciclan) |
| `x29` | Frame pointer (FP) |
| `x30` | Link register (LR, dirección de retorno) |
| `sp` | Stack pointer |
| `xzr` | Registro cero — inicialización de variables |

### 6.2 Modelo de stack frame

Cada función genera el siguiente prólogo y epílogo:

```asm
# Prólogo
stp     x29, x30, [sp, #-16]!   // salvar fp y lr
mov     x29, sp
sub     sp, sp, #496             // espacio variables locales

# Epílogo
add     sp, sp, #496             // liberar variables locales
ldp     x29, x30, [sp], #16     // restaurar fp y lr
ret
```

Las variables locales se almacenan en `[sp, #offset]` con offsets positivos crecientes (0, 8, 16...).

### 6.3 Sistema de tipos en memoria

| Tipo Golampi | Representación ARM64 |
|---|---|
| `int32` | Entero 64-bit en registro `xN` |
| `bool` | 0 (false) o 1 (true) en registro `xN` |
| `rune` | Valor ASCII como entero 64-bit |
| `string` | Puntero a `.asciz` en sección `.data` |
| `float32` | Puntero a string de texto (representación) |
| Array 1D | Puntero a datos contiguos en stack |
| Array 2D | Puntero a array de punteros de fila |

### 6.4 Helpers generados bajo demanda

| Helper | Función |
|---|---|
| `__print_int` | Convierte entero a ASCII y lo imprime (syscall write) |
| `__print_str` | Imprime string con longitud (syscall write) |
| `__print_bool` | Imprime "true" o "false" |
| `__print_newline` | Imprime salto de línea |
| `__print_space` | Imprime espacio entre argumentos |
| `__strlen` | Calcula longitud de string null-terminated |
| `__memcpy` | Copia bytes entre direcciones |

Los helpers se acumulan en `$helperCode` y se vuelcan al final del código generado mediante `flushHelpers()`, evitando que el CPU los ejecute secuencialmente.

### 6.5 Syscalls utilizadas (Linux AArch64)

| Número | Nombre | Uso |
|---|---|---|
| `#64` | `write` | Imprimir en stdout |
| `#93` | `exit` | Terminar el programa |

### 6.6 Comentarios en el ensamblador

Según el enunciado del curso:
- `#` — comentarios de línea al inicio (comentarios standalone)
- `/* */` — comentarios multilínea (header del archivo)
- `//` — comentarios inline después de instrucciones (compatibles con GAS AArch64)

---

## 7. Runtime — Ensamblaje y Ejecución

La clase `Runtime` encapsula el pipeline completo de compilación nativa:

```
Runtime::run($asmCode)
    │
    ├─ saveAsm()     → BACKEND/output/program.s
    │
    ├─ assemble()    → aarch64-linux-gnu-as program.s -o program.o
    │                  (Si falla → ErrorTable::add "Ensamblaje")
    │
    ├─ link()        → aarch64-linux-gnu-ld program.o -o program
    │                  (Si falla → ErrorTable::add "Enlace")
    │
    └─ execute()     → qemu-aarch64 program
                       (Retorna stdout del programa)
```

**Herramientas requeridas en el servidor:**

| Herramienta | Versión | Función |
|---|---|---|
| `aarch64-linux-gnu-as` | 2.42 | Ensamblador GNU para AArch64 |
| `aarch64-linux-gnu-ld` | 2.42 | Enlazador GNU para AArch64 |
| `qemu-aarch64` | 8.2.2 | Emulador ARM64 en modo usuario |

---

## 8. Sistema de Reportes de Errores

### Tipos de errores detectados

| Fase | Origen | Ejemplo |
|---|---|---|
| Léxico | GolampiLexer | Carácter no reconocido |
| Sintáctico | GolampiParser | Token inesperado, construcción incompleta |
| Semántico | CodeGenerator | Variable no declarada |
| Ensamblaje | aarch64-linux-gnu-as | Instrucción ARM64 inválida |
| Enlace | aarch64-linux-gnu-ld | Símbolo no definido |

### Detección Léxico vs Sintáctico

```php
$type = ($recognizer instanceof Lexer) ? "Lexico" : "Sintactico";
ErrorTable::add($type, $msg, $line, $charPositionInLine);
```

### Errores semánticos detectados

- `Identificador '$name' no declarado.`
- `Variable '$name' no declarada.`
- `La funcion main no puede invocarse explicitamente.`
- `Short declaration requiere al menos una variable nueva.`

---

## 9. Estructura de Carpetas

```
COMPI_PROYECTO2_202300733/
│
├── BACKEND/
│   ├── ANTLR/                    ← Archivos generados por ANTLRv4
│   │   ├── GolampiLexer.php
│   │   ├── GolampiParser.php
│   │   ├── GolampiBaseVisitor.php
│   │   └── GolampiVisitor.php
│   │
│   ├── Codigo/
│   │   ├── Execute.php           ← Controlador HTTP: lex→parse→compile→run
│   │   └── Runtime.php           ← Pipeline: as → ld → qemu
│   │
│   ├── Gramatica/
│   │   └── Golampi.g4            ← Gramática ANTLRv4 (reutilizada del P1)
│   │
│   ├── Tablas/
│   │   ├── ErrorTable.php        ← Tabla centralizada de errores
│   │   ├── ErrorListener.php     ← Listener ANTLR para errores
│   │   └── SymbolTable.php       ← Tabla centralizada de símbolos
│   │
│   ├── Visitor/
│   │   ├── CodeGenerator.php     ← Generador de código ARM64 (núcleo)
│   │   ├── Environment.php       ← Manejo de scopes
│   │   ├── FlowTypes.php         ← Señales de control de flujo
│   │   ├── Invocable.php         ← Interface para funciones
│   │   ├── Pointer.php           ← Punteros
│   │   └── UserFunction.php      ← Funciones de usuario
│   │
│   ├── output/                   ← Archivos generados en tiempo de ejecución
│   │   ├── program.s             ← Código ARM64 generado
│   │   ├── program.o             ← Objeto ensamblado
│   │   └── program               ← Ejecutable ARM64
│   │
│   └── Index.php                 ← Entry point HTTP (POST → Execute.php)
│
├── FRONTEND/
│   └── index.html                ← Interfaz web (Editor + ARM64 + Reportes)
│
├── vendor/                       ← Dependencias Composer (ANTLR4 PHP runtime)
├── composer.json
└── composer.lock
```
