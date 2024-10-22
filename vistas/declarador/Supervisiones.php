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
$tituloPagina = "Supervisiones";
?>

<?php include("headerDeclarador.php"); ?>

<style>
       .jumbotron {
              background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
           
            height: 100vh;
        }
</style>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="welcome">
            <center>
                <h1>Supervisiones</h1>
                <div id="tablaSuper"></div>
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
        $('#tablaSuper').load("gestorSupervisiones.php");
    });
</script>