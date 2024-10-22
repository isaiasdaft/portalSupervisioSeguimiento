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
$tituloPagina = "Informes Supervisor";
?>

<?php include("headerSupervisor.php"); ?>

<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h2 class="display-4"> Informes </h2>
            <div id="tablainfo"></div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</center>

<?php include("footerSupervisor.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablainfo').load("gestorInformes.php");
    });
</script>