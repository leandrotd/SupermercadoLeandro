<div class="container-fluid h-100 w-75 py-2">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
            <div class="row">
              <a class="btn btn-primary" type="button" name="button" href="/SupermercadoLeandro/index.php/producto/lista">
                Seguir comprando
              </a>
            </div>
            <div class="row mt-3">
              <div class="col-12 px-0">
                <div class="card h-100">
                  <div class="card-header">
                    <h4>Productos en el carrito</h4>
                  </div>
                  <div class="card-body">
                    <table class="table">
                      <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col" colspan="2">Precio</th>
                      </tr>
                      <?php //for por los productos
                      ?>
                      <tr>
                        <td>
                          <img class="imageSize" src="ruta imagen ()" alt="fotoProd1" />
                        </td>
                        <td>nombreProd1</td>
                        <td>cantidadProd1</td>
                        <td>precioProd1</td>
                        <td>
                          <button type="button" class="btn btn-danger" onclick="quitarElemento()">
                            <em class="bi bi-x-lg"></em>
                          </button>
                        </td>
                      </tr>
                    </table>
                    <hr />
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-3">
                          <h5>Precio Total:</h5>
                        </div>
                        <div class="col">
                          precio
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <!-- cambiar de pagina con js -->
                          <button class="btn btn-success" type="button" name="button" onclick="pagar()">
                            Pagar
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>