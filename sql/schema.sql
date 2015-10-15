-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: ncsolar
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB

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
-- Table structure for table `authority`
--

DROP TABLE IF EXISTS `authority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authority` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `order` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `enacted` datetime DEFAULT NULL,
  `enactedtext` varchar(255) DEFAULT NULL,
  `effective` datetime DEFAULT NULL,
  `effectivetext` varchar(255) DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  `expiredtext` varchar(255) DEFAULT NULL,
  `file_key` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_authority_program_idx` (`program_id`),
  CONSTRAINT `fk_authority_program` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3888 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utility_state1_idx` (`state_id`),
  CONSTRAINT `fk_city_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29790 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ts` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `organization_name` varchar(45) DEFAULT NULL,
  `web_visible_default` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state_id` int(11) unsigned DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5745 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `county`
--

DROP TABLE IF EXISTS `county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `county` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utility_state1_idx` (`state_id`),
  CONSTRAINT `fk_county_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3373 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `energy_category`
--

DROP TABLE IF EXISTS `energy_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `energy_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `export`
--

DROP TABLE IF EXISTS `export`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `export` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `created_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(8) NOT NULL,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `implementing_sector`
--

DROP TABLE IF EXISTS `implementing_sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `implementing_sector` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parameter_set_id` int(11) unsigned NOT NULL,
  `source` varchar(45) DEFAULT NULL,
  `qualifier` varchar(45) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `units` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parameter_parameter_set1_idx` (`parameter_set_id`),
  CONSTRAINT `fk_parameter_parameter_set1` FOREIGN KEY (`parameter_set_id`) REFERENCES `parameter_set` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parameter_set`
--

DROP TABLE IF EXISTS `parameter_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parameter_set_program1_idx` (`program_id`),
  CONSTRAINT `fk_parameter_set_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parameter_set_sector`
--

DROP TABLE IF EXISTS `parameter_set_sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter_set_sector` (
  `sector_id` int(11) unsigned NOT NULL,
  `set_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `sector_id` (`sector_id`,`set_id`),
  KEY `fk_parameter_set_sector_set1` (`set_id`),
  CONSTRAINT `fk_parameter_set_sector_sector1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_parameter_set_sector_set1` FOREIGN KEY (`set_id`) REFERENCES `parameter_set` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parameter_set_technology`
--

DROP TABLE IF EXISTS `parameter_set_technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter_set_technology` (
  `technology_id` int(11) unsigned NOT NULL,
  `set_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `technology_id` (`technology_id`,`set_id`),
  KEY `fk_parameter_set_technology_set1` (`set_id`),
  CONSTRAINT `fk_parameter_set_technology_set1` FOREIGN KEY (`set_id`) REFERENCES `parameter_set` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_parameter_set_technology_technology1` FOREIGN KEY (`technology_id`) REFERENCES `technology` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` int(11) unsigned NOT NULL,
  `is_entire_state` tinyint(1) NOT NULL DEFAULT '0',
  `implementing_sector_id` int(11) unsigned NOT NULL,
  `program_category_id` int(11) unsigned NOT NULL,
  `program_type_id` int(11) unsigned NOT NULL,
  `created_by_user_id` int(11) unsigned NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `updated_ts` datetime DEFAULT NULL,
  `created_ts` timestamp NULL DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `websiteurl` varchar(255) DEFAULT NULL,
  `administrator` varchar(255) DEFAULT NULL,
  `fundingsource` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `start_date_text` varchar(255) DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `end_date_text` varchar(255) DEFAULT NULL,
  `summary` text,
  `additional_technologies` text,
  PRIMARY KEY (`id`),
  KEY `fk_program_state1_idx` (`state_id`),
  KEY `fk_program_program_category1_idx` (`program_category_id`),
  KEY `fk_program_program_type1_idx` (`program_type_id`),
  KEY `fk_program_implementing_sector1_idx` (`implementing_sector_id`),
  KEY `fk_program_user1_idx` (`created_by_user_id`),
  KEY `ix_code` (`code`),
  CONSTRAINT `fk_program_implementing_sector1` FOREIGN KEY (`implementing_sector_id`) REFERENCES `implementing_sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_program_category1` FOREIGN KEY (`program_category_id`) REFERENCES `program_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_program_type1` FOREIGN KEY (`program_type_id`) REFERENCES `program_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_user1` FOREIGN KEY (`created_by_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5665 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_category`
--

DROP TABLE IF EXISTS `program_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_city`
--

DROP TABLE IF EXISTS `program_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_city` (
  `program_id` int(11) unsigned NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `city_id` (`city_id`,`program_id`),
  KEY `fk_program_city_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_city_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `program_city_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_contact`
--

DROP TABLE IF EXISTS `program_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `contact_id` int(11) unsigned NOT NULL,
  `webvisible` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_program_contact_contact1_idx` (`contact_id`),
  KEY `fk_program_contact_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_contact_contact1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_contact_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6605 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_county`
--

DROP TABLE IF EXISTS `program_county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_county` (
  `program_id` int(11) unsigned NOT NULL,
  `county_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `county_id` (`county_id`,`program_id`),
  KEY `fk_program_county_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_county_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `program_county_ibfk_1` FOREIGN KEY (`county_id`) REFERENCES `county` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_detail`
--

DROP TABLE IF EXISTS `program_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` text,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `template_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_program_detail_program1` (`program_id`),
  KEY `fk_program_detail_template1` (`template_id`),
  CONSTRAINT `fk_program_detail_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `program_detail_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `program_detail_template` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19993 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_detail_template`
--

DROP TABLE IF EXISTS `program_detail_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_detail_template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) unsigned NOT NULL,
  `label` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_program_detail_type1` (`type_id`),
  CONSTRAINT `fk_program_detail_type1` FOREIGN KEY (`type_id`) REFERENCES `program_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_memo`
--

DROP TABLE IF EXISTS `program_memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_memo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `added_by_user` int(11) unsigned NOT NULL,
  `added` datetime DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`id`),
  KEY `fk_program_memo_program1_idx` (`program_id`),
  KEY `fk_program_memo_user1_idx` (`added_by_user`),
  CONSTRAINT `fk_program_memo_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_memo_user1` FOREIGN KEY (`added_by_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_sector`
--

DROP TABLE IF EXISTS `program_sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_sector` (
  `program_id` int(11) unsigned NOT NULL,
  `sector_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`program_id`,`sector_id`),
  KEY `fk_program_sector_sector1_idx` (`sector_id`),
  KEY `fk_program_sector_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_sector_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_sector_sector1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_technology`
--

DROP TABLE IF EXISTS `program_technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_technology` (
  `program_id` int(11) unsigned NOT NULL,
  `technology_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`program_id`,`technology_id`),
  KEY `fk_program_technology_technology1_idx` (`technology_id`),
  KEY `fk_program_technology_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_technology_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_technology_technology1` FOREIGN KEY (`technology_id`) REFERENCES `technology` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_type`
--

DROP TABLE IF EXISTS `program_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `program_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_program_type_program_category1_idx` (`program_category_id`),
  CONSTRAINT `fk_program_type_program_category1` FOREIGN KEY (`program_category_id`) REFERENCES `program_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_utility`
--

DROP TABLE IF EXISTS `program_utility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_utility` (
  `program_id` int(11) unsigned NOT NULL,
  `utility_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`program_id`,`utility_id`),
  KEY `fk_program_utility_utility1_idx` (`utility_id`),
  KEY `fk_program_utility_program1_idx` (`program_id`),
  CONSTRAINT `fk_program_utility_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_utility_utility1` FOREIGN KEY (`utility_id`) REFERENCES `utility` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `program_zipcode`
--

DROP TABLE IF EXISTS `program_zipcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_zipcode` (
  `program_id` int(11) unsigned NOT NULL,
  `zipcode_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`program_id`,`zipcode_id`),
  KEY `program_id` (`program_id`),
  KEY `zipcode_id` (`zipcode_id`),
  CONSTRAINT `program_zipcode_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `program_zipcode_ibfk_2` FOREIGN KEY (`zipcode_id`) REFERENCES `zipcode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `search_log`
--

DROP TABLE IF EXISTS `search_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `searchdate` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `filtertype` varchar(45) DEFAULT NULL,
  `text` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sector` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `fieldname` varchar(45) DEFAULT NULL,
  `is_selectable` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `sector_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `sector` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `abbreviation` char(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  `is_territory` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `abbreviation` (`abbreviation`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_memo`
--

DROP TABLE IF EXISTS `subscription_memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_memo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) unsigned NOT NULL,
  `added_by_user` int(11) unsigned NOT NULL,
  `added` datetime DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`id`),
  KEY `fk_subscription_memo_program1_idx` (`program_id`),
  KEY `fk_subscription_memo_user1_idx` (`added_by_user`),
  CONSTRAINT `fk_subscription_memo_program1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_subscription_memo_user1` FOREIGN KEY (`added_by_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `technology`
--

DROP TABLE IF EXISTS `technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technology` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `technology_category_id` int(11) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_technology_technology_category1_idx` (`technology_category_id`),
  CONSTRAINT `fk_technology_technology_category1` FOREIGN KEY (`technology_category_id`) REFERENCES `technology_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `technology_category`
--

DROP TABLE IF EXISTS `technology_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technology_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `energy_category_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `energy_category_id` (`energy_category_id`),
  CONSTRAINT `technology_category_ibfk_1` FOREIGN KEY (`energy_category_id`) REFERENCES `energy_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `password_token` varchar(128) DEFAULT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `role` varchar(8) NOT NULL DEFAULT 'guest',
  `state` char(8) DEFAULT 'active',
  `created_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ts` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=535 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `utility`
--

DROP TABLE IF EXISTS `utility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `state_id` int(11) unsigned NOT NULL,
  `utility_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_utility_state1_idx` (`state_id`),
  CONSTRAINT `fk_utility_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3210 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `utility_zipcode`
--

DROP TABLE IF EXISTS `utility_zipcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_zipcode` (
  `utility_id` int(11) unsigned NOT NULL,
  `zipcode_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`utility_id`,`zipcode_id`),
  KEY `fk_utility_zipcode_zipcode1_idx` (`zipcode_id`),
  KEY `fk_utility_zipcode_utility1_idx` (`utility_id`),
  CONSTRAINT `fk_utility_zipcode_utility1` FOREIGN KEY (`utility_id`) REFERENCES `utility` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_utility_zipcode_zipcode1` FOREIGN KEY (`zipcode_id`) REFERENCES `zipcode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zipcode`
--

DROP TABLE IF EXISTS `zipcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zipcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zipcode` varchar(16) NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  `state_id` int(11) unsigned NOT NULL,
  `county_id` int(11) unsigned NOT NULL,
  `latitude` decimal(10,0) DEFAULT NULL,
  `longitude` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `zipcode` (`zipcode`),
  KEY `fk_zipcode_city1` (`city_id`),
  KEY `fk_zipcode_county1` (`county_id`),
  KEY `fk_zipcode_state1` (`state_id`),
  CONSTRAINT `fk_zipcode_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_zipcode_county1` FOREIGN KEY (`county_id`) REFERENCES `county` (`id`),
  CONSTRAINT `fk_zipcode_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41873 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-15 15:24:10
