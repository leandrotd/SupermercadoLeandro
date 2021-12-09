<?php
//Obtiene el usuario que tiene iniciada sesión
$actual = $this->getUsuario($_SESSION['usuario']);

//El usuario a modificar
$usuario = $this->getUsuarioEmail($_GET['email']);

//El objeto empleado del usuario a modificar si existe
$empleado = $this->getEmpleado($usuario->getIdUsuario());

//Comprueba si el email no esta definido en el $_GET o si el usuario que tenga sesion iniciada no sea administrador o distinto del usuario que se quiera ver los detalles
if (!isset($_GET['email']) || ($this->getPermisos($_SESSION['usuario']) != 0 && $actual->getIdUsuario() != $usuario->getIdUsuario())) {
  header('Location:/SupermercadoLeandro/index.php/producto/lista');
}
?>
<div class="card-header card-header-main">
  Informacion de <?php echo $usuario->getNombre(); ?>
</div>
<div class="card-body">
  <a class="btn btn-secondary mb-3" href="<?php
                                          //Dependiendo del usuario, que el botón volver vaya a una dirección u otra
                                          if ($this->getPermisos($_SESSION['usuario']) == 0) {
                                            echo "/SupermercadoLeandro/index.php/empleado/lista";
                                          } else {
                                            echo "/SupermercadoLeandro/index.php/producto/lista";
                                          } ?>"><i class="bi bi-arrow-left"></i> Volver</a>
  <div class="form-group row">
    <div class="col">
      <a class="btn btn-primary" role="button" href="/SupermercadoLeandro/index.php/usuario/modificacion?email=<?php echo $_GET["email"]; ?>">
        <i class='bi bi-pencil-fill'></i> Editar
      </a>
    </div>
  </div>
  <div class="form-group row">
    <div class="col col-2 text-nowrap mb-2">
      Email
    </div>
    <div class="col-10">
      <?php echo $usuario->getEmail(); ?>
    </div>
  </div>
  <div class="form-group row">
    <div class="col col-2 text-nowrap mb-2">
      Nombre
    </div>
    <div class="col-10">
      <?php echo $usuario->getNombre(); ?>
    </div>
  </div>
  <div class="form-group row">
    <div class="col col-2 text-nowrap mb-2">
      Apellidos
    </div>
    <div class="col-10">
      <?php echo $usuario->getApellidos(); ?>
    </div>
  </div>
  <div class="form-group row">
    <div class="col col-2 text-nowrap mb-2">
      Direccion
    </div>
    <div class="col-10">
      <?php echo $usuario->getDireccion(); ?>
    </div>
  </div>
  <div class="form-group row">
    <div class="col col-2 text-nowrap mb-2">
      Telefono
    </div>
    <div class="col-10">
      <?php echo ($usuario->getTelefono() != 0) ? $usuario->getTelefono() : ''; ?>
    </div>
  </div>
  <?php
  //Muestra si el usuario es un empleado
  if (gettype($empleado) == 'object') {
    echo '<div class="form-group row">
            <div class="col col-2 text-nowrap mb-2">
              DNI
            </div>
            <div class="col-10">' .
      $empleado->getDNI() .
      '</div>
          </div>
          <div class="form-group row">
            <div class="col col-2 text-nowrap mb-2">
              Cargo
            </div>
            <div class="col-10">' .
      $empleado->getCargo() .
      '</div>
          </div>
          <div class="form-group row">
            <div class="col col-2 text-nowrap mb-2">
              ¿Admin?
            </div>
            <div class="col-10">';

    if ($empleado->getTipo() == 0) {
      echo "Sí";
    } else {
      echo "No";
    }

    echo '</div>
          </div>
          <div class="form-group row">
            <div class="col col-2 text-nowrap mb-2">
              Sueldo
            </div>
            <div class="col-10">' .
      $empleado->getSueldo() .
      '</div>
          </div>';
  }
  ?>
</div>