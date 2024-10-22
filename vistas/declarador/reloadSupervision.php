<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");

if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
    $archi = $_GET["id_espe"];

    var_dump($archi);

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["fileSuperv"]) && $_FILES["fileSuperv"]["error"] == 0) {
        $target_dir = "uploadSupervisiones/"; // Change this to the desired directory for uploaded files

        //handle the fileMinuta
        $target_file_supervision = $target_dir . basename($_FILES["fileSuperv"]["name"]);
        $file_type_minuta  = strtolower(pathinfo($target_file_supervision, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array(
            "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt", "zip", "rar"
        );

        if (!in_array($file_type_minuta, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["fileSuperv"]["tmp_name"], $target_file_supervision)) {
                // File upload success, now store information in the database
                $nombre_supervision = $_FILES["fileSuperv"]["name"];
                $superSize = $_FILES["fileSuperv"]["size"];
                $tipoSupervision = $_FILES["fileSuperv"]["type"];
                $uploadSupervision = $target_file_supervision;

                $id = $_POST['id'];

                // Database connection
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "portalsupervision";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
           
                    // Actualizar la información en la base de datos
                $sql = "UPDATE archivos_super SET nombre_archivo = ?, tipo_super = ?, tamaño_Super = ?, upload_date = ? WHERE id = '$archi'";

                // Utilizar consultas preparadas para evitar la inyección de SQL
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdis", $nombre_archivo, $tipo_super, $tamaño_Super, $upload_date, $archi);

                if ($stmt->execute()) {
                    echo "<script>alert('El archivo se actualizó correctamente.');</script>";
                    echo '<script type="text/javascript">window.location.replace("Supervisiones.php");</script>';
                } else {
                    echo "Lo siento, hubo un error al actualizar el archivo: " . $stmt->error;
                }

                $conn->close();
            } else {
                echo "Lo siento, hubo un error al subir el archivo.";
            }
        }
    } else {
        echo "No se subió ningún archivo.";
    }
}
?>
