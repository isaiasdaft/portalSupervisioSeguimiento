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
$tituloPagina = "Puntos Sustantivos";
?>

<?php include ("headerAdmin.php"); ?>

<center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h1 class="display-6"> Puntos Sustantivos</h1>
              
                <h3 class="display-8"> Departamento de Personal</h3>
                <br>
                <div class="col-sm-12">
                    <a type="submit" class="btn btn-success" href="crearPunto.php">Nuevo Punto</a>
                </div>
            
             <div id="tablaPersonal"></div>
        </div>
        <br>
        <p></p>
    
</center>

<?php include ("footerAdmin.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaPersonal').load("puntos_sustantivos/tablaPersonal.php");
        });
</script>