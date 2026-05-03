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
str_0: .asciz "=== INICIO DE CALIFICACION: ARREGLOS ==="
str_1: .asciz "\n--- 5.1 DECLARACION MULTIDIMENSIONAL ---"
str_2: .asciz "Matriz no inicializada [1][1]:"
__space: .ascii " "
str_3: .asciz "Matriz inicializada [0][0]:"
str_4: .asciz "\n--- 5.2 ACCESO Y MODIFICACION MULTIDIMENSIONAL ---"
str_5: .asciz "Original matrizNoInit[0][1]:"
str_6: .asciz "Modificado matrizNoInit[0][1]:"
str_7: .asciz "\n=== FIN DE CALIFICACION: ARREGLOS ==="

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
    mov     x1, #40      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x10, str_1
    add     x10, x10, :lo12:str_1
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #41      // str len
    bl      __print_str
    bl      __print_newline
    str     xzr, [sp, #0]   // var matrizNoInit[0] = 0
    str     xzr, [sp, #8]   // var matrizNoInit[1] = 0
    str     xzr, [sp, #16]   // var matrizNoInit[2] = 0
    str     xzr, [sp, #24]   // var matrizNoInit[3] = 0
    mov     x11, #0   // elem default
    str     x11, [sp, #32]   // arr[0]
    mov     x12, #0   // elem default
    str     x12, [sp, #40]   // arr[1]
    add     x13, sp, #32   // base del array
    str     x13, [sp, #48]   // decl matrizInit
    adrp    x14, str_2
    add     x14, x14, :lo12:str_2
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #30      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [sp, #0]   // load matrizNoInit
    mov     x9, #1
    mov     x10, x15   // base de matrizNoInit
    add     x11, x10, x9, lsl #3   // matrizNoInit[i]
    mov     x13, #1
    mov     x14, x11   // base encadenada
    add     x15, x14, x13, lsl #3   // [i]
    ldr     x9, [x15]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x10, str_3
    add     x10, x10, :lo12:str_3
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #27      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [sp, #48]   // load matrizInit
    mov     x12, #0
    mov     x13, x11   // base de matrizInit
    add     x14, x13, x12, lsl #3   // matrizInit[i]
    mov     x9, #0
    mov     x10, x14   // base encadenada
    add     x11, x10, x9, lsl #3   // [i]
    ldr     x12, [x11]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_4
    add     x13, x13, :lo12:str_4
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #51      // str len
    bl      __print_str
    bl      __print_newline
    adrp    x14, str_5
    add     x14, x14, :lo12:str_5
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #28      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [sp, #0]   // load matrizNoInit
    mov     x9, #0
    mov     x10, x15   // base de matrizNoInit
    add     x11, x10, x9, lsl #3   // matrizNoInit[i]
    mov     x13, #1
    mov     x14, x11   // base encadenada
    add     x15, x14, x13, lsl #3   // [i]
    ldr     x9, [x15]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    mov     x10, #77
    mov     x11, #0   // índice desconocido
    ldr     x12, [sp, #0]   // base de matrizNoInit
    add     x13, x12, x11, lsl #3   // addr matrizNoInit[i]
    str     x10, [x13]   // matrizNoInit[i] = val
    adrp    x14, str_6
    add     x14, x14, :lo12:str_6
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #30      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [sp, #0]   // load matrizNoInit
    mov     x9, #0
    mov     x10, x15   // base de matrizNoInit
    add     x11, x10, x9, lsl #3   // matrizNoInit[i]
    mov     x13, #1
    mov     x14, x11   // base encadenada
    add     x15, x14, x13, lsl #3   // [i]
    ldr     x9, [x15]   // load elem
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    adrp    x10, str_7
    add     x10, x10, :lo12:str_7
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #38      // str len
    bl      __print_str
    bl      __print_newline
main_end:
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

