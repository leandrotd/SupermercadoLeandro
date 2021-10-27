<?php

define('RUTAS', ['../bd', '../controlador', '../modelo', '../modelo/entidades', '../vista', '../vista/factura', '../vista/productos', '../vista/usuarios']);

function autoloader($clase)
{
    for ($i = 0; $i < count(RUTAS); $i++) {
        $filename = RUTAS[$i] . "/$clase.php";

        if (file_exists($filename)) {
            require_once $filename;
            return;
        }
    }
}

spl_autoload_register("autoloader");
