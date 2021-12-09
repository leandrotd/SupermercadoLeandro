<?php
//Comprueba si está establecida la cookie de carrito y tenga elementos
if (isset($_COOKIE['carrito']) && strlen($_COOKIE['carrito']) > 2) {
  //Comprueba que los elementos del carrito sean válidos

  $carrito = $this->obtenerProductos($_COOKIE['carrito']);
  $carrito = ($carrito[0]) ? $carrito : null;

  if ($carrito != null) {
    $temp = $this->comprobarCantidades($carrito);
    $carrito = $temp[0];
    $cambios = $temp[1];
  }
}

//Comprueba si el boton de pagar ha sido pulsado, hay una cookie carrito y no está vacía
if (isset($_POST['pagar']) && isset($carrito) && !empty($carrito)) {
  //Crea la factura y obtiene el id de ella
  $id = $this->crearFactura($carrito, $_SESSION['usuario']);
  //Para enviarla a la pagina de fin de factura
  header('Location:/SupermercadoLeandro/index.php/factura/fin?id=' . $id);
}
?>
<div class="card-header card-header-main">
  <h4>Carrito</h4>
</div>
<form method="post">
  <div class="card-body">
    <?php
    //Comprueba si hay elementos en el carrito
    if (!isset($carrito) || empty($carrito)) {
      echo '<div class="card bg-info mb-3">
            <div class="card-body card-body-info">
              No hay ningun producto en el carrito.
            </div>
          </div>';
    } else {
      //Muestra al usuario si hubo cambios en las cantidades del los elementos del carrito
      if ($cambios) {
        echo '<div class="card bg-warning mb-3">
            <div class="card-header card-header-warning">
              Hubo cambios en productos del carrito
            </div>
            <div class="card-body card-body-warning">
              La cantidad de algunos de los productos en la lista era mayor a la existente actualmente.
            </div>
          </div>';
      }
      echo '<table class="table">
            <tr>
              <th scope="col">Foto</th>
              <th scope="col">Nombre</th>
              <th scope="col">Cantidad</th>
              <th scope="col" colspan="2">Precio</th>
            </tr>';
      //Contador del precio total
      $precio = 0;

      //Carga de todos los productos en la lista
      foreach ($carrito as $producto) {
        echo '<tr>
              <td>';
        if ($producto->getFoto() == null || !file_exists(getcwd() . "/public/assets/images/" . $producto->getFoto())) {
          echo '<img src="/SupermercadoLeandro/public/assets/images/imgprueba.png" height="100" width="100" alt="imgDefecto">';
        } else {
          echo '<img src="/SupermercadoLeandro/public/assets/images/' . $producto->getFoto() . '" height="100" width="100" alt=' . $producto->getFoto() . '>';
        }

        echo '</td>
              <td>' . $producto->getNombre() . '</td>
              <td>' . $producto->getCantidad() . '</td>
              <td>';

        $precio += $producto->getPrecio() * $producto->getCantidad();
        echo number_format($producto->getPrecio() * $producto->getCantidad(), 2);

        echo '</td>
              <td>
                <button type="button" class="btn btn-danger" onclick="borrarCarritoMensaje(\'' . $producto->getNombre() . '\', ' . $producto->getNumProd() . ')">
                  <em class="bi bi-x-lg"></em>
                </button>
              </td>
            </tr>';
      }
      echo '
          </table>
          <hr />
          <div class="container-fluid">
            <div class="row">
            <div class="col-3">
              <button class="btn btn-success text-nowrap" type="submit" name="pagar" onclick="pagar()">
              <em class="bi bi-cart-check"></em> Pagar
              </button>
            </div>
              <div class="col-4 offset-2 text-nowrap">
                <h5 class="d-inline">Precio Total:</h5> ' . number_format($precio, 2) .
        '€</div>
            </div>
          </div>';
    }
    ?>
  </div>
</form>