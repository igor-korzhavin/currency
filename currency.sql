-- MySQL dump 10.15  Distrib 10.0.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.29-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `auctions`
--

DROP TABLE IF EXISTS `auctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auctions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_prop` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sum_to` decimal(19,4) DEFAULT NULL,
  `rate` decimal(19,4) NOT NULL,
  `comment` text,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=418 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auctions`
--

LOCK TABLES `auctions` WRITE;
/*!40000 ALTER TABLE `auctions` DISABLE KEYS */;
INSERT INTO `auctions` VALUES (398,27,7,2800.0000,28.0000,'test',3,'2017-04-23 18:33:22'),(399,27,7,2800.0000,28.0000,'ponizov',3,'2017-04-23 18:33:22'),(400,27,7,2700.0000,27.0000,'test',3,'2017-04-23 18:33:22'),(401,27,7,2700.0000,27.0000,'ponizov',3,'2017-04-23 18:33:22'),(402,27,7,2700.0000,27.0000,'test',3,'2017-04-23 18:33:58'),(403,29,7,2800.0000,28.0000,'test',3,'2017-04-23 18:37:41'),(404,29,6,2700.0000,27.0000,'ponizov',3,'2017-04-23 18:37:41'),(405,29,7,2900.0000,29.0000,'diana',3,'2017-04-23 18:37:41'),(406,29,6,2800.0000,28.0000,'diana',3,'2017-04-23 18:37:41'),(407,29,7,2950.0000,29.5000,'test',3,'2017-04-23 18:37:41'),(408,29,6,2850.0000,28.5000,'ponizov',3,'2017-04-23 18:38:20'),(409,27,7,2800.0000,28.0000,'test',6,'2017-04-23 18:41:30'),(410,24,10,1452.0000,33.0000,'diana',6,'2017-04-23 18:41:23'),(411,21,4,2650.0000,26.5000,'admin',6,'2017-04-23 18:41:18'),(412,21,4,2650.0000,26.5000,'ponizov',6,'2017-04-23 18:42:09'),(413,24,10,1452.0000,33.0000,'ponizov',6,'2017-04-23 18:41:58'),(414,27,7,2800.0000,28.0000,'ponizov',6,'2017-04-23 18:41:48'),(415,27,7,2800.0000,28.0000,'test',7,'2017-04-23 18:41:48'),(416,24,10,1452.0000,33.0000,'diana',7,'2017-04-23 18:41:58'),(417,21,4,2650.0000,26.5000,'admin',7,'2017-04-23 18:42:10');
/*!40000 ALTER TABLE `auctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_prop` int(11) DEFAULT NULL,
  `id_auction` int(11) DEFAULT NULL,
  `prop_id_pay_from` int(11) NOT NULL,
  `prop_id_pay_to` int(11) NOT NULL,
  `au_id_pay_from` int(11) NOT NULL,
  `au_id_pay_to` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (8,26,29,2,1,6,4,1,'2017-04-12 13:06:07'),(9,27,42,1,0,0,0,1,'2017-04-13 16:17:06'),(10,21,50,1,9,0,0,1,'2017-04-14 08:03:17'),(11,28,85,13,14,11,12,1,'2017-04-15 10:12:43'),(12,28,125,13,14,11,12,1,'2017-04-15 14:51:39');
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `parrent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'WM',0),(2,'WMU',1),(3,'WMR',1),(4,'WMZ',1),(5,'WME',1),(6,'PRUSD',19),(7,'PREUR',19),(8,'PRRUB',19),(9,'Yandex',0),(10,'YAMRUB',9),(11,'PM',0),(12,'PMUSD',11),(13,'PMEUR',11),(14,'BTC',0),(15,'BTCEUSD ',14),(16,'BTCERUB',14),(17,'Privat24',0),(18,'P24UAH',17),(19,'Payeer',0);
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange`
--

DROP TABLE IF EXISTS `exchange`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange`
--

LOCK TABLES `exchange` WRITE;
/*!40000 ALTER TABLE `exchange` DISABLE KEYS */;
INSERT INTO `exchange` VALUES (1,'safepay','https://safepay.com.ua/rates/export/xml'),(2,'goodobmen','https://goodobmen.com/rates.html?sType=estandarts_xml');
/*!40000 ALTER TABLE `exchange` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1491473748),('m170405_191826_create_table_auctions',1491473750),('m170405_194111_create_table_contracts',1491473750),('m170405_195032_create_table_contract_events',1491473751),('m170405_200655_create_table_payment_accounts',1491473751),('m170405_201301_create_table_propositions',1491473751),('m170405_203619_create_table_statuses',1491473752),('m170405_204059_create_table_sums',1491473752),('m170405_204453_create_table_user',1491473752),('m170405_205828_insert_in_propositions',1491473753),('m170405_210521_isert_in_user',1491473753);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parse`
--

DROP TABLE IF EXISTS `parse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_from` varchar(11) NOT NULL,
  `currency_to` varchar(11) NOT NULL,
  `rate_in` decimal(19,4) NOT NULL,
  `rate_out` decimal(19,4) NOT NULL,
  `id_exchange` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2050 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parse`
--

LOCK TABLES `parse` WRITE;
/*!40000 ALTER TABLE `parse` DISABLE KEYS */;
INSERT INTO `parse` VALUES (1976,'WMU','P24UAH',1.0000,0.9718,1),(1977,'WMZ','WME',1.0000,0.8803,1),(1978,'WMZ','WMU',1.0000,26.0300,1),(1979,'WMZ','P24UAH',1.0000,25.9201,1),(1980,'WMR','WMZ',1.0000,0.0164,1),(1981,'WMR','WME',1.0000,0.0155,1),(1982,'WMR','WMU',1.0000,0.4352,1),(1983,'WMR','P24UAH',1.0000,0.4380,1),(1984,'WME','WMZ',1.0000,1.0380,1),(1985,'WME','WMR',1.0000,60.2000,1),(1986,'WME','WMU',1.0000,26.9200,1),(1987,'WME','P24UAH',1.0000,27.4515,1),(1988,'WMU','WMZ',1.0000,0.0375,1),(1989,'WMU','WMR',1.0000,2.1800,1),(1990,'WMU','WME',1.0000,0.0343,1),(1991,'WMU','P24UAH',1.0000,0.9718,1),(1992,'YAMRUB','P24UAH',2.2890,1.0000,2),(1993,'PRRUB','PRUSD',56.4880,1.0000,2),(1994,'YAMRUB','PMEUR',63.9729,1.0000,2),(1995,'YAMRUB','OKUSD',58.3751,1.0000,2),(1996,'YAMRUB','OKRUB',1.0190,1.0000,2),(1997,'YAMRUB','BTC',71680.4406,1.0000,2),(1998,'YAMRUB','BTCEUSD',58.4630,1.0000,2),(1999,'YAMRUB','BTCERUB',1.0360,1.0000,2),(2000,'YAMRUB','ADVCUSD',58.0979,1.0000,2),(2001,'YAMRUB','PRUSD',56.7392,1.0000,2),(2002,'YAMRUB','PRRUB',1.0275,1.0000,2),(2003,'P24UAH','YAMRUB',1.0000,2.1790,2),(2004,'P24UAH','OKUSD',26.6321,1.0000,2),(2005,'P24UAH','BTC',33137.0617,1.0000,2),(2006,'P24UAH','BTCEUSD',27.1980,1.0000,2),(2007,'P24UAH','ADVCUSD',26.4541,1.0000,2),(2008,'P24UAH','PRRUB',1.0000,2.0813,2),(2009,'P24UAH','PRUSD',25.7399,1.0000,2),(2010,'PMUSD','YAMRUB',1.0000,57.0488,2),(2011,'PMUSD','PMEUR',1.0765,1.0000,2),(2012,'PMUSD','OKUSD',1.0068,1.0000,2),(2013,'PMUSD','BTCEUSD',1.0075,1.0000,2),(2014,'PMUSD','PRRUB',1.0000,56.5681,2),(2015,'PMUSD','ADVCUSD',0.9999,1.0000,2),(2016,'PMEUR','YAMRUB',1.0000,61.0022,2),(2017,'PMEUR','PMUSD',1.0000,1.0458,2),(2018,'PMEUR','BTCEUSD',1.0000,1.0418,2),(2019,'OKUSD','YAMRUB',1.0000,57.1724,2),(2020,'OKUSD','P24UAH',1.0000,25.5412,2),(2021,'OKUSD','PMUSD',1.0039,1.0000,2),(2022,'OKUSD','BTCEUSD',1.0100,1.0000,2),(2023,'OKUSD','ADVCUSD',0.9990,1.0001,2),(2024,'OKRUB','YAMRUB',1.0030,1.0000,2),(2025,'BTC','YAMRUB',1.0000,70195.1901,2),(2026,'BTC','P24UAH',1.0000,31594.4725,2),(2027,'BTC','OKUSD',1.0000,1231.3385,2),(2028,'BTCEUSD','YAMRUB',1.0000,56.7121,2),(2029,'BTCEUSD','P24UAH',1.0000,25.8100,2),(2030,'BTCEUSD','PMUSD',1.0000,0.9970,2),(2031,'BTCEUSD','PMEUR',1.0788,1.0000,2),(2032,'BTCEUSD','OKUSD',0.9989,1.0001,2),(2033,'BTCEUSD','ADVCUSD',1.0000,1.0051,2),(2034,'BTCEUSD','PRRUB',1.0000,56.9670,2),(2035,'BTCEUSD','PRUSD',1.0000,1.0322,2),(2036,'BTCERUB','YAMRUB',1.0000,1.0086,2),(2037,'ADVCUSD','YAMRUB',1.0000,56.6550,2),(2038,'PRRUB','YAMRUB',1.0010,1.0000,2),(2039,'PRUSD','YAMRUB',1.0000,55.5662,2),(2040,'ADVCUSD','P24UAH',1.0000,25.5010,2),(2041,'PRUSD','P24UAH',1.0000,24.7052,2),(2042,'ADVCUSD','PMUSD',1.0100,1.0000,2),(2043,'PRRUB','PMUSD',59.1047,1.0000,2),(2044,'ADVCUSD','OKUSD',1.0059,1.0000,2),(2045,'ADVCUSD','BTCEUSD',1.0099,1.0000,2),(2046,'PRRUB','BTCEUSD',58.7501,1.0000,2),(2047,'PRUSD','BTCEUSD',1.0437,1.0000,2),(2048,'PRRUB','PRUSD',56.4880,1.0000,2),(2049,'PRUSD','PRRUB',1.0000,55.0553,2);
/*!40000 ALTER TABLE `parse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_accounts`
--

DROP TABLE IF EXISTS `payment_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type_account` varchar(100) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_accounts`
--

LOCK TABLES `payment_accounts` WRITE;
/*!40000 ALTER TABLE `payment_accounts` DISABLE KEYS */;
INSERT INTO `payment_accounts` VALUES (1,6,'WMZ','Z123456789120'),(2,6,'Payeer EUR','410000001111444'),(3,7,'WM','Z234234234234'),(4,7,'Payeer EUR','1'),(5,7,'Payeer EUR','2'),(6,7,'WMZ','3'),(7,7,'WMZ','4'),(8,7,'WMZ','5'),(9,6,'WMU','112312121'),(10,6,'WMU','112312121'),(11,6,'WMR','rrr'),(12,6,'BTC USD ','55666'),(13,7,'BTC USD ','1111'),(14,7,'WMR','222');
/*!40000 ALTER TABLE `payment_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propositions`
--

DROP TABLE IF EXISTS `propositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propositions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `currency_from` varchar(32) DEFAULT NULL,
  `rate` decimal(19,4) DEFAULT NULL,
  `sum_from` decimal(19,4) DEFAULT NULL,
  `sum_to` decimal(19,4) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currency_to` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propositions`
--

LOCK TABLES `propositions` WRITE;
/*!40000 ALTER TABLE `propositions` DISABLE KEYS */;
INSERT INTO `propositions` VALUES (21,6,'WMZ',26.5000,100.0000,2650.0000,'test',0,'2017-04-10 14:04:07','WMU'),(22,7,'BTC USD ',22.0000,333.0000,7326.0000,'test',0,'2017-04-10 14:55:15','WMZ'),(23,4,'WMZ',27.0000,200.0000,5400.0000,'какой то комент',0,'2017-04-10 17:01:22','Payeer RUB'),(24,6,'WMU',33.0000,44.0000,1452.0000,'44',0,'2017-04-11 09:57:02','Payeer USD'),(25,4,'BTC USD ',22.0000,555.0000,12210.0000,'test',0,'2017-04-11 09:55:43','WMR'),(26,6,'Payeer EUR',2.0000,100.0000,200.0000,'тест',0,'2017-04-12 12:37:19','WMZ'),(27,6,'WMZ',28.0000,100.0000,2800.0000,'',0,'2017-04-13 08:03:51','WMU'),(28,7,'BTC USD ',22.0000,111.0000,2442.0000,'qqq',0,'2017-04-15 10:11:15','WMR'),(29,10,'WMZ',30.0000,100.0000,3000.0000,'хахахахаха',0,'2017-04-15 17:58:22','WMU'),(30,6,'PRUSD',11.0000,222.0000,2442.0000,'',0,'2017-04-23 18:52:49','P24UAH');
/*!40000 ALTER TABLE `propositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_contract` int(11) DEFAULT NULL,
  `date_from_prop` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_from_auction` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_to_prop` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_to_auction` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sums`
--

DROP TABLE IF EXISTS `sums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sums` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_contract` int(11) DEFAULT NULL,
  `sum_from` decimal(19,4) DEFAULT NULL,
  `sum_to` decimal(19,4) DEFAULT NULL,
  `sum_interest` decimal(19,4) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sums`
--

LOCK TABLES `sums` WRITE;
/*!40000 ALTER TABLE `sums` DISABLE KEYS */;
/*!40000 ALTER TABLE `sums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'pupkin','vasya@pupkin.com','8cb2237d0679ca88db6464eac60da96345513964','вася','пупкин'),(4,'admin','admin@admin.com','d033e22ae348aeb5660fc2140aec35850c4da997','admin','admin'),(6,'ponizov','podmge@gmail.com','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2','Дмитрий','Понизов'),(7,'test','test@rrr.is','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2','Тест','тест'),(8,'php','nocode@alias.sql','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2','Алисас','Сишарпович'),(9,'test123','test@aaa.ddd','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2','тест','тест'),(10,'diana','diana@diana.ua','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2','Diana','Diana');
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

-- Dump completed on 2017-04-25 12:40:15
