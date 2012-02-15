# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.61)
# Database: backstage
# Generation Time: 2012-02-06 07:12:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `content` longtext,
  `create_time` datetime NOT NULL,
  `create_by` int(11) unsigned NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` int(11) unsigned DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_create_by` (`create_by`),
  KEY `article_update_by` (`update_by`),
  CONSTRAINT `article_create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`),
  CONSTRAINT `article_update_by` FOREIGN KEY (`update_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table article_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_tag`;

CREATE TABLE `article_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_tag_pair` (`article_id`,`tag_id`),
  KEY `article_tag_tag` (`tag_id`),
  CONSTRAINT `article_tag_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  CONSTRAINT `article_tag_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;

INSERT INTO `tag` (`id`, `name`)
VALUES
	(1,'design'),
	(2,'art'),
	(3,'game'),
	(4,'book'),
	(5,'recommendation');

/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `pwd` varchar(255) NOT NULL DEFAULT '',
  `user_status_id` tinyint(4) NOT NULL DEFAULT '1',
  `user_group_id` tinyint(4) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `create_by` int(11) unsigned NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_by` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_create_by` (`create_by`),
  KEY `user_update_by` (`update_by`),
  CONSTRAINT `user_create_by` FOREIGN KEY (`create_by`) REFERENCES `user` (`id`),
  CONSTRAINT `user_update_by` FOREIGN KEY (`update_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `email`, `pwd`, `user_status_id`, `user_group_id`, `create_time`, `create_by`, `update_time`, `update_by`)
VALUES
	(1,'Alice','alice@example.com','tc54c2t2',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(2,'Bob','bob@example.com','b764vy65v3y',1,1,'2012-02-01 17:45:43',1,NULL,NULL),
	(3,'Cindy','cindy@example.com','vy6354cft54',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(4,'Daniel','daniel@example.com','vt542t52',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(5,'Eddie','eddie@example.com','cvt52t54524',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(6,'Fran','fran@example.com','vt524c542',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(7,'George','george@example.com','ct54242vt52',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(8,'Henry','henry@example.com','b8u5uni87m87',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(9,'Isaac','isaac@example.com','p0o8ik75ju',1,1,'2012-02-16 17:44:53',1,NULL,NULL),
	(10,'Jack','jack@example.com','76h53542ju',1,1,'2012-02-16 17:44:53',1,NULL,NULL),
	(11,'Kelvin','kelvin@example.com','zrz4334u',1,1,'2012-02-16 17:44:53',1,NULL,NULL),
	(12,'Lenny','lenny@example.com','ohio3j42ju',1,1,'2012-02-16 17:44:53',1,NULL,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
