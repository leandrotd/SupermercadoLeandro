<div class="container-fluid h-100 w-75 py-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Usuarios
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#clientesTab" role="tab">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#empleadosTab" role="tab">Empleados</a>
                        </li>
                    </ul>
                    <!-- php cargando la lista -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="clientesTab" role="tabpanel">
                            <button class="btn btn-primary m-2" type="button">Text</button>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Edad</th>
                                        <th>Direccion</th>
                                        <th colspan="2">Telefono</th>
                                    </tr>
                                    <tr>
                                        <td>id</td>
                                        <td>nombre</td>
                                        <td>apellidos</td>
                                        <td>edad</td>
                                        <td>direccion</td>
                                        <td>telefono</td>
                                        <td>botones</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="empleadosTab" role="tabpanel">
                            <button class="btn btn-primary m-2" type="button">Text</button>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>DNI</th>
                                        <th>Cargo</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Edad</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th colspan="2">Sueldo</th>
                                    </tr>
                                    <tr>
                                        <td>id</td>
                                        <td>dni</td>
                                        <td>cargo</td>
                                        <td>nombre</td>
                                        <td>apellidos</td>
                                        <td>edad</td>
                                        <td>direccion</td>
                                        <td>telefono</td>
                                        <td>sueldo</td>
                                        <td>botones</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>