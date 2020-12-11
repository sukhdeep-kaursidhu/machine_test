-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2020 at 06:48 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formData`
--

-- --------------------------------------------------------

--
-- Table structure for table `userData`
--

CREATE TABLE `userData` (
  `user_id` int(100) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `phone` int(100) NOT NULL,
  `designation` text NOT NULL,
  `gender` text NOT NULL,
  `hobbies` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userData`
--

INSERT INTO `userData` (`user_id`, `first_name`, `last_name`, `email`, `dob`, `phone`, `designation`, `gender`, `hobbies`) VALUES
(1, 'Person', 'Second', 'person2@gmail.com', '1-January-2020', 1212121212, 'dddddd', 'male', 'singing,reading,writing,'),
(2, 'Person ', 'Third', 'person3@gmail.com', '1-January-2020', 1212121212, 'Trainee', 'male', 'reading,dancing,'),
(3, 'a', 'a', 'a@gmail.com', '1-January-2020', 1212121212, 'aa', 'female', 'singing,'),
(4, '', 'a', 'a@gmail.com', '1-January-2020', 1212121212, 'aa', 'female', 'singing,'),
(5, 'a', 'b', 'c@gmail.com', '1-January-2020', 1212121212, 'aaa', 'female', 'reading,'),
(6, 'a', 'b', 'c@gmail.com', '1-January-2020', 1212121212, 'aaa', 'female', 'reading,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userData`
--
ALTER TABLE `userData`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userData`
--
ALTER TABLE `userData`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
