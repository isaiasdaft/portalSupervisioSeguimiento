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
            <table class="table table-striped table-light" id="tablaDirec">
                <thead>
                    <tr>
                        <td bgcolor="#A4CBB3">Nombre</td>
                        <td bgcolor="#A4CBB3">Puesto</td>
                        <td bgcolor="#A4CBB3">Telefono (Ext)</td>
                        <td bgcolor="#A4CBB3">Correo</td>
                        <td bgcolor="#A4CBB3">Dependencia</td>
                        
                    
                    </tr>
                </thead>
                <tbody>
                <?php
                    $consulta = "SELECT usuario.nombre, cargo, telefono_ext, correo, dependencia.unidad FROM usuario INNER JOIN dependencia ON usuario.dependencia = dependencia.id; ";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $name = $fila['nombre'];
                        $cargo = $fila['cargo'];
                        $tel = $fila['telefono_ext'];
                        $correo = $fila['correo'];
                        $unidad = $fila['unidad'];
                        $name_utf8 = mb_convert_encoding($name, "UTF-8", "auto");
                        $cargo_utf8 = mb_convert_encoding($cargo, "UTF-8", "auto");
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $i++;
                    ?>
                    <tr>
                    <td><?php echo $name_utf8; ?></td>
                    <td><?php echo $cargo_utf8; ?></td>
                    <td><?php echo $tel; ?></td>
                    <td><?php echo $correo; ?></td>
                    <td><?php echo $unidad_utf8; ?></td>
                  
            
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaDirec').DataTable();
    });
</script>
