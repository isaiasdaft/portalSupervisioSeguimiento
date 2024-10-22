<?php

include("../../conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén el id_seguimiento desde la solicitud POST
    $id_seguimiento = $_POST['id_seguimiento'];

    // Realiza la consulta para verificar si ya existe un comentario para el id_seguimiento
    $consulta = "SELECT COUNT(*) AS total FROM comentario_final WHERE id_seguimiento = $id_seguimiento";
    $resultado = $conexion->query($consulta);

    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        $comentarioExiste = ($fila['total'] > 0) ? 'true' : 'false';
        echo $comentarioExiste;
    } else {
        echo 'false'; // En caso de error en la consulta
    }
} else {
    echo 'false'; // Si no es una solicitud POST
}
?>
