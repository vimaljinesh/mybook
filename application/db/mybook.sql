/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : mybook

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-08-15 00:00:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `book_marks`
-- ----------------------------
DROP TABLE IF EXISTS `book_marks`;
CREATE TABLE `book_marks` (
  `pk_bookmark_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `vchr_url` varchar(255) DEFAULT NULL,
  `fk_category_id` bigint(20) DEFAULT NULL,
  `fk_sub_category_id` bigint(20) DEFAULT NULL,
  `vchr_description` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_bookmark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of book_marks
-- ----------------------------

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `pk_categorie_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `chr_type` char(3) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_categorie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `pk_group_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `chr_type` char(3) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of groups
-- ----------------------------

-- ----------------------------
-- Table structure for `notes`
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `pk_note_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(225) DEFAULT NULL,
  `fk_category_id` bigint(20) DEFAULT NULL,
  `fk_sub_category_id` bigint(20) DEFAULT NULL,
  `txt_note` longtext,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_note_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notes
-- ----------------------------

-- ----------------------------
-- Table structure for `phone_book_master`
-- ----------------------------
DROP TABLE IF EXISTS `phone_book_master`;
CREATE TABLE `phone_book_master` (
  `pk_phone_book_master_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `fk_group_id` bigint(20) DEFAULT NULL,
  `fk_sub_group_id` bigint(20) DEFAULT NULL,
  `vchr_address` varchar(255) DEFAULT NULL,
  `vchr_description` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_phone_book_master_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of phone_book_master
-- ----------------------------

-- ----------------------------
-- Table structure for `phone_book_sub`
-- ----------------------------
DROP TABLE IF EXISTS `phone_book_sub`;
CREATE TABLE `phone_book_sub` (
  `pk_phone_book_sub` bigint(20) NOT NULL AUTO_INCREMENT,
  `fk_phone_book_master_id` bigint(20) DEFAULT NULL,
  `vchr_type` varchar(255) DEFAULT NULL,
  `vchr_value` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_phone_book_sub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of phone_book_sub
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `pk_user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_user` varchar(255) NOT NULL,
  `vchr_password` varchar(255) NOT NULL,
  PRIMARY KEY (`pk_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'vimaljinesh@gmail.com', 'vimal123#');
