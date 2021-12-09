<?php
//Obtiene los clientes
$clientes = $this->getClientes();
//Obtiene los empleados
$empleados = $this->getEmpleados();

//Si se ha pulsado el boton de borrar
if (isset($_POST['id'])) {
  //Comprueba que no sea el usuario que tiene sesion iniciada el que se borra
  if ($_SESSION['usuario'] != $_POST['id']) {
    $this->borrarUsuario($_POST['id']);
    header('Location:/SupermercadoLeandro/index.php/empleado/lista');
  } else {
    echo '<script>alert("No puedes borrar tu usuario, otro administrador debe hacerlo")</script>';
  }
}

?>
<div class="card-header card-header-main">
  Usuarios
</div>
<div class="card-body">
  <a href="/SupermercadoLeandro/index.php/usuario/registro" class="btn btn-success mb-3">
    <i class="bi bi-plus-lg"></i> Añadir
  </a>
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#clientesTab" role="tab">Clientes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#empleadosTab" role="tab">Empleados</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane" id="clientesTab" role="tabpanel">
      <table class="table">
        <tbody>
          <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellidos</th>
          </tr>
          <?php
          //Lista de clientes
          foreach ($clientes as $cliente) {
            echo '<tr>
                      <td class="text-nowrap">';

            echo '<a class="btn btn-success mr-1" href="/SupermercadoLeandro/index.php/usuario/detalles?email=' . $cliente->getEmail() . '"><i class="bi bi-eye"></i></a>';


            echo '<form method="post" class="d-inline">';
            echo "<button class='btn btn-danger' type='submit' onclick='return confirm(\"¿Seguro que quieres borrar el usuario " . $cliente->getNombre() . "\")' name='id' value='" . $cliente->getIdUsuario() . "'><i class='bi bi-x-lg'></i></button>";
            echo '</form>';
            echo '</td>
                      <td>' . $cliente->getNombre() . '</td>
                      <td>' . $cliente->getApellidos() . '</td>
                    </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane active" id="empleadosTab" role="tabpanel">
      <table class="table">
        <tbody>
          <tr>
            <th></th>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Admin</th>
            <th>Sueldo</th>
          </tr>
          <?php
          //Lista de empleados
          foreach ($empleados as $empleado) {
            echo '<tr>
                      <td class="text-nowrap">';

            echo '<a class="btn btn-success mr-1" href="/SupermercadoLeandro/index.php/usuario/detalles?email=' . $empleado->getEmail() . '"><i class="bi bi-eye"></i></a>';


            echo '<form method="post" class="d-inline">';
            echo "<button class='btn btn-danger' type='submit' onclick='return confirm(\"¿Seguro que quieres borrar el usuario " . $empleado->getNombre() . "\")' name='id' value='" . $empleado->getIdUsuario() . "'><i class='bi bi-x-lg'></i></button>";
            echo '</form>';
            echo '</td>
                      <td>' . $empleado->getDNI() . '</td>
                      <td>' . $empleado->getNombre() . '</td>
                      <td>' . $empleado->getCargo() . '</td>
                      <td>' . (($empleado->getTipo() == 0) ? 'Si' : 'No') . '</td>
                      <td>' . $empleado->getSueldo() . '</td>
                    </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>