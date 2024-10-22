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
$tituloPagina = "Consultar Apertura";
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

<Center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h1 class="display-4"> Supervisiones</h2>
             <div id="tablaAper"></div>
        </div>
</div> 
</center>



<?php include("footerSupervisor.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaAper').load("gestorAperturas.php");
        });
</script>


<script type="text/javascript">
    function ConfirmDelete()
    {
        var respuesta = confirm("¿Estas seguro de eliminar el registro?");
         if(respuesta == true)
         {
            return true;
         }
         else{
            return false;
         }
    }
</script>
