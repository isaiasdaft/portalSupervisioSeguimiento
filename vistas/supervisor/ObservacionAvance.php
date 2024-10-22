<?php
// Conexión a la base de datos
include("../../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibe los datos de la solicitud AJAX
    $id_avance = $_POST["id_avance"];  
    $observacion = $_POST["observacion"];

    // Realiza la inserción en la tabla observacionesavance
    $sql_insert = "INSERT INTO observacionesavance (observacion, id_avance, subido) VALUES (?, ?, '1')";

    if ($stmt_insert = $conexion->prepare($sql_insert)) {
        // Vincula los parámetros y ejecuta la sentencia preparada
        $stmt_insert->bind_param("si", $observacion, $id_avance);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            echo "Datos guardados correctamente.";
        } else {
            echo "Error al guardar datos.";
        }

        // Cierra la declaración preparada
        $stmt_insert->close();
    } else {
        echo "Error en la preparación de la consulta de inserción.";
    }
} else {
    echo "Solicitud incorrecta.";
}
?>
