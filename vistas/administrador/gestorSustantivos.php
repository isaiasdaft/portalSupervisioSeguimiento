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
            <table class="table table-striped table-light" id="tablaSustantivos">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Titulo</td>
                        <td>Fuente</td>
                        <td>Metodologia</td>
                        <td>Objetivo</td>
                        <td>Departamento</td>
                         
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT puntos_sustantivos.id, titulo, fuente, metodologia, objetivo, departamento.nombre FROM puntos_sustantivos INNER JOIN departamento ON puntos_sustantivos.departamento = departamento.id";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];  
                        $title = $fila['titulo'];
                        $fue = $fila['fuente'];
                        $met = $fila['metodologia'];
                        $obje = $fila['objetivo'];
                        $nombre = $fila['nombre'];
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $fue; ?></td>
                    <td><?php echo $met; ?></td>
                    <td><?php echo $obje; ?></td>
                    <td><?php echo $nombre; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaSustantivos').DataTable();
    });
</script>
