-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: registro_uber
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `choferes`
--

DROP TABLE IF EXISTS `choferes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choferes` (
  `idchofer` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_1` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `telefono_2` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_licencia` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `monto_fianza` int(11) NOT NULL,
  `referencia_1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `referencia_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_uber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `foto_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_licencia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_casa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_contrato` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_uber` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ubicacion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idchofer`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choferes`
--

LOCK TABLES `choferes` WRITE;
/*!40000 ALTER TABLE `choferes` DISABLE KEYS */;
INSERT INTO `choferes` VALUES (9,'fernando','mexicali','6131118512','68612854911','febbrrtt',240,'armand','humberto','56fr23','',NULL,NULL,NULL,NULL,NULL,NULL),(2,'fernando','b','b','','b',40,'b','b','b',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'ferna','d','f','f','f',4,'f','f','f','',NULL,NULL,NULL,NULL,NULL,NULL),(4,'g','g','g','g','g',32,'g','g','g','',NULL,NULL,NULL,NULL,NULL,NULL),(5,'fg','g','h','h','h',4,'h','h','g','',NULL,NULL,NULL,NULL,NULL,NULL),(6,'g','gr','gr','r','re',4,'g','g','gr','',NULL,NULL,NULL,NULL,NULL,NULL),(7,'fe','fe','f','f','e',32,'for','32','e','6674c079f245df3a.gif',NULL,NULL,NULL,NULL,NULL,NULL),(8,'f','for','f','g','g',3,'g','h','g','dbef5b076d8ce008.jpg',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `choferes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `iddocumento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `documento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  PRIMARY KEY (`iddocumento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotografias`
--

DROP TABLE IF EXISTS `fotografias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografias` (
  `idfotografia` int(11) NOT NULL AUTO_INCREMENT,
  `semana` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotografia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  PRIMARY KEY (`idfotografia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografias`
--

LOCK TABLES `fotografias` WRITE;
/*!40000 ALTER TABLE `fotografias` DISABLE KEYS */;
/*!40000 ALTER TABLE `fotografias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revision`
--

DROP TABLE IF EXISTS `revision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revision` (
  `idrevision` int(11) NOT NULL AUTO_INCREMENT,
  `semana` date DEFAULT NULL,
  `kilometraje` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `incentivos` double NOT NULL,
  `ganancias` double NOT NULL,
  `efectivo` double NOT NULL,
  `horas_conectado` int(11) NOT NULL,
  `deposito_bancario` double NOT NULL,
  `renta` double NOT NULL,
  `pendientes` double NOT NULL,
  `multas` double NOT NULL,
  `choques` double NOT NULL,
  `total` double NOT NULL,
  `pendiente` double NOT NULL,
  `rutas_imagenes` json NOT NULL,
  `opciones` json NOT NULL,
  `idvehiculo` int(11) NOT NULL,
  PRIMARY KEY (`idrevision`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revision`
--

LOCK TABLES `revision` WRITE;
/*!40000 ALTER TABLE `revision` DISABLE KEYS */;
INSERT INTO `revision` VALUES (1,'2019-01-28','43',0,43,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"false\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"false\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"false\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"false\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"false\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"false\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"false\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"false\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"false\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"false\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"false\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"false\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"false\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"false\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"true\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"true\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"true\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"true\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"true\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"true\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"true\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"true\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"true\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"true\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"true\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"true\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"true\"}}',3),(2,'2019-02-28','32',0,43,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1),(3,'2019-05-28','32',0,3,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1),(4,'2019-07-28','32',0,5.6,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1),(5,'2019-07-28','32',0,35,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',7),(6,'2019-08-28','32',0,534,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1),(7,'2019-08-28','32',0,43,0,0,0,0,0,0,0,0,0,'{}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1),(8,'2019-08-28','32',0,12,0,0,0,0,0,0,0,0,0,'{\"fotofrente\": \"e99c2f7aba040fe6.jpg\", \"fototablero\": \"72fc64728070576c.jpg\", \"fototrasera\": \"e70842dd5c51b049.jpg\"}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1),(9,'2019-08-28','32',0,43,0,0,0,0,0,0,0,0,0,'{\"fotofrente\": \"371760a93512335b.jpg\", \"fototablero\": \"66f2a50d339950c4.jpg\", \"fototrasera\": \"896ac73915741e10.jpg\"}','{\"0\": {\"key\": \"n_motor\", \"tipo\": \"Nivel de aceite de motor\", \"selected\": \"true\"}, \"1\": {\"key\": \"n_trasmision\", \"tipo\": \"Nivel de aceite trasmision\", \"selected\": \"true\"}, \"2\": {\"key\": \"n_radiador\", \"tipo\": \"Nivel de agua radiador\", \"selected\": \"true\"}, \"3\": {\"key\": \"n_frenos\", \"tipo\": \"Nivel de liquido de frenos\", \"selected\": \"true\"}, \"4\": {\"key\": \"n_power\", \"tipo\": \"Nivel de aceite power\", \"selected\": \"true\"}, \"5\": {\"key\": \"n_parabrisas\", \"tipo\": \"Nivel de agua parabrisas\", \"selected\": \"true\"}, \"6\": {\"key\": \"f_agua\", \"tipo\": \"Fugas de agua\", \"selected\": \"true\"}, \"7\": {\"key\": \"f_aceite\", \"tipo\": \"Fugas de aceite\", \"selected\": \"true\"}, \"8\": {\"key\": \"r_llantas\", \"tipo\": \"Revision de llantas\", \"selected\": \"true\"}, \"9\": {\"key\": \"r_alineacion\", \"tipo\": \"Revision de alineacion\", \"selected\": \"true\"}, \"10\": {\"key\": \"r_luces\", \"tipo\": \"Revision de luces\", \"selected\": \"true\"}, \"11\": {\"key\": \"r_direccionales\", \"tipo\": \"Revision direccionales\", \"selected\": \"true\"}, \"12\": {\"key\": \"r_limpiaparabrisas\", \"tipo\": \"Revision limpiaparabrisas\", \"selected\": \"true\"}, \"13\": {\"key\": \"r_copas\", \"tipo\": \"Revision copas\", \"selected\": \"true\"}, \"14\": {\"key\": \"polvaderas\", \"tipo\": \"Polvaderas\", \"selected\": \"false\"}, \"15\": {\"key\": \"tapon_gasolina\", \"tipo\": \"Tapon de Gasolina\", \"selected\": \"false\"}, \"16\": {\"key\": \"extra\", \"tipo\": \"Extra\", \"selected\": \"false\"}, \"17\": {\"key\": \"gato\", \"tipo\": \"Gato\", \"selected\": \"false\"}, \"18\": {\"key\": \"cruceta\", \"tipo\": \"Cruceta\", \"selected\": \"false\"}, \"19\": {\"key\": \"a_cajuela\", \"tipo\": \"Accesorios Cajuela\", \"selected\": \"false\"}, \"20\": {\"key\": \"parabrisas\", \"tipo\": \"Parabrisas\", \"selected\": \"false\"}, \"21\": {\"key\": \"tapetes\", \"tipo\": \"Tapetes\", \"selected\": \"false\"}, \"22\": {\"key\": \"l_chofer\", \"tipo\": \"Licencia Chofer\", \"selected\": \"false\"}, \"23\": {\"key\": \"c_seguro\", \"tipo\": \"Copia del seguro\", \"selected\": \"false\"}, \"24\": {\"key\": \"t_circulacion\", \"tipo\": \"Tarjeta de circulacion\", \"selected\": \"false\"}, \"25\": {\"key\": \"l_interior\", \"tipo\": \"Limpieza interior\", \"selected\": \"false\"}, \"26\": {\"key\": \"l_exterior\", \"tipo\": \"Limpieza exterior\", \"selected\": \"false\"}}',1);
/*!40000 ALTER TABLE `revision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contraseña` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'fer','fer','232','efef');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculo` (
  `idvehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `linea` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `serie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `perfil` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placas` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pedimento` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tarjeta_circulacion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seguro` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factura` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idchofer` int(11) NOT NULL,
  PRIMARY KEY (`idvehiculo`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES (1,'x','x','x','x','x','x',NULL,'x',NULL,NULL,NULL,NULL,2),(2,'c','c','c','c','c','c',NULL,'c',NULL,NULL,NULL,NULL,0),(3,'z','z','z','z','z','z',NULL,'z',NULL,NULL,NULL,NULL,0),(4,'d','f','d','f','d','d',NULL,'d',NULL,NULL,NULL,NULL,0),(5,'r','t','t','t','t','t',NULL,'t',NULL,NULL,NULL,NULL,0),(6,'g','gg','g','g','g','g',NULL,'g',NULL,NULL,NULL,NULL,0),(7,'fe','fe','fe','fe','f','fe','6d387f26459585b9.jpg','fe','5adaf498781bc349.jpg','7813b8120c2984f7.jpg','81b075abb7598cbb.jpeg','f8eb975bbcf67b70.jpeg',3);
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-04 16:12:56
