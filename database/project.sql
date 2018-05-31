-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 05:44 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `buying`
--

CREATE TABLE `buying` (
  `id` int(11) NOT NULL,
  `fruit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buying`
--

INSERT INTO `buying` (`id`, `fruit_id`, `user_id`, `amount`, `price`, `total`, `location`, `date`, `status`) VALUES
(3, 4, 11, 1, 100, 100, 'บ้านไร่ม่วง', '2018-05-13', 1),
(4, 4, 11, 10, 100, 1000, 'บ่านไร่ม่วง', '2018-05-13', 1),
(5, 4, 11, 9, 100, 900, 'บ้านไร่ม่วง', '2018-05-13', 1),
(8, 4, 11, 4, 100, 400, 'บ่านไร่ม่วง', '2018-05-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `cid` int(13) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `wage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `cid`, `name`, `address`, `tel`, `wage`) VALUES
(1, 111111, 'ssdfsf', '1111', '11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `name`, `user_id`, `emp_id`, `amount`, `date`) VALUES
(1, 'ค่าจ้าง', 11, 13, 500, '2018-05-14'),
(2, 'ค่าจ้าง', 11, 15, 500, '2018-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `fruit`
--

CREATE TABLE `fruit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fruit`
--

INSERT INTO `fruit` (`id`, `name`, `image`, `amount`, `price`, `total`) VALUES
(4, 'ทุเรียน', '20180513155605152622696541097809..jpg', 34, 100, 3400),
(5, 'กล้วย', '2018051316015915262273199588508.jpg', 100, 20, 400),
(6, 'แตงโม', '20180513161646152622820664651972.jpg', 50, 15, 750);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ประชาสัมพันธ์';

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `title`, `detail`, `user_id`, `date`) VALUES
(1, 'tes', 'dsf', 11, '2018-05-14'),
(2, 'tes', 'dsf', 11, '2018-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `locations` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `locations`, `status`, `date`) VALUES
(15, 13, 'สปป ลาว', 0, '2018-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `prict` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `pro_id`, `pro_name`, `amount`, `prict`, `total`, `user_id`) VALUES
(10, 15, 4, 'ทุเรียน', 3, 100, 300, 13),
(11, 15, 5, 'กล้วย', 3, 20, 60, 13),
(12, 15, 6, 'แตงโม', 4, 15, 60, 13);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'User ที่ login',
  `mem_id` int(11) NOT NULL,
  `fruit_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ขาย';

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `name`, `create_at`) VALUES
(38, '20180513140614152622037493228826.jpg', '2018-05-13'),
(39, '20180513140614152622037479231813.jpg', '2018-05-13'),
(40, '20180513140614152622037433096900.jpg', '2018-05-13'),
(41, '20180513141155152622071587446323.jpg', '2018-05-13'),
(42, '20180513141200152622072072314169.jpg', '2018-05-13'),
(43, '20180513141205152622072533685830.jpg', '2018-05-13'),
(44, '20180513141205152622072514965168.jpg', '2018-05-13'),
(45, '20180513141205152622072522645674.jpg', '2018-05-13'),
(46, '20180513141229152622074939590391.jpg', '2018-05-13'),
(47, '20180513141229152622074972683395.jpg', '2018-05-13'),
(48, '20180513141229152622074947371595.jpg', '2018-05-13'),
(49, '20180513141234152622075441668430.jpg', '2018-05-13'),
(50, '20180513141234152622075497647329.jpg', '2018-05-13'),
(51, '20180513141234152622075498394935.jpg', '2018-05-13'),
(52, '20180513141327152622080711550592.jpg', '2018-05-13'),
(53, '20180513141327152622080761353351.jpg', '2018-05-13'),
(54, '20180513141327152622080751335432.jpg', '2018-05-13'),
(55, '20180513141332152622081244796169.jpg', '2018-05-13'),
(56, '20180513141332152622081299542282.jpg', '2018-05-13'),
(57, '20180513141332152622081247157994.jpg', '2018-05-13'),
(58, '20180513141405152622084563056062.jpg', '2018-05-13'),
(59, '20180513141405152622084540075572.jpg', '2018-05-13'),
(60, '20180513141405152622084514641714.jpg', '2018-05-13'),
(61, '20180513141408152622084822639571.jpg', '2018-05-13'),
(62, '20180513141408152622084817052362.jpg', '2018-05-13'),
(63, '20180513141408152622084831421652.jpg', '2018-05-13'),
(64, '2018051314144815262208881465541.jpg', '2018-05-13'),
(65, '20180513142540152622154052516345.jpg', '2018-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`, `name`, `tel`, `sex`) VALUES
(11, 'admin@gmail.com', 'admin', '123456', 'admin', 'admin', '0859685965', '1'),
(13, 'user@gmail.com', 'user', '123456', 'user', 'user', '0798869796', '2'),
(15, 'user3@gmail.com', 'user3', '123456', 'user', 'user3', '0987654345', '2'),
(16, 'user4@gmail.com', 'user4', '123456', 'user', 'user4', '0986758675', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buying`
--
ALTER TABLE `buying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fruit`
--
ALTER TABLE `fruit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buying`
--
ALTER TABLE `buying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fruit`
--
ALTER TABLE `fruit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
