<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Inicio ";

?>

<?php include("headerDeclarador.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../css/extras.css">
    <title>Document</title>

    <style>
        .modal-content table tbody tr:nth-of-type(odd) td {
        background-color: #f9f9f9;
        }

    .modal-content table tbody tr:hover td {
        background-color: #e0e0e0;
    }
        .custom-tabs {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .nav-link {
            color: #007bff;
        }

        .nav-link:hover {
            color: #0056b3;
        }

        .tab-content {
            margin-top: 20px;
        }
        .jumbotron {
            /* Establecer la imagen de fondo y configurar el estilo */
            background: url('../../img/fondo-imss-white.jpg') no-repeat center center fixed;
            background-size: cover;
            background-repeat: no-repeat;
             background-position: center center;
            color: #fff; /* Cambiar el color del texto según sea necesario para una mejor visibilidad */
            height: 100vh;
        }
        html, body {
            background: url('../../img/fondo-imss-white.jpg') no-repeat center center fixed;
            background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            color: #fff; /* Cambiar el color del texto según sea necesario para una mejor visibilidad */
            height: 100vh;
            }
        
        .jumbotron h1, h6 {
            color: #263c32; /* Cambiar el color del texto h1 a blanco */
        }
        .id-column {
            background-color:  #ecf6f2;
            color: #0c0d0d;
        }
        .name-column {
            background-color:  #ecf6f2; /* Tu color deseado */
            color: #0c0d0d;
        }
        .unidad-column {
            background-color:  #ecf6f2; /* Tu color deseado */
            color: #0c0d0d;
        }
        .feI-column {
            background-color:  #ecf6f2; /* Tu color deseado */
            color: #0c0d0d;
        }
        .feF-column {
            background-color:  #ecf6f2; /* Tu color deseado */
            color: #0c0d0d;
        }

    </style>

<style>
    .table td {
        color: #000; /* Cambia el color del texto a negro */
    }
</style>

</head>

<body>

    <center>

        <?php

        $ejecutar = $conexion->query("SELECT nombre FROM usuario WHERE id = $idd");
        while ($fila = $ejecutar->fetch_array()) {
            $name = $fila["nombre"];

            $name_utf8 = mb_convert_encoding($name, "UTF-8", "auto");
        ?>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <div class="welcome">
                        <h1>Bienvenid@ al PORTAL DE SUPERVISIÓN y SEGUIMIENTO VÍA REMOTA: </h1><br>
                        <h2>Usuario: <?php echo $name_utf8; ?>
                    </div>

                    </h1><?php } ?>
                </div>
                <br>
                <br>
                <div>
                    <h4>Actividades</h4>
                </div>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Actividades Pendientes:
                </button>
                <br>
                <br>
                <br>
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Pendientes por atender:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Agregamos pestañas -->
                                <ul class="nav nav-tabs" id="myTabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="supervisiones-tab" data-toggle="tab" href="#supervisiones">Supervisiones Pendientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="seguimientos-tab" data-toggle="tab" href="#seguimientos">Seguimientos Pendientes</a>
                                    </li>
                                </ul>

                                <!-- Contenido de las pestañas -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="supervisiones">
                                        <div class="modal-body">
                                        Visualiza las fechas de las supervisiones pendientes proximos a entregar.
                                            <div id="tablaPendi"></div>
                                            <br>
                                            <a class="btn btn-dark" href="Supervisiones.php">Ver supervisiones</a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="seguimientos">
                                        <div class="modal-body">
                                            Visualiza las fechas de los seguimientos pendientes proximos a entregar.
                                            <div id="tablaSegui"></div>
                                            <br>
                                            <a class="btn btn-dark" href="Seguimiento.php">Ver Seguimientos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
    </center>

</body>

</html>

<?php include("footerDeclarador.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaPendi').load("gestorPendientes.php");
        $('#tablaSegui').load("gestorPendientes2.php");

    });
</script>