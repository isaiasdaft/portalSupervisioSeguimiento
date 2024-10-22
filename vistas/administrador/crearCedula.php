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
$tituloPagina = "Generar Cédula";

?>
<?php include("headerAdmin.php"); ?>

<center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <section class="section">
                <div class="container">
                    <center>
                        <table width="731" border="1" align="center" aling="center">
                            <h2>Cédula - Supervisión</h2>

                            <div class="search-container">
                                <form name="formulario" id="formulario" method="POST">
                                    <label for="TIPO" class="col-md-8 col-form-label">
                                        <h5>Nombre de la supervisión:</h5>
                                    </label>
                                    <datalist id="l">
                                        <?php
                                        $consulta = "SELECT apertura_supervisor.id, nombre_supervision, dependencia.unidad
                                                     from apertura_supervisor 
                                                      INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id";
                                        $ejecutar = mysqli_query($conexion, $consulta);
                                        while ($fila = mysqli_fetch_array($ejecutar)) {
                                            echo '<option value="' . $fila["nombre_supervision"] . '">' . $fila["unidad"] . '</option>';
                                        }
                                        ?>

                                    </datalist>

                                    <div class="input-group sm-2">
                                        <input type="text" name="D1" list="l" class="form-control" id="TIPO" placeholder="Nombre" aria-describedby="basic-addon2" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="submit" value="Buscar" name="buscar">Buscar</button>
                                        </div>
                                    </div>
                                    <span class="fas fa-search"></span>
                            </div>

                            </form>
                </div>
                </form>
                <br>
                <p></p>

                <table width="915" border="2" class="table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th width="180">
                                <center>Procesos Sustantivos</center>
                            </th>
                            <th width="50">
                                <center>RetroAlimentación</center>
                            </th>
                            <th width="110">
                                <center>Calificación</center>
                            </th>
                            <th width="120">
                                <center>comentario Final</center>
                            </th>
                        </tr>
                    </thead>

                    <?php
                    if (isset($_POST['buscar'])) {
                        //se recupera el valor ingresado en la barra de busqueda
                        $supervison_selec = $_POST['D1'];


                        //consulta la base de datos para obtener el valor correcto de $supev
                        $consulta_supervision = "SELECT id FROM apertura_supervisor WHERE nombre_supervision = '$supervison_selec' OR id = '$supervison_selec'";
                        $resultado_supervision = $conexion->query($consulta_supervision);

                        if ($resultado_supervision) {
                            $fila_supervision = $resultado_supervision->fetch_array();

                            if ($fila_supervision) {
                                $nombreSupervision = $fila_supervision['id'];

                                //consulta para obtener calificaciones y comentario
                                $consulta = "SELECT
                                puntos_sustantivos.titulo,
                                calificacion_supervision.comentario AS comentario_calificacion,
                                calificacion_supervision.calificacion,
                                comentario_final.comentario AS comentario_final
                            FROM
                                calificacion_supervision
                            INNER JOIN puntos_sustantivos ON puntos_sustantivos.id = calificacion_supervision.id_punto
                            INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup
                            INNER JOIN apertura_seguimiento ON apertura_seguimiento.id_revision = calificacion_supervision.id
                            LEFT JOIN comentario_final ON comentario_final.id_seguimiento = apertura_seguimiento.id
                            INNER JOIN usuario ON usuario.id = calificacion_supervision.id_usuario
                                WHERE 
                                ( calificacion_supervision.id_sup = '$nombreSupervision' OR apertura_supervisor.nombre_supervision ='$supervison_selec'); ";
                                $var_resultado = $conexion->query($consulta);
                                //mostrar las calificaciones en tabla
                                while ($var_fila = $var_resultado->fetch_array()) {
                                    echo "<tr>
                                    <td>" . $var_fila["titulo"] . "</td>";
                                    echo "<td>" . "<center>" . $var_fila["comentario_calificacion"] . "</td>";
                                    echo "<td>" . "<center>" . $var_fila["calificacion"] . "</td>";
                                    echo "<td>" . "<center>" . $var_fila["comentario_final"] . "</td>";
                                }
                            } else {
                                echo "Supervisión no encontrada.";
                            }
                        } else {
                            echo "Error en la consulta.";
                        }
                    }
                    ?>

                </table>

                <p>&nbsp;</p>
                <p>&nbsp;</p>

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Generar cédula</h2>

                                    <form name="formulario" id="formulario" method="POST">
                                        <div class="row mb-12">
                                            <label for="SUP" class="col-sm-12 col-form-label">Nombre de Supervisión:</label>

                                            <datalist id="2">
                                                <?php
                                                $consulta = "SELECT apertura_supervisor.id, nombre_supervision, dependencia.unidad from apertura_supervisor 
                                                INNER JOIN dependencia ON apertura_supervisor.unidad = dependencia.id";
                                                $ejecutar = mysqli_query($conexion, $consulta);
                                                while ($fila = mysqli_fetch_array($ejecutar)) { ?>
                                                    <option value="<?php echo $fila["nombre_supervision"]; ?>"><?php echo $fila["unidad"];
                                                                                                                $supeve = $fila["id"] ?></option>";
                                                <?php
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="SUPERVISION" class="form-control" placeholder="Ingresa ID o nombre de la supervisión" id="SUP" list="2" required>
                                        </div>
                                        <br>
                                        <div>
                                            <input type="submit" value="Generar Archivo" name="generar" class="btn">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                if (isset($_POST['generar'])) {
                    // Escapar el valor del formulario para evitar SQL Injection
                    $supervision = mysqli_real_escape_string($conexion, $_POST['SUPERVISION']);

                    // Consulta para verificar si la supervisión existe
                    $consulta = "SELECT id FROM apertura_supervisor WHERE nombre_supervision = '$supervision' or id = '$supervision'";
                    $resultado = mysqli_query($conexion, $consulta);

                    // Verificar si se encontró un registro
                    if (mysqli_num_rows($resultado) > 0) {
                        // Obtener el ID de la supervisión
                        $fila = mysqli_fetch_array($resultado);
                        $supeve = $fila['id'];

                        echo "<script>
                                alert('La supervisión existe. Ahora ingresa los datos  para generar la Cédula.');
                                window.location.href = 'GenerarCedula.php?Sup=$supeve';
                            </script>";
                    } else {
                        // Mostrar mensaje de error
                        echo "<script>alert('La supervisión no existe.');</script>";
                    }
                }
                ?>

        </div>

</center>
</div>
</div>

</section>
</div>
</div>


<?php include("footerAdmin.php"); ?>