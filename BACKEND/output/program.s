/* ================================================
   Generado por Golampi Compiler
   Universidad San Carlos de Guatemala
   Arquitectura: ARM64 (AArch64)
   ================================================ */

.section .data
.align 3
__str_true:  .ascii "true"
__str_true_len = . - __str_true
__str_false: .ascii "false"
__str_false_len = . - __str_false
__newline: .ascii "\n"
str_0: .asciz "=== INICIO DE CALIFICACION: FUNCIONES ==="
str_1: .asciz "\n--- 3.1 IMPRIMIR ARBOL ---"
str_2: .asciz "\n--- 3.2 CALCULAR VOLUMEN PIRAMIDE ---"
str_3: .asciz "Volumen:"
__space: .ascii " "
str_4: .asciz "\n--- 3.3 REFERENCIA: ORDENAMIENTO E INTERCAMBIO ---"
str_5: .asciz "Intercambio:"
str_6: .asciz "Ordenado:"
str_7: .asciz "\n--- 3.4 DIVISION MULTIPLE RETORNO ---"
str_8: .asciz "Cociente:"
str_9: .asciz "Residuo:"
str_10: .asciz "\n--- 3.5 POTENCIA RECURSIVA ---"
str_11: .asciz "2^8:"
str_12: .asciz "\n--- 3.6 EUCLIDES RECURSIVO ---"
str_13: .asciz "MCD:"
str_14: .asciz "Pasos:"
str_15: .asciz "\n--- 3.7 HOISTING ---"
str_16: .asciz "\n--- 4.1 FMT.PRINTLN ---"
str_17: .asciz "Impresion directa de texto"
str_18: .asciz "\n--- 4.2 LEN ---"
str_19: .asciz "Golampi"
str_20: .asciz "len(texto):"
str_21: .asciz "len(arrLen):"
str_22: .asciz "\n--- 4.3 NOW ---"
str_23: .asciz "Fecha actual:"
str_24: .asciz "2026-04-23 17:24:28"
str_25: .asciz "\n--- 4.4 SUBSTR ---"
str_26: .asciz "substr:"
str_27: .asciz "Organizacion de Lenguajes"
str_28: .asciz "\n--- 4.5 TYPEOF ---"
str_29: .asciz "int32:"
str_30: .asciz "int32"
str_31: .asciz "float32:"
str_32: .asciz "float32"
str_33: .asciz "bool:"
str_34: .asciz "bool"
str_35: .asciz "string:"
str_36: .asciz "string"
str_37: .asciz "\n=== FIN DE CALIFICACION: FUNCIONES ==="
str_38: .asciz "  *"
str_39: .asciz " ***"
str_40: .asciz "*****"
str_41: .asciz "Funcion ejecutada por hoisting"

.section .text
.align 2
.global _start

_start:
    bl      main
    mov     x0, #0
    mov     x8, #93        // syscall exit
    svc     #0

# ── Función: main ──────────────────────────
main:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #496   // espacio variables locales
    adrp    x9, str_0
    add     x9, x9, :lo12:str_0
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #41      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_1
    add     x10, x10, :lo12:str_1
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #27      // str len
    bl      __print_str
    bl      __print_newline
    mov     x11, #0   // ref a imprimirArbol
    bl      imprimirArbol   // call imprimirArbol
    mov     x12, x0   // return value
    adrp    x13, str_2
    add     x13, x13, :lo12:str_2
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #38      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_3
    add     x14, x14, :lo12:str_3
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #8      // str len
    bl      __print_str
    bl      __print_space
    mov     x15, #0   // ref a calcularVolumenPiramide
    mov     x9, #10   // float 10.0 como entero
    mov     x0, x9   // arg[0]
    mov     x10, #15   // float 15.0 como entero
    mov     x1, x10   // arg[1]
    bl      calcularVolumenPiramide   // call calcularVolumenPiramide
    mov     x11, x0   // return value
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
    adrp    x12, str_4
    add     x12, x12, :lo12:str_4
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #51      // str len
    bl      __print_str
    bl      __print_newline
    mov     x13, #100
    str     x13, [x29, #-8]   // var a
    mov     x14, #200
    str     x14, [x29, #-16]   // var b
    mov     x15, #0   // ref a intercambioValores
    add     x9, x29, #-8   // &a
    mov     x0, x9   // arg[0]
    add     x10, x29, #-16   // &b
    mov     x1, x10   // arg[1]
    bl      intercambioValores   // call intercambioValores
    mov     x11, x0   // return value
    adrp    x12, str_5
    add     x12, x12, :lo12:str_5
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #12      // str len
    bl      __print_str
    bl      __print_space
    ldr     x13, [x29, #-8]   // load a
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_space
    ldr     x14, [x29, #-16]   // load b
    // fmt.Println arg[2] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    mov     x15, #5
    // array literal: reservar espacio en stack
    sub     sp, sp, x15, lsl #3   // size * 8 bytes
    mov     x9, sp   // base del array
    mov     x10, #64
    str     x10, [x9, #0]   // arr[0]
    mov     x11, #25
    str     x11, [x9, #8]   // arr[1]
    mov     x12, #12
    str     x12, [x9, #16]   // arr[2]
    mov     x13, #22
    str     x13, [x9, #24]   // arr[3]
    mov     x14, #11
    str     x14, [x9, #32]   // arr[4]
    str     x9, [x29, #-24]   // var arr
    mov     x15, #0   // ref a ordenamientoSeleccion
    add     x9, x29, #-24   // &arr
    mov     x0, x9   // arg[0]
    bl      ordenamientoSeleccion   // call ordenamientoSeleccion
    mov     x10, x0   // return value
    adrp    x11, str_6
    add     x11, x11, :lo12:str_6
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #9      // str len
    bl      __print_str
    bl      __print_space
    ldr     x12, [x29, #-24]   // load arr
    mov     x13, #0
    mov     x14, x12   // base de arr
    add     x15, x14, x13, lsl #3   // arr[i]
    ldr     x9, [x15]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_space
    ldr     x10, [x29, #-24]   // load arr
    mov     x11, #1
    mov     x12, x10   // base de arr
    add     x13, x12, x11, lsl #3   // arr[i]
    ldr     x14, [x13]   // load elem
    // fmt.Println arg[2] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_space
    ldr     x15, [x29, #-24]   // load arr
    mov     x9, #2
    mov     x10, x15   // base de arr
    add     x11, x10, x9, lsl #3   // arr[i]
    ldr     x12, [x11]   // load elem
    // fmt.Println arg[3] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_space
    ldr     x13, [x29, #-24]   // load arr
    mov     x14, #3
    mov     x15, x13   // base de arr
    add     x9, x15, x14, lsl #3   // arr[i]
    ldr     x10, [x9]   // load elem
    // fmt.Println arg[4] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_space
    ldr     x11, [x29, #-24]   // load arr
    mov     x12, #4
    mov     x13, x11   // base de arr
    add     x14, x13, x12, lsl #3   // arr[i]
    ldr     x15, [x14]   // load elem
    // fmt.Println arg[5] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_7
    add     x9, x9, :lo12:str_7
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #38      // str len
    bl      __print_str
    bl      __print_newline
    mov     x10, #0   // ref a division
    mov     x11, #17
    mov     x0, x11   // arg[0]
    mov     x12, #5
    mov     x1, x12   // arg[1]
    bl      division   // call division
    mov     x13, x0   // return value
    str     x13, [x29, #-32]   // decl cociente
    str     xzr, [x29, #-40]   // decl residuo
    str     xzr, [x29, #-48]   // decl valido
    ldr     x14, [x29, #-48]   // load valido
    cmp     x14, #0
    b.eq    if_end_1
    adrp    x15, str_8
    add     x15, x15, :lo12:str_8
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #9      // str len
    bl      __print_str
    bl      __print_space
    ldr     x9, [x29, #-32]   // load cociente
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_space
    adrp    x10, str_9
    add     x10, x10, :lo12:str_9
    // fmt.Println arg[2] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #8      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-40]   // load residuo
    // fmt.Println arg[3] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
if_end_1:
    adrp    x12, str_10
    add     x12, x12, :lo12:str_10
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #31      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x13, str_11
    add     x13, x13, :lo12:str_11
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    mov     x14, #0   // ref a potencia
    mov     x15, #2
    mov     x0, x15   // arg[0]
    mov     x9, #8
    mov     x1, x9   // arg[1]
    bl      potencia   // call potencia
    mov     x10, x0   // return value
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_12
    add     x11, x11, :lo12:str_12
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #31      // str len
    bl      __print_str
    bl      __print_newline
    mov     x12, #0   // ref a euclides
    mov     x13, #48
    mov     x0, x13   // arg[0]
    mov     x14, #18
    mov     x1, x14   // arg[1]
    bl      euclides   // call euclides
    mov     x15, x0   // return value
    str     x15, [x29, #-56]   // decl mcd
    str     xzr, [x29, #-64]   // decl pasos
    adrp    x9, str_13
    add     x9, x9, :lo12:str_13
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [x29, #-56]   // load mcd
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_space
    adrp    x11, str_14
    add     x11, x11, :lo12:str_14
    // fmt.Println arg[2] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #6      // str len
    bl      __print_str
    bl      __print_space
    ldr     x12, [x29, #-64]   // load pasos
    // fmt.Println arg[3] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_15
    add     x13, x13, :lo12:str_15
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #21      // str len
    bl      __print_str
    bl      __print_newline
    mov     x14, #0   // ref a funcionDefinidaDespues
    bl      funcionDefinidaDespues   // call funcionDefinidaDespues
    mov     x15, x0   // return value
    adrp    x9, str_16
    add     x9, x9, :lo12:str_16
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #24      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_17
    add     x10, x10, :lo12:str_17
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #26      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x11, str_18
    add     x11, x11, :lo12:str_18
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #16      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x12, str_19
    add     x12, x12, :lo12:str_19
    str     x12, [x29, #-72]   // decl texto
    adrp    x13, str_20
    add     x13, x13, :lo12:str_20
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #11      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [x29, #-72]   // load texto for len
    mov     x0, x15
    bl      __strlen
    mov     x14, x0   // len result
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    mov     x9, #4
    // array literal: reservar espacio en stack
    sub     sp, sp, x9, lsl #3   // size * 8 bytes
    mov     x10, sp   // base del array
    mov     x11, #1
    str     x11, [x10, #0]   // arr[0]
    mov     x12, #2
    str     x12, [x10, #8]   // arr[1]
    mov     x13, #3
    str     x13, [x10, #16]   // arr[2]
    mov     x14, #4
    str     x14, [x10, #24]   // arr[3]
    str     x10, [x29, #-80]   // decl arrLen
    adrp    x15, str_21
    add     x15, x15, :lo12:str_21
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #12      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [x29, #-80]   // load arrLen for len
    mov     x0, x10
    bl      __strlen
    mov     x9, x0   // len result
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_22
    add     x11, x11, :lo12:str_22
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #16      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x12, str_23
    add     x12, x12, :lo12:str_23
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #13      // str len
    bl      __print_str
    bl      __print_space
    // now() → "2026-04-23 17:24:28"
    adrp    x13, str_24
    add     x13, x13, :lo12:str_24
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_newline
    adrp    x14, str_25
    add     x14, x14, :lo12:str_25
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #19      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x15, str_26
    add     x15, x15, :lo12:str_26
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #7      // str len
    bl      __print_str
    bl      __print_space
    adrp    x10, str_27
    add     x10, x10, :lo12:str_27
    mov     x11, #0
    mov     x12, #12
    // substr(str, start, length)
    add     x13, x10, x11   // ptr = str + start
    sub     sp, sp, #64             // buffer para substr
    mov     x14, sp            // destino
    mov     x0, x14            // destino
    mov     x1, x13            // origen = str + start
    mov     x2, x12         // bytes a copiar
    bl      __memcpy
    add     x9, x14, x12
    strb    wzr, [x9]               // null terminator
    mov     x9, x14    // retornar ptr subcadena
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x15, str_28
    add     x15, x15, :lo12:str_28
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #19      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x9, str_29
    add     x9, x9, :lo12:str_29
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #6      // str len
    bl      __print_str
    bl      __print_space
    // typeOf(42)
    adrp    x10, str_30
    add     x10, x10, :lo12:str_30
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_31
    add     x11, x11, :lo12:str_31
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #8      // str len
    bl      __print_str
    bl      __print_space
    // typeOf(3.14)
    adrp    x12, str_32
    add     x12, x12, :lo12:str_32
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_33
    add     x13, x13, :lo12:str_33
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_space
    // typeOf(true)
    adrp    x14, str_34
    add     x14, x14, :lo12:str_34
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    adrp    x15, str_35
    add     x15, x15, :lo12:str_35
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #7      // str len
    bl      __print_str
    bl      __print_space
    // typeOf("texto")
    adrp    x9, str_36
    add     x9, x9, :lo12:str_36
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x10, str_37
    add     x10, x10, :lo12:str_37
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #39      // str len
    bl      __print_str
    bl      __print_newline
main_end:
    add     sp, sp, #496   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: imprimirArbol ──────────────────────────
imprimirArbol:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #496   // espacio variables locales
    adrp    x9, str_38
    add     x9, x9, :lo12:str_38
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_39
    add     x10, x10, :lo12:str_39
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x11, str_40
    add     x11, x11, :lo12:str_40
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_newline
imprimirArbol_end:
    add     sp, sp, #496   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: calcularVolumenPiramide ──────────────────────────
calcularVolumenPiramide:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: base
    str     x1, [x29, #-16]   // param: altura
    ldr     x9, [x29, #-8]   // load base
    ldr     x10, [x29, #-8]   // load base
    mul     x11, x9, x10
    ldr     x12, [x29, #-16]   // load altura
    mul     x13, x11, x12
    mov     x14, #3   // float 3.0 como entero
    cbnz    x14, div_ok_2   // check div by zero
    mov     x0, #0
    mov     x8, #93               // exit si div/0
    svc     #0
div_ok_2:
    sdiv    x15, x13, x14
    mov     x0, x15   // return value
    b       calcularVolumenPiramide_end   // return
calcularVolumenPiramide_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: intercambioValores ──────────────────────────
intercambioValores:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: x
    str     x1, [x29, #-16]   // param: y
    ldr     x10, [x29, #-8]   // load x
    ldr     x9, [x10]   // *ptr
    str     x9, [x29, #-24]   // decl temp
    ldr     x12, [x29, #-16]   // load y
    ldr     x11, [x12]   // *ptr
    ldr     x13, [x29, #-8]   // load ptr addr
    str     x11, [x13]   // *x = val
    ldr     x14, [x29, #-24]   // load temp
    ldr     x15, [x29, #-16]   // load ptr addr
    str     x14, [x15]   // *y = val
intercambioValores_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: ordenamientoSeleccion ──────────────────────────
ordenamientoSeleccion:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: arr
    mov     x9, #0
    str     x9, [x29, #-16]   // decl i
for_start_3:
    ldr     x10, [x29, #-16]   // load i
    mov     x11, #4
    cmp     x10, x11
    b.lt    rel_true_6
    mov     x12, #0
    b       rel_end_7
rel_true_6:
    mov     x12, #1
rel_end_7:
    cmp     x12, #0
    b.eq    for_end_5
    ldr     x13, [x29, #-16]   // load i
    str     x13, [x29, #-24]   // decl min
    ldr     x14, [x29, #-16]   // load i
    mov     x15, #1
    add     x9, x14, x15
    str     x9, [x29, #-32]   // decl j
for_start_8:
    ldr     x10, [x29, #-32]   // load j
    mov     x11, #5
    cmp     x10, x11
    b.lt    rel_true_11
    mov     x12, #0
    b       rel_end_12
rel_true_11:
    mov     x12, #1
rel_end_12:
    cmp     x12, #0
    b.eq    for_end_10
    ldr     x13, [x29, #-8]   // load arr
    ldr     x14, [x29, #-32]   // load j
    ldr     x15, [x13]   // deref ptr → base real de arr
    add     x9, x15, x14, lsl #3   // arr[i]
    ldr     x10, [x9]   // load elem
    ldr     x11, [x29, #-8]   // load arr
    ldr     x12, [x29, #-24]   // load min
    ldr     x13, [x11]   // deref ptr → base real de arr
    add     x14, x13, x12, lsl #3   // arr[i]
    ldr     x15, [x14]   // load elem
    cmp     x10, x15
    b.lt    rel_true_15
    mov     x9, #0
    b       rel_end_16
rel_true_15:
    mov     x9, #1
rel_end_16:
    cmp     x9, #0
    b.eq    if_end_14
    ldr     x10, [x29, #-32]   // load j
    str     x10, [x29, #-24]   // min = val
if_end_14:
for_update_9:
    ldr     x11, [x29, #-32]   // load j
    add     x12, x11, #1   // j++
    str     x12, [x29, #-32]   // store j
    b       for_start_8
for_end_10:
    ldr     x13, [x29, #-24]   // load min
    ldr     x14, [x29, #-16]   // load i
    cmp     x13, x14
    b.ne    eq_true_19
    mov     x15, #0
    b       eq_end_20
eq_true_19:
    mov     x15, #1
eq_end_20:
    cmp     x15, #0
    b.eq    if_end_18
    ldr     x9, [x29, #-8]   // load arr
    ldr     x10, [x29, #-16]   // load i
    ldr     x11, [x9]   // deref ptr → base real de arr
    add     x12, x11, x10, lsl #3   // arr[i]
    ldr     x13, [x12]   // load elem
    str     x13, [x29, #-40]   // decl temp
    ldr     x14, [x29, #-8]   // load arr
    ldr     x15, [x29, #-24]   // load min
    ldr     x9, [x14]   // deref ptr → base real de arr
    add     x10, x9, x15, lsl #3   // arr[i]
    ldr     x11, [x10]   // load elem
    ldr     x12, [x29, #-16]   // índice i
    ldr     x13, [x29, #-8]   // load ptr → &arr_caller
    ldr     x15, [x13]             // deref → base real de arr
    add     x14, x15, x12, lsl #3   // addr arr[i]
    str     x11, [x14]   // arr[i] = val
    ldr     x9, [x29, #-40]   // load temp
    ldr     x10, [x29, #-24]   // índice min
    ldr     x11, [x29, #-8]   // load ptr → &arr_caller
    ldr     x13, [x11]             // deref → base real de arr
    add     x12, x13, x10, lsl #3   // addr arr[i]
    str     x9, [x12]   // arr[i] = val
if_end_18:
for_update_4:
    ldr     x14, [x29, #-16]   // load i
    add     x15, x14, #1   // i++
    str     x15, [x29, #-16]   // store i
    b       for_start_3
for_end_5:
ordenamientoSeleccion_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: division ──────────────────────────
division:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: a
    str     x1, [x29, #-16]   // param: b
    ldr     x9, [x29, #-16]   // load b
    mov     x10, #0
    cmp     x9, x10
    b.eq    eq_true_23
    mov     x11, #0
    b       eq_end_24
eq_true_23:
    mov     x11, #1
eq_end_24:
    cmp     x11, #0
    b.eq    if_end_22
    mov     x12, #0
    mov     x0, x12   // return value[0]
    mov     x13, #0
    mov     x1, x13   // return value[1]
    mov     x14, #0   // false
    mov     x2, x14   // return value[2]
    b       division_end   // return
if_end_22:
    ldr     x15, [x29, #-8]   // load a
    ldr     x9, [x29, #-16]   // load b
    cbnz    x9, div_ok_25   // check div by zero
    mov     x0, #0
    mov     x8, #93               // exit si div/0
    svc     #0
div_ok_25:
    sdiv    x10, x15, x9
    mov     x0, x10   // return value[0]
    ldr     x11, [x29, #-8]   // load a
    ldr     x12, [x29, #-16]   // load b
    cbnz    x12, mod_ok_26   // check mod by zero
    mov     x0, #0
    mov     x8, #93
    svc     #0
mod_ok_26:
    sdiv    x14, x11, x12
    msub    x13, x14, x12, x11
    mov     x1, x13   // return value[1]
    mov     x15, #1   // true
    mov     x2, x15   // return value[2]
    b       division_end   // return
division_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: potencia ──────────────────────────
potencia:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: base
    str     x1, [x29, #-16]   // param: exponente
    ldr     x9, [x29, #-16]   // load exponente
    mov     x10, #0
    cmp     x9, x10
    b.eq    eq_true_29
    mov     x11, #0
    b       eq_end_30
eq_true_29:
    mov     x11, #1
eq_end_30:
    cmp     x11, #0
    b.eq    if_end_28
    mov     x12, #1
    mov     x0, x12   // return value
    b       potencia_end   // return
if_end_28:
    ldr     x13, [x29, #-8]   // load base
    mov     x14, #0   // ref a potencia
    ldr     x15, [x29, #-8]   // load base
    mov     x0, x15   // arg[0]
    ldr     x9, [x29, #-16]   // load exponente
    mov     x10, #1
    sub     x11, x9, x10
    mov     x1, x11   // arg[1]
    bl      potencia   // call potencia
    mov     x12, x0   // return value
    mul     x13, x13, x12
    mov     x0, x13   // return value
    b       potencia_end   // return
potencia_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: euclides ──────────────────────────
euclides:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: a
    str     x1, [x29, #-16]   // param: b
    ldr     x9, [x29, #-16]   // load b
    mov     x10, #0
    cmp     x9, x10
    b.eq    eq_true_33
    mov     x11, #0
    b       eq_end_34
eq_true_33:
    mov     x11, #1
eq_end_34:
    cmp     x11, #0
    b.eq    if_end_32
    ldr     x12, [x29, #-8]   // load a
    mov     x0, x12   // return value[0]
    mov     x13, #1
    mov     x1, x13   // return value[1]
    b       euclides_end   // return
if_end_32:
    mov     x14, #0   // ref a euclides
    ldr     x15, [x29, #-16]   // load b
    mov     x0, x15   // arg[0]
    ldr     x9, [x29, #-8]   // load a
    ldr     x10, [x29, #-16]   // load b
    cbnz    x10, mod_ok_35   // check mod by zero
    mov     x0, #0
    mov     x8, #93
    svc     #0
mod_ok_35:
    sdiv    x12, x9, x10
    msub    x11, x12, x10, x9
    mov     x1, x11   // arg[1]
    bl      euclides   // call euclides
    mov     x13, x0   // return value
    str     x13, [x29, #-24]   // decl resultado
    str     xzr, [x29, #-32]   // decl pasos
    ldr     x14, [x29, #-24]   // load resultado
    mov     x0, x14   // return value[0]
    ldr     x15, [x29, #-32]   // load pasos
    mov     x9, #1
    add     x10, x15, x9
    mov     x1, x10   // return value[1]
    b       euclides_end   // return
euclides_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: funcionDefinidaDespues ──────────────────────────
funcionDefinidaDespues:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #496   // espacio variables locales
    adrp    x9, str_41
    add     x9, x9, :lo12:str_41
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #30      // str len
    bl      __print_str
    bl      __print_newline
funcionDefinidaDespues_end:
    add     sp, sp, #496   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret


# ── Helper: __print_int ──────────────────────────
__print_int:
    stp     x29, x30, [sp, #-64]!
    mov     x29, sp
    mov     x9,  x0            // valor a imprimir
    mov     x10, #0            // contador dígitos
    add     x11, x29, #16      // buffer en stack
    # Caso especial: 0
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
    # Negativo?
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
    # Invertir dígitos en buffer
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

# ── Helper: __print_str ──────────────────────────
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

# ── Helper: __print_bool ─────────────────────────
__print_bool:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    cbnz    x0, __pb_true
    adrp    x1, __str_false
    add     x1, x1, :lo12:__str_false
    mov     x2, #5             //  len('false')
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

# ── Helper: __print_newline ──────────────────────
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

# ── Helper: __print_space ────────────────────────
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

# ── Helper: __strlen ────────────────────────────
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

# ── Helper: __memcpy ────────────────────────────
__memcpy:
    stp     x29, x30, [sp, #-16]!
    mov     x29, sp
    cbz     x2, __memcpy_done
__memcpy_loop:
    ldrb    w3, [x1], #1
    strb    w3, [x0], #1
    subs    x2, x2, #1
    b.ne    __memcpy_loop
__memcpy_done:
    ldp     x29, x30, [sp], #16
    ret

