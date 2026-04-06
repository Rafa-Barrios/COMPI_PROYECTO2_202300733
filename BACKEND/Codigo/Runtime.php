<?php

class Runtime {

    // Rutas de los archivos generados
    private static $outputDir  = __DIR__ . "/../output/";
    private static $asmFile    = __DIR__ . "/../output/program.s";
    private static $objFile    = __DIR__ . "/../output/program.o";
    private static $binFile    = __DIR__ . "/../output/program";

    /*
    ========================
    GUARDAR ARCHIVO .s
    ========================
    */
    public static function saveAsm($code) {

        // Crear carpeta output si no existe
        if (!is_dir(self::$outputDir)) {
            mkdir(self::$outputDir, 0755, true);
        }

        file_put_contents(self::$asmFile, $code);
    }

    /*
    ========================
    ENSAMBLAR
    aarch64-linux-gnu-as
    ========================
    */
    public static function assemble() {

        $cmd = sprintf(
            "aarch64-linux-gnu-as %s -o %s 2>&1",
            escapeshellarg(self::$asmFile),
            escapeshellarg(self::$objFile)
        );

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            return [
                "success" => false,
                "phase"   => "ensamblaje",
                "error"   => implode("\n", $output)
            ];
        }

        return ["success" => true];
    }

    /*
    ========================
    ENLAZAR
    aarch64-linux-gnu-ld
    ========================
    */
    public static function link() {

        $cmd = sprintf(
            "aarch64-linux-gnu-ld %s -o %s 2>&1",
            escapeshellarg(self::$objFile),
            escapeshellarg(self::$binFile)
        );

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            return [
                "success" => false,
                "phase"   => "enlace",
                "error"   => implode("\n", $output)
            ];
        }

        return ["success" => true];
    }

    /*
    ========================
    EJECUTAR CON QEMU
    qemu-aarch64
    ========================
    */
    public static function execute() {

        $cmd = sprintf(
            "qemu-aarch64 %s 2>&1",
            escapeshellarg(self::$binFile)
        );

        $output = [];
        $returnCode = 0;

        exec($cmd, $output, $returnCode);

        return [
            "success"    => true,
            "output"     => implode("\n", $output),
            "returnCode" => $returnCode
        ];
    }

    /*
    ========================
    PIPELINE COMPLETO
    ========================
    */
    public static function run($asmCode) {

        // 1. Guardar el .s
        self::saveAsm($asmCode);

        // 2. Ensamblar
        $assembleResult = self::assemble();
        if (!$assembleResult["success"]) {
            \ErrorTable::add(
                "Ensamblaje",
                $assembleResult["error"],
                0,
                0
            );
            return "";
        }

        // 3. Enlazar
        $linkResult = self::link();
        if (!$linkResult["success"]) {
            \ErrorTable::add(
                "Enlace",
                $linkResult["error"],
                0,
                0
            );
            return "";
        }

        // 4. Ejecutar con QEMU
        $execResult = self::execute();

        return $execResult["output"];
    }

    /*
    ========================
    OBTENER RUTA DEL .s
    ========================
    */
    public static function getAsmPath() {
        return self::$asmFile;
    }

    /*
    ========================
    OBTENER CONTENIDO DEL .s
    ========================
    */
    public static function getAsmContent() {
        if (file_exists(self::$asmFile)) {
            return file_get_contents(self::$asmFile);
        }
        return "";
    }

    /*
    ========================
    LIMPIAR ARCHIVOS GENERADOS
    ========================
    */
    public static function clean() {
        foreach ([self::$objFile, self::$binFile] as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}