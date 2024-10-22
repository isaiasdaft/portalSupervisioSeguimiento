<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}
?>


<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaHistory">
                <thead>
                    <tr>
                        <td bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Nombre Minuta</td>
                        <td bgcolor="#A4CBB3">Tamaño archivo</td>
                        <td bgcolor="#A4CBB3">Fecha de subida</td>
                        <td bgcolor="#A4CBB3">Nombre de Supervisión</td>
                        <td bgcolor="#A4CBB3">Unidad</td>
                        <td bgcolor="#A4CBB3">Descargar Minuta</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT archivos_minutas.id, nombre_minuta, minutasize, uploadMinuta,
                     apertura_supervisor.nombre_supervision, dependencia.unidad
                      FROM `archivos_minutas` 
                    INNER JOIN apertura_supervisor ON apertura_supervisor.id = archivos_minutas.id_sup 
                    INNER JOIN dependencia ON dependencia.id = apertura_supervisor.unidad 
                    WHERE apertura_supervisor.Estatus='Finalizado';  ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_minuta'];
                        $size = $fila['minutasize'];
                        $fecha = $fila['uploadMinuta'];
                        $unida = $fila['unidad'];
                        $sup = $fila['nombre_supervision'];
                        $unidad_utf8 = mb_convert_encoding($unida, "UTF-8", "auto");
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $size; ?></td>
                    <td><?php echo $fecha; ?></td>
                    <td><?php echo $sup; ?></td>
                    <td><?php echo $unidad_utf8; ?></td>
                    
                    <td>
                         <a href="downloadMinutas.php?file=<?php echo $name; ?>">
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
    $(document).ready(function(){
        $('#tablaHistory').DataTable();
    });
</script>
