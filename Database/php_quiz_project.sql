-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2020 at 08:26 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_quiz_project`
--
CREATE DATABASE IF NOT EXISTS `php_quiz_project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `php_quiz_project`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `pword`, `admin`) VALUES
(17, '   Michael Admin', 'hanzel@gmail.com', '$2y$10$08gkXnVuYjIWzs5TeghHd.s5BPrBX7a49ViR3WHcDWMBg4Da3D5s.', 1),
(20, '  Boris vau', 'boris@gmail.com', '$2y$10$F45551dUbbGq42rdZf9sQ.3E6jup/EGKBEAT8hFDq485ujp517Y1y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `email`, `pword`) VALUES
(1, 'Steph', 'steph@gmail.com', '$2y$10$9mWqPLqg2CDsMsYPzM.YWerpYXH1jCplQ3EsVe0p/PqzIkBw43Mp6'),
(17, ' Michael Hanzel', 'hanzel@gmail.com', '$2y$10$cWZjH7Vx2hYyenKwIFvPwO7s8QJbP3RWkhnCKH9Fa6TJO8Xtrs1rm'),
(22, 'Peter Hanzel', 'phanzel@gmail.com', '$2y$10$RnnnRJO0s3sfdPvxvTlNT.Z/FzzyNpCmgsFFfqArEIhfpZ/Hxbm2u'),
(23, 'Peter', 'peter@gmail.com', '$2y$10$Vewl7FfgieTADTlhJr/cQ.1ewBOF2i2iZj61onDvAGI.tsoBK2ynS'),
(24, 'Alex Viau', 'viau@gmail.com', '$2y$10$h8WWLQ/1l.hMHkUr0K0W..XCSZNdXz.Bm6NWddOwL30IxOP9mGxeC');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `qno` int(11) DEFAULT NULL,
  `question` varchar(500) NOT NULL,
  `option1` varchar(250) NOT NULL,
  `option2` varchar(250) NOT NULL,
  `option3` varchar(250) NOT NULL,
  `option4` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `qno`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, NULL, 'What is a correct way to add a comment in PHP?', '&lt;!--&hellip;--&gt;', '/*&hellip;*/', '*\\..\\*', '&lt;comment&gt;&hellip;&lt;/comment&gt;', 'b'),
(3, NULL, 'How do you write \"Hello World\" in PHP?', 'echo \"Hello World\";', 'Document.Write(\"Hello World\");', '\"Hello World\";', 'none of these', 'a'),
(4, NULL, 'What does PHP stand for?', 'Personal Hypertext Processor\r\n', 'Private Home Page', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'd'),
(5, NULL, 'How do you get information from a form that is submitted using the &quot;get&quot; method?', '$_GET[];', 'Request.Form;', 'Request.QueryString;', 'none of these', 'a'),
(6, NULL, 'When using the POST method, variables are displayed in the URL:', 'True', 'False', 'Can\'t say', 'none of these', 'b'),
(7, NULL, ' Which of the following function is used to get the size of a file?', 'fopen()', 'fread()', 'fsize()', 'filesize()', 'd'),
(8, NULL, 'Which of the following is used to delete a cookie?', 'setcookie()', '$_COOKIE variable', 'isset() function', 'none of the above', 'a'),
(15, NULL, 'What is file extension for php?', '.php', '.css', '.json', '.twig', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `score_board`
--

CREATE TABLE `score_board` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `score` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score_board`
--

INSERT INTO `score_board` (`id`, `name`, `score`, `time`) VALUES
(18, 'Peter', 6, '2020-04-01 02:41:43'),
(19, ' Michael Hanze', 4, '2020-04-01 02:53:45'),
(20, ' Michael Hanz', 6, '2020-04-04 01:10:58'),
(21, 'Alex Viau', 7, '2020-04-04 04:06:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score_board`
--
ALTER TABLE `score_board`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `score_board`
--
ALTER TABLE `score_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
