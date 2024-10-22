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
            <table class="table table-striped table-hover" id="tablaFiles">
                <thead>
                    <tr>
                        <td>ID Supervisión</td>
                        <td>dependencia</td>
                        <td>Nombre Cédula</td>
                        <td>Nombre Minuta</td>
                        <td>Fecha de subida</td>
                        <td>Descargar Cedula</td>
                        <td>Descargar Minuta</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT * FROM archivarfiles; ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $nombreSup = $fila['nombreSup'];
                        $dependencia = $fila['dependencia'];
                        $upload_cedula = $fila['upload_cedula'];
                        $nombreCedula = $fila['nombreCedula'];
                        $nombreMinuta = $fila['nombreMinuta'];
                        $i++;
                    ?>
                     
                    <tr>
                    <td><?php echo $nombreSup ?></td>
                    <td><?php echo $dependencia ?></td>
                    <td><?php echo $nombreCedula ?></td>
                    <td><?php echo $nombreMinuta ?></td>
                    <td><?php echo $upload_cedula ?></td>
                
                    <td>
                         <a href="download.php?file=<?php echo $nombreCedula; ?>" >
                                <span class="btn btn-dark btn-md"><span class="fas fa-download"></span> Descargar</span>
                                
                        </a>
                        </td>
                        <td>
                         <a href="download.php?file=<?php echo $nombreMinuta; ?>">
                                <span class="btn btn-info btn-md"><span class="fas fa-download"></span> Descargar</span>
                                
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
        $('#tablaFiles').DataTable();
    });
</script>
