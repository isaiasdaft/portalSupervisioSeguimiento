<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../index.php');

    exit;
} else {
    $idd = $_SESSION['id'];
    $sup = $_GET["id"];
    $ideclarador = $_GET["ideclarador"];
}
$tituloPagina = "Evaluar Supervisiones";
?>

<?php include("headerSupervisor.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervision</title>
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/cerrar.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/classic.css">
    <link rel="stylesheet" href="../../css/classic.date.css">
    <link rel="stylesheet" href="../../css/extras.css">
    <link rel="stylesheet" href="../../css/table.css">
</head>

<body>

    <Center>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-5"> Supervisión Final</h1>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Asignar Calificación y Comentario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="calificacionComentarioForm">
                                    <div class="form-group">
                                        <label for="calificacion">Calificación:</label>
                                        <select class="form-control" name="calificacion" id="calificacion">
                                            <option value="">Selecciona la calificación de 1 a 3</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comentario">Comentario:</label>
                                        <textarea class="form-control" name="comentario" id="comentario"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div id="modalAlert" class="alert" role="alert" style="display: none;"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="modalGuardar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="modal fade my-custom-modal" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEditar" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Editar Calificación y Comentario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="calificacionComentarioeditForm">
                                    <div class="form-group">
                                        <label for="calificacion">Calificación:</label>
                                        <select class="form-control" name="calificacion2" id="calificacion2">
                                            <option value="">Selecciona la calificación de 1 a 3</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comentario2">Comentario:</label>
                                        <textarea class="form-control" name="comentario2" id="comentario2"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div id="modalAlert2" class="alert" role="alert" style="display: none;"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="modalEditar">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="tablaSupFinal">
                                <thead style="background-color: #93B8A1; color: #0f2220;">
                                    <tr>
                                        <td>ID</td>
                                        <td>Procesos Sustantivos</td>
                                        <td><center>Asignar Comentario y Calificación </td>
                                        <td>Calificación</td>
                                        <td>Comentario </td>
                                        <td>Petición </td>
                                        <td>Nombre Archivo </td>
                                        <td>Adjunto </td>
                                        <td>Seguimiento</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $consulta2 = "SELECT DISTINCT puntos_sustantivos.id, titulo, calificacion,
                                comentario, especificacion,departamento.nombre as depar, 
                                archivos_super.nombre_archivo FROM puntos_sustantivos 
                                INNER JOIN departamento ON puntos_sustantivos.departamento=departamento.id
                                 INNER JOIN usuario ON departamento.id = usuario.departamento 
                                 INNER JOIN calificacion_supervision ON puntos_sustantivos.id = calificacion_supervision.id_punto 
                                 INNER JOIN especificaciones_supervisor ON 
                                 (calificacion_supervision.id_sup = especificaciones_supervisor.id_sup 
                                 AND calificacion_supervision.id_punto = especificaciones_supervisor.id_punto)
                               INNER JOIN archivos_super ON especificaciones_supervisor.id = archivos_super.id_espe
                   WHERE calificacion_supervision.id_sup = '$sup' AND usuario.id = $idd; ";
                                    $ejecutar2 = mysqli_query($conexion, $consulta2);
                                    $i = 0;
                                    while ($fila = mysqli_fetch_array($ejecutar2)) {
                                        $id = $fila['id'];
                                        $punto = $fila['titulo'];
                                        $cal = $fila['calificacion'];
                                        $come = $fila['comentario'];
                                        $esp = $fila['especificacion'];
                                        $arhivo = $fila['nombre_archivo'];
                                        $titulo_utf8 = mb_convert_encoding($punto, "UTF-8", "auto");
                                    ?>
                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $titulo_utf8; ?></td>
                                            <td>
                                                <?php if (empty($cal) && empty($come)) { ?>
                                                    <a href="#" class="asignar" data-idpunto="<?php echo $id; ?>" data-idsup="<?php echo $sup; ?>" data-toggle="modal" data-target="#myModal">
                                                        <center><span class="btn btn-success btn-md"><span class="fa-solid fa-comment-medical" style="color: #ffffff;"></span></span></center>
                                                    </a>
                                                <?php } else { ?>
                                                    Comentario y Calificación Asignados
                                                    <a href="#" class="editar" data-idpunto="<?php echo $id; ?>" data-idsup="<?php echo $sup; ?>"  data-toggle="modal" data-target="#myModalEditar">
                                                            Editar
                                                        </a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <center><?php echo $cal; ?></center>
                                            </td>
                                            <td><?php echo $come; ?></td>
                                         
                                            <td><?php echo $esp; ?></td>
                                            <td><?php echo $arhivo; ?></td>
                                            <td>
                                                <a href="downloadSupervision.php?file=<?php echo $arhivo; ?>">
                                                    <center></center>
                                                    <span class="btn btn-light btn-sm"><span class="fa-solid fa-download" style="color: #000000;"></span> Descargar</span>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if (empty($cal) && empty($come)) { ?>
                                                <?php } else if ($cal == 1 || $cal == 2) { ?>
                                                    <a href="EnviarSeguimiento.php?id=<?php echo $id; ?>&id_sup=<?php echo $sup; ?>">Enviar a Seguimiento</a>
                                                <?php } else { ?>
                                                    <!-- No mostrar nada si la calificación es 3 -->
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
    </center>
    </p>
    </option>
    </center>
    </div>
    </div>
</body>
</html>

<?php include("footerSupervisor.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.asignar').click(function() {
            var id_punto = $(this).data('idpunto');
            var id_sup = $(this).data('idsup');
            console.log("id_punto: " + id_punto);
            console.log("id_sup: " + id_sup);

            $('#myModal').data('idpunto', id_punto);
            $('#myModal').data('idsup', id_sup);
        });

        $('#modalGuardar').click(function() {
            var id_punto = $('#myModal').data('idpunto');
            var id_sup = $('#myModal').data('idsup');
            var calificacion = $('#calificacion').val();
            var comentario = $('#comentario').val();
            if (calificacion !== '' && comentario !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'guardar_calificacion.php',
                    data: {
                        id_punto: id_punto,
                        calificacion: calificacion,
                        comentario: comentario,
                        id_sup: id_sup
                    },
                    success: function(response) {
                        $('#modalAlert').removeClass('alert-danger').addClass('alert-success').text('Datos guardados correctamente.');
                        $('#modalAlert').show();
                        actualizarTabla(id_punto, calificacion, comentario);

                        setTimeout(function() {
                            $('#myModal').modal('hide');
                        }, 2000);
                    },
                    error: function() {
                        alert("Error al asignar calificación y comentario");
                    }
                });
            } else {
                alert("Por favor, ingresa calificación y comentario antes de guardar.");
            }
        });

        $('.editar').click(function() {
            var id_punto = $(this).data('idpunto');
            var id_sup = $(this).data('idsup');
            console.log("id_punto: " + id_punto);
            console.log("id_sup: " + id_sup);

            $('#myModalEditar').data('idpunto', id_punto);
            $('#myModalEditar').data('idsup', id_sup);
        });

        $('#modalEditar').click(function() {
            var id_punto = $('#myModalEditar').data('idpunto');
            var id_sup = $('#myModalEditar').data('idsup');
            var calificacion = $('#calificacion2').val();
            var comentario = $('#comentario2').val();
            if (calificacion !== '' && comentario !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'guardar_calificacion.php',
                    data: {
                        id_punto: id_punto,
                        calificacion: calificacion,
                        comentario: comentario,
                        id_sup: id_sup
                    },
                    success: function(response) {
                        $('#modalAlert2').removeClass('alert-danger').addClass('alert-success').text('Datos guardados correctamente.');
                        $('#modalAlert2').show();
                        actualizarTabla(id_punto, calificacion, comentario);

                        setTimeout(function() {
                            $('#myModalEditar').modal('hide');
                        }, 2000);
                    },
                    error: function() {
                        alert("Error al asignar calificación y comentario");
                    }
                });
            } else {
                alert("Por favor, ingresa calificación y comentario antes de guardar.");
            }
        });


        function actualizarTabla(id_punto, calificacion, comentario) {
            // Encuentra la fila correspondiente utilizando el atributo de datos
            var fila = $('#tablaSupFinal').find('tr[data-id="' + id_punto + '"]');
            fila.find('td.calificacion').html(calificacion);
            fila.find('td.comentario').html(comentario);
            var seguimientoColumna = fila.find('td.seguimiento');
            if (calificacion == 1 || calificacion == 2) {
                seguimientoColumna.html('<a href="EnviarSeguimiento.php?id=' + id_punto + '">Seguimiento</a>');
            } else {
                seguimientoColumna.html('');
            }
        }

    });
</script>


