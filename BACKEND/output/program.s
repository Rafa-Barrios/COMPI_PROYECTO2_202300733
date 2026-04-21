// ================================================
// Generado por Golampi Compiler
// Universidad San Carlos de Guatemala
// Arquitectura: ARM64 (AArch64)
// ================================================

.section .data
.align 3
__str_true:  .ascii "true"
__str_true_len = . - __str_true
__str_false: .ascii "false"
__str_false_len = . - __str_false
__newline: .ascii "\n"
str_0: .ascii "=== INICIO DE CALIFICACION: FUNCIONALIDADES BASICAS ===\n"
str_1: .ascii "\n--- 1.1 DECLARACION LARGA ---\n"
str_2: .ascii "3.14\n"
str_3: .ascii "Golampi\n"
__space: .ascii " "
str_4: .ascii "\n--- 1.2 ASIGNACION DE VARIABLES ---\n"
str_5: .ascii "9.75\n"
str_6: .ascii "Actualizado\n"
str_7: .ascii "\n--- 1.3 FORMATO DE IDENTIFICADORES ---\n"
str_8: .ascii "Case sensitive:\n"
str_9: .ascii "\n--- 1.4 DECLARACION CORTA ---\n"

.section .text
.align 2
.global _start

_start:
    bl      main
    mov     x0, #0
    mov     x8, #93        // syscall exit
    svc     #0

// ── Función: main ──────────────────────────
main:
    stp     x29, x30, [sp, #-528]!
    mov     x29, sp
    adrp    x9, str_0
    add     x9, x9, :lo12:str_0
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #56      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_1
    add     x10, x10, :lo12:str_1
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #31      // str len
    bl      __print_str
    bl      __print_newline
    mov     x11, #42
    str     x11, [x29, #-8]   // var varInt
    adrp    x12, str_2   // float 3.14
    add     x12, x12, :lo12:str_2
    str     x12, [x29, #-16]   // var varFloat
    mov     x13, #1   // true
    str     x13, [x29, #-24]   // var varBool
    mov     x14, #71   // rune 'G'
    str     x14, [x29, #-32]   // var varRune
    adrp    x15, str_3
    add     x15, x15, :lo12:str_3
    str     x15, [x29, #-40]   // var varString
    ldr     x9, [x29, #-8]   // load varInt
    // fmt.Println arg[0] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_space
    ldr     x10, [x29, #-16]   // load varFloat
    // fmt.Println arg[1] tipo=float32
    mov     x0, x10
    bl      __print_int
    bl      __print_space
    ldr     x11, [x29, #-24]   // load varBool
    // fmt.Println arg[2] tipo=bool
    mov     x0, x11
    bl      __print_bool
    bl      __print_space
    ldr     x12, [x29, #-32]   // load varRune
    // fmt.Println arg[3] tipo=rune
    // print rune (1 byte ASCII)
    sub     sp, sp, #16
    strb    w12, [sp]
    mov     x0, #1          // stdout
    mov     x1, sp          // addr
    mov     x2, #1          // len = 1
    mov     x8, #64         // syscall write
    svc     #0
    add     sp, sp, #16
    bl      __print_space
    ldr     x13, [x29, #-40]   // load varString
    // fmt.Println arg[4] tipo=string
    mov     x0, x13
    bl      __strlen
    mov     x1, x0
    mov     x0, x13
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_4
    add     x14, x14, :lo12:str_4
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #37      // str len
    bl      __print_str
    bl      __print_newline
    mov     x15, #120
    str     x15, [x29, #-8]   // varInt = val
    adrp    x9, str_5   // float 9.75
    add     x9, x9, :lo12:str_5
    str     x9, [x29, #-16]   // varFloat = val
    mov     x10, #0   // false
    str     x10, [x29, #-24]   // varBool = val
    mov     x11, #90   // rune 'Z'
    str     x11, [x29, #-32]   // varRune = val
    adrp    x12, str_6
    add     x12, x12, :lo12:str_6
    str     x12, [x29, #-40]   // varString = val
    ldr     x13, [x29, #-8]   // load varInt
    // fmt.Println arg[0] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_space
    ldr     x14, [x29, #-16]   // load varFloat
    // fmt.Println arg[1] tipo=float32
    mov     x0, x14
    bl      __print_int
    bl      __print_space
    ldr     x15, [x29, #-24]   // load varBool
    // fmt.Println arg[2] tipo=bool
    mov     x0, x15
    bl      __print_bool
    bl      __print_space
    ldr     x9, [x29, #-32]   // load varRune
    // fmt.Println arg[3] tipo=rune
    // print rune (1 byte ASCII)
    sub     sp, sp, #16
    strb    w9, [sp]
    mov     x0, #1          // stdout
    mov     x1, sp          // addr
    mov     x2, #1          // len = 1
    mov     x8, #64         // syscall write
    svc     #0
    add     sp, sp, #16
    bl      __print_space
    ldr     x10, [x29, #-40]   // load varString
    // fmt.Println arg[4] tipo=string
    mov     x0, x10
    bl      __strlen
    mov     x1, x0
    mov     x0, x10
    bl      __print_str
    bl      __print_newline
    adrp    x11, str_7
    add     x11, x11, :lo12:str_7
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #40      // str len
    bl      __print_str
    bl      __print_newline
    mov     x12, #1
    str     x12, [x29, #-48]   // var identificador
    mov     x13, #2
    str     x13, [x29, #-56]   // var Identificador
    adrp    x14, str_8
    add     x14, x14, :lo12:str_8
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #16      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [x29, #-48]   // load identificador
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_space
    ldr     x9, [x29, #-56]   // load Identificador
    // fmt.Println arg[2] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x10, str_9
    add     x10, x10, :lo12:str_9
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #31      // str len
    bl      __print_str
    bl      __print_newline
    mov     x11, #7
    str     x11, [x29, #-64]   // decl cInt
