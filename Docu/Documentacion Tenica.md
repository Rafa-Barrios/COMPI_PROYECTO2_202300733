# Documentación Técnica — Golampi Interpreter

> **Curso:** Organización de Lenguajes y Compiladores 2  
> **Universidad:** San Carlos de Guatemala — Facultad de Ingeniería 
> **Estudiante:** Angel Rafael Barrios González-20230733
> **Tecnologías:** PHP · ANTLRv4 · HTML/CSS/JavaScript

---

## Índice

1. [Descripción General](#1-descripción-general)
2. [Arquitectura del Sistema](#2-arquitectura-del-sistema)
3. [Gramática Formal de Golampi](#3-gramática-formal-de-golampi)
4. [Diagrama de Clases](#4-diagrama-de-clases)
5. [Flujo de Procesamiento](#5-flujo-de-procesamiento)
6. [Tabla de Símbolos — Flujo Detallado](#6-tabla-de-símbolos--flujo-detallado)
7. [Sistema de Reportes de Errores](#7-sistema-de-reportes-de-errores)
8. [Estructura de Carpetas](#8-estructura-de-carpetas)

---

## 1. Descripción General

Golampi es un lenguaje de programación académico inspirado en la sintaxis de Go (Golang), interpretado mediante un backend en PHP que utiliza ANTLRv4 para el análisis léxico y sintáctico. La aplicación expone una interfaz web donde el usuario puede escribir, ejecutar y analizar programas escritos en Golampi, obteniendo la salida en consola y descargando reportes de errores y tabla de símbolos.

**Características principales:**

- Tipos estáticos: `int32`, `float32`, `bool`, `rune`, `string`
- Variables, constantes, arreglos multidimensionales
- Estructuras de control: `if/else`, `for`, `switch`
- Funciones con parámetros por valor y por referencia (punteros)
- Funciones recursivas y con múltiple retorno
- Hoisting de funciones
- Función `main` como punto de entrada obligatorio
- Reporte de errores léxicos, sintácticos y semánticos
- Tabla de símbolos con ámbito, tipo y valor

---

## 2. Arquitectura del Sistema

```
┌─────────────────────────────────────────────────────────┐
│                    NAVEGADOR (Cliente)                   │
│                                                         │
│   ┌─────────────┐    HTTP POST     ┌─────────────────┐  │
│   │  index.html │ ──────────────►  │   Execute.php   │  │
│   │  (Editor +  │ ◄──────────────  │   (Backend)     │  │
│   │   Consola)  │   JSON Response  └────────┬────────┘  │
│   └─────────────┘                           │           │
└─────────────────────────────────────────────┼───────────┘
                                              │
                              ┌───────────────▼───────────────┐
                              │         BACKEND PHP            │
                              │                               │
                              │  GolampiLexer  (ANTLR)        │
                              │       ↓                       │
                              │  GolampiParser (ANTLR)        │
                              │       ↓                       │
                              │  AST (Árbol Sintáctico)       │
                              │       ↓                       │
                              │  Interpreter (Visitor)        │
                              │       ↓                       │
                              │  Environment (Scopes)         │
                              │       ↓                       │
                              │  ErrorTable + SymbolTable     │
                              └───────────────────────────────┘
```

---

## 3. Gramática Formal de Golampi

La gramática está definida en el archivo `Golampi.g4` y es procesada por ANTLRv4.

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

### 3.2 Declaraciones de Variables y Constantes

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

idList
    : ID (',' ID)*
    ;
```

### 3.3 Declaración de Funciones

```antlr
functionDecl
    : 'func' ID '(' parameters? ')' returnType? block
    ;

parameters
    : parameter (',' parameter)*
    ;

parameter
    : ID pointer? type
    ;

pointer
    : '*'
    ;

returnType
    : type
    | '(' typeList ')'
    ;

typeList
    : type (',' type)*
    ;
```

### 3.4 Tipos

```antlr
type
    : primitiveType
    | arrayType
    ;

primitiveType
    : 'int32'
    | 'float32'
    | 'bool'
    | 'rune'
    | 'string'
    ;

arrayType
    : '[' expression ']' type
    ;
```

### 3.5 Sentencias

```antlr
statement
    : block
    | varDecl
    | constDecl
    | shortVarDecl
    | assignment
    | ifStmt
    | switchStmt
    | forStmt
    | breakStmt
    | continueStmt
    | returnStmt
    | exprStmt
    ;

block
    : '{' statement* '}'
    ;

assignment
    : expression assignOp expression
    ;

assignOp
    : '=' | '+=' | '-=' | '*=' | '/='
    ;
```

### 3.6 Control de Flujo

```antlr
ifStmt
    : 'if' expression block ('else' (ifStmt | block))?
    ;

switchStmt
    : 'switch' expression '{' caseClause* defaultClause? '}'
    ;

caseClause
    : 'case' exprList ':' statement*
    ;

defaultClause
    : 'default' ':' statement*
    ;

forStmt
    : 'for' forClause block
    | 'for' expression block
    | 'for' block
    ;

forClause
    : forInit? ';' expression? ';' expression?
    ;

forInit
    : shortVarDecl
    | assignment
    ;

breakStmt    : 'break' ;
continueStmt : 'continue' ;
returnStmt   : 'return' exprList? ;
```

### 3.7 Expresiones

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

incrementOp  : '++' | '--' ;
index        : '[' expression ']' ;
call         : '(' exprList? ')' ;

primary
    : literal
    | ID
    | builtinCall
    | arrayLiteral
    | '(' expression ')'
    ;
```

### 3.8 Arreglos y Literales

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

literal
    : INT | FLOAT | STRING | RUNE
    | 'true' | 'false' | 'nil'
    ;
```

### 3.9 Funciones Embebidas

```antlr
builtinCall
    : 'fmt' '.' 'Println' '(' exprList? ')'
    | 'len' '(' expression ')'
    | 'now' '(' ')'
    | 'substr' '(' expression ',' expression ',' expression ')'
    | 'typeOf' '(' expression ')'
    ;
```

### 3.10 Tokens

```antlr
ID     : [a-zA-Z_] [a-zA-Z_0-9]* ;
INT    : [0-9]+ ;
FLOAT  : [0-9]+ '.' [0-9]+ ;
STRING : '"' (~["\\] | '\\' .)* '"' ;
RUNE   : '\'' . '\'' ;

LINE_COMMENT  : '//' ~[\r\n]* -> skip ;
BLOCK_COMMENT : '/*' .*? '*/' -> skip ;
WS            : [ \t\r\n]+ -> skip ;
```

---

## 4. Diagrama de Clases

```
┌─────────────────────────────────────────────────────────────────────┐
│                          BACKEND/ANTLR                              │
│                                                                     │
│  ┌──────────────────┐     ┌──────────────────┐                     │
│  │  GolampiLexer    │     │  GolampiParser   │                     │
│  │  (generado ANTLR)│────►│  (generado ANTLR)│                     │
│  └──────────────────┘     └────────┬─────────┘                     │
│                                    │ genera AST                    │
│  ┌─────────────────┐               │                               │
│  │ GolampiVisitor  │◄──────────────┘                               │
│  │   (interface)   │                                               │
│  └────────┬────────┘                                               │
│           │ implementa                                              │
│  ┌────────▼────────┐                                               │
│  │GolampiBaseVisitor│                                              │
│  │   (base class)  │                                               │
│  └────────┬────────┘                                               │
└───────────┼─────────────────────────────────────────────────────────┘
            │ extiende
┌───────────▼─────────────────────────────────────────────────────────┐
│                         BACKEND/Visitor                             │
│                                                                     │
│  ┌─────────────────────────────────────────────┐                   │
│  │              Interpreter                    │                   │
│  │─────────────────────────────────────────────│                   │
│  │ + output: string                            │                   │
│  │ - environment: Environment                  │                   │
│  │ - currentScope: string                      │                   │
│  │─────────────────────────────────────────────│                   │
│  │ + visitProgram()                            │                   │
│  │ + visitVarDecl()                            │                   │
│  │ + visitConstDecl()                          │                   │
│  │ + visitFunctionDecl()                       │                   │
│  │ + visitShortVarDecl()                       │                   │
│  │ + visitAssignment()                         │                   │
│  │ + visitBlock()                              │                   │
│  │ + visitIfStmt()                             │                   │
│  │ + visitForStmt()                            │                   │
│  │ + visitSwitchStmt()                         │                   │
│  │ + visitReturnStmt()                         │                   │
│  │ + visitBreakStmt()                          │                   │
│  │ + visitContinueStmt()                       │                   │
│  │ + visitPrimary()                            │                   │
│  │ + visitPostfix()                            │                   │
│  │ + visitLiteral()                            │                   │
│  │ + visitArrayLiteral()                       │                   │
│  │ + visitBuiltinCall()                        │                   │
│  │ + visitAdditive()                           │                   │
│  │ + visitMultiplicative()                     │                   │
│  │ + visitUnary()                              │                   │
│  │ + visitRelational()                         │                   │
│  │ + visitEquality()                           │                   │
│  │ + visitLogicalAnd()                         │                   │
│  │ + visitLogicalOr()                          │                   │
│  │ - add/sub/mul/div/mod()                     │                   │
│  │ - resolveType() / formatValue()             │                   │
│  │ - defaultValue()                            │                   │
│  └──────────────┬──────────────────────────────┘                   │
│                 │ usa                                               │
│  ┌──────────────▼──────────────────────────────┐                   │
│  │              Environment                    │                   │
│  │─────────────────────────────────────────────│                   │
│  │ - values: array                             │                   │
│  │ - constants: array                          │                   │
│  │ - parent: Environment                       │                   │
│  │─────────────────────────────────────────────│                   │
│  │ + define(name, value, line, col)            │                   │
│  │ + defineConst(name, value, line, col)       │                   │
│  │ + get(name, line, col)  [auto-deref ptr]    │                   │
│  │ + getRaw(name)          [sin deref]         │                   │
│  │ + assign(name, value, line, col)            │                   │
│  │ + getEnvironmentOf(name)                    │                   │
│  │ + createChild()                             │                   │
│  └─────────────────────────────────────────────┘                   │
│                                                                     │
│  ┌─────────────────┐   ┌──────────────────┐                        │
│  │   UserFunction  │   │     Pointer      │                        │
│  │─────────────────│   │──────────────────│                        │
│  │ - declaration   │   │ - env: Env       │                        │
│  │ - closure: Env  │   │ - name: string   │                        │
│  │─────────────────│   │──────────────────│                        │
│  │ + arity()       │   │ + get()          │                        │
│  │ + invoke()      │   │ + set(value)     │                        │
│  └─────────────────┘   └──────────────────┘                        │
│                                                                     │
│  ┌──────────────────────────────────────────┐                      │
│  │           FlowTypes (señales)            │                      │
│  │  BreakSignal · ContinueSignal · ReturnSignal                    │
│  └──────────────────────────────────────────┘                      │
└─────────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────────┐
│                         BACKEND/Tablas                              │
│                                                                     │
│  ┌───────────────┐  ┌───────────────┐  ┌─────────────────────┐     │
│  │  ErrorEntry   │  │  ErrorTable   │  │    ErrorListener    │     │
│  │───────────────│  │───────────────│  │─────────────────────│     │
│  │ + id          │  │ - errors[]    │  │ syntaxError()       │     │
│  │ + type        │  │ - counter     │  │ detecta Lexico vs   │     │
│  │ + description │  │───────────────│  │ Sintactico según    │     │
│  │ + line        │  │ + add()       │  │ instanceof Lexer    │     │
│  │ + column      │  │ + getErrors() │  └─────────────────────┘     │
│  └───────────────┘  │ + hasErrors() │                              │
│                     │ + clear()     │                              │
│  ┌───────────────┐  └───────────────┘                              │
│  │  SymbolEntry  │  ┌───────────────┐                              │
│  │───────────────│  │  SymbolTable  │                              │
│  │ + identifier  │  │───────────────│                              │
│  │ + type        │  │ - symbols[]   │                              │
│  │ + scope       │  │───────────────│                              │
│  │ + value       │  │ + add()       │                              │
│  │ + line        │  │ + getSymbols()│                              │
│  │ + column      │  │ + clear()     │                              │
│  └───────────────┘  └───────────────┘                              │
└─────────────────────────────────────────────────────────────────────┘
```

---

## 5. Flujo de Procesamiento

```
  Código fuente (string)
         │
         ▼
┌─────────────────────┐
│   InputStream       │  ← Antlr\Runtime\InputStream::fromString($code)
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
│   Interpreter       │  ← Recorre el AST con patrón Visitor
│   visitProgram()    │
│       │             │
│   Fase 1: Hoisting  │  ← Registra todas las funciones antes de ejecutar
│       │             │
│   Fase 2: Ejecución │  ← Ejecuta declaraciones globales
│       │             │
│   Fase 3: main()    │  ← Localiza y ejecuta func main()
└────────┬────────────┘
         │
         ├──────────────────────────────────────────────┐
         ▼                                              ▼
┌─────────────────────┐                    ┌──────────────────────┐
│   Environment       │                    │   ErrorTable         │
│   (árbol de scopes) │                    │   SymbolTable        │
│                     │                    │                      │
│  global scope       │                    │  Acumulan errores y  │
│    └─ func scope    │                    │  símbolos durante    │
│         └─ block    │                    │  toda la ejecución   │
└─────────────────────┘                    └──────────────────────┘
         │
         ▼
┌─────────────────────┐
│   Execute.php       │  ← Serializa resultado
│   json_encode([     │
│     output,         │  ← Salida de fmt.Println
│     errors,         │  ← Array de ErrorEntry
│     symbols         │  ← Array de SymbolEntry
│   ])                │
└────────┬────────────┘
         │ HTTP Response JSON
         ▼
┌─────────────────────┐
│   index.html        │  ← Muestra en consola
│   (Frontend JS)     │  ← Botones de descarga HTML
└─────────────────────┘
```

---

## 6. Tabla de Símbolos — Flujo Detallado

La tabla de símbolos se construye progresivamente durante el recorrido del AST. Cada vez que el intérprete visita una declaración, registra el símbolo con su información completa.

```
  visitVarDecl()
       │
       ├─ Evalúa expresión inicial (o defaultValue() si no hay)
       ├─ environment->define(name, value, line, col)
       └─ SymbolTable::add(name, resolveType(value), currentScope,
                           formatValue(value), line, col)

  visitConstDecl()
       │
       ├─ Evalúa expresión
       ├─ environment->defineConst(name, value, line, col)
       └─ SymbolTable::add(name, resolveType(value), currentScope,
                           formatValue(value), line, col)

  visitFunctionDecl()
       │
       ├─ Crea UserFunction con closure del scope actual
       ├─ environment->define(name, function, line, col)
       ├─ SymbolTable::add(name, "funcion", currentScope, "—", line, col)
       └─ currentScope = name (para símbolos dentro de la función)

  visitShortVarDecl()
       │
       ├─ Evalúa expresiones del lado derecho
       ├─ Si variable es nueva → environment->define() + SymbolTable::add()
       └─ Si variable existe  → environment->assign() (no agrega a tabla)
```

**Tipos registrados en la tabla:**

| Tipo PHP      | Tipo en Tabla   |
|---------------|-----------------|
| int           | entero          |
| float         | decimal         |
| bool          | booleano        |
| string (1 ch) | caracter        |
| string        | cadena          |
| array         | arreglo         |
| UserFunction  | funcion         |
| null          | desconocido     |

**Formato de valores en la tabla:**

| Valor PHP     | Formato mostrado   |
|---------------|--------------------|
| null          | —                  |
| true / false  | true / false       |
| array         | JSON (ej: [1,2,3]) |
| UserFunction  | —                  |
| otros         | (string)$value     |

---

## 7. Sistema de Reportes de Errores

Los errores se acumulan sin detener la ejecución, usando el patrón tabla centralizada.

### Tipos de errores detectados

| Fase       | Origen             | Ejemplo                                       |
|------------|--------------------|-----------------------------------------------|
| Léxico     | GolampiLexer       | Carácter `@` no pertenece al lenguaje         |
| Sintáctico | GolampiParser      | Construcción incompleta, token inesperado     |
| Semántico  | Interpreter        | Variable no declarada, tipos incompatibles    |
| Semántico  | Environment        | Identificador redeclarado, constante modificada |

### Detección Léxico vs Sintáctico

```php
// ErrorListener.php
$type = ($recognizer instanceof Lexer) ? "Lexico" : "Sintactico";
ErrorTable::add($type, $msg, $line, $charPositionInLine);
```

### Errores semánticos detectados

- `Identificador '$name' no definido.`
- `El identificador '$name' ya esta definido en este scope.`
- `No se puede modificar la constante '$name'.`
- `La condicion del if debe ser booleana.`
- `La condicion del for debe ser booleana.`
- `Tipos incompatibles en operacion +/-/*///%`
- `Tipos incompatibles en comparacion >/>=/</<=`
- `Division por cero.`
- `Indice fuera de rango.`
- `Intento de indexar algo que no es arreglo.`
- `Intento de llamar algo que no es funcion.`
- `Numero incorrecto de argumentos.`
- `La funcion main no puede recibir parametros.`
- `La funcion main no puede retornar valores.`
- `La funcion main no puede ser invocada explicitamente.`
- `El programa debe contener exactamente una funcion main.`

---

## 8. Estructura de Carpetas

```
COMPI_PROYECTO/
│
├── BACKEND/
│   ├── ANTLR/                    ← Archivos generados por ANTLRv4
│   │   ├── GolampiLexer.php
│   │   ├── GolampiParser.php
│   │   ├── GolampiBaseVisitor.php
│   │   ├── GolampiVisitor.php
│   │   ├── GolampiBaseListener.php
│   │   ├── GolampiListener.php
│   │   ├── Golampi.interp
│   │   ├── Golampi.tokens
│   │   ├── GolampiLexer.interp
│   │   └── GolampiLexer.tokens
│   │
│   ├── Codigo/
│   │   └── Execute.php           ← Punto de entrada HTTP
│   │
│   ├── Gramatica/
│   │   └── Golampi.g4            ← Gramática fuente ANTLRv4
│   │
│   ├── Tablas/
│   │   ├── ErrorEntry.php        ← Estructura de un error
│   │   ├── ErrorTable.php        ← Tabla centralizada de errores
│   │   ├── ErrorListener.php     ← Listener ANTLR para errores
│   │   ├── SymbolEntry.php       ← Estructura de un símbolo
│   │   └── SymbolTable.php       ← Tabla centralizada de símbolos
│   │
│   └── Visitor/
│       ├── Environment.php       ← Manejo de scopes y variables
│       ├── FlowTypes.php         ← BreakSignal, ContinueSignal, ReturnSignal
│       ├── Interpreter.php       ← Núcleo del intérprete (Visitor)
│       ├── Invocable.php         ← Interface para funciones invocables
│       ├── Pointer.php           ← Implementación de punteros
│       └── UserFunction.php      ← Funciones definidas por el usuario
│
├── FRONTEND/
│   └── index.html                ← Interfaz web (Editor + Consola + Reportes)
│
├── vendor/                       ← Dependencias Composer (ANTLR4 PHP runtime)
├── composer.json
├── composer.lock
└── README.md                     ← Este documento
```