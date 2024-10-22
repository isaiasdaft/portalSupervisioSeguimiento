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
?>

<?php include("headerSupervisor.php"); ?>


<center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-6"> Generar Minúta</h1>
        </div>
    </div>



<?php include("footerSupervisor.php"); ?>
