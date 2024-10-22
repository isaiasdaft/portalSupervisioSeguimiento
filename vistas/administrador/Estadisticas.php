<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("../../conexion.php");
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../../index.php');
    exit;
} else {
    $idd = $_SESSION['id'];
}
$tituloPagina = "Estadisticas";


$consulta = "SELECT d.unidad AS nombre_dependencia, COUNT(a.dependencia) AS veces_seleccionada FROM aperturas_admin a JOIN dependencia d ON a.dependencia = d.id GROUP BY a.dependencia, d.unidad;  ";
$ejecutar = mysqli_query($conexion, $consulta);
?>

<?php include("headerAdmin.php"); ?>

<Center>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aperturas</title>

		<style type="text/css">
#container {
    height: 500px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 400px;
    max-width: 900px;
    margin: 2em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 200%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.5em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 900;
    padding: 0.8em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.8em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="../../librerias/highCharts/code/highcharts.js"></script>
<script src="../../librerias/highCharts/code/modules/variable-pie.js"></script>
<script src="../../librerias/highCharts/code/modules/exporting.js"></script>
<script src="../../librerias/highCharts/code/modules/export-data.js"></script>
<script src="../../librerias/highCharts/code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
    En esta grafica se puede visualizar las veces que se han iniciado una apertura correspondiente a la unidad médica Esta página brinda una vista para mejorar la visualización sobre los datos registrados durante el periodo que se ha utilizado el sistema. Puedes descargar la gráfica en formato PNG o PDF en tu sistema, para tener un archivo y analizar su contenido a detalle. 
    </p>
    <br>
    <br>
</figure>

		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Aperturas Iniciadas y registradas de cada Unidad Médica.'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
            'Supervisiones creadas: <b>{point.y}</b><br/>' +
            'Seguimientos de cada apertura: <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        data: [
            <?php
                while ($row = mysqli_fetch_array($ejecutar)) { 
                    echo "{name: '".$row["nombre_dependencia"]."', y: ".$row["veces_seleccionada"]."},";
                }
                ?>



        
        
        ]
    }]
});

		</script>
	</body>
</html>


</center>
<?php include("footerAdmin.php"); ?>
