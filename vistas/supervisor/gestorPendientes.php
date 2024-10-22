<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}

$consulta = "SELECT aperturas_admin.id, nombre_supervision, dependencia.unidad, fecha_inicio, fecha_fin, aperturas_admin.tipo 
            FROM aperturas_admin INNER JOIN dependencia ON dependencia.id = aperturas_admin.dependencia
            WHERE estatus='Activa';";
$ejecutar = mysqli_query($conexion, $consulta);
$numRegistros = mysqli_num_rows($ejecutar);

?>
    <link rel="stylesheet" type="text/css" href="../../css/extras.css">

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
        <?php
            if ($numRegistros > 0) {
                // Mostrar la tabla si hay registros
            ?>
            <table class="table table-striped table-hover" id="tablaPendientes">
                <thead class="table-info">
                    <tr>
                        <td>ID</td>
                        <td>Nombre supervisión</td>
                        <td>Dependencia</td>
                        <td>Fecha de inicio</td>
                        <td>Fecha de finalización</td>
                       
                        <td>Iniciar</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT aperturas_admin.id, nombre_supervision, dependencia.unidad, fecha_inicio, fecha_fin, aperturas_admin.tipo 
                    FROM aperturas_admin INNER JOIN dependencia ON dependencia.id = aperturas_admin.dependencia
                     WHERE estatus='Activa';";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $name_utf8 = mb_convert_encoding($name, "UTF-8", "auto");
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $i++;
                    ?>
                    <tr>
                    <td class="id-column"><?php echo $id; ?></td>
                    <td class="name-column"><?php echo $name_utf8; ?></td>
                    <td class="unidad-column"><?php echo $unidad_utf8; ?></td>
                    <td class="feI-column"><?php echo $feI; ?></td>
                    <td class="feF-column"><?php echo $feF; ?></td>
                    
                        <td class="tipo-boton">
                         <a href="crearAperturaSup.php?editar=<?php echo $id; ?>">
                            <center></center>
                            <span class="btn btn-ligth btn-md"><span class="fa-solid fa-circle-plus fa-xl" style="color: #3aba97;"></span></span>   
                        </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            } else {
                // Mostrar mensaje si no hay registros
                ?>
                <div class="alert alert-warning" role="alert">
                    En caso de no haber ninguna apertura pendiente, accede a la sección de<a href="consultarApertura.php"> Consultar Aperturas </a>para revisar las supervisiones con fechas proximas a cerrar.
                </div>
            <?php } ?>
        </div>
      
    </div>
    

</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaPendientes').DataTable();
    });
</script>


