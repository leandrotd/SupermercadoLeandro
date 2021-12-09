<?php
//Obtiene el usuario a modificar
$usuario = $this->getUsuarioEmail($_GET['email']);

//En caso de que no exista vuelve a la lista de productos
if (!$usuario) {
  header('Location:/SupermercadoLeandro/index.php/producto/lista');
}

//Obtiene el empleado si es que existe con el id del usuario
$empleado = $this->getEmpleado($usuario->getIdUsuario());

//Si existe modificar el objeto
if ($empleado) {
  $empleado->setIdUsuario($usuario->getIdUsuario());
  $empleado->setNombre($usuario->getNombre());
  $empleado->setEmail($usuario->getEmail());
  $empleado->setContrasena($usuario->getContrasena());
  $empleado->setApellidos($usuario->getApellidos());
  $empleado->setDireccion($usuario->getDireccion());
  $empleado->setTelefono($usuario->getTelefono());

  $usuario = $empleado;
}

//Si el botón de modificar es pulsado
if (isset($_POST['modificar'])) {
  //Guarda el id
  $id = $usuario->getIdUsuario();
  //Guarda la contraseña antigua
  $contrasena = $usuario->getContrasena();
  $contrasenaCambiada = false;

  //Si se trata de un cliente
  if (!isset($_POST['empleado'])) {
    //Si el que modifica al cliente es el propio usuario
    if ($_SESSION['usuario'] == $usuario->getIdUsuario()) {
      //Guarda el id del usuario a modificar en el $_POST para enviarlo a métodos más adelante
      $_POST['id'] = $_SESSION['usuario'];
      //Comprueba errores
      $errores = $this->validarCampos($_POST, $usuario, true);

      //Si no hay errores
      if (empty($errores)) {
        $usuario = new Usuario();
        $usuario->setIdUsuario($id);
        $usuario->setNombre(trim($_POST['nombre']));
        $usuario->setEmail(strtolower(trim($_POST['email'])));
        $usuario->setApellidos(trim($_POST['apellidos']));
        $usuario->setDireccion(trim($_POST['direccion']));
        $usuario->setTelefono($_POST['telefono']);

        //Comprueba que se quiera cambiar la contraseña
        if (isset($_POST['check'])) {
          $usuario->setContrasena($_POST['contrasena2']);
          $contrasenaCambiada = true;
        } else {
          $usuario->setContrasena($contrasena);
        }

        $this->updateUsuario($usuario, $contrasenaCambiada);
        header('Location:/SupermercadoLeandro/index.php/usuario/detalles?email=' . $_POST['email']);
      }
    }
    //En el caso del que modifique el usuario sea un administrador, solo podrá modificar la parte de empleado, por lo que el anteriormente empleado se convertirá en cliente
    else {
      $this->controllerEmpleado->borrarSiEraEmpleado($usuario);
      header('Location:/SupermercadoLeandro/index.php/usuario/detalles?email=' . $_POST['email']);
    }
  }
  //Si se trata de un empleado
  else {
    //Si el que modifica al empleado es el propio usuario
    if ($_SESSION['usuario'] == $usuario->getIdUsuario()) {
      //Guarda el id en el $_POST para enviarlo a métodos más adelante
      $_POST['id'] = $_SESSION['usuario'];
    }

    //Comprueba errores
    $errores = $this->validarEmpleado($_POST, $usuario, true);

    //Si no hay errores
    if (empty($errores)) {
      $empleado = new Empleado();
      $empleado->setIdUsuario($id);

      //En el caso de que el empleado a modificar no sea el mismo que tenga iniciada la sesion, no puede modificar estos datos
      if ($_SESSION['usuario'] == $usuario->getIdUsuario()) {
        $empleado->setNombre($_POST['nombre']);
        $empleado->setEmail($_POST['email']);
        $empleado->setApellidos($_POST['apellidos']);
        $empleado->setDireccion($_POST['direccion']);
        $empleado->setTelefono($_POST['telefono']);

        //Comprueba que se quiera cambiar la contraseña
        if (isset($_POST['check'])) {
          $empleado->setContrasena($_POST['contrasena2']);
          $contrasenaCambiada = true;
        } else {
          $empleado->setContrasena($contrasena);
        }
      }

      $empleado->setDNI($_POST['dni']);
      $empleado->setCargo($_POST['cargo']);
      $empleado->setTipo(isset($_POST['tipo']) ? 0 : 1);
      $empleado->setSueldo($_POST['sueldo']);

      $this->updateEmpleado($empleado, $contrasenaCambiada);
      header('Location:/SupermercadoLeandro/index.php/usuario/detalles?email=' . $_POST['email']);
    }
  }
}
?>
<div class="card-header card-header-main">
  Informacion de <?php echo $usuario->getNombre(); ?>
</div>
<div class="card-body">
  <form method="post" id="form">
    <div class="container-fluid">
      <div class="form-group row">
        <label for="email" class="col-form-label col-sm-3 pl-sm-0">
          Email *
        </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="email" <?php echo ($_SESSION['usuario'] != $usuario->getIdUsuario()) ? 'readonly' : ''; ?> required minlength="2" value="<?php
                                                                                                                                                                                  //Cargar los datos de un intento fallido o del usuario
                                                                                                                                                                                  if (isset($_POST['email'])) {
                                                                                                                                                                                    echo $_POST['email'];
                                                                                                                                                                                  } else {
                                                                                                                                                                                    echo $usuario->getEmail();
                                                                                                                                                                                  }
                                                                                                                                                                                  ?>" />
          <?php
          //Mostrar errores
          if (isset($errores['email'])) {
            echo "<div class='alert alert-danger mx-auto'>" . $errores['email'] . "</div>";
          }
          ?>
        </div>
      </div>
      <?php
      //Comprueba si el que modifica los datos es el del usuario a modificar
      if ($_SESSION['usuario'] == $usuario->getIdUsuario()) {
        echo '
      <div class="form-group row">
        <div class="col mr-3 border border-warning rounded">
          <div class="w-100">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="check" id="check" onclick="cambiarContrasena()"';
        //Check si al fallar estaba activado
        echo (isset($_POST['check'])) ? ' checked="checked"' : '';
        echo '>
              <label class="form-check-label w-100" for="check">¿Cambiar contraseña?</label>
            </div>
            <div class="container-fluid px-0 ';
        //Check si al fallar estaba activado
        echo (isset($_POST['check'])) ? '' : 'ocultar';
        echo '" id="divContrasena">
              <div class="row my-3 centrarVertical">
                <label for="contrasena" class="col-form-label col-sm-3">
                  <span class="text-nowrap">Contraseña</span> *
                </label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="password" class="form-control" name="contrasena1" id="contrasena1" />

                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button" tabindex="-1" onclick="mostrarContrasena(1)">
                        <em class="bi-eye-slash" id="eye1"></em>
                      </button>
                    </div>
                  </div>';
        //Mostrar errores
        if (isset($errores['contrasena1'])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['contrasena1'] . "</div>";
        }

        echo '
                </div>
              </div>
              <div class="row my-3 centrarVertical">
                <label for="contrasena" class="col-form-label col-sm-3">
                  <span class="text-nowrap">Contraseña</span> <span class="text-nowrap">nueva</span> *
                </label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="password" class="form-control" name="contrasena2" id="contrasena2" />

                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button" tabindex="-1" onclick="mostrarContrasena(2)">
                        <em class="bi-eye-slash" id="eye2"></em>
                      </button>
                    </div>
                  </div>';
        //Mostrar errores
        if (isset($errores['contrasena2'])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['contrasena2'] . "</div>";
        }
        echo '
                </div>
              </div>
              <div class="row mb-3 centrarVertical">
                <label for="contrasena" class="col-form-label col-sm-3">
                  <span class="text-nowrap">Confirmar</span> <span class="text-nowrap">contraseña</span> <span class="text-nowrap">nueva</span> *
                </label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="password" class="form-control" name="contrasena3" id="contrasena3" />

                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button" tabindex="-1" onclick="mostrarContrasena(3)">
                        <em class="bi-eye-slash" id="eye3"></em>
                      </button>
                    </div>
                  </div>';
        //Mostrar errores
        if (isset($errores['contrasena3'])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['contrasena3'] . "</div>";
        }
        echo '
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
      } ?>
      <div class="form-group row">
        <label for="nombre" class="col-form-label col-sm-3 pl-sm-0 text-nowrap">
          Nombre *
        </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nombre" <?php echo ($_SESSION['usuario'] != $usuario->getIdUsuario()) ? 'readonly' : ''; ?> required value="<?php
                                                                                                                                                                    //Cargar los datos de un intento fallido o del usuario
                                                                                                                                                                    if (isset($_POST['nombre'])) {
                                                                                                                                                                      echo $_POST['nombre'];
                                                                                                                                                                    } else {
                                                                                                                                                                      echo $usuario->getNombre();
                                                                                                                                                                    }
                                                                                                                                                                    ?>" />
          <?php
          //Mostrar errores
          if (isset($errores['nombre'])) {
            echo "<div class='alert alert-danger mx-auto'>" . $errores['nombre'] . "</div>";
          }
          ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="apellidos" class="col-form-label col-sm-3 pl-sm-0 text-nowrap">
          Apellidos *
        </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="apellidos" <?php echo ($_SESSION['usuario'] != $usuario->getIdUsuario()) ? 'readonly' : ''; ?> required value="<?php
                                                                                                                                                                        //Cargar los datos de un intento fallido o del usuario
                                                                                                                                                                        if (isset($_POST['apellidos'])) {
                                                                                                                                                                          echo $_POST['apellidos'];
                                                                                                                                                                        } else {
                                                                                                                                                                          echo $usuario->getApellidos();
                                                                                                                                                                        }
                                                                                                                                                                        ?>" />
          <?php
          //Mostrar errores
          if (isset($errores['apellidos'])) {
            echo "<div class='alert alert-danger mx-auto'>" . $errores['apellidos'] . "</div>";
          }
          ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="direccion" class="col-form-label col-sm-3 pl-sm-0 text-nowrap">
          Direccion *
        </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="direccion" <?php echo ($_SESSION['usuario'] != $usuario->getIdUsuario()) ? 'readonly' : ''; ?> required value="<?php
                                                                                                                                                                        //Cargar los datos de un intento fallido o del usuario
                                                                                                                                                                        if (isset($_POST['direccion'])) {
                                                                                                                                                                          echo $_POST['direccion'];
                                                                                                                                                                        } else {
                                                                                                                                                                          echo $usuario->getDireccion();
                                                                                                                                                                        }
                                                                                                                                                                        ?>" />
          <?php
          //Mostrar errores
          if (isset($errores['direccion'])) {
            echo "<div class='alert alert-danger mx-auto'>" . $errores['direccion'] . "</div>";
          }
          ?>
        </div>
      </div>

      <div class="form-group row">
        <label for="telefono" class="col-form-label col-sm-3 pl-sm-0 text-nowrap">
          Telefono
        </label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="telefono" <?php echo ($_SESSION['usuario'] != $usuario->getIdUsuario()) ? 'readonly' : ''; ?> value="<?php
                                                                                                                                                              //Cargar los datos de un intento fallido o del usuario
                                                                                                                                                              if (isset($_POST['telefono'])) {
                                                                                                                                                                echo ($_POST['telefono'] != 0) ? $_POST['telefono'] : '';
                                                                                                                                                              } else {
                                                                                                                                                                echo ($usuario->getTelefono() != 0) ? $usuario->getTelefono() : '';
                                                                                                                                                              }
                                                                                                                                                              ?>" />
          <?php
          //Mostrar errores
          if (isset($errores['telefono'])) {
            echo "<div class='alert alert-danger mx-auto'>" . $errores['telefono'] . "</div>";
          }
          ?>
        </div>
      </div>
      <?php
      //Comprobar que el usuario que modifica es un administrador
      if (isset($_SESSION['usuario']) && $this->getPermisos($_SESSION['usuario']) == 0) {
        echo '<div class="form-group row">
      <div class="col mr-3 border border-warning rounded">
        <div class="w-100">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="empleado" id="empleado" onclick="esEmpleado()"';
        //Si el usuario a modificar es un empleado que este "Check" al cargar
        if ((gettype($empleado) == 'object' && get_class($usuario) == 'Empleado') || isset($_POST['empleado'])) {
          echo ' checked="checked" >';
        } else {
          echo ' >';
        }
        echo '<label class="form-check-label w-100" for="empleado">¿Es un empleado?</label>
          </div>
          <div class="container-fluid px-0 ';
        //Si el usuario a modificar es un empleado que se muestre al cargar
        if ((gettype($empleado) == 'object' && get_class($usuario) == 'Empleado') || isset($_POST['empleado'])) {
          echo '';
        } else {
          echo ' ocultar"';
        }
        echo '" id="formEmpleado">
            <div class="form-group row mt-3"> 
              <label for="dni" class="col-form-label col-sm-3 text-nowrap">
                DNI *
              </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="dni" name="dni" value="';
        if (gettype($empleado) == 'object' && get_class($usuario) == 'Empleado') {
          //Cargar los datos de un intento fallido o del empleado
          if (isset($_POST['dni'])) {
            echo $_POST['dni'];
          } else {
            echo $usuario->getDNI();
          }
        }
        echo '" />';
        //Mostrar errores
        if (isset($errores["dni"])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['dni'] . "</div>";
        }

        echo '</div>
            </div>
            <div class="form-group row">
              <label for="cargo" class="col-form-label col-sm-3 text-nowrap">
                Cargo *
              </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="cargo" name="cargo" value="';
        if (gettype($empleado) == 'object' && get_class($usuario) == 'Empleado') {
          //Cargar los datos de un intento fallido o del empleado
          if (isset($_POST['cargo'])) {
            echo $_POST['cargo'];
          } else {
            echo $usuario->getCargo();
          }
        }
        echo '" />';
        //Mostrar errores
        if (isset($errores["cargo"])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['cargo'] . "</div>";
        }

        echo '</div>
            </div>
            <div class="form-group row">
              <label for="sueldo" class="col-form-label col-sm-3 text-nowrap">
                Sueldo *
              </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="sueldo" name="sueldo" value="';
        if (gettype($empleado) == 'object' && get_class($usuario) == 'Empleado') {
          //Cargar los datos de un intento fallido o del empleado
          if (isset($_POST['sueldo'])) {
            echo $_POST['sueldo'];
          } else {
            echo $usuario->getSueldo();
          }
        }
        echo '" />';
        //Mostrar errores
        if (isset($errores["sueldo"])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['sueldo'] . "</div>";
        }

        echo '</div>
            </div>
            <div class="form-group row ml-0">
              <div class="col text-nowrap form-check">
                <input type="checkbox" class="form-check-input" name="tipo" id="tipo"  ';

        if (gettype($empleado) == 'object' && get_class($usuario) == 'Empleado') {
          if (isset($_POST['sueldo'])) {
            //Check si al fallar estaba activado
            echo 'checked="checked"';
          } else {
            echo ($usuario->getTipo() == 0) ? 'checked="checked"' : '';
          }
        }
        echo '" />
                <label for="tipo" class="form-check-label">
                  ¿Admin?
                </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
      }
      ?>
      <div class="form-group row text-center">
        <div class="col">
          <div class="col-12 text-left">
            <span class="text-danger">Los campos con * son obligatorios</span>
          </div>
          <button class="btn btn-primary" name="modificar" type="submit">
            Modificar
          </button>
        </div>
      </div>
    </div>
  </form>
</div>