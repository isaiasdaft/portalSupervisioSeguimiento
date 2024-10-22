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

<script type="text/javascript">
    function ConfirmDeleteApertura()
    {
        var respuesta = confirm("¿Estas seguro de eliminar la apertura?");
         if(respuesta == true)
         {
            return true;
         }
         else{
            return false;
         }
    }
</script>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table  table-striped table-hover" id="tableGestorAperturas">
                 <thead class="thead-dark">
                    <tr>
                        <td bgcolor="#A4CBB3">ID</td>
                        <td bgcolor="#A4CBB3">Nombre de la supervisión</td>
                        <td bgcolor="#A4CBB3">Unidad</td>
                        <td bgcolor="#A4CBB3">Fecha de inicio</td>
                        <td bgcolor="#A4CBB3">Fecha de finalización</td>
                        <td bgcolor="#A4CBB3">Estado</td>
                        <td bgcolor="#A4CBB3">Visualizar</td>
                        <td bgcolor="#A4CBB3">Eliminar</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT aperturas_admin.id, nombre_supervision, fecha_inicio, fecha_fin,
                    estatus, dependencia.unidad FROM aperturas_admin
                    INNER JOIN dependencia ON aperturas_admin.dependencia = dependencia.id 
                    WHERE estatus = 'concluida' OR estatus = 'Activa'; ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $stat = $fila['estatus'];
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $unidad; ?></td>
                    <td><?php echo $feI; ?></td>
                    <td><?php echo $feF; ?></td>
                    <td><?php echo $stat; ?></td>
                    <td>
                         <a href="ModificarSupervision.php?editar=<?php echo $id; ?>">
                         <center>
                                <span class="btn btn-warning btn-md"><span class="fas fa-edit"></span></span>
                                
                        </a>
                        </td>
                        <td>    
                        <a href="aperturaAdmin.php?borrar=<?php echo $id; ?>" onclick="return confirm('¿Estas seguro de eliminar la apertura?'">
                        <center>
                        <span class="btn btn-danger btn-md" onclick="return ConfirmDeleteApertura()"><span class="fas fa-trash">
                                </span></span>
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
        $('#tableGestorAperturas').DataTable();
    });
</script>

<?php
if(isset($_GET['borrar'])){
	mysqli_query($conexion,"DELETE FROM aperturas_admin WHERE id = '".$_GET['borrar']."'");
    echo "<script>alert('La supervision ha sido borrada!')</script>";?>
                <script type="text/javascript"> window.location.replace("aperturaAdmin.php");  </script>
                
                <?php

}
?>
