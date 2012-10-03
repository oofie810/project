-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Recipes
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
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `ingr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ingr_id`),
  UNIQUE KEY `ingredient` (`ingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (5,'bl1'),(3,'bla'),(4,'bla1'),(9,'evh'),(6,'l1'),(2,'pepper'),(1,'salt'),(7,'seventh'),(8,'sevh'),(10,'vfweh');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `ip_addr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`),
  KEY `action` (`action`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`action`) REFERENCES `log_action` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,1,4,'2012-10-01 17:37:27','192.168.1.132'),(2,1,4,'2012-10-01 17:43:48','192.168.1.132'),(3,1,3,'2012-10-01 17:45:18','192.168.1.132'),(4,1,4,'2012-10-01 18:04:56','192.168.1.132'),(5,3,1,'2012-10-01 18:05:11','192.168.1.132'),(6,1,3,'2012-10-01 18:06:34','192.168.1.132'),(7,1,7,'2012-10-01 18:10:25','192.168.1.132'),(8,1,3,'2012-10-01 19:27:57','192.168.1.132'),(9,1,7,'2012-10-01 19:28:05','192.168.1.132'),(10,1,3,'2012-10-01 19:49:22','192.168.1.121'),(11,1,7,'2012-10-01 20:28:26','192.168.1.121'),(12,1,7,'2012-10-01 20:30:05','192.168.1.121'),(13,1,7,'2012-10-01 20:32:25','192.168.1.121'),(14,1,7,'2012-10-01 20:33:06','192.168.1.121'),(15,1,7,'2012-10-01 20:33:49','192.168.1.121'),(16,1,7,'2012-10-01 20:36:00','192.168.1.121'),(17,1,7,'2012-10-01 20:37:38','192.168.1.121'),(18,1,7,'2012-10-01 20:39:16','192.168.1.121'),(19,1,7,'2012-10-01 20:40:29','192.168.1.121'),(20,1,7,'2012-10-01 20:43:30','192.168.1.121'),(21,1,7,'2012-10-01 20:45:03','192.168.1.121'),(22,1,7,'2012-10-01 20:46:38','192.168.1.121'),(23,1,7,'2012-10-01 20:49:36','192.168.1.121'),(24,1,7,'2012-10-01 20:51:33','192.168.1.121'),(25,1,7,'2012-10-01 21:00:49','192.168.1.121'),(26,1,7,'2012-10-01 21:06:38','192.168.1.121'),(27,1,7,'2012-10-01 21:07:34','192.168.1.121'),(28,1,7,'2012-10-01 21:09:25','192.168.1.121'),(29,1,7,'2012-10-01 21:11:02','192.168.1.121'),(30,1,7,'2012-10-01 21:14:02','192.168.1.121'),(31,1,7,'2012-10-01 21:21:37','192.168.1.121'),(32,1,7,'2012-10-01 21:25:00','192.168.1.121'),(33,1,7,'2012-10-01 21:26:47','192.168.1.121');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_action`
--

DROP TABLE IF EXISTS `log_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_action` (
  `action_id` int(11) NOT NULL DEFAULT '0',
  `action` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_action`
--

LOCK TABLES `log_action` WRITE;
/*!40000 ALTER TABLE `log_action` DISABLE KEYS */;
INSERT INTO `log_action` VALUES (1,'Create Account'),(2,'Activate Account'),(3,'Log In'),(4,'Log Out'),(5,'Edit Profile'),(6,'Change Password'),(7,'Submit Recipe');
/*!40000 ALTER TABLE `log_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passkey`
--

DROP TABLE IF EXISTS `passkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passkey` (
  `passkey` varchar(32) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `passkey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passkey`
--

LOCK TABLES `passkey` WRITE;
/*!40000 ALTER TABLE `passkey` DISABLE KEYS */;
INSERT INTO `passkey` VALUES ('a1e3b7c93459b727189bd339640a718e',1,'2012-10-01 17:26:30'),('31a5154104c20105266ed7d9bfb99cb1',2,'2012-10-01 17:37:47'),('aa2541fd97677e8693a0488d377f837b',3,'2012-10-01 18:05:11');
/*!40000 ALTER TABLE `passkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rec_ing`
--

DROP TABLE IF EXISTS `rec_ing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rec_ing` (
  `rec_id` int(11) NOT NULL DEFAULT '0',
  `ingr_id` int(11) NOT NULL DEFAULT '0',
  `amount` varchar(10) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  PRIMARY KEY (`rec_id`,`ingr_id`),
  KEY `ingr_id` (`ingr_id`),
  CONSTRAINT `rec_ing_ibfk_1` FOREIGN KEY (`rec_id`) REFERENCES `recipe` (`rec_id`),
  CONSTRAINT `rec_ing_ibfk_2` FOREIGN KEY (`ingr_id`) REFERENCES `ingredients` (`ingr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rec_ing`
--

LOCK TABLES `rec_ing` WRITE;
/*!40000 ALTER TABLE `rec_ing` DISABLE KEYS */;
INSERT INTO `rec_ing` VALUES (1,1,'3',3),(1,2,'3',3),(2,1,'3',3),(2,2,'3',3),(3,1,'3',3),(3,2,'3',3),(4,1,'3',3),(4,2,'3',3),(5,1,'3',3),(5,2,'3',3),(6,1,'3',3),(6,2,'3',3),(17,1,'3',3),(17,2,'3',3),(17,3,'4',4),(18,1,'3',3),(18,2,'3',3),(18,3,'4',4),(19,1,'3',3),(19,2,'3',3),(19,4,'4',4),(20,1,'3',3),(20,2,'3',3),(20,4,'4',4),(21,1,'3',3),(21,2,'3',3),(21,5,'4',4),(22,1,'3',3),(22,2,'3',3),(22,6,'4',4),(23,1,'3',3),(23,2,'3',3),(23,8,'4',4),(24,1,'3',3),(24,2,'3',3),(24,9,'4',4),(25,1,'3',3),(25,2,'3',3),(25,10,'4',4);
/*!40000 ALTER TABLE `rec_ing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_name` varchar(255) DEFAULT NULL,
  `directions` text,
  `num_ingr` int(11) DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (1,'Recipe - test','Directions -test',NULL,1,'2012-10-01 18:10:25'),(2,'qwrqw','fqw',NULL,1,'2012-10-01 19:28:05'),(3,'re','fewfew',NULL,1,'2012-10-01 20:28:26'),(4,'f','1',NULL,1,'2012-10-01 20:30:04'),(5,'ddw','cw',NULL,1,'2012-10-01 20:32:25'),(6,'cw','vew',NULL,1,'2012-10-01 20:33:06'),(7,'ewf','fwe',NULL,1,'2012-10-01 20:33:49'),(8,'wev','few',NULL,1,'2012-10-01 20:36:00'),(9,'v','ewv',NULL,1,'2012-10-01 20:37:38'),(10,'r11','f23f',NULL,1,'2012-10-01 20:39:16'),(11,'wq','cew',NULL,1,'2012-10-01 20:40:29'),(12,'12','12',NULL,1,'2012-10-01 20:43:30'),(13,'e','vew',NULL,1,'2012-10-01 20:45:03'),(14,'wecwe','few',NULL,1,'2012-10-01 20:46:38'),(15,'cwe','few',NULL,1,'2012-10-01 20:49:36'),(16,'1','12',NULL,1,'2012-10-01 20:51:32'),(17,'12','12',NULL,1,'2012-10-01 21:00:49'),(18,'cqw','ewcwec',NULL,1,'2012-10-01 21:06:37'),(19,'few','we',NULL,1,'2012-10-01 21:07:34'),(20,'123','312',NULL,1,'2012-10-01 21:09:25'),(21,'d1','d23',NULL,1,'2012-10-01 21:11:02'),(22,'12','r3f32',NULL,1,'2012-10-01 21:14:02'),(23,'ew','cew',NULL,1,'2012-10-01 21:21:37'),(24,'qwe','r23r23',NULL,1,'2012-10-01 21:25:00'),(25,'fwef','fewfwe',NULL,1,'2012-10-01 21:26:47');
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status` int(1) DEFAULT NULL,
  `status_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `units` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'tsp'),(2,'tbsp'),(3,'cup/s'),(4,'lb/s'),(5,'piece/s');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ronald','98652834c01c25e1d5488d0a90ec7082','ron.ongjoco@gmail.com',NULL,NULL,NULL,NULL,NULL,1),(2,'ronald1','98652834c01c25e1d5488d0a90ec7082','ron.ongjoco++@gmail.com',NULL,NULL,NULL,NULL,NULL,0),(3,'ronald12','98652834c01c25e1d5488d0a90ec7082','ron.ongjo+++++co@gmail.com',NULL,NULL,NULL,NULL,NULL,0);
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

-- Dump completed on 2012-10-02 16:40:57
