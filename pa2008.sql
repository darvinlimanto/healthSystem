-- MySQL dump 10.14  Distrib 5.5.65-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pa2008
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

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
-- Table structure for table `client_health_risk_parameters`
--

DROP TABLE IF EXISTS `client_health_risk_parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_health_risk_parameters` (
  `clientParameterID` int(11) NOT NULL AUTO_INCREMENT,
  `parameterName` varchar(255) NOT NULL,
  `parameterValue` double NOT NULL,
  `clientHealthRisksID` int(11) NOT NULL,
  PRIMARY KEY (`clientParameterID`),
  KEY `clientHealthRisksID` (`clientHealthRisksID`),
  CONSTRAINT `client_health_risk_parameters_ibfk_1` FOREIGN KEY (`clientHealthRisksID`) REFERENCES `client_health_risks` (`clientHealthRisksID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_health_risk_parameters`
--

LOCK TABLES `client_health_risk_parameters` WRITE;
/*!40000 ALTER TABLE `client_health_risk_parameters` DISABLE KEYS */;
INSERT INTO `client_health_risk_parameters` VALUES (11,'bloodpressurelevel',85,1),(12,'glucoselevel',145,2),(13,'bloodpressurelevel',110,3),(14,'temperaturelevel',37.5,4),(15,'height',80,5),(16,'weight',165,5);
/*!40000 ALTER TABLE `client_health_risk_parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_health_risks`
--

DROP TABLE IF EXISTS `client_health_risks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_health_risks` (
  `clientHealthRisksID` int(11) NOT NULL AUTO_INCREMENT,
  `dateTime` date NOT NULL,
  `clientHealthRiskTitle` varchar(255) NOT NULL,
  `clientID` int(11) NOT NULL,
  `healthRiskID` int(11) NOT NULL,
  PRIMARY KEY (`clientHealthRisksID`),
  KEY `healthRiskID` (`healthRiskID`),
  KEY `clientID` (`clientID`),
  CONSTRAINT `client_health_risks_ibfk_1` FOREIGN KEY (`healthRiskID`) REFERENCES `health_risks` (`healthRiskID`),
  CONSTRAINT `client_health_risks_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_health_risks`
--

LOCK TABLES `client_health_risks` WRITE;
/*!40000 ALTER TABLE `client_health_risks` DISABLE KEYS */;
INSERT INTO `client_health_risks` VALUES (1,'2020-05-28','Blood Pressure Calculator',2,1),(2,'2020-05-28','Blood Sugar Calculator',2,2),(3,'2020-05-28','Blood Pressure Calculator',4,1),(4,'2020-06-03','Body Temperature Calculator',2,3),(5,'2020-06-04','BMI Calculator',2,5);
/*!40000 ALTER TABLE `client_health_risks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `clientID` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateJoined` datetime NOT NULL,
  `role` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`clientID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'admin','admin','male','2020-05-27','PAPX2008@gmail.com','aa43468cc0431f2754f9cf3bc5801797','2020-05-27 14:55:56',1),(2,'John','Doe','m','1999-05-26','john.doe@gmail.com','1a8bbb148e4c50b746c5d90d3b32cc3f','2020-05-26 14:39:27',0),(4,'Mary','Ann','f','1997-09-09','mary.ann@gmail.com','6ef9f8c816ad899fb0180cd62b06b3f3','2020-05-27 19:55:06',0),(6,'Harry','Potter','m','1980-07-31','harry.potter@gmail.com','abfd05ea01277e58638aad182edb61c4','2020-06-03 19:17:27',0);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulas`
--

DROP TABLE IF EXISTS `formulas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formulas` (
  `formulaName` varchar(50) NOT NULL,
  `formulaCalc` varchar(255) NOT NULL,
  `healthRiskID` int(11) NOT NULL,
  PRIMARY KEY (`formulaName`,`healthRiskID`),
  KEY `healthRiskID` (`healthRiskID`),
  CONSTRAINT `formulas_ibfk_1` FOREIGN KEY (`healthRiskID`) REFERENCES `health_risks` (`healthRiskID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulas`
--

LOCK TABLES `formulas` WRITE;
/*!40000 ALTER TABLE `formulas` DISABLE KEYS */;
INSERT INTO `formulas` VALUES ('BMI','weight/(height/100*height/100)',5),('BPL','bloodpressurelevel',1),('GL','glucoselevel',2),('HR','heartrate',4),('TL','temperaturelevel',3);
/*!40000 ALTER TABLE `formulas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_risks`
--

DROP TABLE IF EXISTS `health_risks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health_risks` (
  `healthRiskID` int(11) NOT NULL AUTO_INCREMENT,
  `healthRiskTitle` varchar(50) NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`healthRiskID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_risks`
--

LOCK TABLES `health_risks` WRITE;
/*!40000 ALTER TABLE `health_risks` DISABLE KEYS */;
INSERT INTO `health_risks` VALUES (1,'Blood Pressure Calculator','2020-05-28 18:39:02'),(2,'Blood Sugar Calculator','2020-05-28 18:42:43'),(3,'Body Temperature Calculator','2020-06-03 18:34:12'),(4,'Heart Rate Calculator','2020-06-03 18:56:47'),(5,'BMI Calculator','2020-06-04 18:12:38');
/*!40000 ALTER TABLE `health_risks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameters`
--

DROP TABLE IF EXISTS `parameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameters` (
  `parameterID` int(11) NOT NULL AUTO_INCREMENT,
  `parameterName` varchar(255) NOT NULL,
  `parameterUnit` varchar(255) NOT NULL,
  `healthRiskID` int(11) NOT NULL,
  PRIMARY KEY (`parameterID`),
  KEY `healthRiskID` (`healthRiskID`),
  CONSTRAINT `parameters_ibfk_1` FOREIGN KEY (`healthRiskID`) REFERENCES `health_risks` (`healthRiskID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameters`
--

LOCK TABLES `parameters` WRITE;
/*!40000 ALTER TABLE `parameters` DISABLE KEYS */;
INSERT INTO `parameters` VALUES (1,'bloodpressurelevel','mmHg',1),(2,'glucoselevel','mg/dL',2),(3,'temperaturelevel','Celcius',3),(4,'heartrate','bpm',4),(5,'height','kg',5),(6,'weight','cm',5);
/*!40000 ALTER TABLE `parameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendations`
--

DROP TABLE IF EXISTS `recommendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommendations` (
  `riskName` varchar(255) NOT NULL,
  `riskCondition` varchar(255) NOT NULL,
  `advice` varchar(255) NOT NULL,
  `healthRiskID` int(11) NOT NULL,
  KEY `healthRiskID` (`healthRiskID`),
  CONSTRAINT `healthRiskID` FOREIGN KEY (`healthRiskID`) REFERENCES `health_risks` (`healthRiskID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendations`
--

LOCK TABLES `recommendations` WRITE;
/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
INSERT INTO `recommendations` VALUES ('High Blood Pressure','BPL>139','Exercise regularly, consume less fat.',1),('High Blood Sugar','GL>130','Exercise regularly, consume less carbohydrate.',2),('Low Blood Pressure','BPL<90','Exercise and drink water regularly, consume salty food.',1),('Low Blood Sugar','GL<70','Consume more carbs, take tablet to increase blood sugar level if necessary.',2),('Normal Blood Pressure','BPL>=90&&BPL<=139','Your blood pressure level is Normal.',1),('Normal Blood Sugar','GL>=70&&GL<=130','Your blood sugar level is Normal.',2),('High Temperature','TL>=38','You have fever. Take a rest and call doctor if needed.',3),('Normal Temperature','TL>=36&&TL<38','Your body temperature is in normal range.',3),('Low Temperature','TL<36','Possible case of hypothermia. Contact doctor immediately',3),('High Heart Rate','HR>100','A sign of problem. See a doctor immediately',4),('Normal Heart Rate','HR>=60&&HR<=100','Your heart rate is in normal range.',4),('Low Heart Rate','HR<60','If you feeling faint, dizzy or short of breath, see a doctor.',4),('Overweight','BMI>25','Exercise regularly, consume healthier diet.',5),('Normal','BMI>=18.5&&BMI<=25','Your BMI Condition is Normal.',5),('Underweight','BMI<18.5','Add more carbs into your diet.',5);
/*!40000 ALTER TABLE `recommendations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pa2008'
--

--
-- Dumping routines for database 'pa2008'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-04 18:16:31
