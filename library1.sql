-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 02:09 PM
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
-- Database: `library1`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getStudent` ()   select * from student$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first`, `last`, `username`, `password`, `email`, `phone`, `pic`) VALUES
(1, 'Sathish', 'P', 'sathi11', 'sathish45*', 'sathish@gmail.com', 9884433218, 'admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `authors` varchar(100) NOT NULL,
  `edition` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `title`, `authors`, `edition`, `status`, `quantity`, `department`) VALUES
(1, 'Principle of Electronics', 'V.K.Mehta,Rohit Mehta', '3rd Edition', 'Available', 5, 'ECE'),
(2, 'The Complete Reference C++', 'Herbert Schildt', '4th ', 'Available', 2, 'CSE'),
(3, 'Data Structures', 'Seymour Lipschutz', '4th', 'Available', 4, 'CSE'),
(4, 'Mechanics of materials', 'David Jones', '5th', 'Available', 8, 'Mech'),
(5, 'Computer Networks and Protocols', 'Susan Davis', '4th', 'Available', 8, 'CSE'),
(6, 'Civil Engineering Fundamentals', 'Micheal Miller', '2nd', 'Available', 11, 'Civil'),
(7, 'Digital Signal Processing Principle', 'Thomas Anderson', '4th', 'Available', 5, 'ECE'),
(8, 'Introduction to communication systems', 'Jessica Carter', '3rd', 'Available', 11, 'ECE'),
(9, 'Introduction to Algorithms', 'Thomas Cormen', '4th', 'Available', 26, 'CSE'),
(10, 'Operating System Concepts', 'Gary Anderson', '9th', 'Available', 9, 'CSE'),
(11, 'Database Systems: Concept and Design', 'Abraham Silberschatz', '6th', 'Available', 15, 'CSE'),
(12, 'Computer graphics: Principle and Practice', 'James Smith', '3rd', 'Available', 20, 'CSE'),
(13, 'Thermodynamics: An Engineering Approach', 'John Anderson', '7th', 'Available', 10, 'Mech'),
(14, '\"Fluid Mechanics: Fundamentals and Applications\"', 'Linda Davis', '6th', 'Available', 24, 'Mech'),
(15, 'Mechanical Vibrations', 'Micheal Miller', '4th', 'Available', 15, 'Mech');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(50) NOT NULL,
  `usn` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `usn`, `comment`) VALUES
(1, '4VP21CS060', 'Opening time?'),
(2, 'Admin', 'Library opens at 9:00 AM'),
(3, 'Admin', 'Very nice experience'),
(4, '4VP21CS060', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `fine_id` int(100) NOT NULL,
  `usn` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `book_id` int(100) NOT NULL,
  `returned_date` varchar(100) DEFAULT NULL,
  `day` int(50) DEFAULT NULL,
  `fine` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`fine_id`, `usn`, `status`, `book_id`, `returned_date`, `day`, `fine`) VALUES
(1, '4VP21CS078', 'not paid', 4, '2024-03-21', 3, 3),
(2, '4VP21CS078', 'not paid', 11, '2024-03-21', 2, 2),
(3, '4VP21CS078', 'not paid', 5, '2024-03-21', 6, 6),
(4, '4VP21CS060', 'not paid', 1, '2024-03-23', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `issue_id` int(100) NOT NULL,
  `usn` varchar(100) NOT NULL,
  `book_id` varchar(100) NOT NULL,
  `approve` varchar(100) NOT NULL,
  `issue_date` varchar(100) NOT NULL,
  `return_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`issue_id`, `usn`, `book_id`, `approve`, `issue_date`, `return_date`) VALUES
(4, '4VP21CS060', '10', 'RETURNED', '2024-03-01', '2024-03-18'),
(5, '4VP21CS078', '4', 'RETURNED', '2024-03-01', '2024-03-18'),
(6, '4VP21CS078', '11', 'RETURNED', '2024-03-01', '2024-03-19'),
(7, '4VP21CS078', '5', 'RETURNED', '2024-03-01', '2024-03-15'),
(8, '4VP21CS060', '1', 'RETURNED', '2024-03-11', '2024-03-19'),
(9, '4VP21CS111', '10', '', '', ''),
(12, '4VP21CS060', '6', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(100) NOT NULL,
  `usn` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `cdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `usn`, `action`, `cdate`) VALUES
(1, '4VP21CS001', 'Inserted', '2024-03-23 13:03:28'),
(2, '4VP21CS112', 'Inserted', '2024-03-24 13:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `usn` varchar(50) NOT NULL,
  `sem` int(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `phone` bigint(200) NOT NULL,
  `deptname` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`first`, `last`, `usn`, `sem`, `section`, `phone`, `deptname`, `pic`) VALUES
('Divya', 'Bhat', '4VP21CS001', 7, 'A', 9663350782, 'CSE', 'noprof.png'),
('Havin', 'PR', '4VP21CS010', 2, 'A', 9589632110, 'CSE', 'noprof.png'),
('Dhrithi', 'Bhat', '4VP21CS060', 5, 'A', 8971112492, 'CSE', 'dhrithi.png'),
('Deepa', 'Bhat', '4VP21CS078', 6, 'A', 8197587071, 'ECE', 'noprof.png'),
('Sahana', 'S', '4VP21CS080', 5, 'C', 9880073760, 'ECE', 'noprof.png'),
('Drushya', 'Shetty', '4VP21CS088', 6, 'A', 8898897017, 'Mech', 'noprof.png'),
('Rama', 'P', '4VP21CS090', 7, 'B', 9884433219, 'CSE', 'noprof.png'),
('Asha', 'P', '4VP21CS097', 7, 'B', 8888886655, 'Mech', 'noprof.png'),
('Himani', 'PR', '4VP21CS111', 5, 'A', 9000000000, 'CSE', 'noprof.png'),
('Tashi', 'M', '4VP21CS112', 8, 'B', 9988550011, 'ECE', 'noprof.png');

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `insertLog` AFTER INSERT ON `student` FOR EACH ROW INSERT INTO logs VALUES(null,NEW.usn,"Inserted",NOW())
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`fine_id`);

--
-- Indexes for table `issue_book`
--
ALTER TABLE `issue_book`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`usn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `fine_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue_book`
--
ALTER TABLE `issue_book`
  MODIFY `issue_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
