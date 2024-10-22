<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Inicio";
?>

<?php include("headerAdmin.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision</title>
    <link rel="stylesheet" href="../../css/animate.min.css">
    <link rel="stylesheet" href="../../css/extras.css">

    <style>
        .jumbotron {
            /* Establecer la imagen de fondo y configurar el estilo */
            background: url('../../img/fondo-imss-white.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            /* Cambiar el color del texto según sea necesario para una mejor visibilidad */
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

        .jumbotron h1,
        h6 {
            color: #263c32;
            /* Cambiar el color del texto h1 a blanco */
        }
    </style>
</head>

<body class="animated fadeIn">

    <center>
        <div class="animated bounceIn">

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
                            <h2><?php echo $name_utf8; ?>
                        </div>

                        </h1><?php } ?>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Info
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Inicio:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6>Accede a la sección de supervisión, para crear nuevas aperturas para iniciar con la supervisiónes requeridas.</h6>
                                    <p></p>
                                    <h6> Las aperturas iniciadas seran notificadas a los supervisores de cada departamento. </h6>
                                    <p></p>
                                    <img src="../../img/sep.jpg" alt="" width="290px">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <a class="btn btn-primary" href="CrearApertura.php">Crear Apertura</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </div>
        </div>

    </center>

</body>

</html>

<?php include("footerAdmin.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaGestor').load("gestorPendientes.php");
    });
</script>