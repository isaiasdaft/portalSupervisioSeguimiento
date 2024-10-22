<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
    $depar = $_SESSION['departamento'];
}
$numSup = $_GET['Sup'];
$tituloPagina = "Descargar Minuta";

$id_sup = $numSup;
$columnaDepartamento = '';  // Ajusta esto según el departamento

switch ($depar) {
    case 1:
        $columnaDepartamento = 'd_capacitaTrans';
        break;
    case 2:
        $columnaDepartamento = 'd_personal';
        break;
    case 3:
        $columnaDepartamento = 'd_relacionesLaborales';
        break;
    case 4:
        $columnaDepartamento = 'd_presupuesto';
        break;
}

$consultaExistencia = "SELECT $columnaDepartamento FROM conteo_supervisores WHERE id_sup = '$id_sup'";
$resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

$supervisorFinalizo = 0;
if ($resultadoExistencia) {
    $filaExistencia = mysqli_fetch_assoc($resultadoExistencia);
    if ($filaExistencia) {
        $supervisorFinalizo = $filaExistencia[$columnaDepartamento];
    }
} else {
    // Manejar el error en caso de que la consulta falle
    $supervisorFinalizo = 0;  // Se asume que el supervisor no ha finalizado en caso de error
}

?>
<script type="text/javascript">
    function ConfirmDelete() {
        var respuesta = confirm("¿Estas seguro de Finalizar esta supervisión?");
        return respuesta;
    }
</script>


<?php include("headerSupervisor.php"); ?>

<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div align="center">
                <table class="table table-active">
                    <thead>
                        <tr>
                            <th bgcolor="#A4CBB3" scope="col">
                                <center>Procesos Sustantivos</center>
                            </th>
                            <th bgcolor="#A4CBB3" scope="col">
                                <center>Comentario Final</center>
                            </th>
                        </tr>
                    </thead>
                    <?php

                    $query = "SELECT DISTINCT puntos_sustantivos.id, puntos_sustantivos.titulo, 
                    comentario_final.comentario FROM puntos_sustantivos INNER JOIN departamento ON 
                    puntos_sustantivos.departamento = departamento.id INNER JOIN usuario ON departamento.id = usuario.departamento 
                    INNER JOIN calificacion_supervision ON puntos_sustantivos.id = calificacion_supervision.id_punto 
                    INNER join apertura_supervisor ON calificacion_supervision.id_sup = apertura_supervisor.id 
                    INNER JOIN apertura_seguimiento ON calificacion_supervision.id = apertura_seguimiento.id_revision 
                    INNER JOIN comentario_final ON apertura_seguimiento.id = comentario_final.id_seguimiento
                     WHERE apertura_supervisor.id = '$numSup' AND usuario.departamento = '$depar';  ";

                    $ex = mysqli_query($conexion, $query);
                    $i = 0;
                    while ($var = mysqli_fetch_array($ex)) {
                        $Titulo = $var['titulo'];
                        $Esp = $var['comentario'];
                        $titulo_utf8 = mb_convert_encoding($Titulo, "UTF-8", "auto");
                    ?>
                        <tr align="center">

                            <td><?php echo $titulo_utf8; ?></td>
                            <td><?php echo $Esp; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header">
                                    <h2>Generar Minuta</h2>
                                    <button type="button" id="agregar-campo" class="btn btn-primary float-right">Agregar Titular</button>
                                </div>
                                <div class="card-body">
                                    <form action="DescargarMinuta.php?Sup=<?php echo $numSup; ?>&ID=<?php echo $idd; ?>" name="formulario" id="formulario" method="POST">
                                        <div id="campos-dinamicos" class="campos-dinamicos">
                                            <div class="campo">
                                                <input type="text" name="n1" placeholder="Puesto" class="form-control" style="width: 62%;">
                                                <input type="text" name="nt1" placeholder="Nombre del Titular" class="form-control" style="width: 62%;">
                                                <input type="hidden" name="numCamposDinamicos" id="numCamposDinamicos" value="0">
                                            </div>
                                        </div>
                                        <span id="eliminar-campo" class="btn btn-danger btn-md" style="display:none;"><span class="fa-solid fa-trash-can"></span> </span>
                                    </form>
                                </div>
                                <div>
                                    <br>
                                    <button type="submit" id="generar-minuta" class="btn btn-success">Descargar Minuta</button>
                                    <p></p>
                                </div>
                                </form>
                                <style>
                                    .mostrar-despues-de-descargar {
                                        display: none;
                                    }
                                </style>
                                <p></p>
                            </div>
                            <br>
                            <br>
                            <br>
                            <center>
                                <form method="post" onsubmit="return ConfirmDelete();">
                                    <?php
                                    if ($supervisorFinalizo == 0) {
                                        echo '<button type="submit" id="finalizar" class="btn btn-secondary" name="finalizar">Finalizar Supervisión</button>';
                                    } else {
                                        echo '<button type="button" class="btn btn-danger" style="display: none;" disabled>Finalizar Supervisión</button>';
                                    }
                                    ?>
                                </form>
                            </center>
                        </div>

                        <br>
                    </div>
            </div>
            </section>
            <?php
            if (isset($_POST['finalizar'])) {
                $id_sup = $numSup;
                $depar = $_SESSION['departamento'];

                switch ($depar) {
                    case 1:
                        // Verificar si ya existe un registro para el id_sup
                        $consultaExistencia = "SELECT COUNT(*) as existe FROM conteo_supervisores WHERE id_sup = '$id_sup' ";
                        $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
                        $filaExistencia = mysqli_fetch_assoc($resultadoExistencia);

                        if ($filaExistencia['existe'] == 0) {
                            // Si no existe, crear el registro por primera vez
                            $consultaCreacion = "INSERT INTO conteo_supervisores (id_sup, d_capacitaTrans, d_personal, d_relacionesLaborales, d_presupuesto, supervisores_finalizados) 
                                     VALUES ('$id_sup', 1, 0, 0, 0, 1)";
                            $ejecutarCreacion = mysqli_query($conexion, $consultaCreacion);
                        } else {
                            // Si ya existe, actualizar el conteo de supervisores finalizados por departamento
                            $columnaDepartamento = "d_capacitaTrans";  // Reemplaza esto según el departamento
                            $consultaConteo = "UPDATE conteo_supervisores SET $columnaDepartamento = 1, supervisores_finalizados = supervisores_finalizados + 1 WHERE id_sup = '$id_sup'";
                            $ejecutarConteo = mysqli_query($conexion, $consultaConteo);
                        }

                        // Verificar si todos los supervisores del departamento han finalizado
                        $consultaVerificacion = "SELECT supervisores_finalizados FROM conteo_supervisores WHERE id_sup = '$id_sup'";
                        $resultadoVerificacion = mysqli_query($conexion, $consultaVerificacion);
                        $filaVerificacion = mysqli_fetch_assoc($resultadoVerificacion);

                        if ($filaVerificacion['supervisores_finalizados'] == 4) {
                            // Si todos los supervisores han finalizado, actualiza el estado en la otra tabla
                            $consultaFinalizacion = "UPDATE apertura_supervisor SET Estatus='Finalizado' WHERE apertura_supervisor.id='$id_sup'";
                            $ejecutarFinalizacion = mysqli_query($conexion, $consultaFinalizacion);

                            if ($ejecutarFinalizacion) {
                                echo "<script>alert('Se ha finalizado la supervisión, todos los supervisores han terminado sus actividades!')</script>";
                                // Redirigir a seguimientoFinal.php solo si la supervisión no está finalizada
                                echo "<script>window.location.replace('$estadoSupervision' != 'Finalizado' ? 'seguimientoFinal.php' : '');</script>";
                            } else {
                                echo "<script>alert('Error al finalizar la supervisión')</script>";
                            }
                        } else {
                            echo "<script>alert('Has finalizado la supervisión por tu parte, espera que los demás supervisores terminen sus actividades!')</script>";
                            echo "<script>window.location.replace('seguimientoFinal.php');</script>";
                        }
                        break;

                        // Puedes agregar más casos según la cantidad de departamentos que tengas en tu sistema
                    case 2:


                        // Verificar si ya existe un registro para el id_sup
                        $consultaExistencia = "SELECT COUNT(*) as existe FROM conteo_supervisores WHERE id_sup = '$id_sup' ";
                        $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
                        $filaExistencia = mysqli_fetch_assoc($resultadoExistencia);

                        if ($filaExistencia['existe'] == 0) {
                            // Si no existe, crear el registro por primera vez
                            $consultaCreacion = "INSERT INTO conteo_supervisores (id_sup, d_capacitaTrans, d_personal, d_relacionesLaborales, d_presupuesto, supervisores_finalizados) 
                                     VALUES ('$id_sup', 0, 1, 0, 0, 1)";
                            $ejecutarCreacion = mysqli_query($conexion, $consultaCreacion);
                        } else {
                            // Si ya existe, actualizar el conteo de supervisores finalizados por departamento
                            $columnaDepartamento = "d_personal";  // Reemplaza esto según el departamento
                            $consultaConteo = "UPDATE conteo_supervisores SET $columnaDepartamento = 1, supervisores_finalizados = supervisores_finalizados + 1 WHERE id_sup = '$id_sup'";
                            $ejecutarConteo = mysqli_query($conexion, $consultaConteo);
                        }

                        // Verificar si todos los supervisores del departamento han finalizado
                        $consultaVerificacion = "SELECT supervisores_finalizados FROM conteo_supervisores WHERE id_sup = '$id_sup'";
                        $resultadoVerificacion = mysqli_query($conexion, $consultaVerificacion);
                        $filaVerificacion = mysqli_fetch_assoc($resultadoVerificacion);

                        if ($filaVerificacion['supervisores_finalizados'] == 4) {
                            // Si todos los supervisores han finalizado, actualiza el estado en la otra tabla
                            $consultaFinalizacion = "UPDATE apertura_supervisor SET Estatus='Finalizado' WHERE apertura_supervisor.id='$id_sup'";
                            $ejecutarFinalizacion = mysqli_query($conexion, $consultaFinalizacion);

                            if ($ejecutarFinalizacion) {
                                echo "<script>alert('Se ha finalizado la supervisión, todos los supervisores han terminado sus actividades!')</script>";
                                // Redirigir a seguimientoFinal.php solo si la supervisión no está finalizada
                                echo "<script>window.location.replace('$estadoSupervision' != 'Finalizado' ? 'seguimientoFinal.php' : '');</script>";
                            } else {
                                echo "<script>alert('Error al finalizar la supervisión')</script>";
                            }
                        } else {
                            echo "<script>alert('Has finalizado la supervisión por tu parte, espera que los demás supervisores terminen sus actividades!')</script>";
                            echo "<script>window.location.replace('seguimientoFinal.php');</script>";
                        }
                        break;

                        // Puedes agregar más casos según la cantidad de departamentos que tengas en tu sistema
                    case 3:
                        // Verificar si ya existe un registro para el id_sup
                        $consultaExistencia = "SELECT COUNT(*) as existe FROM conteo_supervisores WHERE id_sup = '$id_sup' ";
                        $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
                        $filaExistencia = mysqli_fetch_assoc($resultadoExistencia);

                        if ($filaExistencia['existe'] == 0) {
                            // Si no existe, crear el registro por primera vez
                            $consultaCreacion = "INSERT INTO conteo_supervisores (id_sup, d_capacitaTrans, d_personal, d_relacionesLaborales, d_presupuesto, supervisores_finalizados) 
                                     VALUES ('$id_sup', 0, 0, 1, 0, 1)";
                            $ejecutarCreacion = mysqli_query($conexion, $consultaCreacion);
                        } else {
                            // Si ya existe, actualizar el conteo de supervisores finalizados por departamento
                            $columnaDepartamento = "d_relacionesLaborales";  // Reemplaza esto según el departamento
                            $consultaConteo = "UPDATE conteo_supervisores SET $columnaDepartamento = 1, supervisores_finalizados = supervisores_finalizados + 1 WHERE id_sup = '$id_sup'";
                            $ejecutarConteo = mysqli_query($conexion, $consultaConteo);
                        }

                        // Verificar si todos los supervisores del departamento han finalizado
                        $consultaVerificacion = "SELECT supervisores_finalizados FROM conteo_supervisores WHERE id_sup = '$id_sup'";
                        $resultadoVerificacion = mysqli_query($conexion, $consultaVerificacion);
                        $filaVerificacion = mysqli_fetch_assoc($resultadoVerificacion);

                        if ($filaVerificacion['supervisores_finalizados'] == 4) {
                            // Si todos los supervisores han finalizado, actualiza el estado en la otra tabla
                            $consultaFinalizacion = "UPDATE apertura_supervisor SET Estatus='Finalizado' WHERE apertura_supervisor.id='$id_sup'";
                            $ejecutarFinalizacion = mysqli_query($conexion, $consultaFinalizacion);

                            if ($ejecutarFinalizacion) {
                                echo "<script>alert('Se ha finalizado la supervisión, todos los supervisores han terminado sus actividades!')</script>";
                                // Redirigir a seguimientoFinal.php solo si la supervisión no está finalizada
                                echo "<script>window.location.replace('$estadoSupervision' != 'Finalizado' ? 'seguimientoFinal.php' : '');</script>";
                            } else {
                                echo "<script>alert('Error al finalizar la supervisión')</script>";
                            }
                        } else {
                            echo "<script>alert('Has finalizado la supervisión por tu parte, espera que los demás supervisores terminen sus actividades!')</script>";
                            echo "<script>window.location.replace('seguimientoFinal.php');</script>";
                        }
                        break;

                        // Puedes agregar más casos según la cantidad de departamentos que tengas en tu sistema
                    case 4:
                        // Verificar si ya existe un registro para el id_sup
                        $consultaExistencia = "SELECT COUNT(*) as existe FROM conteo_supervisores WHERE id_sup = '$id_sup' ";
                        $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
                        $filaExistencia = mysqli_fetch_assoc($resultadoExistencia);

                        if ($filaExistencia['existe'] == 0) {
                            // Si no existe, crear el registro por primera vez
                            $consultaCreacion = "INSERT INTO conteo_supervisores (id_sup, d_capacitaTrans, d_personal, d_relacionesLaborales, d_presupuesto, supervisores_finalizados) 
                                     VALUES ('$id_sup', 0, 0, 0, 1, 1)";
                            $ejecutarCreacion = mysqli_query($conexion, $consultaCreacion);
                        } else {
                            // Si ya existe, actualizar el conteo de supervisores finalizados por departamento
                            $columnaDepartamento = "d_presupuesto";  // Reemplaza esto según el departamento
                            $consultaConteo = "UPDATE conteo_supervisores SET $columnaDepartamento = 1, supervisores_finalizados = supervisores_finalizados + 1 WHERE id_sup = '$id_sup'";
                            $ejecutarConteo = mysqli_query($conexion, $consultaConteo);
                        }

                        // Verificar si todos los supervisores del departamento han finalizado
                        $consultaVerificacion = "SELECT supervisores_finalizados FROM conteo_supervisores WHERE id_sup = '$id_sup'";
                        $resultadoVerificacion = mysqli_query($conexion, $consultaVerificacion);
                        $filaVerificacion = mysqli_fetch_assoc($resultadoVerificacion);

                        if ($filaVerificacion['supervisores_finalizados'] == 4) {
                            // Si todos los supervisores han finalizado, actualiza el estado en la otra tabla
                            $consultaFinalizacion = "UPDATE apertura_supervisor SET Estatus='Finalizado' WHERE apertura_supervisor.id='$id_sup'";
                            $ejecutarFinalizacion = mysqli_query($conexion, $consultaFinalizacion);

                            if ($ejecutarFinalizacion) {
                                echo "<script>alert('Se ha finalizado la supervisión, todos los supervisores han terminado sus actividades!')</script>";
                                // Redirigir a seguimientoFinal.php solo si la supervisión no está finalizada
                                echo "<script>window.location.replace('$estadoSupervision' != 'Finalizado' ? 'seguimientoFinal.php' : '');</script>";
                            } else {
                                echo "<script>alert('Error al finalizar la supervisión')</script>";
                            }
                        } else {
                            echo "<script>alert('Has finalizado la supervisión por tu parte, espera que los demás supervisores terminen sus actividades!')</script>";
                            echo "<script>window.location.replace('seguimientoFinal.php');</script>";
                        }
                        break;

                    default:
                        echo "<script>alert('Departamento no válido')</script>";
                        break;
                }
            }
            ?>
        </div>

</center>
</div>
</div>
<?php include("footerSupervisor.php"); ?>

<style>
    #agregar-campo {
        background-color: #59719b;
    }

    .campo {
        margin-bottom: 12px;
    }
    #generar-campo:hover {
        background-color: #407e57;
    }

    #generar {
        background-color: #407e57;
    }

    #generar:hover {
        background-color: #2faf5e;
    }

    #finalizar {
        background-color: #615c5d;
    }

    #finalizar:hover {
        background-color: #d30a22;
    }
</style>

<script>
    $(document).ready(function() {
        var maxTitulares = 8;
        var contadorTitulares = 1;
        // Agregar titular
        $("#agregar-campo").click(function() {
            if (contadorTitulares < maxTitulares) {
                contadorTitulares++;
                var nuevoCampo = `
                    <div class="campo" style="display:none;">
                        <input type="text" name="n${contadorTitulares}" placeholder="Puesto" class="form-control" style="width: 62%;">
                        <input type="text" name="nt${contadorTitulares}" placeholder="Nombre del Titular ${contadorTitulares}" class="form-control" style="width: 62%;">
                    </div>
                `;
                $("#campos-dinamicos").append(nuevoCampo);
                $(`#campos-dinamicos .campo:last-child`).slideDown();
                if (contadorTitulares > 1) {
                    $("#eliminar-campo").show();
                }
            }
        });
        $("#eliminar-campo").click(function() {
            if (contadorTitulares > 1) {
                $(`#campos-dinamicos .campo:last-child`).slideUp(function() {
                    $(this).remove();
                });
                contadorTitulares--;
                if (contadorTitulares === 1) {
                    $("#eliminar-campo").hide();
                }
            }
        });
        $("#generar-minuta").click(function() {
            if (!validarCamposDinamicos()) {
                alert("Por favor, complete todos los campos antes de generar la cédula.");
                return false; // Evita que el formulario se envíe si la validación falla
            }
            $("#numCamposDinamicos").val(contadorTitulares);
            $("#formulario").submit();
        });

        function validarCamposDinamicos() {
            var camposDinamicos = $(`#campos-dinamicos .campo input`);
            for (var i = 0; i < camposDinamicos.length; i++) {
                if ($(camposDinamicos[i]).val() === "") {
                    return false; // Si al menos un campo está vacío, devuelve falso
                }
            }
            return true; // Todos los campos están completos
        }
    });
</script>