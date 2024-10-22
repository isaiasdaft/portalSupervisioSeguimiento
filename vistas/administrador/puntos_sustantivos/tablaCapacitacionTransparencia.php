<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../../conexion.php");
if(!isset($_SESSION['id'])){
    header('Location: ../../../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-light" id="tablacapacitacio">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Titulo</td>
                        <td>Fuente</td>
                        <td>Metodologia</td>
                        <td>Objetivo</td>
                        <td>Actualizar</td>
                         
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT puntos_sustantivos.id, titulo, fuente, metodologia, objetivo, departamento.nombre FROM puntos_sustantivos INNER JOIN departamento ON puntos_sustantivos.departamento = departamento.id
                    WHERE departamento =1";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];  
                        $title = $fila['titulo'];
                        $fue = $fila['fuente'];
                        $met = $fila['metodologia'];
                        $obje = $fila['objetivo'];
                        $nombre = $fila['nombre'];
                        $title_utf8 = mb_convert_encoding($title, "UTF-8", "auto");
                        $fue_utf8 = mb_convert_encoding($fue, "UTF-8", "auto");
                        $met_utf8 = mb_convert_encoding($met, "UTF-8", "auto");
                        $obje_utf8 = mb_convert_encoding($obje, "UTF-8", "auto");
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $title_utf8; ?></td>
                    <td><?php echo $fue_utf8; ?></td>
                    <td><?php echo $met_utf8; ?></td>
                    <td><?php echo $obje_utf8; ?></td>
                    <td>
                    <center>
                        <a href="modificarPunto.php?editar_id=<?php echo $id; ?>">
                                <span class="btn btn-info btn-md"><span class="fas fa-edit"></span></span>
                                
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
        $('#tablacapacitacio').DataTable();
    });
</script>
