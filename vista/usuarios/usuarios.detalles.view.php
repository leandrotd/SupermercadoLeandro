<div class="container-fluid h-100 w-75 py-2">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          "Nombre de usuario"
        </div>
        <div class="card-body">
          <a class="btn btn-primary mb-3" href="/SupermercadoLeandro/index.php/producto/lista">
            Atrás
          </a>
          <form method="post" action="/SupermercadoLeandro/index.php/producto">
            <div class="form-group row">
              <label for="email" class="col-form-label col-sm-2">
                Email
              </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="email" required minlength="2" />

                <!--<div class="alert alert-danger" *ngIf="username.invalid && (username.dirty || username.touched)">
                  <div class="" *ngIf="!username.valid">
                    {{ "UsernameRequired" | translate }}
                  </div>
                </div>-->
              </div>
            </div>
            <div class="form-group row">
              <label for="contrasena" class="col-form-label col-sm-2">
                Contraseña
              </label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input type="password" class="form-control" name="contrasena" required id="contrasena"/>

                  <div class="input-group-append">
                    <button class="btn btn-secondary" onclick="mostrarContrasena(0)">
                      <em id="iconoContrasena" class="bi-eye-slash"></em>
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

            <div class="form-group row">
              <label for="nombre" class="col-form-label col-sm-2">
                Nombre
              </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="nombre" required />
                <!--<div class="alert alert-danger" *ngIf="
              first_name.invalid && (first_name.dirty || first_name.touched)
            ">
                  <div class="" *ngIf="!first_name.valid">
                    {{ "FirstNameRequired" | translate }}
                  </div>
                </div>-->
              </div>
            </div>

            <div class="form-group row">
              <label for="apellidos" class="col-form-label col-sm-2">
                Apellidos
              </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="apellidos" required />
                <!--<div class="alert alert-danger" *ngIf="
              middle_name.invalid && (middle_name.dirty || middle_name.touched)
            ">
                  <div class="" *ngIf="!middle_name.valid">
                    {{ "MiddleNameRequired" | translate }}
                  </div>
                </div>-->
              </div>
            </div>

            <div class="form-group row">
              <label for="edad" class="col-form-label col-sm-2">
                Edad
              </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="edad" required />
                <!--<div class="alert alert-danger" *ngIf="last_name.invalid && (last_name.dirty || last_name.touched)">
                  <div class="" *ngIf="!last_name.valid">
                    {{ "LastNameRequired" | translate }}
                  </div>
                </div>-->
              </div>
            </div>

            <div class="form-group row">
              <label for="direccion" class="col-form-label col-sm-2">
                Direccion
              </label>
              <div class="col-sm-6">
                <input type="date" class="form-control" name="direccion" required />
                <!--<div class="alert alert-danger" *ngIf="
              birth_date.invalid && (birth_date.dirty || birth_date.touched)
            ">
                  <div class="" *ngIf="!birth_date.valid">
                    {{ "BirthDateRequired" | translate }}
                  </div>
                </div>-->
              </div>
            </div>

            <div class="form-group row">
              <label for="telefono" class="col-form-label col-sm-2">
                Telefono
              </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="telefono" required />
                <!--<div class="alert alert-danger" *ngIf="email.invalid && (email.dirty || email.touched)">
                  <div class="" *ngIf="!email.valid">
                    {{ "EmailRequired" | translate }}
                  </div>
                </div>-->
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <button class="btn btn-primary" role="button" type="submit">
                  Modificar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>