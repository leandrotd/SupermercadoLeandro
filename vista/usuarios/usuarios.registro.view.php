<div class="container-fluid h-100 w-75 py-2">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header text-center">
          <h2>Registro</h2>
        </div>
        <div class="card-body">
          <!--poner para comprobar con php y cambiar si correcto-->
          <form action="/SupermercadoLeandro/index.php/usuario/login">
            <div class="container-fluid text-center mx-auto w-75">
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <input type="email" class="form-control" name="email" placeholder="Email" autofocus required />
                    <!--<div class="alert alert-danger" *ngIf="username.invalid && (username.dirty || username.touched)">
                      <div class="" *ngIf="!username.valid">
                        {{ "UsernameRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required />
                    <!--<div class="alert alert-danger" *ngIf="
                          first_name.invalid && (first_name.dirty || first_name.touched)
                        ">
                      <div class="" *ngIf="!first_name.valid">
                        {{ "FirstNameRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required />
                    <!--<div class="alert alert-danger" *ngIf="
                      middle_name.invalid &&
                      (middle_name.dirty || middle_name.touched)
                    ">
                      <div class="" *ngIf="!middle_name.valid">
                        {{ "MiddleNameRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <input type="number" class="form-control" name="edad" placeholder="Edad" required min="1" />
                    <!--<div class="alert alert-danger" *ngIf="
                      last_name.invalid && (last_name.dirty || last_name.touched)
                    ">
                      <div class="" *ngIf="!last_name.valid">
                        {{ "LastNameRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <input type="text" class="form-control" name="direccion" placeholder="Direccion" required />
                    <!--<div class="alert alert-danger" *ngIf="
                      birth_date.invalid && (birth_date.dirty || birth_date.touched)
                    ">
                      <div class="" *ngIf="!birth_date.valid">
                        {{ "BirthDateRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <input type="text" class="form-control" name="telefono" placeholder="Telefono" />
                    <!--<div class="alert alert-danger" *ngIf="email.invalid && (email.dirty || email.touched)">
                      <div class="" *ngIf="!email.valid">
                        {{ "EmailRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <div class="input-group">
                      <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required id="contrasena1" />
                      <div class="input-group-append">
                        <button class="btn btn-secondary" onclick="mostrarContrasena(1)">
                          <em class="bi-eye-slash" id="eye-1"></em>
                        </button>
                      </div>
                    </div>
                    <!--<div class="alert alert-danger" *ngIf="password.invalid && (password.dirty || password.touched)">
                      <div class="" *ngIf="!password.valid">
                        {{ "PasswordRequired" | translate }}
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <div class="input-group">
                      <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required id="contrasena2" />
                      <div class="input-group-append">
                        <button class="btn btn-secondary" onclick="mostrarContrasena(2)">
                          <em class="bi-eye-slash" id="eye-2"></em>
                        </button>
                      </div>
                    </div>
                    <!--<div class="alert alert-danger" *ngIf="comprobarContra != user.password">
                      {{ "PasswordSame" | translate }}
                    </div>-->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">
                      Registrarse
                    </button>
                  </div>
                  <div class="text-center">
                    <span><a href="/SupermercadoLeandro/index.php/usuario/login">Volver a iniciar sesion</a></span>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>