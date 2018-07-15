# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: phalcon
# Generation Time: 2018-01-09 10:27:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table book
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '书本名',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `UID_INDEX` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='著作表';

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;

INSERT INTO `book` (`id`, `uid`, `name`, `created_at`, `updated_at`)
VALUES
	(1,1,'Hello World','2018-01-09 15:15:32','2018-01-09 15:15:32'),
	(2,1,'7天放弃PHP','2018-01-09 15:15:39','2018-01-09 15:15:39'),
	(3,1,'1周精通Go语言','2018-01-09 15:15:49','2018-01-09 15:15:49'),
	(4,2,'时装精选','2018-01-09 15:15:56','2018-01-09 15:15:56'),
	(5,3,'学习宝典','2018-01-09 15:16:02','2018-01-09 15:16:02'),
	(6,2,'作弊技巧','2018-01-09 15:16:08','2018-01-09 15:16:08');

/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='角色表';

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'admin','2018-01-09 15:14:02','2018-01-09 15:14:02'),
	(2,'reader','2018-01-09 15:14:07','2018-01-09 15:14:07'),
	(3,'writer','2018-01-09 15:14:13','2018-01-09 15:14:13');

/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seeds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seeds`;

CREATE TABLE `seeds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '种子名',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `UID_INDEX` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分表测试 根据uid分表 基数 seeds1 偶数 seeds2\n本表不实际使用';



# Dump of table seeds1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seeds1`;

CREATE TABLE `seeds1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '种子名',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `UID_INDEX` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分表测试 根据uid分表 基数 seeds1 偶数 seeds2\n本表不实际使用';

LOCK TABLES `seeds1` WRITE;
/*!40000 ALTER TABLE `seeds1` DISABLE KEYS */;

INSERT INTO `seeds1` (`id`, `uid`, `name`, `created_at`, `updated_at`)
VALUES
	(1,1,'12345','2018-01-09 15:17:46','2018-01-09 15:17:46'),
	(2,1,'2','2018-01-09 15:17:50','2018-01-09 15:17:50'),
	(3,3,'4','2018-01-09 15:17:58','2018-01-09 15:17:58');

/*!40000 ALTER TABLE `seeds1` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seeds2
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seeds2`;

CREATE TABLE `seeds2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '种子名',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `UID_INDEX` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分表测试 根据uid分表 基数 seeds1 偶数 seeds2\n本表不实际使用';

LOCK TABLES `seeds2` WRITE;
/*!40000 ALTER TABLE `seeds2` DISABLE KEYS */;

INSERT INTO `seeds2` (`id`, `uid`, `name`, `created_at`, `updated_at`)
VALUES
	(1,2,'12345','2018-01-09 15:17:46','2018-01-09 15:17:46'),
	(2,2,'4','2018-01-09 15:17:58','2018-01-09 15:17:58');

/*!40000 ALTER TABLE `seeds2` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table title
# ------------------------------------------------------------

DROP TABLE IF EXISTS `title`;

CREATE TABLE `title` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `title` WRITE;
/*!40000 ALTER TABLE `title` DISABLE KEYS */;

INSERT INTO `title` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'PHP开发','2018-01-09 15:18:07','2018-01-09 15:18:07'),
	(2,'PHP架构师','2018-01-09 15:18:13','2018-01-09 15:18:13'),
	(3,'经典运维','2018-01-09 15:18:22','2018-01-09 15:18:22'),
	(4,'实习生','2018-01-09 15:18:26','2018-01-09 15:18:26');

/*!40000 ALTER TABLE `title` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `created_at` datetime,
  `updated_at` datetime,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NAME_UNIQUE` (`name`),
  KEY `ROLE_ID_INDEX` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `role_id`, `created_at`, `updated_at`)
VALUES
	(1,'limx',1,'2018-01-09 15:13:28','2018-01-09 15:13:28'),
	(2,'Agnes',2,'2018-01-09 15:13:38','2018-01-09 15:13:38'),
	(3,'wxh',1,'2018-01-09 15:13:46','2018-01-09 15:13:46');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_title
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_title`;

CREATE TABLE `user_title` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UID_TITLE_ID_UNIQUE` (`uid`,`title_id`),
  KEY `UID_INDEX` (`uid`),
  KEY `TITLE_ID_INDEX` (`title_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户标签连接表';

LOCK TABLES `user_title` WRITE;
/*!40000 ALTER TABLE `user_title` DISABLE KEYS */;

INSERT INTO `user_title` (`id`, `uid`, `title_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2018-01-09 15:17:46','2018-01-09 15:17:46'),
	(2,1,2,'2018-01-09 15:17:50','2018-01-09 15:17:50'),
	(3,2,3,'2018-01-09 15:17:53','2018-01-09 15:17:53'),
	(4,3,4,'2018-01-09 15:17:58','2018-01-09 15:17:58');

/*!40000 ALTER TABLE `user_title` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
