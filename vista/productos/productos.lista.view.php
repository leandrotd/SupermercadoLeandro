<div class="container-fluid h-100 w-75 py-2">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          Filtros
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row align-items-center">
              <div class="col-5 col-lg-3">
                <span class="text-nowrap">Nombre Producto:</span>
                <input type="text" class="form-control">
              </div>
              <div class="col-5 col-lg-3">
                <!--poner php aqui-->
                Categoria:
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>pito</option>
                </select>
              </div>
              <div class="col-1">
                <br/>
                <button class="btn btn-primary"><i class="bi bi-search"></i></button>
              </div>
              <div class="col-12 col-lg-5">
                Ordenar por:
                <div>
                  <a href="#" class="text-nowrap">Precio
                    <!-- al hacer click que cambie con  -->
                    <i class="bi bi-sort-numeric-down-alt"></i>
                    <i class="bi bi-sort-numeric-down"></i>
                  </a>
                  <a href="#" class="text-nowrap pl-1 border-left">Nombre
                    <!-- al hacer click que cambie con  -->
                    <i class="bi bi-sort-down"></i>
                    <i class="bi bi-sort-down-alt"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row h-75">
    <div class="col-12">
      <!-- cargar la tabla con php -->
      <div class="card rounded-0">
        <div class="card-header rounded-0">
          <div class="container-fluid">
            <div class="row">
              <!-- foto, nombre, precio, categoria, botones -->
              <div class="col-6 offset-1">
                Nombre
              </div>
              <div class="col-2">
                Cantidad
              </div>
              <div class="col-2">
                Precio
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row align-items-center">
              <!-- foto, nombre, precio, categoria, botones -->
              <div class="col-1 p-0">
                <img src="<?php echo '/SupermercadoLeandro/public/assets/images/imgprueba.png'; ?>">
              </div>
              <div class="col-6">
                Nombre
                <!--enlace a detalles del producto-->
              </div>
              <div class="col-2">
                <input class="form-control" type="number" min="1" max="<?php echo 23; ?>" value="1">
              </div>
              <div class="col-2">
                Precio
              </div>
              <div class="col-1">
                <button class="btn btn-primary"> <i class="bi bi-cart-plus"></i></button>
                <!-- Agregar mas si es admin -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>