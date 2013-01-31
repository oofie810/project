-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: recipe
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `action_log`
--

DROP TABLE IF EXISTS `action_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `log_ibfk_1` (`user_id`),
  KEY `log_ibfk_2` (`action_id`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`action_id`) REFERENCES `action_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_log`
--

LOCK TABLES `action_log` WRITE;
/*!40000 ALTER TABLE `action_log` DISABLE KEYS */;
INSERT INTO `action_log` VALUES (1,9,3,'2012-10-04 15:48:00','192.168.1.132'),(2,9,4,'2012-10-04 15:48:07','192.168.1.132'),(3,9,3,'2012-10-04 16:20:43','192.168.1.132'),(4,9,7,'2012-10-04 16:21:58','192.168.1.132'),(5,9,7,'2012-10-04 16:23:36','192.168.1.132'),(6,9,7,'2012-10-04 16:24:47','192.168.1.132'),(7,9,7,'2012-10-04 16:26:31','192.168.1.132'),(8,9,7,'2012-10-04 16:27:30','192.168.1.132'),(9,9,7,'2012-10-04 16:30:01','192.168.1.132'),(10,9,7,'2012-10-04 16:36:02','192.168.1.132'),(11,9,7,'2012-10-04 16:38:13','192.168.1.132'),(12,9,7,'2012-10-04 16:39:19','192.168.1.132'),(13,9,7,'2012-10-04 16:41:49','192.168.1.132'),(14,9,7,'2012-10-04 16:45:52','192.168.1.132'),(15,9,7,'2012-10-04 16:52:14','192.168.1.132'),(16,9,7,'2012-10-04 17:03:08','192.168.1.132'),(17,9,7,'2012-10-04 17:04:38','192.168.1.132'),(18,9,3,'2012-10-04 17:52:56','192.168.1.132'),(19,9,7,'2012-10-04 17:59:06','192.168.1.132'),(20,9,3,'2012-10-04 20:07:26','192.168.1.132'),(21,9,7,'2012-10-04 20:19:51','192.168.1.132'),(22,9,7,'2012-10-04 20:23:03','192.168.1.132'),(23,9,7,'2012-10-04 20:28:30','192.168.1.132'),(24,9,7,'2012-10-04 20:45:47','192.168.1.132'),(25,9,7,'2012-10-04 20:45:49','192.168.1.132'),(26,9,7,'2012-10-04 20:45:50','192.168.1.132'),(27,9,3,'2012-10-08 16:04:05','192.168.1.132'),(28,9,4,'2012-10-08 16:11:56','192.168.1.132'),(29,9,3,'2012-10-08 16:12:03','192.168.1.132'),(30,9,4,'2012-10-08 16:13:35','192.168.1.132'),(31,9,3,'2012-10-08 16:13:48','192.168.1.132'),(32,9,4,'2012-10-08 17:17:52','192.168.1.132'),(33,9,3,'2012-10-08 17:20:26','192.168.1.132'),(34,9,7,'2012-10-08 17:51:10','192.168.1.132'),(35,9,3,'2012-10-08 18:45:02','192.168.1.132'),(36,9,4,'2012-10-08 18:57:36','192.168.1.132'),(37,9,3,'2012-10-10 22:56:43','192.168.1.142'),(38,9,3,'2012-10-11 11:08:21','192.168.1.132'),(39,9,5,'2012-10-11 11:09:45','192.168.1.132'),(40,9,5,'2012-10-11 11:19:55','192.168.1.132'),(41,9,5,'2012-10-11 11:20:39','192.168.1.132'),(42,9,5,'2012-10-11 11:25:37','192.168.1.132'),(43,9,5,'2012-10-11 11:27:48','192.168.1.132'),(44,9,5,'2012-10-11 11:29:05','192.168.1.132'),(45,9,5,'2012-10-11 11:31:06','192.168.1.132'),(46,9,5,'2012-10-11 11:57:04','192.168.1.132'),(47,9,5,'2012-10-11 11:58:11','192.168.1.132'),(48,9,5,'2012-10-11 11:59:11','192.168.1.132'),(49,9,5,'2012-10-11 12:00:35','192.168.1.132'),(50,9,5,'2012-10-11 12:01:37','192.168.1.132'),(51,9,5,'2012-10-11 12:02:22','192.168.1.132'),(52,9,5,'2012-10-11 12:02:59','192.168.1.132'),(53,9,5,'2012-10-11 12:04:09','192.168.1.132'),(54,9,5,'2012-10-11 12:04:54','192.168.1.132'),(55,9,5,'2012-10-11 12:05:41','192.168.1.132'),(56,9,5,'2012-10-11 12:06:13','192.168.1.132'),(57,9,5,'2012-10-11 12:07:20','192.168.1.132'),(58,9,5,'2012-10-11 12:08:35','192.168.1.132'),(59,9,5,'2012-10-11 12:09:03','192.168.1.132'),(60,9,5,'2012-10-11 12:09:59','192.168.1.132'),(61,9,5,'2012-10-11 12:10:56','192.168.1.132'),(62,9,5,'2012-10-11 12:11:56','192.168.1.132'),(63,9,5,'2012-10-11 12:12:05','192.168.1.132'),(64,9,5,'2012-10-11 12:12:55','192.168.1.132'),(65,9,5,'2012-10-11 12:14:39','192.168.1.132'),(66,9,5,'2012-10-11 12:15:14','192.168.1.132'),(67,9,5,'2012-10-11 12:15:32','192.168.1.132'),(68,9,5,'2012-10-11 12:15:55','192.168.1.132'),(69,9,5,'2012-10-11 12:17:16','192.168.1.132'),(70,9,5,'2012-10-11 12:18:39','192.168.1.132'),(71,9,5,'2012-10-11 12:18:53','192.168.1.132'),(72,9,5,'2012-10-11 12:22:56','192.168.1.132'),(73,9,5,'2012-10-11 12:23:39','192.168.1.132'),(74,9,5,'2012-10-11 12:24:12','192.168.1.132'),(75,9,5,'2012-10-11 12:24:29','192.168.1.132'),(76,9,5,'2012-10-11 12:24:57','192.168.1.132'),(77,9,5,'2012-10-11 12:26:10','192.168.1.132'),(78,9,5,'2012-10-11 12:26:42','192.168.1.132'),(79,9,5,'2012-10-11 12:27:12','192.168.1.132'),(80,9,5,'2012-10-11 12:28:33','192.168.1.132'),(81,9,5,'2012-10-11 12:29:29','192.168.1.132'),(82,9,5,'2012-10-11 12:30:16','192.168.1.132'),(83,9,5,'2012-10-11 12:31:52','192.168.1.132'),(84,9,5,'2012-10-11 12:32:04','192.168.1.132'),(85,9,5,'2012-10-11 12:35:47','192.168.1.132'),(86,9,5,'2012-10-11 12:49:45','192.168.1.132'),(87,9,3,'2012-10-11 14:18:29','192.168.1.132'),(88,9,5,'2012-10-11 14:21:21','192.168.1.132'),(89,9,5,'2012-10-11 14:21:33','192.168.1.132'),(90,9,5,'2012-10-11 14:21:41','192.168.1.132'),(91,9,3,'2012-10-23 16:14:31','192.168.1.132'),(92,9,3,'2012-10-23 18:29:19','192.168.1.132'),(93,9,3,'2012-10-25 14:48:51','192.168.1.132'),(94,9,3,'2012-10-26 14:54:06','192.168.1.132'),(95,9,3,'2012-11-05 17:09:30','192.168.1.132'),(96,9,3,'2012-11-06 10:11:56','192.168.1.132'),(97,9,3,'2012-11-14 15:08:53','192.168.1.132'),(98,9,5,'2012-11-14 15:09:18','192.168.1.132'),(99,9,3,'2012-11-14 16:09:52','192.168.1.132'),(100,9,3,'2012-11-14 17:52:51','192.168.1.132'),(101,9,3,'2012-11-26 15:49:29','192.168.1.132'),(102,9,3,'2012-11-30 16:13:08','192.168.1.132'),(103,9,3,'2012-11-30 17:15:18','192.168.1.132'),(104,9,3,'2012-12-04 15:57:45','192.168.1.132'),(105,9,3,'2012-12-05 15:15:03','192.168.1.132'),(106,9,3,'2012-12-06 15:23:15','192.168.1.132'),(107,9,3,'2012-12-13 15:20:41','192.168.1.132'),(108,9,3,'2012-12-13 17:33:24','192.168.1.132'),(109,9,3,'2012-12-13 21:28:46','192.168.1.132');
/*!40000 ALTER TABLE `action_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `action_type`
--

DROP TABLE IF EXISTS `action_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_type`
--

LOCK TABLES `action_type` WRITE;
/*!40000 ALTER TABLE `action_type` DISABLE KEYS */;
INSERT INTO `action_type` VALUES (1,'Create Account'),(2,'Activate Account'),(3,'Log In'),(4,'Log Out'),(5,'Edit Profile'),(6,'Change Password'),(7,'Submit Recipe');
/*!40000 ALTER TABLE `action_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `displayable_images`
--

DROP TABLE IF EXISTS `displayable_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `displayable_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `resolution` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `displayable_images`
--

LOCK TABLES `displayable_images` WRITE;
/*!40000 ALTER TABLE `displayable_images` DISABLE KEYS */;
INSERT INTO `displayable_images` VALUES (1,1,'c9666f0aaeb20440dce9a582d12df9c1.jpg',1,'.jpg'),(2,2,'adccf1a7aee8727954b3a62a4589098c.jpg',1,'.jpg'),(3,3,'95e04f4d7bd4e8232b426cae08e5acc9.png',1,'.png'),(4,4,'46e559961a55da8b44c9085362782b16.jpg',1,'.jpg'),(5,5,'a3baca28c2542ce7aac8f63dc085c1d6.jpg',1,'.jpg'),(6,6,'b0ba81ae61aaecd43473cb57a17bea41.jpg',1,'.jpg'),(7,7,'68ee94991e0109cbc86e0f6d0599d5b0.jpg',1,'.jpg'),(8,8,'16935e37f12cc25fa0ed9d938419d975.jpg',1,'.jpg'),(9,9,'16935e37f12cc25fa0ed9d938419d975.jpg',1,'.jpg'),(10,10,'a9743684362e5c4485b13805cbfe1a42.jpg',1,'.jpg'),(11,11,'0f4e7769633953fb872d5bab43297323.jpg',1,'.jpg'),(12,12,'02dca5615b6160190a1d32b9ee5629c7.jpg',1,'.jpg'),(13,13,'a60efe8246d1463103f412f519f651a9.jpg',1,'.jpg'),(14,14,'461d1418c3c45b3832e1ed6a9c8cf245.png',1,'.png'),(15,15,'1a238c7024347559abe9ef0f1fb6171a.jpg',1,'.jpg'),(16,16,'19944d5a81223f5ecca21a5859fb1368.jpg',1,'.jpg'),(17,17,'8f5866659c5ecc70f9e1b364689241ca.jpg',1,'.jpg'),(18,18,'d745c7699204688b56cd0bf19fe24672.jpg',1,'.jpg'),(19,19,'5d238010cc74aa2a92b249d599676e58.png',1,'.png'),(20,0,'162833fb531548a12654d2d551630122.JPG',1,'.JPG');
/*!40000 ALTER TABLE `displayable_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submission_date` datetime NOT NULL,
  `caption` varchar(255) NOT NULL,
  `homepage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'c9666f0aaeb20440dce9a582d12df9c1.jpg',9,'2012-11-06 12:00:47','bmw',0),(2,'adccf1a7aee8727954b3a62a4589098c.jpg',9,'2012-11-06 12:00:47','bmw',0),(3,'95e04f4d7bd4e8232b426cae08e5acc9.png',9,'2012-11-06 12:00:48','bmw',0),(4,'46e559961a55da8b44c9085362782b16.jpg',9,'2012-11-06 12:04:55','bmw',1),(5,'a3baca28c2542ce7aac8f63dc085c1d6.jpg',9,'2012-11-06 12:04:55','bmw',1),(6,'b0ba81ae61aaecd43473cb57a17bea41.jpg',9,'2012-11-06 12:08:07','first',1),(7,'68ee94991e0109cbc86e0f6d0599d5b0.jpg',9,'2012-11-06 12:08:08','f',1),(8,'16935e37f12cc25fa0ed9d938419d975.jpg',9,'2012-11-06 12:10:06','gsgdsg',1),(9,'16935e37f12cc25fa0ed9d938419d975.jpg',9,'2012-11-06 12:10:06','gsgdsg',1),(10,'a9743684362e5c4485b13805cbfe1a42.jpg',9,'2012-11-06 12:12:17','bmw',1),(11,'0f4e7769633953fb872d5bab43297323.jpg',9,'2012-11-06 12:12:18','bmw',1),(12,'02dca5615b6160190a1d32b9ee5629c7.jpg',9,'2012-11-06 12:21:44','1',1),(13,'a60efe8246d1463103f412f519f651a9.jpg',9,'2012-11-06 12:21:44','1',0),(14,'461d1418c3c45b3832e1ed6a9c8cf245.png',9,'2012-11-06 12:21:44','1',1),(15,'1a238c7024347559abe9ef0f1fb6171a.jpg',9,'2012-11-06 12:23:18','z4',1),(16,'19944d5a81223f5ecca21a5859fb1368.jpg',9,'2012-11-06 12:23:18','z4',1),(17,'8f5866659c5ecc70f9e1b364689241ca.jpg',9,'2012-11-06 12:27:12','bmw',1),(18,'d745c7699204688b56cd0bf19fe24672.jpg',9,'2012-11-06 12:27:12','458',1),(19,'5d238010cc74aa2a92b249d599676e58.png',9,'2012-11-06 12:27:13','linux',1);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_to_recipe`
--

DROP TABLE IF EXISTS `image_to_recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_to_recipe` (
  `image_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`,`recipe_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `image_id` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  CONSTRAINT `recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_to_recipe`
--

LOCK TABLES `image_to_recipe` WRITE;
/*!40000 ALTER TABLE `image_to_recipe` DISABLE KEYS */;
INSERT INTO `image_to_recipe` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1);
/*!40000 ALTER TABLE `image_to_recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_type`
--

DROP TABLE IF EXISTS `image_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_type`
--

LOCK TABLES `image_type` WRITE;
/*!40000 ALTER TABLE `image_type` DISABLE KEYS */;
INSERT INTO `image_type` VALUES (1,'thumbnail');
/*!40000 ALTER TABLE `image_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
INSERT INTO `ingredient` VALUES (1,'dark chocolate'),(2,'milk chocolate'),(3,'white chocolate');
/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passkey`
--

DROP TABLE IF EXISTS `passkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passkey` (
  `passkey` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  KEY `passkey_ibfk_1` (`user_id`),
  CONSTRAINT `passkey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passkey`
--

LOCK TABLES `passkey` WRITE;
/*!40000 ALTER TABLE `passkey` DISABLE KEYS */;
/*!40000 ALTER TABLE `passkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `directions` text NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submission_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (1,'Chocolate','Mix chocolates together.',9,'2012-10-08 17:51:10');
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_to_ingredient`
--

DROP TABLE IF EXISTS `recipe_to_ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_to_ingredient` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`,`ingredient_id`),
  KEY `rec_ing_ibfk_2` (`ingredient_id`),
  KEY `rec_ing_ibfk_3` (`unit_id`),
  CONSTRAINT `rec_ing_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  CONSTRAINT `rec_ing_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`),
  CONSTRAINT `rec_ing_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_to_ingredient`
--

LOCK TABLES `recipe_to_ingredient` WRITE;
/*!40000 ALTER TABLE `recipe_to_ingredient` DISABLE KEYS */;
INSERT INTO `recipe_to_ingredient` VALUES (1,1,'1',1),(1,2,'2',2),(1,3,'3',4);
/*!40000 ALTER TABLE `recipe_to_ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resolution`
--

DROP TABLE IF EXISTS `resolution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resolution` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resolution`
--

LOCK TABLES `resolution` WRITE;
/*!40000 ALTER TABLE `resolution` DISABLE KEYS */;
INSERT INTO `resolution` VALUES (1,'thumb'),(2,'800x600');
/*!40000 ALTER TABLE `resolution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (0,'Unconfirmed'),(1,'Confirmed');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'tsp'),(2,'tbsp'),(3,'cup/s'),(4,'lb/s'),(5,'piece/s');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `status` int(4) NOT NULL DEFAULT '0',
  `privileges` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (9,'ronald','98652834c01c25e1d5488d0a90ec7082','ron.ongjoco@gmail.com','RONALD','ONGJOCO','549.jpg','0000-00-00','M',1,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-19 12:12:08