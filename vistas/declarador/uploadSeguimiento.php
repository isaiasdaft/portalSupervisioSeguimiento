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
    if (isset($_FILES["fileSegui"]) && $_FILES["fileSegui"]["error"] == 0) {
        $target_dir = "uploadSeguimientos/"; // Change this to the desired directory for uploaded files

        //handle the fileMinuta
        $target_file_seguimiento = $target_dir . basename($_FILES["fileSegui"]["name"]);
        $file_type_seguimiento  = strtolower(pathinfo($target_file_seguimiento, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array( "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt", "zip", "rar","pptx"   );

        if (!in_array($file_type_seguimiento, $allowed_types)) {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG, GIF y PDF.";

        } else {    
            if (move_uploaded_file($_FILES["fileSegui"]["tmp_name"], $target_file_seguimiento)) {
                // File upload success, now store information in the database
                $nombre_supervision = $_FILES["fileSegui"]["name"];
                $superSize = $_FILES["fileSegui"]["size"];
                $tipoSupervision = $_FILES["fileSegui"]["type"];
                $uploadSupervision = $target_file_seguimiento;

                //se almacena los valores de id_sup y id_punto tomados de la tabla
                $id = $_POST['id'];
                $id_revi = $_POST["id_revision"];

                if ($conexion->connect_error) {
                    die("Connection failed: " . $conexion->connect_error);
                }

                $sql_archivos = "INSERT INTO archivos_seguimiento
                 (nombre_archivo, tamano, tipo, fecha, id_seguimiento) 
                 VALUES ('$nombre_supervision','$superSize','$tipoSupervision', NOW(), $id)";
                

                if ($conexion->query($sql_archivos) === TRUE) {
                    // Agregar la sentencia SQL para actualizar archivo_subido a 1
                   $sql_actualizar_archivo_subido = "UPDATE apertura_seguimiento SET archivo_subido = 1 WHERE id = $id";
                   if ($conexion->query($sql_actualizar_archivo_subido) === TRUE) {
                    echo "<script>alert('Los archivos se han archivado correctamente!')</script>";?>
                    echo "<script>alert('Espera tu evaluación final, en la la sección de calificaciones!')</script>";?>
                    <script type="text/javascript"> window.location.replace("Seguimiento.php");  </script>
                    <?php
                   } else {
                       echo "Error al actualizar la columna archivo_subido: " . $conexion->error;
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