<?php
$inicioCorrecto;

//Accion del boton de iniciar sesion
if (isset($_POST['login'])) {
  $inicioCorrecto = $this->iniciarSesion(strtolower(trim($_POST['email'])), $_POST['contrasena']);
}

//Comprueba que se haya iniciado correctamente la sesion
if (isset($inicioCorrecto) && $inicioCorrecto) {
  header('Location:/SupermercadoLeandro/index.php/producto/lista');
}
?>
<div class="card-header card-header-main text-center">
  <h2>Inicio Sesion</h2>
</div>
<div class="card-body">

  <?php
  //Mostrar error del inicio de sesion
  if (isset($inicioCorrecto) && !$inicioCorrecto) {
    echo '<div class="alert alert-danger mx-auto">
              Email o contraseña incorrecta
            </div>';
  }
  ?>

  <form method="post">
    <div class="form-group text-center mx-auto w-75">
      <input type="text" class="form-control" name="email" placeholder="Correo" autofocus required>
    </div>
    <div class="form-group text-center mx-auto w-75 mb-5">
      <div class="input-group">
        <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required id="contrasena" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="button" onclick="mostrarContrasena(0)">
            <em class="bi-eye-slash" id="eye"></em>
          </button>
        </div>
      </div>
    </div>
    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary" name="login">Login</button>
    </div>
    <div class="text-center">
      <span>¿No estás registrado? <a class="text-info" href="/SupermercadoLeandro/index.php/usuario/registro">Regístrate</a></span>
    </div>
  </form>
</div>