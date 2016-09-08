
CREATE TABLE IF NOT EXISTS `book_marks` (
  `pk_bookmark_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `vchr_url` varchar(255) DEFAULT NULL,
  `fk_category_id` bigint(20) DEFAULT NULL,
  `fk_sub_category_id` bigint(20) DEFAULT NULL,
  `vchr_description` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_bookmark_id`)
);

CREATE TABLE IF NOT EXISTS `categories` (
  `pk_categorie_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `chr_type` char(3) CHARACTER SET latin1 DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_categorie_id`)
);

CREATE TABLE IF NOT EXISTS `groups` (
  `pk_group_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `chr_type` char(3) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_group_id`)
);

CREATE TABLE IF NOT EXISTS `notes` (
  `pk_note_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(225) DEFAULT NULL,
  `fk_category_id` bigint(20) DEFAULT NULL,
  `fk_sub_category_id` bigint(20) DEFAULT NULL,
  `txt_note` longtext,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_note_id`)
);

CREATE TABLE IF NOT EXISTS `phone_book_master` (
  `pk_phone_book_master_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vchr_name` varchar(255) DEFAULT NULL,
  `fk_group_id` bigint(20) DEFAULT NULL,
  `fk_sub_group_id` bigint(20) DEFAULT NULL,
  `vchr_address` varchar(255) DEFAULT NULL,
  `vchr_description` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_phone_book_master_id`)
);

CREATE TABLE IF NOT EXISTS `phone_book_sub` (
  `pk_phone_book_sub` bigint(20) NOT NULL AUTO_INCREMENT,
  `fk_phone_book_master_id` bigint(20) DEFAULT NULL,
  `vchr_type` varchar(255) DEFAULT NULL,
  `vchr_value` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pk_phone_book_sub`)
);
