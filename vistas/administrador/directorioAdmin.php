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
$tituloPagina = "Directorio";
?>

<?php include ("headerAdmin.php"); ?>

<center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h2 class="display-5"> Directorio de usuarios</h2>
             <div id="tablaDirectorio"></div>
        </div>

</div> 
</center>

<?php include ("footerAdmin.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaDirectorio').load("gestorDirectorio.php");
        });
</script>