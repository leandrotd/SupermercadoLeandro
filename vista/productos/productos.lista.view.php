<?php
//Comprueba si esta especificado el id del producto a borrar
if (isset($_POST['id'])) {
  $this->borrar($_POST['id']);
}

//Carga la lista de productos
$productos = $this->getProductos();
?>
<div class="card-header card-header-main rounded-0">
  <div class="container-fluid">
    <div class="row">
      <div class="col-5 offset-1 text-nowrap">
        Nombre
      </div>
      <div class="col-2 text-nowrap">

        <?php
        if (isset($_SESSION['usuario'])) {
          echo 'Cantidad';
        }
        ?>

      </div>
      <div class="col-2 text-nowrap">
        Precio
      </div>
    </div>
  </div>
</div>
<div class="card-body pt-3">

  <?php
  //Solo los empleados pueden añadir productos
  if (isset($_SESSION['usuario'])) {
    $permisos = $this->getPermisos($_SESSION['usuario']);
    if ($permisos == 0 || $permisos == 1) {
      echo '<a href="/SupermercadoLeandro/index.php/producto/detalles" class="btn btn-success my-3">
    <i class="bi bi-plus-lg"></i> Añadir
  </a>';
    }
  }
  ?>

  <div class="container-fluid">
    <?php
    //Carga de productos en la tabla
    foreach ($productos as $producto) {
      //Comprueba que: la cantidad del producto es 0 y el usuario es un cliente o que el usuario es un empleado
      if ($producto->getCantidad() > 0 || (isset($permisos) && ($permisos == 0 || $permisos == 1))) {

        echo '<div class="row align-items-center my-3" id="prod' . $producto->getNumProd() . '">
    <div class="col-1 p-0">';

        //Si el producto no tiene foto asignada, muestra el logo de la empresa
        if ($producto->getFoto() == null || !file_exists(getcwd() . "/public/assets/images/" . $producto->getFoto())) {
          echo '<img src="/SupermercadoLeandro/public/assets/images/logo.png" height="100" width="100" alt="imgDefecto">';
        } else {
          echo '<img src="/SupermercadoLeandro/public/assets/images/' . $producto->getFoto() . '" height="100" width="100" alt=' . $producto->getFoto() . '>';
        }

        echo '</div>
    <div class="col-5">' . $producto->getNombre() . '</div>
    <div class="col-2">';

        //Solo si es usuario puede mostrar las cantidades
        if (isset($_SESSION['usuario'])) {
          if ($permisos == -1) {
            //Si es cliente puede modificar la cantidad a comprar
            echo '<input class="form-control" id="cantidadProd' . $producto->getNumProd() . '" type="number" min="1" max="' . $producto->getCantidad() . '" value="1">';
          } else {
            //Si es empleado muestra la cantidad maxima
            echo '<input class="form-control" type="text" readonly value="' . $producto->getCantidad() . '">';
          }
        }

        echo '</div>
    <div class="col-2 text-nowrap">' . $producto->getPrecio() . '€</div>
    <div class="col-2">
      <div class="container-fluid">
        <div class="row">';

        if (isset($_SESSION['usuario'])) {
          //Si la sesion del usuario corresponde a un empleado, muestra los botones de modificar y borrar el producto
          if ($permisos == 0 || $permisos == 1) {
            echo '<form class="col-12 m-0 p-0 mb-1" method="get" action="/SupermercadoLeandro/index.php/producto/detalles">';
            echo "<button class='btn btn-success' type='submit' name='id' value='" . $producto->getNumProd() . "'><i class='bi bi-pencil-fill'></i></button>";
            echo '</form>';

            echo '<form class="col-12 m-0 p-0" method="post">';
            echo "<button class='btn btn-danger' type='submit' name='id' onclick='return confirm(\"¿Seguro que quieres el producto " . $producto->getNombre() . "?\")' value='" . $producto->getNumProd() . "'><i class='bi bi-x-lg'></i></button>";
            echo '</form>';
          } else {
            echo '<div class="col-12 m-0 p-0"><button class="btn btn-primary" type="button" onclick="agregarAlCarrito(' . $producto->getNumProd() . ', ' . $producto->getCantidad() . ', \'' . $producto->getNombre() . '\' )"> <i class="bi bi-cart-plus"></i></button></div>';
          }
        }

        echo "</div>
        </div>
      </div>
    </div>";
      }
    }
    ?>
  </div>
</div>