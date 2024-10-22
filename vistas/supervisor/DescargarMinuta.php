<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}

require '../../librerias/phpword/vendor/autoload.php';

$numCamposDinamicos = $_POST['numCamposDinamicos'];
$nombrePlantilla = 'plantillas/plantilla_MINUTA_' . $numCamposDinamicos . '.docx';

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

date_default_timezone_set('America/Mexico_City');

$consulta = "SELECT departamento FROM usuario WHERE id = $id";
$ejecutar = mysqli_query($conexion, $consulta);
while ($fila = mysqli_fetch_array($ejecutar)) {
	$dep = $fila['departamento'];
}

$consulta = "SELECT fecha_fin FROM apertura_supervisor WHERE id = $numSup";
$ejecutar = mysqli_query($conexion, $consulta);
while ($fila = mysqli_fetch_array($ejecutar)) {
	$fechaf = $fila['fecha_fin'];
}
setlocale (LC_ALL, "es_MX.UTF-8");


$m = date('n');


switch ($m) {
        case 1 :
        $mes = "Enero";
        break;
	  case 2 :
        $mes = "Febrero";
        break;
        case 3 :
        $mes = "Marzo";
        break;
        case 4 :
        $mes = "Abril";
        break;
	  case 5 :
        $mes = "Mayo";
        break;
        case 6 :
        $mes = "Junio";
        break;
	 case 7 :
        $mes = "Julio";
        break;
      case 8 :
        $mes = "Agosto";
        break;
      case 9 :
        $mes = "Septiembre";
        break;
      case 10 :
        $mes = "Octubre";
        break;
       case 11 :
        $mes = "Noviembre";
        break;
       case 12 :
        $mes = "Diciembre";
        break;
 }
$hora = date('h:i');

//-------------------------------------------Fecha de Fin
$dia = date('d');
$anio = date('y');
$fechaf = ("$dia/$mes/$anio");

$templateProcessor->setValue('Fecha', $fechaf);
//-------------------------------------------Mes
$templateProcessor->setValue('Mes', $mes);
//-------------------------------------------Hora
$templateProcessor->setValue('Hora', $hora);
//-------------------------------------------Primera parte

//-------------------------------------------Unidad
$consulta = "SELECT unidad FROM dependencia WHERE id = '$numSup'";
$var_resultado = $conexion->query($consulta);
while ($var_fila=$var_resultado->fetch_array()) {
	$Ndep = $var_fila['unidad'];
}
if($Ndep = "Organo de operacion administrativa desconcentrada de Aguascalientes"){
	
	$Ndep = "Órgano de operación administrativa desconcentrada de Aguascalientes";
	
}
$templateProcessor->setValue('u1', $Ndep);
//-------------------------------------------Domicilio
$consulta = "SELECT Domicilio FROM usuario
INNER JOIN dependencia ON usuario.dependencia = dependencia.id WHERE dependencia = $dep";
$var_resultado = $conexion->query($consulta);
while ($var_fila=$var_resultado->fetch_array()) {
	$dom = $var_fila['Domicilio'];
}
$templateProcessor->setValue('domicilio', $dom);
//-------------------------------------------Nombre supervision
$consulta = "SELECT nombre_supervision FROM apertura_supervisor WHERE id = $numSup";
$var_resultado = $conexion->query($consulta);
while ($var_fila=$var_resultado->fetch_array()) {
	$NSUP = $var_fila['nombre_supervision'];
}
$templateProcessor->setValue('NombreSup', $NSUP);
//-------------------------------------------Comentario Final
$consulta = "SELECT comentario_final.comentario FROM comentario_final 
INNER JOIN apertura_seguimiento ON comentario_final.id_seguimiento = apertura_seguimiento.id 
INNER JOIN calificacion_supervision ON apertura_seguimiento.id_revision = calificacion_supervision.id 
INNER JOIN apertura_supervisor ON calificacion_supervision.id_sup = apertura_supervisor.id 
WHERE apertura_supervisor.id = '$numSup'; ";
$var_resultado = $conexion->query($consulta);
while ($var_fila=$var_resultado->fetch_array()) {
	$COMFIN = $var_fila['comentario'];
}
$templateProcessor->setValue('ComentarioFinal', $COMFIN);
//-------------------------------------------Nombre y cargos
$nyc = "";
$consulta = "SELECT nombre, cargo FROM usuario WHERE departamento = $dep";
$var_resultado = $conexion->query($consulta);
while ($var_fila=$var_resultado->fetch_array()) {
	$nyc .= $var_fila["nombre"];
	$nyc .= " "; 	
	$nyc .= $var_fila["cargo"];
	$nyc .= " ";
}
$templateProcessor->setValue('NombreCargos', $nyc);
//-------------------------------------------Nombres en las firmas


//Preparando para descargar el documento
$consultanom= "SELECT nombre_supervision FROM apertura_supervisor WHERE id='$numSup'";
$var_resultado = $conexion->query($consultanom);
		while ($var_fila=$var_resultado->fetch_array())
    	{
   $nombre = $var_fila["nombre_supervision"];
     	}
	

header('Content-Disposition: attachment; filename="Minuta_' . $nombre . '.docx"');

//Enviar el output del objeto al explorador para descarga del usuario.
$templateProcessor->saveAs("php://output");


?>