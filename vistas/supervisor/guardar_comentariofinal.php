<?php
// Conexión a la base de datos
include("../../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibe los datos de la solicitud AJAX
    $id_seguimiento = $_POST["id_seguimiento"];  
    $comentario = $_POST["comentario"];

    // Realiza la inserción en la tabla comentario_final
    $sql_insert = "INSERT INTO comentario_final (comentario, id_seguimiento)
                   VALUES (?, ?)";

    if ($stmt_insert = $conexion->prepare($sql_insert)) {
        $stmt_insert->bind_param("ss", $comentario, $id_seguimiento);

        if ($stmt_insert->execute()) {
            // La inserción fue exitosa, ahora procede con la actualización
            $sql_update = "UPDATE apertura_seguimiento
                           SET estatus = 'Concluida'
                           WHERE id = ?";

            if ($stmt_update = $conexion->prepare($sql_update)) {
                $stmt_update->bind_param("s", $id_seguimiento);

                if ($stmt_update->execute()) {
                    // Ambas consultas fueron exitosas
                    echo "Datos actualizados correctamente.";
                } else {
                    echo "Error al actualizar el estatus en apertura_seguimiento.";
                }

                $stmt_update->close();
            } else {
                echo "Error en la preparación de la consulta de actualización.";
            }
        } else {
            echo "Error al insertar datos en comentario_final.";
        }

        $stmt_insert->close();
    } else {
        echo "Error en la preparación de la consulta de inserción.";
    }
} else {
    echo "Solicitud incorrecta.";
}
?>
