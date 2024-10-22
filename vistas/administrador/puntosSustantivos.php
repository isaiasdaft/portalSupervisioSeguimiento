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
?>

<?php include ("headerAdmin.php"); ?>

<Center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h1 class="display-6"> Puntos Sustantivos </h1>
             <div id="tablaSustantivos"></div>
        </div>
</div> 
</center>

<?php include ("footerAdmin.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaSustantivos').load("gestorSustantivos.php");
        });
</script>
