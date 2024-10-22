<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}

?>

<link rel="stylesheet" type="text/css" href="../../css/extras.css">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Subir archivo de Seguimiento:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="UploadSeguimiento.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_revision" id="id_revision">
                    <div class="mb-3">
                        <label for="fileCedula" class="form-label">Seleccionar archivo a subir: </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="fileSegui" id="fileSegui">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-info"> Subir Archivo</button>
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
<style>
    .table th,
    .table td {
        color: #000; /* Cambia el color del texto a negro */
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaPendientes">
                <thead class="table-info">
                    <tr>
                        <td bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Titulo punto</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td bgcolor="#A4CBB3">Retroalimentación</td>
                        <td bgcolor="#A4CBB3">Fecha Inicio</td>
                        <td bgcolor="#A4CBB3">Fecha Fin</td>
                        <td bgcolor="#A4CBB3">Subir </td>
                        <td bgcolor="#A4CBB3">estaus </td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $consulta = "SELECT apertura_seguimiento.id, apertura_seguimiento.id_revision,
                     puntos_sustantivos.titulo, apertura_supervisor.nombre_supervision, usuario.nombre, 
                     calificacion_supervision.comentario, apertura_seguimiento.fecha_inicio, 
                     apertura_seguimiento.fecha_fin, apertura_seguimiento.archivo_subido 
                     FROM apertura_seguimiento INNER JOIN calificacion_supervision ON 
                     apertura_seguimiento.id_revision = calificacion_supervision.id 
                     INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id
                     INNER JOIN apertura_supervisor ON calificacion_supervision.id_sup = apertura_supervisor.id 
                     INNER JOIN usuario ON calificacion_supervision.id_usuario = usuario.id 
                     WHERE calificacion_supervision.id_usuario = '$idd' AND apertura_seguimiento.estatus='Revision';  ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $titu = $fila['titulo'];
                        $id_revi =$fila['id_revision'];
                        $name = $fila['nombre_supervision'];
                        $comen = $fila['comentario'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $archivoSubido = $fila['archivo_subido'];
                        $titu_utf8 = mb_convert_encoding($titu, "UTF-8", "auto");
                        $comen_utf8 = mb_convert_encoding($comen, "UTF-8", "auto");
                        $archivoSubidoMessage = $archivoSubido ? "Archivo subido" : "No se ha subido el archivo";
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>    
                    <td><?php echo $titu_utf8; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $comen_utf8; ?></td>
                    <td><?php echo $feI; ?></td>
                    <td><?php echo $feF; ?></td>
                    <td>
                                <center>
                                    <a href="#">
                                        <?php if (!$archivoSubido) { ?>
                                            <button type="button" class="btn btn-info btn-sm upload-button" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $id; ?>" data-id_revision="<?php echo $id_revi; ?>">
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaPendientes').DataTable();

        $('.upload-button').on('click', function() {
            var id = $(this).data('id');
            var id_revision = $(this).data('id_revision');
            var nombre_supervision = $(this).data('nombre_supervision');


            $('#id').val(id);
            $('#id_revision').val(id_revision);
            $('#seguisize').val("");
            $('#tipoSegui').val("");
            $('#uploadSegui').val("");

            // Actualiza el título del modal con el nombre de la supervisión
            $('#exampleModalLabel').html("Subir archivo de Seguimiento: " + nombre_supervision);
        });
    });
</script>