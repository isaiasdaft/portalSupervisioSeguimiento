<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Asignar Seguimiento";
$APID = $_GET["id_sup"];
$OPID = $_GET["id"];

$consulta = "SELECT calificacion_supervision.id, calificacion_supervision.id_usuario, 
apertura_seguimiento.fecha_inicio, apertura_seguimiento.fecha_fin 
FROM calificacion_supervision LEFT JOIN apertura_seguimiento ON
 calificacion_supervision.id = apertura_seguimiento.id_revision 
 WHERE calificacion_supervision.id_sup = '$APID' AND calificacion_supervision.id_punto = '$OPID';  ";

$ejecutar = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($ejecutar);

$IDREVIS = $fila['id'];
$user = $fila['id_usuario'];
$fechaInicio = $fila['fecha_inicio'];
$fechaFin = $fila['fecha_fin'];

?>
<?php include("headerSupervisor.php"); ?>
<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <section class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="card-title"> Asignar fechas de Seguimiento</h1>
                                        <center>
                                            <form name="formulario" id="formulario" method="POST">
                                                <div class="row mb-12">
                                                    <label for="NAME" class="col-sm-12 col-form-label">ID de la Calificación y supervisión</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="enable" value="<?php echo $IDREVIS ?>" name="REV" id="rev" class="form-control"  readonly>
                                                </div>
                                                <br>
                                                <div class="row mb-3">
                                                    <label for="input_from" class="col-md-3 col-form-label"> </label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="fi"  id="input_from" class="form-control" placeholder="Seleccionar fecha de Inicio"  value="<?php echo $fechaInicio; ?>" required>
                                         </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="input_to" class="col-md-3 col-form-label"></label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="ff" id="input_to" class="form-control" placeholder="Seleccionar Fecha de Finalización" value="<?php echo $fechaFin; ?>" required> 
                                                    </div>
                                                </div>
                                                <input type="hidden" name="ideclarador" value="<?php echo $user; ?>">
                                                <br>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <button name="Add" type="submit" class="btn btn-primary" onclick="return ConfirmApertura()">Enviar a Seguimiento</button>
                                                        <button name="Update" type="submit" class="btn btn-warning" onclick="return ConfirmApertura()">Actualizar Seguimiento</button>
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
</center>
<?php
  	if (isset($_POST['Add'])) {
    $revision = $_POST['REV'];
	$Ini = $_POST['fi'];
	$Fin = $_POST['ff'];

    $ideclarador = $_POST['ideclarador'];
    $insertQuery = "INSERT INTO `apertura_seguimiento`(`id_revision`, `fecha_inicio`, `fecha_fin`,`archivo_subido`, `estatus`) VALUES ('$revision', '$Ini', '$Fin', NULL, 'Revision')";
    $result = mysqli_query($conexion, $insertQuery);
    if ($result === TRUE) {
        echo "<script>alert('Se envió correctamente a seguimiento  la apertura !')</script>";
        ?>
        <script type="text/javascript">
            var id = <?php echo json_encode($APID); ?>;
            var ideclarador = <?php echo json_encode($ideclarador); ?>;
            window.location.href = "SupervisionFinal.php?id=" + id + "&ideclarador=" + ideclarador;
        </script>

        ?>
        <?php
    } else {
        echo "<script>alert('Ocurrió un error al actualizar el estatus en aperturas_admin: " . mysqli_error($conexion) . "')</script>";
    
    }
    }
if (isset($_POST['Update'])) {
    $revision = $_POST['REV'];
    $Ini = $_POST['fi'];
    $Fin = $_POST['ff'];
    $ideclarador = $_POST['ideclarador'];
    if (!empty($Ini) && !empty($Fin)) {
        // Sentencia SQL de actualización
        $updateQuery = "UPDATE `apertura_seguimiento` SET `fecha_inicio`='$Ini', `fecha_fin`='$Fin' WHERE `id_revision`='$revision'";

        // Ejecutar la consulta de actualización
        $updateResult = mysqli_query($conexion, $updateQuery);

        if ($updateResult === TRUE) {
            echo "<script>alert('Se actualizó correctamente la apertura en seguimiento!')</script>";
            ?>
            <script type="text/javascript">
                var id = <?php echo json_encode($APID); ?>;
                var ideclarador = <?php echo json_encode($ideclarador); ?>;
                window.location.href = "SupervisionFinal.php?id=" + id + "&ideclarador=" + ideclarador;
            </script>
            <?php
        } else {
            echo "<script>alert('Ocurrió un error al actualizar la apertura en seguimiento: " . mysqli_error($conexion) . "')</script>";
        }
    } else {
        echo "<script>alert('Por favor, complete los campos de fecha antes de actualizar.')</script>";
    }
}
?>
?>
<?php include("footerSupervisor.php"); ?>