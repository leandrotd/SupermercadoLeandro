<?php

/**
 * DataAccessObject de Producto
 */
class ProductoDAO extends BaseDAO
{

  /**
   * Agregar Producto.
   *
   * @param Producto $producto Producto a añadir.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function add($producto)
  {
    try {
      $sql = "INSERT INTO productos (Nombre, Precio, Cantidad, Foto) 
		        VALUES (?, ?, ?, ?)";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $producto->getNombre(),
            $producto->getPrecio(),
            $producto->getCantidad(),
            $producto->getFoto()
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select de todos los productos.
   *
   * @return array|false<b> Si tuvo exito devuelve el array con los productos, en caso contrario false.
   */
  public function findAll()
  {
    try {

      $stm = $this->pdo->prepare("SELECT * FROM productos");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_CLASS, 'Producto');
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Select del producto especificado.
   *
   * @param numeric $id Id del producto a buscar.
   * @return Producto|false<b> Si tuvo exito devuelve el producto, en caso contrario false.
   */
  public function getById($id)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM productos WHERE NumProd = ?");
      $stm->execute(array($id));

      return $stm->fetchObject("Producto");
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Modificar Producto.
   *
   * @param Producto $empleado Producto a moodificar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function update($producto)
  {
    try {
      $sql = "UPDATE productos SET 
						Nombre = ?, 
						Precio = ?,
            Cantidad = ?,
						Foto = ?
				    WHERE NumProd = ?";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $producto->getNombre(),
            $producto->getPrecio(),
            $producto->getCantidad(),
            $producto->getFoto(),
            $producto->getNumProd()
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Actualiza la cantidad de inventario del producto especificado.
   *
   * @param numeric $id Id del producto.
   * @param numeric $cantidad Cantidad del producto a quitar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function borrarCantidad($id, $cantidad)
  {
    try {
      $sql = "UPDATE productos
            SET 
            Cantidad = ((SELECT Cantidad 
                        FROM productos 
                        WHERE NumProd = ?) - ?)
            WHERE NumProd = ?";

      $this->pdo->prepare($sql)
        ->execute(
          array(
            $id,
            $cantidad,
            $id
          )
        );
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Borrar Producto.
   *
   * @param numeric $id Id del Producto a borrar.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function delete($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("DELETE FROM productos WHERE NumProd = ?");

      $stm->execute(array($id));
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Mueve la foto nueva del producto hacia la carpeto images.
   *
   * @param array $foto $_FILES de la foto subida.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function subirFoto($foto)
  {
    return (move_uploaded_file($foto["tmp_name"], getcwd() . "/public/assets/images/" . $foto["name"])) ? true : false;
  }

  /**
   * Intenta borrar la foto en el servidor.
   *
   * @param string $foto Nombre de la foto.
   * @return bool Si tuvo exito devuelve true, en caso contrario false.
   */
  public function borrarFoto($foto)
  {
    if ($foto != '' && file_exists(getcwd() . "/public/assets/images/" . $foto)) {
      return (unlink(getcwd() . "/public/assets/images/" . $foto)) ? true : false;
    } else {
      return true;
    }
  }
}
