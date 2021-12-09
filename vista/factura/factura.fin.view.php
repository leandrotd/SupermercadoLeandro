<?php
//Comprueba que esté presente el identificador de la factura
if (!isset($_GET['id'])) {
  header('Location:/SupermercadoLeandro/index.php/producto/lista');
}
?>
<div class="card-header card-header-main text-center">
  <h2>
    Tu compra se ha efectuado correctamente.
  </h2>
</div>
<div class="card-body">
  <div class="container-fluid">
    <div class="row my-5">
      <div class="col text-center">
        <h4>
          El codigo de compra es: <?php echo $_GET['id']; ?>
        </h4>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col text-center">
        <a class="btn btn-primary" href="/SupermercadoLeandro/index.php/producto/lista">Continuar</a>
      </div>
    </div>
  </div>
</div>