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
$tituloPagina = "Crear Nuevo Usuario";
?>

<?php include ("headerAdmin.php"); ?>



<div class="jumbotron jumbotron-fluid">
<div class="container">
  <section class="section">
    <div class="row">
    <div class="col-lg-12">
      <center>
      <div class="card">
        <div class="card-body">
          <center>
        <h2>Crear Usuario</h2>
        </div>
        <form name="formulario" id="formulario" method="POST">
          <div class="row mb-12">
            <label for="TIPO" class="col-sm-12 col-form-label">Tipo de usuario:</label>
          </div>
                <datalist id="tp">
                    <option value="Administrador">
                    <option value="Supervisor">
                    <option value="Declarador">
                </datalist>
          <div class="col-sm-10">
              <input name="Tipo" list="tp" class ="form-control" id="TIPO" required>
      </div> 

  <div class="row mb-12">
    <label for="DEP" class="col-sm-12 col-form-label">Dependencia:</label>
  </div>
    <datalist id="dependencia">
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
    <option value="Coordinacion de Abasto">
    <option value="Subdelegacion Sur">
    </datalist>
    <p></p>
    <div class="col-sm-10">
    <input name="Depe" list="dependencia" class ="form-control" id="DEP" required>
  </div> 

  <div class="row mb-12">
    <label for="DEPA" class="col-sm-12 col-form-label">Departamento:</label>
</div>
    <datalist id="Departamento">
      <option value="Departamento de capacitacion y transparencia">
      <option value="Departamento de personal">
      <option value="Departamento de relaciones laborales">
      <option value="Departamento de presupuesto y control de gasto">
    </datalist>
    <p></p>
    <div class="col-sm-10">
    <input name="Depa" list="Departamento" class ="form-control" id="DEPA" required>
    
  </div>

  <div class="row mb-12">
    <label for="N" class="col-sm-12 col-form-label">Nombre Completo:</label>
</div>
  <div class="col-sm-10">
    <input type="enable" name="name"  class ="form-control" id="N" required>
  </div>

  <div class="row mb-12">
    <label for="C" class="col-sm-12 col-form-label">Correo:</label>
</div>
<div class="col-sm-10">
    <input type="enable" name="email" class ="form-control" id="C" required>
  </div>
  
  <div class="row mb-12">
  <label for="U" class="col-sm-12 col-form-label">Usuario:</label>
</div>
<div class="col-sm-10">
    <input type="enable" name="user" class ="form-control" id="U" required>
  </div>

  <div class="row mb-12">
    <label for="P" class="col-sm-12 col-form-label">Contraseña:</label>
</div>
<div class="col-sm-10">
    <input type="enable" name="pass" class ="form-control" id="P" required>
  </div>

  <div class="row mb-12">
    <label for="CAR" class="col-sm-12 col-form-label">Cargo:</label>
</div>
<div class="col-sm-10">
    <input type="enable" name="cargo" class ="form-control" id="CAR" required>
  </div>

  <div class="row mb-12">
    <label for="TEL" class="col-sm-12 col-form-label">Teléfono y EXT:</label>
</div>
<div class="col-sm-10">
    <input type="enable" name="tel" class ="form-control" id="TEL" required>
  </div>
    <br>
    <center>
    <div class="row">
      
      <div class="col-sm-12 text-left">
      <center>
        <button name="Add" type="submit" class="btn btn-success" onclick="return exito()">Registrar Usuario</button>
        </center>
      </div>
    </div>
    </center>
</center> 
</form>
</div>
</div>
</div>
</div>
</section>
    </div>
    </div>

<?php
  if (isset($_POST['Add'])) {
    $Tipe = $_POST['Tipo'];
    switch ($Tipe) {
        case "Administrador":
        $Type =1;
        break;
        case "Supervisor":
        $Type =2;
        break;
        case "Declarador":
        $Type =3;
        break;
    }
    
    $Depen = $_POST['Depe'];
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
        case "Coordinacion de Abasto":
    $unid = 21;
    break;
        case "Subdelegacion Sur":
    $unid = 22;
    break;
}
    
    $Depar = $_POST['Depa'];
            switch ($Depar) {
        case "Departamento de capacitacion y transparencia":
        $Depa =1;
        break;
        case "Departamento de personal":
        $Depa =2;
        break;
        case "Departamento de relaciones laborales":
        $Depa =3;
        break;
        case "Departamento de presupuesto y control de gasto":
        $Depa =4;
        break;
    }
    
    $Name = $_POST['name'];
    $User = $_POST['user'];
    $Con = $_POST['pass'];
    $Car = $_POST['cargo'];
    $Tel = $_POST['tel'];
    $Mail = $_POST['email'];
    
    
    $Consulta = "INSERT INTO `usuario` (`id`, `nombre`, `dependencia`, `cargo`, `telefono_ext`, `correo`, `usuario`, `contrasena`, `tipo_usuario`, `departamento`) VALUES ('NULL', '$Name', '$unid', '$Car', '$Tel', '$Mail', '$User', '$Con', '$Type', '$Depa')";
    if ($conexion ->query($Consulta) === TRUE) {
      echo '<script language="javascript">alert("El usuario ha sido registrado con exito");</script>';
            ?>

            <script type="text/javascript">window.location.replace("adminUsuarios.php");  </script>
            
            <?php
    }else{
        echo '<script language="javascript">alert("Ocurrio un error, revisa que los datos sean los correctos e intentalo de nuevo");</script>';
    }
}
?>


<?php include ("footerAdmin.php"); ?>