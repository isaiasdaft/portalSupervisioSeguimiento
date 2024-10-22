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

<script type="text/javascript">
    function ConfirmDeleteApertura() {
        var respuesta = confirm("¿Estas seguro de eliminar la apertura?");
        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaApert">
                <thead class="thead-dark">
                    <tr>
                    <td class="d-none d-sm-table-cell">ID</td>
                        <td>Nombre de la supervisión</td>
                        <td>Unidad</td>
                        <td>Fecha de inicio</td>
                        <td>Fecha de finalización</td>
                        <td>Estatus</td>
                        <td>Criterios</td>
                        <td>Detalles</td>
                        <td>Editar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta = "SELECT apertura_supervisor.id, nombre_supervision, dependencia.unidad,
                     fecha_inicio, fecha_fin, Estatus, tipo FROM apertura_supervisor 
                     INNER JOIN dependencia ON dependencia.id = apertura_supervisor.unidad 
                     WHERE tipo = 'supervision' AND Estatus='Activo';  ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre_supervision'];
                        $unidad = $fila['unidad'];
                        $feI = $fila['fecha_inicio'];
                        $feF = $fila['fecha_fin'];
                        $stat = $fila['Estatus'];
                        $name_utf8 = mb_convert_encoding($name, "UTF-8", "auto");
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name_utf8; ?></td>
                            <td><?php echo $unidad_utf8; ?></td>
                            <td><?php echo $feI; ?></td>
                            <td><?php echo $feF; ?></td>
                            <td><?php echo $stat; ?></td>
                            <td>
                                <a href="supervisionVinculo.php?id=<?php echo $id; ?>"> 
                                    <center>
                                        <span class="btn btn-primary btn-sm"><span class="fa-solid fa-folder-plus"></span>
                                </a>
                            </td>
                            <td>
                                <a href="DetalleSupervision.php?id=<?php echo $id; ?>">
                                    <center>
                                        <span class="btn btn-info btn-sm"><span class="fa-solid fa-circle-info"></span></span>

                                </a>
                            </td> 
                            <td>
                                <a href="ModificarApertura.php?editar=<?php echo $id; ?>">
                                    <center>
                                        <span class="btn btn-warning btn-sm"><span class="fas fa-edit"></span></span>

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
        $('#tablaApert').DataTable();
    });
</script>

<?php
if (isset($_GET['borrar'])) {
    mysqli_query($conexion, "DELETE FROM apertura_supervisor WHERE id = '" . $_GET['borrar'] . "'");
    echo "<script>alert('La supervision ha sido borrada!')</script>"; ?>
    <script type="text/javascript">
        window.location.replace("consultarApertura.php");
    </script>
<?php

}
?>