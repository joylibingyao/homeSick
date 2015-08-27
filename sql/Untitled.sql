-- MySQL dump 10.13  Distrib 5.6.22, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: mapdb
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users_idx` (`user_id`),
  KEY `fk_comments_locations1_idx` (`location_id`),
  CONSTRAINT `fk_comments_locations1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'add comment',NULL,NULL,3,6),(2,'seoul!!!!1',NULL,NULL,3,7),(3,'new comment',NULL,NULL,3,6),(4,'brian is here',NULL,NULL,3,6),(5,'brain is here',NULL,NULL,3,7),(6,'ghghgh',NULL,NULL,3,7),(7,'comments',NULL,NULL,3,3),(8,'steve siad something',NULL,NULL,3,11),(9,'i am steve',NULL,NULL,3,11),(10,'add another comment',NULL,NULL,11,9),(18,'asf',NULL,NULL,14,9);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(45) DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Seoul',37.5667,126.967,NULL),(2,'San Francisco',37.7833,122.417,NULL),(3,'Hohhot',40.8167,111.65,NULL),(6,'San Jose, CA, USA',37.3382,-121.886,NULL),(7,'Seoul, South Korea',37.5665,126.978,NULL),(8,'',0,0,NULL),(9,'Chicago, IL, USA',41.8781,-87.6298,NULL),(10,'Laos',19.8563,102.495,'https://upload.wikimedia.org/wikipedia/commons/f/f6/LA_Dodgers.svg'),(11,'Los Angeles, CA, USA',34.0522,-118.244,'http://www.acmecd.com/citygraphics/losangeles.jpg'),(12,'Baja, Hungary',46.1818,18.9543,'https://upload.wikimedia.org/wikipedia/commons/6/60/Baja_Bug.jpg');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_locations1_idx` (`location_id`),
  CONSTRAINT `fk_users_locations1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Michael Choi','michael@choi.com','2015-07-02 17:14:23','2015-07-02 17:14:23',7,NULL),(3,'Joy Li','joy@li.com','2015-07-02 17:22:57','2015-07-02 17:22:57',3,NULL),(4,'Tuyen Chung','tuyen@chung.com','2015-07-02 17:23:44','2015-07-02 17:23:44',2,NULL),(5,'0','steve@tan.com','2015-07-03 02:54:20','2015-07-03 02:54:20',6,'adf229cdeabc4c50c007cabeb3631976'),(6,'brian','Brian@dojo.com','2015-07-03 02:57:16','2015-07-03 02:57:16',7,'adf229cdeabc4c50c007cabeb3631976'),(8,'dojo','dojo@dojo.dojo','2015-07-03 04:10:30','2015-07-03 04:10:30',6,'adf229cdeabc4c50c007cabeb3631976'),(9,'new user','sdf@dkjh.com','2015-07-03 17:26:42','2015-07-03 17:26:42',6,'d9729feb74992cc3482b350163a1a010'),(10,'new O','werwe@erqwe.com','2015-07-03 19:15:58','2015-07-03 19:15:58',8,'3fa2cbd5c1e39928ac3f14f66d134705'),(11,'tuijkhgf','abcdef@gmail.com','2015-07-03 19:22:27','2015-07-03 19:22:27',9,'696d29e0940a4957748fe3fc9efd22a3'),(12,'register','register@register.com','2015-07-03 19:30:18','2015-07-03 19:30:18',10,'3fa2cbd5c1e39928ac3f14f66d134705'),(13,'KObe','Bryant@kobe.com','2015-07-03 19:32:16','2015-07-03 19:32:16',11,'550e1bafe077ff0b0b67f4e32f29d751'),(14,'steve','steve@tung.com','2015-07-03 19:45:26','2015-07-03 19:45:26',12,'3fa2cbd5c1e39928ac3f14f66d134705');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-03 15:05:56
