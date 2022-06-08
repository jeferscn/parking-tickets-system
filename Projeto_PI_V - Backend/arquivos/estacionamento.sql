-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: estacionamento
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(4) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (2,'SUV'),(3,'Hatch');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_vagas` int(10) DEFAULT NULL,
  `total_vagas_ocupadas` int(10) DEFAULT NULL,
  `valor_pequeno` decimal(10,2) DEFAULT NULL,
  `valor_medio` decimal(10,2) DEFAULT NULL,
  `valor_grande` decimal(10,2) DEFAULT NULL,
  `nome_estacionamento` varchar(45) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `mensagem` varchar(110) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracoes`
--

LOCK TABLES `configuracoes` WRITE;
/*!40000 ALTER TABLE `configuracoes` DISABLE KEYS */;
INSERT INTO `configuracoes` VALUES (1,55,8,4.00,5.00,6.00,'Chamber Parking','Rua XV de Novembro, 1230 - Curitiba/PR','Obrigado por confiar em nossos serviços!','(41) 99999-9999');
/*!40000 ALTER TABLE `configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formas_pagamento`
--

DROP TABLE IF EXISTS `formas_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formas_pagamento` (
  `id_pagamento` int(4) NOT NULL AUTO_INCREMENT,
  `tipo_pagamento` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pagamento`
--

LOCK TABLES `formas_pagamento` WRITE;
/*!40000 ALTER TABLE `formas_pagamento` DISABLE KEYS */;
INSERT INTO `formas_pagamento` VALUES (2,'Cartão Débito'),(3,'Cartão Crédito'),(5,'Dinheiro'),(6,'Pix - A vista');
/*!40000 ALTER TABLE `formas_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos` (
  `id_pagamento` int(10) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) DEFAULT NULL,
  `tipo_pagamento` varchar(20) DEFAULT NULL,
  `id_veiculo` int(10) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` VALUES (1,0.00,'Dinheiro',4,'ABCDEFGH'),(2,0.00,'Pix - A vista',5,'ABCDEFGH'),(3,0.00,'Cartão Crédito',6,'ABCDEFGH'),(4,0.00,'Cartão Crédito',7,'ABCDEFGH'),(5,0.00,'Cartão Crédito',9,'ABCDEFGH'),(6,0.00,'Cartão Crédito',8,'ABCDEFGH'),(7,0.00,'Cartão Crédito',10,'ABCDEFGH'),(8,0.00,'Cartão Crédito',1,'ABCDEFGH'),(9,0.00,'Cartão Crédito',1,'ABCDEFGH'),(10,0.00,'Cartão Crédito',1,'ABCDEFGH'),(11,0.00,'Cartão Crédito',2,'ABCDEFGH'),(12,0.00,'Cartão Crédito',3,'ABCDEFGH'),(13,0.00,'Cartão Crédito',3,'ABCDEFGH'),(14,0.00,'Cartão Crédito',3,'ABCDEFGH'),(15,0.00,'Cartão Crédito',3,'ABCDEFGH'),(16,0.00,'Cartão Crédito',3,'ABCDEFGH'),(17,0.00,'Cartão Crédito',3,'ABCDEFGH'),(18,0.00,'Cartão Crédito',4,'ABCDEFGH'),(19,0.00,'Cartão Crédito',5,'ABCDEFGH'),(20,0.00,'Cartão Crédito',5,'ABCDEFGH'),(21,0.00,'Cartão Crédito',5,'ABCDEFGH'),(22,0.00,'Cartão Crédito',5,'ABCDEFGH'),(23,0.00,'Cartão Crédito',6,'ABCDEFGH'),(24,0.00,'Cartão Crédito',6,'ABCDEFGH'),(25,0.00,'Cartão Crédito',6,'ABCDEFGH'),(26,0.00,'Cartão Crédito',6,'ABCDEFGH'),(27,57.13,'Cartão Crédito',6,'ABCDEFGH'),(28,70.42,'Dinheiro',7,'ABCDEFGH'),(29,107.20,'Dinheiro',10,'ABCDEFGH'),(30,89.42,'Dinheiro',9,'ABCDEFGH'),(31,71.60,'Cartão Débito',8,'ABCDEFGH'),(32,197.87,'Dinheiro',1,'ABCDEFGH'),(33,248.33,'Dinheiro',2,'ABCDEFGH'),(34,111.20,'Cartão Débito',4,'ABCDEFGH'),(35,92.75,'Cartão Débito',5,'ABCDEFGH'),(36,74.20,'Cartão Crédito',6,'ABCDEFGH'),(37,91.83,'Cartão Crédito',7,'ABCDEFGH'),(38,120.80,'Cartão Débito',3,'ABCDEFGH'),(39,75.87,'Dinheiro',8,'ABCDEFGH'),(40,94.92,'Dinheiro',9,'ABCDEFGH'),(41,114.00,'Dinheiro',10,'ABCDEFGH'),(42,296.80,'Cartão Crédito',1,'ABCDEFGH'),(43,370.75,'Cartão Crédito',2,'ABCDEFGH'),(44,264.60,'Cartão Crédito',3,'ABCDEFGH'),(45,260.20,'Cartão Débito',4,'ABCDEFGH');
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(4) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `nivel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Admin','admin','21232f297a57a5a743894a0e4a801fc3','Administrador');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculos` (
  `id_veiculo` int(7) NOT NULL AUTO_INCREMENT,
  `placa` varchar(10) DEFAULT NULL,
  `nome_veiculo` varchar(30) DEFAULT NULL,
  `tamanho` varchar(10) DEFAULT NULL,
  `nome_categoria` varchar(50) DEFAULT NULL,
  `estacionado` varchar(5) DEFAULT NULL,
  `data_entrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_saida` datetime DEFAULT NULL,
  PRIMARY KEY (`id_veiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` VALUES (1,'ABCDEFGH','Fiesta','pequeno','Hatch','nao','2022-06-05 18:48:20','2022-06-08 18:00:37'),(2,'ABCDEFGH','Camaro','medio','Hatch','nao','2022-06-05 18:52:05','2022-06-08 18:01:55'),(3,'ABCDEFGH','Caminhonete F250','grande','Hatch','nao','2022-06-07 01:07:02','2022-06-08 18:13:28'),(4,'ABCDEFGH','Carro Ford','grande','SUV','nao','2022-06-07 02:02:21','2022-06-08 18:25:01'),(5,'ABCDEFGH','Carro Ford','medio','','sim','2022-06-07 02:02:33','2022-06-07 17:35:48'),(6,'ABCDEFGH','Carro Ford','pequeno','Hatch','sim','2022-06-07 02:02:46','2022-06-07 17:36:20'),(7,'ABCDEFGH','Dodge','medio','Hatch','sim','2022-06-07 02:15:26','2022-06-07 17:38:15'),(8,'ABCDEFGH','AASDASASA','pequeno','Hatch','sim','2022-06-07 02:19:38','2022-06-07 18:17:59'),(9,'ABCDEFGH','WETWETWT','medio','SUV','sim','2022-06-07 02:19:58','2022-06-07 18:19:36'),(10,'ABCDEFGH','WETWETWTR','grande','Hatch','sim','2022-06-07 02:20:11','2022-06-07 18:21:07');
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-08 18:33:30
