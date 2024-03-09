-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 09:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customer-feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `customerfeedbacks`
--

CREATE TABLE `customerfeedbacks` (
  `FeedbackID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `FeedbackTitle` varchar(50) NOT NULL,
  `FeedbackContent` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerfeedbacks`
--

INSERT INTO `customerfeedbacks` (`FeedbackID`, `Email`, `FeedbackTitle`, `FeedbackContent`) VALUES
(1, 'johanmariocampo@gmail.com', 'Iron Man Funko', 'Are there any more Iron Man funko pops in your inventory?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerfeedbacks`
--
ALTER TABLE `customerfeedbacks`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerfeedbacks`
--
ALTER TABLE `customerfeedbacks`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
