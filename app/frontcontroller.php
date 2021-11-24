<?php
$direccion =  substr($_SERVER['REQUEST_URI'], 21);
if (strlen($direccion) == 0 || strlen($direccion) == 9) {
    //Llamada a la página principal
    call_user_func(array(new ProductoController(), 'lista'));
} else {
    $controlador = explode("/", $direccion)[1];
    $controlador = new (ucwords($controlador) . 'Controller');

    $accion = isset(explode("/", $direccion)[2]) ? explode("/", $direccion)[2] : 'lista';

    call_user_func(array($controlador, $accion));
}
