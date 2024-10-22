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

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tableHistorial">
                <thead class="table-info">
                    <tr>
                        <td bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td bgcolor="#A4CBB3">
                            <center> Dependencia
                        </td>
                         <td bgcolor="#A4CBB3">Fecha de inicio</td>
                            <td bgcolor="#A4CBB3">Fecha de finalización</td>
                            <td bgcolor="#A4CBB3">Estatus</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $consulta = "SELECT apertura_supervisor.id, nombre_supervision, dependencia.unidad, 
                    apertura_supervisor.fecha_inicio, apertura_supervisor.fecha_fin,
                     apertura_supervisor.Estatus FROM apertura_supervisor 
                     INNER JOIN dependencia ON dependencia.id = apertura_supervisor.unidad 
                     INNER JOIN usuario ON usuario.id = apertura_supervisor.declarador 
                     WHERE apertura_supervisor.Estatus='Finalizado' AND usuario.id = '$idd'; ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $tipo = $fila['Estatus'];
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $unidad_utf8; ?></td>
                            <td><?php echo $feI; ?></td>
                            <td><?php echo $feF; ?></td>
                            <td><?php echo $tipo; ?></td>
    
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tableHistorial').DataTable();
    });
</script>