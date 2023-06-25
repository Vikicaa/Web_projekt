-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 05:59 PM
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
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_token` int(11) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `gift_id` int(11) NOT NULL,
  `gift_name` varchar(255) NOT NULL,
  `purchased` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_token` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `gift_id` int(11) DEFAULT NULL,
  `invited_token` int(11) DEFAULT NULL,
  `feedback` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `invited`
--

CREATE TABLE `invited` (
  `invited_token` int(11) NOT NULL,
  `invited_name` varchar(255) NOT NULL,
  `invited_mail` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_phone`, `user_comment`) VALUES
(1, 'asd123', '$2y$10$hokikCgJwcq2Ak8ctj8bcu/2mTBz/tRqv9DrXRvXMVaQpI1NtOucm', 'asd@asd.com', 2147483647, ''),
(2, 'asd123', '$2y$10$JG0fYGOzV3tzUhQLe3GWZOdiVF/7ao4kNRGoLxsEiRf73C5fkqa0y', 'asd@asd.com', 2147483647, ''),
(3, 'asd123', '$2y$10$ZhSItvXAznbWnSd0IN.s.ejD9aSOKmxoqm3hedT.YLlF84QFimav6', 'asd@asd.com', 2147483647, ''),
(4, 'asd123', '$2y$10$J1MVDYHBFMeRkuLvXonlxOE20Nr4K6/Bp9x3MMmbFbM6N5uhNupN6', 'asd@asd.com', 2147483647, ''),
(5, 'asd123', '$2y$10$VvVSbWqVVZiuW5Ygax9GcOLY1g6sCyJaawXCEuj8dzTQ/pnVsrAUq', 'asd@asd.com', 2147483647, ''),
(6, 'asd123', '$2y$10$.EgkfjsVqXkZfxi/8ZG07eIEQUDJge8Z09i3rQzQXcAorYu40DfYm', 'asd@asd.com', 2147483647, ''),
(7, 'asd123', '$2y$10$MpzlSsBWM3gTK6GRw1QyUOl6NuKzm4QDRyYuccgjWHPBqjgvt3ICu', 'asd@asd.com', 2147483647, ''),
(8, 'asd123', '$2y$10$m6TvI0nmrNZ.N7DF.TZK8u3meKNaBSBdZqkrzirEt4gyB4SkDDfVi', 'asd@ssss.com', 2147483647, ''),
(9, 'asd123', '$2y$10$3NrDBHNLb5Xc8/l0H7Gi4OTs5kNa4fz9ddE9QryImBzIYjON5LTxa', 'qweqwe@sd.com', 2147483647, ''),
(10, 'mark', '$2y$10$qrMzg8fPK7RSrNr.rE3WYe8AMnc2fCiTFPr1wGtBqTRz0KhqE2Q9a', 'xcvb@gmail.com', 2147483647, '');

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
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`gift_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_token`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `gift_id` (`gift_id`),
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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `gift`
  MODIFY `gift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `guests_ibfk_2` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`gift_id`),
  ADD CONSTRAINT `guests_ibfk_3` FOREIGN KEY (`invited_token`) REFERENCES `invited` (`invited_token`);

--
-- Constraints for table `invited`
--
ALTER TABLE `invited`
  ADD CONSTRAINT `invited_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `invited_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
