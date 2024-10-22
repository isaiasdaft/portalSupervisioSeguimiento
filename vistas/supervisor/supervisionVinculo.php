<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 2) {
    header('Location: ../index.php');
    
    exit;
} 
else {
    $idd = $_SESSION['id'];
    $sup = $_GET["id"];
}

$tituloPagina = "Criterios";
?>

<?php include("headerSupervisor.php"); ?>

<Center>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"> Criterios a evaluar</h2>
                <div align="center">
                    <br>
                <table class="table table-striped table-hover" border="2">
                        <thead>
                            <tr>
                                <th bgcolor="#93B8A1" scope="col">
                                <p><center>Procesos Sustantivos</center></p>
                                </th>
                                <th bgcolor="#93B8A1" scope="col">
                                <p><center>Objetivo</center></p>
                                </th>
                                <th bgcolor="#93B8A1" scope="col"><p> Criterios </p></th>
                                

                            </tr>
                        </thead>
                        <?php
                       
                        $consulta = "SELECT puntos_sustantivos.id, titulo, objetivo FROM puntos_sustantivos INNER JOIN departamento ON puntos_sustantivos.departamento = departamento.id
                        INNER JOIN usuario ON departamento.id = usuario.departamento WHERE usuario.id = '$idd'";
                        $ejecutar = mysqli_query($conexion, $consulta);
                        $i = 0;
                        while ($fila = mysqli_fetch_array($ejecutar)) {
                            $Puntos = $fila['titulo'];
                            $obje =$fila['objetivo'];
                            $id = $fila['id'];
                            $Puntos_utf8 = mb_convert_encoding($Puntos, "UTF-8", "auto");
                            $obje_utf8 = mb_convert_encoding($obje, "UTF-8", "auto");
                        ?>
                            <tr align="center">
                                <td><?php echo $Puntos_utf8; ?></td>
                                <td><?php echo $obje_utf8; ?></td>
                                <td><a style="color: #0A9CBF" href="Sinforme.php?id=<?php echo $id; ?>&sup=<?php echo $sup; ?>">
                                <span class="btn btn-info btn-sm"><span class="fa-solid fa-plus" style="color: #1d2425;"></span>Añadir</span></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <center>
                        <p></p>
                    </center>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
      

                    <!-- end .footer -->
                </div>

        </div>
    </div>
</center>




<?php include("footerSupervisor.php"); ?>