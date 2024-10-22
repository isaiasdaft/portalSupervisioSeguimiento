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
<style>
    .table td {
        color: #000; /* Cambia el color del texto a negro */
    }
</style>
<link rel="stylesheet" type="text/css" href="../../css/extras.css">
<link rel="stylesheet" type="text/css" href="../../css/table.css">
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaPendientes">
                <thead class="table-info">
                    <tr>
                        <td>ID</td>
                        <td>Nombre supervisión</td>
                        <td>Dependencia</td>
                        <td>Fecha de inicio</td>
                        <td>Fecha de finalización</td>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                     
                    $consulta = "SELECT apertura_supervisor.id, nombre_supervision, dependencia.unidad, fecha_inicio, fecha_fin, 
                    apertura_supervisor.tipo FROM apertura_supervisor
                     INNER JOIN dependencia ON dependencia.id = apertura_supervisor.unidad 
                     INNER JOIN usuario ON apertura_supervisor.declarador = usuario.id 
                     WHERE declarador= $idd AND Estatus='Activo';  ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>    
                    <td><?php echo $name; ?></td>
                    <td><?php echo $unidad_utf8; ?></td>
                    <td><?php echo $feI; ?></td>
                    <td><?php echo $feF; ?></td>
                  
         
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaPendientes').DataTable();
    });
</script>