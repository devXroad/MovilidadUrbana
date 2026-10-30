<?php

/**
 * Autoloader del proyecto
 * Registra la función para cargar automáticamente las clases e interfaces de la carpeta app.
 */
spl_autoload_register(function (string $clase): void {
    $baseDir = dirname(__DIR__) . '/app/';

    // 1. Buscar directamente por el nombre de la clase en app/ o app/Util/
    $partes = explode('\\', $clase);
    $nombreClase = end($partes);

    if (file_exists($baseDir . $nombreClase . '.php')) {
        require_once $baseDir . $nombreClase . '.php';
    } elseif (file_exists($baseDir . 'Util/' . $nombreClase . '.php')) {
        require_once $baseDir . 'Util/' . $nombreClase . '.php';
    } else {
        // 2. Buscar según la estructura del namespace relativo quitando prefijo
        foreach (['App\\AlquilerMovilidad\\', 'App\\', 'Dwes\\AlquilerMovilidad\\', 'Dwes\\'] as $prefix) {
            if (str_starts_with($clase, $prefix)) {
                $claseRelativa = substr($clase, strlen($prefix));
                $archivoPSR4 = $baseDir . str_replace('\\', '/', $claseRelativa) . '.php';
                if (file_exists($archivoPSR4)) {
                    require_once $archivoPSR4;
                    break;
                }
            }
        }
    }

    // Compatibilidad bidireccional entre App\... y Dwes\...
    if (str_starts_with($clase, 'Dwes\\')) {
        $appClass = 'App\\' . substr($clase, 5);
        if (class_exists($appClass, false) && !class_exists($clase, false)) {
            class_alias($appClass, $clase);
        }
    } elseif (str_starts_with($clase, 'App\\')) {
        $dwesClass = 'Dwes\\' . substr($clase, 4);
        if (class_exists($dwesClass, false) && !class_exists($clase, false)) {
            class_alias($dwesClass, $clase);
        }
    }
});
