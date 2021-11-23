<?php

class UsuarioController
{
    public function detalles()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/usuarios/usuarios.detalles.view.php';
        require_once 'vista/footer.view.php';
    }

    public function login()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/usuarios/usuarios.login.view.php';
        require_once 'vista/footer.view.php';
    }

    public function registro()
    {
        require_once 'vista/header.view.php';
        require_once 'vista/usuarios/usuarios.registro.view.php';
        require_once 'vista/footer.view.php';
    }
}
