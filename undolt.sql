-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2022 at 11:07 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `undolt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aName` varchar(100) NOT NULL,
  `aPass` varchar(255) NOT NULL,
  `aContact` varchar(20) NOT NULL,
  `aEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aName`, `aPass`, `aContact`, `aEmail`) VALUES
(1, 'Undolt', 'Undolt@2022', '9876543210', 'Undolt@2022');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `subject` varchar(100) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `info` varchar(10000) DEFAULT NULL,
  `file1` varchar(200) DEFAULT NULL,
  `file2` varchar(200) DEFAULT NULL,
  `file3` varchar(200) DEFAULT NULL,
  `file4` varchar(200) DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `aStatus` varchar(100) DEFAULT NULL,
  `qid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `deadline` varchar(20) DEFAULT NULL,
  `approvedByMid` int(11) DEFAULT '-999',
  `assignTid` int(11) NOT NULL DEFAULT '-999',
  `solInfo` varchar(1000) DEFAULT NULL,
  `sol1` varchar(255) DEFAULT NULL,
  `sol2` varchar(255) DEFAULT NULL,
  `sol3` varchar(255) DEFAULT NULL,
  `sol4` varchar(255) DEFAULT NULL,
  `sol5` varchar(255) DEFAULT NULL,
  `tPrice` int(11) DEFAULT '0',
  `ref_used` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`subject`, `topic`, `info`, `file1`, `file2`, `file3`, `file4`, `price`, `aStatus`, `qid`, `sid`, `deadline`, `approvedByMid`, `assignTid`, `solInfo`, `sol1`, `sol2`, `sol3`, `sol4`, `sol5`, `tPrice`, `ref_used`) VALUES
('Computer', 'Dsa', 'Nothing', 'Abhi resume june.pdf', 'ellipse.png', 'ellise2png.png', '', 1000, 'Completed', 37, 3, '2022-07-10', 1, 12, 'This is not so good', 'Abhi june.docx', 'Abhi resume june.pdf', 'bed admit card.pdf', 'bed.pdf', '', 0, 0),
('maths', 'Calculus', 'Nothing', 'ellipse.png', '', '', '', 500, 'Reviewed', 38, 1, '2022-07-06', 1, 11, 'I there good to see you', 'ellise2png.png', 'nn.png', '', '', '', 0, 0),
('chemistry', 'atoms', 'Nothings', '1656952108ellipse.png', '', '', '', 200, 'Reviewed', 39, 1, '2022-07-08', 1, 11, 'This is not so good', '', '', '', '', '', 0, 0),
('data', 'data', 'sdf', 'N00001743-Megha Dhiman.docx', '', '', '', 500, 'Reviewed', 40, 14, '2022-07-13', 1, 11, 'I there good to see you', '', '', '', '', '', 300, 0),
('data2', 'live', 'sdf', '', '', '', '', 400, 'Approved', 42, 10001, '', 1, -999, NULL, NULL, NULL, NULL, NULL, NULL, 100, 0),
('PCM', 'ef', 'wer', '', '', '', '', 0, 'Accepted by Tutor', 45, 10002, '', 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `mName` varchar(40) NOT NULL,
  `mEmail` varchar(40) NOT NULL,
  `mContact` bigint(12) NOT NULL,
  `mPass` varchar(40) NOT NULL,
  `mid` int(11) NOT NULL,
  `approved` varchar(40) DEFAULT NULL,
  `upi` varchar(100) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `ifsc` varchar(100) DEFAULT NULL,
  `bankName` varchar(100) DEFAULT NULL,
  `banned` int(11) DEFAULT '0',
  `vkey` varchar(255) DEFAULT NULL,
  `verified` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`mName`, `mEmail`, `mContact`, `mPass`, `mid`, `approved`, `upi`, `bank`, `ifsc`, `bankName`, `banned`, `vkey`, `verified`) VALUES
('mtemp', 'temp1@gmail.com', 23523, '1c92c8e905686e222359909f861fd499', 1, 'Yes', 'abhishek@paytm', NULL, NULL, NULL, 0, NULL, 0),
('mtemp2', 'temp2@gmail.com', 234, '1c92c8e905686e222359909f861fd499', 3, 'Yes', NULL, NULL, NULL, NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sreferral`
--

CREATE TABLE `sreferral` (
  `sid` int(11) NOT NULL,
  `ref_code` varchar(100) NOT NULL,
  `referral_sid` int(11) NOT NULL,
  `total_ref` int(11) DEFAULT '0',
  `applicable_ref` int(11) DEFAULT '0',
  `used_ref` int(11) NOT NULL DEFAULT '0',
  `first_order` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sreferral`
--

INSERT INTO `sreferral` (`sid`, `ref_code`, `referral_sid`, `total_ref`, `applicable_ref`, `used_ref`, `first_order`) VALUES
(14, 'TTY14', -999, 3, 0, 3, 'done'),
(10001, 'XFR10001', 14, 0, 0, 0, 'done'),
(10003, 'IOR10003', -999, 1, 0, 1, 'done'),
(10004, 'RMT10004', 10003, 0, 0, 0, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sName` varchar(40) NOT NULL,
  `sEmail` varchar(40) NOT NULL,
  `sContact` bigint(12) NOT NULL,
  `sPass` varchar(40) NOT NULL,
  `sid` int(11) NOT NULL,
  `vkey` varchar(255) DEFAULT NULL,
  `verified` int(11) DEFAULT '0',
  `banned` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sName`, `sEmail`, `sContact`, `sPass`, `sid`, `vkey`, `verified`, `banned`) VALUES
('temp1', 'temp1@gmail.com', 235, 'b11527a3bc3fb840ecd1cfe08f6384c0', 1, 'XXX', 1, 0),
('temp2', 'temp2@gmail.com', 23423, '1c92c8e905686e222359909f861fd499', 3, 'XXX', 0, 0),
('temp3', 'temp3@gmail.com', 3453, '1c92c8e905686e222359909f861fd499', 14, 'XXX', 0, 0),
('temp4', 'temp4@gmail.com', 234, '1c92c8e905686e222359909f861fd499', 10001, 'XXX', 0, 0),
('temp5', 'temp5@gmail.com', 2342, '1c92c8e905686e222359909f861fd499', 10003, 'XXX', 0, 0),
('temp5', 'temp6@gmail.com', 35, '1c92c8e905686e222359909f861fd499', 10004, 'XXX', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tName` varchar(40) NOT NULL,
  `tEmail` varchar(40) NOT NULL,
  `tContact` bigint(12) NOT NULL,
  `tPass` varchar(40) NOT NULL,
  `tid` int(11) NOT NULL,
  `approved` varchar(40) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `tsubject` varchar(400) NOT NULL,
  `upi` varchar(100) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `ifsc` varchar(100) DEFAULT NULL,
  `bankName` varchar(100) DEFAULT NULL,
  `banned` int(11) DEFAULT '0',
  `vkey` varchar(255) DEFAULT NULL,
  `verified` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tName`, `tEmail`, `tContact`, `tPass`, `tid`, `approved`, `rating`, `tsubject`, `upi`, `bank`, `ifsc`, `bankName`, `banned`, `vkey`, `verified`) VALUES
('Tutor1', 'tutor1@gmail.com', 241, '1c92c8e905686e222359909f861fd499', 11, 'Approve', 7, 'Maths, physics', 'abhishek@paytm', NULL, NULL, NULL, 0, NULL, 0),
('Tutor2', 'tutor2@gmail.com', 812, '1c92c8e905686e222359909f861fd499', 12, 'Approve', 0, 'MAths', NULL, NULL, NULL, NULL, 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mEmail` (`mEmail`);

--
-- Indexes for table `sreferral`
--
ALTER TABLE `sreferral`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `referral_sid` (`referral_sid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `sEmail` (`sEmail`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tid`),
  ADD UNIQUE KEY `tEmail` (`tEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sreferral`
--
ALTER TABLE `sreferral`
  ADD CONSTRAINT `sreferral_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `vkeyAutoM` ON SCHEDULE EVERY 10 MINUTE STARTS '2022-07-30 13:20:55' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE undolt.manager
SET vkey = 'XXX' where vkey<>'XXX'$$

CREATE DEFINER=`root`@`localhost` EVENT `vkeyAutoT` ON SCHEDULE EVERY 10 MINUTE STARTS '2022-07-30 13:20:55' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE undolt.tutor
SET vkey = 'XXX' where vkey<>'XXX'$$

CREATE DEFINER=`root`@`localhost` EVENT `vkeyAutoS` ON SCHEDULE EVERY 10 MINUTE STARTS '2022-07-30 13:20:55' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE undolt.student
SET vkey = 'XXX' where vkey<>'XXX'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
