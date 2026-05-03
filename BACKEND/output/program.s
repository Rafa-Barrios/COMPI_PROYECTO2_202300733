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
str_7: .asciz "\n--- 3.4 POTENCIA RECURSIVA ---"
str_8: .asciz "2^8:"
str_9: .asciz "\n--- 3.5 REFERENCIA AVANZADA: INTERCAMBIO VALIDADO E INTERCALACION ---"
str_10: .asciz "Intercambio validado:"
str_11: .asciz "Intercalación:"
str_12: .asciz "\n--- 3.6 EUCLIDES RECURSIVO ---"
str_13: .asciz "MCD:"
str_14: .asciz "Pasos:"
str_15: .asciz "\n--- 4.1 FMT.PRINTLN ---"
str_16: .asciz "Impresion directa de texto"
str_17: .asciz "\n--- 4.2 LEN ---"
str_18: .asciz "Golampi"
str_19: .asciz "len(texto):"
str_20: .asciz "len(arrLen):"
str_21: .asciz "\n--- 4.3 NOW ---"
str_22: .asciz "Fecha actual:"
str_23: .asciz "2026-05-03 08:27:55"
str_24: .asciz "\n--- 4.4 SUBSTR ---"
str_25: .asciz "substr:"
str_26: .asciz "Organizacion de Lenguajes"
str_27: .asciz "\n--- 4.5 TYPEOF ---"
str_28: .asciz "int32:"
str_29: .asciz "int32"
str_30: .asciz "float32:"
str_31: .asciz "float32"
str_32: .asciz "bool:"
str_33: .asciz "bool"
str_34: .asciz "string:"
str_35: .asciz "string"
str_36: .asciz "\n=== FIN DE CALIFICACION: FUNCIONES ==="
str_37: .asciz "  *"
str_38: .asciz " ***"
str_39: .asciz "*****"

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
    str     x13, [sp, #0]   // var a
    mov     x14, #200
    str     x14, [sp, #8]   // var b
    mov     x15, #0   // ref a intercambioValores
    add     x9, sp, #0   // &a
    mov     x0, x9   // arg[0]
    add     x10, sp, #8   // &b
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
    ldr     x13, [sp, #0]   // load a
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_space
    ldr     x14, [sp, #8]   // load b
    // fmt.Println arg[2] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    mov     x15, #64
    str     x15, [sp, #16]   // arr[0]
    mov     x9, #25
    str     x9, [sp, #24]   // arr[1]
    mov     x10, #12
    str     x10, [sp, #32]   // arr[2]
    mov     x11, #22
    str     x11, [sp, #40]   // arr[3]
    mov     x12, #11
    str     x12, [sp, #48]   // arr[4]
    add     x13, sp, #16   // base del array
    str     x13, [sp, #56]   // var arr
    mov     x14, #0   // ref a ordenamientoSeleccion
    add     x15, sp, #56   // &arr
    mov     x0, x15   // arg[0]
    bl      ordenamientoSeleccion   // call ordenamientoSeleccion
    mov     x9, x0   // return value
    adrp    x10, str_6
    add     x10, x10, :lo12:str_6
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #9      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [sp, #56]   // load arr
    mov     x12, #0
    mov     x13, x11   // base de arr
    add     x14, x13, x12, lsl #3   // arr[i]
    ldr     x15, [x14]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_space
    ldr     x9, [sp, #56]   // load arr
    mov     x10, #1
    mov     x11, x9   // base de arr
    add     x12, x11, x10, lsl #3   // arr[i]
    ldr     x13, [x12]   // load elem
    // fmt.Println arg[2] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_space
    ldr     x14, [sp, #56]   // load arr
    mov     x15, #2
    mov     x9, x14   // base de arr
    add     x10, x9, x15, lsl #3   // arr[i]
    ldr     x11, [x10]   // load elem
    // fmt.Println arg[3] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_space
    ldr     x12, [sp, #56]   // load arr
    mov     x13, #3
    mov     x14, x12   // base de arr
    add     x15, x14, x13, lsl #3   // arr[i]
    ldr     x9, [x15]   // load elem
    // fmt.Println arg[4] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_space
    ldr     x10, [sp, #56]   // load arr
    mov     x11, #4
    mov     x12, x10   // base de arr
    add     x13, x12, x11, lsl #3   // arr[i]
    ldr     x14, [x13]   // load elem
    // fmt.Println arg[5] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    adrp    x15, str_7
    add     x15, x15, :lo12:str_7
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #31      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x9, str_8
    add     x9, x9, :lo12:str_8
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    mov     x10, #0   // ref a potencia
    mov     x11, #2
    mov     x0, x11   // arg[0]
    mov     x12, #8
    mov     x1, x12   // arg[1]
    bl      potencia   // call potencia
    mov     x13, x0   // return value
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_newline
    adrp    x14, str_9
    add     x14, x14, :lo12:str_9
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #70      // str len
    bl      __print_str
    bl      __print_newline
    mov     x15, #50
    str     x15, [sp, #64]   // var x
    mov     x9, #30
    str     x9, [sp, #72]   // var y
    mov     x10, #0   // ref a intercambioValoresValidado
    add     x11, sp, #64   // &x
    mov     x0, x11   // arg[0]
    add     x12, sp, #72   // &y
    mov     x1, x12   // arg[1]
    bl      intercambioValoresValidado   // call intercambioValoresValidado
    mov     x13, x0   // return value
    adrp    x14, str_10
    add     x14, x14, :lo12:str_10
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #21      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [sp, #64]   // load x
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_space
    ldr     x9, [sp, #72]   // load y
    // fmt.Println arg[2] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    mov     x10, #64
    str     x10, [sp, #80]   // arr[0]
    mov     x11, #34
    str     x11, [sp, #88]   // arr[1]
    mov     x12, #25
    str     x12, [sp, #96]   // arr[2]
    mov     x13, #12
    str     x13, [sp, #104]   // arr[3]
    mov     x14, #22
    str     x14, [sp, #112]   // arr[4]
    mov     x15, #11
    str     x15, [sp, #120]   // arr[5]
    add     x9, sp, #80   // base del array
    str     x9, [sp, #128]   // var arr2
    mov     x10, #0   // ref a intercalacion
    add     x11, sp, #128   // &arr2
    mov     x0, x11   // arg[0]
    bl      intercalacion   // call intercalacion
    mov     x12, x0   // return value
    adrp    x13, str_11
    add     x13, x13, :lo12:str_11
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #15      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [sp, #128]   // load arr2
    mov     x15, #0
    mov     x9, x14   // base de arr2
    add     x10, x9, x15, lsl #3   // arr2[i]
    ldr     x11, [x10]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_space
    ldr     x12, [sp, #128]   // load arr2
    mov     x13, #1
    mov     x14, x12   // base de arr2
    add     x15, x14, x13, lsl #3   // arr2[i]
    ldr     x9, [x15]   // load elem
    // fmt.Println arg[2] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_space
    ldr     x10, [sp, #128]   // load arr2
    mov     x11, #2
    mov     x12, x10   // base de arr2
    add     x13, x12, x11, lsl #3   // arr2[i]
    ldr     x14, [x13]   // load elem
    // fmt.Println arg[3] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_space
    ldr     x15, [sp, #128]   // load arr2
    mov     x9, #3
    mov     x10, x15   // base de arr2
    add     x11, x10, x9, lsl #3   // arr2[i]
    ldr     x12, [x11]   // load elem
    // fmt.Println arg[4] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_space
    ldr     x13, [sp, #128]   // load arr2
    mov     x14, #4
    mov     x15, x13   // base de arr2
    add     x9, x15, x14, lsl #3   // arr2[i]
    ldr     x10, [x9]   // load elem
    // fmt.Println arg[5] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_space
    ldr     x11, [sp, #128]   // load arr2
    mov     x12, #5
    mov     x13, x11   // base de arr2
    add     x14, x13, x12, lsl #3   // arr2[i]
    ldr     x15, [x14]   // load elem
    // fmt.Println arg[6] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_12
    add     x9, x9, :lo12:str_12
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #31      // str len
    bl      __print_str
    bl      __print_newline
    mov     x10, #0   // ref a euclides
    mov     x11, #48
    mov     x0, x11   // arg[0]
    mov     x12, #18
    mov     x1, x12   // arg[1]
    bl      euclides   // call euclides
    mov     x13, x0   // return value
    str     x0, [sp, #136]   // decl mcd (ret 0)
    str     x1, [sp, #144]   // decl pasos (ret 1)
    adrp    x14, str_13
    add     x14, x14, :lo12:str_13
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [sp, #136]   // load mcd
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_space
    adrp    x9, str_14
    add     x9, x9, :lo12:str_14
    // fmt.Println arg[2] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #6      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [sp, #144]   // load pasos
    // fmt.Println arg[3] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_15
    add     x11, x11, :lo12:str_15
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #24      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x12, str_16
    add     x12, x12, :lo12:str_16
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #26      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x13, str_17
    add     x13, x13, :lo12:str_17
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #16      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_18
    add     x14, x14, :lo12:str_18
    str     x14, [sp, #152]   // decl texto
    adrp    x15, str_19
    add     x15, x15, :lo12:str_19
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #11      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [sp, #152]   // load texto for len
    mov     x0, x10
    bl      __strlen
    mov     x9, x0   // len result
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    mov     x11, #1
    str     x11, [sp, #160]   // arr[0]
    mov     x12, #2
    str     x12, [sp, #168]   // arr[1]
    mov     x13, #3
    str     x13, [sp, #176]   // arr[2]
    mov     x14, #4
    str     x14, [sp, #184]   // arr[3]
    add     x15, sp, #160   // base del array
    str     x15, [sp, #192]   // decl arrLen
    adrp    x9, str_20
    add     x9, x9, :lo12:str_20
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #12      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [sp, #192]   // load arrLen for len
    mov     x0, x11
    bl      __strlen
    mov     x10, x0   // len result
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x12, str_21
    add     x12, x12, :lo12:str_21
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #16      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x13, str_22
    add     x13, x13, :lo12:str_22
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #13      // str len
    bl      __print_str
    bl      __print_space
    // now() → "2026-05-03 08:27:55"
    adrp    x14, str_23
    add     x14, x14, :lo12:str_23
    // fmt.Println arg[1] tipo=string
    mov     x0, x14
    bl      __strlen
    mov     x1, x0
    mov     x0, x14
    bl      __print_str
    bl      __print_newline
    adrp    x15, str_24
    add     x15, x15, :lo12:str_24
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #19      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x9, str_25
    add     x9, x9, :lo12:str_25
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #7      // str len
    bl      __print_str
    bl      __print_space
    adrp    x11, str_26
    add     x11, x11, :lo12:str_26
    mov     x12, #0
    mov     x13, #12
    // substr(str, start, length)
    add     x14, x11, x12   // ptr = str + start
    sub     sp, sp, #64             // buffer para substr
    mov     x15, sp            // destino
    mov     x0, x15            // destino
    mov     x1, x14            // origen = str + start
    mov     x2, x13         // bytes a copiar
    bl      __memcpy
    add     x9, x15, x13
    strb    wzr, [x9]               // null terminator
    mov     x10, x15    // retornar ptr subcadena
    // fmt.Println arg[1] tipo=string
    mov     x0, x10
    bl      __strlen
    mov     x1, x0
    mov     x0, x10
    bl      __print_str
    bl      __print_newline
    adrp    x9, str_27
    add     x9, x9, :lo12:str_27
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #19      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_28
    add     x10, x10, :lo12:str_28
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #6      // str len
    bl      __print_str
    bl      __print_space
    // typeOf(42)
    adrp    x11, str_29
    add     x11, x11, :lo12:str_29
    // fmt.Println arg[1] tipo=string
    mov     x0, x11
    bl      __strlen
    mov     x1, x0
    mov     x0, x11
    bl      __print_str
    bl      __print_newline
    adrp    x12, str_30
    add     x12, x12, :lo12:str_30
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #8      // str len
    bl      __print_str
    bl      __print_space
    // typeOf(3.14)
    adrp    x13, str_31
    add     x13, x13, :lo12:str_31
    // fmt.Println arg[1] tipo=string
    mov     x0, x13
    bl      __strlen
    mov     x1, x0
    mov     x0, x13
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_32
    add     x14, x14, :lo12:str_32
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_space
    // typeOf(true)
    adrp    x15, str_33
    add     x15, x15, :lo12:str_33
    // fmt.Println arg[1] tipo=string
    mov     x0, x15
    bl      __strlen
    mov     x1, x0
    mov     x0, x15
    bl      __print_str
    bl      __print_newline
    adrp    x9, str_34
    add     x9, x9, :lo12:str_34
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #7      // str len
    bl      __print_str
    bl      __print_space
    // typeOf("texto")
    adrp    x10, str_35
    add     x10, x10, :lo12:str_35
    // fmt.Println arg[1] tipo=string
    mov     x0, x10
    bl      __strlen
    mov     x1, x0
    mov     x0, x10
    bl      __print_str
    bl      __print_newline
    adrp    x11, str_36
    add     x11, x11, :lo12:str_36
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
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
    adrp    x9, str_37
    add     x9, x9, :lo12:str_37
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #3      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_38
    add     x10, x10, :lo12:str_38
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x11, str_39
    add     x11, x11, :lo12:str_39
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
    str     x0, [sp, #0]   // param: base
    str     x1, [sp, #8]   // param: altura
    ldr     x9, [sp, #0]   // load base
    str     x9, [sp, #16]   // save left operand
    ldr     x10, [sp, #0]   // load base
    ldr     x11, [sp, #16]   // reload left operand
    mul     x12, x11, x10
    str     x12, [sp, #24]   // save left operand
    ldr     x13, [sp, #8]   // load altura
    ldr     x14, [sp, #24]   // reload left operand
    mul     x15, x14, x13
    str     x15, [sp, #32]   // save left operand
    mov     x9, #3   // float 3.0 como entero
    ldr     x10, [sp, #32]   // reload left operand
    cbnz    x9, div_ok_0   // check div by zero
    mov     x0, #0
    mov     x8, #93               // exit si div/0
    svc     #0
div_ok_0:
    sdiv    x11, x10, x9
    mov     x0, x11   // return value
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
    str     x0, [sp, #0]   // param: x
    str     x1, [sp, #8]   // param: y
    ldr     x10, [sp, #0]   // load x
    ldr     x9, [x10]   // *ptr
    str     x9, [sp, #16]   // decl temp
    ldr     x12, [sp, #8]   // load y
    ldr     x11, [x12]   // *ptr
    ldr     x13, [sp, #0]   // load ptr addr
    str     x11, [x13]   // *x = val
    ldr     x14, [sp, #16]   // load temp
    ldr     x15, [sp, #8]   // load ptr addr
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
    str     x0, [sp, #0]   // param: arr
    mov     x9, #0
    str     x9, [sp, #8]   // decl i
for_start_1:
    ldr     x10, [sp, #8]   // load i
    mov     x11, #4
    cmp     x10, x11
    b.lt    rel_true_4
    mov     x12, #0
    b       rel_end_5
rel_true_4:
    mov     x12, #1
rel_end_5:
    cmp     x12, #0
    b.eq    for_end_3
    ldr     x13, [sp, #8]   // load i
    str     x13, [sp, #16]   // decl min
    ldr     x14, [sp, #8]   // load i
    mov     x15, #1
    add     x9, x14, x15
    str     x9, [sp, #24]   // decl j
for_start_6:
    ldr     x10, [sp, #24]   // load j
    mov     x11, #5
    cmp     x10, x11
    b.lt    rel_true_9
    mov     x12, #0
    b       rel_end_10
rel_true_9:
    mov     x12, #1
rel_end_10:
    cmp     x12, #0
    b.eq    for_end_8
    ldr     x13, [sp, #0]   // load arr
    ldr     x14, [sp, #24]   // load j
    ldr     x15, [x13]   // deref ptr → base real de arr
    add     x9, x15, x14, lsl #3   // arr[i]
    ldr     x10, [x9]   // load elem
    ldr     x11, [sp, #0]   // load arr
    ldr     x12, [sp, #16]   // load min
    ldr     x13, [x11]   // deref ptr → base real de arr
    add     x14, x13, x12, lsl #3   // arr[i]
    ldr     x15, [x14]   // load elem
    cmp     x10, x15
    b.lt    rel_true_13
    mov     x9, #0
    b       rel_end_14
rel_true_13:
    mov     x9, #1
rel_end_14:
    cmp     x9, #0
    b.eq    if_end_12
    ldr     x10, [sp, #24]   // load j
    str     x10, [sp, #16]   // min = val
if_end_12:
for_update_7:
    ldr     x11, [sp, #24]   // load j
    add     x12, x11, #1   // j++
    str     x12, [sp, #24]   // store j
    b       for_start_6
for_end_8:
    ldr     x13, [sp, #16]   // load min
    ldr     x14, [sp, #8]   // load i
    cmp     x13, x14
    b.ne    eq_true_17
    mov     x15, #0
    b       eq_end_18
eq_true_17:
    mov     x15, #1
eq_end_18:
    cmp     x15, #0
    b.eq    if_end_16
    ldr     x9, [sp, #0]   // load arr
    ldr     x10, [sp, #8]   // load i
    ldr     x11, [x9]   // deref ptr → base real de arr
    add     x12, x11, x10, lsl #3   // arr[i]
    ldr     x13, [x12]   // load elem
    str     x13, [sp, #32]   // decl temp
    ldr     x14, [sp, #0]   // load arr
    ldr     x15, [sp, #16]   // load min
    ldr     x9, [x14]   // deref ptr → base real de arr
    add     x10, x9, x15, lsl #3   // arr[i]
    ldr     x11, [x10]   // load elem
    ldr     x12, [sp, #8]   // índice i
    ldr     x13, [sp, #0]   // load ptr → &arr_caller
    ldr     x15, [x13]             // deref → base real de arr
    add     x14, x15, x12, lsl #3   // addr arr[i]
    str     x11, [x14]   // arr[i] = val
    ldr     x9, [sp, #32]   // load temp
    ldr     x10, [sp, #16]   // índice min
    ldr     x11, [sp, #0]   // load ptr → &arr_caller
    ldr     x13, [x11]             // deref → base real de arr
    add     x12, x13, x10, lsl #3   // addr arr[i]
    str     x9, [x12]   // arr[i] = val
if_end_16:
for_update_2:
    ldr     x14, [sp, #8]   // load i
    add     x15, x14, #1   // i++
    str     x15, [sp, #8]   // store i
    b       for_start_1
for_end_3:
ordenamientoSeleccion_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: potencia ──────────────────────────
potencia:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [sp, #0]   // param: base
    str     x1, [sp, #8]   // param: exponente
    ldr     x9, [sp, #8]   // load exponente
    mov     x10, #0
    cmp     x9, x10
    b.eq    eq_true_21
    mov     x11, #0
    b       eq_end_22
eq_true_21:
    mov     x11, #1
eq_end_22:
    cmp     x11, #0
    b.eq    if_end_20
    mov     x12, #1
    mov     x0, x12   // return value
    b       potencia_end   // return
if_end_20:
    ldr     x13, [sp, #0]   // load base
    str     x13, [sp, #16]   // save left operand
    mov     x14, #0   // ref a potencia
    ldr     x15, [sp, #0]   // load base
    mov     x0, x15   // arg[0]
    ldr     x9, [sp, #8]   // load exponente
    mov     x10, #1
    sub     x11, x9, x10
    mov     x1, x11   // arg[1]
    bl      potencia   // call potencia
    mov     x12, x0   // return value
    ldr     x13, [sp, #16]   // reload left operand
    mul     x14, x13, x12
    mov     x0, x14   // return value
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
    str     x0, [sp, #0]   // param: a
    str     x1, [sp, #8]   // param: b
    ldr     x9, [sp, #8]   // load b
    mov     x10, #0
    cmp     x9, x10
    b.eq    eq_true_25
    mov     x11, #0
    b       eq_end_26
eq_true_25:
    mov     x11, #1
eq_end_26:
    cmp     x11, #0
    b.eq    if_end_24
    ldr     x12, [sp, #0]   // load a
    mov     x0, x12   // return value[0]
    mov     x13, #1
    mov     x1, x13   // return value[1]
    b       euclides_end   // return
if_end_24:
    mov     x14, #0   // ref a euclides
    ldr     x15, [sp, #8]   // load b
    mov     x0, x15   // arg[0]
    ldr     x9, [sp, #0]   // load a
    str     x9, [sp, #16]   // save left operand
    ldr     x10, [sp, #8]   // load b
    ldr     x11, [sp, #16]   // reload left operand
    cbnz    x10, mod_ok_27   // check mod by zero
    mov     x0, #0
    mov     x8, #93
    svc     #0
mod_ok_27:
    sdiv    x13, x11, x10
    msub    x12, x13, x10, x11
    mov     x1, x12   // arg[1]
    bl      euclides   // call euclides
    mov     x14, x0   // return value
    str     x0, [sp, #24]   // decl resultado (ret 0)
    str     x1, [sp, #32]   // decl pasos (ret 1)
    ldr     x15, [sp, #24]   // load resultado
    mov     x0, x15   // return value[0]
    ldr     x9, [sp, #32]   // load pasos
    mov     x10, #1
    add     x11, x9, x10
    mov     x1, x11   // return value[1]
    b       euclides_end   // return
euclides_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: intercambioValoresValidado ──────────────────────────
intercambioValoresValidado:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [sp, #0]   // param: x
    str     x1, [sp, #8]   // param: y
    ldr     x10, [sp, #0]   // load x
    mov     x11, #0   // nil
    cmp     x10, x11
    b.ne    eq_true_32
    mov     x12, #0
    b       eq_end_33
eq_true_32:
    mov     x12, #1
eq_end_33:
    cmp     x12, #0
    b.eq    and_false_30   // cortocircuito &&
    ldr     x13, [sp, #8]   // load y
    mov     x14, #0   // nil
    cmp     x13, x14
    b.ne    eq_true_34
    mov     x15, #0
    b       eq_end_35
eq_true_34:
    mov     x15, #1
eq_end_35:
    cmp     x15, #0
    b.eq    and_false_30   // cortocircuito &&
    mov     x9, #1
    b       and_end_31
and_false_30:
    mov     x9, #0
and_end_31:
    cmp     x9, #0
    b.eq    if_end_29
    ldr     x10, [sp, #0]   // load x
    ldr     x9, [x10]   // *ptr
    str     x9, [sp, #16]   // decl temp
    ldr     x12, [sp, #8]   // load y
    ldr     x11, [x12]   // *ptr
    ldr     x13, [sp, #0]   // load ptr addr
    str     x11, [x13]   // *x = val
    ldr     x14, [sp, #16]   // load temp
    ldr     x15, [sp, #8]   // load ptr addr
    str     x14, [x15]   // *y = val
if_end_29:
intercambioValoresValidado_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: intercalacion ──────────────────────────
intercalacion:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [sp, #0]   // param: arr
    mov     x9, #0
    str     x9, [sp, #8]   // decl i
for_start_36:
    ldr     x10, [sp, #8]   // load i
    mov     x11, #5
    cmp     x10, x11
    b.lt    rel_true_39
    mov     x12, #0
    b       rel_end_40
rel_true_39:
    mov     x12, #1
rel_end_40:
    cmp     x12, #0
    b.eq    for_end_38
    mov     x13, #0
    str     x13, [sp, #16]   // decl j
for_start_41:
    ldr     x14, [sp, #16]   // load j
    mov     x15, #5
    ldr     x9, [sp, #8]   // load i
    sub     x10, x15, x9
    cmp     x14, x10
    b.lt    rel_true_44
    mov     x11, #0
    b       rel_end_45
rel_true_44:
    mov     x11, #1
rel_end_45:
    cmp     x11, #0
    b.eq    for_end_43
    ldr     x12, [sp, #0]   // load arr
    ldr     x13, [sp, #16]   // load j
    ldr     x14, [x12]   // deref ptr → base real de arr
    add     x15, x14, x13, lsl #3   // arr[i]
    ldr     x9, [x15]   // load elem
    ldr     x10, [sp, #0]   // load arr
    ldr     x11, [sp, #16]   // load j
    mov     x12, #1
    add     x13, x11, x12
    ldr     x14, [x10]   // deref ptr → base real de arr
    add     x15, x14, x13, lsl #3   // arr[i]
    ldr     x9, [x15]   // load elem
    cmp     x9, x9
    b.gt    rel_true_48
    mov     x10, #0
    b       rel_end_49
rel_true_48:
    mov     x10, #1
rel_end_49:
    cmp     x10, #0
    b.eq    if_end_47
    ldr     x11, [sp, #0]   // load arr
    ldr     x12, [sp, #16]   // load j
    ldr     x13, [x11]   // deref ptr → base real de arr
    add     x14, x13, x12, lsl #3   // arr[i]
    ldr     x15, [x14]   // load elem
    str     x15, [sp, #24]   // decl temp
    ldr     x9, [sp, #0]   // load arr
    ldr     x10, [sp, #16]   // load j
    mov     x11, #1
    add     x12, x10, x11
    ldr     x13, [x9]   // deref ptr → base real de arr
    add     x14, x13, x12, lsl #3   // arr[i]
    ldr     x15, [x14]   // load elem
    ldr     x9, [sp, #16]   // índice j
    ldr     x10, [sp, #0]   // load ptr → &arr_caller
    ldr     x12, [x10]             // deref → base real de arr
    add     x11, x12, x9, lsl #3   // addr arr[i]
    str     x15, [x11]   // arr[i] = val
    ldr     x13, [sp, #24]   // load temp
    mov     x14, #0   // índice desconocido
    ldr     x15, [sp, #0]   // load ptr → &arr_caller
    ldr     x10, [x15]             // deref → base real de arr
    add     x9, x10, x14, lsl #3   // addr arr[i]
    str     x13, [x9]   // arr[i] = val
if_end_47:
for_update_42:
    ldr     x11, [sp, #16]   // load j
    add     x12, x11, #1   // j++
    str     x12, [sp, #16]   // store j
    b       for_start_41
for_end_43:
for_update_37:
    ldr     x13, [sp, #8]   // load i
    add     x14, x13, #1   // i++
    str     x14, [sp, #8]   // store i
    b       for_start_36
for_end_38:
intercalacion_end:
    add     sp, sp, #512   // liberar variables locales
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

