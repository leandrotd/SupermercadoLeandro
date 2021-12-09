<?php
//Comprueba si se quiere cerrar la sesion
if (isset($_POST['cerrar'])) {
    //Se borra los datos de sesion
    $_SESSION = array();
    //Borrar la cookie de carrito
    if (isset($_COOKIE['carrito'])) {
        unset($_COOKIE['carrito']);
        setcookie('carrito', null, -1, '/');
    }
    header('Location:/SupermercadoLeandro/index.php/usuario/login');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Supermercado Leandro</title>
    <meta charset="utf-8" />

    <!-- Icono de aplicacion -->
    <link rel="icon" href="/SupermercadoLeandro/public/assets/images/logo.png" type="image/x-icon" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/SupermercadoLeandro/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SupermercadoLeandro/public/assets/css/bootstrap-icons-1.7.1/bootstrap-icons.css">

    <!--Carga de estilos-->
    <link rel="stylesheet" href="/SupermercadoLeandro/public/assets/css/estilos.css">

    <!--Carga de scripts-->
    <script type="text/javascript" src="/SupermercadoLeandro/public/assets/js/funciones.js"></script>
</head>

<body <?php
        //Si la pagina actual corresponde a la lista de productos, que se actualicen las cantidades de los productos al cargar la pagina
        $direccion = substr($_SERVER['REQUEST_URI'], 21);
        if (strlen($direccion) == 0 || strlen($direccion) == 9 || $direccion == 'index.php/producto/lista') {
            echo 'onload="actualizarCantidades(true)"';
        } ?>>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="/SupermercadoLeandro/index.php"><img src="/SupermercadoLeandro/public/assets/images/logo.png" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerItems">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="headerItems">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php
                                    //Comprobar página para indicar con 'active' si es actualmente ella
                                    echo (substr($_SERVER['REQUEST_URI'], 31) == 'producto/lista') ? 'active' : ((substr($_SERVER['REQUEST_URI'], 31) == '') ? 'active' : ''); ?>">
                    <a class="nav-link" href="/SupermercadoLeandro/index.php/producto/lista">Productos</a>
                </li>
                <?php
                //Comprobar que tenga iniciada sesion
                if (isset($_SESSION['usuario'])) {
                    //Si es cliente, mostrar enlace a carrito
                    if ($this->getPermisos($_SESSION['usuario']) == -1) {
                        echo '<li class="nav-item ';
                        //Comprobar página para indicar con 'active' si es actualmente ella
                        echo (substr($_SERVER['REQUEST_URI'], 31) == 'factura/detalles') ? 'active' : '';
                        echo '">
                    <a class="nav-link" href="/SupermercadoLeandro/index.php/factura/detalles">Carrito</a>
                </li>';
                    }
                }
                //Si no tiene iniciada sesion
                else {
                    echo '<li class="nav-item ';
                    //Comprobar página para indicar con 'active' si es actualmente ella
                    echo (substr($_SERVER['REQUEST_URI'], 31) == 'usuario/login') ? 'active' : '';
                    echo '">
                    <a class="nav-link" href="/SupermercadoLeandro/index.php/usuario/login">Iniciar Sesion</a>
                </li>';
                }
                ?>


            </ul>
            <?php
            //Comprobar que tenga iniciada sesion
            if (isset($_SESSION['usuario'])) {
                echo '<div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" id="ddusuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $this->getNombre($_SESSION['usuario']) . '</a>
                <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="ddusuario">
                    <a class="dropdown-item" href="/SupermercadoLeandro/index.php/usuario/detalles?email=';

                echo $this->getCorreo($_SESSION['usuario']);

                echo '">Perfil</a>';

                $nivelPermisos = $this->getPermisos($_SESSION['usuario']);

                //Comprobar que sea un administrador
                if ($nivelPermisos == 0) {
                    echo '<a class="dropdown-item" href="/SupermercadoLeandro/index.php/empleado/lista">Lista Usuarios</a>';
                }
                echo '<hr class="dropdown-divider">
                        <form method="post" class="mb-0">
                            <button class="dropdown-item" name="cerrar" type="submit">Cerrar sesion</button>
                        </form>
                    </div>
                </div>';
            }
            ?>
        </div>
    </nav>
    <div class="contenedorPrincipal">
        <div class="container-fluid h-100 w-75 py-2">
            <div class="row">
                <div class="col">
                    <div class="card">