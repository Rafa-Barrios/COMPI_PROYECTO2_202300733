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
str_0: .asciz "=== INICIO DE CALIFICACION: ESTRUCTURAS DE CONTROL ==="
str_1: .asciz "Ana"
str_2: .asciz "\n--- 2.2 IF ---"
str_3: .asciz "El estudiante"
__space: .ascii " "
str_4: .asciz "tiene una nota mayor a 80"
str_5: .asciz "\n--- 2.3 IF ELSE ---"
str_6: .asciz "Clasificacion: SOBRESALIENTE"
str_7: .asciz "Clasificacion: EXCELENTE"
str_8: .asciz "Clasificacion: REGULAR"
str_9: .asciz "\n--- 2.4 SWITCH CASE DEFAULT ---"
str_10: .asciz "Categoria 1: Principiante"
str_11: .asciz "Categoria 2: Intermedio"
str_12: .asciz "Categoria 3: Avanzado"
str_13: .asciz "Categoria Desconocida"
str_14: .asciz "\n--- 2.5 FOR CLASICO ---"
str_15: .asciz "Iteracion:"
str_16: .asciz "\n--- 2.6 FOR CONDICIONAL ---"
str_17: .asciz "Cuenta regresiva:"
str_18: .asciz "\n--- 2.7 FOR INFINITO ---"
str_19: .asciz "Intento:"
str_20: .asciz "\n--- 2.8 BREAK ---"
str_21: .asciz "Se encontro 7, se aplica break"
str_22: .asciz "\n--- 2.9 CONTINUE ---"
str_23: .asciz "Impar:"
str_24: .asciz "\n=== FIN DE CALIFICACION: ESTRUCTURAS DE CONTROL ==="

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
    mov     x1, #54      // str len
    bl      __print_str
    bl      __print_newline
    mov     x10, #85
    str     x10, [x29, #-8]   // decl nota1
    mov     x11, #92
    str     x11, [x29, #-16]   // decl nota2
    adrp    x12, str_1
    add     x12, x12, :lo12:str_1
    str     x12, [x29, #-24]   // decl estudiante
    adrp    x13, str_2
    add     x13, x13, :lo12:str_2
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #15      // str len
    bl      __print_str
    bl      __print_newline
    ldr     x14, [x29, #-8]   // load nota1
    mov     x15, #80
    cmp     x14, x15
    b.gt    rel_true_2
    mov     x9, #0
    b       rel_end_3
rel_true_2:
    mov     x9, #1
rel_end_3:
    cmp     x9, #0
    b.eq    if_end_1
    adrp    x10, str_3
    add     x10, x10, :lo12:str_3
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #13      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-24]   // load estudiante
    // fmt.Println arg[1] tipo=string
    mov     x0, x11
    bl      __strlen
    mov     x1, x0
    mov     x0, x11
    bl      __print_str
    bl      __print_space
    adrp    x12, str_4
    add     x12, x12, :lo12:str_4
    // fmt.Println arg[2] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #25      // str len
    bl      __print_str
    bl      __print_newline
if_end_1:
    adrp    x13, str_5
    add     x13, x13, :lo12:str_5
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #20      // str len
    bl      __print_str
    bl      __print_newline
    ldr     x14, [x29, #-16]   // load nota2
    mov     x15, #95
    cmp     x14, x15
    b.ge    rel_true_6
    mov     x9, #0
    b       rel_end_7
rel_true_6:
    mov     x9, #1
rel_end_7:
    cmp     x9, #0
    b.eq    if_else_4
    adrp    x10, str_6
    add     x10, x10, :lo12:str_6
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #28      // str len
    bl      __print_str
    bl      __print_newline
    b       if_end_5
if_else_4:
    ldr     x11, [x29, #-16]   // load nota2
    mov     x12, #90
    cmp     x11, x12
    b.ge    rel_true_10
    mov     x13, #0
    b       rel_end_11
rel_true_10:
    mov     x13, #1
rel_end_11:
    cmp     x13, #0
    b.eq    if_else_8
    adrp    x14, str_7
    add     x14, x14, :lo12:str_7
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #24      // str len
    bl      __print_str
    bl      __print_newline
    b       if_end_9
if_else_8:
    adrp    x15, str_8
    add     x15, x15, :lo12:str_8
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #22      // str len
    bl      __print_str
    bl      __print_newline
if_end_9:
if_end_5:
    adrp    x9, str_9
    add     x9, x9, :lo12:str_9
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #32      // str len
    bl      __print_str
    bl      __print_newline
    mov     x10, #2
    str     x10, [x29, #-32]   // decl codigoCategoria
    ldr     x11, [x29, #-32]   // load codigoCategoria
    str     x11, [x29, #-40]   // switch value
    mov     x12, #1
    ldr     x13, [x29, #-40]   // load switch value
    cmp     x13, x12
    b.eq    case_13
    mov     x14, #2
    ldr     x15, [x29, #-40]   // load switch value
    cmp     x15, x14
    b.eq    case_14
    mov     x9, #3
    ldr     x10, [x29, #-40]   // load switch value
    cmp     x10, x9
    b.eq    case_15
    b       case_default_16
case_13:
    adrp    x11, str_10
    add     x11, x11, :lo12:str_10
    // fmt.Println arg[0] tipo=string
    mov     x0, x11         // str addr
    mov     x1, #25      // str len
    bl      __print_str
    bl      __print_newline
    b       switch_end_12
case_14:
    adrp    x12, str_11
    add     x12, x12, :lo12:str_11
    // fmt.Println arg[0] tipo=string
    mov     x0, x12         // str addr
    mov     x1, #23      // str len
    bl      __print_str
    bl      __print_newline
    b       switch_end_12
case_15:
    adrp    x13, str_12
    add     x13, x13, :lo12:str_12
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #21      // str len
    bl      __print_str
    bl      __print_newline
    b       switch_end_12
case_default_16:
    adrp    x14, str_13
    add     x14, x14, :lo12:str_13
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #21      // str len
    bl      __print_str
    bl      __print_newline
switch_end_12:
    adrp    x15, str_14
    add     x15, x15, :lo12:str_14
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #24      // str len
    bl      __print_str
    bl      __print_newline
    mov     x9, #1
    str     x9, [x29, #-48]   // decl i
for_start_17:
    ldr     x10, [x29, #-48]   // load i
    mov     x11, #5
    cmp     x10, x11
    b.le    rel_true_20
    mov     x12, #0
    b       rel_end_21
rel_true_20:
    mov     x12, #1
rel_end_21:
    cmp     x12, #0
    b.eq    for_end_19
    adrp    x13, str_15
    add     x13, x13, :lo12:str_15
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #10      // str len
    bl      __print_str
    bl      __print_space
    ldr     x14, [x29, #-48]   // load i
    // fmt.Println arg[1] tipo=int
    mov     x0, x14
    bl      __print_int
    bl      __print_newline
for_update_18:
    ldr     x15, [x29, #-48]   // load i
    add     x9, x15, #1   // i++
    str     x9, [x29, #-48]   // store i
    b       for_start_17
for_end_19:
    adrp    x10, str_16
    add     x10, x10, :lo12:str_16
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #28      // str len
    bl      __print_str
    bl      __print_newline
    mov     x11, #10
    str     x11, [x29, #-56]   // decl contador
for_start_22:
    ldr     x12, [x29, #-56]   // load contador
    mov     x13, #0
    cmp     x12, x13
    b.gt    rel_true_25
    mov     x14, #0
    b       rel_end_26
rel_true_25:
    mov     x14, #1
rel_end_26:
    cmp     x14, #0
    b.eq    for_end_24
    adrp    x15, str_17
    add     x15, x15, :lo12:str_17
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #17      // str len
    bl      __print_str
    bl      __print_space
    ldr     x9, [x29, #-56]   // load contador
    // fmt.Println arg[1] tipo=int
    mov     x0, x9
    bl      __print_int
    bl      __print_newline
    mov     x10, #3
    ldr     x11, [x29, #-56]   // load contador
    sub     x12, x11, x10
    str     x12, [x29, #-56]   // contador = val
for_update_23:
    b       for_start_22
for_end_24:
    adrp    x13, str_18
    add     x13, x13, :lo12:str_18
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #25      // str len
    bl      __print_str
    bl      __print_newline
    mov     x14, #0
    str     x14, [x29, #-64]   // decl intentos
for_start_27:
    ldr     x15, [x29, #-64]   // load intentos
    add     x9, x15, #1   // intentos++
    str     x9, [x29, #-64]   // store intentos
    adrp    x10, str_19
    add     x10, x10, :lo12:str_19
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #8      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-64]   // load intentos
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
    ldr     x12, [x29, #-64]   // load intentos
    mov     x13, #3
    cmp     x12, x13
    b.eq    eq_true_32
    mov     x14, #0
    b       eq_end_33
eq_true_32:
    mov     x14, #1
eq_end_33:
    cmp     x14, #0
    b.eq    if_end_31
    b       for_end_29   // break
if_end_31:
for_update_28:
    b       for_start_27
for_end_29:
    adrp    x15, str_20
    add     x15, x15, :lo12:str_20
    // fmt.Println arg[0] tipo=string
    mov     x0, x15         // str addr
    mov     x1, #18      // str len
    bl      __print_str
    bl      __print_newline
    mov     x9, #1
    str     x9, [x29, #-48]   // reassign i
for_start_34:
    ldr     x10, [x29, #-48]   // load i
    mov     x11, #20
    cmp     x10, x11
    b.le    rel_true_37
    mov     x12, #0
    b       rel_end_38
rel_true_37:
    mov     x12, #1
rel_end_38:
    cmp     x12, #0
    b.eq    for_end_36
    ldr     x13, [x29, #-48]   // load i
    mov     x14, #7
    cmp     x13, x14
    b.eq    eq_true_41
    mov     x15, #0
    b       eq_end_42
eq_true_41:
    mov     x15, #1
eq_end_42:
    cmp     x15, #0
    b.eq    if_end_40
    adrp    x9, str_21
    add     x9, x9, :lo12:str_21
    // fmt.Println arg[0] tipo=string
    mov     x0, x9         // str addr
    mov     x1, #30      // str len
    bl      __print_str
    bl      __print_newline
    b       for_end_36   // break
if_end_40:
    ldr     x10, [x29, #-48]   // load i
    // fmt.Println arg[0] tipo=int
    mov     x0, x10
    bl      __print_int
    bl      __print_newline
for_update_35:
    ldr     x11, [x29, #-48]   // load i
    add     x12, x11, #1   // i++
    str     x12, [x29, #-48]   // store i
    b       for_start_34
for_end_36:
    adrp    x13, str_22
    add     x13, x13, :lo12:str_22
    // fmt.Println arg[0] tipo=string
    mov     x0, x13         // str addr
    mov     x1, #21      // str len
    bl      __print_str
    bl      __print_newline
    mov     x14, #1
    str     x14, [x29, #-72]   // decl j
for_start_43:
    ldr     x15, [x29, #-72]   // load j
    mov     x9, #6
    cmp     x15, x9
    b.le    rel_true_46
    mov     x10, #0
    b       rel_end_47
rel_true_46:
    mov     x10, #1
rel_end_47:
    cmp     x10, #0
    b.eq    for_end_45
    ldr     x11, [x29, #-72]   // load j
    mov     x12, #2
    cbnz    x12, mod_ok_50   // check mod by zero
    mov     x0, #0
    mov     x8, #93
    svc     #0
mod_ok_50:
    sdiv    x14, x11, x12
    msub    x13, x14, x12, x11
    mov     x15, #0
    cmp     x13, x15
    b.eq    eq_true_51
    mov     x9, #0
    b       eq_end_52
eq_true_51:
    mov     x9, #1
eq_end_52:
    cmp     x9, #0
    b.eq    if_end_49
    b       for_update_44   // continue
if_end_49:
    adrp    x10, str_23
    add     x10, x10, :lo12:str_23
    // fmt.Println arg[0] tipo=string
    mov     x0, x10         // str addr
    mov     x1, #6      // str len
    bl      __print_str
    bl      __print_space
    ldr     x11, [x29, #-72]   // load j
    // fmt.Println arg[1] tipo=int
    mov     x0, x11
    bl      __print_int
    bl      __print_newline
for_update_44:
    ldr     x12, [x29, #-72]   // load j
    add     x13, x12, #1   // j++
    str     x13, [x29, #-72]   // store j
    b       for_start_43
for_end_45:
    adrp    x14, str_24
    add     x14, x14, :lo12:str_24
    // fmt.Println arg[0] tipo=string
    mov     x0, x14         // str addr
    mov     x1, #52      // str len
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

