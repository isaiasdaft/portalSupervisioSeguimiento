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
            <table class="table table-striped table-secondary" id="tablaPendientes">
                <thead class="table-dark">
                    <tr>
                        <td>Nombre supervisión</td>
                        <td>Fecha de inicio</td>
                        <td>Fecha de finalización</td>
                        <td>Estatus</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT nombre_supervision, fecha_inicio, fecha_fin, estatus FROM aperturas_admin WHERE estatus='Activa'; ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $name = $fila['nombre_supervision'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $stat = $fila['estatus'];
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $feI; ?></td>
                    <td><?php echo $feF; ?></td>
                    <td><?php echo $stat; ?></td>
                    </tr>
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