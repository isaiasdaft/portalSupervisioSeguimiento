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
$tituloPagina = "Detalles de Supervisión";

$APID = $_GET["id"];

$consulta = "SELECT nombre_supervision, dependencia.unidad, usuario.nombre, fecha_inicio, fecha_fin, apertura_supervisor.declarador 
FROM apertura_supervisor 
INNER JOIN usuario ON apertura_supervisor.declarador = usuario.id
INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id
WHERE apertura_supervisor.id = '$APID'";

$ejecutar = mysqli_query($conexion, $consulta);
$fila = mysqli_fetch_array($ejecutar);
$NOMSUP = $fila['nombre_supervision'];
$DEPEN = $fila['unidad'];
$USER = $fila['nombre'];
$FI = $fila['fecha_inicio'];
$FF = $fila['fecha_fin'];
$iduser = $fila['declarador'];

$consulta2 = "SELECT nombre_supervision, dependencia.unidad, usuario.nombre, fecha_inicio, fecha_fin, apertura_supervisor.declarador 
FROM apertura_supervisor 
INNER JOIN usuario ON apertura_supervisor.declarador = usuario.id
INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id
WHERE apertura_supervisor.id = '$APID'";

$ejecutar = mysqli_query($conexion, $consulta2);
$fila = mysqli_fetch_array($ejecutar);
$NOMSUP = $fila['nombre_supervision'];
$DEPEN = $fila['unidad'];
$USER = $fila['nombre'];
$FI = $fila['fecha_inicio'];
$FF = $fila['fecha_fin'];
$iduser = $fila['declarador'];
$depe_utf8 = mb_convert_encoding($DEPEN, "UTF-8", "auto");
?>

<script type="text/javascript">
    function MM_openBrWindow(theURL, winName, features) { //v2.0
        window.open(theURL, winName, features);
    }

    function MM_goToURL() { //v3.0
        var i, args = MM_goToURL.arguments;
        document.MM_returnValue = false;
        for (i = 0; i < (args.length - 1); i += 2) eval(args[i] + ".location='" + args[i + 1] + "'");
    }
</script>


<?php include("headerSupervisor.php"); ?>

<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-5"> Detalles de la Supervisión</h1>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row mb-2">
                            <label for="NOM" class="col-sm-3 col-form-label">Nombre: </label>

                            <div class="col-sm-6">
                                <input type="enable" value="<?php echo $NOMSUP ?>" id="NOM" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="UNI" class="col-sm-3 col-form-label">Unidad: </label>
                            <div class="col-sm-6">
                                <input type="enable" value="<?php echo $depe_utf8 ?>" id="UNI" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="DEC" class="col-sm-3 col-form-label">Declarador:</label>
                            <div class="col-sm-6">
                                <input type="enable" value="<?php echo $USER ?>" id="DEC" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="start" class="col-sm-3 col-form-label">Fecha de Inicio:</label>
                            <div class="col-sm-6">
                                <input type="enable" value="<?php echo $FI ?>" id="start" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="end" class="col-sm-3 col-form-label">Fecha de Termino:</label>
                            <div class="col-sm-6">
                                <input type="enable" value="<?php echo $FF ?>" id="end" class="form-control" readonly />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p></p>
            <div align="center">
                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                            <th bgcolor="#A4CBB3" scope="col">
                                <center>Procesos Sustantivos</center>
                            </th>
                            <th bgcolor="#A4CBB3" scope="col">
                                <center>Especificaciones</center>
                            </th>
                            <th bgcolor="#A4CBB3" scope="col">
                                <center>Avances</center>
                            </th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT puntos_sustantivos.id, titulo, especificacion FROM puntos_sustantivos 
                    INNER JOIN departamento ON puntos_sustantivos.departamento = departamento.id 
                    INNER JOIN usuario ON departamento.id = usuario.departamento 
                    INNER JOIN especificaciones_supervisor ON puntos_sustantivos.id = especificaciones_supervisor.id_punto 
                    INNER JOIN apertura_supervisor ON especificaciones_supervisor.id_sup = apertura_supervisor.id 
                    WHERE especificaciones_supervisor.id_sup = '$APID' AND usuario.id = $idd; ";

                    $ex = mysqli_query($conexion, $query);
                    $i = 0;
                    while ($var = mysqli_fetch_array($ex)) {
                        $id = $var['id'];
                        $Titulo = $var['titulo'];
                        $Esp = $var['especificacion'];
                        $titulo_utf8 = mb_convert_encoding($Titulo, "UTF-8", "auto");
                    ?>
                        <tr align="center">
                            <td><?php echo $titulo_utf8; ?></td>
                            <td><?php echo $Esp; ?></td>
                            <td>
                            <a class="btn btn-light me-auto me-md-2" href="AvancesDeclarador.php?id=<?php echo $APID; ?>&ideclarador=<?php echo $iduser; ?>&punto=<?php echo $id; ?>">
                                    
                                    Ver avances
                                    <span class="fa-solid fa-circle-chevron-right" style="color: #13e99b;"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>

            <div class="text-center mt-4">

                <a class="btn btn-info me-auto me-md-2" href="SupervisionFinal.php?id=<?php echo $APID; ?>&ideclarador=<?php echo $iduser; ?>">
                    Evaluar Supervisiones
                    <span class="fa-solid fa-circle-chevron-right" style="color: #13e99b;"></span>
                </a>
            </div>

        </div>
    </div>
</center>




<?php include("footerSupervisor.php"); ?>