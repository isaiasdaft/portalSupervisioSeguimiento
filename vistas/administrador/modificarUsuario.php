<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../index.php');
    exit;
}
else{
	$idd=$_SESSION['id'];
}
?>


<?php include ("headerAdmin.php"); ?>


<?php
if(isset($_GET['editar'])){
	$editar_id = $_GET['editar'];

	$consulta = "SELECT usuario.nombre, usuario, contrasena, telefono_ext, correo, cargo, departamento.nombre as nom , unidad, tipo FROM usuario INNER JOIN tipo_user ON usuario.tipo_usuario = tipo_user.id 
	INNER JOIN dependencia ON usuario.dependencia = dependencia.id
	 INNER JOIN departamento ON usuario.departamento = departamento.id 
	 WHERE usuario.id =  '$editar_id'";
	$ejecutar = mysqli_query($conexion, $consulta);

	$fila = mysqli_fetch_array($ejecutar);
	

	$Name = $fila['nombre'];
	$User = $fila['usuario'];
	$Con = $fila['contrasena'];
	$Tel = $fila['telefono_ext'];
	$Mail = $fila['correo'];
	$Car = $fila['cargo'];
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
    <section>
    <div class="row">
            <div class="col-lg-12">
        <center>
          <div class="card">
            <div class="card-body">
              <br>
    

    
    <h1>Editar Usuario</h1>
    
    
  <form name="formulario" id="formulario" method="POST">
    <center>
      
    <div class="row mb-12">
        <label for="NAME" class="col-sm-12 col-form-label">Nombre Completo:</label>
    </div>
        <p></p>
        <div class="col-sm-7">
        <input type="enable" name="name" value="<?php echo $Name; ?>" class ="form-control" id="NAME" required>
      </div>
      
      <div class="row mb-12">
        <label for="C" class="col-sm-12 col-form-label">Correo:</label>
      </div>
        <p></p>
        <div class="col-sm-7">
        <input type="enable" name="email" value="<?php echo $Mail; ?>" class ="form-control" id="C" required>
      </div> 
      
      <div class="row mb-12">
        <label for="USER" class="col-sm-12 col-form-label">Usuario:</label>
        </div>
        <p></p>
        <div class="col-sm-7">
        <input type="enable" name="user" value="<?php echo $User; ?>" class ="form-control" id="USER" required>
      </div>
      
      <div class="row mb-12">
        <label for="PASS" class="col-sm-12 col-form-label">Contraseña:</label>
        </div>
        <p></p>
        <div class="col-sm-7">
        <input type="enable" name="pass" value="<?php echo $Con; ?>" class ="form-control" id="PASS" required>
      </div>
      
      <div class="row mb-12">
        <label for="CAR" class="col-sm-12 col-form-label">Cargo:</label>
        </div>
        <p></p>
        <div class="col-sm-7">
        <input type="enable" name="cargo" value="<?php echo $Car; ?>" class ="form-control" id="CAR" required>
      </div>

      <div class="row mb-12">
        <label for="TEL" class="col-sm-12 col-form-label">Teléfono y EXT:</label>
      </div>
        <p></p>
        <div class="col-sm-7">
        <input type="enable" name="tel" value="<?php echo $Tel; ?>" class ="form-control" id="TEL" required>
      </div>

      <p></p>
      <input type="submit" value="ACTUALIZAR DATOS" name="actualizar" class="btn">
    </center>
    </div>
    </div>
    </div>
    </div>
    </form>
    <section>
  </div>
</div>


<?php
	if (isset($_POST['actualizar'])){
		
		$Name = $_POST['name'];
		$User = $_POST['user'];
		$Con = $_POST['pass'];
		$Tel = $_POST['tel'];
		$Mail = $_POST['email'];
		$Car = $_POST['cargo'];
		
		if($Name!="none" and $Con!="none" and $Car!="none" and $Tel!="none" and $Mail!="none"){
			$actualizar = "UPDATE usuario SET nombre = '$Name', usuario = '$User', cargo = '$Car', telefono_ext = '$Tel', correo = '$Mail', contrasena = '$Con' WHERE usuario.id='$editar_id'";

			$ejecutar = mysqli_query($conexion, $actualizar);

			if ($ejecutar) {
    			echo "<script>alert('El usuario ha sido Modificado!')</script>";?>
                <script type="text/javascript"> window.location.replace("adminUsuarios.php");  </script>
                
                <?php
			}else{
				echo "<script>alert('Error al modificar')</script>";
			}
		}else{
			echo "<script>alert('Los Campos No Pueden Quedar Vacios!')</script>";
		}
	}
?>







<?php include ("footerAdmin.php"); ?>