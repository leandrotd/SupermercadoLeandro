<?php
//Carpeta donde se guardarán las imagenes
$carpetaDestino = getcwd() . "/public/assets/images/";
$producto;
$errores;

//Utilizado para cuando se modifique, se carguen automaticamente los datos
if (isset($_GET['id'])) {
  $producto = $this->getProducto($_GET['id']);
}

//En el caso de que sea la operacion del boton sea de crear un producto
if (isset($_POST['crear'])) {
  //Comprobar que los campos esten bien
  $errores = $this->validarCampos($_POST, $_FILES);

  //Comprobar que no haya una imagen con el mismo nombre y cambiarla para que sea unica
  $_FILES["foto"]["name"] = $this->comprobarFoto($carpetaDestino, $_FILES["foto"]["name"]);

  if (empty($errores)) {
    //Crear el objeto
    $producto = new Producto();
    $producto->setNombre(trim($_POST['nombre']));
    $producto->setPrecio($_POST['precio']);
    $producto->setCantidad($_POST['cantidad']);
    $producto->setFoto($_FILES['foto']['name'] ? $_FILES['foto'] : null);

    //Guardarlo
    $this->add($producto);
    header('Location:/SupermercadoLeandro/index.php/producto/lista');
  }
} else if (isset($_POST['modificar'])) {
  //Comprobar que los campos esten bien
  $errores = $this->validarCampos($_POST, $_FILES);

  //Comprobar que no haya una imagen con el mismo nombre y cambiarla para que sea unica
  $_FILES["foto"]["name"] = $this->comprobarFoto($carpetaDestino, $_FILES["foto"]["name"]);

  if (empty($errores)) {
    //Modifica el objeto
    $producto->setNombre(trim($_POST['nombre']));
    $producto->setPrecio($_POST['precio']);
    $producto->setCantidad($_POST['cantidad']);

    //Si hay una foto nueva, borrar la anterior
    if ($_FILES['foto']['name']) {
      $this->borrarFoto($producto->getFoto());

      $producto->setFoto($_FILES['foto']);
    }

    //Guardarlo
    $this->modificar($producto);
    header('Location:/SupermercadoLeandro/index.php/producto/lista');
  }
}

?>
<div class="card-body">
  <form method="post" enctype="multipart/form-data">
    <div class="container-fluid mr-2">
      <div class="row mt-3">
        <div class="col-12 col-md-4 text-center">
          <div class="text-left mb-3">Foto: </div>
          <?php
          //Cargar la imagen al modificar si existe
          if (isset($_GET['id']) && ($producto->getFoto() != null && $producto->getFoto() != "0")) {
            echo '<img src="/SupermercadoLeandro/public/assets/images/' . $producto->getFoto() . '" height="150px" width="150px" alt="' . $producto->getFoto() . '" />';
          }
          ?>
          <input type="file" name="foto" class="form-control mt-2" />
          <?php
          //Cargar errores de la imagen
          if (isset($errores['foto'])) {
            echo "<div class='alert alert-danger mx-auto'>" . $errores['foto'] . "</div>";
          }
          ?>
        </div>
        <div class="col-12 col-md-8 px-0 px-md-auto">
          <div class="container-fluid">
            <div class="row mt-3">
              <div class="col">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php
                                                                                                              //Cargar nombre del producto
                                                                                                              if (isset($_POST['nombre'])) {
                                                                                                                echo $_POST['nombre'];
                                                                                                              } else if (isset($_GET['id'])) {
                                                                                                                echo $producto->getNombre();
                                                                                                              }
                                                                                                              ?>" required />
                <?php
                //Cargar errores del nombre del producto
                if (isset($errores['nombre'])) {
                  echo "<div class='alert alert-danger mx-auto'>" . $errores['nombre'] . "</div>";
                }
                ?>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" min='0' placeholder="Cantidad" value="<?php
                                                                                                                              //Cargar cantidad del producto
                                                                                                                              if (isset($_POST['cantidad'])) {
                                                                                                                                echo $_POST['cantidad'];
                                                                                                                              } else if (isset($_GET['id'])) {
                                                                                                                                echo $producto->getCantidad();
                                                                                                                              }
                                                                                                                              ?>" required />
                <?php
                //Cargar errores en la cantidad del producto
                if (isset($errores['cantidad'])) {
                  echo "<div class='alert alert-danger mx-auto'>" . $errores['cantidad'] . "</div>";
                }
                ?>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" id="precio" min='0' pattern="^[1-9]\d*(\.\d+)?$" step=".01" placeholder="Precio por unidad" value="<?php
                                                                                                                                                                            //Cargar precio del producto
                                                                                                                                                                            if (isset($_POST['precio'])) {
                                                                                                                                                                              echo $_POST['precio'];
                                                                                                                                                                            } else if (isset($_GET['id'])) {
                                                                                                                                                                              echo $producto->getPrecio();
                                                                                                                                                                            }
                                                                                                                                                                            ?>" required />
                <?php
                //Cargar errores en el precio del producto
                if (isset($errores['precio'])) {
                  echo "<div class='alert alert-danger mx-auto'>" . $errores['precio'] . "</div>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col text-center">
          <?php
          //Diferenciar entre crear y modificar
          if (!isset($_GET['id']) || isset($_POST['crear'])) {
            echo '<button class="btn btn-success btn-lg" role="button" type="submit" name="crear">
                      Crear
                    </button>';
          } else {
            echo '<button class="btn btn-success btn-lg" role="button" type="submit" name="modificar">
                      Modificar
                    </button>';
          }
          ?>
        </div>
      </div>
    </div>
  </form>
</div>