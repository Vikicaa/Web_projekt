-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 10:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(60) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_phone`) VALUES
(1, 'hkmark', '12345678', 'hkmark2002@gmail.com', '0637596344'),
(2, 'vikica', '12345678', 'viktor2xx1@gmail.com', '0635678342');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comtext` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_location`, `event_price`, `user_id`) VALUES
(7, 'Szakdolgozat', '2023-06-15', 'Subotica', 2222, 35),
(8, 'Diplomalas', '2023-07-01', 'Cantavir', 123, 35),
(9, 'Stat vizsga', '2023-06-30', 'Szabadkan a VTS-n', 480, 37);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_token` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `invited_token` int(11) DEFAULT NULL,
  `bring_gift` tinyint(1) NOT NULL DEFAULT 0,
  `feedback` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_token`, `event_id`, `invited_token`, `bring_gift`, `feedback`) VALUES
(10, 9, 1, 1, 2),
(11, 9, 1, 0, 1),
(12, 9, 1, 0, 1),
(13, 9, 1, 0, 1),
(14, 9, 1, 0, 1),
(15, 9, 1, 0, 1),
(16, 9, 1, 0, 1),
(17, 9, 1, 0, 1),
(18, 9, 1, 0, 1),
(19, 9, 1, 0, 1),
(20, 9, 1, 0, 1),
(21, 9, 1, 0, 1),
(22, 9, 1, 0, 1),
(23, 9, 1, 0, 1),
(24, 9, 1, 0, 1),
(25, 9, 1, 0, 1),
(26, 9, 1, 0, 1),
(27, 9, 1, 0, 1),
(28, 9, 1, 0, 1),
(29, 9, 1, 0, 1),
(30, 9, 1, 0, 1),
(31, 9, 1, 0, 1),
(32, 9, 1, 0, 1),
(33, 9, 1, 0, 1),
(34, 9, 1, 0, 1),
(35, 9, 1, 0, 1),
(36, 9, 1, 0, 1),
(37, 9, 1, 0, 1),
(38, 9, 1, 0, 1),
(39, 9, 1, 0, 1),
(40, 9, 1, 0, 1),
(41, 9, 1, 0, 1),
(42, 9, 1, 0, 1),
(43, 9, 1, 0, 1),
(44, 9, 1, 0, 1),
(45, 9, 1, 0, 1),
(46, 9, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invited`
--

CREATE TABLE `invited` (
  `invited_token` int(11) NOT NULL,
  `invited_mail` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `invited`
--

INSERT INTO `invited` (`invited_token`, `invited_mail`, `user_id`, `event_id`) VALUES
(1, 'viktor20010105@gmail.com', 37, 9),
(11, 'hkmark2002@gmail.com', 35, 7),
(5591, 'hkmark2002@gmail.com', 35, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` int(15) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_phone`, `activation_key`, `activated`) VALUES
(35, 'mark', '$2y$10$o5QqTFm5x5JQV.q3Ion/7eUzNHMtrdVyyJmA9zy1IPeSeOUI5gKp6', 'markhorvathkavai@gmail.com', 637596344, '0lzK2xV3cC8DwqzhDLaQcCKJPFewhu0C', 1),
(37, 'Vikica', '$2y$10$xP7Z0eGECs93XxEagVCIPeWsgoBYME1e/ysfuHyTrZxKEbfeZxhxC', 'viktor2xx1@gmail.com', 638821856, 'ivL6F7fUL6VOH5zloAyViuSHRVLqYf8f', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_token`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `invited_token` (`invited_token`);

--
-- Indexes for table `invited`
--
ALTER TABLE `invited`
  ADD PRIMARY KEY (`invited_token`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `invited`
--
ALTER TABLE `invited`
  MODIFY `invited_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5592;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guests_ibfk_3` FOREIGN KEY (`invited_token`) REFERENCES `invited` (`invited_token`) ON DELETE CASCADE;

--
-- Constraints for table `invited`
--
ALTER TABLE `invited`
  ADD CONSTRAINT `invited_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invited_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
