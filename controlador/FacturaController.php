<?php

class FacturaController
{
    public function detalles()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/factura/factura.detalles.view.php';
        require_once 'vista/footer.view.php';
    }

    public function fin()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/factura/factura.fin.view.php';
        require_once 'vista/footer.view.php';
    }
}
