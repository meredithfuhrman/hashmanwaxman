CREATE TABLE `wp_users` (  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `user_status` int(11) NOT NULL DEFAULT '0',  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  PRIMARY KEY (`ID`),  KEY `user_login_key` (`user_login`),  KEY `user_nicename` (`user_nicename`)) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES('1', 'meredith', '$P$Bcfuz.96tK7h7BKXPqWCmmvKMVAY2h/', 'meredith', 'meredith.fuhrman@gmail.com', '', '2015-12-20 06:15:06', '', '0', 'meredith');
INSERT INTO `wp_users` VALUES('2', 'jordan', '$P$BdfzL6Q6XppqW5Z03Q.g3xtjrZFsF50', 'jordan', 'jordan.wallace.williams@gmail.com', '', '2015-12-22 08:19:17', '1450772357:$P$BZzWR2.0G0SpwxE.e5B7cOOO7Sjxwm1', '0', 'Jordan Williams');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
