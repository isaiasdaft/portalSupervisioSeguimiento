<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}
$tituloPagina = "Usuarios";
?>

<?php include ("headerAdmin.php"); ?>


<center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h2 class="display-5"> Administrar usuarios del sistema</h2>
             <div id="tablaUsuarios"></div>
        </div>
        <br>
        <p></p>
        <center>
            <div class="">
                <form action="crearUsuarios.php">
                <input type="submit" class="fadeIn fourth" value="Crear Nuevo usuario">
                </form>
            </div>
            </center>
</div> 
</center>


<?php include ("footerAdmin.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaUsuarios').load("gestorUsuarios.php");
        });
</script>

<script src="sweetalert2.js"></script>
 <script>
    function exito(){
        Swal.fire(
            'Good Job',
            'You clicke the button',
            'success'
        )
    }
 </script>


<script type="text/javascript">
    function ConfirmDelete()
    {
        var respuesta = confirm("¿Estas seguro de eliminar el registro?");
         if(respuesta == true)
         {
            return true;
         }
         else{
            return false;
         }
    }
</script>


    <?php
    if(isset($_GET['borrar'])){
        mysqli_query($conexion,"DELETE FROM usuario WHERE id = '".$_GET['borrar']."'");
    echo "<script>alert('El usuario ha sido borrado!')</script>";?>
                    <script type="text/javascript"> window.location.replace("adminUsuarios.php");  </script>
                    
                    <?php

    }
    ?>

<script src="../../librerias/sweetalert.min.js"></script>
