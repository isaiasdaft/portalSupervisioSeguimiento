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
    $pun = $_GET["punto"];
}
$tituloPagina = "Avances supervisiones";

?>


<?php include("headerSupervisor.php"); ?>


<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Asignar Observación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="observasionesAvance">
                            <div class="form-group">
                                <label for="observacion">Comentarios:</label>
                                <textarea class="form-control" name="observacion" id="observacion" disabled></textarea>
                            </div>
                        </form>
                    </div>
                    <div id="modalAlert" class="alert" role="alert" style="display: none;"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="modalGuardar" disabled>Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <center>
            <h1 class="display-5"> Avances de la Supervisión</h1>
        </center>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-secondary table-stripper" id="tablaAvances">
                        <thead>
                            <tr>
                                <td bgcolor="#A4CBB3">ID</td>
                                <td bgcolor="#A4CBB3">Archivo</td>
                                <td bgcolor="#A4CBB3">Tamaño</td>
                                <td bgcolor="#A4CBB3">Fecha de Subida</td>
                                <td bgcolor="#A4CBB3">Descargar</td>
                                <td bgcolor="#A4CBB3">Observaciones</td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulta = "SELECT avances.id, apertura_supervisor.nombre_supervision, puntos_sustantivos.titulo, 
                            puntos_sustantivos.num_punto, avances.filename,avances.filetype, avances.filesize, avances.upload_date 
                            FROM apertura_supervisor INNER JOIN especificaciones_supervisor ON especificaciones_supervisor.id_sup = apertura_supervisor.id
                             INNER JOIN puntos_sustantivos ON puntos_sustantivos.id = especificaciones_supervisor.id_punto 
                             INNER JOIN avances ON especificaciones_supervisor.id = avances.id_espe 
                             WHERE avances.id_usuario = '$ideclarador' AND apertura_supervisor.id = '$sup' AND puntos_sustantivos.id = '$pun' 
                               ";
                            $ejecutar = mysqli_query($conexion, $consulta);
                            $i = 0;
                            while ($fila = mysqli_fetch_array($ejecutar)) {
                                $id = $fila['id'];
                                $name = $fila['filename'];
                                $size = $fila['filesize'];
                                $upload = $fila['upload_date'];
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $size; ?></td>
                                    <td><?php echo $upload; ?></td>
                                    <td>
                                        <a href="downloadAvances.php?file=<?php echo $name; ?>">
                                            <span class="btn btn-info btn-md"><span class="fas fa-download"></span> Descargar</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="asignar" data-idusuario="<?php echo $ideclarador; ?>" data-idavance="<?php echo $id; ?>" data-toggle="modal" data-target="#myModal">
                                            <center><span class="btn btn-success btn-md"><span class="fa-solid fa-comment-medical" style="color: #ffffff;"></span></span></center>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
</div>
</center>


<?php include("footerSupervisor.php"); ?>

<script>
    $(document).ready(function() {

        $(".asignar").on("click", function() {
            var id_avance = $(this).data("idavance");
            console.log("id_avance: " + id_avance);

            $.ajax({
            type: "POST",
            url: "verificarObservacion.php",
            data: { idAvance: id_avance },
            success: function (response) {
                var modal = $('#myModal');

                if (response == 'observacion_existente') {
                    // Si el usuario ya ha dado una observación, oculta el textarea y el botón de guardar
                    modal.find('#modalGuardar').hide();
                    modal.find('#modalAlert').removeClass('alert-success').addClass('alert-danger').text('Ya has dado una observación a este registro.');
                    modal.find('#modalAlert').show();

                    $.ajax({
                        type: "POST",
                        url: "obtenerObservacion.php", // Archivo PHP para obtener la observación existente
                        data: { idAvance: id_avance },
                        success: function (observacion) {
                            modal.find('#observacion').val(observacion);
                        }
                    });
                } else {
                    // Si no hay observación existente, muestra el modal normalmente
                    modal.find('#modalGuardar').show();
                    modal.find('#modalAlert').hide();
                    modal.find('#observacion').prop('disabled', false);
                    modal.find('#modalGuardar').prop('disabled', false);
                    modal.find('#observacion').val(''); // Limpiar el textarea
                }

                // Muestra el modal después de realizar las verificaciones
                modal.modal('show');
            }
        });

            $('#myModal').data('idavance', id_avance);
        });

        $("#modalGuardar").on("click", function() {
            var id_avance = $('#myModal').data('idavance');
            var observacion = $("#observacion").val();

            console.log("Datos a enviar:", {
                id_avance: id_avance,
                observacion: observacion
            });

            $.ajax({
                type: "POST",
                url: "ObservacionAvance.php", // Archivo PHP que maneja la inserción
                data: {
                    observacion: observacion,
                    id_avance: id_avance
                },
                success: function(response) {
                    $('#modalAlert').removeClass('alert-danger').addClass('alert-success').text('Datos guardados correctamente.');
                    $('#modalAlert').show();

                    actualizarTabla(id_avance, observacion);
                    setTimeout(function() {
                        $('#myModal').modal('hide');
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                    alert("Error al asignar observaciones ");
                }
            });
        });

        function actualizarTabla(id_avance, observacion) {
            // Encuentra la fila correspondiente utilizando el atributo de datos
            var fila = $('#tablaAvances').find('tr[data-id="' + id_avance + '"]');

            fila.find('td.observacion').html(observacion);
        }
    });
</script>