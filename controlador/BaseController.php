<?php

//Inicio la sesion aqui debido a que es cargado independientemente de la página a cargar
session_start();
define('UNSIGNED_INT_MAX', 4294967295);

/**
 * Es utilizada como base para todos los controladores
 */
abstract class BaseController
{

    /**
     * Almacena el objeto FacturaDAO.
     *
     * @var FacturaDAO
     */
    protected $factura;

    /**
     * Almacena el objeto UsuarioDAO.
     *
     * @var UsuarioDAO
     */
    protected $usuario;

    /**
     * Almacena el objeto EmpleadoDAO.
     *
     * @var EmpleadoDAO
     */
    protected $empleado;

    /**
     * Almacena el objeto ProductoDAO.
     *
     * @var ProductoDAO
     */
    protected $producto;

    /**
     * Obtiene el nombre del usuario con el id especificado.
     *
     * @param numeric $idUsuario
     * @return string Nombre
     */
    public function getNombre($idUsuario)
    {
        return $this->usuario->getById($idUsuario)->getNombre();
    }

    /**
     * Obtiene el nivel de permisos (Tipo) del usuario especificado.
     *
     * @param numeric $idUsuario
     * @return numeric Si no existe un empleado con ese id devuelve un -1, de lo contrario el Tipo.
     */
    public function getPermisos($idUsuario)
    {
        $empleado = $this->empleado->getById($idUsuario);

        return ($empleado) ? $empleado->getTipo() : -1;
    }

    /**
     * Obtiene el correo del usuario especificado.
     *
     * @param numeric $idUsuario
     * @return string Email del usuario.
     */
    public function getCorreo($idUsuario)
    {
        return $this->usuario->getById($idUsuario)->getEmail();
    }
}
