-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: project
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
  PRIMARY KEY (`ingr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (203,'butter'),(204,'sugar'),(205,'eggs'),(206,'hot water'),(207,'yeast'),(208,''),(209,'bangus'),(210,'ginger'),(211,'k'),(212,'cups'),(213,'fishes'),(214,'tilapia');
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
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (24,45,1,'2012-07-26 15:33:38',NULL),(25,45,2,'2012-07-26 16:00:12',NULL),(26,45,4,'2012-07-26 16:11:36',NULL),(27,45,4,'2012-07-26 16:11:46',NULL),(28,45,5,'2012-07-26 16:15:48',NULL),(32,45,4,'2012-07-26 16:51:27',NULL),(35,51,1,'2012-07-26 17:08:15',NULL),(36,51,2,'2012-07-26 17:08:24',NULL),(37,51,5,'2012-07-26 17:09:56',NULL),(38,51,6,'2012-07-26 17:11:23',NULL),(39,51,4,'2012-07-26 17:13:54',NULL),(40,51,2,'2012-07-26 17:15:57',NULL),(41,52,1,'2012-07-27 12:08:27',NULL),(42,52,2,'2012-07-27 12:08:39',NULL),(43,53,1,'2012-07-27 12:55:27',NULL),(44,53,2,'2012-07-27 13:06:06',NULL),(45,28,2,'2012-07-27 13:06:20',NULL),(46,28,4,'2012-07-27 13:23:38','192.168.1.2'),(47,28,4,'2012-07-27 13:27:36','192.168.1.2'),(48,28,6,'2012-07-27 13:29:11','192.168.1.2'),(49,28,6,'2012-07-27 13:30:22','192.168.1.2'),(50,28,4,'2012-07-27 13:31:14','192.168.1.2'),(51,28,3,'2012-07-27 13:31:38','192.168.1.2'),(52,54,1,'2012-07-27 14:10:39','192.168.1.2'),(53,55,1,'2012-07-27 14:11:34','192.168.1.2'),(54,56,1,'2012-07-27 14:12:47','192.168.1.2'),(55,57,1,'2012-07-27 14:17:04','192.168.1.2'),(56,58,1,'2012-07-27 14:17:47','192.168.1.2'),(57,59,1,'2012-07-27 14:22:05','192.168.1.2'),(58,60,1,'2012-07-27 14:26:04','192.168.1.2'),(59,60,2,'2012-07-27 14:26:15','192.168.1.2'),(60,28,3,'2012-07-27 14:33:25','192.168.1.5'),(61,28,4,'2012-07-27 14:33:28','192.168.1.5'),(62,28,3,'2012-07-29 14:12:44','192.168.1.8'),(63,28,3,'2012-08-01 12:36:50','192.168.1.7'),(64,28,5,'2012-08-01 12:37:25','192.168.1.7'),(65,28,4,'2012-08-01 12:43:28','192.168.1.7'),(66,28,3,'2012-08-01 12:44:01','192.168.1.7'),(67,28,4,'2012-08-01 12:44:03','192.168.1.7'),(68,61,1,'2012-08-01 12:44:52','192.168.1.7'),(69,61,2,'2012-08-01 12:47:28','192.168.1.7'),(70,28,3,'2012-08-01 17:10:17','192.168.1.19'),(71,28,4,'2012-08-01 17:10:27','192.168.1.19'),(72,28,3,'2012-08-02 13:24:51','192.168.1.4'),(73,28,3,'2012-08-03 16:18:56','192.168.1.5'),(74,28,3,'2012-08-03 19:46:22','192.168.1.5'),(75,28,3,'2012-08-04 20:33:24','192.168.1.11'),(76,28,3,'2012-08-06 11:09:04','192.168.1.5'),(77,28,3,'2012-08-06 17:45:50','192.168.1.5'),(78,28,3,'2012-08-06 19:06:44','192.168.1.5'),(79,28,3,'2012-08-07 10:16:51','192.168.1.5'),(80,28,3,'2012-08-07 15:47:54','192.168.1.5'),(81,28,4,'2012-08-07 17:29:59','192.168.1.5'),(82,28,3,'2012-08-07 17:34:56','192.168.1.5'),(83,28,4,'2012-08-07 17:37:39','192.168.1.5'),(84,28,3,'2012-08-07 17:38:40','192.168.1.5'),(85,28,4,'2012-08-07 17:38:48','192.168.1.5'),(86,28,3,'2012-08-07 17:40:59','192.168.1.5'),(87,28,3,'2012-08-07 20:33:17','192.168.1.5'),(88,28,3,'2012-08-08 09:52:14','192.168.1.5'),(89,28,4,'2012-08-08 09:52:26','192.168.1.5'),(90,28,3,'2012-08-08 09:52:33','192.168.1.5'),(91,28,3,'2012-08-08 14:47:20','192.168.1.5'),(92,28,5,'2012-08-08 15:51:42','192.168.1.5'),(93,28,5,'2012-08-08 16:15:41','192.168.1.5'),(94,28,5,'2012-08-08 16:15:52','192.168.1.5'),(95,28,5,'2012-08-08 16:27:02','192.168.1.5'),(96,28,3,'2012-08-09 14:15:38','192.168.1.5'),(97,28,3,'2012-08-09 15:07:43','192.168.1.5'),(98,28,3,'2012-08-09 17:20:34','192.168.1.3'),(99,28,3,'2012-08-10 09:28:50','192.168.1.5'),(100,28,3,'2012-08-10 17:08:39','192.168.1.5'),(101,28,3,'2012-08-10 23:18:19','192.168.1.21'),(102,28,3,'2012-08-11 23:10:16','192.168.1.21'),(103,28,3,'2012-08-12 10:23:30','192.168.1.21'),(104,28,3,'2012-08-12 11:16:39','192.168.1.21'),(105,28,3,'2012-08-13 16:57:17','192.168.1.3'),(106,28,3,'2012-08-13 17:40:15','192.168.1.3'),(107,28,3,'2012-08-14 17:06:28','192.168.1.142'),(108,28,3,'2012-08-14 19:59:26','192.168.1.145'),(109,28,3,'2012-08-15 11:00:54','192.168.1.142'),(110,28,4,'2012-08-15 15:35:48','192.168.1.142'),(111,28,3,'2012-08-15 15:54:03','192.168.1.142'),(112,28,4,'2012-08-15 15:56:57','192.168.1.142'),(113,28,3,'2012-08-15 15:58:04','192.168.1.142'),(114,28,4,'2012-08-15 15:58:07','192.168.1.142'),(115,28,3,'2012-08-15 16:01:59','192.168.1.142'),(116,28,4,'2012-08-15 16:05:37','192.168.1.142'),(117,28,3,'2012-08-15 16:05:48','192.168.1.142'),(118,28,4,'2012-08-15 16:07:54','192.168.1.142'),(119,28,3,'2012-08-15 16:08:07','192.168.1.142'),(120,28,4,'2012-08-15 16:19:02','192.168.1.142'),(121,28,3,'2012-08-15 16:45:00','192.168.1.142'),(122,28,3,'2012-08-16 11:44:55','192.168.1.142'),(123,28,4,'2012-08-16 12:02:49','192.168.1.142'),(124,28,3,'2012-08-17 14:04:44','192.168.1.142'),(125,28,3,'2012-08-20 13:19:05','192.168.1.145'),(126,28,4,'2012-08-20 13:26:38','192.168.1.145'),(127,28,3,'2012-08-20 13:28:03','192.168.1.145'),(128,28,3,'2012-08-20 15:34:04','192.168.1.145'),(129,28,3,'2012-08-21 15:11:30','192.168.1.145'),(130,28,3,'2012-08-21 16:03:53','192.168.1.145'),(131,28,3,'2012-08-22 10:06:50','192.168.1.145'),(132,28,3,'2012-08-22 15:17:26','192.168.1.145'),(133,28,7,'2012-08-22 16:24:36','192.168.1.145'),(134,28,7,'2012-08-22 16:32:01','192.168.1.145'),(135,28,7,'2012-08-22 16:32:46','192.168.1.145');
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
INSERT INTO `rec_ing` VALUES (101,203,'1.5',3),(101,204,'1',3),(101,205,'2',5),(101,206,'1',3),(101,207,'.75',3),(101,208,'',1),(102,209,'1',1),(102,210,'2',5),(103,208,'',1),(104,208,'',1),(104,211,'',1),(105,212,'3',1),(107,213,'1',1),(108,214,'2',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES (101,'Cinnamons','Combine potatoes, potato water, butter, sugar, salt and hot water in large mixing bowl. Stir until butter melts; set aside and let cool. Combine yeast and 1/2 cup warm water in small bowl. Let rest 5 minutes. Add eggs, 2 cups flour and yeast mixture to potato mixture. Beat until well mixed. Continue adding flour, 1 cup at a time until soft dough forms.\r\nKnead on a lightly floured surface until smooth and elastic (about 4 to 6 minutes), OR knead with electric mixer using dough hook. Place in a greased bowl, turning to coat. Cover.\r\nLet rise in a warm, draft free area about 1 hour, until doubled in size. Punch dough down; divide in half.\r\nRoll one portion of dough on a lightly floured surface to a 12 x 18-inch rectangle. Spread with half the butter. Combine sugar and cinnamon; sprinkle half of the mixture over surface. Roll up tightly lengthwise, sealing edges. Cut into 12 slices. Place in greased 13 x 9-inch pan. Repeat with remaining dough. Cover.\r\nLet rise 30 to 45 minutes until nearly doubled.\r\nBake in preheated 350 degrees F oven for 25 to 30 minutes.\r\nCool for 15 minutes. Combine icing ingredients and drizzle over rolls.',NULL,28,'2012-08-20 16:19:41'),(102,'fish','cooked',NULL,28,'2012-08-21 16:49:53'),(103,'mkm','kmkm',NULL,28,'2012-08-22 15:59:12'),(104,'mkmo0','kmkm',NULL,28,'2012-08-22 15:59:42'),(105,'chicken','cdscsdcsc',NULL,28,'2012-08-22 16:23:27'),(106,'chicken','cdscsdcsc',NULL,28,'2012-08-22 16:24:36'),(107,'tilapia','vsdvsdvs',NULL,28,'2012-08-22 16:32:01'),(108,'tilapia2','csd',NULL,28,'2012-08-22 16:32:46');
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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (28,'ronald','f2b3c14978b6f6706a6f9216e6138331','ron.ongjoco@gmail.com','RONALD','ONGJOCO-edit',NULL,'1982-12-12','M',1),(45,'ronald3','98652834c01c25e1d5488d0a90ec7082','r.on.ongjoco@gmail.com','ROnald','Ongjoco',NULL,'1982-12-12','M',0),(51,'qwerty12','f2b3c14978b6f6706a6f9216e6138331','r.o.n.ongjoco@gmail.com','ROnald','Ongjoco',NULL,'1982-12-12','F',1),(52,'ronald8','98652834c01c25e1d5488d0a90ec7082','ron.on.g.jo.co@gmail.com',NULL,NULL,NULL,NULL,NULL,1),(53,'ronald9','98652834c01c25e1d5488d0a90ec7082','ro.n.on.g.jo.co@gmail.com',NULL,NULL,NULL,NULL,NULL,1),(54,'qwerty1','98652834c01c25e1d5488d0a90ec7082','r@gmail.com',NULL,NULL,NULL,NULL,NULL,0),(55,'qwerty','98652834c01c25e1d5488d0a90ec7082','rt@gmail.com',NULL,NULL,NULL,NULL,NULL,0),(56,'qwert','98652834c01c25e1d5488d0a90ec7082','r_ongjoco@yahoo.com',NULL,NULL,NULL,NULL,NULL,0),(57,'qwer','98652834c01c25e1d5488d0a90ec7082','r.t@gmail.com',NULL,NULL,NULL,NULL,NULL,0),(58,'qwe','98652834c01c25e1d5488d0a90ec7082','rqq@gmail.com',NULL,NULL,NULL,NULL,NULL,0),(59,'qw','98652834c01c25e1d5488d0a90ec7082','ron.ongjoco+test@gmail.com',NULL,NULL,NULL,NULL,NULL,0),(60,'qwertyu','98652834c01c25e1d5488d0a90ec7082','ron.ongjoco+te@gmail.com',NULL,NULL,NULL,NULL,NULL,1),(61,'ronald11','f2b3c14978b6f6706a6f9216e6138331','ron.ongjoco++@gmail.com',NULL,NULL,NULL,NULL,NULL,1);
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

-- Dump completed on 2012-08-23 12:45:40
