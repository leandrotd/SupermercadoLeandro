<?php

/**
 * DataAccessObject de Factura
 */
class FacturaDAO extends BaseDAO
{

    /**
     * Agregar Factura.
     *
     * @param numeric $idUsuario Id del usuario para asignarle la factura.
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function add($idUsuario)
    {
        try {
            $sql = "INSERT INTO facturas (IdUsuario) VALUES (?)";

            $this->pdo->prepare($sql)->execute(array($idUsuario));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Agregar productos a la factura.
     *
     * @param numeric $idFactura Id de la factura a la que se añade.
     * @param Producto $producto Producto con la informacion para añadirsela a la fila.
     * @return bool Si tuvo exito devuelve true, en caso contrario false.
     */
    public function addItem($idFactura, $producto)
    {
        try {
            $precio = $producto->getCantidad() * floatval($producto->getPrecio());
            $sql = "INSERT INTO productos_facturas (NumFactura, NumProd, Cantidad, Precio) VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $idFactura,
                        $producto->getNumProd(),
                        $producto->getCantidad(),
                        $precio
                    )
                );
            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Sin uso
     *
     * @return void
     */
    public function findAll()
    {
    }

    /**
     * Sin uso
     *
     * @return void
     */
    public function getById($id)
    {
    }

    /**
     * Obtiene la ultima factura creada por el usuario.
     *
     * @param numeric $idUsuario Id del usuario.
     * @return Factura|false<b> Si tuvo exito devuelve el empleado, en caso contrario false.
     */
    public function getFacturaNueva($idUsuario)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM facturas 
                                        WHERE IdUsuario = ? 
                                        AND NumFactura NOT IN (SELECT DISTINCT NumFactura 
                                                                FROM productos_facturas)");

            $stm->execute(array($idUsuario));
            return $stm->fetchObject("Factura");
        } catch (Exception $e) {
            return false;
        }
    }
    /**
     * Sin uso
     *
     * @return void
     */
    public function update($obj)
    {
    }

    /**
     * Sin uso
     *
     * @return void
     */
    public function delete($id)
    {
    }
}
