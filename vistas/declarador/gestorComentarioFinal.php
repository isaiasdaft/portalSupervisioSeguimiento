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
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaObservacion">
                <thead class="table-info">
                    <tr>
                        <td  bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td  bgcolor="#A4CBB3">Punto Sustantivo</td>
                        <td  bgcolor="#A4CBB3">Comentario</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                   echo "Valor de supid: " . $idd;
                    $consulta = "SELECT calificacion_supervision.id, apertura_supervisor.nombre_supervision, 
                    puntos_sustantivos.titulo, calificacion_supervision.calificacion, calificacion_supervision.comentario
                     FROM calificacion_supervision 
                     INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
                     INNER JOIN puntos_sustantivos ON puntos_sustantivos.id = calificacion_supervision.id_punto
                      INNER JOIN usuario ON usuario.id = calificacion_supervision.id_usuario 
                      WHERE id_usuario=$idd;  ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['titulo'];
                        $est = $fila['calificacion'];
                        $tipo = $fila['comentario'];
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>    
                    <td><?php echo $name; ?></td>
                    <td><?php echo $unidad; ?></td>
                    <td><center><?php echo $est; ?></td>
                    <td><?php echo $tipo; ?></td>
         
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaObservacion').DataTable();
    });
</script>