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
$tituloPagina = "Crear Apertura Supervisor";
?>
<?php include("headerSupervisor.php"); ?>
<?php
$editar_id = isset($_GET['editar']) ? $_GET['editar'] : null;
$Name = '';
$depe = '';
$tipo = '';
$fi = '';
$ff = '';
if ($editar_id) {
    $consulta = "SELECT aperturas_admin.id, nombre_supervision, dependencia.unidad, fecha_inicio, fecha_fin, aperturas_admin.tipo FROM aperturas_admin 
    INNER JOIN dependencia ON dependencia.id = aperturas_admin.dependencia
     WHERE aperturas_admin.id = '$editar_id'";
    $ejecutar = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_array($ejecutar);
    if($fila){
        $ID = $fila['id'];
        $Name = $fila['nombre_supervision'];
        $depe = $fila['unidad'];
        $tipo = $fila['tipo'];
        $fi = $fila['fecha_inicio'];
        $ff = $fila['fecha_fin'];
    }
}
?>
<center>
  <style>
     .jumbotron {
              background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 110vh;
        }
  </style>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
     <section class="section">
      <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <center>
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Apertura Supervisor</h2>
              <br>
              <center>
                
              <form name="formulario" id="formulario" method="POST" onsubmit="return validarFechas()">
              <div class="row mb-3">
                  <label for="NAME" class="col-sm-2 col-form-label">Nombre supervisión:</label>
                  <div class="col-sm-8">
                    <input placeholder="Ingresa el nombre de la supervisión" type="text" name="name" class="form-control" value="<?php echo $Name; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="DEP" class="col-sm-2 col-form-label">Dependencia:</label>
                  <datalist id="depencia">
                        <option value="Organo de operacion administrativa desconcentrada de Aguascalientes">
                        <option value="Hospital General #1">
                        <option value="Hospital General #2">
                        <option value="Hospital General #3">
                        <option value="Unidad Medica Familiar #1">
                        <option value="Unidad Medica Familiar #2">
                        <option value="Unidad Medica Familiar #3">
                        <option value="Unidad Medica Familiar #4">
                        <option value="Unidad Medica Familiar #5">
                        <option value="Unidad Medica Familiar #6">
                        <option value="Unidad Medica Familiar #7">
                        <option value="Unidad Medica Familiar #8">
                        <option value="Unidad Medica Familiar #9">
                        <option value="Unidad Medica Familiar #10">
                        <option value="Unidad Medica Familiar #11">
                        <option value="Unidad Medica Familiar #12">
                        <option value="Unidad Medica de Atencion Ambulatoria">
                        <option value="Guarderia Ordinaria">
                        <option value="Centro de Seguridad Social">
                        <option value="Planta de lavado">
                        <option value="Coordinación de Abasto">
                        <option value="Subdelegacion Sur">
                        </datalist>
                        <p></p>
                  <div class="col-sm-8">
                    <input  placeholder="Selecciona una unidad médica" list="depencia" name="depe" class="form-control" value="<?php echo $depe; ?>"  id="dep" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="FI" class="col-sm-2 col-form-label">Declarador:</label>
                  <div class="col-sm-8">
                  <input type="hidden" name="decla" id="declaHidden" value="">
                  <select name="declaraSelect" id="decla" class="form-control" required onchange="document.getElementById('declaHidden').value=this.value;">
                        <option value="" disabled selected>Asignar declarador (Seleccionar la unidad del declarador): </option>
                       <option value="11">Organo de operacion administrativa desconcentrada de Aguascalientes</option>
                        <option value="18">Hospital General #1</option>
                        <option value="25">Hospital General #2</option>
                        <option value="7">Hospital General #3</option>
                        <option value="26">Unidad Medica Familiar #1</option>
                        <option value="20">Unidad Medica Familiar #2</option>
                        <option value="28">Unidad Medica Familiar #3  </option>
                        <option value="29">Unidad Medica Familiar #4</option>
                        <option value="30">Unidad Medica Familiar #5</option>
                        <option value="31">Unidad Medica Familiar #6</option>
                        <option value="44">Unidad Medica Familiar #7</option>
                        <option value="45">Unidad Medica Familiar #8</option>
                        <option value="34">Unidad Medica Familiar #9</option>
                        <option value="35">Unidad Medica Familiar #10</option>
                        <option value="36">Unidad Medica Familiar #11</option>
                        <option value="37">Unidad Medica Familiar #12</option>
                        <option value="38">Unidad Medica de Atencion Ambulatoria</option>
                        <option value="39">Guarderia Ordinaria</option>
                        <option value="40">Centro de Seguridad Social</option>
                        <option value="41">Planta de lavado</option>
                        <option value="27">Coordinación de Abasto</option>
                        <option value="42">Subdelegacion Sur</option>
                        </select>
                        <small class="form-text text-muted">Recuerda seleccionar la misma dependencia en declarador</small>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="FI" class="col-sm-2 col-form-label">Fecha Inicio:</label>
                  <div class="col-sm-5">
                    <input type="date" name="fi" id="FI"  class="form-control" value="<?php echo $fi; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="FF" class="col-sm-2 col-form-label">Fecha Fin:</label>
                  <div class="col-sm-5">
                    <input type="date" name="ff" id="FF" class="form-control"  value="<?php echo $ff; ?>" required>
                  </div>
                </div>
                <br>
                <div class="row mb-3">
                  <div class="col-sm-12">
                    <button name="Add" type="submit" class="btn btn-primary" onclick="return ConfirmApertura()">Crear Apertura</button>
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
<?php
  	if (isset($_POST['Add'])) {
		$Depen = $_POST['depe'];
    $unid = 0; 
		switch ($Depen) {
        case "Organo de operacion administrativa desconcentrada de Aguascalientes":
        $unid = 1;
        break;
		    case "Hospital General #1":
        $unid = 2;
        break;
		    case "Hospital General #2":
        $unid = 3;
        break;
		    case "Hospital General #3":
        $unid = 4;
        break;
		    case "Unidad Medica Familiar #1":
        $unid = 5;
        break;
		    case "Unidad Medica Familiar #2":
        $unid = 6;
        break;
		    case "Unidad Medica Familiar #3":
        $unid = 7;
        break;
		    case "Unidad Medica Familiar #4":
        $unid = 8;
        break;
		    case "Unidad Medica Familiar #5":
        $unid = 9;
        break;
		    case "Unidad Medica Familiar #6":
        $unid = 10;
        break;
		    case "Unidad Medica Familiar #7":
        $unid = 11;
        break;
		    case "Unidad Medica Familiar #8":
        $unid = 12;
        break;
		    case "Unidad Medica Familiar #9":
        $unid = 13;
        break;
		    case "Unidad Medica Familiar #10":
        $unid = 14;
        break;
		    case "Unidad Medica Familiar #11":
        $unid = 15;
        break;
		    case "Unidad Medica Familiar #12":
        $unid = 16;
        break;
		    case "Unidad Medica de Atencion Ambulatoria":
        $unid = 17;
        break;    
		    case "Guarderia Ordinaria":
        $unid = 18;
        break;
		    case "Centro de Seguridad Social":
        $unid = 19;
        break;
		    case "Planta de lavado":
        $unid = 20;
        break;
		    case "Coordinación de Abasto":
        $unid = 21;
        break;
		    case "Subdelegacion Sur":
        $unid = 22;
        break;
}
    $Decla = $_POST['decla'];
		$name = $_POST['name'];
		$Ini = $_POST['fi'];
		$Fin = $_POST['ff'];
    
    $verificacionConsulta = "SELECT id FROM usuario WHERE id = '$Decla'";
    $resultadoVerificacion = $conexion->query($verificacionConsulta);
         if($resultadoVerificacion->num_rows > 0){
            $Consulta = "INSERT INTO `apertura_supervisor` (`id`, `nombre_supervision`, `unidad`, `declarador`, `fecha_inicio`, `fecha_fin`,  `tipo`, `Estatus`) VALUES ('NULL','$name','$unid','$Decla','$Ini','$Fin','supervision','Activo')";

            if ($conexion->query($Consulta) === TRUE) {
                $ID = $conexion->insert_id;
                if ($editar_id) {
                  $actualizarEstatusQuery = "UPDATE aperturas_admin SET estatus = 'concluida' WHERE id = $editar_id";
                  if ($conexion->query($actualizarEstatusQuery) === TRUE) {
                      echo "<script>alert('Se creó la apertura correctamente!')</script>";
                      ?>
                      <script type="text/javascript"> window.location.replace("consultarApertura.php");  </script>
                      <?php
                  } else {
                      echo "<script>alert('Ocurrió un error al actualizar el estatus en aperturas_admin: " . $conexion->error . "')</script>";
              }
            } else {
               echo "<script>alert('Se creó la apertura correctamente!.')</script>";
              ?>
                   <script type="text/javascript"> window.location.replace("consultarApertura.php");  </script>
              <?php
            }
          } else {
            echo "<script>alert('Ocurrió un error, revise los diálogos!')</script>";
          }
        } else {
            echo "<script>alert('El ID del declarador no es válido. Por favor, ingrese un ID existente.')</script>";
        }
    }
?>
<?php include("footerSupervisor.php"); ?>

<script>
    function validarFechas() {
      
        var fechaInicio = new Date(document.getElementById('FI').value);
        var fechaFin = new Date(document.getElementById('FF').value);

        // Verificar que la fecha de fin no sea anterior a la fecha de inicio
        if (fechaFin < fechaInicio) {
            alert('La fecha de fin no puede ser anterior a la fecha de inicio.');
            return false;
        }

        // Obtener el valor de Dependencia
            var dependencia = document.getElementById('dep').value;

        // Obtener el texto seleccionado en el select para Declarador
        var declaradorSelect = document.getElementById('decla');
        var declaradorText = declaradorSelect.options[declaradorSelect.selectedIndex].text;

        // Realizar la comparación y mostrar un mensaje si no coinciden
        if (dependencia !== declaradorText) {
            alert('La dependencia y el declarador deben ser iguales. Por favor, selecciona los mismos valores en ambos campos.');
            return false;
        }
        return true;
            }
</script>

<script type="text/javascript">
    function ConfirmApertura()
    {
        var respuesta = confirm("¿Estas seguro de crear la apertura con los datos ingresados?");
         if(respuesta == true)
         {
            return true;
         }
         else{
            return false;
         }
    }
</script>