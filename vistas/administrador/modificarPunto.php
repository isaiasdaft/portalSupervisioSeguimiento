<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
    $depa = $_SESSION['departamento'];

   
}
$tituloPagina = "Actualizar Punto Sustantivo";
?>

<?php include("headerAdmin.php"); ?>

<script type="text/javascript">
   function ConfirmDelete() {
    return confirm("¿Estás seguro de eliminar el punto sustantivo?");
}
</script>

<?php
$Name = ''; // Asignar un valor predeterminado
$Fue = '';
$meto = '';
$obj = '';

if (isset($_GET['editar_id'])) {
    $editar_id = $_GET['editar_id'];
    $consulta = "SELECT id, titulo, fuente, metodologia, objetivo FROM puntos_sustantivos WHERE id = '$editar_id'";
    $ejecutar = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_array($ejecutar);
    if ($fila) {
        $id = $fila['id'];
        $Name = $fila['titulo'];
        $Fue = $fila['fuente'];
        $meto = $fila['metodologia'];
        $obj = $fila['objetivo'];
    }
}
?>
<center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-6"> Actualizar Punto Sustantivo</h1>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <center>
                            <div class="card">
                                <div class="card-body">
                                    <form name="formulario" id="formulario" method="POST">
                                        <div class="row mb-12">
                                            <label for="NAM" class="col-sm-12 col-form-label"> Título:</label>
                                        </div>
                                        <p></p>
                                        <div class="col-sm-12">
                                            <center> </center>
                                            <textarea type="text" name="name" class="form-control" style="width: 100%;" required><?php echo $Name; ?></textarea>
                                            <center>
                                        </div>
                                        <div class="row mb-12">
                                            <label for="Tipo" class="col-sm-12 col-form-label"> Fuente:</label>
                                        </div>
                                        <p></p>
                                        <div class="col-sm-12">
                                            <textarea type="text" name="fuente" class="form-control" required><?php echo $Fue; ?></textarea>
                                        </div>
                                        <div class="row mb-12">
                                            <label for="FI" class="col-sm-12 col-form-label">Metodologia:</label>
                                        </div>
                                        <p></p>
                                        <div class="col-sm-12">
                                        <textarea type="text"  name="metodologia" class="form-control"  required><?php echo $meto; ?></textarea>
                                        </div>
                                        <div class="row mb-12">
                                            <label for="FF" class="col-sm-12 col-form-label">Objetivo:</label>
                                        </div>
                                        <p></p>
                                        <div class="col-sm-12">
                                        <textarea type="text" name="objetivo" class="form-control"  required><?php echo $obj; ?> </textarea>
                                        </div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>
        </div>

        <center>
            <p>&nbsp;</p>
            <input type="submit" value="Modificar" name="actualizar" class="btn">
        </center>
        <br>
        <center>
         <a href="modificarPunto.php?borrar=<?php echo $id; ?>" onclick="return confirm('¿Estas seguro de eliminar el usuario?'">
            <span class="btn btn-danger btn-md" onclick="return ConfirmDelete()"><span class="fas fa-trash">
                 </span></span>
                 </a>

        </center>
        </form>
    </div>
</center>
<?php
if (isset($_POST['actualizar'])) {
    $Name = mysqli_real_escape_string($conexion, $_POST['name']);
    $Fue = mysqli_real_escape_string($conexion, $_POST['fuente']);
    $meto = mysqli_real_escape_string($conexion, $_POST['metodologia']);
    $obj = mysqli_real_escape_string($conexion, $_POST['objetivo']);

    if (!empty($Name) && !empty($Fue) && !empty($meto) && !empty($obj)) {
        $actualizar = "UPDATE puntos_sustantivos SET titulo ='$Name', fuente='$Fue', metodologia = '$meto', objetivo='$obj' WHERE id = '$editar_id'";
        $ejecutar = mysqli_query($conexion, $actualizar);
        if ($ejecutar) {
            echo "<script>alert('El punto Sustantivo ha sido modificado!')</script>"; ?>
            <script type="text/javascript">
                window.location.replace("CapacitacionTransparencia.php");
            </script>
<?php
        } else {
            echo "<script>alert('Error al modificar')</script>";
        }
    } else {
        echo "<script>alert('Los Campos No Pueden Quedar Vacios!')</script>";
    }
}
?>


<?php
if(isset($_GET['borrar'])){
    // Cambié "usuario" a "puntos_sustantivos" en la consulta DELETE
    mysqli_query($conexion, "DELETE FROM puntos_sustantivos WHERE id = '".$_GET['borrar']."'");
    echo "<script>alert('El punto ha sido borrado!')</script>";?>
    <script type="text/javascript"> window.location.replace("CapacitacionTransparencia.php"); </script>
<?php
}
?>

<?php include("footerAdmin.php"); ?>