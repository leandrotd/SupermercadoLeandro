<?php

class ProductoController
{
    public function detalles()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/productos/productos.detalles.view.php';
        require_once 'vista/footer.view.php';
    }

    public function lista()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/productos/productos.lista.view.php';
        require_once 'vista/footer.view.php';
    }
}
