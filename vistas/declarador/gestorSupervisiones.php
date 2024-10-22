<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}

?>
<link rel="stylesheet" type="text/css" href="../../css/extras.css">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Subir archivo de punto sustantivo:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="uploadSupervision.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_sup" id="id_sup">
                    <input type="hidden" name="id_punto" id="id_punto">
                    <input type="hidden" name="id_usuario" id="id_usuario">
                
                    <div class="mb-3">
                        <label for="fileCedula" class="form-label">Seleccionar archivo a subir: </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="fileSuperv" id="fileSuperv">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-info"> Subir Archivos</button>
                    </div>
                    <br>
          
                </form>
                <div id="alert-container" class="alert" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaSupervisiones">
                <thead class="table-info">
                    <tr>
                        <td bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Punto Sustantivo</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td bgcolor="#A4CBB3">Fecha Limite</td>
                        <td bgcolor="#A4CBB3">Especificaciones</td>
                        <td bgcolor="#A4CBB3">Avances</td>
                        <td bgcolor="#A4CBB3">Archivo Final</td>
                        <td bgcolor="#A4CBB3">Estatus</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $consulta = "SELECT es.id, es.id_sup, es.id_punto, ps.titulo, asv.nombre_supervision, 
                    es.especificacion, es.archivo_subido, ars.id AS archivo_id, ars.nombre_archivo,
                     asv.fecha_inicio, asv.fecha_fin FROM especificaciones_supervisor es 
                     INNER JOIN puntos_sustantivos ps ON es.id_punto = ps.id 
                     INNER JOIN apertura_supervisor asv ON es.id_sup = asv.id 
                     INNER JOIN usuario u ON asv.declarador = u.id
                      LEFT JOIN archivos_super ars ON es.id = ars.id_espe
                       WHERE u.id = '$idd' AND asv.Estatus = 'Activo';   ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $idEspe = $fila['id'];
                        $idSup = $fila['id_sup'];
                        $idPunto = $fila['id_punto'];
                        $titu = $fila['titulo'];
                        $name = $fila['nombre_supervision'];
                        $Ff = $fila['fecha_fin'];
                        $est = $fila['especificacion'];
                        $archivoSubido = $fila['archivo_subido'];
                        $idarchivo = $fila['id'];
                        $titu_utf8 = mb_convert_encoding($titu, "UTF-8", "auto");
                        $est_utf8 = mb_convert_encoding($est, "UTF-8", "auto");
                        $archivoSubidoMessage = $archivoSubido ? "Archivo subido" : "No se ha subido archivo";
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $idEspe; ?></td>
                            <td><?php echo $titu_utf8; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $Ff; ?></td>
                            <td><?php echo $est_utf8; ?></td>
                            <td>
                            <a href="Avances.php?id_espe=<?php echo $idEspe; ?>">
                                            Subir Avances
                                        </a>
                            </td>
                            <td>
                                <center>
                                    <a href="#">
                                        <?php if (!$archivoSubido) { ?>
                                            <button type="button" class="btn btn-info btn-sm upload-button" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $idEspe; ?>" data-id_sup="<?php echo $idSup; ?>" data-id_punto="<?php echo $idPunto; ?>" data-id_usuario="<?php echo $idd; ?>">
                                                <span class="btn btn-info btn-sm"><span class="fas fa-upload"></span></span>
                                            </button>
                                        <?php } ?>
                                    </a>
                                </center>
                            </td>
                            <td class="file-name">
                                <?php echo $archivoSubidoMessage; ?>
                                <div class="file-status">
                                    <?php if ($archivoSubido) { ?>      
                                        
                                    <?php } else { ?>
                                        
                                    <?php } ?>
                                </div>
                            </td>

                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tablaSupervisiones').DataTable();

        // Event listener para el botón "Subir Archivo" en la tabla
        $('.upload-button').on('click', function() {
            var id = $(this).data('id');
            var id_sup = $(this).data('id_sup');
            var id_punto = $(this).data('id_punto');
            var id_usuario = $(this).data('id_usuario');
            console.log("ID de supervision al abrir el modal: " + id_sup);
            console.log("ID de punto al abrir el modal: " + id_punto);
            console.log("ID de usuario al abrir el modal: " + id_usuario);

            $('#id').val(id);
            $('#id_sup').val(id_sup);
            $('#id_punto').val(id_punto);
            $('#id_usuario').val(id_usuario);
            $('#superSize').val("");
            $('#tipoSupervision').val("");
            $('#uploadSupervision').val("");

            // Actualiza el título del modal con el nombre de la supervisión
            $('#exampleModalLabel').html("Subir archivo de punto sustantivo: " );
        });

        $('.file-status').each(function() {
            var $fileStatus = $(this);
            var hasFile = $fileStatus.find('a').length > 0;
            if (hasFile) {
                $fileStatus.show();
            }
        });

        $('#changeFileButton').on('click', function() {
            // Habilita la entrada de archivo para permitir al usuario cambiar el archivo
            $('#fileSuperv').attr('disabled', false);
        });

        $('#exampleModal').on('show.bs.modal', function (event) {
            // Intercepta la apertura del modal y muestra una confirmación
            var confirmation = confirm('En esta sección se subirá el archivo que será calificado ¿Estás seguro de enviar?');
            if (!confirmation) {
                event.preventDefault(); // Cancela la apertura del modal si el usuario cancela
            }else{
                 // Si el usuario acepta, asigna el evento de clic en el botón del modal
                 $('#modalSubmitButton').on('click', function() {
                    // Tu lógica para enviar el formulario
                    $('#exampleModal').modal('hide'); // Opcional: oculta el modal después del envío
                });
            }
        });

        // Maneja la respuesta del formulario de subida
        $('form').submit(function(e) {
            e.preventDefault();
           
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // Actualiza la última columna con el nombre del archivo subido
                    var fileName = formData.get('fileSuperv').name;
                    form.closest('tr').find('.file-name').text(fileName);

                    // Muestra la alerta con el mensaje de éxito
                    $('#alert-container').removeClass('alert-danger').addClass('alert-success').text('Los archivos se han archivado correctamente.');
                    $('#alert-container').show();

                    setTimeout(function() {
                        $('#exampleModal').modal('hide');
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    $('#alert-container').removeClass('alert-success').addClass('alert-danger').text('Error al subir el archivo: ' + error);
                    $('#alert-container').show();
                }
            });
        });
    });
</script>