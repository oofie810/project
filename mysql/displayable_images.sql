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
  /*CONSTRAINT `resolution_lookup` FOREIGN KEY (`resolution`) REFERENCES `resolution` (`id`),
  CONSTRAINT `type_of_image` FOREIGN KEY (`type`) REFERENCES `image_type` (`id`)*/
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
