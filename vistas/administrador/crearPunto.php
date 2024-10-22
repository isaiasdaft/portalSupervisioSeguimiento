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
$tituloPagina = "Nuevo Punto Sustantivo";
?>

<?php include("headerAdmin.php"); ?>

<center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h1>Nuevo Punto Sustantivo</h1>
                                </div>
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="row mb-12">
                                        <label for="N" class="col-sm-12 col-form-label">Título:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea type="enable" name="titulo" class="form-control" id="N" required></textarea>
                                    </div>

                                    <div class="row mb-12">
                                        <label for="C" class="col-sm-12 col-form-label">Fuente:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea type="enable" name="fuente" class="form-control" id="C" required></textarea>
                                    </div>

                                    <div class="row mb-12">
                                        <label for="U" class="col-sm-12 col-form-label">Metodología:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea type="enable" name="metodologia" class="form-control" id="U" required></textarea>
                                    </div>

                                    <div class="row mb-12">
                                        <label for="P" class="col-sm-12 col-form-label">Objetivo:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea type="enable" name="objetivo" class="form-control" id="P" required></textarea>
                                    </div>
                                    <div class="row mb-12 ">
                                            <label for="DEP" class="col-sm-12 col-form-label">Dependencia</label>
                                    </div>
                                            <div class="col-sm-8">
                                                <select name="depe" class="form-control" id="DEP" required>
                                                <option value="" disabled selected>Selecciona el departamento al que se asignara el punto</option>
                                                <option value="1">Departamento de Capacitación y Transparencia</option>
                                                <option value="2">Departamento de Personal</option>
                                                <option value="3">Departamento de Relaciones Laborales</option>
                                                <option value="4">Departamento de Presupuesto y Control del Gasto</option>
                                                </select>
                                            </div>
                                            <br>
                                    <p></p>
                                    </div>
                                    <br>
                                    <center>
                                        <div class="row">
                                            <div class="col-sm-12 text-left">
                                                <center>
                                                    <button name="Add" type="submit" class="btn btn-success" onclick="return exito()">Crear Punto</button>
                                                </center>
                                                <br>
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
    <br>
    <p></p>

</center>


<?php
  if (isset($_POST['Add'])) {

    $tit = $_POST['titulo'];
    $Fue = $_POST['fuente'];
    $meto = $_POST['metodologia'];
    $obj = $_POST['objetivo'];
    $depar = $_POST['depe'];

    
    $Consulta = "INSERT INTO `puntos_sustantivos` (`titulo`, `fuente`, `metodologia`, `objetivo`, `departamento`) VALUES ('$tit', '$Fue', '$meto', '$obj', '$depar')";
    if ($conexion ->query($Consulta) === TRUE) {
      echo '<script language="javascript">alert("El punto ha sido registrado con exito");</script>';
            ?>
            <script type="text/javascript">window.location.replace("CapacitacionTransparencia.php");  </script>
            
            <?php
    }else{
        echo '<script language="javascript">alert("Ocurrio un error, revisa que los datos sean los correctos e intentalo de nuevo");</script>';
    }
}
?>


<?php include("footerAdmin.php"); ?>