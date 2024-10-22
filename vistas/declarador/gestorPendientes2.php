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
            <table class="table table-striped table-hover" id="tablaPendientes2">
                <thead class="table-info">
                    <tr>
                        <td >ID</td>
                        <td>Supervisión</td>
                       
                        <td >Fecha de inicio</td>
                        <td >Fecha de finalización</td>
                        <td >Retroalimentación</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                     
                    $consulta = "SELECT apertura_seguimiento.id, apertura_supervisor.nombre_supervision,
                     dependencia.unidad, apertura_seguimiento.fecha_inicio, apertura_seguimiento.fecha_fin,
                      calificacion_supervision.comentario FROM apertura_seguimiento 
                      INNER JOIN calificacion_supervision ON apertura_seguimiento.id_revision = calificacion_supervision.id 
                      INNER JOIN apertura_supervisor ON calificacion_supervision.id_sup = apertura_supervisor.id
                       INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id 
                       WHERE declarador= '$idd' AND apertura_seguimiento.estatus='Revision';   ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $tipo = $fila['comentario'];
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>    
                    <td><?php echo $name; ?></td>
                    <td><?php echo $feI; ?></td>
                    <td><?php echo $feF; ?></td>
                    <td><?php echo $tipo; ?></td>
         
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaPendientes2').DataTable();
    });
</script>