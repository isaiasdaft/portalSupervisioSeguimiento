<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
    $archi = $_GET["id_espe"];
}
?>

<?php include("headerDeclarador.php"); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="welcome">
            <center>
                <h1>Actualizar Archivo</h1>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Actulizar archivo de la Supervision:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="reloadSupervision.php" method="post" enctype="multipart/form-data">
                            
                                <input type="hidden" name="id"  name="id_espe" id="id_espe">
                                    <div class="mb-3">
                                        <label for="fileCedula" class="form-label">Seleccionar archivo para actulizar: </label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="fileSuperv" id="fileSuperv">
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-info"> Subir Archivos </button>
                                    </div>

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
                                        <td bgcolor="#A4CBB3">
                                            <center>Nombre supervisión
                                        </td>
                                        <td bgcolor="#A4CBB3">Punto Sustantivo</td>
                                        <td bgcolor="#A4CBB3">Nombre archivo subido</td>
                                        <td bgcolor="#A4CBB3">Tamaño archivo</td>
                                        <td bgcolor="#A4CBB3">Fecha de subida</td>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                     echo "Valor de archivo: " . $archi;
                                    $consulta = "SELECT archivos_super.id, apertura_supervisor.nombre_supervision,
                     puntos_sustantivos.titulo, nombre_archivo, tipo_super, tamaño_Super, upload_date 
                     FROM archivos_super INNER JOIN especificaciones_supervisor ON especificaciones_supervisor.id = archivos_super.id_espe
                      INNER JOIN apertura_supervisor ON especificaciones_supervisor.id_sup = apertura_supervisor.id 
                      INNER JOIN puntos_sustantivos ON especificaciones_supervisor.id_punto = puntos_sustantivos.id 
                      INNER JOIN usuario ON apertura_supervisor.declarador = usuario.id
                      WHERE id_espe='$archi'; ";
                      
                                    $ejecutar = mysqli_query($conexion, $consulta);
                                    $i = 0;
                                    while ($fila = mysqli_fetch_array($ejecutar)) {
                                        $idEspe = $fila['id'];
                                        $name = $fila['nombre_supervision'];
                                        $titulo = $fila['titulo'];
                                        $archivo = $fila['nombre_archivo'];
                                        $tamaño = $fila['tamaño_Super'];
                                        $fecha = $fila['upload_date'];
                                        $i++;
                                    ?>

                                        <tr>
                                            <td><?php echo $idEspe; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $titulo; ?></td>
                                            <td><?php echo $archivo; ?></td>
                                            <td><?php echo $tamaño; ?> Mb.</td>
                                            <td><?php echo $fecha; ?></td>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <button type="button" class="btn btn-info btn-md upload-button" data-id="<?php echo $idEspe; ?>" data-toggle="modal" data-target="#exampleModal">
                    Actualizar Archivo
                </button>


        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

</div>


<?php include("footerDeclarador.php"); ?>