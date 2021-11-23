<div class="container-fluid h-100 w-75 py-2">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header text-center">
          <h2>Inicio Sesion</h2>
        </div>
        <div class="card-body">
          <!--poner para comprobar con php y cambiar si correcto-->
          <form action="/SupermercadoLeandro/index.php/producto/lista">
            <div class="form-group text-center mx-auto w-75">
              <input type="text" class="form-control" name="email" placeholder="Correo" autofocus required>
            </div>
            <div class="form-group text-center mx-auto w-75">
              <div class="input-group">
                <input type="password" class="form-control" email="contrasena" placeholder="Contraseña" required id="contrasena" />
                <div class="input-group-append">
                  <button class="btn btn-secondary" onclick="mostrarContrasena(0)">
                    <em class="bi-eye-slash" id="eye-1"></em>
                  </button>
                </div>
              </div>
            </div><br>
            <div class="form-group text-center">
              <button onclick='login()' type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="text-center">
              <span>¿No estás registrado? <a class="text-info" href="/SupermercadoLeandro/index.php/usuario/registro">Regístrate</a></span>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>