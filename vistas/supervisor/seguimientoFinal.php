<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
$numsup = "";
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Seguimiento";


if (isset($_POST['B'])) {
    // Obtener los valores de los campos de entrada
    $nombreSupervision = $_POST['nombre_supervision'];
    $nombreTitulo = $_POST['titulo'];

    // Realizar una consulta a la base de datos para obtener los resultados
    $consulta = "SELECT DISTINCT apertura_seguimiento.id, apertura_seguimiento.id_revision, 
    apertura_seguimiento.fecha_inicio, apertura_seguimiento.fecha_fin, apertura_supervisor.nombre_supervision,
     puntos_sustantivos.titulo, archivos_seguimiento.nombre_archivo FROM apertura_seguimiento 
     INNER JOIN archivos_seguimiento ON apertura_seguimiento.id = archivos_seguimiento.id_seguimiento 
     INNER JOIN calificacion_supervision ON calificacion_supervision.id = apertura_seguimiento.id_revision 
     INNER JOIN apertura_supervisor ON calificacion_supervision.id_sup = apertura_supervisor.id 
     INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
     WHERE (apertura_supervisor.nombre_supervision = '$nombreSupervision ' OR apertura_supervisor.id = '$nombreSupervision') 
     AND (puntos_sustantivos.titulo ='$nombreTitulo' OR puntos_sustantivos.id = '$nombreTitulo')";

    $resultados = mysqli_query($conexion, $consulta);
}
?>
<script>
    document.getElementById('S').addEventListener('change', function() {
        var selectedValue = this.value;

        var id = obtenerIdParaValor(selectedValue);
        document.getElementById('IdSUP').value = id;
    });
</script>

<?php include("headerSupervisor.php"); ?>

<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Seguimiento Final: </h1>
            <div class="modal fade" id="comentarioModal" tabindex="-1" role="dialog" aria-labelledby="comentarioModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="comentarioModalLabel">Añadir Comentario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="ComentarioFinalForm">
                            <div class="form-group">
                                        
                                <input type="hidden" name="id_seguimiento" value="<?php echo $fila['id']; ?>">
                                <label for="comentario">Comentario:</label>
                                <textarea name="comentario" class="form-control" rows="4" id="comentario" required></textarea>
                                <br>
                            </div>
                            </form>
                        </div>
                        <div id="modalAlert" class="alert" role="alert" style="display: none;"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="modalGuardar">Guardar</button>
                            </div>
                    </div>
                </div>
            </div>
            <center>
                <form name="formulario" id="f" method="POST" onsubmit="return validarFormulario()">
                    <div>
                        <div class="row mb-12">
                            <label for="NomSUP" class="col-sm-12 col-form-label">Nombre de supervisión:</label>
                        </div>
                        <div class="col-sm-8">
                            <input placeholder="Ingresa el nombre o ID de la supervisión" name="nombre_supervision" id="NomSUP" class="form-control" required>
                        </div>
                        <div class="row mb-12">
                            <label for="NomTIT" class="col-sm-12 col-form-label">Nombre del punto sustantivo:</label>
                        </div>
                        <div class="col-sm-8">
                            <input placeholder="Ingresa el ID o  el nombre del punto sustantivo" name="titulo" list="depencia" id="NomTIT" class="form-control" required>
                        </div>
                        <br>
                        <br>
                        <center>
                            <?php if (isset($resultados) && mysqli_num_rows($resultados) > 0) { ?>
                                <table class="table table-striped table-light" id="tablaseguimineto">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#A4CBB3" scope="col">ID</th>
                                            <th bgcolor="#A4CBB3" scope="col">Fecha Inicio</th>
                                            <th bgcolor="#A4CBB3" scope="col">fecha Fin</th>
                                            <th bgcolor="#A4CBB3" scope="col">Nombre</th>
                                            <th bgcolor="#A4CBB3" scope="col">Proceso Sustantivo</th>
                                            <th bgcolor="#A4CBB3" scope="col">Archivo</th>
                                            <th bgcolor="#A4CBB3" scope="col">Descargar</th>
                                            <th bgcolor="#A4CBB3" scope="col">Comentario Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($fila = mysqli_fetch_array($resultados)) { ?>
                                            <tr>
                                                <td><?php echo $fila['id']; ?></td>
                                                <td><?php echo $fila['fecha_inicio']; ?></td>
                                                <td><?php echo $fila['fecha_fin']; ?></td>
                                                <td><?php echo $fila['nombre_supervision']; ?></td>
                                                <td><?php echo $fila['titulo']; ?></td>
                                                <td><?php echo $fila['nombre_archivo']; ?></td>
                                                <td>
                                                    <a href="downloadSeguimiento.php?file=<?php echo $fila['nombre_archivo']; ?>">
                                                        <center></center>
                                                        <span class="btn btn-info btn-sm"><span class="fa-solid fa-download" style="color: #274040;"></span> Descargar</span>
                                                    </a>
                                                </td>
                                                <td class="comentario">
                                                    <center>
                                                    <a href="#" class="comentario-btn" data-id="<?php echo $fila['id']; ?>" data-toggle="modal" data-target="#comentarioModal">
                                                        <center><span class="btn btn-info btn-md"><span class="fa-solid fa-comment-medical" style="color: #ffffff;"></span></span></center>
                                                    </a>
                                              
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p>No se encontraron resultados. </p>
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
                <br>
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Descargar Minuta</h2>
                                    <center>
                                        <form name="formulario" id="formulario" method="POST">
                                            <div class="row mb-12">
                                                <label for="S" class="col-md-12 col-form-label">Nombre de la Supervisión:</label>
                                                <datalist id="op3">
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
                                            <div class="col-sm-8">
                                                <input placeholder="Ingresa el Nombre o ID supervisión" list="op3" name="IdSUP" id="S" class="form-control" required>
                                            </div>
                                            <br>
                                            <div>
                                                 <input type="submit" value="Generar Archivo" name="generar" class="btn">
                                            </div>
                                            <input type="hidden" name="generar" id="IdSUP" value="">
                                            <script>
                                                document.getElementById('S').addEventListener('change', function() {
                                                    var selectedValue = this.value;
                                                  
                                                    var id = obtenerIdParaValor(selectedValue); 
                                                    document.getElementById('IdSUP').value = id;
                                                });
                                            </script>
                                            
                                        </form>

                                        <?php
                                            if (isset($_POST['generar'])) {
                                                $numsup  = mysqli_real_escape_string($conexion, $_POST['IdSUP']);

                                                $consulta = "SELECT id FROM apertura_supervisor WHERE nombre_supervision = '$numsup' or id = '$numsup'";
                                                $resultado = mysqli_query($conexion, $consulta);

                                                // Verificar si se encontró un registro
                                                if (mysqli_num_rows($resultado) > 0) {
                                                    // Obtener el ID de la supervisión
                                                    $fila = mysqli_fetch_array($resultado);
                                                    $supeve = $fila['id'];

                                                    echo "<script>
                                                            alert('La supervisión existe. Ahora ingresa los datos  para generar la Minuta.');
                                                            window.location.href = 'DetallesMinuta.php?Sup=$supeve';
                                                        </script>";
                                                } else {
                                                    // Mostrar mensaje de error
                                                    echo "<script>alert('La supervisión no existe.');</script>";
                                                }
                                            }
                                            ?>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </center>
            <br>
            <script>
                function validarFormulario() {
                    var nombreSupervision = document.getElementById('NomSUP').value;
                    var nombreTitulo = document.getElementById('NomTIT').value;

                    if (nombreSupervision === '' && nombreTitulo === '') {
                        alert('Debes ingresar al menos un campo (Nombre de supervisión o Nombre del punto sustantivo).');
                        return false;
                    }
                }
            </script>
        </div>
    </div>
</center>

<?php include("footerSupervisor.php"); ?>
<script type="text/javascript">
     $(document).ready(function() {
        function comentarioExistente(id_seguimiento) {
        var comentarioExiste = false;

        $.ajax({
            type: 'POST',
            url: 'verificar_comentario.php', 
            async: false, 
            data: {
                id_seguimiento: id_seguimiento
            },
            success: function(response) {
                // La respuesta debe ser un valor booleano, true si ya existe un comentario, false de lo contrario
                comentarioExiste = response === 'true';
            },
            error: function() {
                alert("Error al verificar el comentario existente");
            }
        });

        return comentarioExiste;
    }

         // Cuando se hace clic en el botón "Guardar" dentro de la ventana modal
         $('.comentario-btn').click(function() {
            var id_seguimiento = $(this).data('id');
            console.log("ID de Seguimiento al abrir el modal: " + id_seguimiento);
            // Asignar los valores a los elementos del modal
            $('#comentarioModal').data('id', id_seguimiento);

                    // Verifica si ya hay un comentario para este registro
                if (!comentarioExistente(id_seguimiento)) {
                    // Asigna los valores a los elementos del modal
                    $('#comentarioModal').data('id', id_seguimiento);
                } else {
                    // Oculta el botón de comentario si ya hay un comentario
                    alert('Ya se ha agregado un comentario a este registro.');
                    return false;
                }
        });
        $('#modalGuardar').click(function() {
            var id_seguimiento = $('#comentarioModal').data('id');
            var comentario = $('#comentario').val();

            if (comentario !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'guardar_comentariofinal.php',
                    data: {
                        id_seguimiento: id_seguimiento,
                        comentario: comentario
                    },
                    success: function(response) {
                        $('#modalAlert').removeClass('alert-danger').addClass('alert-success').text('Comentario final asignado correctamente!.');
                        $('#modalAlert').show();
                        // Actualiza la tabla si es necesario
                        actualizarTabla(id_seguimiento, comentario);
                        setTimeout(function() {
                            $('#comentarioModal').modal('hide');
                        }, 1000);
                    },
                    error: function() {
                        alert("Error al asignar calificación y comentario");
                    }
                });
            } else {
                alert("Por favor, ingresa calificación y comentario antes de guardar.");
            }
        });

        function actualizarTabla(id_seguimiento, comentario) {
            var fila = $('#tablaseguimineto').find('tr[data-id="' + id_seguimiento + '"]');
            fila.find('td.comentario').html(comentario);
        }
     });
</script>