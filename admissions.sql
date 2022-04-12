-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 11:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admissions`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_college`
--

CREATE TABLE `tbl_college` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `college_desc` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_college`
--

INSERT INTO `tbl_college` (`college_id`, `college_name`, `college_desc`) VALUES
(1, 'CAG', 'COLLEGE OF AGRICULTURE'),
(2, 'CASS', 'COLLEGE OF ARTS AND SOCIAL SCIENCE'),
(3, 'CBAA', 'COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY'),
(4, 'CED', 'COLLEGE OF EDUCATION'),
(5, 'CEN', 'COLLEGE OF ENGINEERING'),
(6, 'CF', 'COLLEGE OF FISHERIES'),
(7, 'CHSI', 'COLLEGE OF HOME SCIENCE AND INDUSTRY'),
(8, 'COS', 'COLLEGE OF SCIENCE'),
(9, 'CVSM', 'COLLEGE OF VETERINARY SCIENCE AND MEDICINE'),
(10, 'DOT UNI', 'DISTANCE, OPEN AND TRANSNATIONAL UNIVERSITY'),
(11, 'OAD', 'OFFICE OF ADMISSIONS'),
(12, 'NSTP', 'NSTP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `course_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `course_desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `course_type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `course_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `college_id`, `course_name`, `course_desc`, `course_type`, `course_status`) VALUES
(1, 1, 'BS ENTREP', 'BACHELOR OF SCIENCE IN ENTREPRENEURSHIP', 'BS', 1),
(2, 1, 'BSA', 'BACHELOR OF SCIENCE IN AGRICULTURE', 'BS', 1),
(3, 1, 'BSAB', 'BACHELOR OF SCIENCE IN AGRIBUSINESS', 'BS', 1),
(4, 1, 'MAB', 'MASTER OF SCIENCE IN AGRI-BUSINESS', 'MS', 1),
(5, 1, 'MSANSCI', 'MASTER OF SCIENCE IN ANIMAL SCIENCE', 'MS', 1),
(6, 1, 'MSCPROT', 'MASTER OF SCIENCE IN CROP PROTECTION', 'MS', 1),
(7, 1, 'MSCRSCI', 'MASTER OF SCIENCE IN CROP SCIENCE', 'MS', 1),
(8, 1, 'MSSOILS', 'MASTER OF SCIENCE IN SOIL SCIENCE', 'MS', 1),
(9, 1, 'PHDAGENTOM', 'DOCTOR OF PHILOSOPHY IN AGRICULTURAL ENTOMOLOGY', 'PhD', 1),
(10, 1, 'PHDANSCI', 'DOCTOR OF PHILOSOPHY IN ANIMAL SCIENCE', 'PhD', 1),
(11, 1, 'PHDCRSCI', 'DOCTOR OF PHILOSOPHY IN CROP SCIENCE', 'PhD', 1),
(12, 1, 'PHDSOILS', 'DOCTOR OF PHILOSOPHY IN SOIL SCIENCE', 'PhD', 1),
(13, 2, 'BAFIL', 'BACHELOR OF ARTS IN FILIPINO', 'BA', 1),
(14, 2, 'BALITT', 'BACHELOR OF ARTS IN LITERATURE', 'BA', 1),
(15, 2, 'BALL', 'BACHELOR OF ARTS IN LANGUAGE & LITERATURE', 'BA', 1),
(16, 2, 'BAPSYCH', 'BACHELOR OF ARTS IN PSYCHOLOGY', 'BA', 1),
(17, 2, 'BASS', 'BACHELOR OF ARTS IN SOCIAL SCIENCES', 'BA', 1),
(18, 2, 'BSDC', 'BACHELOR OF SCIENCE IN DEVELOPMENT COMMUNICATION', 'BS', 1),
(19, 2, 'BSPSYCH', 'BACHELOR OF SCIENCE IN PSYCHOLOGY', 'BS', 1),
(20, 2, 'MALL', 'MASTER OF ARTS IN LANGUAGE & LITERATURE', 'MA', 1),
(21, 2, 'MSDC', 'MASTER OF SCIENCE IN DEVELOPMENT COMMUNICATION', 'MS', 1),
(22, 2, 'MSRD', 'MASTER OF SCIENCE IN RURAL DEVELOPMENT', 'MS', 1),
(23, 2, 'PHDDEVCOM', 'DOCTOR OF PHILOSOPHY IN DEVELOPMENT COMMUNICATION', 'PhD', 1),
(24, 2, 'PHDRD', 'DOCTOR OF PHILOSOPHY IN RURAL DEVELOPMENT', 'PhD', 1),
(25, 3, 'BSAC', 'BACHELOR OF SCIENCE IN ACCOUNTANCY', 'BS', 1),
(26, 3, 'BSBA', 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION', 'BS', 1),
(27, 3, 'BSENTREP', 'BACHELOR OF SCIENCE IN ENTREPRENEURSHIP', 'BS', 1),
(28, 3, 'BSMA', 'BACHELOR OF SCIENCE IN MANAGEMENT ACCOUNTING', 'BS', 1),
(29, 3, 'MBA', 'MASTER OF SCIENCE IN BUSINESS ADMINISTRATION', 'MS', 1),
(30, 4, 'BCAED', 'BACHELOR OF CULTURE & ARTS EDUCATION', 'B', 1),
(31, 4, 'BECED', 'BACHELOR OF EARLY CHILDHOOD EDUCATION', 'B', 1),
(32, 4, 'BEED', 'BACHELOR OF ELEMENTARY EDUCATION', 'B', 1),
(33, 4, 'BPED', 'BACHELOR OF PHYSICAL EDUCATION', 'B', 1),
(34, 4, 'BSED', 'BACHELOR OF SECONDARY EDUCATION', 'B', 1),
(35, 4, 'BTLED', 'BACHELOR OF TECHNOLOGY & LIVELIHOOD EDUCATION', 'B', 1),
(36, 4, 'MSBIOED', 'MASTER OF SCIENCE IN BIOLOGY EDUCATION', 'MS', 1),
(37, 4, 'MSCHEMED', 'MASTER OF SCIENCE IN CHEMISTRY EDUCATION', 'MS', 1),
(38, 4, 'MSED', 'MASTER OF SCIENCE IN EDUCATION', 'MS', 1),
(39, 4, 'MSGC', 'MASTER OF SCIENCE IN GUIDANCE & COUNSELING', 'MS', 1),
(40, 4, 'PHDDEVED', 'DOCTOR OF PHILOSOPHY IN DEVELOPMENT EDUCATION', 'PhD', 1),
(41, 5, 'BSABE', 'BACHELOR OF SCIENCE IN AGRICULTURAL & BIOSYSTEMS ENGINEERING', 'BS', 1),
(42, 5, 'BSAEN', 'BACHELOR OF SCIENCE IN AGRICULTURAL ENGINEERING', 'BS', 1),
(43, 5, 'BSCE', 'BACHELOR OF SCIENCE IN CIVIL ENGINEERING', 'BS', 1),
(44, 5, 'BSIT', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 'BS', 1),
(45, 5, 'BSMET', 'BACHELOR OF SCIENCE IN METEOROLOGY', 'BS', 1),
(46, 5, 'MSAGEN', 'MASTER OF SCIENCE IN AGRICULTURAL ENGINEERING', 'MS', 1),
(47, 5, 'PHDAGEN', 'DOCTOR OF PHILOSOPHY IN AGRICULTURAL ENGINEERING', 'PhD', 1),
(48, 6, 'BSF', 'BACHELOR OF SCIENCE IN FISHERIES', 'BS', 1),
(49, 6, 'MSAQUA', 'MASTER OF SCIENCE IN AQUACULTURE', 'MS', 1),
(50, 6, 'PHDAQUA', 'DOCTOR OF PHILOSOPHY IN AQUACULTURE', 'PhD', 1),
(51, 7, 'BSFT', 'BACHELOR OF SCIENCE IN FOOD TECHNOLOGY', 'BS', 1),
(52, 7, 'BSFTT', 'BACHELOR OF SCIENCE IN FASHION & TEXTILE TECHNOLOGY', 'BS', 1),
(53, 7, 'BSHM', 'BACHELOR OF SCIENCE IN HOSPITALITY MANAGEMENT', 'BS', 1),
(54, 7, 'BSHRM', 'BACHELOR OF SCIENCE IN HOTEL & RESTAURANT MANAGEMENT', 'BS', 1),
(55, 7, 'BSTGT', 'BACHELOR OF SCIENCE IN TEXTILE & GARMENT TECHNOLOGY', 'BS', 1),
(56, 7, 'BSTM', 'BACHELOR OF SCIENCE IN TOURISM MANAGEMENT', 'BS', 1),
(57, 8, 'BSBIO', 'BACHELOR OF SCIENCE IN BIOLOGY', 'BS', 1),
(58, 8, 'BSCHEM', 'BACHELOR OF SCIENCE IN CHEMISTRY', 'BS', 1),
(59, 8, 'BSES', 'BACHELOR OF SCIENCE IN ENVIRONMENTAL SCIENCE', 'BS', 1),
(60, 8, 'BSMATH', 'BACHELOR OF SCIENCE IN MATHEMATICS', 'BS', 1),
(61, 8, 'BSSTAT', 'BACHELOR OF SCIENCE IN STATISTICS', 'BS', 1),
(62, 8, 'MSCHEM', 'MASTER OF SCIENCE IN CHEMISTRY', 'MS', 1),
(63, 8, 'MSBIO', 'MASTER OF SCIENCE IN BIOLOGY', 'MS', 1),
(64, 8, 'MSEM', 'MASTER OF SCIENCE IN ENVIRONMENTAL MANAGEMENT', 'MS', 1),
(65, 8, 'PHDBIO', 'DOCTOR OF PHILOSOPHY IN BIOLOGY', 'PhD', 1),
(66, 8, 'PHDEM', 'DOCTOR OF PHILOSOPHY IN ENVIRONMENTAL MANAGEMENT', 'PhD', 1),
(67, 9, 'DVM', 'DOCTOR OF VETERINARY MEDICINE', 'D', 1),
(68, 9, 'MVST', 'MASTER OF SCIENCE IN VETERINARY STUDIES', 'MS', 1),
(69, 10, 'DOTUni-CIT', 'CERTIFICATE IN TEACHING', 'C', 1),
(70, 10, 'DOTUni-MAB', 'MASTER OF SCIENCE IN AGRI-BUSINESS', 'MS', 1),
(71, 10, 'DOTUni-MBA', 'MASTER OF SCIENCE IN BUSINESS ADMINISTRATION', 'MS', 1),
(72, 10, 'DOTUni-MEM', 'MASTER OF SCIENCE IN ENVIRONMENTAL MANAGEMENT', 'MS', 1),
(73, 10, 'DOTUni-MSED', 'MASTER OF SCIENCE IN EDUCATION (DOT.UNI)', 'MS', 1),
(74, 10, 'DOTUni-MSRD', 'MASTER OF SCIENCE IN RURAL DEVELOPMENT', 'MS', 1),
(75, 10, 'DOTUni-MSRES', 'MASTER OF SCIENCE IN RENEWABLE ENERGY SOURCES', 'MS', 1),
(76, 10, 'DOTUni-PHD DEV ED', 'DOCTOR OF PHILOSOPHY IN DEVELOPMENT EDUCATION', 'PhD', 1),
(77, 10, 'DOTUni-PHD RD', 'DOCTOR OF PHILOSOPHY IN RURAL DEVELOPMENT', 'PhD', 1),
(78, 10, 'DOTUni-PHDSFSRP', 'DOCTOR OF PHILOSOPHY IN SFSRP', 'PhD', 1),
(128, 1, 'ETEEAP', 'EXPANDED TERTIARY EDUCATION EQUIVALENCY AND ACCREDITATION PROGRAM (ETEEAP)', 'BS', 1),
(129, 4, 'ETEEAP', 'EXPANDED TERTIARY EDUCATION EQUIVALENCY AND ACCREDITATION PROGRAM (ETEEAP)', 'BS', 1),
(130, 5, 'ETEEAP', 'EXPANDED TERTIARY EDUCATION EQUIVALENCY AND ACCREDITATION PROGRAM (ETEEAP)', 'BS', 1),
(131, 6, 'ETEEAP', 'EXPANDED TERTIARY EDUCATION EQUIVALENCY AND ACCREDITATION PROGRAM (ETEEAP)', 'BS', 1),
(132, 1, 'MSAGECON', 'Master of Science in Agricultural Economics', 'MS', 1),
(133, 8, 'MCHEM', 'MASTER OF CHEMISTRY', 'MS', 1),
(142, 8, 'CROSS ENROLLEE', 'CROSS ENROLLEE', 'BS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_college`
--
ALTER TABLE `tbl_college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_college`
--
ALTER TABLE `tbl_college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;