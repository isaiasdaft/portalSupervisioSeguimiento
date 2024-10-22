<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
    $archi = $_GET["id_espe"];
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-stripper" id="tablaAvances">
                <thead>
                    <tr>
                        <td bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Nombre archivo</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td bgcolor="#A4CBB3">Tamaño</td>
                        <td bgcolor="#A4CBB3">Tipo</td>
                        <td bgcolor="#A4CBB3">Fecha de envío</td>
                        <td bgcolor="#A4CBB3">Descargar</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                 echo "Valor de id_avance: " . $archi;
                    $consulta = "SELECT avances.id, avances.filename, apertura_supervisor.nombre_supervision, 
                    avances.filesize, avances.filetype, avances.upload_date FROM avances
                     INNER JOIN usuario ON avances.id_usuario = usuario.id 
                     INNER JOIN especificaciones_supervisor ON avances.id_espe = especificaciones_supervisor.id
                      INNER JOIN apertura_supervisor ON especificaciones_supervisor.id_sup = apertura_supervisor.id 
                      WHERE avances.id_espe= '$archi' AND avances.id_usuario= '$idd'; ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $ID = $fila['id'];
                        $name = $fila['filename'];
                        $nome = $fila['nombre_supervision'];
                        $tamaño = $fila['filesize'];
                        $type = $fila['filetype'];
                        $upload = $fila['upload_date'];
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $ID; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $tamaño; ?></td>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $upload; ?></td>
                    <td>
                         <a href="downloadAvances.php?file=<?php echo $name; ?>" >
                                <span class="btn btn-Primary btn-md"><span class="fas fa-download"></span> Descargar</span>
                                
                        </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaAvances').DataTable();
    });
</script>
