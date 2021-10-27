<?php

if (!isset($_REQUEST['p'])) {
    call_user_func(array(new ProductoController(), 'index'));
} else {
    $controlador = new (ucwords(strtolower($_REQUEST['p'])) . 'Controller');
    $accion = isset($_REQUEST['a']) ? strtolower($_REQUEST['a']) : 'index';

    call_user_func(array($controlador, $accion));
}