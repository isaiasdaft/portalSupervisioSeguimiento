<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}

if (isset($_POST['B'])) {
    // Obtener los valores de los campos de entrada
    $nombreSupervision = $_POST['nombre_supervision'];


    // Realizar una consulta a la base de datos para obtener los resultados
    $consulta = "SELECT calificacion_supervision.id, apertura_supervisor.nombre_supervision, 
    puntos_sustantivos.titulo, calificacion_supervision.calificacion, 
    calificacion_supervision.comentario FROM calificacion_supervision 
    INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
    INNER JOIN puntos_sustantivos ON puntos_sustantivos.id = calificacion_supervision.id_punto 
    INNER JOIN usuario ON usuario.id = calificacion_supervision.id_usuario
     WHERE (nombre_supervision = '$nombreSupervision' OR apertura_supervisor.id = '$nombreSupervision')
      AND (id_usuario='$idd');  ";


    $resultados = mysqli_query($conexion, $consulta);
}

if (isset($_POST['B2'])) {
    // Obtener los valores de los campos de entrada
    $nombreSupervision = $_POST['nombre_supervision'];
    $titulo = $_POST['titulo'];


    $consulta2 = "SELECT apertura_seguimiento.id, apertura_supervisor.nombre_supervision, 
    puntos_sustantivos.titulo, comentario_final.comentario FROM apertura_seguimiento 
    INNER JOIN calificacion_supervision ON apertura_seguimiento.id_revision = calificacion_supervision.id
     INNER JOIN apertura_supervisor ON calificacion_supervision.id_sup = apertura_supervisor.id 
     INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
     INNER JOIN comentario_final ON apertura_seguimiento.id = comentario_final.id_seguimiento 
     WHERE (apertura_supervisor.nombre_supervision = '$nombreSupervision' OR apertura_supervisor.id = '$nombreSupervision') 
     AND (puntos_sustantivos.titulo = '$titulo') AND (id_usuario='$idd');  ";


    $resultados2 = mysqli_query($conexion, $consulta2);
}

$tituloPagina = "Calificaciones ";

?>

<style>
       .jumbotron {
              background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
           
            height: 100vh;
        }
</style>


<?php include("headerDeclarador.php"); ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="calificaciones-tab" data-toggle="tab" href="#calificaciones"> Supervisiones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones"> Seguimientos</a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Calificaciones Tab -->
            <div class="tab-pane fade show active" id="calificaciones">
                <div class="welcome">
                    <center>
                        <h1>Calificaciones de Supervisiones: </h1>

                        <form name="formulario" id="f" method="POST" onsubmit="return validarFormulario()">
                            <div>
                                <div class="row mb-12">
                                    <label for="NomSUP" class="col-sm-12 col-form-label">Nombre de supervisión:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input placeholder="Ingresa el nombre o ID de la supervisión" name="nombre_supervision" id="NomSUP" class="form-control" required>
                                </div>
                                <br>
                                <br>
                                <center>
                                    <?php if (isset($resultados) && mysqli_num_rows($resultados) > 0) { ?>
                                        <table class="table table-striped table-light">
                                            <thead>
                                                <tr>
                                                    <th bgcolor="#A4CBB3" scope="col">ID</th>
                                                    <th bgcolor="#A4CBB3" scope="col">Nombre de Supervisión</th>
                                                    <th bgcolor="#A4CBB3" scope="col">Título</th>
                                                    <th bgcolor="#A4CBB3" scope="col">Calificación</th>
                                                    <th bgcolor="#A4CBB3" scope="col">comentario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($fila = mysqli_fetch_array($resultados)) { ?>
                                                    <tr>
                                                        <td><?php echo $fila['id']; ?></td>
                                                        <td><?php echo $fila['nombre_supervision']; ?></td>
                                                        <td><?php echo $fila['titulo']; ?></td>
                                                        <td><?php echo $fila['calificacion']; ?></td>
                                                        <td><?php echo $fila['comentario']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>No se encontraron resultados.</p>
                                    <?php } ?>


                                </center>
                            </div>
                            <p></p>

                            <center>
                                <p>
                                    <button type="submit" value="Buscar" name="B" class="btn btn-outline-info btn-lg">Buscar</button>
                                </p>
                            </center>
                        </form>
                </div>
            </div>
            <div class="tab-pane fade" id="observaciones">
                <div class="welcome">
                    <center>
                        <h1>Observación Final: </h1>
                        <form name="formulario2" id="f2" method="POST" onsubmit="return validarFormulario()">
                            <div>
                                <div class="row mb-12">
                                    <label for="NomSUP" class="col-sm-12 col-form-label">Nombre de supervisión:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input placeholder="Ingresa el nombre o ID de la supervisión" name="nombre_supervision" id="NomSUP" class="form-control" required>
                                </div>
                                <div class="row mb-12">
                                    <label for="NomPUN" class="col-sm-12 col-form-label">Punto sustantivo:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select placeholder="Ingresa el nombre o ID del punto sustantivo"  name="titulo" id="NomPUN" class="form-control mt-2" required>
                                    <option>Selecciona un punto sustantivo </option>
                                        <option value="Aplicacion de las Politicas, Normatividad y Lineamientos vigentes en materia administracion de los servicios personales">Aplicación de las Politicas, Normatividad y Lineamientos vigentes en materia administracion de los servicios personales</option>
                                        <option value="Asistencia, Puntualidad y Sustituciones">Asistencia, Puntualidad y Sustituciones</option>
                                        <option value="Actualizacion de la Plantilla Nominal">Actualización de la Plantilla Nominal</option>
                                        <option value="Analisis del Balance de Plazas">Análisis del Balance de Plazas</option>
                                        <option value="Actualizacion a las incidencias de A.P.S">Actualización a las incidencias de A.P.S</option>
                                        <option value="Registro de Firmas de Funcionarios">Registro de Firmas de Funcionarios</option>
                                        <option value="Reporte a la Subcomision Mixta Disciplinaria por omision de registro de salida, firma de la tarjeta de asistencia el primer dia habil de la quincena y marcas alteradas">Reporte a la Subcomisión Mixta Disciplinaria por omisión de registro de salida, firma de la tarjeta de asistencia el primer día hábil de la quincena y marcas alteradas </option>
                                        <option value="Control de 4ta. Falta">Control de 4ta. Falta</option>
                                        <option value="Constancia de autorizacion de Pase de Entrada o Salida">Constancia de autorizacion de Pase de Entrada o Salida</option>
                                        <option value="Autorizacion de licencias con y sin sueldo">Autorización de licencias con y sin sueldo</option>
                                        <option value="Certificados de Incapacidad">Certificados de Incapacidad</option>
                                        <option value="Programacion de Vacaciones fuera de Calendario ">Programación de Vacaciones fuera de Calendario </option>
                                        <option value="Horarios y Turnos">Horarios y Turnos</option>
                                        <option value="Tramite de Gafete de Identificacion, por nuevo ingreso, perdida o deterioro">Tramite de Gafete de Identificación, por nuevo ingreso, perdida o deterioro</option>
                                        <option value="Salarios no Cobrados y/o cancelados">Salarios no Cobrados y/o cancelados</option>
                                        <option value="Actualizacion de comunicados SIAP, enviados a traves del Departamento Delegacional de Personal">Actualizacion de comunicados SIAP, enviados a traves del Departamento Delegacional de Personal</option>
                                        <option value="Critica de nomina quincenal">Critica de nómina quincenal</option>
                                        <option value="Pago e incorporacion por Acreditamiento en Cuenta de Inversion">Pago e incorporación por Acreditamiento en Cuenta de Inversión</option>
                                        <option value="Certificaciones de Vigencia Laboral y Capacidad de Crédito. UMF #8">Certificaciones de Vigencia Laboral y Capacidad de Crédito. UMF #8</option>
                                        <option value="Asignación del Marco Presupuestal de los conceptos 08 sustituto y extraordinarios 10 Nivelación a Plaza Superior, 35 Guardias y 37 Tiempo Extraordinario.">Asignación del Marco Presupuestal de los conceptos 08 sustituto y extraordinarios 10 Nivelación a Plaza Superior, 35 Guardias y 37 Tiempo Extraordinario.</option>
                                        <option value="Asignación del Marco Presupuestal de los conceptos extraordinarios (08 sustitución, 10 Nivelación a Plaza Superior, 35 Guardias y 37 Tiempo Extraordinario)">Asignación del Marco Presupuestal de los conceptos extraordinarios (08 sustitución, 10 Nivelación a Plaza Superior, 35 Guardias y 37 Tiempo Extraordinario)</option>
                                        <option value="Disminución del Ausentismo no Programado.">Disminución del Ausentismo no Programado.</option>
                                        <option value="Programación Anual de Vacaciones.">Programación Anual de Vacaciones.</option>
                                        <option value="Personal sustituto adscrito a la Unidad">Personal sustituto adscrito a la Unidad</option>
                                        <option value="Reuniones Bilaterales">Reuniones Bilaterales</option>
                                        <option value="Sustitución de Trabajador a Trabajador">Sustitución de Trabajador a Trabajador</option>
                                        <option value="Ropa de Trabajo y Uniformes">Ropa de Trabajo y Uniformes</option>
                                        <option value="Comité Local Mixto de Capacitación y Adiestramiento">Comité Local Mixto de Capacitación y Adiestramiento</option>
                                        <option value="Recorrido de verificación de la Comisión Delegacional a la Comisión Local Mixta de Seguridad e Higiene">Recorrido de verificación de la Comisión Delegacional a la Comisión Local Mixta de Seguridad e Higiene/option>
                                        <option value="Estructuras y/o Plantillas autorizadas">Estructuras y/o Plantillas autorizadas</option>
                                    </select>
                                </div>
                                <br>
                                <br>
                                <center>
                                    <?php if (isset($resultados2) && mysqli_num_rows($resultados2) > 0) { ?>
                                        <table class="table table-striped table-light">
                                            <thead>
                                                <tr>
                                                    <th bgcolor="#A4CBB3" scope="col">ID</th>
                                                    <th bgcolor="#A4CBB3" scope="col">Nombre seguimiento</th>
                                                    <th bgcolor="#A4CBB3" scope="col">Título</th>
                                                    <th bgcolor="#A4CBB3" scope="col">comentario Final</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($fila = mysqli_fetch_array($resultados2)) { ?>
                                                    <tr>
                                                        <td><?php echo $fila['id']; ?></td>
                                                        <td><?php echo $fila['nombre_supervision']; ?></td>
                                                        <td><?php echo $fila['titulo']; ?></td>
                                                        <td><?php echo $fila['comentario']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>No se encontraron resultados.</p>
                                    <?php } ?>
                                </center>
                            </div>
                            <p></p>

                            <center>
                                <p>
                                    <button type="submit" value="Buscar2" name="B2" class="btn btn-outline-info btn-lg">Buscar</button>
                                </p>
                            </center>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

</div>
<?php include("footerDeclarador.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaCali').load("gestorCalificaciones.php");
        $('#tablaObserva').load("gestorComentarioFinal.php");
    });

    $('#myTabs a').on('click', function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>