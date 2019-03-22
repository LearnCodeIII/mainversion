-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2019 at 07:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

CREATE TABLE `ad` (
  `sn` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_number` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_poc` varchar(255) NOT NULL,
  `client_mobile` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `contract_budget` varchar(255) NOT NULL,
  `contract_start_date` date NOT NULL,
  `contract_end_date` date NOT NULL,
  `ad_name` varchar(255) NOT NULL,
  `ad_pic` varchar(255) NOT NULL,
  `ad_link` varchar(255) NOT NULL,
  `ad_link_count` varchar(255) NOT NULL,
  `ad_start_time` datetime NOT NULL,
  `ad_end_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ad`
--

INSERT INTO `ad` (`sn`, `client_name`, `client_number`, `client_address`, `client_poc`, `client_mobile`, `client_email`, `contract_budget`, `contract_start_date`, `contract_end_date`, `ad_name`, `ad_pic`, `ad_link`, `ad_link_count`, `ad_start_time`, `ad_end_time`) VALUES
(1, '叄喜映畫股份有限公司', '53760253', '台北市中山區明水路401號1樓', '程紀皓', '0970044938', 'icebing1224@gmail.com', '啟用', '2019-03-01', '2024-03-01', 'Slutface', 'Pic1', 'Link1', 'Count1', '2019-03-01 00:00:00', '2024-03-01 00:00:00'),
(2, '七日印象電影有限公司', '53087286', '台北市延壽街117號2樓', '沈可尚', '0961762815', '7thdayfilm@gmail.com', '啟用', '2018-07-05', '2023-07-05', 'Rosarian', 'Pic2', 'Link2', 'Count2', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(3, '大夏數位傳播有限公司', '12968096', '台北市建國南路2段231號', '張美珠', '0971346973', 'lihua.cinefilm@gmail.com', '啟用', '2013-06-30', '2018-06-30', 'Jardonn', 'Pic3', 'Link3', 'Count3', '2013-06-30 00:00:00', '2018-06-30 00:00:00'),
(4, '大觀影視有限公司', '28217326', '台北市金華街18-6號', '陳希聖', '0960552981', 'gvproduction@gmail.com', '啟用', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic4', 'Link4', 'Count4', '2019-12-10 00:00:00', '2024-12-10 00:00:00'),
(5, '天予電影有限公司', '28934642', '台北市南港區忠孝東路六段70巷21弄22號', '連奕琦', '0913997232', 'giftpictures2@gmail.com', '停用', '2010-01-16', '2015-01-16', 'Valence', 'Pic5', 'Link5', 'Count5', '2010-01-16 00:00:00', '2015-01-16 00:00:00'),
(6, '今生視聽傳播有限公司', '20988692', '台北市松山區南京東路5段368號', '王湘婷', '0936785562', 'newhopejim@gmail.com', '啟用', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic6', 'Link6', 'Count6', '2001-05-29 00:00:00', '2006-05-29 00:00:00'),
(7, '巨宸製作公司', '24318457', '台北市民生東路五段260巷25號', '陳美珊', '0925141032', 'cass81129@gmail.com', '啟用', '2012-12-12', '2017-12-12', 'Chipmunk', 'Pic7', 'Link7', 'Count7', '2012-12-12 00:00:00', '2017-12-12 00:00:00'),
(8, '冉色斯動畫股份有限公司', '27447721', '新北市永和區博愛街9號1樓', '姚孟超', '0953901062', 'xanthus@gmail.com', '啟用', '2017-02-01', '2022-02-01', 'Hymnody', 'Pic8', 'Link8', 'Count8', '2017-02-01 00:00:00', '2022-02-01 00:00:00'),
(9, '海樂影業股份有限公司', '27457157', '新北市三重區重新路四段97號26樓', '吳浩佑', '0970148957', 'Deepjoy.ltd@msa.hinet.net', '啟用', '2019-03-11', '2024-03-11', 'Pedicular', 'Pic9', 'Link9', 'Count9', '2019-03-11 00:00:00', '2024-03-11 00:00:00'),
(10, '三乘影像事務所', '80497615', '台北市大安區安和路二段217巷13號', '廖蒲爵', '0963179675', 'triplefilmhouse@hinet.net', '啟用', '2019-03-24', '2024-03-24', 'Pedicular', 'Pic10', 'Link10', 'Count10', '2019-03-24 00:00:00', '2024-03-24 00:00:00'),
(91, '叄喜映畫股份有限公司', '53760253', '台北市中山區明水路401號1樓', '程紀皓', '0970044938', 'icebing1224@gmail.com', '啟用', '2019-03-01', '2024-03-01', 'Slutface', 'Pic1', 'Link1', 'Count1', '2019-03-01 00:00:00', '2024-03-01 00:00:00'),
(92, '七日印象電影有限公司', '53087286', '台北市延壽街117號2樓', '沈可尚', '0961762815', '7thdayfilm@gmail.com', '啟用', '2018-07-05', '2023-07-05', 'Rosarian', 'Pic2', 'Link2', 'Count2', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(93, '大夏數位傳播有限公司', '12968096', '台北市建國南路2段231號', '張美珠', '0971346973', 'lihua.cinefilm@gmail.com', '啟用', '2013-06-30', '2018-06-30', 'Jardonn', 'Pic3', 'Link3', 'Count3', '2013-06-30 00:00:00', '2018-06-30 00:00:00'),
(94, '大觀影視有限公司', '28217326', '台北市金華街18-6號', '陳希聖', '0960552981', 'gvproduction@gmail.com', '啟用', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic4', 'Link4', 'Count4', '2019-12-10 00:00:00', '2024-12-10 00:00:00'),
(95, '天予電影有限公司', '28934642', '台北市南港區忠孝東路六段70巷21弄22號', '連奕琦', '0913997232', 'giftpictures2@gmail.com', '啟用', '2010-01-16', '2015-01-16', 'Valence', 'Pic5', 'Link5', 'Count5', '2010-01-16 00:00:00', '2015-01-16 00:00:00'),
(96, '今生視聽傳播有限公司', '20988692', '台北市松山區南京東路5段368號', '王湘婷', '0936785562', 'newhopejim@gmail.com', '啟用', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic6', 'Link6', 'Count6', '2001-05-29 00:00:00', '2006-05-29 00:00:00'),
(97, '巨宸製作公司', '24318457', '台北市民生東路五段260巷25號', '陳美珊', '0925141032', 'cass81129@gmail.com', '啟用', '2012-12-12', '2017-12-12', 'Chipmunk', 'Pic7', 'Link7', 'Count7', '2012-12-12 00:00:00', '2017-12-12 00:00:00'),
(98, '冉色斯動畫股份有限公司', '27447721', '新北市永和區博愛街9號1樓', '姚孟超', '0953901062', 'xanthus@gmail.com', '啟用', '2017-02-01', '2022-02-01', 'Hymnody', 'Pic8', 'Link8', 'Count8', '2017-02-01 00:00:00', '2022-02-01 00:00:00'),
(99, '海樂影業股份有限公司', '27457157', '新北市三重區重新路四段97號26樓', '吳浩佑', '0970148957', 'Deepjoy.ltd@msa.hinet.net', '啟用', '2019-03-11', '2024-03-11', 'Pedicular', 'Pic9', 'Link9', 'Count9', '2019-03-11 00:00:00', '2024-03-11 00:00:00'),
(100, '三乘影像事務所', '80497615', '台北市大安區安和路二段217巷13號', '廖蒲爵', '0963179675', 'triplefilmhouse@hinet.net', '啟用', '2019-03-24', '2024-03-24', 'Pedicular', 'Pic10', 'Link10', 'Count10', '2019-03-24 00:00:00', '2024-03-24 00:00:00'),
(112, '叄喜映畫股份有限公司', '53760253', '台北市中山區明水路401號1樓', '程紀皓', '0970044938', 'icebing1224@gmail.com', '啟用', '2019-03-01', '2024-03-01', 'Slutface', 'Pic1', 'Link1', 'Count1', '2019-03-01 00:00:00', '2024-03-01 00:00:00'),
(113, '七日印象電影有限公司', '53087286', '台北市延壽街117號2樓', '沈可尚', '0961762815', '7thdayfilm@gmail.com', '啟用', '2018-07-05', '2023-07-05', 'Rosarian', 'Pic2', 'Link2', 'Count2', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(114, '大夏數位傳播有限公司', '12968096', '台北市建國南路2段231號', '張美珠', '0971346973', 'lihua.cinefilm@gmail.com', '啟用', '2013-06-30', '2018-06-30', 'Jardonn', 'Pic3', 'Link3', 'Count3', '2013-06-30 00:00:00', '2018-06-30 00:00:00'),
(115, '大觀影視有限公司', '28217326', '台北市金華街18-6號', '陳希聖', '0960552981', 'gvproduction@gmail.com', '啟用', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic4', 'Link4', 'Count4', '2019-12-10 00:00:00', '2024-12-10 00:00:00'),
(116, '天予電影有限公司', '28934642', '台北市南港區忠孝東路六段70巷21弄22號', '連奕琦', '0913997232', 'giftpictures2@gmail.com', '停用', '2010-01-16', '2015-01-16', 'Valence', 'Pic5', 'Link5', 'Count5', '2010-01-16 00:00:00', '2015-01-16 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad`
--
ALTER TABLE `ad`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
