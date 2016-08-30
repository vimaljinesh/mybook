-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2016 at 05:29 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybook`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_marks`
--

CREATE TABLE `book_marks` (
  `pk_bookmark_id` bigint(20) NOT NULL,
  `vchr_name` varchar(255) DEFAULT NULL,
  `vchr_url` varchar(255) DEFAULT NULL,
  `fk_category_id` bigint(20) DEFAULT NULL,
  `fk_sub_category_id` bigint(20) DEFAULT NULL,
  `vchr_description` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `pk_categorie_id` bigint(20) NOT NULL,
  `vchr_name` varchar(255) NOT NULL,
  `chr_type` char(3) CHARACTER SET latin1 DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`pk_categorie_id`, `vchr_name`, `chr_type`, `bln_deleted`) VALUES
(1, 'PHP', 'C', NULL),
(2, 'jQurey', 'C', NULL),
(3, 'Regular Expression', 'S', NULL),
(4, 'String Functions', 'S', NULL),
(5, 'Array Functions', 'S', NULL),
(6, 'ഇംഗ്ലീഷ്-മലയാളം', 'C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `pk_group_id` bigint(20) NOT NULL,
  `vchr_name` varchar(255) NOT NULL,
  `chr_type` char(3) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `pk_note_id` bigint(20) NOT NULL,
  `fk_category_id` bigint(20) DEFAULT NULL,
  `fk_sub_category_id` bigint(20) DEFAULT NULL,
  `txt_note` longtext,
  `bln_deleted` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phone_book_master`
--

CREATE TABLE `phone_book_master` (
  `pk_phone_book_master_id` bigint(20) NOT NULL,
  `vchr_name` varchar(255) DEFAULT NULL,
  `fk_group_id` bigint(20) DEFAULT NULL,
  `pk_sub_group_id` bigint(20) DEFAULT NULL,
  `vchr_address` varchar(255) DEFAULT NULL,
  `vchr_description` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phone_book_sub`
--

CREATE TABLE `phone_book_sub` (
  `pk_phone_book_sub` bigint(20) NOT NULL,
  `fk_phone_book_master_id` bigint(20) NOT NULL,
  `vchr_type` varchar(255) DEFAULT NULL,
  `vchr_value` varchar(255) DEFAULT NULL,
  `bln_deleted` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_marks`
--
ALTER TABLE `book_marks`
  ADD PRIMARY KEY (`pk_bookmark_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`pk_categorie_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`pk_group_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`pk_note_id`);

--
-- Indexes for table `phone_book_master`
--
ALTER TABLE `phone_book_master`
  ADD PRIMARY KEY (`pk_phone_book_master_id`);

--
-- Indexes for table `phone_book_sub`
--
ALTER TABLE `phone_book_sub`
  ADD PRIMARY KEY (`pk_phone_book_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `pk_categorie_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `pk_group_id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
