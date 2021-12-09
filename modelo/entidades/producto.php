<?php

/**
 * Clase Producto
 */
class Producto
{

    private $NumProd;
    private $Nombre;
    private $Precio;
    private $Cantidad;
    private $Foto;


    public function getNumProd()
    {
        return $this->NumProd;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getPrecio()
    {
        return $this->Precio;
    }

    public function getCantidad()
    {
        return $this->Cantidad;
    }

    public function getFoto()
    {
        return $this->Foto;
    }

    public function setNumProd($NumProd)
    {
        $this->NumProd = $NumProd;

        return $this;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function setPrecio($Precio)
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    public function setFoto($Foto)
    {
        $this->Foto = $Foto;

        return $this;
    }
}
