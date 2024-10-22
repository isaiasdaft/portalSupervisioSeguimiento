<?php
// Conexión a la base de datos
include("../../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibe los datos de la solicitud AJAX
    $id_punto = $_POST["id_punto"];
    $calificacion = $_POST["calificacion"];
    $comentario = $_POST["comentario"];
    $id_sup = $_POST["id_sup"];

    // Realiza la actualización en la base de datos
    $sql = "UPDATE calificacion_supervision SET calificacion = ?, comentario = ? WHERE id_punto = ? AND id_sup = ?";
    
    
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssii", $calificacion, $comentario, $id_punto, $id_sup);
        
        if ($stmt->execute()) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos.";
        }
        
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta.";
    }
} else {
    echo "Solicitud incorrecta.";
}
?>