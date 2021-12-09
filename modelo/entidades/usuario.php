<?php

/**
 * Clase Usuario
 */
class Usuario
{
    //Estan en estado protected debido a su uso en la clase Empleado

    protected $IdUsuario;
    protected $Nombre;
    protected $Email;
    protected $Contrasena;
    protected $Apellidos;
    protected $Direccion;
    protected $Telefono;

    public function getIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getContrasena()
    {
        return $this->Contrasena;
    }

    public function getApellidos()
    {
        return $this->Apellidos;
    }

    public function getDireccion()
    {
        return $this->Direccion;
    }

    public function getTelefono()
    {
        return $this->Telefono;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->IdUsuario = $idUsuario;

        return $this;
    }

    public function setNombre($nombre)
    {
        $this->Nombre = $nombre;

        return $this;
    }

    public function setEmail($email)
    {
        $this->Email = $email;

        return $this;
    }

    public function setContrasena($contrasena)
    {
        $this->Contrasena = $contrasena;

        return $this;
    }

    public function setApellidos($apellidos)
    {
        $this->Apellidos = $apellidos;

        return $this;
    }

    public function setDireccion($direccion)
    {
        $this->Direccion = $direccion;

        return $this;
    }

    public function setTelefono($telefono)
    {
        $this->Telefono = $telefono;

        return $this;
    }
}
