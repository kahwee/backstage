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
	(1,'something'),
	(3,'hiihihi');

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
	(1,'Alice','alice@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(2,'Bob','bob@mail.com','password',1,1,'2012-02-01 17:45:43',1,NULL,NULL),
	(3,'Cindy','cindy@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(4,'Daniel','daniel@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(5,'Elixir','elixir@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(6,'Farisal','farisal@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(7,'George','george@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL),
	(8,'Henry','henry@mail.com','password',1,1,'2012-02-01 17:44:53',1,NULL,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
