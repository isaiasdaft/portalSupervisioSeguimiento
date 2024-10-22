-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2024 a las 18:03:58
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portalsupervision`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aperturas_admin`
--

CREATE TABLE `aperturas_admin` (
  `id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `dependencia` int(11) DEFAULT NULL,
  `nombre_supervision` varchar(250) DEFAULT NULL,
  `estatus` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aperturas_admin`
--

INSERT INTO `aperturas_admin` (`id`, `fecha_inicio`, `fecha_fin`, `dependencia`, `nombre_supervision`, `estatus`, `tipo`) VALUES
(1, '2024-01-09', '2024-01-12', 1, 'ejemploOOAD', 'Revision', 'Supervision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apertura_punto`
--

CREATE TABLE `apertura_punto` (
  `id_sup` int(11) NOT NULL,
  `id_punto` int(11) NOT NULL,
  `especificacion` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apertura_seguimiento`
--

CREATE TABLE `apertura_seguimiento` (
  `id` int(11) NOT NULL,
  `id_revision` int(11) DEFAULT NULL,
  `fecha_inicio` text DEFAULT NULL,
  `fecha_fin` text DEFAULT NULL,
  `archivo_subido` tinyint(4) DEFAULT 0,
  `estatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apertura_supervisor`
--

CREATE TABLE `apertura_supervisor` (
  `id` int(11) NOT NULL,
  `nombre_supervision` varchar(250) DEFAULT NULL,
  `unidad` int(11) DEFAULT NULL,
  `declarador` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `Estatus` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apertura_supervisor`
--

INSERT INTO `apertura_supervisor` (`id`, `nombre_supervision`, `unidad`, `declarador`, `fecha_inicio`, `fecha_fin`, `tipo`, `Estatus`) VALUES
(104, 'ejemploOOAD', 1, 11, '2024-01-09', '2024-01-12', 'supervision', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivarfiles`
--

CREATE TABLE `archivarfiles` (
  `id` int(11) NOT NULL,
  `nombreCedula` varchar(200) NOT NULL,
  `cedulasize` int(11) NOT NULL,
  `tipoCedula` varchar(200) NOT NULL,
  `upload_cedula` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombreMinuta` varchar(200) NOT NULL,
  `minutaSize` int(11) NOT NULL,
  `tipoMinuta` varchar(200) NOT NULL,
  `upload_minuta` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombreSup` varchar(200) DEFAULT NULL,
  `dependencia` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_cedula`
--

CREATE TABLE `archivos_cedula` (
  `id` int(11) NOT NULL,
  `nombre_cedula` varchar(250) DEFAULT NULL,
  `ruta_cedula` varchar(250) DEFAULT NULL,
  `nombre_minuta` varchar(250) DEFAULT NULL,
  `ruta_minuta` varchar(250) DEFAULT NULL,
  `id_sup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_minutas`
--

CREATE TABLE `archivos_minutas` (
  `id` int(11) NOT NULL,
  `nombre_minuta` varchar(250) NOT NULL,
  `minutasize` int(11) NOT NULL,
  `tipominuta` varchar(200) NOT NULL,
  `uploadMinuta` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_sup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_revision`
--

CREATE TABLE `archivos_revision` (
  `id` int(11) NOT NULL,
  `id_punto` int(11) DEFAULT NULL,
  `id_sup` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_seguimiento`
--

CREATE TABLE `archivos_seguimiento` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(200) NOT NULL,
  `tamaño` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_seguimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_super`
--

CREATE TABLE `archivos_super` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(200) NOT NULL,
  `tipo_super` varchar(150) DEFAULT NULL,
  `tamaño_Super` int(11) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_espe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

CREATE TABLE `avances` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_espe` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_supervision`
--

CREATE TABLE `calificacion_supervision` (
  `id` int(11) NOT NULL,
  `id_punto` int(11) DEFAULT NULL,
  `id_sup` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL CHECK (`calificacion` >= 1 and `calificacion` <= 3),
  `comentario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_final`
--

CREATE TABLE `comentario_final` (
  `id` int(11) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `id_seguimiento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conteo_supervisores`
--

CREATE TABLE `conteo_supervisores` (
  `id` int(11) NOT NULL,
  `id_sup` int(11) DEFAULT NULL,
  `d_capacitaTrans` int(11) DEFAULT 0,
  `d_personal` int(11) DEFAULT 0,
  `d_relacionesLaborales` int(11) DEFAULT 0,
  `d_presupuesto` int(11) DEFAULT 0,
  `supervisores_finalizados` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
(1, 'Departamento de Capacitación y Transparencia\r\n'),
(2, 'DEPARTAMENTO DE PERSONAL\r\n'),
(3, 'DEPARTAMENTO DE RELACIONES LABORALES\r\n'),
(4, 'DEPARTAMENTO DE PRESUPUESTO Y CONTROL DEL GASTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `id` int(11) NOT NULL,
  `unidad` varchar(250) DEFAULT NULL,
  `Domicilio` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `unidad`, `Domicilio`) VALUES
(1, 'Organo de operacion administrativa desconcentrada de Aguascalientes', 'AV. ALAMEDA,DEL TRABAJO,AGUASCALIENTES AGS.,C.P 20180\r\n\r\n'),
(2, 'Hospital General #1', 'BLVD. JOSÉ MA. CHÁVEZ NO. 1202,COL. LINDAVISTA,AGUASCALIENTES AGS.,C.P 20270\r\n\r\n'),
(3, 'Hospital General #2', 'AV. DE LOS CONOS NO. 102,FRACC. OJOCALIENTE,AGUASCALIENTES AGS.,C.P 20190\r\n'),
(4, 'Hospital General #3', 'AV. GENERAL PROLONGATION IGNACIO ZARAGOZA 90,COL. EJIDO DE JESUS ​​MARIA,20908\r\n'),
(5, 'Unidad Medica Familiar #1', 'BLVD. JOSÉ MA. CHÁVEZ NO. 1202,COL. LINDAVISTA,20270'),
(6, 'Unidad Medica Familiar #2', 'INSURGENTES NO. 126,COL.CENTRO,RINCÓN DE ROMOS AGS.,C.P.20400\r\n'),
(7, 'Unidad Medica Familiar #3', 'AV. REVOLUCIÓN ESQ. HEROICO COLEGIO MILITAR S/N,PABELLÓN DE ARTEAGA, AGS.,C.P 20600\r\n'),
(8, 'Unidad Medica Familiar #4', 'BLVD. RODOLFO LANDEROS NO. 320,FRACC.BUGAMBILIAS,CALVILLO AGS.,C.P 20800\r\n'),
(9, 'Unidad Medica Familiar #5', 'NICOLÁS BRAVO NO. 1,FRACC. INFONAVIT,ASIENTOS AGS.,C.P 20712\r\n'),
(10, 'Unidad Medica Familiar #6', 'BLVD. MIGUEL DE LA MADRID NO. 703,COL. AGUA CLARA,JESÚS MARIA AGS. ,C.P 20900\r\n'),
(11, 'Unidad Medica Familiar #7', 'AV. AGUASCALIENTES NO. 603,COL. SAN MARCOS,AGUASCALIENTES AGS.,C.P 20070    \r\n'),
(12, 'Unidad Medica Familiar #8', 'ALAMEDA  NO. 702,COL. DEL TRABAJO,AGUASCALIENTES AGS.,C.P 20180\r\n'),
(13, 'Unidad Medica Familiar #9', 'BLVD. SIGLO XXI,ESQ. CALLE PROSPERIDAD,FRACC. OJOCALIENTE IV,AGUASCALIENTES AGS.,C.P 20197\r\n'),
(14, 'Unidad Medica Familiar #10', 'AV. DE LA CONVENCIÓN NORTE ESQUINA PETRÓLEOS MEXICANOS,COL. INDUSTRIAL,AGUASCALIENTES AGS.,	C.P20030\r\n'),
(15, 'Unidad Medica Familiar #11', 'AV. MARIANO HIDALGO NO. 510,CD. SATÉLITE MORELOS,AGUASCALIENTES AGS.,C.P 20995\r\n'),
(16, 'Unidad Medica Familiar #12', 'AV.VALLE DE LOS ROMEROS NO. 1603,VILLAS DE NTRA. SRA. DE LA ASUNCIÓN,AGUASCALIENTES AGS.,	C.P 20126\r\n'),
(17, 'Unidad Medica de Atención Ambulatoria', ''),
(18, 'Guarderia Ordinaria', 'AV. DE LA CONVENCIÓN SUR ESQ. MIGUEL CALDERA,	COL. LINDAVISTA,AGUASCALIENTES AGS.,C.P 20270\r\n'),
(19, 'Centro de Seguridad Social', 'AV. DE LA CONVENCIÓN SUR,COL. LINDAVISTA,AGUASCALIENTES AGS. ,C.P 20270\r\n'),
(20, 'Planta de lavado', 'AV. DE LA CONVENCIÓN SUR ESQ. MIGUEL CALDERA,	COL. LINDAVISTA,AGUASCALIENTES AGS.,C.P 20270\r\n'),
(21, 'Coordinación de Abasto', ''),
(22, 'Subdelegación Sur', 'ECUADOR NO. 205,FRACC. LAS AMÉRICAS,AGUASCALIENTES AGS.,C.P 20230\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificaciones_supervisor`
--

CREATE TABLE `especificaciones_supervisor` (
  `id` int(11) NOT NULL,
  `id_sup` int(11) NOT NULL,
  `id_punto` int(11) NOT NULL,
  `especificacion` varchar(200) NOT NULL,
  `archivo_subido` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especificaciones_supervisor`
--

INSERT INTO `especificaciones_supervisor` (`id`, `id_sup`, `id_punto`, `especificacion`, `archivo_subido`) VALUES
(41, 104, 1, 'ejemplo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacionesavance`
--

CREATE TABLE `observacionesavance` (
  `id` int(11) NOT NULL,
  `observacion` varchar(350) DEFAULT NULL,
  `id_avance` int(11) DEFAULT NULL,
  `subido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos_sustantivos`
--

CREATE TABLE `puntos_sustantivos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `fuente` varchar(250) DEFAULT NULL,
  `metodologia` varchar(250) DEFAULT NULL,
  `objetivo` varchar(250) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `num_punto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puntos_sustantivos`
--

INSERT INTO `puntos_sustantivos` (`id`, `titulo`, `fuente`, `metodologia`, `objetivo`, `departamento`, `num_punto`) VALUES
(1, 'Aplicacion de las Politicas, Normatividad y Lineamientos vigentes en materia administracion de los servicios personales ', 'Organigrama estructural.\r\nRelación de la Normatividad vigente en la materia. (Políticas y Lineamientos Generales).\r\nOficios donde se difundan las políticas,normatividad y líneas de acción para la administración de los recursos humanos y presupuestal', '1.- Verificar que la Unidad cuente con los documentos señalados que coadyuven a una oportuna y eficiente operación de los servicios de personal, así como corroborar que estos hayan sido difundidos al personal operativo y que se hayan realizado las ', 'Vigilar que la administración de los servicios personales se realice con apego en los Manuales de Procedimientos, Instructivos y todas aquellas disposiciones generadas por el nivel delegacional que regulen los procedimientos en la materia.  ', 1, 1),
(2, 'Asistencia, Puntualidad y Sustituciones', 'Manual de Procedimientos para el Control y Registro de la Asistencia, Puntualidad y Sustituciones en las Unidades Operativas y Dependencias.\r\n\r\n\r\nTarjetas de asistencia de la quincena de proceso y anteriores.\r\n\r\nEquipo de cómputo con aplicativo SIAP-', '1.- Verificar que el Jefe del Departamento de la Unidad realice visitas espontáneas al lugar donde se encuentra el reloj checador y en el control de A.P.S., para verificar que el personal registre su entrada ó salida en su tarjeta de asistencia.', 'Supervisar y vigilar que la asistencia, puntualidad y sustituciones de los trabajadores de la Unidad se realice en apego a los procedimientos normativos en esta materia\n\nContar con un control del personal que no registró su asistencia dentro de l', 2, 2),
(3, 'Actualizacion de la Plantilla Nominal', 'Plantilla Nominal mecanizada.\r\n\r\nPlantilla Administrativa (Histórica)\r\n\r\nControl de documentos que generan altas, bajas y promociones.\r\n\r\nRelación de solicitudes de cancelación de salarios.\r\n\r\nOficios de certificación de tomas de posesión.\r\n\r\nContro', '1.- Verificar la plantilla nominal contra los movimientos de altas, bajas y promociones y realizar los registros de actualización oportuna.\r\n\r\n\r\n\r\n2.- Revisar el control de bajas contra las solicitudes de cancelación de salarios becas sin sueldo, l', 'Contar con una Plantilla de Personal debidamente actualizada que permita generar con fluidez y certeza los trámites administrativos derivados de las altas, bajas y promociones del personal adscrito a la Unidad ', 2, 3),
(4, 'Analisis del Balance de Plazas', 'Balance de plazas.\r\n\r\nControl de Propuestas para Actualización al Catálogo de Plazas.\r\n\r\nPlazas Sobrantes\r\n\r\nPlazas Compensadas\r\n\r\nPlazas Cubre vacaciones\r\n\r\nPlazas Cubre descansos\r\n\r\nPlazas Confianza Nivel\r\n', 'Balance de plazas.\r\n\r\nControl de Propuestas para Actualización al Catálogo de Plazas.\r\n\r\nPlazas Sobrantes\r\n\r\nPlazas Compensadas\r\n\r\nPlazas Cubre vacaciones\r\n\r\nPlazas Cubre descansos\r\n\r\nPlazas Confianza Nivel\r\n', 'Contar con un documento debidamente actualizado que sirva de base para validar el comportamiento de la fuerza de trabajo autorizada, que apoye a la operación de los servicios con cuadros de distribución por categorías.', 2, 4),
(5, 'Actualizacion a las incidencias de A.P.S', 'Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas.\r\n\r\n\r\n\r\nTarjetas de A.P.S.\r\n\r\nDocumentos relativos a las incidencias.\r\n', 'Actualizar las tarjetas de asistencia con la información documental necesaria para sustentar las incidencias de los trabajadores.\r\n Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas.\r\n\r\n\r\n\r\nTarjetas de A.P.S.\r\n\r\nDoc', 'Actualizar las tarjetas de asistencia con la información documental necesaria para sustentar las incidencias de los trabajadores.', 2, 5),
(6, 'Registro de Firmas de Funcionarios', 'Registro de Firmas de Funcionarios.', 'Registro de Firmas de Funcionarios.', 'Contar con un Catalogo de Firmas de Funcionarios facultados para suscribir documentación en trámites de personal.', 2, 6),
(7, 'Reporte a la Subcomision Mixta Disciplinaria por omision de registro de salida, firma de la tarjeta de asistencia el primer dia habil de la quincena y marcas alteradas', 'Listado mecanizado de trabajadores que presentan ésta incidencia, por quincena.\r\n\r\nReportes enviados a la Subcomisión Mixta Disciplinaria.\r\n\r\nOficios de respuesta de la Subcomisión Mixta Disciplinaria.\r\n\r\nReglamento Interior de Trabajo.\r\nCapítulo X.\r', '1.- Verificar que el personal operativo realice el cotejo del listado mecanizado y/o las tarjetas de asistencia contra los reportes enviados a la Subcomisión Mixta Disciplinaria y que éstos se remitan con oportunidad.', 'Enviar con oportunidad a la Subcomisión Mixta Disciplinaria\r\nla relación de los trabajadores que incurran en éstas incidencias \r\n', 2, 7),
(8, 'Control de 4ta. Falta', 'Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas\r\n\r\nTarjeta de 4ta. Falta (kardex)\r\n\r\nTarjeta de 4ta. Falta (kardex) del personal contratado por 08 sustitución.\r\nTarjetas de Asistencia.\r\n\r\nOficios enviados al la Je', '1.- Verificar que se realice la revisión a las tarjetas de A.P.S. contra el kardex de 4ta. falta, verificando que las faltas de los trabajadores se encuentren descargadas, incluyendo al personal sustituto (08).\r\n\r\n\r\n2.- Verificar que se realice el re', 'Contar con los controles administrativos necesarios para identificar a los trabajadores que incurren en 4ta. Falta.', 3, 8),
(9, 'Constancia de autorizacion de Pase de Entrada o Salida', 'Instructivo de uso y llenado de la Constancia de autorización de Pase de Entrada o Salida\r\n\r\nManual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas.\r\n\r\n\r\n\r\n\r\n\r\n', '1.- Verificar que exista una Libreta-Control donde sean registrados todos los pases por número de folio.\r\n2.- Constatar que se utilice el formato normado.\r\n3.- Verificar que los pases se encuentren debidamente requisitados y que se autoricen de acu', 'Contar con un control de pases de entrada y/o salida, de acuerdo a lo establecido en el Manual de Procedimientos', 2, 9),
(10, 'Autorizacion de licencias con y sin sueldo', 'Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas.\r\n\r\n\r\nLibreta - Control de registro por número de folio de licencias con y sin sueldo.\r\n\r\nTarjetas de A.P.S.\r\n\r\nLicencias con y sin sueldo otorgadas durante el últi', '1.- Comprobar que en la Libreta – Control de registro de licencias con y sin sueldo se encuentren debidamente registradas y cotejar contra tarjetas de asistencia.\r\n\r\n\r\n\r\n\r\n\r\n2.- Corroborar que las licencias con sueldo contengan anexo el comprobante', 'Tramitar las solicitudes de Licencia con y sin sueldo y que éstos documentos se apeguen a lo establecido en el Contrato Colectivo de Trabajo. Tramitar las solicitudes de Licencia con y sin sueldo y que éstos documentos se apeguen a lo establecido', 2, 10),
(11, 'Certificados de Incapacidad', 'Manual de Procedimientos para el \r\nControl y Registro de A.P.S. en Unidades Operativas.\r\n\r\nLibreta de registro de incapacidades.\r\n\r\nCopias de Certificados de Incapacidad\r\n\r\nTarjetas de APS.\r\n\r\nOficios enviados a la unidad expedidora de la incapacidad', '1.- Certificar que la Libreta de Control de incapacidades se encuentre actualizada y solicitar copias de las mismas para constatar su correcta aplicación de acuerdo al procedimiento normado para el registro en el Sistema SIAP-APS.\r\n\r\n2.- Identificar ', 'Dar seguimiento al control de las incapacidades prolongadas o por recurrencia de los trabajadores.', 4, 11),
(12, 'Programacion de Vacaciones fuera de Calendario ', 'Manual de Procedimientos para el Trámite y Otorgamiento de Vacaciones\r\n\r\n\r\nSolicitud de vacaciones fuera de calendario anual (Vac-07)\r\n\r\nLibreta de registro.\r\n\r\nNomina correspondiente.\r\n\r\nTarjetas de Asistencia\r\n\r\nContrato Colectivo de Trabajo\r\nCláus', '1.- Verificar el envío oportuno de la solicitud al Departamento Delegacional de Personal (45 días antes del disfrute solicitado).\r\n\r\n\r\n\r\n2.- Verificar que se efectué crítica de nomina para la inclusión oportuna.\r\n\r\n\r\n\r\n3.-. Evitar el diferimiento de', 'Establecer el control adecuado para el trámite de vacaciones fuera de calendario.\r\n.\r\n', 2, 12),
(13, 'Horarios y Turnos', 'Manual de Procedimientos para Modificación de Horarios Institucionales\r\n\r\n\r\nCatálogo de Horarios \r\n\r\nPlantilla Nominal \r\n\r\nTarjetas de Asistencia.\r\n', '1.- Verificar que las solicitudes de modificación de horario no afecten el equilibrio de la fuerza de trabajo en los servicios de la unidad y que la clave exista en el Catálogo Institucional.\r\n\r\n2.- Revisar que la modificación de horario se aplique h', 'Verificar que los horarios y turnos de los trabajadores se respeten conforme al Catálogo de Horarios y las características de las plazas autorizadas.', 2, 13),
(14, 'Tramite de Gafete de Identificacion, por nuevo ingreso, perdida o deterioro', 'Solicitudes de Gafete de Identificación presentadas por los trabajadores.(MD. 12A)\r\n\r\nControl de solicitudes para la elaboración de gafete de identificación (MD14).\r\n\r\n\r\nManual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operat', '1.- El Jefe de Personal y Responsables de los Servicios de la Unidad , supervisarán permanentemente que los Directivos y trabajadores adscritos a la Unidad porten su gafete de identificación.\r\n\r\n\r\n\r\n\r\n2.- Verificar que las solicitudes de elaboración', 'Lograr que todos los trabajadores tengan y porten su gafete de identificación.', 2, 14),
(15, 'Salarios no Cobrados y/o cancelados', 'Manual de Procedimientos para la Aplicación de Salarios Cancelados y No Cobrados.\r\n\r\nRelación de Salarios no Cobrados enviada por el Departamento Delegacional de Personal.\r\n\r\nSolicitudes de cancelación de salarios.\r\n\r\nSolicitudes de salarios no cobr', '1.- Analizar la relación de salarios no cobrados y cancelados para determinar lo procedente.\r\n\r\n\r\n2.- Cotejar la relación de salarios no cobrados y verificar que se haya depurado y tramitado con oportunidad, en su totalidad a través de la cancelació', '1.- Analizar la relación de salarios no cobrados y cancelados para determinar lo procedente.\r\n\r\n\r\n2.- Cotejar la relación de salarios no cobrados y verificar que se haya depurado y tramitado con oportunidad, en su totalidad a través de la cancelació', 2, 15),
(16, 'Actualizacion de comunicados SIAP, enviados a traves del Departamento Delegacional de Personal\n\n', 'Actualizacion de comunicados SIAP, enviados a traves del Departamento Delegacional de Personal.\r\n\r\n', '1.- Verificar que exista evidencia documental de que el personal encargado de la captura de incidencias en el sistema de cómputo, tenga conocimiento de todas las modificaciones que se realicen en los procesos relacionados con el sistema SIAP-APS.\r\n\r\n', 'Incorporar las versiones actualizadas de las modificaciones al sistema SIAP-APS', 4, 16),
(17, 'Critica de nomina quincenal', 'Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas\r\n\r\nNóminas de quincenas anteriores\r\n\r\nTarjetas de APS de quincenas anteriores y documentación relativa a las incidencias de los trabajadores\r\n\r\nSolicitudes de incl', '1.- Supervisar que personal encargado de las actividades de crítica de nomina, las realice en estricto apego a la normatividad, con los ajustes correspondientes \r\n\r\n2.- Identificar si su análisis requiere capacitación en la materia.\r\n\r\n\r\n\r\n3.- El', 'Validar que la información contenida en la nómina sea por los movimientos derivados de la actualización de incidencias y contratación de los trabajadores a través de la Critica de Nomina quincenalmente.', 2, 17),
(18, 'Pago e incorporacion por Acreditamiento en Cuenta de Inversion', 'Manual de Procedimientos para el Pago de las Nóminas Institucionales Mediante Acreditamiento en Cuenta Bancaria\r\n\r\n\r\n\r\nListado de acreditamiento en cuenta.\r\n\r\nListado de Líquidos sin importes.\r\n\r\nTarjetas de asistencia, Cédula de Datos Personales u o', '1.- Verificar que todo el personal de confianza este incluido a este sistema de pago.\r\n\r\n\r\n2.-Verificar que los trabajadores que cobren por este procedimiento firmen la nomina original de pago.\r\n\r\n3.- Seleccionar algunos casos para verificar que la ', 'Identificar al personal que no cobra a través de este procedimiento para hacer labor de convencimiento.', 2, 18),
(19, 'Certificaciones de Vigencia Laboral y Capacidad de Crédito. UMF #8', 'Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas\r\n\r\nRegistro y control de Certificación de Créditos, (PER PRES-077).\r\n\r\nComprobante de pago del trabajador.\r\n\r\nNómina correspondiente\r\n', '1.- Verificar que este control se encuentre por orden de matrícula, así como la actualización con las altas y bajas de los trabajadores.\r\n\r\n2.- Cotejar la nomina contra las certificaciones de crédito tramitadas en el Departamento de Personal de la Un', 'Verificar que la unidad cuente con los controles necesarios para las certificaciones, evitando afectar el patrimonio de los trabajadores.', 2, 19),
(20, 'Asignación del Marco Presupuestal de los conceptos 08 sustituto y extraordinarios \n 10 Nivelación a Plaza Superior, 35 Guardias y 37 Tiempo Extraordinario.\n', 'Manual de Procedimientos para el Control y Registro de A.P.S. en Unidades Operativas\r\n\r\nLineamientos que Regulan los Conceptos Extraordinarios.\r\n\r\nRelación de plazas vacantes etiquetadas con presupuesto.\r\n\r\nOficio enviado por la Jefatura Delegacional', '1.- Verificar la asignación Presupuestal, emitida por la Jefatura Delegacional de Servicios de Personal para los conceptos extraordinarios contra las facturas de ejercicio quincenal.\r\n2.- Verificar la adecuada distribución del presupuesto, de acuerd', 'Conocer el presupuesto asignado para administrarlo en estricto apego a los lineamientos establecidos en materia de disciplina presupuestal.', 4, 20),
(21, 'Asignación del Marco Presupuestal de los conceptos extraordinarios (08 sustitución, 10 Nivelación a Plaza Superior, 35 Guardias y 37 Tiempo Extraordinario)', NULL, 'Concepto 35 guardias.\r\n\r\n1.- Cotejar la plantilla mínima de guardias festivas contra el balance de plazas a fin de verificar el porcentaje de cobertura (entre el 25 y el 30%, aproximadamente).\r\n\r\n\r\n2.- Verificar que las solicitudes de guardias festiv', NULL, 4, 21),
(22, 'Disminución del Ausentismo no Programado.', 'Programa Delegacional para la Disminución del Ausentismo no Programado.\r\n\r\nActa Constitutiva del Comité Local Mixto para Disminuir el Ausentismo no Programado.\r\n\r\nMinutas de Trabajo, dando seguimiento a las acciones y/o estrategias encaminadas a dis', '1.- Verificar que sesione de manera regular el Comité Mixto para disminución del Ausentismo no Programado, revisando las minutas de las sesiones que se realicen.\r\n\r\n\r\n3.- Verificar que las estadísticas del comportamiento del ausentismo no programado', 'Disminuir el Ausentismo no Programado, a través de acciones conjuntas de todos los Responsables de los Servicios así como con la Representación Sindical a fin de mejorar la asistencia del personal, coadyuvando en la eficiencia y calidad de la aten', 3, 22),
(23, 'Programación Anual de Vacaciones.', 'Manual de Procedimientos de APS\r\n\r\nCalendario Anual de Vacaciones\r\n\r\n.\r\nCláusula 45 del Contrato Colectivo de Trabajo,.\r\n\r\nListado previo de programación.\r\n', '1.- Verificar que las acciones para la programación de vacaciones de los trabajadores de base se realice de manera bilateral con la Representación Sindical.\r\n\r\n2.- Aplicar la normatividad en esta materia programando por servicio y turno, logrando ', 'Mantener un equilibrio en la fuerza de trabajo.', 2, 23),
(24, 'Personal sustituto adscrito a la Unidad', 'Relación de Personal Sustituto adscrito a la Unidad, enviado por la Subcomisión Mixta de Bolsa de Trabajo.', '1.- Constatar que el personal que se encuentra en la Bolsa de Trabajo de la Unidad, y este laborando de manera regular.\r\n\r\n2.- Verificar que el Kardex del personal sustituto se encuentre actualizado en caso contrario proceder a su actualización par', 'Depurar los registros del personal sustituto a fin contar con una Bolsa de Trabajo que garantice la contratación de los mismos', 2, 24),
(25, 'Reuniones Bilaterales', 'Contrato Colectivo de Trabajo y sus Reglamentos.\n\nCalendario de Reuniones Bilaterales.\n\nSeguimiento a los Compromisos y Acuerdos establecidos.\n\nInforme a las autoridades de la Unidad y al Departamento Delegacional de Relaciones Laborales.\n', '1.- Comprobar que se están llevando a cabo las Reuniones Bilaterales, mediante las Minutas de Trabajo.\n\n2.- Verificar que los compromisos contraídos se basen en las políticas, lineamientos y normatividad vigente en la materia.\n\n\n3.- Constatar qu', 'Fortalecer el dialogo, la conciliación y concertación de los acuerdos en las reuniones de trabajo.\r\nMantener una actitud de respeto y armonía en las relaciones laborales.\r\n', 1, 25),
(26, 'Sustitución de Trabajador a Trabajador', 'Lineamientos Generales para la Aplicación del Programa Sustitución de Trabajador por Trabajador.\r\n\r\nControl de registros de los casos que se autorizan a través de este Programa.\r\n', '1.- Verificar la aplicación del Programa para cubrir el ausentismo derivado de Licencias sin suelo.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n2.- Certificar que los trabajadores a quienes se les autorice este Programa cumplan con los lineamientos establecidos.\r\n\r\n\r\n3.- Desar', 'Lograr una adecuada cobertura de las plazas de base mediante la aplicación del Convenio.', 2, 26),
(27, 'Ropa de Trabajo y Uniformes', 'Reglamento de Ropa de Trabajo y Uniformes.\r\n\r\n Pro forma \r\n', '1.- Verificar que se cuente con la Pro forma que sirvió de base para la solicitud de ropa de trabajo y uniformes al personal.\r\n\r\n\r\n2.- Constatar la participación del Jefe del Departamento de Personal de la Unidad con los Comités Locales Mixtos de R', 'Proporcionar ropa de trabajo y uniformes a los trabajadores.', 3, 27),
(28, 'Comité Local Mixto de Capacitación y Adiestramiento', 'Reglamento de capacitación y\r\nadiestramiento\r\nLineamientos para el\r\nfuncionamiento del comité local mixto de capacitación y\r\nadiestramiento\r\nContrato Colectivo de Trabajo\r\nConvocatorias emitidas por la\r\ncomisión y/o subcomisión de\r\ncapacitación y adi', '\r\nVerificar que exista acta de integración del comité local de capacitación y adiestramiento, informes bimestrales, actas de sesión y seguimiento de acuerdos y envío a la subcomisión. Publicación,\r\nenvío de actas de colocación, inscripción a promoció', 'Supervisar la integración y\r\ncorrecto funcionamiento del\r\ncomité local mixto de\r\ncapacitación y\r\nadiestramiento\r\n', 1, 28),
(29, 'Recorrido de verificación de la Comisión Delegacional a la Comisión Local Mixta de Seguridad e Higiene', '• NOM-019-STPS-2011, numerales 5.4, 5.5 y 9.5.\r\n\r\n• Reglamento de la Comisión Nacional Mixta de Seguridad e Higiene, Artículos 17, 18 inciso c).\r\n\r\n• Programa Anual de recorridos.\r\n\r\n• Acta Constitutiva de la Comisión Local Mixta de Seguridad e Higie', '1- Verificar que se hayan realizado los recorridos de verificación de acuerdo al Programa anual de recorridos.\r\n\r\n2.- Verificar que se cuente con acta constitutiva actualizada.\r\n\r\n3.- Verificar que exista acta de recorrido respecto de las supervisio', 'Verificar la instalación y funcionamiento de Comisión Local Mixta de Seguridad e Higiene.', 3, 29),
(30, 'Estructuras y/o Plantillas autorizadas', '•	Estructuras salariales. •	Plantillas teóricas y/o autorizadas.  •	Plantillas Teóricas.', 'Validación de Plantilla Nominal y Balance de Plazas de acuerdo a las estructuras salariales, plantillas teóricas y/o autorizadas', 'Verificar que de acuerdo a las estructuras salariales y/o plantillas teóricas de los Departamentos que conforman las Unidades Operativas Médicas, los puestos ocupados correspondan a lo determinado.', 2, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_calificacion`
--

CREATE TABLE `punto_calificacion` (
  `id` int(11) NOT NULL,
  `id_punto` int(11) DEFAULT NULL,
  `id_sup` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `comentario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_user`
--

CREATE TABLE `tipo_user` (
  `id` int(11) NOT NULL,
  `tipo` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_user`
--

INSERT INTO `tipo_user` (`id`, `tipo`) VALUES
(1, 'administrador'),
(2, 'supervisor'),
(3, 'declarador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `dependencia` int(11) DEFAULT NULL,
  `cargo` varchar(250) DEFAULT NULL,
  `telefono_ext` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `usuario` varchar(250) NOT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `dependencia`, `cargo`, `telefono_ext`, `correo`, `usuario`, `contrasena`, `tipo_usuario`, `departamento`) VALUES
(4, 'J.Refugio Ramirez Alonso', 1, 'N41 Responsable de Proyecto F4', '4498060396 ext:41715', 'refugio.ramirez@imss.gob.mx', 'Refugio Ramirez', '11305452', 1, 1),
(6, 'JOSÉ ARTURO GUERRA MENDOZA', 1, 'ABOGADO PROCURADOR', '4499752200 EXT 41714', 'jose.guerram@imss.gob.mx', 'ARTURO GUERRA', '311010147', 1, 1),
(7, 'Hospital General #3', 4, 'Declarador', '449100', 'Hospital_General_3@imss.gob.mx', 'HospitalGeneral3', '123456789', 3, 1),
(11, 'Órgano de operación administrativa desconcentrada de Aguascalientes', 1, 'Declarador General', '449', 'OOAD@gmail.com', 'OOAD', 'OOAD123', 3, 1),
(12, 'JACQUELINE SOSA DAMASCO', 4, 'Jefa de Personal', '4491203367', 'jacky112365@imss.gob.mx', 'Jacqueline Sosa', '112365', 3, 2),
(13, 'Luis Gerardo Fernandez Barrientos', 1, 'Encargado de Personal', '4492903080', 'trillizo.100@gmail.com', 'Luis Fernandez', '16151169', 2, 2),
(14, 'Adriana Esparza Robles', 1, 'Administradora', '4491002003', 'adriana19223355gmail.com', 'Adriana Esparza', '987654321', 1, 2),
(15, 'Supervisor Relaciones Laborales', 1, 'Supervisor departamento de relaciones laborales', '4499874562', 'DEPARTAMENTODERELACIONESLABORALES@imss.gob.mx', 'Depto_Relaciones_Laborales', '1234567', 2, 3),
(17, 'Supervisor Departamento de Capacitación y Transparencia', 1, 'Supervisor', '4491239987', 'manuel@hotmail.com', 'Depto_Capacitación_Transparencia', '101010', 2, 1),
(18, 'Declarador General Hospital General #1', 2, 'Declarador clínica 1', '449', 'HospitalGeneral1@gmail.com', 'HospitalGeneral1', '99999', 3, 2),
(19, 'Fernando Ruiz Olguin', 1, 'Administrador', '4491223698', 'fern1234@hotmail.com', 'Fernando Ruiz Olguin', '123456789', 1, 2),
(20, 'Unidad Medica Familiar #2', 6, 'Declarador UMF 2', '44923687455', 'Unidad Medica_Familiar_2@imss.gob.mx', 'UnidadMedicaFamiliar2', 'unidadM2', 3, 1),
(22, 'Hector Daniel Ferrer', 1, 'Supervisor', '4492368974', 'hectordaniel@hotmail.com', 'Hector Daniel Ferrer', '5214698', 2, 3),
(23, 'Joel Palos Villaseñor', 1, 'Supervisor', '4492236885', 'joelpalos@gmail.com', 'Joel Palos Villaseñor', '7656566', 2, 4),
(24, 'Brenda Lizeth Alcazar Murillo', 9, 'Supervisor', '44988762265', 'brenda@hotmail.com', 'Brenda Lizeth Alcazar Murillo', '565965656', 3, 2),
(25, 'Hospital General #2', 3, 'Declarador dependencia', '449', 'Hospital_General_2@gmail.com', 'HospitalGeneral2', '2222222', 3, NULL),
(26, 'Unidad Medica Familiar #1', 5, 'Declarador general', '449', 'Unidad_Medica_Familiar_1@imss.gob.mx', 'UnidadMedicaFamiliar1', 'contraseña', 3, NULL),
(27, 'Coordinacion de Abasto', 21, 'Declarador', '4492684578', 'CoordinaciondeAbasto@gmail.com', 'CoordinaciondeAbasto', 'coordina', 3, 2),
(28, 'Unidad Medica Familiar #3', 7, 'Declarador UMF #3', '4499', 'Unidad_Medica_Familiar_3@gmail.com', 'UnidadMedicaFamiliar3', 'UMF3', 3, 1),
(29, 'Unidad Medica Familiar #4', 8, 'Declarador General UMF 4', '449 4854 ext(45)', 'Unidad_Medica_Familiar_4_ags@gmail.com', 'UnidadMedicaFamiliar4', 'UMF4', 3, 3),
(30, 'Unidad Medica Familiar #5', 9, 'Declarador Gral. UMF 5', '44959265', 'Unidad_Medica_Familiar_5_ags@gmail.com', 'UnidadMedicaFamiliar5', 'UMF5', 3, 4),
(31, 'Unidad Medica Familiar #6', 10, 'Declarador general UMF#4', '449', 'Unidad_Medica_Familiar_6_ags@gmail.com', 'UnidadMedicaFamiliar6', 'UMF6', 3, 3),
(34, 'Unidad Medica Familiar #9', 13, 'Declarador general UMF 9', '449', 'Unidad_Medica_Familiar_9_Ags@gmail.com', 'UnidadMedicaFamiliar9', 'UMF9', 3, 3),
(35, 'Unidad Medica Familiar #10', 12, 'Declarador gral UMF 10', '449963', 'Unidad_Medica_Familiar_10@gmail.com', 'UnidadMedicaFamiliar10', 'UMF10', 3, 1),
(36, 'Unidad Medica Familiar #11', 13, 'Declarador General UMF 11', '44999365', 'Unidad_Medica_Familiar_11_ags@gmail.com', 'UnidadMedicaFamiliar11', 'UMF11', 3, 4),
(37, 'Unidad Medica Familiar #12', 16, 'Declarador General UMF 12', '449', 'Unidad_Medica_Familiar_12_ags@gmail.com', 'UnidadMedicaFamiliar12', 'UMF12', 3, 1),
(38, 'Unidad Medica de Atencion Ambulatoria', 17, 'Declarador Gral. UMAA ', '449154', 'Unidad_Medica_Atencion_Ambulatoria_Ags@gmail.com', 'UnidadMedicaAtencionAmbulatoria', 'UMAA', 3, 3),
(39, 'Guardería Ordinaria', 18, 'Declarador Gral Guardería Ordinaria', '449', 'Guarderia_Ordinaria_Ags@gmail.com', 'GuarderiaOrdinariaAgs', '654321', 3, 1),
(40, 'Centro de Seguridad Social', 19, 'Declarador General', '449 ext()', 'Centro_de_Seguridad_Social@gmail.com', 'CentrodeSeguridadSocial', 'CSS10', 3, 3),
(41, 'Planta de lavado', 20, 'Declarador General', '449 ext()', 'Planta_lavado_Ags@gmail.com', 'PlantadeLavado', '55664433', 3, 3),
(42, 'Subdelegacion Sur', 22, 'Declarador General', '449 ext()', 'Subdelegacion_Sur_Ags@gmail.com', 'SubdelegacionSur', 'sur1122', 3, 1),
(43, 'Prueba', 1, 'Jefe', '123456789', 'jesusandradesustaita@gmail.com', 'Jesús Andrade', '54321', 1, 1),
(44, 'Unidad Medica Familiar 7', 11, 'Declarador general', '449', 'UnidadMedicaFamiliar7@gmail.com', 'UnidadMedicaFamiliar7', 'UMF7', 3, 1),
(45, 'Unidad Medica Familiar #8', 12, 'Declarador general UMF 8', '449', 'UnidadMedicaFamiliar8@gmail.com', 'UnidadMedicaFamiliar8', 'UMF8', 3, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aperturas_admin`
--
ALTER TABLE `aperturas_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dependencia` (`dependencia`);

--
-- Indices de la tabla `apertura_punto`
--
ALTER TABLE `apertura_punto`
  ADD KEY `id_punto` (`id_punto`);

--
-- Indices de la tabla `apertura_seguimiento`
--
ALTER TABLE `apertura_seguimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_revision` (`id_revision`);

--
-- Indices de la tabla `apertura_supervisor`
--
ALTER TABLE `apertura_supervisor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unidad` (`unidad`),
  ADD KEY `FK_Declarador_Usuario` (`declarador`);

--
-- Indices de la tabla `archivarfiles`
--
ALTER TABLE `archivarfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivos_cedula`
--
ALTER TABLE `archivos_cedula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sup` (`id_sup`);

--
-- Indices de la tabla `archivos_minutas`
--
ALTER TABLE `archivos_minutas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sup` (`id_sup`);

--
-- Indices de la tabla `archivos_revision`
--
ALTER TABLE `archivos_revision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_archivo_punto` (`id_punto`);

--
-- Indices de la tabla `archivos_seguimiento`
--
ALTER TABLE `archivos_seguimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seguimiento` (`id_seguimiento`);

--
-- Indices de la tabla `archivos_super`
--
ALTER TABLE `archivos_super`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_espe` (`id_espe`);

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_avances_especificaciones` (`id_espe`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `calificacion_supervision`
--
ALTER TABLE `calificacion_supervision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_punto` (`id_punto`),
  ADD KEY `id_sup` (`id_sup`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `comentario_final`
--
ALTER TABLE `comentario_final`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seguimiento` (`id_seguimiento`);

--
-- Indices de la tabla `conteo_supervisores`
--
ALTER TABLE `conteo_supervisores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sup` (`id_sup`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especificaciones_supervisor`
--
ALTER TABLE `especificaciones_supervisor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sup` (`id_sup`),
  ADD KEY `id_punto` (`id_punto`);

--
-- Indices de la tabla `observacionesavance`
--
ALTER TABLE `observacionesavance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_avance` (`id_avance`);

--
-- Indices de la tabla `puntos_sustantivos`
--
ALTER TABLE `puntos_sustantivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento` (`departamento`);

--
-- Indices de la tabla `punto_calificacion`
--
ALTER TABLE `punto_calificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_punto` (`id_punto`);

--
-- Indices de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento` (`departamento`),
  ADD KEY `FK_Tipo_Usuario` (`tipo_usuario`),
  ADD KEY `dependencia` (`dependencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aperturas_admin`
--
ALTER TABLE `aperturas_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `apertura_seguimiento`
--
ALTER TABLE `apertura_seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `apertura_supervisor`
--
ALTER TABLE `apertura_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `archivarfiles`
--
ALTER TABLE `archivarfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_cedula`
--
ALTER TABLE `archivos_cedula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_minutas`
--
ALTER TABLE `archivos_minutas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_revision`
--
ALTER TABLE `archivos_revision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_seguimiento`
--
ALTER TABLE `archivos_seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_super`
--
ALTER TABLE `archivos_super`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `avances`
--
ALTER TABLE `avances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `calificacion_supervision`
--
ALTER TABLE `calificacion_supervision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `comentario_final`
--
ALTER TABLE `comentario_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conteo_supervisores`
--
ALTER TABLE `conteo_supervisores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `especificaciones_supervisor`
--
ALTER TABLE `especificaciones_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `observacionesavance`
--
ALTER TABLE `observacionesavance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntos_sustantivos`
--
ALTER TABLE `puntos_sustantivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `punto_calificacion`
--
ALTER TABLE `punto_calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_user`
--
ALTER TABLE `tipo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aperturas_admin`
--
ALTER TABLE `aperturas_admin`
  ADD CONSTRAINT `aperturas_admin_ibfk_1` FOREIGN KEY (`dependencia`) REFERENCES `dependencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `apertura_punto`
--
ALTER TABLE `apertura_punto`
  ADD CONSTRAINT `FK_PUNTO_APERTURA` FOREIGN KEY (`id_punto`) REFERENCES `puntos_sustantivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apertura_punto_ibfk_1` FOREIGN KEY (`id_punto`) REFERENCES `puntos_sustantivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `apertura_seguimiento`
--
ALTER TABLE `apertura_seguimiento`
  ADD CONSTRAINT `apertura_seguimiento_ibfk_1` FOREIGN KEY (`id_revision`) REFERENCES `calificacion_supervision` (`id`);

--
-- Filtros para la tabla `apertura_supervisor`
--
ALTER TABLE `apertura_supervisor`
  ADD CONSTRAINT `FK_Declarador_Usuario` FOREIGN KEY (`declarador`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apertura_supervisor_ibfk_2` FOREIGN KEY (`unidad`) REFERENCES `dependencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_minutas`
--
ALTER TABLE `archivos_minutas`
  ADD CONSTRAINT `archivos_minutas_ibfk_1` FOREIGN KEY (`id_sup`) REFERENCES `apertura_supervisor` (`id`);

--
-- Filtros para la tabla `archivos_revision`
--
ALTER TABLE `archivos_revision`
  ADD CONSTRAINT `FK_archivo_punto` FOREIGN KEY (`id_punto`) REFERENCES `apertura_punto` (`id_punto`);

--
-- Filtros para la tabla `archivos_seguimiento`
--
ALTER TABLE `archivos_seguimiento`
  ADD CONSTRAINT `archivos_seguimiento_ibfk_1` FOREIGN KEY (`id_seguimiento`) REFERENCES `apertura_seguimiento` (`id`);

--
-- Filtros para la tabla `archivos_super`
--
ALTER TABLE `archivos_super`
  ADD CONSTRAINT `archivos_super_ibfk_1` FOREIGN KEY (`id_espe`) REFERENCES `especificaciones_supervisor` (`id`);

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `fk_avances_especificaciones` FOREIGN KEY (`id_espe`) REFERENCES `especificaciones_supervisor` (`id`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `calificacion_supervision`
--
ALTER TABLE `calificacion_supervision`
  ADD CONSTRAINT `calificacion_supervision_ibfk_1` FOREIGN KEY (`id_punto`) REFERENCES `puntos_sustantivos` (`id`),
  ADD CONSTRAINT `calificacion_supervision_ibfk_2` FOREIGN KEY (`id_sup`) REFERENCES `apertura_supervisor` (`id`),
  ADD CONSTRAINT `calificacion_supervision_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `comentario_final`
--
ALTER TABLE `comentario_final`
  ADD CONSTRAINT `comentario_final_ibfk_1` FOREIGN KEY (`id_seguimiento`) REFERENCES `apertura_seguimiento` (`id`);

--
-- Filtros para la tabla `conteo_supervisores`
--
ALTER TABLE `conteo_supervisores`
  ADD CONSTRAINT `conteo_supervisores_ibfk_1` FOREIGN KEY (`id_sup`) REFERENCES `apertura_supervisor` (`id`);

--
-- Filtros para la tabla `especificaciones_supervisor`
--
ALTER TABLE `especificaciones_supervisor`
  ADD CONSTRAINT `especificaciones_supervisor_ibfk_1` FOREIGN KEY (`id_sup`) REFERENCES `apertura_supervisor` (`id`),
  ADD CONSTRAINT `especificaciones_supervisor_ibfk_2` FOREIGN KEY (`id_punto`) REFERENCES `puntos_sustantivos` (`id`);

--
-- Filtros para la tabla `observacionesavance`
--
ALTER TABLE `observacionesavance`
  ADD CONSTRAINT `observacionesavance_ibfk_1` FOREIGN KEY (`id_avance`) REFERENCES `avances` (`id`);

--
-- Filtros para la tabla `puntos_sustantivos`
--
ALTER TABLE `puntos_sustantivos`
  ADD CONSTRAINT `puntos_sustantivos_ibfk_1` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `punto_calificacion`
--
ALTER TABLE `punto_calificacion`
  ADD CONSTRAINT `punto_calificacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `punto_calificacion_ibfk_2` FOREIGN KEY (`id_punto`) REFERENCES `puntos_sustantivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_Tipo_Usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USER_DEP` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`dependencia`) REFERENCES `dependencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
