-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2021 at 10:03 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subsiri`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_about_us`
--

CREATE TABLE `db_about_us` (
  `id` int(10) NOT NULL,
  `about_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `img_cover` varchar(100) DEFAULT '',
  `is_active` int(2) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_about_us`
--

INSERT INTO `db_about_us` (`id`, `about_name`, `description`, `img_cover`, `is_active`, `created`, `updated`) VALUES
(1, 'บริษัท ทรัพย์ศิริ เทรดดิ้ง จำกัด', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n\r\n<p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n', 'about.jpg', 1, '2021-02-20 11:03:44', '2021-02-26 11:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `db_admin`
--

CREATE TABLE `db_admin` (
  `id` int(11) NOT NULL,
  `group_id` int(2) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `is_active` int(2) DEFAULT 1,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_admin`
--

INSERT INTO `db_admin` (`id`, `group_id`, `full_name`, `username`, `password`, `ip`, `is_active`, `created`) VALUES
(1, 1, 'Administrator', 'subsiric@subsiri.com', '751483cade288427cb666bfde23a88fb', '::1', 1, '2021-02-13 19:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `db_banner`
--

CREATE TABLE `db_banner` (
  `id` int(20) NOT NULL,
  `banner_name` varchar(100) DEFAULT '',
  `img_cover` varchar(100) DEFAULT '',
  `is_active` varchar(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_banner`
--

INSERT INTO `db_banner` (`id`, `banner_name`, `img_cover`, `is_active`, `created`, `updated`) VALUES
(1, 'แบนเนอร์ ทรัพย์ศิริ', 'banner.jpg', '1', '2021-02-20 10:48:20', '2021-02-20 10:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `db_contact`
--

CREATE TABLE `db_contact` (
  `id` int(10) NOT NULL,
  `contact_name` varchar(100) DEFAULT '',
  `contact_address` text DEFAULT NULL,
  `date_time` text DEFAULT NULL,
  `phone_1` text DEFAULT NULL,
  `phone_2` text DEFAULT NULL,
  `phone_3` text DEFAULT NULL,
  `phone_4` text DEFAULT NULL,
  `phone_5` text DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `is_active` int(2) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_contact`
--

INSERT INTO `db_contact` (`id`, `contact_name`, `contact_address`, `date_time`, `phone_1`, `phone_2`, `phone_3`, `phone_4`, `phone_5`, `google_map`, `is_active`, `created`, `updated`) VALUES
(1, 'บริษัท ทรัพย์ศิริ เทรดดิ้ง จำกัด', '41/6 หมู่ 2 ต.คลองสี่ อ.คลองหลวง จ.ปทุมธานี 12120', 'วันจันทร์-วันศุกร์ 8.00 -17.00 น. วันเสาร์ 8.00-12.00 น.', '02-1590325', '094-6474982', '099-0547456', '', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3870.8438232957105!2d100.68691311534859!3d14.027270194628326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d803c4167a9c9%3A0x1a5fdd6be9e67574!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4l-C4o-C4seC4nuC4ouC5jOC4qOC4tOC4o-C4tCDguYDguJfguKPguJTguJTguLTguYnguIcg4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sth!2sth!4v1613285413441!5m2!1sth!2sth', 1, '2021-02-20 15:58:18', '2021-02-20 16:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `db_product`
--

CREATE TABLE `db_product` (
  `id` int(20) NOT NULL,
  `url_name` varchar(100) DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `product_name` varchar(100) DEFAULT '',
  `price` decimal(10,0) DEFAULT NULL,
  `size` varchar(50) DEFAULT '',
  `description` text DEFAULT NULL,
  `img_cover` varchar(150) DEFAULT NULL,
  `is_best` int(2) DEFAULT 0,
  `is_active` int(2) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_product`
--

INSERT INTO `db_product` (`id`, `url_name`, `keyword`, `product_name`, `price`, `size`, `description`, `img_cover`, `is_best`, `is_active`, `created`, `updated`) VALUES
(1, 'subsiri-product-name', 'subsiri1, subsiri2, subsiri3', 'กิ๊บตอกสายไฟ', '35', '10X12 ซม.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n', '12896508465819.jpg', 0, 1, '2021-02-20 15:17:59', '2021-02-20 15:26:18'),
(2, 'subsiri-product2', 'subsiri', 'เคเบิ้ลไทม์', '100', '15 ซม.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n', '12896508532110.jpg', 1, 1, '2021-02-26 10:19:06', NULL),
(3, 'subsiri-product3', 'subsiri', 'ผ้าเทปดำพันสายไฟ', '100', '50 ซม.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>\r\n', '12896508549188.jpg', 1, 1, '2021-02-26 10:34:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_product_img`
--

CREATE TABLE `db_product_img` (
  `product_id` int(15) NOT NULL,
  `img_name` varchar(150) NOT NULL,
  `order_id` int(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_product_img`
--

INSERT INTO `db_product_img` (`product_id`, `img_name`, `order_id`, `created`) VALUES
(1, '12896508435346.jpg', 1, '2021-02-20 15:17:59'),
(1, '12896508465819.jpg', 2, '2021-02-20 15:17:59'),
(1, '12896508477921.jpg', 3, '2021-02-20 15:17:59'),
(1, '12896508500634.jpg', 4, '2021-02-20 15:17:59'),
(1, '12896508532110.jpg', 5, '2021-02-20 15:17:59'),
(1, '12896508549188.jpg', 6, '2021-02-20 15:17:59'),
(2, '12896508477921.jpg', 1, '2021-02-26 10:19:06'),
(2, '12896508532110.jpg', 2, '2021-02-26 10:19:06'),
(2, '12896508549188.jpg', 3, '2021-02-26 10:19:06'),
(3, '12896508435346.jpg', 1, '2021-02-26 10:34:09'),
(3, '12896508477921.jpg', 2, '2021-02-26 10:34:09'),
(3, '12896508549188.jpg', 3, '2021-02-26 10:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `db_review`
--

CREATE TABLE `db_review` (
  `id` int(20) NOT NULL,
  `review_name` varchar(100) DEFAULT '',
  `description` text DEFAULT NULL,
  `img_cover` varchar(100) DEFAULT NULL,
  `is_active` int(2) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_review`
--

INSERT INTO `db_review` (`id`, `review_name`, `description`, `img_cover`, `is_active`, `created`, `updated`) VALUES
(1, 'ขอขอบพระคุณลูกค้า', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.\r\n ', 'cus.jpg', 1, '2021-02-20 15:33:44', '2021-02-26 10:46:21'),
(2, 'ขอขอบพระคุณลูกค้า', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.', 'SCG_EXPRESS_COOL_TA_Q_BIN_4_780x437.jpg', 1, '2021-02-26 10:50:32', NULL),
(3, 'ขอขอบพระคุณลูกค้า', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.', '67495447_922426294798671_4745372304354050048_o.jpg', 1, '2021-02-26 10:52:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_about_us`
--
ALTER TABLE `db_about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_admin`
--
ALTER TABLE `db_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `db_banner`
--
ALTER TABLE `db_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_contact`
--
ALTER TABLE `db_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_product`
--
ALTER TABLE `db_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_product_img`
--
ALTER TABLE `db_product_img`
  ADD PRIMARY KEY (`product_id`,`img_name`);

--
-- Indexes for table `db_review`
--
ALTER TABLE `db_review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_about_us`
--
ALTER TABLE `db_about_us`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_admin`
--
ALTER TABLE `db_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_banner`
--
ALTER TABLE `db_banner`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_contact`
--
ALTER TABLE `db_contact`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_product`
--
ALTER TABLE `db_product`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_review`
--
ALTER TABLE `db_review`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
