<?php
include("../../conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["fileMinuta"]) && $_FILES["fileMinuta"]["error"] == 0) {
        $target_dir = "uploadsMinutas/"; // Change this to the desired directory for uploaded files

        //handle the fileMinuta
        $target_file_minuta = $target_dir . basename($_FILES["fileMinuta"]["name"]);
        $file_type_minuta  = strtolower(pathinfo($target_file_minuta, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array(
            "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "txt", "zip", "rar","pptx"
        );

        if (!in_array($file_type_minuta, $allowed_types)) {
            echo "Lo sentimos, sólo se permiten archivos JPG, JPEG, PNG, GIF y PDF. docx, txt, zip, rar, pptx";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["fileMinuta"]["tmp_name"], $target_file_minuta)) {
                // File upload success, now store information in the database
                $nombre_minuta = $_FILES["fileMinuta"]["name"];
                $minutasize = $_FILES["fileMinuta"]["size"];
                $tipominuta = $_FILES["fileMinuta"]["type"];
                $upload_minuta = $target_file_minuta;

                  if ($conexion->connect_error) {
                      die("Connection failed: " . $conexion->connect_error);
                  }
                //se almacena el valor del nombre 
                $nombreSup = mysqli_real_escape_string($conexion, $_POST["nombreSup"]);
                var_dump($nombreSup); // Agrega esta línea para depurar
                //tomar el id de la supervision
                $sql = "SELECT id FROM apertura_supervisor WHERE nombre_supervision = '$nombreSup' OR id='$nombreSup'";

                $result = $conexion->query($sql);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $id_sup = $row["id"];
            
                    $sql = "INSERT INTO archivos_minutas (nombre_minuta, minutasize, tipominuta, uploadMinuta, id_sup) VALUES
                    ('$nombre_minuta', $minutasize, '$tipominuta', NOW(), '$id_sup')";

                    if ($conexion->query($sql) === TRUE) {
                        echo "<script>alert('Los archivos se han archivado correctamente!')</script>";?>
                        <script type="text/javascript"> window.location.replace("subirMinuta.php");  </script>
                        <?php
                    } else {
                        $error_message = "Lo sentimos, hubo un error al cargar su archivo y almacenar información en la base de datos.: " . $conn->error;
                    }      
                } else {
                    $error_message = "El archivo no se ha subido. El nombre de la supervisión debe corresponder con uno existente!";
                }
                $conexion->close();
            } else {
                $error_message = "Lo sentimos, hubo un error al cargar su archivo.";
            
            }
        }
    } else {
        $error_message = "ningún archivo fue subido.";
    }
    if (!empty($error_message)) {
        echo "<script>alert('" . addslashes($error_message) . "'); window.location.replace('subirMinuta.php');</script>";
    }
}
?>
