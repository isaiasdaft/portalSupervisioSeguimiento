<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Directorio";
?>

<?php include("headerSupervisor.php"); ?>

<Center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h3 class="display-5">Directorio de usuarios</h3>
                <div id="tablaDirectorio"></div>
        </div>
</div> 
</center>

<?php include("footerSupervisor.php"); ?>


<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaDirectorio').load("gestorDirectorio.php");
    });
</script>
