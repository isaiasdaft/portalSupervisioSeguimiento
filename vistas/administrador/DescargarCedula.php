<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}

require '../../librerias/phpword/vendor/autoload.php';

$numCamposDinamicos = $_POST['numCamposDinamicos'];
$nombrePlantilla = 'plantillas/plantilla_CEDULA_' . $numCamposDinamicos . '.docx';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($nombrePlantilla);
$numSup = $_GET['Sup'];
$id = $_GET['ID'];

// Variables dinámicas
for ($i = 1; $i <= $numCamposDinamicos; $i++) {
    ${'n' . $i} = $_POST['n' . $i];
    ${'nt' . $i} = $_POST['nt' . $i];
}

for ($i = 1; $i <= $numCamposDinamicos; $i++) {
    $templateProcessor->setValue('n' . $i, ${'n' . $i});
    $templateProcessor->setValue('nt' . $i, ${'nt' . $i});
}

//ejemplo de uno de los tantos puntos que se añaden en el docuemnto
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 1 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob1', $var_fila["comentario"]);
    $templateProcessor->setValue('ca1', $var_fila["calificacion"]);
}
//Punto Numero 2
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 2 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob2', $var_fila["comentario"]);
    $templateProcessor->setValue('ca2', $var_fila["calificacion"]);
}
//Punto Numero 3
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 3 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob3', $var_fila["comentario"]);
    $templateProcessor->setValue('ca3', $var_fila["calificacion"]);
}
//Punto Numero 4
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 4 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob4', $var_fila["comentario"]);
    $templateProcessor->setValue('ca4', $var_fila["calificacion"]);
}
//Punto Numero 5
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 5 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob5', $var_fila["comentario"]);
    $templateProcessor->setValue('ca5', $var_fila["calificacion"]);
}
//Punto Numero 6
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 6 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob6', $var_fila["comentario"]);
    $templateProcessor->setValue('ca6', $var_fila["calificacion"]);
}
//Punto Numero 7
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 7 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob7', $var_fila["comentario"]);
    $templateProcessor->setValue('ca7', $var_fila["calificacion"]);
}
//Punto Numero 8
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 8 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob8', $var_fila["comentario"]);
    $templateProcessor->setValue('ca8', $var_fila["calificacion"]);
}
//Punto Numero 9
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 9 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob9', $var_fila["comentario"]);
    $templateProcessor->setValue('ca9', $var_fila["calificacion"]);
}
//Punto Numero 10
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 10 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob10', $var_fila["comentario"]);
    $templateProcessor->setValue('ca10', $var_fila["calificacion"]);
}
//Punto Numero 11
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 11 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob11', $var_fila["comentario"]);
    $templateProcessor->setValue('ca11', $var_fila["calificacion"]);
}
//Punto Numero 12
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 12 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob12', $var_fila["comentario"]);
    $templateProcessor->setValue('ca12', $var_fila["calificacion"]);
}
//Punto Numero 13
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 13 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob13', $var_fila["comentario"]);
    $templateProcessor->setValue('ca13', $var_fila["calificacion"]);
}
//Punto Numero 14
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 14 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob14', $var_fila["comentario"]);
    $templateProcessor->setValue('ca14', $var_fila["calificacion"]);
}
//Punto Numero 15
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 15 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob15', $var_fila["comentario"]);
    $templateProcessor->setValue('ca15', $var_fila["calificacion"]);
}
//Punto Numero 16
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 16 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob16', $var_fila["comentario"]);
    $templateProcessor->setValue('ca16', $var_fila["calificacion"]);
}
//Punto Numero 17
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 17 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob17', $var_fila["comentario"]);
    $templateProcessor->setValue('ca17', $var_fila["calificacion"]);
}
//Punto Numero 18
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 18 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob18', $var_fila["comentario"]);
    $templateProcessor->setValue('ca18', $var_fila["calificacion"]);
}
//Punto Numero 19
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 19 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob19', $var_fila["comentario"]);
    $templateProcessor->setValue('ca19', $var_fila["calificacion"]);
}
//Punto Numero 20
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 20 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos

    $templateProcessor->setValue('ob20', $var_fila["comentario"]);
    $templateProcessor->setValue('ca20', $var_fila["calificacion"]);
}
//Punto Numero 21
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 21 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob21', $var_fila["comentario"]);
    $templateProcessor->setValue('ca21', $var_fila["calificacion"]);
}
//Punto Numero 22
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 22 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob22', $var_fila["comentario"]);
    $templateProcessor->setValue('ca22', $var_fila["calificacion"]);
}
//Punto Numero 23
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 23 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob23', $var_fila["comentario"]);
    $templateProcessor->setValue('ca23', $var_fila["calificacion"]);
}
//Punto Numero 24
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 24 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob24', $var_fila["comentario"]);
    $templateProcessor->setValue('ca24', $var_fila["calificacion"]);
}
//Punto Numero 25
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 25 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob25', $var_fila["comentario"]);
    $templateProcessor->setValue('ca25', $var_fila["calificacion"]);
}
//Punto Numero 26
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 26 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob26', $var_fila["comentario"]);
    $templateProcessor->setValue('ca26', $var_fila["calificacion"]);
}
//Punto Numero 27
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 27 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob27', $var_fila["comentario"]);
    $templateProcessor->setValue('ca27', $var_fila["calificacion"]);
}
//Punto Numero 28
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 28 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob28', $var_fila["comentario"]);
    $templateProcessor->setValue('ca28', $var_fila["calificacion"]);
}
//Punto Numero 29
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 29 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob29', $var_fila["comentario"]);
    $templateProcessor->setValue('ca29', $var_fila["calificacion"]);
}
//Punto Numero 30
$consulta = "SELECT DISTINCT apertura_supervisor.id, apertura_supervisor.nombre_supervision, 
calificacion_supervision.comentario, calificacion_supervision.calificacion 
FROM calificacion_supervision INNER JOIN apertura_supervisor ON apertura_supervisor.id = calificacion_supervision.id_sup 
INNER JOIN especificaciones_supervisor ON apertura_supervisor.id = especificaciones_supervisor.id_sup 
INNER JOIN puntos_sustantivos ON calificacion_supervision.id_punto = puntos_sustantivos.id 
WHERE puntos_sustantivos.id = 30 AND especificaciones_supervisor.id_sup = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    //Cambiar las variables por datos
    $templateProcessor->setValue('ob30', $var_fila["comentario"]);
    $templateProcessor->setValue('ca30', $var_fila["calificacion"]);
}


//-------------------------------------------Fecha
setlocale(LC_ALL, "es_MX.UTF-8");


$m = date('n');


switch ($m) {

    case 1:

        $mes = "Enero";

        break;
    case 2:

        $mes = "Febrero";

        break;

    case 3:

        $mes = "Marzo";

        break;

    case 4:

        $mes = "Abril";

        break;
    case 5:

        $mes = "Mayo";

        break;

    case 6:

        $mes = "Junio";

        break;
    case 7:

        $mes = "Julio";

        break;

    case 8:

        $mes = "Agosto";

        break;

    case 9:

        $mes = "Septiembre";

        break;

    case 10:

        $mes = "Octubre";

        break;

    case 11:

        $mes = "Noviembre";

        break;

    case 12:

        $mes = "Diciembre";

        break;
}

$dia = date('d');
$anio = date('y');
$fechaf = ("$dia/$mes/$anio");
$templateProcessor->setValue('Fecha', $fechaf);
//-------------------------------------------Unidad
$consulta = "SELECT dependencia.unidad FROM dependencia INNER JOIN apertura_supervisor ON apertura_supervisor.unidad = dependencia.id WHERE apertura_supervisor.id = '$numSup'";
$var_resultado = $conexion->query($consulta);
while ($var_fila = $var_resultado->fetch_array()) {
    $Ndep = $var_fila['unidad'];
}
if ($Ndep = "Organo de operacion administrativa desconcentrada de Aguascalientes") {

    $Ndep = "Órgano de operación administrativa desconcentrada de Aguascalientes";
}
$templateProcessor->setValue('Unidad', $Ndep);

//-------------------------------------------Nombres en las firmas

$consultanom= "SELECT nombre_supervision FROM apertura_supervisor WHERE id='$numSup'";
$var_resultado = $conexion->query($consultanom);
		while ($var_fila=$var_resultado->fetch_array())
    	{
   $nombre = $var_fila["nombre_supervision"];
     	}
	

header('Content-Disposition: attachment; filename="CEDULA_EVALUACION_' . $nombre . '.docx"');
$templateProcessor->saveAs("php://output");
exit;

?>