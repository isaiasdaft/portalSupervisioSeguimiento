<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo isset($tituloPagina) ? $tituloPagina : "Portal de SUPERVISIÓN vía a distancia"; ?></title>
    <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../librerias/fontawesome/css/all.css">
    <link src="../../librerias/sweetalert.min.js">
    </link>
    <link rel="stylesheet" href="../../css/animate.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../css/extras.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/cerrar.css">
    <link rel="icon" href="../../img/a2.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../librerias/datatable/dataTables.bootstrap4.min.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto;
        
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #90b6a3;
        }

        @media (max-width: 600px) {

            th,
            td {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body class="animated fadeIn">
    <nav type="navbar" class="navbar navbar-expand-lg navbar-dark static-top" style="background-color: #1F6157;">
        <div class="container">
            <a class="navbar-brand" href="inicio.php">
                <img src="../../img/a.jpg" alt="" width="68px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="
            #navbarResponsive" aria-controls="navbarResponsive" aria-haspopup="true" aria-expanded="false" aria-label="
            Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" id="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="inicio.php"><span class="fa-solid fa-house"></span> Inicio
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardropSus" data-toggle="dropdown">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-table"></span> supervisión
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="CrearApertura.php">Crear Nueva Apertura</a>
                            <a class="dropdown-item" href="aperturaAdmin.php">Consultar Aperturas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-toggle="dropdown" id="navbardropSus">
                                <i class="bi bi-menu-button-wide"></i>Puntos Sustantivos
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="CapacitacionTransparencia.php">Departamento de Capacitación y Transparencia</a></li>
                                <li><a class="dropdown-item" href="Personal.php">Departamento de Personal</a></li>
                                <li><a class="dropdown-item" href="Relaciones.php">Departamento de Realaciones Laborales</a></li>
                                <li><a class="dropdown-item" href="Presupuesto.php">Departamento de Presupuesto y control de gastos</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardropCedulas" data-toggle="dropdown">
                            <i class="bi bi-menu-button-wide"></i><span class="far fa-folder"></span> Cédulas
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="crearCedula.php">Generar cédula</a>
                            <a class="dropdown-item" href="archivarCedula.php">Archivar </a>
                            <a class="dropdown-item" href="adicional.php">adicional </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardropCedulas" data-toggle="dropdown">
                            <i class="bi bi-menu-button-wide"></i><span class="fas fa-book"></span> Unidad
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="InformesAdmin.php">Informes Minuta</a>
                            <a class="dropdown-item" href="Historial.php">Historial</a>
                            <a class="dropdown-item" href="directorioAdmin.php">Directorio</a>
                            <a class="dropdown-item" href="Estadisticas.php">Estadisticas</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <span class="fas fa-user"></span> Usuarios
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="adminUsuarios.php">Visualizar usuarios</a>
                            <a class="dropdown-item" href="crearUsuarios.php">Registrar nuevo usuario</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="cerrarSesion()">
                            <span class="fas fa-power-off"></span> Cerrar sesion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>