<?php
include("../../conexion.php");
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (
        isset($_FILES["fileCedula"]) && $_FILES["fileCedula"]["error"] == 0 &&
        isset($_FILES["fileMinuta"]) && $_FILES["fileMinuta"]["error"] == 0
    ) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files

        //handle the fileCedula 
        $target_file_cedula = $target_dir . basename($_FILES["fileCedula"]["name"]);
        $file_type_cedula = strtolower(pathinfo($target_file_cedula, PATHINFO_EXTENSION));

        //handle the fileMinuta
        $target_file_minuta = $target_dir . basename($_FILES["fileMinuta"]["name"]);
        $file_type_minuta  = strtolower(pathinfo($target_file_minuta, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array(
            "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt", "zip", "rar","pptx"
        );

        if (!in_array($file_type_cedula, $allowed_types) || !in_array($file_type_minuta, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["fileCedula"]["tmp_name"], $target_file_cedula) &&
                move_uploaded_file($_FILES["fileMinuta"]["tmp_name"], $target_file_minuta)) {
                // File upload success, now store information in the database
                $nombreCedula  = $_FILES["fileCedula"]["name"];
                $cedulasize = $_FILES["fileCedula"]["size"];
                $tipoCedula = $_FILES["fileCedula"]["type"];
                $upload_cedula = $target_file_cedula;

                $nombreMinuta = $_FILES["fileMinuta"]["name"];
                $minutaSize = $_FILES["fileMinuta"]["size"];
                $tipoMinuta = $_FILES["fileMinuta"]["type"];
                $upload_minuta = $target_file_minuta;

                //se almacena el valor del nombre 
                $nombreSup = $_POST["nombreSup"];
                $dependencia = $_POST["dependencia"];


                if ($conexion->connect_error) {
                    die("Connection failed: " . $conexion->connect_error);
                }

                // Insert the file information into the database
                $sql = "INSERT INTO archivarfiles (nombreCedula, cedulasize, tipoCedula, upload_cedula, nombreMinuta, minutaSize, tipoMinuta, upload_minuta, nombreSup, dependencia) VALUES
                        ('$nombreCedula', $cedulasize, '$tipoCedula', NOW(), '$nombreMinuta', $minutaSize, '$tipoMinuta', NOW(), '$nombreSup', '$dependencia')";


                if ($conexion->query($sql) === TRUE) {
                    echo "<script>alert('Los archivos se han archivado correctamente!')</script>";?>
                <script type="text/javascript"> window.location.replace("archivarCedula.php");  </script>

                <?php

                } else {
                    echo "<script>alert('Ningun archivo fue subido!')</script>";?>
                    <script type="text/javascript"> window.location.replace("archivarCedula.php");  </script>
                     <?php
                }

                $conexion->close();
            } else {
                echo "<script>alert('Ningun archivo fue subido!')</script>";?>
                 <script type="text/javascript"> window.location.replace("archivarCedula.php");  </script>
              <?php
            }
        }
    } else {
        echo "<script>alert('Ningun archivo fue subido!')</script>";?>
        <script type="text/javascript"> window.location.replace("archivarCedula.php");  </script>
        <?php
    }
}
?>
