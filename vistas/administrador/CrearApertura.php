<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
  header('Location: ../../index.php');
  exit;
} else {
  $idd = $_SESSION['id'];
}
$tituloPagina = "Crear Nueva Apertura";
?>

<?php include("headerAdmin.php"); ?>

<center>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <section class="section">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <center>
                <div class="card">
                  <div class="card-body">
                    <h2 class="card-title">Apertura</h2>
                    <br>
                    <center>
                      <form name="formulario" id="formulario" method="POST" onsubmit="return validarFechas()">
                        <div class="row mb-3">
                          <label for="DEP" class="col-sm-2 col-form-label">Dependencia</label>
                          <div class="col-sm-8">
                            <select name="depe" class="form-control" id="DEP" required>
                              <option value="" disabled selected>Selecciona una dependencia</option>
                              <option value="1">Organo de operacion administrativa desconcentrada de Aguascalientes</option>
                              <option value="2">Hospital General #1</option>
                              <option value="3">Hospital General #2</option>
                              <option value="4">Hospital General #3</option>
                              <option value="5">Unidad Medica Familiar #1</option>
                              <option value="6">Unidad Medica Familiar #2</option>
                              <option value="7">Unidad Medica Familiar #3</option>
                              <option value="8">Unidad Medica Familiar #4</option>
                              <option value="9">Unidad Medica Familiar #5</option>
                              <option value="10">Unidad Medica Familiar #6</option>
                              <option value="11">Unidad Medica Familiar #7</option>
                              <option value="12">Unidad Medica Familiar #8</option>
                              <option value="13">Unidad Medica Familiar #9</option>
                              <option value="14">Unidad Medica Familiar #10</option>
                              <option value="15">Unidad Medica Familiar #11</option>
                              <option value="16">Unidad Medica Familiar #12</option>
                              <option value="17">Unidad Medica de Atencion Ambulatoria</option>
                              <option value="18">Guarderia Ordinaria</option>
                              <option value="19">Centro de Seguridad Social</option>
                              <option value="20">Planta de lavado</option>
                              <option value="21">Coordinacion de Abasto</option>
                              <option value="22">Subdelegacion Sur</option>
                            </select>
                          </div>
                          <p></p>
                        </div>
                        <div class="row mb-3">
                          <label for="NAME" class="col-sm-2 col-form-label">Nombre de la supervisión</label>
                          <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="FI" class="col-sm-2 col-form-label">Fecha Inicio</label>
                          <div class="col-sm-5">
                            <input type="date" name="fi" id="FI" class="form-control" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="FF" class="col-sm-2 col-form-label">Fecha Fin</label>
                          <div class="col-sm-5">
                            <input type="date" name="ff" id="FF" class="form-control" required>
                          </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                          <div class="col-sm-12">
                            <button name="Add" type="submit" class="btn btn-primary" onclick="return exito()">Crear Apertura</button>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
              </center>
            </div>
          </div>

      </section>
    </div>
  </div>
</center>

<script>
  function validarFechas() {
    var fechaInicio = new Date(document.getElementById('FI').value);
    var fechaFin = new Date(document.getElementById('FF').value);

    if (fechaFin < fechaInicio) {
      alert('La fecha de fin no puede ser anterior a la fecha de inicio.');
      return false;
    }

    return true;
  }
</script>

<?php
if (isset($_POST['Add'])) {

  $unid = $_POST['depe'];
  $Nom = $_POST['name'];
  $Ini = $_POST['fi'];
  $Fin = $_POST['ff'];

  $Consulta = "INSERT INTO `aperturas_admin` (`id`, `fecha_inicio`, `fecha_fin`, `dependencia`, `nombre_supervision`, `tipo`, `estatus`) 
  VALUES ('NULL', '$Ini','$Fin','$unid','$Nom','Supervision','Activa')";
  if ($conexion->query($Consulta) === TRUE) {
    echo "<script>alert('Se creo la apertura correctamente!')</script>"; ?>
    <script type="text/javascript">
      window.location.replace("aperturaAdmin.php");
    </script>

<?php
  } else {
    echo "<script>alert('Ocurrio un error revise los dialogos!')</script>";
  }
}
?>


<?php include("footerAdmin.php"); ?>