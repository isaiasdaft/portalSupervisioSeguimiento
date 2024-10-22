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
            <table class="table table-hover table-stripper" id="tablaInforme">
                <thead>
                    <tr>
                        <td bgcolor="#A4CBB3">Nombre archivo</td>
                        <td bgcolor="#A4CBB3">Nombre supervisión</td>
                        <td bgcolor="#A4CBB3">Tamaño</td>
                        <td bgcolor="#A4CBB3">Dependencia</td>
                        <td bgcolor="#A4CBB3">Declarador</td>
                        <td bgcolor="#A4CBB3">Fecha de envío</td>
                        <td bgcolor="#A4CBB3">Descargar</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT archivos_minutas.nombre_minuta, 
                    apertura_supervisor.nombre_supervision, minutasize, dependencia.unidad, usuario.nombre, 
                    archivos_minutas.uploadMinuta FROM archivos_minutas
                     INNER JOIN apertura_supervisor ON archivos_minutas.id_sup = apertura_supervisor.id 
                     INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id 
                     INNER JOIN usuario ON apertura_supervisor.declarador = usuario.id
                     WHERE apertura_supervisor.Estatus = 'Activo';  ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $name = $fila['nombre_minuta'];
                        $nome = $fila['nombre_supervision'];
                        $tamaño = $fila['minutasize'];
                        $unidad = $fila['unidad'];
                        $user = $fila['nombre'];
                        $upload = $fila['uploadMinuta'];
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $user_utf8 = mb_convert_encoding($user, "UTF-8", "auto");
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $tamaño; ?></td>
                    <td><?php echo $unidad_utf8; ?></td>
                    <td><?php echo $user_utf8; ?></td>
                    <td><?php echo $upload; ?></td>
                    <td>
                         <a href="downloadMinutas.php?file=<?php echo $name; ?>" >
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
        $('#tablaInforme').DataTable();
    });
</script>
