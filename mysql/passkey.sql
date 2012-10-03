DROP TABLE IF EXISTS `passkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passkey` (
  `passkey` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  CONSTRAINT `passkey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
