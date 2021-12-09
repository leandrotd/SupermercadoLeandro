<?php

/**
 * Clase Empleado y la clase Usuario
 */
class Empleado extends Usuario
{

    private $DNI;
    private $Cargo;
    private $Tipo;
    private $Sueldo;

    public function getDNI()
    {
        return $this->DNI;
    }

    public function setDNI($DNI)
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getCargo()
    {
        return $this->Cargo;
    }

    public function setCargo($Cargo)
    {
        $this->Cargo = $Cargo;

        return $this;
    }

    public function getTipo()
    {
        return $this->Tipo;
    }

    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;

        return $this;
    }

    public function getSueldo()
    {
        return $this->Sueldo;
    }

    public function setSueldo($Sueldo)
    {
        $this->Sueldo = $Sueldo;

        return $this;
    }
}
