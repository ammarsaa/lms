-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 11:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `profile_picture` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `admin_email`, `user_name`, `password`, `reg_date`, `updation_date`, `status`, `profile_picture`) VALUES
(1, 'Syed Ammar Ahmed', 'syedammarahmed14@outlook.com', 'Ammar S.A.A', '123465789', '2020-07-13 08:28:12', '2020-07-24 18:47:02', 'Active', 'syed-ammar-ahmed small.png'),
(2, 'Muhammad Tariq Hafiz', 'itsmth@gmail.com', 'M.T.H', 'Itsmth@gmail.com132', '2020-07-13 08:28:12', '2020-07-24 17:13:00', 'Active', 'form-man.jpg'),
(3, 'Sheema Sadia', 'onlysheema@gmail.com', 'S.S', 'Onlysheema@gmail.com13', '2020-07-13 08:28:12', '2020-07-23 10:18:16', 'Active', 'form-woman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `author_name` varchar(159) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_name_urdu` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `author_name`, `author_name_urdu`, `creation_date`, `updation_date`) VALUES
(1, ' C.S Lewis', NULL, '2020-04-23 11:50:45', '2020-06-24 12:29:02'),
(2, 'Doctor Imran Mushtaq', 'ÚˆØ§Ú©Ù¹Ø± Ø¹Ù…Ø±Ø§Ù† Ù…Ø´ØªØ§Ù‚', '2020-04-07 14:00:00', '2020-06-24 12:36:48'),
(3, 'Enid Blyton', NULL, '2020-04-14 08:53:52', '2020-06-24 12:29:26'),
(4, 'Ishtiaq Ahmed', 'Ø§Ø´ØªÛŒØ§Ù‚ Ø§Ø­Ù…Ø¯', '2020-04-16 11:11:28', '2020-06-24 12:36:07'),
(5, 'Ibn E Safi', 'Ø§Ø¨Ù†Ù ØµÙÛŒ', '2020-04-16 11:11:51', '2020-06-24 12:36:22'),
(6, 'Jenny Nimmo', NULL, '2020-04-22 10:38:21', '2020-06-24 12:29:47'),
(7, 'Lemony Snicket', NULL, '2020-04-22 10:53:41', '2020-06-24 12:29:51'),
(8, 'Elspeth Graham', NULL, '2020-04-22 14:23:23', '2020-06-24 12:29:53'),
(9, 'J.K Rowling', NULL, '2020-04-22 14:23:41', '2020-06-24 12:29:56'),
(10, 'Roderick Hunt and Alex Brychta', NULL, '2020-04-23 11:42:10', '2020-06-24 12:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `book_pic` text COLLATE utf8_unicode_ci NOT NULL,
  `book_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_name_urdu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `isbn_number` int(100) DEFAULT NULL,
  `book_price` int(11) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `book_pic`, `book_name`, `book_name_urdu`, `cat_id`, `author_id`, `isbn_number`, `book_price`, `reg_date`, `updation_date`, `status`) VALUES
(1, 'capture.PNG', '19 & 20: Famous Five |The Case of Gobbling Goop & The Case of The Surfer Dude Who is Truly Rude', NULL, 2, 3, 2147483647, 700, '2020-04-08 14:00:00', '2020-08-10 09:26:51', NULL),
(2, 'Picture111.png', 'Daylight Robbery', '', 3, 2, 0, 0, '2020-04-14 12:28:58', '2020-08-10 09:26:57', NULL),
(3, '', 'Computer Test Book', 'Ú©Ù…Ù¾ÛŒÙˆÙ¹Ø± Ù¹ÛŒØ³Ù¹ Ø¨Ú©', 4, 3, 1230, 299, '2020-04-16 07:06:33', '2020-08-10 09:27:02', NULL),
(4, '', 'Novel', '', 7, 7, 1230, 299, '2020-04-22 14:49:23', '2020-08-10 09:27:08', NULL),
(5, '', 'Test Book', 'Ù¹ÛŒØ³Ù¹ Ø¨Ú©', 3, 3, 1230, 299, '2020-04-23 09:18:39', '2020-08-10 09:26:59', NULL),
(6, '', 'Castle Adventure', '', 3, 10, 2147483647, 150, '2020-04-23 11:30:38', '2020-08-10 09:26:55', NULL),
(7, '', 'The Dragon\'s Child', NULL, 3, 6, 340673044, 570, '2020-04-23 11:32:51', '2020-08-10 09:27:04', NULL),
(8, '', '15: Secret Seven | Fun For The Secret Seven  English', NULL, 7, 3, 340182415, 200, '2020-07-07 14:24:05', '2020-08-10 09:27:13', NULL),
(9, '', 'Ghaar Ka Samandar', 'ØºØ§Ø± Ú©Ø§ Ø³Ù…Ù†Ø¯Ø±', 2, 4, 123, 700, '2020-07-30 09:34:21', '2020-08-10 09:27:16', NULL),
(10, '', 'Test', 'Ù¹ÛŒØ³Ù¹', 3, 3, 1230, 299, '2020-07-30 09:46:54', '2020-08-10 09:27:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `category_name`, `status`, `creation_date`, `updation_date`) VALUES
(1, 'Urdu Magazine', 'Active ', '2020-04-23 11:48:32', '2020-06-24 12:16:43'),
(2, 'Urdu Novel', 'Active', '2020-04-14 10:43:39', '2020-06-24 12:42:23'),
(3, 'English Story Book', 'Active', '2020-04-14 12:37:53', '2020-06-24 12:42:52'),
(4, 'Computer Science', 'Active ', '2020-04-15 10:13:21', '2020-06-24 12:16:50'),
(5, 'English Encyclopedia', 'Active ', '2020-04-22 10:54:34', '2020-06-24 12:16:53'),
(6, 'Urdu Encyclopedia', 'Active ', '2020-04-23 09:14:35', '2020-06-24 12:16:56'),
(7, 'English Novel', 'Active', '2020-06-24 12:43:25', '2020-07-16 15:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `id` int(3) NOT NULL,
  `feedback` text COLLATE utf8_unicode_ci NOT NULL,
  `feedback_urdu` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(3) NOT NULL,
  `email_id` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`id`, `feedback`, `feedback_urdu`, `user_id`, `email_id`, `creation_date`) VALUES
(1, 'Wow Nice!', '', 1, 's.ammarahmed14@gmail.com', '2020-08-09 08:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbooksdetail`
--

CREATE TABLE `tblissuedbooksdetail` (
  `id` int(4) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `user_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `return_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `return_status` tinyint(4) DEFAULT '0',
  `fine` int(11) DEFAULT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblrulesandregulations`
--

CREATE TABLE `tblrulesandregulations` (
  `id` int(11) NOT NULL,
  `rule` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rule_urdu` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblrulesandregulations`
--

INSERT INTO `tblrulesandregulations` (`id`, `rule`, `rule_urdu`, `creation_date`, `updation_date`) VALUES
(1, 'Before Donating anything write your name on it with full Date. \r\nExample: \r\nDonated To Masooma Library \r\nName: Sadia Date:1-January-2019 Day: Tuesday.', 'Ù„Ø§Ø¦Ø¨Ø±ÛŒØ±ÛŒ Ù…ÛŒÚº Ú©ÙˆØ¦ Ø¨Ú¾ÛŒ Ú†ÛŒØ² ÙˆÙ‚Ù Ú©Ø±Ù†Û’ Ø³Û’ Ù¾ÛÙ„Û’ Ø§Ø³ Ù¾Ø± Ø§Ù¾Ù†Ø§ Ù†Ø§Ù… Ø¨Ù…Ø¹ Ù…Ú©Ù…Ù„ ØªØ§Ø±ÛŒØ® Ø¯Ø±Ø¬ Ú©Ø±ÛŒÚºÛ” \r\n:Ù…Ø«Ø§Ù„\r\nÙˆÙ‚Ù Ø¨Ø±Ø§Û“ Ù…Ø¹ØµÙˆÙ…Û Ù„Ø§Ø¦Ø¨Ø±ÛŒØ±ÛŒ\r\n Ù†Ø§Ù…: Ø³Ø¹Ø¯ÛŒÛ ØªØ§Ø±ÛŒØ®: Û± Ø¬Ù†ÙˆØ±ÛŒ Û²Û°Û±Û¹Ø¡ Ø¨Ø±ÙˆØ²: Ù…Ù†Ú¯Ù„', '2020-07-06 17:47:55', '2020-07-30 08:44:47'),
(2, 'After Donating, the book or the the thing which have been donated will be  not be yours (it will be of library) and you can\'t take Donated thing back.', 'Ù„Ø§Ø¦Ø¨Ø±ÛŒØ±ÛŒ Ù…ÛŒÚº Ú©ÙˆØ¦ Ø³ÛŒ Ø¨Ú¾ÛŒ Ú†ÛŒØ² ÙˆÙ‚Ù Ú©Ø±Ù†Û’ Ú©Û’ Ø¨Ø¹Ø¯ØŒ Ø¢Ù¾ Ú©ÛŒ Ù†ÛÛŒÚº Ø±ÛÛ’ Ú¯ÛŒ (Ù„Ø§Ø¦Ø¨Ø±ÛŒØ±ÛŒ Ú©ÛŒ ÛÙˆ Ø¬Ø§Ø¦Û’ Ú¯ÛŒ) Ø§ÙˆØ± Ø¢Ù¾ Ø§Ø³ Ú†ÛŒØ² Ú©Ùˆ ÙˆØ§Ù¾Ø³ Ù†ÛÛŒÚº Ù„Û’ Ø³Ú©ØªÛ’Û”', '2020-07-21 15:51:51', '2020-07-30 08:57:44'),
(3, 'You can only borrow one book at a time.', 'Ø¢Ù¾ Ø§ÛŒÚ© ÙˆÙ‚Øª Ù…ÛŒÚº Ø§ÛŒÚ© ÛÛŒ Ú©ØªØ§Ø¨ Ø§Ø¯Ú¾Ø§Ø± Ú©Ø± Ø³Ú©ØªÛ’ ÛÛŒÚºÛ”', '2020-07-21 16:10:53', '2020-07-30 09:00:31'),
(4, 'Maximum days of borrowing a book are 10 days.', 'Ø¢Ù¾ Ú©ØªØ§Ø¨ Ú©Ùˆ Ø²ÛŒØ§Ø¯Û Ø³Û’ Ø²ÛŒØ§Ø¯Û Û±Û° Ø¯Ù† ØªÚ© Ø§Ø¯Ú¾Ø§Ø± Ú©Ø± Ø³Ú©ØªÛ’ ÛÛŒÚºÛ”', '2020-07-21 16:11:10', '2020-07-30 09:25:48'),
(5, 'After 10 days (of borrowing), \"fine of 2 Rs.\" (per day) will be charged.', 'Ø¯Ø³ Ø¯Ù† Ø¨Ø¹Ø¯ (Ú©Ø³ÛŒ Ú†ÛŒØ² Ú© ÙˆØ§Ø¯Ú¾Ø§Ø± Ú©Ø±Ù†Û’ Ú©Û’)ØŒ \"Û² Ø±ÙˆÙ¾Û’ (ÙÛŒ Ø¯Ù†)\" Ú©Û’ Ø­Ø³Ø§Ø¨ Ø³Û’ Ø¬Ø±Ù…Ø§Ù†Û Ù„ÛŒØ§ Ø¬Ø§Ø¦Û’ Ú¯Ø§Û”', '2020-07-21 16:11:25', '2020-07-30 09:27:10'),
(6, 'Turning the corner of the page and writing in book isn\'t allowed; if you turn or write so, \"10 Rs. fine\" (per page) will be charged.', 'Ú©Ø³ÛŒ Ú©ØªØ§Ø¨ Ú©Û’ ØµÙØ­Û Ú©Û’ Ú©Ù†Ø§Ø±Û’ Ú©Ùˆ Ù…ÙˆÚ‘Ù†Ø§ ÛŒØ§ Ù¾Ú¾Ø± Ø§Ø³ Ù…ÛŒÚº Ù„Ú©Ú¾Ù†Ø§ Ù…Ù…Ù†ÙˆØ¹ ÛÛ’ Ù„ÛŒÚ©Ù† Ø§Ú¯Ø± Ø¢Ù¾ Ù†Û’ Ú©ÛŒØ§ ØªÙˆ Ø¢Ù¾ Ù¾Ø± \"Û±Û° Ø±ÙˆÙ¾Û’\" (ÙÛŒ ØµÙØ­Û) Ú©Û’ Ø­Ø³Ø§Ø¨ Ø³Û’ Ø¬Ø±Ù…Ø§Ù†Û Ø¹Ø§Ø¦Ø¯ ÛÙˆÚ¯Ø§Û”', '2020-07-21 16:11:37', '2020-07-30 09:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `tblslider`
--

CREATE TABLE `tblslider` (
  `id` int(3) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slider_img` text COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblslider`
--

INSERT INTO `tblslider` (`id`, `title`, `slider_img`, `content`, `creation_date`, `updation_date`) VALUES
(1, 'test title', 'author.png', 'test', '2020-07-13 18:04:15', '2020-07-13 18:42:16'),
(2, 'test title2', 'author1.png', '123456789 test', '2020-07-13 18:43:39', '2020-07-13 18:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture` text COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_role` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `full_name`, `email_id`, `mobile_no`, `user_name`, `password`, `status`, `profile_picture`, `reg_date`, `updation_date`, `user_role`) VALUES
(1, 'Syed Ammar Ahmed', 's.ammarahmed14@gmail.com', '03342756490', 'S.A.A', '123@Masoomalibrary', 'Active', 'image-removebg-preview.png', '2020-04-18 22:08:17', '2020-07-24 16:50:31', 'User'),
(2, 'Sheema Sadia Safdar', 'onlysheema@gmail.com', '123', 'SS', '123@Sheema', 'Active', 'users1.png', '2020-04-14 01:58:54', '2020-08-06 18:31:35', 'User'),
(3, 'Syeda Hania Sameer', 'syedammarahmed14@outlook.com', '03342786490', 'SHS', '123@Hania', 'Active', '', '2020-04-15 18:59:06', '2020-08-06 18:31:43', 'User'),
(4, 'Muhemmad Humza Bin Najam Us Saquib', 'emailhumza@gmail.com', '03452672902', 'MH', 'tHgq6yM4unp3CJM', 'Active', 'Picture111.png', '2020-08-19 19:10:11', '2020-08-19 14:14:56', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`),
  ADD UNIQUE KEY `author_name` (`author_name`),
  ADD UNIQUE KEY `author_name_urdu` (`author_name_urdu`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE,
  ADD UNIQUE KEY `book_name` (`book_name`,`isbn_number`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbooksdetail`
--
ALTER TABLE `tblissuedbooksdetail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`);

--
-- Indexes for table `tblrulesandregulations`
--
ALTER TABLE `tblrulesandregulations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblslider`
--
ALTER TABLE `tblslider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblissuedbooksdetail`
--
ALTER TABLE `tblissuedbooksdetail`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblrulesandregulations`
--
ALTER TABLE `tblrulesandregulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblslider`
--
ALTER TABLE `tblslider`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
