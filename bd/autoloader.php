<?php

//Defino las rutas de los ficheros a utilizar
define('RUTAS', ['../bd', '../controlador', '../modelo', '../modelo/entidades', '../vista', '../vista/factura', '../vista/productos', '../vista/usuarios']);

//Funcion que realiza la autocarga
function autoloader($clase)
{
    //Comprueba cada ruta en la variable RUTAS junto con el nombre del fichero y si da con el, lo carga
    for ($i = 0; $i < count(RUTAS); $i++) {
        $filename = RUTAS[$i] . "/$clase.php";

        if (file_exists($filename)) {
            require_once $filename;
            return;
        }
    }
}

spl_autoload_register("autoloader");
