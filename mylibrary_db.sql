-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 01:48 PM
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
-- Database: `mylibrary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookId` int(11) NOT NULL,
  `BookName` varchar(20) DEFAULT NULL,
  `CreatedOn` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookId`, `BookName`, `CreatedOn`) VALUES
(11, 'Sherlock Holmes', '2023-07-13'),
(12, 'Three Men In A Boat', '2023-07-13'),
(17, 'The Alchemist', '2023-07-18'),
(18, 'Twilight', '2023-07-20'),
(19, 'Oliver Twist', '2023-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `BookId` int(11) NOT NULL,
  `BookName` varchar(20) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `IssuedOn` date NOT NULL,
  `DueOn` date NOT NULL,
  `ReturnedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`BookId`, `BookName`, `UserName`, `IssuedOn`, `DueOn`, `ReturnedOn`) VALUES
(12, '', 'Susan', '2023-07-18', '2023-07-25', '2023-07-18'),
(17, '', 'Aathira', '2023-07-19', '2023-07-23', '2023-07-20'),
(19, '', 'Tom', '2023-07-20', '2023-07-11', '2023-07-20'),
(26, '', 'Anna', '2023-07-22', '2023-07-29', NULL),
(28, '', 'Tia', '2023-07-23', '2023-07-30', '2023-07-23'),
(17, '', 'aaa', '2023-07-24', '2023-07-23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

