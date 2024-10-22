<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Historial";
?>

<?php include("headerDeclarador.php"); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="welcome">
            <center>
                <h1>Historial</h1>
                <div id="tableHist"></div>

        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

</div>


<?php include("footerDeclarador.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tableHist').load("gestorHistorial.php");
    });
</script>
