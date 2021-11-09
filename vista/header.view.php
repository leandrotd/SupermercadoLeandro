<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo isset($_SESSION['pagAct']) ? $_SESSION['pagAct'] : 'Supermercado Leandro'; ?></title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/estilos.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="public/assets/images/logo.png" alt="Logo" class="img-fluid"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerItems">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="headerItems">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?php //comprobar pagina 
                                    ?>">
                    <a class="nav-link" href="#">Frutas</a>
                </li>
                <li class="nav-item <?php //comprobar pagina 
                                    ?>">
                    <a class="nav-link" href="#">Verduras</a>
                </li>
                <li class="nav-item <?php //comprobar pagina 
                                    ?>">
                    <a class="nav-link" href="#">Sobre Nosotros</a>
                </li>
            </ul>
            <?php //comprobar si ha iniciado sesion y de que tipo es
            ?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="ddusuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
                <div class="dropdown-menu dropdown-menu-md-right" aria-labelledby="ddusuario">
                    <a class="dropdown-item" href="#">Perfil</a>
                    <?php //depende del tipo
                    ?>
                    <a class="dropdown-item" href="#">Lista Usuarios</a>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <a class="dropdown-item" href="#">Cerrar sesion</a>
                </div>
            </div>
        </div>
    </nav>
    <div>