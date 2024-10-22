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
    function ConfirmDelete()
    {
        var respuesta = confirm("¿Estas seguro de eliminar el usuario?");
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
            <table class="table table-hover table-striped" id="tablaUsuario">
                <thead>
                    <tr>
                        <td class="d-none d-sm-table-cell">ID</td>
                        <td>Nombre completo</td>
                        <td>Usuario</td>
                        <td class="d-none d-sm-table-cell">Contraseña</td>
                        <td>Unidad</td>
                        <td>Email</td>
                        <td>Teléfono</td>
                        <td>Modificar</td>
                        <td>Eliminar</td>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $consulta = "SELECT usuario.id, nombre, usuario, contrasena, unidad, correo,telefono_ext FROM usuario INNER JOIN dependencia ON usuario.dependencia = dependencia.id";
                    $ejecutar = mysqli_query($conexion, $consulta);
                    $i = 0;
                    while ( $fila = mysqli_fetch_array($ejecutar)) {
                        $id = $fila['id'];
                        $name = $fila['nombre'];
                        $user = $fila['usuario'];
                        $password = $fila['contrasena'];
                        $unidad = $fila['unidad'];
                        $email = $fila['correo'];
                        $tel = $fila['telefono_ext'];
                        $name_utf8 = mb_convert_encoding($name, "UTF-8", "auto");
                        $user_utf8 = mb_convert_encoding($user, "UTF-8", "auto");
                        $unidad_utf8 = mb_convert_encoding($unidad, "UTF-8", "auto");
                        $email_utf8 = mb_convert_encoding($email, "UTF-8", "auto");
                        $i++;   
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name_utf8; ?></td>
                    <td><?php echo $user_utf8; ?></td>
                    <td><?php echo $password; ?></td>
                    <td><?php echo $unidad_utf8; ?></td>
                    <td><?php echo $email_utf8; ?></td>
                    <td><?php echo $tel; ?></td>
                        <td>
                            <center>
                         <a href="modificarUsuario.php?editar=<?php echo $id; ?>">
                                <span class="btn btn-warning btn-md"><span class="fas fa-edit"></span></span>
                                
                        </a>
                        </td>
                        <td>    
                        <center>
                        <a href="adminUsuarios.php?borrar=<?php echo $id; ?>" onclick="return confirm('¿Estas seguro de eliminar el usuario?'">
                        <span class="btn btn-danger btn-md" onclick="return ConfirmDelete()"><span class="fas fa-trash">
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
        $('#tablaUsuario').DataTable();
    });
</script>


<?php
if(isset($_GET['borrar'])){
	mysqli_query($conexion,"DELETE FROM usuario WHERE id = '".$_GET['borrar']."'");
echo "<script>alert('El usuario ha sido borrado!')</script>";?>
                <script type="text/javascript"> window.location.replace("adminUsuarios.php");  </script>
                
                <?php

}
?>


