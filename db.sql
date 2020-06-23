-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 23, 2020 at 04:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(9) NOT NULL,
  `contenu` text,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `sender_id` int(9) DEFAULT NULL,
  `receiver_id` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `contenu`, `date`, `sender_id`, `receiver_id`) VALUES
(1, 'test', '2020-06-23 17:17:12', 1, 2),
(2, 'test eeee', '2020-06-23 17:17:21', 1, 2),
(3, 'test', '2020-06-23 17:17:50', 1, 2),
(4, 'cc', '2020-06-23 17:17:58', 2, 1),
(5, 'hi', '2020-06-23 17:18:05', 1, 2),
(6, 'fff', '2020-06-23 17:18:16', 2, 1),
(7, 'vvv', '2020-06-23 17:18:24', 2, 1),
(8, 'tests', '2020-06-23 17:18:41', 1, 2),
(9, 'tests$', '2020-06-23 17:18:44', 1, 2),
(10, 'sdsdsd', '2020-06-23 17:18:45', 1, 2),
(11, 'dsdsd', '2020-06-23 17:18:46', 1, 2),
(12, 'sdsd', '2020-06-23 17:18:46', 1, 2),
(13, 'sdsd', '2020-06-23 17:18:47', 1, 2),
(14, 'sdsd', '2020-06-23 17:18:48', 1, 2),
(15, 'sdsd', '2020-06-23 17:18:48', 1, 2),
(16, 'sdsdee', '2020-06-23 17:18:50', 1, 2),
(17, 'rrr', '2020-06-23 17:18:52', 1, 2),
(18, '\"\"\"', '2020-06-23 17:18:54', 1, 2),
(19, 'fff', '2020-06-23 17:18:55', 1, 2),
(20, 'zz', '2020-06-23 17:18:58', 1, 2),
(21, 'eee', '2020-06-23 17:18:59', 1, 2),
(22, 'rrr', '2020-06-23 17:19:00', 1, 2),
(23, 'test', '2020-06-23 17:23:45', 1, 2),
(24, 'cc', '2020-06-23 17:26:07', 1, 2),
(25, 'eeee', '2020-06-23 17:26:32', 1, 2),
(26, 'eee', '2020-06-23 17:27:26', 1, 2),
(27, 'ssss', '2020-06-23 17:29:05', 1, 2),
(28, 'zzz', '2020-06-23 17:30:52', 1, 2),
(29, 'testtt', '2020-06-23 17:31:43', 1, 2),
(30, 'hello', '2020-06-23 17:31:55', 2, 1),
(31, 'cv ?', '2020-06-23 17:32:24', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `nom` varchar(100) DEFAULT '',
  `mail` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL,
  `logged_in` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `mail`, `password`, `logged_in`) VALUES
(1, 'Noor', 'noor@orange.com', 'noor', 1),
(2, 'Skander', 'skander@orange.com', 'skander', 1),
(3, 'Wael', 'wael@orange.com', 'wael', 0),
(4, 'Nizar', 'nizar@orange.com', 'nizar', 1),
(5, 'Rania', 'rania@orange.com', 'rania', 0),
(6, 'Rim', 'rim@orange.com', 'rim', 0),
(7, 'Hamza', 'hamza@orange.com', 'hamza', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
