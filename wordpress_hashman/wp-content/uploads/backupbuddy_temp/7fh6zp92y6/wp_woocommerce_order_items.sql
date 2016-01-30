CREATE TABLE `wp_woocommerce_order_items` (  `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT,  `order_item_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,  `order_item_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  `order_id` bigint(20) NOT NULL,  PRIMARY KEY (`order_item_id`),  KEY `order_id` (`order_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40000 ALTER TABLE `wp_woocommerce_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_woocommerce_order_items` ENABLE KEYS */;
