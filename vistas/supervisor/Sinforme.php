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
$tituloPagina = "Añadir Criterio";
$PUNTOID = $_GET['id'];
$sup = $_GET['sup'];

?>

<?php
if (isset($_GET['editar'])) {
    $editar_id = $_GET['editar'];
}
?>

<?php include("headerSupervisor.php"); ?>

<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"> Agregar comentario a supervisión</h2>
                <div>
                    <br>
                    <table class="table table-striped table-hover" border="2">
                        <thead>
                            <tr>
                                <th bgcolor="#A4CBB3" scope="col">
                                    <p>
                                        <center>Proceso Sustantivo</center>
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <?php
                        $consulta = "SELECT titulo  FROM puntos_sustantivos WHERE id = '$PUNTOID'";
                        $ejecutar = mysqli_query($conexion, $consulta);
                        $i = 0;
                        while ($fila = mysqli_fetch_array($ejecutar)) {
                            $Punto = $fila['titulo'];
                            $Punto_utf8 = mb_convert_encoding($Punto, "UTF-8", "auto");
                        ?>
                            <tr align="center">
                                <td><?php echo $Punto_utf8; ?></td>
                            </tr>
                        <?php } ?>

                        <?php
                        $consulta = "SELECT especificacion FROM especificaciones_supervisor WHERE id_sup = '$sup' AND id_punto = '$PUNTOID'";
                        $ejecutar = mysqli_query($conexion, $consulta);
                        $fila = mysqli_fetch_array($ejecutar);
                        if (isset($fila['especificacion'])) {
                            $especi = $fila['especificacion'];
                            if (isset($_POST['Add'])) {
                                $esp = $_POST['especificacion'];
                                $Consulta = "UPDATE especificaciones_supervisor SET especificacion='$esp'  WHERE id_punto = '$PUNTOID' AND id_sup = '$sup'";
                                if ($conexion->query($Consulta) === TRUE) {
                                    echo "<script>alert('Criterio actualizado correctamente!')</script>"; ?>
                                    <script type="text/javascript">
                                        window.location.replace("consultarApertura.php");
                                    </script>

                                    <?php

                                } else {
                                    echo "<script>alert('Ocurrio un error revise los dialogos!')</script>";
                                }
                            }
                        } else {
                            $especi = "";
                            if (isset($_POST['Add'])) {
                                $esp = $_POST['especificacion'];
                                if (!empty($PUNTOID) && !empty($sup)) {
                                    $Consulta = "INSERT INTO especificaciones_supervisor(id_sup,id_punto, especificacion) values ('$sup','$PUNTOID','$esp')";
                                    if ($conexion->query($Consulta) === TRUE) {
                                        echo "<script>alert('Criterio añadido correctamente!')</script>"; ?>
                                        <script type="text/javascript">
                                            window.location.replace("consultarApertura.php");
                                        </script>
                        <?php
                                    } else {
                                        echo "Error: " . $Consulta . "<br>" . $conexion->error;
                                    }
                                } else {
                                    echo "<script>alert('Ocurrio un error revise los dialogos!')</script>";
                                }
                            }
                        }

                        ?>

                    </table>

                    <p></p>

                    <form id="form1" name="form1" method="POST">

                        <div class="form-group">
                            <label for="ESP">Criterios: </label>
                            <textarea class="form-control" id="ESP" rows="3" name="especificacion" placeholder="Escribe aquí las especificaciones" required><?php echo $especi; ?></textarea>
                        </div>
                        <center>
                            <br>
                            <input type="submit" value="Enviar" name="Add" class="btn">
                            <p>&nbsp;</p>
                        </center>
                    </form>
                    </option>
</center>


</center>

<center></center>
</form>
</div>

</div>
</div>
</center>



<?php include("footerSupervisor.php"); ?>