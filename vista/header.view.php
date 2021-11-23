<!DOCTYPE html>
<html lang="es">

<head>
    <title>Supermercado Leandro</title>
    <meta charset="utf-8" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/SupermercadoLeandro/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SupermercadoLeandro/public/assets/css/bootstrap-icons-1.7.1/bootstrap-icons.css">

    <!--Carga de estilos-->
    <link rel="stylesheet" href="/SupermercadoLeandro/public/assets/css/estilos.css">

    <!--Carga de scripts-->
    <script type="text/javascript" src="/SupermercadoLeandro/public/assets/js/usuarios.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/SupermercadoLeandro/index.php"><img src="/SupermercadoLeandro/public/assets/images/imgprueba.png" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerItems">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="headerItems">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php //comprobar pagina 
                                    ?>">
                    <a class="nav-link" href="/SupermercadoLeandro/index.php/producto/lista">Productos</a>
                </li>
                <li class="nav-item <?php //comprobar pagina 
                                    ?>">
                    <a class="nav-link" href="/SupermercadoLeandro/index.php/factura/detalles">Carrito</a>
                </li>
            </ul>
            <?php //comprobar si ha iniciado sesion y de que tipo es
            ?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="ddusuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="ddusuario">
                    <a class="dropdown-item" href="/SupermercadoLeandro/index.php/usuario/detalles">Perfil</a>
                    <?php //depende del tipo
                    ?>
                    <a class="dropdown-item" href="/SupermercadoLeandro/index.php/empleado/lista">Lista Usuarios</a>
                    <?php //depende del tipo
                    ?>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="#" onclick="cerrarSesion()">Cerrar sesion</a>
                </div>
            </div>
        </div>
    </nav>
    <div>