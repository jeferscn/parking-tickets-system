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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (4,'Automóvel'),(5,'Motocicleta'),(6,'Caminhão'),(7,'Caminhonete'),(8,'Bicicleta');
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
  `tempo_isencao` int(2) DEFAULT NULL,
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
INSERT INTO `configuracoes` VALUES (1,55,20,4.00,5.00,5.00,15,'UNICURITIBA Parking','Rua XV de Novembro, 1230 - Curitiba/PR','Obrigado por confiar em nossos serviços!','(41) 99999-9999');
/*!40000 ALTER TABLE `configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cores`
--

DROP TABLE IF EXISTS `cores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cores` (
  `cor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cores`
--

LOCK TABLES `cores` WRITE;
/*!40000 ALTER TABLE `cores` DISABLE KEYS */;
INSERT INTO `cores` VALUES ('Vermelho'),('Branco');
/*!40000 ALTER TABLE `cores` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pagamento`
--

LOCK TABLES `formas_pagamento` WRITE;
/*!40000 ALTER TABLE `formas_pagamento` DISABLE KEYS */;
INSERT INTO `formas_pagamento` VALUES (2,'Cartão Débito'),(5,'Dinheiro'),(6,'Pix - A vista'),(7,'Cartão Crédito');
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` VALUES (1,0.00,'Dinheiro',4,'2133213213'),(2,0.00,'Pix - A vista',5,'213321321'),(3,0.00,'Cartão Crédito',6,'21332132'),(4,0.00,'Cartão Crédito',7,'AER4556'),(5,0.00,'Cartão Crédito',9,'WETWEWT'),(6,0.00,'Cartão Crédito',8,'DADADSAS'),(7,0.00,'Cartão Crédito',10,'WETWEWTR'),(8,0.00,'Cartão Crédito',1,'AEB55448'),(9,0.00,'Cartão Crédito',1,'AEB55448'),(10,0.00,'Cartão Crédito',1,''),(11,0.00,'Cartão Crédito',2,''),(12,0.00,'Cartão Crédito',3,'AEF250AAV'),(13,0.00,'Cartão Crédito',3,'AEF250AAV'),(14,0.00,'Cartão Crédito',3,'AEF250AAV'),(15,0.00,'Cartão Crédito',3,'AEF250AAV'),(16,0.00,'Cartão Crédito',3,'AEF250AAV'),(17,0.00,'Cartão Crédito',3,'AEF250AAV'),(18,0.00,'Cartão Crédito',4,'2133213213'),(19,0.00,'Cartão Crédito',5,'213321321'),(20,0.00,'Cartão Crédito',5,'213321321'),(21,0.00,'Cartão Crédito',5,'213321321'),(22,0.00,'Cartão Crédito',5,'213321321'),(23,0.00,'Cartão Crédito',6,'21332132'),(24,0.00,'Cartão Crédito',6,'21332132'),(25,0.00,'Cartão Crédito',6,'21332132'),(26,0.00,'Cartão Crédito',6,'21332132'),(27,57.13,'Cartão Crédito',6,'21332132'),(28,70.42,'Dinheiro',7,'AER4556'),(29,1.17,'Cartão Crédito',11,'GOL3030'),(30,1.17,'Cartão Crédito',12,'GOL3031'),(31,0.00,'Cartão Crédito',15,'FUSCA30'),(32,2.08,'Cartão Crédito',14,'GOL3035');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Admin','admin','21232f297a57a5a743894a0e4a801fc3','Administrador'),(5,'jeferson','jeferson@email.com','202cb962ac59075b964b07152d234b70','Operador'),(6,'matheus','matheus@email.com','202cb962ac59075b964b07152d234b70','Operador');
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
  `cor` varchar(30) DEFAULT NULL,
  `tamanho` varchar(10) DEFAULT NULL,
  `nome_categoria` varchar(50) DEFAULT NULL,
  `estacionado` varchar(5) DEFAULT NULL,
  `data_entrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_saida` datetime DEFAULT NULL,
  PRIMARY KEY (`id_veiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` VALUES (17,'GOL2022','GOL2022',NULL,'medio','Automóvel','sim','2022-06-10 23:12:13',NULL);
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

-- Dump completed on 2022-06-10 20:20:20
