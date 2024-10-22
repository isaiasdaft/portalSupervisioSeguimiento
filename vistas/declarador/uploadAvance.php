<?php
include("../../conexion.php");
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 3) {
    header('Location: ../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["fileAvance"]) && $_FILES["fileAvance"]["error"] == 0) {
        $target_dir = "uploadAvances/"; // Change this to the desired directory for uploaded files

        //handle the fileMinuta
        $target_file_avance = $target_dir . basename($_FILES["fileAvance"]["name"]);
        $file_type_avance  = strtolower(pathinfo($target_file_avance, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt", "zip", "rar","pptx"    );

        if (!in_array($file_type_avance, $allowed_types)) {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG, GIF y PDF.";

        } else {    
            if (move_uploaded_file($_FILES["fileAvance"]["tmp_name"], $target_file_avance)) {
                // File upload success, now store information in the database
                $nombre_supervision = $_FILES["fileAvance"]["name"];
                $superSize = $_FILES["fileAvance"]["size"];
                $tipoSupervision = $_FILES["fileAvance"]["type"];
                $uploadSupervision = $target_file_avance;

                
                $id = $_POST['id'];
                $id_avance = $_POST["id_espe"];


                if ($conexion->connect_error) {
                    die("Connection failed: " . $conexion->connect_error);
                }

                  // Verificar si el id_avance existe en la tabla especificaciones_supervisor
                $stmt_verificar = $conexion->prepare("SELECT id FROM especificaciones_supervisor WHERE id = ?");
                $stmt_verificar->bind_param("i", $id_avance);
                $stmt_verificar->execute();
                $stmt_verificar->store_result();

                if ($stmt_verificar->num_rows > 0) {
                    $stmt_verificar->close();

                    // Evitar posibles ataques de inyección SQL usando sentencias preparadas
                    $sql_archivos = $conexion->prepare("INSERT INTO avances (filename, filesize, filetype, upload_date, id_espe, id_usuario) VALUES (?, ?, ?, NOW(), ?, ?)");
                    $sql_archivos->bind_param("sisis", $nombre_supervision, $superSize, $tipoSupervision, $id_avance, $id);

                    if ($sql_archivos->execute()) {
                        echo "<script>alert('El archivo de avance se subió correctamente!')</script>";?>
                        <script type="text/javascript"> window.location.replace("Supervisiones.php");  </script>
                        <?php
                    } else {
                        echo "Error al insertar en la tabla archivos_supervisiones: " . $conexion->error;
                    }

                    // Cierre de la conexión a la base de datos
                    $conexion->close();
                    $sql_archivos->close();
                } else {
                    echo "Error: El id_avance no existe en la tabla especificaciones_supervisor.";
                }
            } else {
                echo "No se ha subido ningún archivo.";
            }
        }
    }
}
?>

