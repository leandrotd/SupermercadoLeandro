<div class="container-fluid h-100 w-75 py-2">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form action="/SupermercadoLeandro/index.php/producto/lista" method="post">
            <div class="container-fluid mr-2">
              <div class="row">
                <a class="btn btn-primary" href="/SupermercadoLeandro/index.php/producto/lista">
                  Volver
                </a>
              </div>
              <div class="row mt-3">
                <div class="col-12 col-md-3 text-center">
                  <img src="public/assets/images/imgprueba.png" height="150px" width="150px" alt="imagen" />
                  <input type="file" name="picture" onchange="enviarImagen(<?php echo 'el id'; ?>)" class="form-control mt-2" />
                </div>
                <div class="col-12 col-md-9 px-0 px-md-auto">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="container-fluid px-0 px-md-auto">
                          <div class="row mt-3">
                            <div class="col">
                              <label for="nombre" class="form-label">Nombre</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required />
                              <!--
                              Comprobacion
                              <div class="alert alert-danger" *ngIf="name.invalid && (name.dirty || name.touched)">
                                <div class="" *ngIf="!name.valid">
                                  Error en el nombre
                                </div>
                              </div>-->
                            </div>
                          </div>
                          <div class="row mt-3">
                            <div class="col">
                              <label for="cantidad" class="form-label">Cantidad</label>
                              <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?php echo isset($cantidad) ? $cantidad : ''; ?>" required />
                              <!--
                              Comprobacion
                              <div class="alert alert-danger" *ngIf="amount.invalid && (amount.dirty || amount.touched)" min=0>
                                <div class="" *ngIf="!amount.valid">
                                  Error en la cantidad
                                </div>
                              </div>-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="container-fluid px-0 px-md-auto">
                          <div class="row mt-3">
                            <div class="col">
                              <label for="precio" class="form-label">Precio</label>
                              <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio por unidad" value="<?php echo isset($precio) ? $precio : ''; ?>" required />
                              <!--
                              Comprobacion
                              <div class="alert alert-danger" *ngIf="price.invalid && (price.dirty || price.touched)" min=0>
                                <div class="" *ngIf="!price.valid">
                                  Error en el precio
                                </div>
                              </div>-->
                            </div>
                          </div>
                          <div class="row mt-3">
                            <div class="col">
                              <label for="categoria" class="form-label">Categoria</label>
                              <select class="form-control" name="categoria" id="categoria">
                                <option></option>
                                <option></option>
                                <option></option>
                              </select>
                              <!--
                              Opcional
                              <div class="alert alert-danger" *ngIf="category.invalid && (category.dirty || category.touched)">
                                <div class="" *ngIf="!category.valid">
                                  Error en la categoria
                                </div>
                              </div>-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="description" placeholder="Escribe una descripcion del producto."></textarea>
                        <!--
                        Opcional
                        <div class="alert alert-danger" *ngIf="description.invalid && (description.dirty || description.touched)">
                          <div class="" *ngIf="!description.valid ">
                            Error en la descripcion
                          </div>
                          </div>
                        </div>-->
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col text-center">
                  <!--Comprobar si es crear o modificar-->
                  <button class="btn btn-success btn-lg" role="button" type="submit">
                    Crear
                  </button>
                  <button class="btn btn-success btn-lg" role="button" type="submit">
                    Modificar
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>