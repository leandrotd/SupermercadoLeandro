<?php
//Recojo la dirección a la página a acceder
$direccion =  substr($_SERVER['REQUEST_URI'], 21);

//Compruebo si no llama a ningun archivo o solo a index.php
if (strlen($direccion) == 0 || strlen($direccion) == 9) {
    //Llamo a la pagina por defecto
    call_user_func(array(new ProductoController(), 'lista'));
} else {
    //Recojo el nombre del controlador y la página a visualizar
    $controlador = explode("/", $direccion)[1];
    $controlador = new (ucwords($controlador) . 'Controller');

    $accion = isset(explode("/", $direccion)[2]) ? explode("?", explode("/", $direccion)[2])[0] : 'lista';

    //Llamo a la funcion correspondiente
    call_user_func(array($controlador, $accion));
}
