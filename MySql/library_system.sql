-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2015 at 04:56 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `Book_ID` varchar(10) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `ISBN` int(11) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `P_ID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_ID`, `title`, `author`, `ISBN`, `publication_date`, `P_ID`) VALUES
('1', 'comp', 'wie din', 1112, '2014-01-06', '1'),
('10', 'Angular.js', 'J Bill', 1236795046, '2010-11-16', '3'),
('11', 'Twitter Bootstrap', 'D Patel', 2147483647, '2013-07-01', '6'),
('12', 'Data Structures', 'Bushan Trivedi', 123456345, '2008-05-19', '1'),
('13', 'Big Data', 'P Majumdar', 123456213, '2000-05-15', '3'),
('14', 'Introduction to php', 'D Patel', 12334532, '2006-04-18', '4'),
('15', 'JavaScript and php', 'Mehul Roy', 123345222, '2004-05-17', '2'),
('16', 'Web Programming', 'P Saito', 123456221, '1999-07-15', '7'),
('17', 'Data Analisys', 'Minal Bhise', 12345623, '2003-12-07', '7'),
('18', 'Linux OS', 'S Saiyad', 123456343, '1998-08-08', '7'),
('19', 'Intodusction to Joomla', 'Shurti Patel', 123345234, '2005-07-07', '7'),
('2', 'Object Oriented Programing', 'wie din', 1112, '2014-01-06', '1'),
('20', 'Testing and Automatin ', 'G Patel', 123456235, '2007-04-02', '7'),
('3', 'Artificial Inteligence', 'sdf', 654, '1994-02-03', '4'),
('4', 'DBMS', 'halengu', 11555, '2005-12-05', '5'),
('5', 'Architecture', 'Ennoure', 1232, '1991-12-05', '4'),
('6', 'Data Mining', 'Whnjia Li', 2147483647, '2005-07-12', '2'),
('7', 'Web Desiging', 'Trutpti bh', 2147483647, '2002-09-16', '6'),
('8', 'Introduction to Node.js', 'Sam Joe', 1234578904, '2011-02-09', '5'),
('9', 'Java Servlet', 'M Banerjee', 2147483647, '2012-02-01', '6');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `Book_ID` varchar(10) NOT NULL DEFAULT '',
  `c_id` varchar(10) NOT NULL DEFAULT '',
  `B_Date_Time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `R_Date_Time` datetime DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `lib_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`username`, `Book_ID`, `c_id`, `B_Date_Time`, `R_Date_Time`, `fine`, `lib_id`) VALUES
('dimple.rudakia', '1', '1', '2015-05-04 03:41:56', '2015-05-24 03:41:56', 4, 'l1'),
('dimple.rudakia', '1', '1', '2015-05-04 04:46:43', '2015-05-24 04:46:43', 0, 'l1'),
('dimple.rudakia', '1', '3', '2015-05-04 01:30:38', '2015-05-24 01:30:38', 4, 'l1'),
('dimple.rudakia', '1', '4', '2015-05-04 04:15:28', '2015-05-24 04:15:28', 4, 'l1'),
('dimple.rudakia', '1', '4', '2015-05-04 04:16:18', '2015-05-24 04:16:18', 4, 'l1'),
('dimple.rudakia', '1', '4', '2015-05-04 04:46:53', '2015-05-24 04:46:53', 4, 'l1'),
('dimple.rudakia', '1', '4', '2015-05-04 04:48:24', '2015-05-24 04:48:24', 4, 'l1'),
('dimple.rudakia', '2', '1', '2015-05-04 01:30:49', '2015-05-24 01:30:49', 4, 'l2'),
('dimple.rudakia', '2', '1', '2015-05-04 04:59:12', '2015-05-24 04:59:12', 0, 'l2'),
('dimple.rudakia', '2', '2', '2015-05-04 17:05:03', '2015-05-24 17:05:03', 4, 'l2'),
('dimple.rudakia', '2', '2', '2015-05-04 20:40:10', '2015-05-24 20:40:10', 4, 'l2'),
('dimple.rudakia', '3', '2', '2015-05-04 21:03:52', '2015-05-24 21:03:52', 4, 'l2'),
('dimple.rudakia', '4', '2', '2015-05-04 01:44:06', '2015-05-24 01:44:06', 4, 'l2'),
('dimple.rudakia', '4', '2', '2015-05-04 04:47:59', '2015-05-24 04:47:59', 4, 'l2'),
('parthiv.kagtada', '3', '1', '2015-05-05 12:47:16', '2015-05-25 12:47:16', 4, 'l2'),
('parthiv.kagtada', '3', '1', '2015-05-05 13:02:57', '2015-05-25 13:02:57', 4, 'l2'),
('parthiv.kagtada', '3', '1', '2015-05-05 13:04:48', '2015-05-25 13:04:48', 4, 'l2'),
('parthiv.kagtada', '3', '1', '2015-05-05 13:06:44', '2015-05-25 13:06:44', 0, 'l2'),
('parthiv.kagtada', '4', '3', '2015-05-05 13:07:14', '2015-05-25 13:07:14', 4, 'l1'),
('parthiv.kagtada', '4', '3', '2015-05-05 13:08:10', '2015-05-25 13:08:10', 4, 'l1'),
('ruthvik.vishwa', '2', '2', '2015-05-04 22:58:11', '2015-05-24 22:58:11', 0, 'l2'),
('ruthvik.vishwa', '3', '2', '2015-05-04 23:00:44', '2015-05-24 23:00:44', 0, 'l2');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `lib_ID` varchar(10) NOT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `total_books` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`lib_ID`, `l_name`, `city`, `total_books`) VALUES
('l1', 'Manhattan Branch', 'Manhattan', 100),
('l2', 'Queens Branch', 'Queens', 125);

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE IF NOT EXISTS `copy` (
  `C_ID` varchar(10) NOT NULL DEFAULT '',
  `Book_ID` varchar(10) NOT NULL DEFAULT '',
  `Lib_ID` varchar(10) DEFAULT NULL,
  `borrowed` varchar(1) DEFAULT 'n',
  `reserved` varchar(1) DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copy`
--

INSERT INTO `copy` (`C_ID`, `Book_ID`, `Lib_ID`, `borrowed`, `reserved`) VALUES
('1', '1', 'l1', 'y', 'n'),
('1', '10', 'l1', 'n', 'n'),
('1', '14', 'l2', 'n', 'n'),
('1', '15', 'l1', 'n', 'n'),
('1', '16', 'l2', 'n', 'n'),
('1', '17', 'l1', 'n', 'n'),
('1', '18', 'l2', 'n', 'n'),
('1', '19', 'l1', 'n', 'n'),
('1', '2', 'l2', 'y', 'n'),
('1', '20', 'l1', 'n', 'n'),
('1', '3', 'l2', 'y', 'n'),
('1', '4', 'l1', 'y', 'n'),
('1', '5', 'l1', 'n', 'y'),
('1', '6', 'l1', 'n', 'y'),
('1', '7', 'l1', 'n', 'n'),
('1', '8', 'l1', 'n', 'n'),
('1', '9', 'l2', 'n', 'n'),
('2', '10', 'l1', 'n', 'n'),
('2', '14', 'l2', 'n', 'n'),
('2', '15', 'l2', 'n', 'n'),
('2', '16', 'l2', 'n', 'n'),
('2', '17', 'l2', 'n', 'n'),
('2', '19', 'l2', 'n', 'n'),
('2', '2', 'l2', 'y', 'n'),
('2', '20', 'l1', 'n', 'n'),
('2', '3', 'l2', 'y', 'n'),
('2', '4', 'l2', 'n', 'n'),
('2', '6', 'l2', 'n', 'y'),
('2', '7', 'l1', 'n', 'n'),
('2', '8', 'l1', 'n', 'n'),
('2', '9', 'l1', 'n', 'n'),
('3', '1', 'l1', 'n', 'n'),
('3', '20', 'l2', 'n', 'n'),
('3', '3', 'l2', 'n', 'n'),
('3', '4', 'l1', 'n', 'y'),
('3', '6', 'l2', 'n', 'y'),
('3', '7', 'l2', 'n', 'n'),
('3', '9', 'l2', 'n', 'n'),
('4', '1', 'l1', 'n', 'n'),
('5', '1', 'l1', 'n', 'n'),
('6', '1', 'l2', 'n', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `d_id` int(11) NOT NULL,
  `designation` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`d_id`, `designation`) VALUES
(1, 'admin'),
(2, 'reader');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `P_ID` varchar(10) NOT NULL,
  `p_name` varchar(50) DEFAULT NULL,
  `street` varchar(25) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`P_ID`, `p_name`, `street`, `City`, `State`, `zip`) VALUES
('1', 'Orielly Pvt. Ltd.', '5412', 'woodhaven', 'ny', 113444),
('2', 'Indian Express', '4144', 'woodside', 'NJ', 11244),
('3', 'New York Times', '1485', 'manhattan', 'NY', 11377),
('4', 'MC grow hill', '5689', 'vancouver', 'PA', 77144),
('5', 'Oxford Press', '7999', 'sunny side', 'CA', 22579),
('6', 'Harword', '4889', 'Seattel', 'CA', 12366),
('7', 'Effulgent Publication', '165 Grand Street', 'Brooklyn', 'NY', 11211);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `Book_ID` varchar(10) NOT NULL DEFAULT '',
  `c_id` varchar(10) NOT NULL DEFAULT '',
  `Res_Date_Time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reserved` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`username`, `Book_ID`, `c_id`, `Res_Date_Time`, `reserved`) VALUES
('dimple.rudakia', '2', '2', '2015-05-04 16:06:12', 'n'),
('dimple.rudakia', '3', '2', '2015-05-04 20:56:38', 'n'),
('dimple.rudakia', '5', '1', '2015-05-04 04:59:50', 'n'),
('dimple.rudakia', '5', '1', '2015-05-05 21:22:18', 'n'),
('dimple.rudakia', '6', '2', '2015-05-07 00:00:00', 'y'),
('parthiv.kagtada', '4', '3', '2015-05-05 13:07:58', 'n'),
('parthiv.kagtada', '4', '3', '2015-05-06 20:00:35', 'y'),
('ruthvik.vishwa', '6', '1', '2015-05-06 00:00:00', 'y'),
('sadhana.penta', '5', '1', '2015-05-06 19:32:03', 'y'),
('sadhana.penta', '6', '3', '2015-05-06 20:10:40', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `u_name` varchar(50) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `u_name`, `City`, `State`, `zip`, `phone`, `d_id`) VALUES
('aditya.deshpande', 'aditya', 'aditya', 'manhattan', 'NY', 11995, 214748364, 2),
('dhwani.mehta', 'shwani', 'Dhwani', 'AL', 'Birmingham', 1818272277, 11125, 2),
('dimple.rudakia', 'dimple', 'dimple', 'GA', 'atlanta', 2147483647, 13302, 2),
('dishant.patel', 'dishant.patel', 'dishant', 'ny', 'woodside', 2147483647, 11377, 1),
('jessica.bhatt', 'jessica', 'jessica', 'Little Rock', 'AR', 11378, 6586641, 2),
('parthiv.kagtada', 'parthiv', 'parthiv', 'TA', 'Dullas', 2147483647, 44756, 2),
('piyush.gupta', 'piyush', 'Piyush', 'denvor', 'CO', 15152, 2147483647, 2),
('pooja.shah', 'pooja', 'pooja', 'OH', 'Iowa', 2134567887, 42133, 2),
('ruthvik.vishwa', 'ruthvik', 'Ruthvik', 'NJ', 'Newbrumsvick', 2147483647, 12002, 2),
('sadhana.penta', 'sadhana', 'sadhana', 'Merietta', 'GA', 12589, 898254330, 2),
('sifa.vohera', 'sifa', 'sifa', 'detroit', 'OI', 321321, 214748364, 2),
('Udit.desai', 'udit', 'Udit', 'Phoenix', 'AZ', 65577, 123456987, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`Book_ID`), ADD KEY `P_ID` (`P_ID`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
 ADD PRIMARY KEY (`username`,`Book_ID`,`c_id`,`B_Date_Time`), ADD KEY `Book_ID` (`Book_ID`), ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
 ADD PRIMARY KEY (`lib_ID`);

--
-- Indexes for table `copy`
--
ALTER TABLE `copy`
 ADD PRIMARY KEY (`C_ID`,`Book_ID`), ADD KEY `Lib_ID` (`Lib_ID`), ADD KEY `Book_ID` (`Book_ID`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
 ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
 ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
 ADD PRIMARY KEY (`username`,`Book_ID`,`c_id`,`Res_Date_Time`), ADD KEY `Book_ID` (`Book_ID`), ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`), ADD KEY `d_id` (`d_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `publisher` (`P_ID`);

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`Book_ID`) REFERENCES `book` (`Book_ID`),
ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
ADD CONSTRAINT `borrow_ibfk_3` FOREIGN KEY (`c_id`) REFERENCES `copy` (`C_ID`);

--
-- Constraints for table `copy`
--
ALTER TABLE `copy`
ADD CONSTRAINT `copy_ibfk_1` FOREIGN KEY (`Lib_ID`) REFERENCES `branch` (`lib_ID`),
ADD CONSTRAINT `copy_ibfk_2` FOREIGN KEY (`Book_ID`) REFERENCES `book` (`Book_ID`);

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`Book_ID`) REFERENCES `book` (`Book_ID`),
ADD CONSTRAINT `reserve_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
ADD CONSTRAINT `reserve_ibfk_3` FOREIGN KEY (`c_id`) REFERENCES `copy` (`C_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `designation` (`d_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
