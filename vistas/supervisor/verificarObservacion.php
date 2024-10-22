<?php
// Conexión a la base de datos
include("../../conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recibe los datos de la solicitud AJAX
    $id_avance = $_POST["idAvance"];

    // Realiza la consulta para verificar si ya existe una observación para este avance
    $sql_select = "SELECT COUNT(*) AS num_observaciones FROM observacionesavance WHERE id_avance = ?";
    
    if ($stmt_select = $conexion->prepare($sql_select)) {
        // Vincula los parámetros y ejecuta la sentencia preparada
        $stmt_select->bind_param("i", $id_avance);
        $stmt_select->execute();
        
        // Obtiene el resultado
        $result = $stmt_select->get_result();
        $row = $result->fetch_assoc();

        // Comprueba el número de observaciones para este avance
        $num_observaciones = $row['num_observaciones'];

        // Cierra la declaración preparada
        $stmt_select->close();

        // Devuelve un mensaje indicando si hay observaciones existentes
        if ($num_observaciones > 0) {
            echo 'observacion_existente';
        } else {
            echo 'observacion_no_existente';
        }
    } else {
        echo "Error en la preparación de la consulta de selección.";
    }
} else {
    echo "Solicitud incorrecta.";
}
?>
