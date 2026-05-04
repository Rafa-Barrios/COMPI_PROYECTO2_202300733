# Manual de Usuario — Golampi Compiler

> **Curso:** Organización de Lenguajes y Compiladores 2  
> **Universidad:** San Carlos de Guatemala — Facultad de Ingeniería  
> **Tecnologías:** PHP · ANTLRv4 · ARM64 · HTML/CSS/JavaScript  
> **Lenguaje:** Golampi (inspirado en Go)  
> **Alumno:** Angel Rafael Barrios González — 202300733

---

## Índice de Contenidos

1. [Requisitos del Sistema](#1-requisitos-del-sistema)
2. [Instalación y Configuración](#2-instalación-y-configuración)
3. [Descripción de la Interfaz](#3-descripción-de-la-interfaz)
4. [Crear y Editar Código](#4-crear-y-editar-código)
5. [Compilar un Programa](#5-compilar-un-programa)
6. [Interpretar la Consola ARM64](#6-interpretar-la-consola-arm64)
7. [Reporte de Errores — Cómo Interpretarlo](#7-reporte-de-errores--cómo-interpretarlo)
8. [Tabla de Símbolos — Cómo Interpretarla](#8-tabla-de-símbolos--cómo-interpretarla)
9. [Descargar los Reportes](#9-descargar-los-reportes)
10. [Ejemplos de Uso](#10-ejemplos-de-uso)
11. [Preguntas Frecuentes](#11-preguntas-frecuentes)

---

## 1. Requisitos del Sistema

### Requisitos de Software

| Software | Versión mínima | Descripción |
|---|---|---|
| PHP | 8.0 o superior | Lenguaje del backend |
| Servidor Web | Apache / PHP built-in | Para servir la aplicación |
| Composer | 2.x | Gestor de dependencias PHP |
| ANTLRv4 Runtime | 4.13.x (PHP) | Librería de parseo |
| aarch64-linux-gnu-as | 2.42 | Ensamblador GNU para ARM64 |
| aarch64-linux-gnu-ld | 2.42 | Enlazador GNU para ARM64 |
| qemu-aarch64 | 8.2.2 | Emulador ARM64 en modo usuario |
| Navegador web | Chrome / Firefox / Edge | Para la interfaz |

> 💡 **Nota:** Las herramientas ARM64 y QEMU deben estar instaladas en el servidor. El usuario final solo necesita un navegador moderno.

---

## 2. Instalación y Configuración

### Paso 1 — Descomprimir el proyecto

Coloca la carpeta del proyecto en el directorio donde tu servidor PHP pueda servirla.

### Paso 2 — Instalar dependencias

Abre una terminal en la raíz del proyecto y ejecuta:

```bash
composer install
```

### Paso 3 — Instalar herramientas ARM64 (en el servidor)

```bash
sudo apt install gcc-aarch64-linux-gnu qemu-user
```

### Paso 4 — Crear la carpeta de salida

```bash
mkdir -p BACKEND/output
chmod 755 BACKEND/output
```

### Paso 5 — Iniciar el servidor

**Opción A — PHP built-in (recomendado para desarrollo):**

```bash
php -S localhost:8080 -t FRONTEND/
```

**Opción B — Con Apache:** Apunta el `DocumentRoot` a la carpeta del proyecto.

### Paso 6 — Abrir la aplicación

```
http://localhost:8080
```

Deberías ver la interfaz del **Golampi Compiler** con el editor y la consola ARM64.

---

## 3. Descripción de la Interfaz

La interfaz está organizada en cuatro áreas principales:

| Área | Descripción |
|---|---|
| **Barra de título** | Muestra el nombre GOLAMPI COMPILER y el indicador ARM64 |
| **Barra de acciones** | Botones: Nuevo, Abrir, Guardar, ⚙ Compilar, Limpiar |
| **Editor de código** | Área de texto para escribir código Golampi (columna izquierda) |
| **Consola ARM64** | Panel superior derecho. Muestra el código ensamblador generado |
| **Panel de reportes** | Panel inferior derecho. Botones para descargar los tres reportes |
| **Barra de estado** | Franja inferior. Estado de la compilación y conteo de errores |

### Botones de la Barra de Acciones

| Botón | Función |
|---|---|
| 🗋 **Nuevo** | Limpia el editor y la consola para empezar desde cero |
| 📂 **Abrir** | Carga un archivo `.txt` o `.golampi` desde el sistema de archivos |
| 💾 **Guardar** | Descarga el código fuente actual como archivo `.txt` |
| ⚙ **Compilar** | Compila el código a ARM64. Genera el `.s`, lo ensambla y lo ejecuta |
| 🧹 **Limpiar** | Borra el contenido de la consola ARM64 |

---

## 4. Crear y Editar Código

### Escribir código directamente

Haz clic en el editor (columna izquierda) y comienza a escribir tu programa Golampi. No hay validación en tiempo real — el análisis ocurre al presionar **⚙ Compilar**.

### Cargar un archivo existente

1. Haz clic en **📂 Abrir**.
2. Selecciona un archivo `.txt` o `.golampi`.
3. El contenido se cargará en el editor.

### Guardar el código actual

1. Haz clic en **💾 Guardar**.
2. El navegador descargará `codigo.golampi.txt` con el contenido del editor.

### Estructura mínima de un programa Golampi

```go
func main() {
    fmt.Println("Hola, Golampi Compiler!")
}
```

> 💡 Todo programa válido debe contener exactamente una función `main`.

---

## 5. Compilar un Programa

### Pasos para compilar

1. Escribe o carga el código en el editor.
2. Haz clic en **⚙ Compilar** (botón naranja).
3. El botón cambiará a **⏳ Compilando...** mientras procesa.
4. Al terminar, la consola mostrará el código ARM64 generado.
5. La barra de estado indicará si hubo errores.

### ¿Qué ocurre internamente al compilar?

| Fase | Componente | Descripción |
|---|---|---|
| 1 | Análisis Léxico | El Lexer tokeniza el código. Detecta caracteres inválidos. |
| 2 | Análisis Sintáctico | El Parser construye el AST. Detecta construcciones incorrectas. |
| 3 | Hoisting | Las funciones se registran antes de generar código. |
| 4 | Generación ARM64 | El CodeGenerator recorre el AST y emite instrucciones ARM64. |
| 5 | Ensamblaje | `aarch64-linux-gnu-as` convierte el `.s` a objeto `.o`. |
| 6 | Enlazado | `aarch64-linux-gnu-ld` genera el ejecutable final. |
| 7 | Ejecución | `qemu-aarch64` ejecuta el binario ARM64. |
| 8 | Respuesta | Se retorna JSON con `{asm, output, errors, symbols}`. |

> 💡 **Nota:** Si hay errores léxicos o sintácticos, el proceso se detiene antes de generar código ARM64 y se muestran los errores directamente.

---

## 6. Interpretar la Consola ARM64

La consola (panel superior derecho, texto azul) muestra el **código ensamblador ARM64 generado** por el compilador, no la salida directa del programa.

### Estructura del código ARM64 generado

```asm
/* ================================================
   Generado por Golampi Compiler — OLC2 USAC
   ================================================ */

.section .data
str_0: .asciz "Hola Mundo"

.align 3
.section .text
.align 2
.global _start

_start:
    bl      main
    mov     x0, #0
    mov     x8, #93        // syscall exit
    svc     #0

# ── Función: main ──────────────────────────────
main:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    sub     sp, sp, #496
    ...
    add     sp, sp, #496
    ldp     x29, x30, [sp], #16
    ret
```

### Indicadores de estado

| Indicador | Significado |
|---|---|
| ✅ Compilación exitosa — ARM64 generado | Todo correcto |
| ⚙ Compilación completada — N error(es) | Hay errores pero se generó código |
| ── Compilación fallida | Errores léxicos/sintácticos, no se generó ARM64 |

### Si hay errores además del ARM64

Aparecerán al final de la consola como comentarios:

```
// ── ADVERTENCIAS / ERRORES ──────────────────
// [Ensamblaje] Línea 0, Col 0: referencia a '__print_str' sin definir
// [Semantico] Línea 5, Col 4: Variable 'x' no declarada.
```

---

## 7. Reporte de Errores — Cómo Interpretarlo

El reporte de errores es una tabla HTML descargable con todos los errores encontrados.

### Columnas de la tabla

| # | Tipo | Descripción | Línea | Columna |
|---|---|---|---|---|
| 1 | Lexico | token recognition error at: '@' | 5 | 12 |
| 2 | Sintactico | mismatched input '}' expecting... | 10 | 0 |
| 3 | Semantico | Identificador 'x' no declarado. | 15 | 4 |
| 4 | Ensamblaje | referencia a '__print_str' sin definir | 0 | 0 |

### Tipos de errores y su significado

| Tipo | Cuándo ocurre | Ejemplos |
|---|---|---|
| **Lexico** | Durante la tokenización | Carácter `@` no reconocido |
| **Sintactico** | Durante el parseo del AST | Llave `}` faltante, token inesperado |
| **Semantico** | Durante la generación de código | Variable no declarada, función desconocida |
| **Ensamblaje** | Durante `aarch64-linux-gnu-as` | Instrucción ARM64 inválida |
| **Enlace** | Durante `aarch64-linux-gnu-ld` | Símbolo no definido |

### Errores comunes y sus causas

| Error | Causa probable |
|---|---|
| `Identificador 'x' no declarado.` | Se usó una variable sin declararla |
| `Variable 'arr' no declarada.` | Array usado antes de declarar |
| `La funcion main no puede invocarse explicitamente.` | Se llamó `main()` desde el código |
| `referencia a '__print_str' sin definir` | El helper no se generó (bug interno) |
| `Short declaration requiere al menos una variable nueva.` | Todas las variables del `:=` ya existen |

---

## 8. Tabla de Símbolos — Cómo Interpretarla

La tabla de símbolos refleja todas las variables, constantes y funciones declaradas durante la compilación.

### Columnas de la tabla

| Columna | Descripción |
|---|---|
| **Identificador** | Nombre de la variable, constante o función |
| **Tipo** | Tipo declarado: `int32`, `float32`, `bool`, `rune`, `string`, `array:N` |
| **Ámbito** | `global`, `main`, o el nombre de la función donde vive |
| **Valor** | Valor inicial o `—` para funciones |
| **Línea** | Línea del código fuente donde fue declarado |
| **Columna** | Posición del carácter inicial |

### Ejemplo de tabla de símbolos

| Identificador | Tipo | Ámbito | Valor | Línea | Columna |
|---|---|---|---|---|---|
| main | int32 | global | — | 1 | 5 |
| x | int32 | main | — | 3 | 8 |
| PI | float32 | main | — | 4 | 10 |
| activo | booleano | main | — | 5 | 8 |
| nums | array:3 | main | — | 6 | 8 |

---

## 9. Descargar los Reportes

El panel de reportes (columna derecha inferior) ofrece tres botones de descarga.

| Botón | Qué descarga |
|---|---|
| 💾 **Descargar ARM64** | Archivo `.s` con el código ensamblador generado |
| ⚠️ **Ver / Descargar Errores** | Tabla HTML con todos los errores encontrados |
| 🔍 **Tabla de Símbolos** | Tabla HTML con todos los identificadores declarados |

### Pasos para descargar

1. Compila tu programa con **⚙ Compilar**.
2. Espera a que termine (el botón vuelve a naranja).
3. Haz clic en el botón de reporte deseado.
4. El navegador descargará el archivo automáticamente.

> 💡 El archivo ARM64 (`.s`) puede abrirse con cualquier editor de texto y ejecutarse manualmente con las herramientas GNU si lo deseas.

---

## 10. Ejemplos de Uso

### Ejemplo 1 — Hola Mundo

```go
func main() {
    fmt.Println("Hola, Golampi Compiler!")
}
```

**Salida esperada del programa (via QEMU):**
```
Hola, Golampi Compiler!
```

---

### Ejemplo 2 — Variables y Operaciones Aritméticas

```go
func main() {
    var x int32 = 10
    var y int32 = 5
    fmt.Println("Suma:", x + y)
    fmt.Println("Módulo:", x % y)
}
```

**Salida esperada:**
```
Suma: 15
Módulo: 0
```

---

### Ejemplo 3 — Función con retorno

```go
func cuadrado(n int32) int32 {
    return n * n
}

func main() {
    resultado := cuadrado(7)
    fmt.Println("7 al cuadrado:", resultado)
}
```

**Salida esperada:**
```
7 al cuadrado: 49
```

---

### Ejemplo 4 — Función recursiva

```go
func factorial(n int32) int32 {
    if n == 0 {
        return 1
    }
    return n * factorial(n - 1)
}

func main() {
    fmt.Println("5! =", factorial(5))
}
```

**Salida esperada:**
```
5! = 120
```

---

### Ejemplo 5 — Arreglo con for

```go
func main() {
    nums := [3]int32{10, 20, 30}
    for i := 0; i < 3; i++ {
        fmt.Println(nums[i])
    }
}
```

**Salida esperada:**
```
10
20
30
```

---

### Ejemplo 6 — Paso por referencia

```go
func duplicar(n *int32) {
    *n = *n * 2
}

func main() {
    var x int32 = 5
    duplicar(&x)
    fmt.Println("Duplicado:", x)
}
```

**Salida esperada:**
```
Duplicado: 10
```

---

## 11. Preguntas Frecuentes

**¿Por qué la consola muestra código ARM64 y no la salida del programa?**  
El compilador genera ensamblador ARM64 que es lo que se muestra. La ejecución ocurre internamente en el servidor vía QEMU. Si el programa compiló sin errores de ensamblaje/enlace, la salida del programa aparecerá después del ARM64 en la consola.

**¿Por qué no se genera el `.s` si hay errores sintácticos?**  
Los errores léxicos y sintácticos ocurren antes de la generación de código. Sin un AST válido, el CodeGenerator no puede trabajar.

**¿Puedo descargar el `.s` para ensamblarlo yo mismo?**  
Sí. Usa el botón **💾 Descargar ARM64** y luego ejecuta:
```bash
aarch64-linux-gnu-as programa.s -o programa.o
aarch64-linux-gnu-ld programa.o -o programa
qemu-aarch64 programa
```

**¿Por qué `rune` imprime un número en vez de un carácter?**  
`rune` se almacena como su valor ASCII. `'A'` se imprime como `65`. Esto es comportamiento esperado del compilador académico.

**¿Por qué `float32` no hace aritmética real?**  
El soporte de punto flotante con registros `s0–s31` está fuera del alcance definido para este compilador. Los `float32` se manejan como representación de texto.

**¿Qué hago si aparece `Segmentation fault` al ejecutar el ARM?**  
Generalmente significa acceso a memoria inválida. Causas comunes: variable no inicializada usada como puntero, o índice de array fuera de rango. Revisa la lógica de tu programa.

**¿El compilador soporta arrays 3D?**  
La gramática actual soporta hasta arrays 2D con la sintaxis `{{1,2},{3,4}}`. Arrays 3D o superiores requieren modificación de la gramática.
