CREATE DATABASE  IF NOT EXISTS `facturaciondb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `facturaciondb`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: facturaciondb
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `fact_detalle`
--

DROP TABLE IF EXISTS `fact_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fact_detalle` (
  `fdet_id` int NOT NULL AUTO_INCREMENT,
  `fdet_linea` varchar(100) DEFAULT NULL,
  `fdet_cantidad` int DEFAULT NULL,
  `zprod_id` int DEFAULT NULL,
  `zfenc_id` int DEFAULT NULL,
  PRIMARY KEY (`fdet_id`),
  KEY `fact_detalle_fact_encabezado_FK` (`zfenc_id`),
  KEY `fact_detalle_producto_FK` (`zprod_id`),
  CONSTRAINT `fact_detalle_fact_encabezado_FK` FOREIGN KEY (`zfenc_id`) REFERENCES `fact_encabezado` (`fenc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fact_detalle_producto_FK` FOREIGN KEY (`zprod_id`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fact_detalle`
--

LOCK TABLES `fact_detalle` WRITE;
/*!40000 ALTER TABLE `fact_detalle` DISABLE KEYS */;
INSERT INTO `fact_detalle` VALUES (1,'Local',7,1,1),(2,'Local',9,2,1),(3,'Local',13,3,1);
/*!40000 ALTER TABLE `fact_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fact_encabezado`
--

DROP TABLE IF EXISTS `fact_encabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fact_encabezado` (
  `fenc_id` int NOT NULL AUTO_INCREMENT,
  `fenc_numero` int DEFAULT NULL,
  `fenc_fecha` date DEFAULT NULL,
  `zper_id` int DEFAULT NULL,
  PRIMARY KEY (`fenc_id`),
  KEY `fact_encabezado_persona_FK` (`zper_id`),
  CONSTRAINT `fact_encabezado_persona_FK` FOREIGN KEY (`zper_id`) REFERENCES `persona` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fact_encabezado`
--

LOCK TABLES `fact_encabezado` WRITE;
/*!40000 ALTER TABLE `fact_encabezado` DISABLE KEYS */;
INSERT INTO `fact_encabezado` VALUES (1,10001,'2024-06-20',1);
/*!40000 ALTER TABLE `fact_encabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `per_id` int NOT NULL AUTO_INCREMENT,
  `per_nombre` varchar(100) DEFAULT NULL,
  `per_apellido` varchar(100) DEFAULT NULL,
  `per_tipodocumento` varchar(100) DEFAULT NULL,
  `per_documento` int DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Usuario1','Uno','cc',1111111111),(2,'Usuario2','Dos','cc',1111111112);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `prod_id` int NOT NULL AUTO_INCREMENT,
  `prod_descripcion` varchar(100) DEFAULT NULL,
  `prod_precio` float DEFAULT NULL,
  `prod_costo` float DEFAULT NULL,
  `prod_um` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Aluminio',100000,80000,'mts'),(2,'Hierro',120000,10000,'mts'),(3,'Madera',80000,70000,'cms');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_producto_mas_caro`
--

DROP TABLE IF EXISTS `vista_producto_mas_caro`;
/*!50001 DROP VIEW IF EXISTS `vista_producto_mas_caro`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_producto_mas_caro` AS SELECT 
 1 AS `per_id`,
 1 AS `per_nombre`,
 1 AS `per_apellido`,
 1 AS `prod_descripcion`,
 1 AS `prod_precio`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_productos_cantidad_facturada_desc`
--

DROP TABLE IF EXISTS `vista_productos_cantidad_facturada_desc`;
/*!50001 DROP VIEW IF EXISTS `vista_productos_cantidad_facturada_desc`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_productos_cantidad_facturada_desc` AS SELECT 
 1 AS `prod_id`,
 1 AS `prod_descripcion`,
 1 AS `total_cantidad_facturada`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_productos_margen_canancia`
--

DROP TABLE IF EXISTS `vista_productos_margen_canancia`;
/*!50001 DROP VIEW IF EXISTS `vista_productos_margen_canancia`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_productos_margen_canancia` AS SELECT 
 1 AS `prod_id`,
 1 AS `prod_descripcion`,
 1 AS `utilidad_generada`,
 1 AS `margen_ganancia`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_productos_utilidad_facturacion`
--

DROP TABLE IF EXISTS `vista_productos_utilidad_facturacion`;
/*!50001 DROP VIEW IF EXISTS `vista_productos_utilidad_facturacion`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_productos_utilidad_facturacion` AS SELECT 
 1 AS `prod_id`,
 1 AS `prod_descripcion`,
 1 AS `utilidad_generada`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_total_facturado_persona`
--

DROP TABLE IF EXISTS `vista_total_facturado_persona`;
/*!50001 DROP VIEW IF EXISTS `vista_total_facturado_persona`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_total_facturado_persona` AS SELECT 
 1 AS `per_id`,
 1 AS `per_nombre`,
 1 AS `per_apellido`,
 1 AS `total_facturado`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vista_producto_mas_caro`
--

/*!50001 DROP VIEW IF EXISTS `vista_producto_mas_caro`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_producto_mas_caro` AS select `p`.`per_id` AS `per_id`,`p`.`per_nombre` AS `per_nombre`,`p`.`per_apellido` AS `per_apellido`,`pd`.`prod_descripcion` AS `prod_descripcion`,`pd`.`prod_precio` AS `prod_precio` from (((`persona` `p` join `fact_encabezado` `fe` on((`p`.`per_id` = `fe`.`zper_id`))) join `fact_detalle` `fd` on((`fe`.`fenc_id` = `fd`.`zfenc_id`))) join `producto` `pd` on((`fd`.`zprod_id` = `pd`.`prod_id`))) order by `pd`.`prod_precio` desc limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_productos_cantidad_facturada_desc`
--

/*!50001 DROP VIEW IF EXISTS `vista_productos_cantidad_facturada_desc`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_productos_cantidad_facturada_desc` AS select `pd`.`prod_id` AS `prod_id`,`pd`.`prod_descripcion` AS `prod_descripcion`,sum(`fd`.`fdet_cantidad`) AS `total_cantidad_facturada` from (`producto` `pd` join `fact_detalle` `fd` on((`pd`.`prod_id` = `fd`.`zprod_id`))) group by `pd`.`prod_id`,`pd`.`prod_descripcion` order by `total_cantidad_facturada` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_productos_margen_canancia`
--

/*!50001 DROP VIEW IF EXISTS `vista_productos_margen_canancia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_productos_margen_canancia` AS select `pd`.`prod_id` AS `prod_id`,`pd`.`prod_descripcion` AS `prod_descripcion`,sum(((`pd`.`prod_precio` - `pd`.`prod_costo`) * `fd`.`fdet_cantidad`)) AS `utilidad_generada`,(((`pd`.`prod_precio` - `pd`.`prod_costo`) / `pd`.`prod_precio`) * 100) AS `margen_ganancia` from (`producto` `pd` join `fact_detalle` `fd` on((`pd`.`prod_id` = `fd`.`zprod_id`))) group by `pd`.`prod_id`,`pd`.`prod_descripcion`,`pd`.`prod_precio`,`pd`.`prod_costo` order by `utilidad_generada` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_productos_utilidad_facturacion`
--

/*!50001 DROP VIEW IF EXISTS `vista_productos_utilidad_facturacion`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_productos_utilidad_facturacion` AS select `pd`.`prod_id` AS `prod_id`,`pd`.`prod_descripcion` AS `prod_descripcion`,sum(((`pd`.`prod_precio` - `pd`.`prod_costo`) * `fd`.`fdet_cantidad`)) AS `utilidad_generada` from (`producto` `pd` join `fact_detalle` `fd` on((`pd`.`prod_id` = `fd`.`zprod_id`))) group by `pd`.`prod_id`,`pd`.`prod_descripcion` order by `utilidad_generada` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_total_facturado_persona`
--

/*!50001 DROP VIEW IF EXISTS `vista_total_facturado_persona`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_total_facturado_persona` AS select `p`.`per_id` AS `per_id`,`p`.`per_nombre` AS `per_nombre`,`p`.`per_apellido` AS `per_apellido`,coalesce(sum((`pd`.`prod_precio` * `fd`.`fdet_cantidad`)),0) AS `total_facturado` from (((`persona` `p` left join `fact_encabezado` `fe` on((`p`.`per_id` = `fe`.`zper_id`))) left join `fact_detalle` `fd` on((`fe`.`fenc_id` = `fd`.`zfenc_id`))) left join `producto` `pd` on((`fd`.`zprod_id` = `pd`.`prod_id`))) group by `p`.`per_id`,`p`.`per_nombre`,`p`.`per_apellido` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 11:12:23
