<?php

class ProductoController {

    public function index() {
        require_once 'vista/header.view.php';
        require_once 'vista/productos/productos.lista.view.php';
        require_once 'vista/footer.view.php';
    }

}