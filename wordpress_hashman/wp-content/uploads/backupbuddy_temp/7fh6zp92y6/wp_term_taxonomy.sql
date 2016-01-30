CREATE TABLE `wp_term_taxonomy` (  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',  `count` bigint(20) NOT NULL DEFAULT '0',  PRIMARY KEY (`term_taxonomy_id`),  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),  KEY `taxonomy` (`taxonomy`)) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40000 ALTER TABLE `wp_term_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_term_taxonomy` VALUES('1', '1', 'category', '', '0', '0');
INSERT INTO `wp_term_taxonomy` VALUES('3', '3', 'nav_menu', '', '0', '16');
INSERT INTO `wp_term_taxonomy` VALUES('4', '4', 'product_type', '', '0', '0');
INSERT INTO `wp_term_taxonomy` VALUES('5', '5', 'product_type', '', '0', '0');
INSERT INTO `wp_term_taxonomy` VALUES('6', '6', 'product_type', '', '0', '0');
INSERT INTO `wp_term_taxonomy` VALUES('7', '7', 'product_type', '', '0', '0');
/*!40000 ALTER TABLE `wp_term_taxonomy` ENABLE KEYS */;
