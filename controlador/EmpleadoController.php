<?php

class EmpleadoController
{
    public function lista()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/usuarios/usuarios.lista.view.php';
        require_once 'vista/footer.view.php';
    }
}
