-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 01, 2024 at 08:30 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DataEntry`
--

-- --------------------------------------------------------

--
-- Table structure for table `ContactLog`
--

CREATE TABLE `ContactLog` (
  `LogID` int(11) NOT NULL,
  `FileName` varchar(50) NOT NULL,
  `FileType` varchar(10) NOT NULL,
  `LogFromDate` date DEFAULT NULL,
  `LogFromTime` time DEFAULT NULL,
  `LogToDate` date NOT NULL,
  `LogToTime` time NOT NULL,
  `LogCurrentDate` date NOT NULL,
  `LogCurrentTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserMail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `UserName`, `UserPassword`, `UserMail`) VALUES
('11579c44cdd7becc95e41b5945981dbf', 'Nirav Shah', '7af3c3f6d762d6cc0597ec3312fd5567', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UserContact`
--

CREATE TABLE `UserContact` (
  `ContactID` int(11) NOT NULL,
  `ContactName` varchar(100) NOT NULL,
  `ContactNumber1` varchar(20) NOT NULL,
  `ContactNumber2` varchar(20) NOT NULL,
  `ContactNumber3` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UserContact`
--

INSERT INTO `UserContact` (`ContactID`, `ContactName`, `ContactNumber1`, `ContactNumber2`, `ContactNumber3`, `Date`, `Time`) VALUES
(12, 'Horizon', '+911234567890', '+911122334455', '+917687584827', '2023-05-26', '19:22:33'),
(13, 'Horizon2', '+919988776655', '0', '0', '2023-06-26', '19:22:43'),
(15, 'Horizon3', '+919977442210', '+919510110251', '+618571873487', '2023-07-26', '19:57:13'),
(16, 'Horizon4', '+919990919293', '0', '0', '2023-08-26', '19:57:37'),
(17, 'Horizon5', '+44989876787', '+614989876787', '0', '2023-09-10', '11:45:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ContactLog`
--
ALTER TABLE `ContactLog`
  ADD PRIMARY KEY (`LogID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `UserContact`
--
ALTER TABLE `UserContact`
  ADD PRIMARY KEY (`ContactID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ContactLog`
--
ALTER TABLE `ContactLog`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserContact`
--
ALTER TABLE `UserContact`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
