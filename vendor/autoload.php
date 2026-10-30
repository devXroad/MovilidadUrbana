<?php

/**
 * Autoloader del proyecto
 * Registra la función para cargar automáticamente las clases e interfaces de la carpeta app.
 */
spl_autoload_register(function (string $clase): void {
    $baseDir = dirname(__DIR__) . '/app/';

    // 1. Buscar directamente por el nombre de la clase en app/ (ej. app/Cliente.php)
    $partes = explode('\\', $clase);
    $nombreClase = end($partes);
    $archivoDirecto = $baseDir . $nombreClase . '.php';
    if (file_exists($archivoDirecto)) {
        require_once $archivoDirecto;
        return;
    }

    // 2. Buscar según la estructura del namespace relativo quitando el prefijo 'App\' (PSR-4)
    $prefix = 'App\\';
    if (str_starts_with($clase, $prefix)) {
        $claseRelativa = substr($clase, strlen($prefix));
    } else {
        $claseRelativa = $clase;
    }

    $archivoPSR4 = $baseDir . str_replace('\\', '/', $claseRelativa) . '.php';
    if (file_exists($archivoPSR4)) {
        require_once $archivoPSR4;
        return;
    }

    // 3. Buscar con la ruta completa del namespace
    $archivoCompleto = $baseDir . str_replace('\\', '/', $clase) . '.php';
    if (file_exists($archivoCompleto)) {
        require_once $archivoCompleto;
        return;
    }
});
