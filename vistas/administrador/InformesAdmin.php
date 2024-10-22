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
$tituloPagina = "Informes Supervisor";
?>

<?php include ("headerAdmin.php"); ?>
    
<Center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h2 class="display-5"> Minutas de supervisiones activas</h2>
                <br>
             <div id="tablaGestor"></div>
        </div>
</div> 
</center>
<?php include ("footerAdmin.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaGestor').load("gestorInformes.php");
        });
</script>

