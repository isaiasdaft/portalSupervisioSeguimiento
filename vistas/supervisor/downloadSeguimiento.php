<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filepath = '../declarador/uploadSeguimientos/' . $file; // Reemplaza 'ruta_de_tus_archivos/' 

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo 'El archivo no se encontró en el servidor.';
    }
}
?>
