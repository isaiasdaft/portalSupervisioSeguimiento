<?php
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}

$tituloPagina = "Modificar Apertura";
?>

<?php include ("headerAdmin.php"); ?>


<?php
	if(isset($_GET['editar'])){
	$editar_id = $_GET['editar'];

	$consulta = "SELECT fecha_inicio, fecha_fin, nombre_supervision, estatus, tipo FROM aperturas_admin INNER JOIN dependencia ON aperturas_admin.dependencia = dependencia.id WHERE aperturas_admin.id = '$editar_id'";
	$ejecutar = mysqli_query($conexion, $consulta);

	$fila = mysqli_fetch_array($ejecutar);

	$Name = $fila['nombre_supervision'];
	$Fei = $fila['fecha_inicio'];
	$Fef = $fila['fecha_fin'];
    $Type = $fila['tipo'];
	$Stat = $fila['estatus'];
}
?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <section class="section">
            <div class="row">
            <div class="col-lg-12">
        <center>
          <div class="card">
            <div class="card-body">
             
              <br>

<center>
<table width="731" border="1" align="center" aling="center">

  <h1>Modificar Supervision</h1>

    <form name="formulario" id="formulario" method="POST">
     <div class="row mb-12">
        <label for = "NAME" class="col-sm-12 col-form-label"> Nombre de la supervisión:</label>
        </div>
        <p></p>
        <div class="col-sm-6">
            <center> </center>
        <input type="text" name="name" class ="form-control" value="<?php echo $Name; ?>" required> <center>  
        </div>
        <p></p>
    

    <div class="row mb-12">
        <label for = "FI"  class="col-sm-12 col-form-label">Fecha de inicio:</label> 
    </div>
    <p></p>
    <div class="col-sm-4">
        <input type="date" id="Fi" name="fecha_inicio" 
                min="2022-01-01" max="2050-12-31"
                class ="inDate form-control"  id="FI" value="<?php echo $Fei; ?>" required>
    </div> 
        <div class="row mb-12">
        <label for = "FF"  class="col-sm-12 col-form-label">Fecha de temrinación:</label> 
        </div>
        <p></p>
        <div class="col-sm-4">
        <input type="date" id="Ff" name="fecha_fin" 
                min="2022-01-01" max="2050-12-31"
                class ="date form-control" id="FF" value="<?php echo $Fef; ?>" required>
        </div>

        <div class="row mb-12">
        <label for = "Est"  class="col-sm-12 col-form-label" min = "1000"> Estado de la supervision:</label> 
        </div>
        <datalist id="est">
            <option value="Activa">
            <option value="Concluida">
            </datalist>
        <p></p>
        <div class="col-sm-6">
                <input list="est" name="estatus" class="form-control readonly-input"  id="EST" value="<?php echo $Stat; ?>" readonly>     
</div>
    </div>
    </div>
    </div>
    </div>
    </section>
 </div>
</div>

    
    <center>
    <p>&nbsp;</p>
        <input type="submit" value="Modificar" name="actualizar" class="btn">
    </center>
</form>
    <?php 
    if (isset($_POST['actualizar'])){

        $Name = $_POST['name'];
	    $Fei = $_POST['fecha_inicio'];
	    $Fef = $_POST['fecha_fin'];
     
	    $Stat = $_POST['estatus'];

        if($Name!="none" and $Fei!="none" and $Fef!="none" and  $Stat!="none"){
            $actualizar = "UPDATE aperturas_admin SET nombre_supervision ='$Name', fecha_inicio='$Fei', fecha_fin = '$Fef',  estatus = '$Stat' WHERE aperturas_admin.id = '$editar_id'";

            $ejecutar = mysqli_query($conexion, $actualizar);

            if ($ejecutar){
                echo "<script>alert('Los datos han sido Modificados!')</script>";?>
                <script type="text/javascript"> window.location.replace("aperturaAdmin.php");  </script>
                
                <?php
            }else{
                echo "<script>alert('Error al modificar')</script>";
            }

        }else{
            echo "<script>alert('Los Campos No Pueden Quedar Vacios!')</script>";
        }

    }
    ?>

</div>

<?php include ("footerAdmin.php"); ?>