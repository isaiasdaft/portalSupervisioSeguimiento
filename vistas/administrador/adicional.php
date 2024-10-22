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

$tituloPagina = "Home";
?>

<?php include ("headerAdmin.php"); ?>
    
<Center>

</center>
<?php include ("footerAdmin.php"); ?>


