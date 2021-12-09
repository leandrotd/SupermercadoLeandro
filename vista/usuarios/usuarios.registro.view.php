<?php

//Si el botón de añadir es pulsado
if (isset($_POST['submit'])) {
  //Se el un cliente
  if (!isset($_POST['empleado'])) {
    //Valida los campos
    $errores = $this->validarCampos($_POST, false);

    //Si no hay errores en la validación
    if (empty($errores)) {
      $usuario = new Usuario;
      $usuario->setNombre(trim($_POST['nombre']));
      $usuario->setEmail(strtolower(trim($_POST['email'])));
      $usuario->setContrasena($_POST['contrasena1']);
      $usuario->setApellidos(trim($_POST['apellidos']));
      $usuario->setDireccion(trim($_POST['direccion']));
      $usuario->setTelefono($_POST['telefono']);

      $this->addUsuario($usuario);
      if (isset($_SESSION['usuario'])) {
        header('Location:/SupermercadoLeandro/index.php/empleado/lista');
      } else {
        header('Location:/SupermercadoLeandro/index.php/usuario/login');
      }
    }
  } else {
    //Valida los campos
    $errores = $this->validarEmpleado($_POST, false);

    //Si no hay errores en la validación
    if (empty($errores)) {
      $empleado = new Empleado();
      $empleado->setNombre(trim($_POST['nombre']));
      $empleado->setEmail(strtolower(trim($_POST['email'])));
      $empleado->setContrasena($_POST['contrasena1']);
      $empleado->setApellidos(trim($_POST['apellidos']));
      $empleado->setDireccion(trim($_POST['direccion']));
      $empleado->setTelefono($_POST['telefono']);
      $empleado->setDNI(trim($_POST['dni']));
      $empleado->setCargo(trim($_POST['cargo']));
      $empleado->setTipo(isset($_POST['tipo']) ? 0 : 1);
      $empleado->setSueldo($_POST['sueldo']);

      $this->addEmpleado($empleado);
      header('Location:/SupermercadoLeandro/index.php/empleado/lista');
    }
  }
}

?>
<div class="card-header card-header-main text-center">
  <h2>Registro</h2>
</div>
<div class="card-body">
  <form method="post" id="form">
    <div class="container-fluid text-center mx-auto w-75">
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <input type="email" tabindex="1" class="form-control" name="email" placeholder="Email*" required value="<?php
                                                                                                                    //Cargar los datos de un intento fallido
                                                                                                                    echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" />
            <?php
            //Mostrar errores
            if (isset($errores['email'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['email'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <input type="text" tabindex="2" class="form-control" name="nombre" placeholder="Nombre*" required value="<?php
                                                                                                                      //Cargar los datos de un intento fallido
                                                                                                                      echo (isset($_POST['nombre'])) ? $_POST['nombre'] : ''; ?>" />
            <?php
            //Mostrar errores
            if (isset($errores['nombre'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['nombre'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <input type="text" tabindex="3" class="form-control" name="apellidos" placeholder="Apellidos*" required value="<?php
                                                                                                                            //Cargar los datos de un intento fallido
                                                                                                                            echo (isset($_POST['apellidos'])) ? $_POST['apellidos'] : ''; ?>" />
            <?php
            //Mostrar errores
            if (isset($errores['apellidos'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['apellidos'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <input type="text" tabindex="5" class="form-control" name="direccion" placeholder="Direccion*" required value="<?php
                                                                                                                            //Cargar los datos de un intento fallido
                                                                                                                            echo (isset($_POST['direccion'])) ? $_POST['direccion'] : ''; ?>" />
            <?php
            //Mostrar errores
            if (isset($errores['direccion'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['direccion'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <input type="text" tabindex="6" class="form-control" pattern="[0-9]+" name="telefono" placeholder="Telefono" size="9" value="<?php
                                                                                                                                          //Cargar los datos de un intento fallido
                                                                                                                                          echo (isset($_POST['telefono'])) ? $_POST['telefono'] : ''; ?>" />
            <?php
            //Mostrar errores
            if (isset($errores['telefono'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['telefono'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <div class="input-group">
              <input type="password" tabindex="7" class="form-control" name="contrasena1" placeholder="Contraseña*" required id="contrasena1" />
              <div class="input-group-append">
                <button class="btn btn-secondary" tabindex="-1" type="button" onclick="mostrarContrasena(1)">
                  <em class="bi-eye-slash" id="eye1"></em>
                </button>
              </div>
            </div>
            <?php
            //Mostrar errores
            if (isset($errores['contrasena1'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['contrasena1'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group text-center">
            <div class="input-group">
              <input type="password" tabindex="8" class="form-control" name="contrasena2" placeholder="Confirmar contraseña*" required id="contrasena2" />
              <div class="input-group-append">
                <button class="btn btn-secondary" tabindex="-1" type="button" onclick="mostrarContrasena(2)">
                  <em class="bi-eye-slash" id="eye2"></em>
                </button>
              </div>
            </div>
            <?php
            //Mostrar errores
            if (isset($errores['contrasena2'])) {
              echo "<div class='alert alert-danger mx-auto'>" . $errores['contrasena2'] . "</div>";
            }
            ?>
          </div>
        </div>
      </div>
      <?php
      //Comprueba si tiene la sesion iniciada un administrador
      if (isset($_SESSION['usuario']) && $this->getPermisos($_SESSION['usuario']) == 0) {
        echo '<div class="row border border-warning rounded">
                <div class="col text-left">
                  <div class="form-check pr-3">
                    <input type="checkbox" tabindex="9" class="form-check-input" name="empleado" id="empleado" onclick="esEmpleado()"';
        //Check si al fallar estaba activado
        if (isset($_POST['empleado'])) {
          echo ' checked="checked">';
        } else {
          echo ' >';
        }

        echo '<label class="form-check-label" for="empleado">¿Es un empleado?</label>
                    <div class="row mt-3 ';
        //Ocultar si al fallar no estaba activado el check de empleado
        if (!isset($_POST['empleado'])) {
          echo 'ocultar';
        }

        echo '" id="formEmpleado"> 
                    <div class="col"> 
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col px-0">
                            <div class="form-group text-center">
                              <input type="text" tabindex="10" class="form-control" name="dni" placeholder="DNI*" value="';
        //Cargar los datos de un intento fallido
        echo isset($_POST['dni']) ? $_POST['dni'] : '';
        echo '" />';
        //Mostrar errores
        if (isset($errores["dni"])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['dni'] . "</div>";
        }

        echo '  </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col px-0">
                            <div class="form-group text-center">
                              <input type="text" tabindex="11" class="form-control" name="cargo" placeholder="Cargo*" value="';
        //Cargar los datos de un intento fallido
        echo isset($_POST['cargo']) ? $_POST['cargo'] : '';
        echo '" />';
        //Mostrar errores
        if (isset($errores["cargo"])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['cargo'] . "</div>";
        }

        echo '  </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col px-0">
                            <div class="form-group text-center">
                              <input type="text" tabindex="13" class="form-control" tabindex="12" name="sueldo" placeholder="Sueldo*" value="';
        //Cargar los datos de un intento fallido
        echo isset($_POST['sueldo']) ? $_POST['sueldo'] : '';
        echo '" />';
        //Mostrar errores
        if (isset($errores["sueldo"])) {
          echo "<div class='alert alert-danger mx-auto'>" . $errores['sueldo'] . "</div>";
        }

        echo '  </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group text-left ml-2">
                            <input type="checkbox" class="form-check-input" tabindex="13" name="tipo" id="tipo"';
        echo isset($_POST['tipo']) ? 'checked' : '';
        echo '/>
                            <label for="tipo" class="form-check-label">
                              ¿Admin?
                            </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
      }
      ?>
      <div class="row">
        <div class="col-12 text-left my-3">
          <span class="text-danger">Los campos con * son obligatorios</span>
        </div>
        <div class="col-12 <?php echo !isset($_SESSION['usuario']) ? 'mb-3' : '' ?>">
          <div class="form-group text-center mb-0">
            <button type="submit" class="btn btn-primary" name="submit">
              Registrar
            </button>
          </div>
        </div>
        <?php
        if (!isset($_SESSION['usuario'])) {
          echo '<div class="col-12">
                  <div class="text-center">
                    <span><a href="/SupermercadoLeandro/index.php/usuario/login">Volver a iniciar sesion</a></span>
                  </div>';
        }
        ?>

      </div>
    </div>
  </form>
</div>