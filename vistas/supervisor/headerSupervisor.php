<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title><?php echo isset($tituloPagina) ? $tituloPagina : "Portal de SUPERVISIÓN vía a distancia"; ?></title>
    <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../librerias/fontawesome/css/all.css">
    <link src="../../librerias/sweetalert.min.js">
    </link>
    <link rel="stylesheet" type="text/css" href="../../css/extras.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/cerrar.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/classic.css">
    <link rel="stylesheet" href="../../css/classic.date.css">
    <link rel="stylesheet" href="../../css/extras.css">
    <link rel="stylesheet" href="../../css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <link rel="icon" href="../../img/a2.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../librerias/datatable/dataTables.bootstrap4.min.css">

    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <style>
                /* Estilo específico para el modal personalizado */
        .my-custom-modal .modal-content {
            /* Añade tus estilos personalizados aquí */
            border: 2px solid #e2f48a; /* Borde azul para diferenciar */
        }

        .my-custom-modal .modal-header {
            /* Añade tus estilos personalizados para el encabezado */
            background-color: #e2f48a; /* Fondo azul para diferenciar */
            color: white; /* Texto blanco para contrastar */
        }
        
    </style>
    
</head>

<body>
    

    <nav type="navbar" class="navbar navbar-expand-lg navbar-dark static-top" style="background-color: #1F6157;">
        <div class="container">
            <a class="navbar-brand" href="iniciosupervisor.php">
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
                        <a class="nav-link" href="iniciosupervisor.php"><span class="fa-solid fa-house"></span> Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardropSus" data-toggle="dropdown">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-table"></span> supervisión
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="crearAperturaSup.php">Crear Nueva Apertura</a>
                            <a class="dropdown-item" href="consultarApertura.php">Consultar Aperturas</a>

                        </div>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="seguimientoFinal.php" id="navbardropCedulas">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-check"></span> Seguimiento Final
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="subirMinuta.php" id="navbardropCedulas">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-upload"></span> Subir Archvivos
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardropCedulas" data-toggle="dropdown">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-book"></span> Unidad
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Informes.php">Informes </a>
                            <a class="dropdown-item" href="HistorialSup.php">Historial</a>
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

    
