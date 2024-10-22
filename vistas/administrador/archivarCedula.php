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
$tituloPagina = "Archivar ";
?>

<?php include ("headerAdmin.php"); ?>

<center>
<div class="jumbotron jumbotron-fluid">
         <div class="container">
                <h2 class="display-5"> Archivar Cédulas y Minutas</h2>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                    <label for="NAME" class="col-sm-5 col-form-label">Nombre de la supervisión</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="Ingresa el nombre de la supervisión" name="nombreSup" id="nombreSup" class="form-control" required>
                    </div>
                    </div>
                    <div class="mb-3">
                  <label for="dependencia" class="col-sm-5 col-form-label">Dependencia</label>
                  <div class="col-sm-8">
                            <select name="dependencia" class="form-control" id="dependencia" required>
                              <option value="" disabled selected>Selecciona una dependencia</option>
                              <option value="Organo de operacion administrativa desconcentrada de Aguascalientes">Organo de operacion administrativa desconcentrada de Aguascalientes</option>
                              <option value="Hospital General #1">Hospital General #1</option>
                              <option value="Hospital General #2">Hospital General #2</option>
                              <option value="Hospital General #3">Hospital General #3</option>
                              <option value="Unidad Medica Familiar #1">Unidad Medica Familiar #1</option>
                              <option value="Unidad Medica Familiar #2">Unidad Medica Familiar #2</option>
                              <option value="Unidad Medica Familiar #3">Unidad Medica Familiar #3</option>
                              <option value="Unidad Medica Familiar #4">Unidad Medica Familiar #4</option>
                              <option value="Unidad Medica Familiar #">Unidad Medica Familiar #5</option>
                              <option value="Unidad Medica Familiar #6">Unidad Medica Familiar #6</option>
                              <option value="Unidad Medica Familiar #7">Unidad Medica Familiar #7</option>
                              <option value="Unidad Medica Familiar #8">Unidad Medica Familiar #8</option>
                              <option value="Unidad Medica Familiar #9">Unidad Medica Familiar #9</option>
                              <option value="Unidad Medica Familiar #10">Unidad Medica Familiar #10</option>
                              <option value="Unidad Medica Familiar #11">Unidad Medica Familiar #11</option>
                              <option value="Unidad Medica Familiar #12">Unidad Medica Familiar #12</option>
                              <option value="Unidad Medica de Atencion Ambulatoria">Unidad Medica de Atencion Ambulatoria</option>
                              <option value="Guarderia Ordinaria">Guarderia Ordinaria</option>
                              <option value="Centro de Seguridad Social">Centro de Seguridad Social</option>
                              <option value="Planta de lavado">Planta de lavado</option>
                              <option value="Coordinacion de Abasto">Coordinacion de Abasto</option>
                              <option value="Subdelegacion Sur">Subdelegacion Sur</option>
                            </select>
                          </div>
                        <p></p>
                </div>
                <div class="mb-3">
                    <label for="fileCedula" class="form-label">Seleccionar cédula </label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="fileCedula" id="fileCedula" required>
                    </div>
                    </div>
                <div class="mb-3">
                    <label for="fileMinuta" class="form-label">Seleccionar Minuta </label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="fileMinuta" id="fileMinuta" required>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary"> Subir Archivos</button>
                </form>
    <br>
            <div>
                <h2>Documentos Archivados </h2>
                <div id="tablaArchivos"></div>
            </div>
        </div>
        <br>
        <p></p>
    
</center>


<?php include ("footerAdmin.php"); ?>

<script type="text/javascript">
        $(document).ready(function(){
            $('#tablaArchivos').load("gestorArchivos.php");
        });
</script>