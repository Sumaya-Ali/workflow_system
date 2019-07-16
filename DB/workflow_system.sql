-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 03:53 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workflow_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `step`
--

CREATE TABLE `step` (
  `step_id` int(11) NOT NULL,
  `step_title` text NOT NULL,
  `workflow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `step_order` int(11) NOT NULL,
  `step_flag` tinyint(1) NOT NULL,
  `step_finished_date` datetime NOT NULL,
  `step_state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`step_id`, `step_title`, `workflow_id`, `user_id`, `step_order`, `step_flag`, `step_finished_date`, `step_state`) VALUES
(4, 'workflow1_step1', 40, 6, 1, 0, '2019-07-16 06:42:07', 1),
(5, 'workflow1_step2', 40, 7, 2, 0, '2019-07-16 06:43:00', 1),
(6, 'workflow1_step3', 40, 6, 3, 0, '2019-07-16 06:43:56', 1),
(7, 'workflow1_step4', 40, 7, 4, 0, '2019-07-16 06:44:00', 1),
(8, 'workflow2_step1', 41, 6, 1, 0, '2019-07-16 06:36:05', 1),
(9, 'workflow2_step2', 41, 7, 2, 0, '2019-07-16 06:37:12', 1),
(10, 'plan', 42, 9, 1, 0, '2019-07-16 14:38:42', 1),
(11, 'design', 42, 10, 2, 0, '2019-07-16 14:40:32', 1),
(12, 'code', 42, 11, 3, 0, '2019-07-16 14:40:59', 1),
(13, 'test', 42, 10, 4, 0, '2019-07-16 14:41:33', 1),
(14, 'step1', 43, 10, 1, 0, '2019-07-16 14:42:31', 1),
(15, 'step2', 43, 11, 2, 0, '2019-07-16 14:42:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `user_password` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `creation_date`) VALUES
(1, 'admin', 'admin', '2019-07-13 00:00:00'),
(9, 'sumaya', '12345', '2019-07-16 14:25:11'),
(10, 'salam', '123', '2019-07-16 14:25:28'),
(11, 'sarah', '123', '2019-07-16 14:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

CREATE TABLE `workflow` (
  `workflow_id` int(11) NOT NULL,
  `workflow_title` text NOT NULL,
  `workflow_steps` int(11) NOT NULL,
  `workflow_creation_date` datetime NOT NULL,
  `workflow_finished_date` datetime NOT NULL,
  `workflow_priority` int(11) NOT NULL,
  `workflow_state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`workflow_id`, `workflow_title`, `workflow_steps`, `workflow_creation_date`, `workflow_finished_date`, `workflow_priority`, `workflow_state`) VALUES
(40, 'workflow1', 4, '2019-07-15 14:24:17', '2019-07-16 06:44:00', 3, 1),
(41, 'workflow2', 2, '2019-07-15 14:27:04', '2019-07-16 06:37:12', 5, 1),
(42, 'program', 4, '2019-07-16 14:35:16', '2019-07-16 14:41:33', 5, 1),
(43, 'project', 2, '2019-07-16 14:39:55', '2019-07-16 14:42:40', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `step`
--
ALTER TABLE `step`
  ADD PRIMARY KEY (`step_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `workflow`
--
ALTER TABLE `workflow`
  ADD PRIMARY KEY (`workflow_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `step`
--
ALTER TABLE `step`
  MODIFY `step_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `workflow`
--
ALTER TABLE `workflow`
  MODIFY `workflow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
