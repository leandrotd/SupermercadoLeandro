<?php

/**
 * Clase Factura
 */
class Factura
{
    private $NumFactura;
    private $IdUsuario;

    public function getNumFactura()
    {
        return $this->NumFactura;
    }

    public function getIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function setNumFactura($NumFactura)
    {
        $this->NumFactura = $NumFactura;

        return $this;
    }

    public function setIdUsuario($IdUsuario)
    {
        $this->IdUsuario = $IdUsuario;

        return $this;
    }
}
