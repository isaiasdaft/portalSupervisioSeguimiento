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
$tituloPagina = "Consultar Aperturas";
?>

<?php include ("headerAdmin.php"); ?>

<style>
       .jumbotron {
              background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
           
            height: 100vh;
        }
</style>
<Center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h2 class="display-5">Gestor de Supervisiones </h2>
             <div id="tablaGestorAperturas"></div>
             <br>
        </div>
        <br>
        <br>
        <br>
</div> 
</center>

<?php include ("footerAdmin.php"); ?>


<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaGestorAperturas').load("gestorRecientes.php");
        });
</script>

<script type="text/javascript">
    function ConfirmDeleteApertura()
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
	mysqli_query($conexion,"DELETE FROM aperturas_admin WHERE id = '".$_GET['borrar']."'");
    echo "<script>alert('La supervision ha sido borrada!')</script>";?>
                <script type="text/javascript"> window.location.replace("aperturaAdmin.php");  </script>
                
                <?php

}
?>

