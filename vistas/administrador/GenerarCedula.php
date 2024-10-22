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
$tituloPagina = "Generar Cédula0";
$numSup = $_GET['Sup'];
?>
<?php include("headerAdmin.php"); ?>
<center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">Generar cédula</h2>

                                <form action="DescargarCedula.php?Sup=<?php echo $numSup; ?>&ID=<?php echo $idd; ?>" name="formulario" id="formulario" method="POST">
                                    <div id="campos-dinamicos" class="campos-dinamicos">
                                        <div class="campo">
                                        <input type="text" name="n1" placeholder="Puesto" class="form-control" style="width: 62%;">
                                        <input type="text" name="nt1" placeholder="Nombre del Titular" class="form-control" style="width: 62%;">
                                        <input type="hidden" name="numCamposDinamicos" id="numCamposDinamicos" value="0">
                                        </div>
                                    </div>
                                    <span id="eliminar-campo" class="btn btn-danger btn-md" style="display:none;"><span class="fa-solid fa-trash-can"></span>  Eliminar</span>
                                    <button type="button" id="agregar-campo" class="btn btn-primary">Agregar Titular</button>
                                </form>
                            </div>

                        </div>
                        <br>
                        <button type="submit" id="generar-cedula" class="btn btn-success"> <span class="fa-solid fa-file-circle-plus"></span> Generar Cédula</button>
                    </div>
                </div>
            </section>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
    </div>
    </div>
    </section>
    </div>
    <br>
    <p></p>
</center>
<?php include("footerAdmin.php"); ?>
<style>
    #agregar-campo {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .campo {
        margin-bottom: 12px;
    }   
</style>
<script>
    $(document).ready(function () {
        var maxTitulares = 8;
        var contadorTitulares = 1;
        // Agregar titular
        $("#agregar-campo").click(function () {
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
        $("#eliminar-campo").click(function () {
            if (contadorTitulares > 1) {
                $(`#campos-dinamicos .campo:last-child`).slideUp(function () {
                    $(this).remove();
                });
                contadorTitulares--;
                if (contadorTitulares === 1) {
                    $("#eliminar-campo").hide();
                }
            }
        });
        $("#generar-cedula").click(function () {
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

