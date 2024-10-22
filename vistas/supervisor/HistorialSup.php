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
$tituloPagina = "Historial Supervisor";
?>

<?php include("headerSupervisor.php"); ?>

<Center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h1 class="display-4">Historial de Minutas</h2>
                <div id="tablaHistorial"></div>
        </div>
</div> 
</center>

<?php include("footerSupervisor.php"); ?>


<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaHistorial').load("gestorHistorial.php");
    });
</script>
