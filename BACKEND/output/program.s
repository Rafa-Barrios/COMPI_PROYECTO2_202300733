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
str_0: .ascii "=== INICIO DE CALIFICACION: FUNCIONALIDADES BASICAS ==="
str_1: .ascii "\n--- 1.1 DECLARACION LARGA ---"
str_2: .ascii "3.14"
str_3: .ascii "Golampi"
__space: .ascii " "
str_4: .ascii "\n--- 1.2 ASIGNACION DE VARIABLES ---"
str_5: .ascii "9.75"
str_6: .ascii "Actualizado"
str_7: .ascii "\n--- 1.3 FORMATO DE IDENTIFICADORES ---"
str_8: .ascii "Case sensitive:"
str_9: .ascii "\n--- 1.4 DECLARACION CORTA ---"
str_10: .ascii "2.5"
str_11: .ascii "Inferencia"
str_12: .ascii "\n--- 1.5 DECLARACION LARGA SIN INICIALIZAR ---"
str_13: .ascii "\n--- 1.6 DECLARACION MULTIPLE ---"
str_14: .ascii "Hola"
str_15: .ascii "Mundo"
str_16: .ascii "\n--- 1.7 CONSTANTES ---"
str_17: .ascii "3.14159"
str_18: .ascii "\n--- 1.8 MANEJO DE NIL ---"
str_19: .ascii "Impresion de nil:"
str_20: .ascii "Comparacion nil == nil:"
str_21: .ascii "\n--- 1.11 OPERACIONES ARITMETICAS ---"
str_22: .ascii "+:"
str_23: .ascii "-:"
str_24: .ascii "*:"
str_25: .ascii "/:"
str_26: .ascii "%:"
str_27: .ascii "\n--- 1.12 OPERACIONES RELACIONALES ---"
str_28: .ascii "==:"
str_29: .ascii "!=:"
str_30: .ascii "<:"
str_31: .ascii ">:"
str_32: .ascii "\n--- 1.13 OPERACIONES LOGICAS ---"
str_33: .ascii "true && false:"
str_34: .ascii "true || false:"
str_35: .ascii "!true:"
str_36: .ascii "\n--- 1.14 CORTO CIRCUITO ---"
str_37: .ascii "AND:"
str_38: .ascii "OR:"
str_39: .ascii "\n--- 1.15 OPERADORES DE ASIGNACION ---"
str_40: .ascii "Resultado final:"
str_41: .ascii "\n=== FIN DE CALIFICACION: FUNCIONALIDADES BASICAS ==="

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
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #496   // espacio variables locales
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
    bl      __strlen
    mov     x1, x0
    mov     x0, x10
    bl      __print_str
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
    bl      __strlen
    mov     x1, x0
    mov     x0, x14
    bl      __print_str
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
    adrp    x12, str_10   // float 2.5
    add     x12, x12, :lo12:str_10
    str     x12, [x29, #-72]   // decl cFloat
    mov     x13, #1   // true
    str     x13, [x29, #-80]   // decl cBool
    mov     x14, #88   // rune 'X'
    str     x14, [x29, #-88]   // decl cRune
    adrp    x15, str_11
    add     x15, x15, :lo12:str_11
    str     x15, [x29, #-96]   // decl cString
    ldr     x9, [x29, #-64]   // load cInt
    // fmt.Println arg[0] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_space
    ldr     x10, [x29, #-72]   // load cFloat
    // fmt.Println arg[1] tipo=float32
    mov     x0, x10
    bl      __strlen
    mov     x1, x0
    mov     x0, x10
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-80]   // load cBool
    // fmt.Println arg[2] tipo=bool
    mov     x0, x11
    bl      __print_bool
    bl      __print_space
    ldr     x12, [x29, #-88]   // load cRune
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
    ldr     x13, [x29, #-96]   // load cString
    // fmt.Println arg[4] tipo=string
    mov     x0, x13
    bl      __strlen
    mov     x1, x0
    mov     x0, x13
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_12
    add     x14, x14, :lo12:str_12
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #47      // str len
    bl      __print_str
    bl      __print_newline
    str     xzr, [x29, #-104]   // var defInt = default
    str     xzr, [x29, #-112]   // var defFloat = default
    str     xzr, [x29, #-120]   // var defBool = default
    str     xzr, [x29, #-128]   // var defRune = default
    str     xzr, [x29, #-136]   // var defString = default
    ldr     x15, [x29, #-104]   // load defInt
    // fmt.Println arg[0] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_space
    ldr     x9, [x29, #-112]   // load defFloat
    // fmt.Println arg[1] tipo=float32
    mov     x0, x9
    bl      __strlen
    mov     x1, x0
    mov     x0, x9
    bl      __print_str
    bl      __print_space
    ldr     x10, [x29, #-120]   // load defBool
    // fmt.Println arg[2] tipo=bool
    mov     x0, x10
    bl      __print_bool
    bl      __print_space
    ldr     x11, [x29, #-128]   // load defRune
    // fmt.Println arg[3] tipo=rune
    // print rune (1 byte ASCII)
    sub     sp, sp, #16
    strb    w11, [sp]
    mov     x0, #1          // stdout
    mov     x1, sp          // addr
    mov     x2, #1          // len = 1
    mov     x8, #64         // syscall write
    svc     #0
    add     sp, sp, #16
    bl      __print_space
    ldr     x12, [x29, #-136]   // load defString
    // fmt.Println arg[4] tipo=string
    mov     x0, x12
    bl      __strlen
    mov     x1, x0
    mov     x0, x12
    bl      __print_str
    bl      __print_newline
    adrp    x13, str_13
    add     x13, x13, :lo12:str_13
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #34      // str len
    bl      __print_str
    bl      __print_newline
    mov     x14, #10
    mov     x15, #20
    str     x14, [x29, #-144]   // var m1
    str     x15, [x29, #-152]   // var m2
    adrp    x9, str_14
    add     x9, x9, :lo12:str_14
    adrp    x10, str_15
    add     x10, x10, :lo12:str_15
    str     x9, [x29, #-160]   // decl m3
    str     x10, [x29, #-168]   // decl m4
    ldr     x11, [x29, #-144]   // load m1
    // fmt.Println arg[0] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_space
    ldr     x12, [x29, #-152]   // load m2
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_space
    ldr     x13, [x29, #-160]   // load m3
    // fmt.Println arg[2] tipo=string
    mov     x0, x13
    bl      __strlen
    mov     x1, x0
    mov     x0, x13
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-168]   // load m4
    // fmt.Println arg[3] tipo=string
    mov     x0, x14
    bl      __strlen
    mov     x1, x0
    mov     x0, x14
    bl      __print_str
    bl      __print_newline
    adrp    x15, str_16
    add     x15, x15, :lo12:str_16
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #24      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x9, str_17   // float 3.14159
    add     x9, x9, :lo12:str_17
    str     x9, [x29, #-176]   // const PI
    mov     x10, #1000
    str     x10, [x29, #-184]   // const MAX
    ldr     x11, [x29, #-176]   // load PI
    // fmt.Println arg[0] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_space
    ldr     x12, [x29, #-184]   // load MAX
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_18
    add     x13, x13, :lo12:str_18
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #27      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_19
    add     x14, x14, :lo12:str_19
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #18      // str len
    bl      __print_str
    bl      __print_space
    mov     x15, #0   // nil
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_20
    add     x9, x9, :lo12:str_20
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #24      // str len
    bl      __print_str
    bl      __print_space
    mov     x10, #0   // nil
    mov     x11, #0   // nil
    cmp     x10, x11
    b.eq    eq_true_0
    mov     x12, #0
    b       eq_end_1
eq_true_0:
    mov     x12, #1
eq_end_1:
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_21
    add     x13, x13, :lo12:str_21
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #38      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_22
    add     x14, x14, :lo12:str_22
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    mov     x15, #15
    mov     x9, #25
    add     x10, x15, x9
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_23
    add     x11, x11, :lo12:str_23
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    mov     x12, #50
    mov     x13, #18
    sub     x14, x12, x13
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    adrp    x15, str_24
    add     x15, x15, :lo12:str_24
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    mov     x9, #7
    mov     x10, #8
    mul     x11, x9, x10
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
    adrp    x12, str_25
    add     x12, x12, :lo12:str_25
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    mov     x13, #100
    mov     x14, #3
    sdiv    x15, x13, x14
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_26
    add     x9, x9, :lo12:str_26
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    mov     x10, #17
    mov     x11, #5
    sdiv    x13, x10, x11
    msub    x12, x13, x11, x10
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x14, str_27
    add     x14, x14, :lo12:str_27
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #39      // str len
    bl      __print_str
    bl      __print_newline
    mov     x15, #10
    str     x15, [x29, #-192]   // var r1
    mov     x9, #20
    str     x9, [x29, #-200]   // var r2
    adrp    x10, str_28
    add     x10, x10, :lo12:str_28
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-192]   // load r1
    ldr     x12, [x29, #-200]   // load r2
    cmp     x11, x12
    b.eq    eq_true_2
    mov     x13, #0
    b       eq_end_3
eq_true_2:
    mov     x13, #1
eq_end_3:
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_newline
    adrp    x14, str_29
    add     x14, x14, :lo12:str_29
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [x29, #-192]   // load r1
    ldr     x9, [x29, #-200]   // load r2
    cmp     x15, x9
    b.ne    eq_true_4
    mov     x10, #0
    b       eq_end_5
eq_true_4:
    mov     x10, #1
eq_end_5:
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_30
    add     x11, x11, :lo12:str_30
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    ldr     x12, [x29, #-192]   // load r1
    ldr     x13, [x29, #-200]   // load r2
    cmp     x12, x13
    b.lt    rel_true_6
    mov     x14, #0
    b       rel_end_7
rel_true_6:
    mov     x14, #1
rel_end_7:
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    adrp    x15, str_31
    add     x15, x15, :lo12:str_31
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_space
    ldr     x9, [x29, #-192]   // load r1
    ldr     x10, [x29, #-200]   // load r2
    cmp     x9, x10
    b.gt    rel_true_8
    mov     x11, #0
    b       rel_end_9
rel_true_8:
    mov     x11, #1
rel_end_9:
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
    adrp    x12, str_32
    add     x12, x12, :lo12:str_32
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #34      // str len
    bl      __print_str
    bl      __print_newline
    mov     x13, #1   // true
    str     x13, [x29, #-208]   // var t
    mov     x14, #0   // false
    str     x14, [x29, #-216]   // var f
    adrp    x15, str_33
    add     x15, x15, :lo12:str_33
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #15      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [x29, #-208]   // load t
    cmp     x10, #0
    b.eq    and_false_10   // cortocircuito &&
    ldr     x11, [x29, #-216]   // load f
    cmp     x11, #0
    b.eq    and_false_10   // cortocircuito &&
    mov     x9, #1
    b       and_end_11
and_false_10:
    mov     x9, #0
and_end_11:
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x12, str_34
    add     x12, x12, :lo12:str_34
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #15      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-208]   // load t
    cmp     x14, #0
    b.ne    or_true_12   // cortocircuito ||
    ldr     x15, [x29, #-216]   // load f
    cmp     x15, #0
    b.ne    or_true_12   // cortocircuito ||
    mov     x13, #0
    b       or_end_13
or_true_12:
    mov     x13, #1
or_end_13:
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_35
    add     x9, x9, :lo12:str_35
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #7      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-208]   // load t
    cmp     x11, #0
    b.eq    not_true_14
    mov     x10, #0
    b       not_end_15
not_true_14:
    mov     x10, #1
not_end_15:
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x12, str_36
    add     x12, x12, :lo12:str_36
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #29      // str len
    bl      __print_str
    bl      __print_newline
    mov     x13, #0
    str     x13, [x29, #-224]   // var divisor
    mov     x15, #0   // false
    cmp     x15, #0
    b.eq    and_false_16   // cortocircuito &&
    mov     x9, #100
    ldr     x10, [x29, #-224]   // load divisor
    sdiv    x11, x9, x10
    mov     x12, #1
    cmp     x11, x12
    b.eq    eq_true_18
    mov     x13, #0
    b       eq_end_19
eq_true_18:
    mov     x13, #1
eq_end_19:
    cmp     x13, #0
    b.eq    and_false_16   // cortocircuito &&
    mov     x14, #1
    b       and_end_17
and_false_16:
    mov     x14, #0
and_end_17:
    str     x14, [x29, #-232]   // decl ccAnd
    mov     x15, #1   // true
    cmp     x15, #0
    b.ne    or_true_20   // cortocircuito ||
    mov     x9, #100
    ldr     x10, [x29, #-224]   // load divisor
    sdiv    x11, x9, x10
    mov     x12, #1
    cmp     x11, x12
    b.eq    eq_true_22
    mov     x13, #0
    b       eq_end_23
eq_true_22:
    mov     x13, #1
eq_end_23:
    cmp     x13, #0
    b.ne    or_true_20   // cortocircuito ||
    mov     x14, #0
    b       or_end_21
or_true_20:
    mov     x14, #1
or_end_21:
    str     x14, [x29, #-240]   // decl ccOr
    adrp    x14, str_37
    add     x14, x14, :lo12:str_37
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [x29, #-232]   // load ccAnd
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_38
    add     x9, x9, :lo12:str_38
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [x29, #-240]   // load ccOr
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_39
    add     x11, x11, :lo12:str_39
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #39      // str len
    bl      __print_str
    bl      __print_newline
    mov     x12, #50
    str     x12, [x29, #-248]   // var asig
    mov     x13, #10
    ldr     x14, [x29, #-248]   // load asig
    add     x15, x14, x13
    str     x15, [x29, #-248]   // asig = val
    mov     x9, #5
    ldr     x10, [x29, #-248]   // load asig
    sub     x11, x10, x9
    str     x11, [x29, #-248]   // asig = val
    mov     x12, #2
    ldr     x13, [x29, #-248]   // load asig
    mul     x14, x13, x12
    str     x14, [x29, #-248]   // asig = val
    mov     x15, #5
    ldr     x9, [x29, #-248]   // load asig
    sdiv    x10, x9, x15
    str     x10, [x29, #-248]   // asig = val
    adrp    x11, str_40
    add     x11, x11, :lo12:str_40
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #17      // str len
    bl      __print_str
    bl      __print_space
    ldr     x12, [x29, #-248]   // load asig
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_41
    add     x13, x13, :lo12:str_41
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #54      // str len
    bl      __print_str
    bl      __print_newline
main_end:
    add     sp, sp, #496   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret


// ── Helper: __print_int ──────────────────────────
__print_int:
    stp     x29, x30, [sp, #-64]!
    mov     x29, sp
    mov     x9,  x0            // valor a imprimir
    mov     x10, #0            // contador dígitos
    add     x11, x29, #16      // buffer en stack
    // Caso especial: 0
    cbnz    x9, __pi_neg_check
    mov     w12, #48           // '0'
    strb    w12, [x11]
    mov     x0, #1             // stdout
    mov     x1, x11
    mov     x2, #1
    mov     x8, #64
    svc     #0
    b       __pi_done
__pi_neg_check:
    // Negativo?
    cmp     x9, #0
    b.ge    __pi_loop
    mov     w12, #45           // '-'
    strb    w12, [x11, x10]
    add     x10, x10, #1
    neg     x9, x9
__pi_loop:
    cbz     x9, __pi_reverse
    mov     x13, #10
    udiv    x14, x9, x13       // cociente
    msub    x15, x14, x13, x9  // resto = x9 - cociente*10
    add     x15, x15, #48      // ASCII
    strb    w15, [x11, x10]
    add     x10, x10, #1
    mov     x9,  x14
    b       __pi_loop
__pi_reverse:
    // Invertir dígitos en buffer
    mov     x16, #0            // inicio
    sub     x17, x10, #1       // fin
__pi_rev_loop:
    cmp     x16, x17
    b.ge    __pi_print
    ldrb    w12, [x11, x16]
    ldrb    w13, [x11, x17]
    strb    w13, [x11, x16]
    strb    w12, [x11, x17]
    add     x16, x16, #1
    sub     x17, x17, #1
    b       __pi_rev_loop
__pi_print:
    mov     x0, #1             // stdout
    mov     x1, x11            // buffer
    mov     x2, x10            // longitud
    mov     x8, #64            // syscall write
    svc     #0
__pi_done:
    ldp     x29, x30, [sp], #64
    ret

// ── Helper: __print_str ──────────────────────────
__print_str:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    mov     x2,  x1            // longitud
    mov     x1,  x0            // dirección
    mov     x0,  #1            // stdout
    mov     x8,  #64           // syscall write
    svc     #0
    ldp     x29, x30, [sp], #16
    ret

// ── Helper: __print_bool ─────────────────────────
__print_bool:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    cbnz    x0, __pb_true
    adrp    x1, __str_false
    add     x1, x1, :lo12:__str_false
    mov     x2, #5             // len('false')
    b       __pb_write
__pb_true:
    adrp    x1, __str_true
    add     x1, x1, :lo12:__str_true
    mov     x2, #4             // len('true')
__pb_write:
    mov     x0, #1             // stdout
    mov     x8, #64            // syscall write
    svc     #0
    ldp     x29, x30, [sp], #16
    ret

// ── Helper: __print_newline ──────────────────────
__print_newline:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    adrp    x0, __newline
    add     x0, x0, :lo12:__newline
    // reordenar para syscall: x0=fd, x1=buf, x2=len
    mov     x2, #1
    mov     x1, x0
    mov     x0, #1
    mov     x8, #64
    svc     #0
    ldp     x29, x30, [sp], #16
    ret

// ── Helper: __print_space ────────────────────────
__print_space:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    adrp    x1, __space
    add     x1, x1, :lo12:__space
    mov     x0, #1             // stdout
    mov     x2, #1             // len
    mov     x8, #64            // syscall write
    svc     #0
    ldp     x29, x30, [sp], #16
    ret

// ── Helper: __strlen ────────────────────────────
__strlen:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    mov     x1, x0
__strlen_loop:
    ldrb    w2, [x1]
    cbz     w2, __strlen_done
    add     x1, x1, #1
    b       __strlen_loop
__strlen_done:
    sub     x0, x1, x0
    ldp     x29, x30, [sp], #16
    ret

