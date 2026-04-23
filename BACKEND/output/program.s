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
str_1: .asciz "Resta:"
str_2: .asciz "Mult:"
str_3: .asciz "Div:"
str_4: .asciz "Mod:"
str_5: .asciz "Inc:"
str_6: .asciz "Dec:"
str_7: .asciz "i:"
str_8: .asciz "div por cero evitada"
str_9: .asciz "z:"

.section .text
.align 2
.global _start

_start:
    bl      main
    mov     x0, #0
    mov     x8, #93        // syscall exit
    svc     #0

# ── Función: dividir ──────────────────────────
dividir:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #512   // espacio variables locales
    str     x0, [x29, #-8]   // param: a
    str     x1, [x29, #-16]   // param: b
    ldr     x9, [x29, #-8]   // load a
    ldr     x10, [x29, #-16]   // load b
    cbnz    x10, div_ok_0   // check div by zero
    mov     x0, #0
    mov     x8, #93               // exit si div/0
    svc     #0
div_ok_0:
    sdiv    x11, x9, x10
    mov     x0, x11   // return value
    b       dividir_end   // return
dividir_end:
    add     sp, sp, #512   // liberar variables locales
    ldp     x29, x30, [sp], #16      // restaurar fp y lr
    ret

# ── Función: main ──────────────────────────
main:
    stp     x29, x30, [sp, #-16]!   // salvar fp y lr
    mov     x29, sp
    sub     sp, sp, #496   // espacio variables locales
    mov     x9, #20
    str     x9, [x29, #-8]   // var a
    mov     x10, #4
    str     x10, [x29, #-16]   // var b
    ldr     x11, [x29, #-8]   // load a
    ldr     x12, [x29, #-16]   // load b
    add     x13, x11, x12
    str     x13, [x29, #-24]   // decl suma
    ldr     x14, [x29, #-8]   // load a
    ldr     x15, [x29, #-16]   // load b
    sub     x9, x14, x15
    str     x9, [x29, #-32]   // decl resta
    ldr     x10, [x29, #-8]   // load a
    ldr     x11, [x29, #-16]   // load b
    mul     x12, x10, x11
    str     x12, [x29, #-40]   // decl mult
    mov     x13, #0   // ref a dividir
    ldr     x14, [x29, #-8]   // load a
    mov     x0, x14   // arg[0]
    ldr     x15, [x29, #-16]   // load b
    mov     x1, x15   // arg[1]
    bl      dividir   // call dividir
    mov     x9, x0   // return value
    str     x9, [x29, #-48]   // decl div
    ldr     x10, [x29, #-8]   // load a
    ldr     x11, [x29, #-16]   // load b
    cbnz    x11, mod_ok_1   // check mod by zero
    mov     x0, #0
    mov     x8, #93
    svc     #0
mod_ok_1:
    sdiv    x13, x10, x11
    msub    x12, x13, x11, x10
    str     x12, [x29, #-56]   // decl mod
    adrp    x14, str_0
    add     x14, x14, :lo12:str_0
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_space
    ldr     x15, [x29, #-24]   // load suma
    // fmt.Println arg[1] tipo=int
    mov     x0, x15
    bl      __print_int
    bl      __print_newline
    adrp    x9, str_1
    add     x9, x9, :lo12:str_1
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #6      // str len
    bl      __print_str
    bl      __print_space
    ldr     x10, [x29, #-32]   // load resta
    // fmt.Println arg[1] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
    adrp    x11, str_2
    add     x11, x11, :lo12:str_2
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #5      // str len
    bl      __print_str
    bl      __print_space
    ldr     x12, [x29, #-40]   // load mult
    // fmt.Println arg[1] tipo=int
    mov     x0, x12
    bl      __print_int
    bl      __print_newline
    adrp    x13, str_3
    add     x13, x13, :lo12:str_3
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-48]   // load div
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    adrp    x15, str_4
    add     x15, x15, :lo12:str_4
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x9, [x29, #-56]   // load mod
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    mov     x10, #10
    str     x10, [x29, #-64]   // var c
    ldr     x11, [x29, #-64]   // load c
    add     x12, x11, #1   // c++
    str     x12, [x29, #-64]   // store c
    adrp    x13, str_5
    add     x13, x13, :lo12:str_5
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-64]   // load c
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    ldr     x15, [x29, #-64]   // load c
    sub     x9, x15, #1   // c--
    str     x9, [x29, #-64]   // store c
    ldr     x10, [x29, #-64]   // load c
    sub     x11, x10, #1   // c--
    str     x11, [x29, #-64]   // store c
    adrp    x12, str_6
    add     x12, x12, :lo12:str_6
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #4      // str len
    bl      __print_str
    bl      __print_space
    ldr     x13, [x29, #-64]   // load c
    // fmt.Println arg[1] tipo=int
    mov     x0, x13
    bl      __print_int
    bl      __print_newline
    mov     x14, #0
    str     x14, [x29, #-72]   // var i
for_start_2:
    ldr     x15, [x29, #-72]   // load i
    mov     x9, #6
    cmp     x15, x9
    b.lt    rel_true_5
    mov     x10, #0
    b       rel_end_6
rel_true_5:
    mov     x10, #1
rel_end_6:
    cmp     x10, #0
    b.eq    for_end_4
    ldr     x11, [x29, #-72]   // load i
    mov     x12, #2
    cmp     x11, x12
    b.eq    eq_true_9
    mov     x13, #0
    b       eq_end_10
eq_true_9:
    mov     x13, #1
eq_end_10:
    cmp     x13, #0
    b.eq    if_end_8
    mov     x14, #1
    ldr     x15, [x29, #-72]   // load i
    add     x9, x15, x14
    str     x9, [x29, #-72]   // i = val
    b       for_update_3   // continue
if_end_8:
    ldr     x10, [x29, #-72]   // load i
    mov     x11, #5
    cmp     x10, x11
    b.eq    eq_true_13
    mov     x12, #0
    b       eq_end_14
eq_true_13:
    mov     x12, #1
eq_end_14:
    cmp     x12, #0
    b.eq    if_end_12
    b       for_end_4   // break
if_end_12:
    adrp    x13, str_7
    add     x13, x13, :lo12:str_7
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #2      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-72]   // load i
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
    mov     x15, #1
    ldr     x9, [x29, #-72]   // load i
    add     x10, x9, x15
    str     x10, [x29, #-72]   // i = val
for_update_3:
    b       for_start_2
for_end_4:
    mov     x11, #10
    str     x11, [x29, #-80]   // var x
    mov     x12, #0
    str     x12, [x29, #-88]   // var y
    ldr     x13, [x29, #-88]   // load y
    mov     x14, #0
    cmp     x13, x14
    b.eq    eq_true_17
    mov     x15, #0
    b       eq_end_18
eq_true_17:
    mov     x15, #1
eq_end_18:
    cmp     x15, #0
    b.eq    if_else_15
    adrp    x9, str_8
    add     x9, x9, :lo12:str_8
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #20      // str len
    bl      __print_str
    bl      __print_newline
    b       if_end_16
if_else_15:
    ldr     x10, [x29, #-80]   // load x
    ldr     x11, [x29, #-88]   // load y
    cbnz    x11, div_ok_19   // check div by zero
    mov     x0, #0
    mov     x8, #93               // exit si div/0
    svc     #0
div_ok_19:
    sdiv    x12, x10, x11
    str     x12, [x29, #-96]   // var z
    adrp    x13, str_9
    add     x13, x13, :lo12:str_9
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #2      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-96]   // load z
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
if_end_16:
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

