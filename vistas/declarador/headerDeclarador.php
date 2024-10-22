<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo isset($tituloPagina) ? $tituloPagina : "Portal de SUPERVISIÓN vía a distancia"; ?></title>
    <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../librerias/fontawesome/css/all.css">
    <link src="../../librerias/sweetalert.min.js">
    </link>
    <link rel="stylesheet" href="../../css/animate.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../../css/extras.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/cerrar.css">
    <link rel="stylesheet" type="text/css" href="../../librerias/datatable/dataTables.bootstrap4.min.css">
    <link rel="icon" href="../../img/a2.ico" type="image/x-icon">

   

</head>

<body>
    <!-- Navigation -->
    
    <nav type="navbar" class="navbar navbar-expand-lg navbar-dark static-top"  style="background-color: #1F6157;">
        <div class="container">
            <a class="navbar-brand" href="inicioDeclarador.php">
                <img src="../../img/a.jpg" alt="" width="68px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="
            #navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="
            Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" id="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicioDeclarador.php"><span class="fa-solid fa-house"></span> Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Supervisiones.php" id="navbardropCedulas">
                            <i class="bi bi-menu-button-wide"></i><span class="fa-solid fa-table"></span> Supervisiones
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Seguimiento.php" id="navbardropCedulas">
                            <i class="bi bi-menu-button-wide"></i><span class="fa-solid fa-user-check"></span> Seguimiento
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Calificaciones.php" id="navbardropCedulas">
                            <i class="bi bi-menu-button-wide"></i><span class="fa-solid fa-list-check"></span> Calificaciones
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardropCedulas" data-toggle="dropdown">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-book"></span> Unidad
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Historial.php">Historial</a>
                            <a class="dropdown-item" href="Directorio.php">Directorio</a>

                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"  href="javascript:void(0);" onclick="cerrarSesion()">
                            <span class="fas fa-power-off"></span> Cerrar sesion <!-- alta de usuario o consulatr-->
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    