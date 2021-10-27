<?php

if (!isset($_REQUEST['p'])) {
    //Llamada a la página principal
    call_user_func(array(new ProductoController(), 'index'));
} else {
    //Obtenemos el controlador a utilizar
    $controlador = new (ucwords(strtolower($_REQUEST['p'])) . 'Controller');
    
    //Recogemos la accion a realizar
    $accion = isset($_REQUEST['a']) ? strtolower($_REQUEST['a']) : 'index';

    //Ejecutamos
    call_user_func(array($controlador, $accion));
}