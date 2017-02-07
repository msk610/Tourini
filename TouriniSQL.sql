-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tourini
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `attractions`
--

DROP TABLE IF EXISTS `attractions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attractions` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `aname` varchar(45) NOT NULL,
  PRIMARY KEY (`aid`,`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attractions`
--

LOCK TABLES `attractions` WRITE;
/*!40000 ALTER TABLE `attractions` DISABLE KEYS */;
/*!40000 ALTER TABLE `attractions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `circles`
--

DROP TABLE IF EXISTS `circles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `circles` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `circle_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cid`,`uid1`,`uid2`),
  KEY `uid2__idx` (`uid2`),
  KEY `uid1_` (`uid1`),
  CONSTRAINT `uid1_` FOREIGN KEY (`uid1`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `uid2_` FOREIGN KEY (`uid2`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `circles`
--

LOCK TABLES `circles` WRITE;
/*!40000 ALTER TABLE `circles` DISABLE KEYS */;
INSERT INTO `circles` VALUES (105,1,9,'FAMILY'),(106,1,37,'FAMILY'),(109,1,28,'FAMILY'),(110,1,26,'FAMILY'),(114,1,28,'YO'),(115,1,26,'YO'),(116,1,9,'YO'),(117,39,1,'NYUCIRCLE');
/*!40000 ALTER TABLE `circles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `request` int(11) DEFAULT NULL,
  `requestTime` timestamp(2) NULL DEFAULT NULL,
  PRIMARY KEY (`uid1`,`uid2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (1,1,1,'2016-05-12 08:44:32.00'),(1,6,1,'2016-05-11 17:30:15.00'),(1,7,NULL,'2016-05-12 18:35:21.00'),(1,8,NULL,'2016-05-12 18:35:22.00'),(1,9,1,'2016-05-11 14:38:46.00'),(1,26,1,'2016-05-11 14:56:25.00'),(1,28,1,'2016-05-11 14:56:48.00'),(1,33,1,'2016-05-11 14:39:19.00'),(1,34,NULL,'2016-05-12 09:00:58.00'),(1,36,1,'2016-05-11 17:41:00.00'),(1,37,1,'2016-05-12 15:15:25.00'),(9,1,1,'2016-05-12 06:39:25.00'),(9,6,1,'2016-05-11 16:59:09.00'),(9,7,NULL,'2016-05-12 14:35:30.00'),(9,8,1,'2016-05-11 16:59:41.00'),(9,9,1,'2016-05-12 14:34:50.00'),(9,26,1,'2016-05-11 16:59:38.00'),(9,33,1,'2016-05-11 15:46:18.00'),(9,38,1,'2016-05-12 15:18:19.00'),(28,9,1,'2016-05-11 16:15:24.00'),(34,1,1,'2016-05-11 17:28:02.00'),(35,36,1,'2016-05-11 17:40:10.00'),(37,9,1,'2016-05-12 15:16:52.00'),(37,38,1,'2016-05-12 04:15:00.00'),(38,1,1,'2016-05-12 17:24:50.00'),(38,6,NULL,'2016-05-12 16:20:52.00'),(38,9,NULL,'2016-05-12 16:20:56.00'),(39,1,1,'2016-05-14 00:35:31.00');
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupmembers`
--

DROP TABLE IF EXISTS `groupmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupmembers` (
  `gid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupmembers`
--

LOCK TABLES `groupmembers` WRITE;
/*!40000 ALTER TABLE `groupmembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `groupmembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `longitude` decimal(3,0) NOT NULL,
  `latitude` decimal(3,0) NOT NULL,
  `city` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `privacy` int(11) DEFAULT NULL,
  PRIMARY KEY (`lid`,`longitude`,`latitude`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (2,NULL,40,-73,'USA','USA',NULL),(3,NULL,40,-73,'USA','USA',NULL),(4,NULL,40,-73,'USA','USA',NULL),(5,NULL,40,-73,'USA','USA',NULL),(6,NULL,40,-73,'USA','USA',NULL),(7,NULL,40,-73,'USA','USA',NULL),(8,NULL,40,-73,'USA','USA',NULL),(9,NULL,40,-73,'USA','USA',NULL),(10,NULL,40,-73,'USA','USA',NULL),(11,NULL,40,-73,'USA','USA',NULL),(12,NULL,40,-73,'USA','USA',NULL),(13,NULL,40,-73,'BROOKLYN','USA',NULL),(14,NULL,40,-73,'BROOKLYN','USA',NULL),(15,NULL,40,-73,'BROOKLYN','USA',NULL),(16,9,-73,40,'BROOKLYN','USA',NULL),(17,1,-73,40,'NEW YORK','USA',NULL),(18,1,0,0,'','USA',NULL),(19,39,-73,40,'NEW YORK','USA',NULL);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `message` varchar(145) NOT NULL,
  `timeSent` timestamp NULL DEFAULT NULL,
  `lid` int(11) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `lid__idx` (`lid`),
  CONSTRAINT `lid_` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,1,'message here','2016-05-12 09:25:29',NULL),(2,1,'let\'s see what happens','2016-05-12 13:27:42',NULL),(3,1,'this is my journal entry','2016-05-12 13:38:22',NULL),(4,9,'dsf','2016-05-12 14:05:04',NULL),(5,9,'asdf','2016-05-12 14:06:16',NULL),(6,9,'asd','2016-05-12 14:13:20',NULL),(7,1,'we are done!','2016-05-14 00:13:26',NULL),(8,39,'<br> hello','2016-05-14 00:45:43',NULL),(9,39,'<br> hello','2016-05-14 00:45:50',NULL);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `mid` int(11) NOT NULL,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `message` varchar(140) NOT NULL,
  `timeSent` timestamp(2) NULL DEFAULT NULL,
  `lid` int(11) DEFAULT NULL,
  PRIMARY KEY (`mid`,`uid1`,`uid2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `timeTaken` timestamp(2) NULL DEFAULT NULL,
  `caption` varchar(45) DEFAULT NULL,
  `privacy` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (2,NULL,NULL,'2016-05-12 13:15:17.00','HTTP://I.IMGUR.COM/PYYTPPG.PNG',NULL),(4,NULL,NULL,'2016-05-12 13:16:08.00','http://i.imgur.com/zz4FZgC.png',NULL),(5,NULL,NULL,'2016-05-12 13:38:32.00','http://i.imgur.com/Qbcx7us.png',NULL),(6,NULL,NULL,'2016-05-12 13:41:37.00','http://i.imgur.com/Qbcx7us.png',NULL),(7,NULL,NULL,'2016-05-12 13:46:57.00','http://i.imgur.com/tItjSsI.png',NULL),(8,NULL,9,'2016-05-12 14:18:10.00','http://i.imgur.com/EvIZimX.png',NULL),(9,NULL,1,'2016-05-13 01:50:47.00','http://i.imgur.com/3GOzfSR.png',NULL),(11,NULL,1,'2016-05-13 23:53:56.00','http://i.imgur.com/Qgs4sMn.png',NULL),(12,NULL,39,'2016-05-14 00:40:06.00','http://i.imgur.com/wval0Oe.jpg',NULL);
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `profilePic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'jbanna','passhere','jason','rosenstein','1993-11-15',0,'https://i.imgur.com/kiFjKy1.png'),(6,'anothertest','asdfg','abc','def','1253-12-24',0,'http://i.imgur.com/01P5h3b.jpg'),(7,'alexvan','asdfg','alex','vanderbilto','2122-12-12',0,'http://i.imgur.com/lMZZ1Nx.jpg'),(8,'blahblah','password','alex','blahblah','2012-12-12',0,'http://i.imgur.com/5d86nSX.jpg'),(9,'marissa','tigger73','Marissa','Roer','1992-10-09',1,'http://i.imgur.com/ZCXQ1tb.jpg'),(26,'abraham','asdfg','a','l','2000-12-12',1,'http://i.imgur.com/hGPj1gn.png'),(27,'cookies','cookie','cookie','monster','2000-12-01',0,'http://i.imgur.com/I3qFgSk.png'),(28,'lockchain','lockchain','lock','chain','2000-01-01',2,'http://i.imgur.com/aBYKmsg.png'),(30,'test','tester','test','test','2000-01-02',2,'http://i.imgur.com/TqwvZwd.png'),(31,'abcdef','asdfg','a','b','2000-02-02',1,'http://i.imgur.com/Pmks9Zp.png'),(32,'testing','testing','t','t','2900-01-02',1,'http://i.imgur.com/hGPj1gn.png'),(33,'mak619','mdkabir','md','kabir','1996-12-05',0,'http://i.imgur.com/4feOMKt.png'),(34,'asdfg','asdfg','asdfg','asdfg','3000-01-01',1,'http://i.imgur.com/hGPj1gn.png'),(35,'qwerty','qwerty','q','q','2000-01-01',0,'http://i.imgur.com/hGPj1gn.png'),(36,'tyuiop','tyuiop','t','t','2000-01-01',1,'http://i.imgur.com/hGPj1gn.png'),(37,'ippy','asdfg','ippy','thecat','2013-05-12',0,'http://i.imgur.com/uSqqfA1.png'),(38,'mellie','asdfg','mellie','thecat','2013-02-02',1,'http://i.imgur.com/pqTM7eM.png'),(39,'hellodb','asdfg','hello','db','1990-01-11',0,'http://i.imgur.com/dRzDPTr.png');
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

-- Dump completed on 2016-05-13 17:48:08
