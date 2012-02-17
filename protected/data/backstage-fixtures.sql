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

INSERT INTO `article` (`id`, `name`, `content`, `create_time`, `create_by`, `update_time`, `update_by`, `delete_time`, `delete_by`)
VALUES
  (1, 'Adele', '<p><strong style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">Adele Laurie Blue Adkins</strong><sup id=\"cite_ref-nicole_1-0\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Adele_(singer)#cite_note-nicole-1\">[2]</a></sup><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;(born 5&nbsp;May&nbsp;1988), better known&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Mononymous person\" href=\"http://en.wikipedia.org/wiki/Mononymous_person\">mononymously</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;as&nbsp;</span><strong style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">Adele</strong><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">, is a&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"United Kingdom\" href=\"http://en.wikipedia.org/wiki/United_Kingdom\">British</a><sup id=\"cite_ref-2\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Adele_(singer)#cite_note-2\">[3]</a></sup><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;recording artist and songwriter. Adele was offered a recording contract from&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"XL Recordings\" href=\"http://en.wikipedia.org/wiki/XL_Recordings\">XL Recordings</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;after a friend posted her demonstration on Myspace in 2006. The next year she received the&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Brit Awards\" href=\"http://en.wikipedia.org/wiki/Brit_Awards\">Brit Awards</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;\"Critics\' Choice\" and won the&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"BBC\" href=\"http://en.wikipedia.org/wiki/BBC\">BBC</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Sound of 2008\" href=\"http://en.wikipedia.org/wiki/Sound_of_2008\">Sound of 2008</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">. Her debut album,&nbsp;</span><em style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial;\" title=\"19 (Adele album)\" href=\"http://en.wikipedia.org/wiki/19_(Adele_album)\">19</a></em><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">, was released in 2008 to much commercial and critical success in the UK.&nbsp;</span><em style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">19</em><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;was certified four times</span><a class=\"mw-redirect\" style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Platinum record\" href=\"http://en.wikipedia.org/wiki/Platinum_record\">platinum</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;in the UK.</span><sup id=\"cite_ref-BPI_certifications_3-0\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Adele_(singer)#cite_note-BPI_certifications-3\">[4]</a></sup><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;Her career in the US was boosted by a&nbsp;</span><em style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: initial initial; background-repeat: initial initial;\" title=\"Saturday Night Live\" href=\"http://en.wikipedia.org/wiki/Saturday_Night_Live\">Saturday Night Live</a></em><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;appearance in late 2008. At the&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"51st Grammy Awards\" href=\"http://en.wikipedia.org/wiki/51st_Grammy_Awards\">2009 Grammy Awards</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">, Adele received the awards for&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Best New Artist\" href=\"http://en.wikipedia.org/wiki/Best_New_Artist\">Best New Artist</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;and&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Best Female Pop Vocal Performance\" href=\"http://en.wikipedia.org/wiki/Best_Female_Pop_Vocal_Performance\">Best Female Pop Vocal Performance</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">.</span><sup id=\"cite_ref-GRAM09_4-0\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Adele_(singer)#cite_note-GRAM09-4\">[5]</a></sup><sup id=\"cite_ref-5\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Adele_(singer)#cite_note-5\">[6]</a></sup><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;She has also won a total of 8&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Grammy Award\" href=\"http://en.wikipedia.org/wiki/Grammy_Award\">Grammy Awards</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;and 1&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Brit Award\" href=\"http://en.wikipedia.org/wiki/Brit_Award\">Brit Award</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">.</span></p>', '0000-00-00 00:00:00', 1, NULL, NULL, NULL, NULL),
  (2, 'Bruce Springsteen', '<p><strong style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">Bruce Frederick Joseph Springsteen</strong><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;(born September 23, 1949), nicknamed \"</span><strong style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">The Boss</strong><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">,\" is an American singer-songwriter-performer who records and tours with the&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"E Street Band\" href=\"http://en.wikipedia.org/wiki/E_Street_Band\">E Street Band</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">. Springsteen is widely known for his brand of&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Heartland rock\" href=\"http://en.wikipedia.org/wiki/Heartland_rock\">heartland rock</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">, poetic lyrics, and&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Americana\" href=\"http://en.wikipedia.org/wiki/Americana\">Americana</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;sentiments centered on his native&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"New Jersey\" href=\"http://en.wikipedia.org/wiki/New_Jersey\">New Jersey</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">.</span><sup id=\"cite_ref-0\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Bruce_Springsteen#cite_note-0\">[1]</a></sup></p>', '0000-00-00 00:00:00', 4, NULL, NULL, NULL, NULL),
  (3, 'Cee Lo Green', '<p><strong style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">Thomas DeCarlo Callaway</strong><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;(born May 30, 1974),</span><sup id=\"cite_ref-musicstop.org_0-2\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Cee_Lo_Green#cite_note-musicstop.org-0\">[1]</a></sup><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;better known by his stage name&nbsp;</span><strong style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">Cee Lo Green</strong><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">, is an American&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Singer-songwriter\" href=\"http://en.wikipedia.org/wiki/Singer-songwriter\">singer-songwriter</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">,&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Rapping\" href=\"http://en.wikipedia.org/wiki/Rapping\">rapper</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">,&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Record producer\" href=\"http://en.wikipedia.org/wiki/Record_producer\">record producer</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;and&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Actor\" href=\"http://en.wikipedia.org/wiki/Actor\">actor</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">. He originally came to prominence as a member of the&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Southern hip hop\" href=\"http://en.wikipedia.org/wiki/Southern_hip_hop\">southern hip hop</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;group</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Goodie Mob\" href=\"http://en.wikipedia.org/wiki/Goodie_Mob\">Goodie Mob</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">, later launching a critically acclaimed solo career</span><sup id=\"cite_ref-New_York_Times_August_2010_1-0\" class=\"reference\" style=\"line-height: 1em; font-family: sans-serif;\"><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; white-space: nowrap; background-position: initial initial; background-repeat: initial initial;\" href=\"http://en.wikipedia.org/wiki/Cee_Lo_Green#cite_note-New_York_Times_August_2010-1\">[2]</a></sup><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;and forming&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Gnarls Barkley\" href=\"http://en.wikipedia.org/wiki/Gnarls_Barkley\">Gnarls Barkley</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">&nbsp;with DJ&nbsp;</span><a style=\"text-decoration: none; color: #0b0080; background-image: none; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: sans-serif; font-size: 13px; line-height: 19px;\" title=\"Danger Mouse\" href=\"http://en.wikipedia.org/wiki/Danger_Mouse\">Danger Mouse</a><span style=\"font-family: sans-serif; font-size: 13px; line-height: 19px;\">.</span></p>', '0000-00-00 00:00:00', 2, NULL, NULL, NULL, NULL),
  (4, 'David Guetta', '<p>Pierre David Guetta (7 November 1967), known professionally as <em>David Guetta</em> (French pronunciation: [daˌvid ɡɛˈta]), is a French house music producer and DJ.[1] Originally a DJ at nightclubs during the 1980s and 1990s, he co-founded Gum Productions and released his first album, Just a Little More Love, in 2002. Later, he released Guetta Blaster (2004) and Pop Life (2007). His 2009 album One Love included the hit singles \"When Love Takes Over\" (featuring Kelly Rowland), \"Gettin\' Over You\" (featuring Chris Willis, Fergie &amp; LMFAO) and \"Sexy Bitch\" (featuring Akon), the last becoming a top five hit in the United States and all three reaching #1 in the United Kingdom, as well as another internationally known single called \"Memories\" featuring Kid Cudi which became a top five hit in many countries. Guetta has sold over three million albums and 15 million singles worldwide.[2] He is currently one of the most sought-after music producers.[3] As of 2012 David Guetta is the world\'s most popular DJ, claiming the #1 poll position of the DJ Mag 100 popularity poll.</p>', '0000-00-00 00:00:00', 2, NULL, NULL, NULL, NULL),
  (5, 'Elton John', '<p>Sir Elton Hercules John, CBE (born Reginald Kenneth Dwight on 25 March 1947) is an English rock singer-songwriter, composer, pianist and occasional actor. He has worked with lyricist Bernie Taupin as his songwriter partner since 1967; they have collaborated on more than 30 albums to date.</p>\r\n<p>In his four-decade career John has sold more than 250 million records, making him one of the most successful artists of all time.[1] His single \"Candle in the Wind 1997\" has sold over 33 million copies worldwide, and is the best selling single in Billboard history.[2] He has more than 50 Top 40 hits, including seven consecutive No. 1 US albums, 56 Top 40 singles, 16 Top 10, four No. 2 hits, and nine No. 1 hits. He has won six Grammy Awards, four Brit Awards, an Academy Award, a Golden Globe Award and a Tony Award. In 2004, Rolling Stone ranked him Number 49 on its list of the 100 greatest artists of all time.[3]</p>', '0000-00-00 00:00:00', 2, NULL, NULL, NULL, NULL);



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
