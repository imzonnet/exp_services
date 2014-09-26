/*
Navicat MySQL Data Transfer

Source Server         : ZServer
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : exp_services

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-09-26 17:27:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cs_budgets`
-- ----------------------------
DROP TABLE IF EXISTS `cs_budgets`;
CREATE TABLE `cs_budgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cs_budgets
-- ----------------------------
INSERT INTO `cs_budgets` VALUES ('1', '10-100');
INSERT INTO `cs_budgets` VALUES ('2', '100-200');
INSERT INTO `cs_budgets` VALUES ('3', '200-500');
INSERT INTO `cs_budgets` VALUES ('4', '500-1000');
INSERT INTO `cs_budgets` VALUES ('5', '1000-2000');
INSERT INTO `cs_budgets` VALUES ('6', '> 2000');

-- ----------------------------
-- Table structure for `cs_items`
-- ----------------------------
DROP TABLE IF EXISTS `cs_items`;
CREATE TABLE `cs_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `requirement` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `budget_id` int(10) unsigned NOT NULL,
  `deliver_in` int(11) NOT NULL DEFAULT '0',
  `service_type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cs_items_budget_id_index` (`budget_id`),
  KEY `cs_items_service_type_id_index` (`service_type_id`),
  KEY `cs_items_user_id_index` (`user_id`),
  CONSTRAINT `cs_items_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `cs_budgets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cs_items_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `cs_service_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cs_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cs_items
-- ----------------------------

-- ----------------------------
-- Table structure for `cs_messages`
-- ----------------------------
DROP TABLE IF EXISTS `cs_messages`;
CREATE TABLE `cs_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submit_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cs_messages_item_id_index` (`item_id`),
  KEY `cs_messages_user_id_index` (`user_id`),
  KEY `cs_messages_status_id_index` (`status_id`),
  CONSTRAINT `cs_messages_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `cs_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cs_messages_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `cs_status` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cs_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cs_messages
-- ----------------------------

-- ----------------------------
-- Table structure for `cs_service_types`
-- ----------------------------
DROP TABLE IF EXISTS `cs_service_types`;
CREATE TABLE `cs_service_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cs_service_types
-- ----------------------------
INSERT INTO `cs_service_types` VALUES ('1', 'Theme', 'Lorem Ipsum has been the industry\'s standard ');
INSERT INTO `cs_service_types` VALUES ('2', 'Project', 'Lorem Ipsum has been the industry\'s standard ');
INSERT INTO `cs_service_types` VALUES ('3', 'Fix Bug', 'Lorem Ipsum has been the industry\'s standard ');

-- ----------------------------
-- Table structure for `cs_status`
-- ----------------------------
DROP TABLE IF EXISTS `cs_status`;
CREATE TABLE `cs_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cs_status
-- ----------------------------
INSERT INTO `cs_status` VALUES ('1', 'Open', 'Lorem Ipsum has been the dummy text ever since the 1500s');
INSERT INTO `cs_status` VALUES ('2', 'In Progress', 'Lorem Ipsum has been the dummy text ever since the 1500s');
INSERT INTO `cs_status` VALUES ('3', 'Close', 'Lorem Ipsum has been the dummy text ever since the 1500s');
INSERT INTO `cs_status` VALUES ('4', 'Cancel', 'Lorem Ipsum has been the dummy text ever since the 1500s');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'administer', '{\"administer\":1}', '2014-09-26 10:27:25', '2014-09-26 10:27:25');
INSERT INTO `groups` VALUES ('2', 'supporter', '{\"supporter\":1}', '2014-09-26 10:27:25', '2014-09-26 10:27:25');
INSERT INTO `groups` VALUES ('3', 'user', '{\"user\":1}', '2014-09-26 10:27:25', '2014-09-26 10:27:25');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2012_12_06_225921_migration_cartalyst_sentry_install_users', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225929_migration_cartalyst_sentry_install_groups', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', '1');
INSERT INTO `migrations` VALUES ('2014_09_11_025849_users', '2');
INSERT INTO `migrations` VALUES ('2014_09_11_025900_cs_service_types', '2');
INSERT INTO `migrations` VALUES ('2014_09_11_025922_cs_status', '2');
INSERT INTO `migrations` VALUES ('2014_09_11_030022_cs_budgets', '2');
INSERT INTO `migrations` VALUES ('2014_09_11_030034_cs_items', '2');
INSERT INTO `migrations` VALUES ('2014_09_11_030046_cs_messages', '2');
INSERT INTO `migrations` VALUES ('2014_09_24_015252_t_powerful', '2');
INSERT INTO `migrations` VALUES ('2014_09_24_020029_t_categories', '2');
INSERT INTO `migrations` VALUES ('2014_09_24_020204_t_themes', '2');
INSERT INTO `migrations` VALUES ('2014_09_24_020609_t_theme_images', '2');
INSERT INTO `migrations` VALUES ('2014_09_24_020616_t_theme_logs', '2');
INSERT INTO `migrations` VALUES ('2014_09_24_020721_t_orders', '2');

-- ----------------------------
-- Table structure for `throttle`
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------

-- ----------------------------
-- Table structure for `t_categories`
-- ----------------------------
DROP TABLE IF EXISTS `t_categories`;
CREATE TABLE `t_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_categories
-- ----------------------------
INSERT INTO `t_categories` VALUES ('1', 'Drupal', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');
INSERT INTO `t_categories` VALUES ('2', 'Joomla', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');
INSERT INTO `t_categories` VALUES ('3', 'Wordpress', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');

-- ----------------------------
-- Table structure for `t_orders`
-- ----------------------------
DROP TABLE IF EXISTS `t_orders`;
CREATE TABLE `t_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `theme_id` int(10) unsigned NOT NULL,
  `ordered_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `t_orders_user_id_index` (`user_id`),
  KEY `t_orders_theme_id_index` (`theme_id`),
  CONSTRAINT `t_orders_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `t_themes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `t_powerful`
-- ----------------------------
DROP TABLE IF EXISTS `t_powerful`;
CREATE TABLE `t_powerful` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public/images/icon.png',
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_powerful
-- ----------------------------
INSERT INTO `t_powerful` VALUES ('1', 'HTML 5', 'public/images/icon.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ');
INSERT INTO `t_powerful` VALUES ('2', 'CSS3', 'public/images/icon.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ');
INSERT INTO `t_powerful` VALUES ('3', 'Custom Typography', 'public/images/icon.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ');
INSERT INTO `t_powerful` VALUES ('4', 'Responsive Design', 'public/images/icon.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ');
INSERT INTO `t_powerful` VALUES ('5', 'Custom Fonts', 'public/images/icon.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ');

-- ----------------------------
-- Table structure for `t_themes`
-- ----------------------------
DROP TABLE IF EXISTS `t_themes`;
CREATE TABLE `t_themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `features` text COLLATE utf8_unicode_ci,
  `powerful_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1.0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `t_themes_category_id_index` (`category_id`),
  CONSTRAINT `t_themes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `t_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_themes
-- ----------------------------

-- ----------------------------
-- Table structure for `t_theme_images`
-- ----------------------------
DROP TABLE IF EXISTS `t_theme_images`;
CREATE TABLE `t_theme_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `theme_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `t_theme_images_theme_id_index` (`theme_id`),
  CONSTRAINT `t_theme_images_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `t_themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_theme_images
-- ----------------------------

-- ----------------------------
-- Table structure for `t_theme_logs`
-- ----------------------------
DROP TABLE IF EXISTS `t_theme_logs`;
CREATE TABLE `t_theme_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `theme_id` int(10) unsigned NOT NULL,
  `changed_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `t_theme_logs_theme_id_index` (`theme_id`),
  CONSTRAINT `t_theme_logs_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `t_themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_theme_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public/images/avatar.png',
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin@admin.com', '$2y$10$NMSCEg5iBkjVPMocD1HNPeFgjP0n.njpKse0sIAkSNiNJTtNcGXEe', null, '1', null, null, null, null, null, 'John', 'Nguyen', '2014-09-26 10:27:25', '2014-09-26 10:27:25', '', '123456789', 'skypename', 'public/images/avatar.png', 'male', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');
INSERT INTO `users` VALUES ('2', 'sup@sup.com', '$2y$10$IWxJh36NFV51Z2YkU6L2VOngdEge7G4aUfDQ2VxxI7fvgY0wxYSEK', null, '1', null, null, null, null, null, 'John', 'McClane', '2014-09-26 10:27:25', '2014-09-26 10:27:25', '', '123456789', 'skypename', 'public/images/avatar4.png', 'male', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');
INSERT INTO `users` VALUES ('3', 'member@member.com', '$2y$10$Tj63BkwnYJ2.wJuH7nQIaub/coRwtps1mzW98d/mAH.7Um6YKigB2', null, '1', null, null, null, null, null, 'Bruce', 'Wayne', '2014-09-26 10:27:25', '2014-09-26 10:27:25', '', '23564586', 'skypename', 'public/images/avatar2.png', 'male', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s');

-- ----------------------------
-- Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('1', '1');
INSERT INTO `users_groups` VALUES ('2', '2');
INSERT INTO `users_groups` VALUES ('3', '3');
