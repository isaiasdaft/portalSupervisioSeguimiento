<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
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
                        <td bgcolor="#A4CBB3">Nombre archivo</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td bgcolor="#A4CBB3">
                            <center> Dependencia
                        </td>
                         <td bgcolor="#A4CBB3">Fecha de inicio</td>
                            <td bgcolor="#A4CBB3">Fecha de fin</td>
                            <td bgcolor="#A4CBB3">
                                <center> Minuta enviada
                            </td>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $consulta = "SELECT archivos_minutas.nombre_minuta, 
                    apertura_supervisor.nombre_supervision,apertura_supervisor.fecha_inicio,
                    apertura_supervisor.fecha_fin, minutasize, dependencia.unidad, apertura_supervisor.declarador, 
                    archivos_minutas.uploadMinuta FROM archivos_minutas
                     INNER JOIN apertura_supervisor ON archivos_minutas.id_sup = apertura_supervisor.id 
                     INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id 
                     INNER JOIN usuario ON apertura_supervisor.declarador = usuario.id
                     WHERE apertura_supervisor.Estatus = 'Finalizado';";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $name = $fila['nombre_minuta'];
                        $nome = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $upload = $fila['uploadMinuta'];
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $nome; ?></td>
                            <td><?php echo $unidad_utf8; ?></td>
                            <td><?php echo $feI; ?></td>
                            <td><?php echo $feF; ?></td>
                            
                            <td>
                              <a href="downloadMinutas.php?file=<?php echo $name; ?>" >
                                    <center>
                                        <span class="btn btn-success btn-md"><span class="fa-solid fa-download" style="color: #ffffff;"></span></span>
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
        $('#tableHistorial').DataTable();
    });
</script>