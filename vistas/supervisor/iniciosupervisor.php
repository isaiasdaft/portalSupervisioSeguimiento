<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Inicio";
?>

<?php include("headerSupervisor.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Supervision</title>

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
            background-repeat: no-repeat;
            background-position: center center;
            color: #fff; /* Cambiar el color del texto según sea necesario para una mejor visibilidad */
            height: 100vh;
            }

        .jumbotron h1,
        h6 {
            color: #263c32;
        }

        .id-column {
            background-color: #ecf6f2;
            color: #0c0d0d;
        }

        .name-column {
            background-color: #ecf6f2;
            /* Tu color deseado */
            color: #0c0d0d;
        }

        .unidad-column {
            background-color: #ecf6f2;
            /* Tu color deseado */
            color: #0c0d0d;
        }

        .feI-column {
            background-color: #ecf6f2;
            /* Tu color deseado */
            color: #0c0d0d;
        }

        .feF-column {
            background-color: #ecf6f2;
            /* Tu color deseado */
            color: #0c0d0d;
        }

        .tipo-column {
            background-color: #ecf6f2;
            color: #0c0d0d;
        }

        .tipo-boton {
            background-color: #ecf6f2;
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
                        <h2>Usuario: <?php echo $name_utf8; ?></h2>
                    </div>

                    </h1><?php } ?>
                </div>
                <br>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                    Actividades Pendientes:
                </button>
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pendientes:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">
                                    <h6>Verifica que los datos de las nuevas aperturas sean correctos, y crear cada supervisión en el botón de inicar.</h6>
                                </div>
                                <div id="tablaGestor"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
            </div>
            </div>
    </center>

</body>

</html>

<?php include("footerSupervisor.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaGestor').load("gestorPendientes.php");
    });
</script>