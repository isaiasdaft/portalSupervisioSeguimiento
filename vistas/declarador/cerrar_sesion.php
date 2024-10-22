<?php
header("Content-Type: text/html;charset=utf-8");
/* Destruir la sesion */
session_start();
session_destroy();
/* Redirigir */
header('Location: ../../index.php');
?>