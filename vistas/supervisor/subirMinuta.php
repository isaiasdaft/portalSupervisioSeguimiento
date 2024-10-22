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
$tituloPagina = "Subir Minúta";
?>

<?php include("headerSupervisor.php"); ?>

<style>
       .jumbotron {
              background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
           
            height: 100vh;
        }
</style>

<center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-6"> Subir Minuta</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="NAME" class="col-sm-5 col-form-label">Nombre supervisión</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="Ingresa el nombre o ID de la supervisión" name="nombreSup" id="nombreSup" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="fileCedula" class="form-label">Seleccionar Minuta </label>
                    <div class="col-sm-8">
                        <input type="file"  class="form-control" name="fileMinuta" id="fileMinuta">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"> Subir Archivos</button>
            </form>
            <br>

        </div>
        <br>
        <br>
        <br>
        <br>
        <p></p>

</center>


<?php include("footerSupervisor.php"); ?>