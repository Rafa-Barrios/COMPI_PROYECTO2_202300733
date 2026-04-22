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
str_0: .asciz "Suma:"
__space: .ascii " "
str_1: .asciz "Asignacion:"
str_2: .asciz "mayor que 5"
str_3: .asciz "menor o igual a 5"

.section .text
.align 2
.global _start

_start:
    bl      main
    mov     x0, #0
    mov     x8, #93        // syscall exit
    svc     #0

# ── Función: suma ──────────────────────────
suma:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: a
    str     x1, [x29, #-16]   // param: b
    ldr     x9, [x29, #-8]   // load a
    ldr     x10, [x29, #-16]   // load b
    add     x11, x9, x10
    mov     x0, x11   // return value
    b       suma_end   // return
suma_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: main ──────────────────────────
main:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #496   // espacio variables locales
    mov     x9, #0   // ref a suma
    str     x9, [x29, #-8]   // var resultado
    adrp    x10, str_0
    add     x10, x10, :lo12:str_0
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-8]   // load resultado
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
    mov     x12, #100
    str     x12, [x29, #-16]   // var a
    mov     x13, #200
    str     x13, [x29, #-24]   // var b
    ldr     x14, [x29, #-24]   // load b
    str     x14, [x29, #-16]   // a = val
    adrp    x15, str_1
    add     x15, x15, :lo12:str_1
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #11      // str len
    bl      __print_str
    bl      __print_space
    ldr     x9, [x29, #-16]   // load a
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    mov     x10, #7
    str     x10, [x29, #-32]   // var x
    ldr     x11, [x29, #-32]   // load x
    mov     x12, #5
    cmp     x11, x12
    b.gt    rel_true_2
    mov     x13, #0
    b       rel_end_3
rel_true_2:
    mov     x13, #1
rel_end_3:
    cmp     x13, #0
    b.eq    if_else_0
    adrp    x14, str_2
    add     x14, x14, :lo12:str_2
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #11      // str len
    bl      __print_str
    bl      __print_newline
    b       if_end_1
if_else_0:
    adrp    x15, str_3
    add     x15, x15, :lo12:str_3
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #17      // str len
    bl      __print_str
    bl      __print_newline
if_end_1:
    mov     x9, #1
    str     x9, [x29, #-40]   // var i
for_start_4:
    ldr     x10, [x29, #-40]   // load i
    mov     x11, #4
    cmp     x10, x11
    b.lt    rel_true_7
    mov     x12, #0
    b       rel_end_8
rel_true_7:
    mov     x12, #1
rel_end_8:
    cmp     x12, #0
    b.eq    for_end_6
    ldr     x13, [x29, #-40]   // load i
    // fmt.Println arg[0] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_newline
    mov     x14, #1
    ldr     x15, [x29, #-40]   // load i
    add     x9, x15, x14
    str     x9, [x29, #-40]   // i = val
for_update_5:
    b       for_start_4
for_end_6:
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

