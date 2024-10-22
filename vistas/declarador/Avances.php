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
$tituloPagina = "Avances";
?>
<?php include("headerDeclarador.php"); ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="welcome">
            <center>
                <h2>Subir Avances</h2>
                <form action="uploadAvance.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario();">
                    <input type="hidden" name="id" id="id" value="<?php echo $idd; ?>">
                    <input type="hidden" name="id_espe" id="id_espe" value="<?php echo $archi; ?>">
                    <div class="mb-3">
                        <label for="fileAvance" class="form-label">Seleccionar archivo de avance: </label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="fileAvance" id="fileAvance">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary"> Subir Archivos</button>
                    </div>
                    <br>
                    <p></p>
                    <br>
                    <h2>Avances subidos de la supervisión</h2>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-stripper" id="tablaAvances">
                                    <thead>
                                        <tr>

                                            <td bgcolor="#A4CBB3">Nombre archivo</td>
                                            <td bgcolor="#A4CBB3">Nombre supervisión</td>
                                            <td bgcolor="#A4CBB3">Tamaño</td>
                                            <td bgcolor="#A4CBB3">Tipo</td>
                                            <td bgcolor="#A4CBB3">Fecha de envío</td>
                                            <td bgcolor="#A4CBB3">Descargar</td>
                                            <td bgcolor="#A4CBB3">Observaciones</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = "SELECT avances.id, avances.filename, 
                                        apertura_supervisor.nombre_supervision, avances.filesize, 
                                        avances.filetype, avances.upload_date, observacionesavance.observacion
                                         FROM avances INNER JOIN usuario ON avances.id_usuario = usuario.id 
                                         INNER JOIN especificaciones_supervisor ON avances.id_espe = especificaciones_supervisor.id 
                                         INNER JOIN apertura_supervisor ON especificaciones_supervisor.id_sup = apertura_supervisor.id 
                                         LEFT JOIN observacionesavance ON avances.id = observacionesavance.id_avance 
                                         WHERE avances.id_espe = '$archi' AND avances.id_usuario = '$idd';  ";
                                        $ejecutar = mysqli_query($conexion, $consulta);
                                        $i = 0;
                                        while ($fila = mysqli_fetch_array($ejecutar)) {
                                            $ID = $fila['id'];
                                            $name = $fila['filename'];
                                            $nome = $fila['nombre_supervision'];
                                            $tamaño = $fila['filesize'];
                                            $type = $fila['filetype'];
                                            $upload = $fila['upload_date'];
                                            $observa = $fila['observacion'];
                                            $i++;
                                        ?>
                                            <tr>

                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $nome; ?></td>
                                                <td><?php echo $tamaño; ?></td>
                                                <td><?php echo $type; ?></td>
                                                <td><?php echo $upload; ?></td>
                                                <td>
                                                    <a href="downloadAvance.php?file=<?php echo $name; ?>">
                                                        <span class="btn btn-Primary btn-md"><span class="fas fa-download"></span> Descargar</span>
                                                    </a>
                                                </td>
                                                <td><?php echo $observa; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

</div>

<script>
    function validarFormulario() {
        var fileInput = document.getElementById('fileAvance');
        var archivo = fileInput.files[0];

        if (!archivo) {
            alert('Por favor, selecciona un archivo antes de hacer clic en "Subir Archivos".');
            return false;
        }
        return true; // Envía el formulario si se seleccionó un archivo
    }
</script>

<?php include("footerDeclarador.php"); ?>