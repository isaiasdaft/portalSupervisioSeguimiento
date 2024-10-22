<?php
include("../../conexion.php");


// Verifica si la conexión a la base de datos fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtiene el ID del registro que se va a verificar (enviado a través de la solicitud AJAX)
$id = $_GET['id'];

// Realiza una consulta SQL para verificar si el archivo ya se ha cargado
$sql = "SELECT * FROM archivos_super WHERE id_espe = $id";

$result = $conexion->query($sql);

// Comprueba si la consulta devolvió resultados
if ($result->num_rows > 0) {
    // Si hay resultados, significa que el archivo ya se ha cargado para este registro
    echo 'cargado';
} else {
    // Si no hay resultados, el archivo no se ha cargado todavía
    echo 'no cargado';
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
