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
    if (isset($_FILES["fileSuperv"]) && $_FILES["fileSuperv"]["error"] == 0) {
        $target_dir = "uploadSupervisiones/"; // Change this to the desired directory for uploaded files

        //handle the fileMinuta
        $target_file_supervision = $target_dir . basename($_FILES["fileSuperv"]["name"]);
        $file_type_supervision  = strtolower(pathinfo($target_file_supervision, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array( "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt", "zip", "rar","pptx" );

        if (!in_array($file_type_supervision, $allowed_types)) {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG, GIF y PDF.";

        } else {    
            if (move_uploaded_file($_FILES["fileSuperv"]["tmp_name"], $target_file_supervision)) {
                // File upload success, now store information in the database
                $nombre_supervision = $_FILES["fileSuperv"]["name"];
                $superSize = $_FILES["fileSuperv"]["size"];
                $tipoSupervision = $_FILES["fileSuperv"]["type"];
                $uploadSupervision = $target_file_supervision;

                //se almacena los valores de id_sup y id_punto tomados de la tabla
                $id = $_POST['id'];
                $id_sup = $_POST["id_sup"];
                $id_punto = $_POST["id_punto"];
                $id_usuario = $idd;    

                if ($conexion->connect_error) {
                    die("Connection failed: " . $conexion->connect_error);
                }
                    $sql_archivos = "INSERT INTO archivos_super
                    (nombre_archivo, tipo_super, tamano_Super, upload_date, id_espe) 
                    VALUES ('$nombre_supervision', '$tipoSupervision', '$superSize', NOW(), $id)";
                

                if ($conexion->query($sql_archivos) === TRUE) {
                    // Insertar en la tabla calificacion_supervision
                    $sql_calificacion = "INSERT INTO calificacion_supervision (id_punto, id_sup, id_usuario, calificacion, comentario) VALUES ($id_punto, $id_sup, $id_usuario, null, null)";
                    
                    if ($conexion->query($sql_calificacion) === TRUE) {
                        // Archivo almacenado con éxito
                        
                             // Agregar la sentencia SQL para actualizar archivo_subido a 1
                        $sql_actualizar_archivo_subido = "UPDATE especificaciones_supervisor SET archivo_subido = 1 WHERE id = $id";
                        if ($conexion->query($sql_actualizar_archivo_subido) === TRUE) {
                          
                            echo "<script>alert('Los archivos se han archivado correctamente.')</script>";
                        
                        }else{
                            echo "Error al actualizar la columna archivo_subido: " . $conexion->error;
        
                        }
                    } else {
                        echo "Error al insertar en la tabla calificacion_supervision: " . $conexion->error;
                    }
                } else {
                    echo "Error al insertar en la tabla archivos_supervisiones: " . $conexion->error;
                }

                // Cierre de la conexión a la base de datos
                $conexion->close();
            } else {
                echo "Lo siento, se produjo un error al cargar el archivo.";
            }
        }
    } else {
        echo "No se ha subido ningún archivo.";
    }
}
?>
