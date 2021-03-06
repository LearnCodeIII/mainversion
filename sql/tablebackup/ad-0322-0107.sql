-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 03 月 21 日 18:07
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `movie`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ad`
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
-- 傾印資料表的資料 `ad`
--

INSERT INTO `ad` (`sn`, `client_name`, `client_number`, `client_address`, `client_poc`, `client_mobile`, `client_email`, `contract_budget`, `contract_start_date`, `contract_end_date`, `ad_name`, `ad_pic`, `ad_link`, `ad_link_count`, `ad_start_time`, `ad_end_time`) VALUES
(1, '叄喜映畫股份有限公司', '53760253', '台北市中山區明水路401號1樓', '程紀皓', '0970044938', 'icebing1224@gmail.com', 'TWD', '2019-03-01', '2024-03-01', 'Slutface', 'Pic1', 'Link1', 'Count1', '2019-03-01 00:00:00', '2024-03-01 00:00:00'),
(2, '七日印象電影有限公司', '53087286', '台北市延壽街117號2樓', '沈可尚', '0961762815', '7thdayfilm@gmail.com', 'TWD', '2018-07-05', '2023-07-05', 'Rosarian', 'Pic2', 'Link2', 'Count2', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(3, '大夏數位傳播有限公司', '12968096', '台北市建國南路2段231號', '張美珠', '0971346973', 'lihua.cinefilm@gmail.com', 'TWD', '2013-06-30', '2018-06-30', 'Jardonn', 'Pic3', 'Link3', 'Count3', '2013-06-30 00:00:00', '2018-06-30 00:00:00'),
(4, '大觀影視有限公司', '28217326', '台北市金華街18-6號', '陳希聖', '0960552981', 'gvproduction@gmail.com', 'TWD', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic4', 'Link4', 'Count4', '2019-12-10 00:00:00', '2024-12-10 00:00:00'),
(5, '天予電影有限公司', '28934642', '台北市南港區忠孝東路六段70巷21弄22號', '連奕琦', '0913997232', 'giftpictures2@gmail.com', 'TWD', '2010-01-16', '2015-01-16', 'Valence', 'Pic5', 'Link5', 'Count5', '2010-01-16 00:00:00', '2015-01-16 00:00:00'),
(6, '今生視聽傳播有限公司', '20988692', '台北市松山區南京東路5段368號', '王湘婷', '0936785562', 'newhopejim@gmail.com', 'TWD', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic6', 'Link6', 'Count6', '2001-05-29 00:00:00', '2006-05-29 00:00:00'),
(7, '巨宸製作公司', '24318457', '台北市民生東路五段260巷25號', '陳美珊', '0925141032', 'cass81129@gmail.com', 'TWD', '2012-12-12', '2017-12-12', 'Chipmunk', 'Pic7', 'Link7', 'Count7', '2012-12-12 00:00:00', '2017-12-12 00:00:00'),
(8, '冉色斯動畫股份有限公司', '27447721', '新北市永和區博愛街9號1樓', '姚孟超', '0953901062', 'xanthus@gmail.com', 'TWD', '2017-02-01', '2022-02-01', 'Hymnody', 'Pic8', 'Link8', 'Count8', '2017-02-01 00:00:00', '2022-02-01 00:00:00'),
(9, '海樂影業股份有限公司', '27457157', '新北市三重區重新路四段97號26樓', '吳浩佑', '0970148957', 'Deepjoy.ltd@msa.hinet.net', 'TWD', '2019-03-11', '2024-03-11', 'Pedicular', 'Pic9', 'Link9', 'Count9', '2019-03-11 00:00:00', '2024-03-11 00:00:00'),
(10, '三乘影像事務所', '80497615', '台北市大安區安和路二段217巷13號', '廖蒲爵', '0963179675', 'triplefilmhouse.com.hinet.net', 'TWD', '2019-03-24', '2024-03-24', 'Pedicular', 'Pic10', 'Link10', 'Count10', '2019-03-24 00:00:00', '2024-03-24 00:00:00'),
(50, '叄喜映畫股份有限公司', '53760253', '台北市中山區明水路401號1樓', '程紀皓', '0970044938', 'icebing1224@gmail.com', 'TWD', '2019-03-01', '2024-03-01', 'Slutface', 'Pic1', 'Link1', 'Count1', '2019-03-01 00:00:00', '2024-03-01 00:00:00'),
(51, '七日印象電影有限公司', '53087286', '台北市延壽街117號2樓', '沈可尚', '0961762815', '7thdayfilm@gmail.com', 'TWD', '2018-07-05', '2023-07-05', 'Rosarian', 'Pic2', 'Link2', 'Count2', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(52, '大夏數位傳播有限公司', '12968096', '台北市建國南路2段231號', '張美珠', '0971346973', 'lihua.cinefilm@gmail.com', 'TWD', '2013-06-30', '2018-06-30', 'Jardonn', 'Pic3', 'Link3', 'Count3', '2013-06-30 00:00:00', '2018-06-30 00:00:00'),
(53, '大觀影視有限公司', '28217326', '台北市金華街18-6號', '陳希聖', '0960552981', 'gvproduction@gmail.com', 'TWD', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic4', 'Link4', 'Count4', '2019-12-10 00:00:00', '2024-12-10 00:00:00'),
(54, '天予電影有限公司', '28934642', '台北市南港區忠孝東路六段70巷21弄22號', '連奕琦', '0913997232', 'giftpictures2@gmail.com', 'TWD', '2010-01-16', '2015-01-16', 'Valence', 'Pic5', 'Link5', 'Count5', '2010-01-16 00:00:00', '2015-01-16 00:00:00'),
(55, '今生視聽傳播有限公司', '20988692', '台北市松山區南京東路5段368號', '王湘婷', '0936785562', 'newhopejim@gmail.com', 'TWD', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic6', 'Link6', 'Count6', '2001-05-29 00:00:00', '2006-05-29 00:00:00'),
(56, '巨宸製作公司', '24318457', '台北市民生東路五段260巷25號', '陳美珊', '0925141032', 'cass81129@gmail.com', 'TWD', '2012-12-12', '2017-12-12', 'Chipmunk', 'Pic7', 'Link7', 'Count7', '2012-12-12 00:00:00', '2017-12-12 00:00:00'),
(57, '冉色斯動畫股份有限公司', '27447721', '新北市永和區博愛街9號1樓', '姚孟超', '0953901062', 'xanthus@gmail.com', 'TWD', '2017-02-01', '2022-02-01', 'Hymnody', 'Pic8', 'Link8', 'Count8', '2017-02-01 00:00:00', '2022-02-01 00:00:00'),
(58, '海樂影業股份有限公司', '27457157', '新北市三重區重新路四段97號26樓', '吳浩佑', '0970148957', 'Deepjoy.ltd@msa.hinet.net', 'TWD', '2019-03-11', '2024-03-11', 'Pedicular', 'Pic9', 'Link9', 'Count9', '2019-03-11 00:00:00', '2024-03-11 00:00:00'),
(59, '三乘影像事務', '80497615', '台北市大安區安和路二段217巷13號', '廖蒲爵', '0963179675', 'triplefilmhouse@hinet.net', 'TWD', '2019-03-24', '2024-03-24', 'Pedicular', 'Pic10', 'Link10', 'Count10', '2019-03-24 00:00:00', '2024-03-24 00:00:00'),
(60, '叄喜映畫股份有限公司', '53760253', '台北市中山區明水路401號1樓', '程紀皓', '0970044938', 'icebing1224@gmail.com', 'TWD', '2019-03-01', '2024-03-01', 'Slutface', 'Pic1', 'Link1', 'Count1', '2019-03-01 00:00:00', '2024-03-01 00:00:00'),
(61, '七日印象電影有限公司', '53087286', '台北市延壽街117號2樓', '沈可尚', '0961762815', '7thdayfilm@gmail.com', 'TWD', '2018-07-05', '2023-07-05', 'Rosarian', 'Pic2', 'Link2', 'Count2', '2023-07-05 00:00:00', '2023-07-05 00:00:00'),
(62, '大夏數位傳播有限公司', '12968096', '台北市建國南路2段231號', '張美珠', '0971346973', 'lihua.cinefilm@gmail.com', 'TWD', '2013-06-30', '2018-06-30', 'Jardonn', 'Pic3', 'Link3', 'Count3', '2013-06-30 00:00:00', '2018-06-30 00:00:00'),
(63, '大觀影視有限公司', '28217326', '台北市金華街18-6號', '陳希聖', '0960552981', 'gvproduction@gmail.com', 'TWD', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic4', 'Link4', 'Count4', '2019-12-10 00:00:00', '2024-12-10 00:00:00'),
(64, '天予電影有限公司', '28934642', '台北市南港區忠孝東路六段70巷21弄22號', '連奕琦', '0913997232', 'giftpictures2@gmail.com', 'TWD', '2010-01-16', '2015-01-16', 'Valence', 'Pic5', 'Link5', 'Count5', '2010-01-16 00:00:00', '2015-01-16 00:00:00'),
(90, '今生視聽傳播有限公司', '20988692', '台北市松山區南京東路5段368號', '王湘婷', '0936785562', 'newhopejim@gmail.com', 'TWD', '2019-12-10', '2024-12-10', 'Zibeline', 'Pic6', 'Link6', 'Count6', '2001-05-29 00:00:00', '2006-05-29 00:00:00'),
(91, '巨宸製作公司', '24318457', '台北市民生東路五段260巷25號', '陳美珊', '0925141032', 'cass81129@gmail.com', 'TWD', '2012-12-12', '2017-12-12', 'Chipmunk', 'Pic7', 'Link7', 'Count7', '2012-12-12 00:00:00', '2017-12-12 00:00:00'),
(92, '冉色斯動畫股份有限公司', '27447721', '新北市永和區博愛街9號1樓', '姚孟超', '0953901062', 'xanthus@gmail.com', 'TWD', '2017-02-01', '2022-02-01', 'Hymnody', 'Pic8', 'Link8', 'Count8', '2017-02-01 00:00:00', '2022-02-01 00:00:00'),
(93, '海樂影業股份有限公司', '27457157', '新北市三重區重新路四段97號26樓', '吳浩佑', '0970148957', 'Deepjoy.ltd@msa.hinet.net', 'TWD', '2019-03-11', '2024-03-11', 'Pedicular', 'Pic9', 'Link9', 'Count9', '2019-03-11 00:00:00', '2024-03-11 00:00:00'),
(94, '三乘影像事務', '80497615', '台北市大安區安和路二段217巷13號', '廖蒲爵', '0963179675', 'triplefilmhouse@hinet.net', 'TWD', '2019-03-24', '2024-03-24', 'Pedicular', 'Pic10', 'Link10', 'Count10', '2019-03-24 00:00:00', '2024-03-24 00:00:00'),
(95, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', 'TGIF 文青不挑片 HipSecret Cinema', 'pic1', 'link1', 'count1', '2019-03-01 00:00:00', '2019-03-05 00:00:00'),
(96, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-06', '2019-03-10', '高負帥の青年們 X 北漂據所 X 神秘放映', 'pic1', 'link1', 'count1', '2019-03-06 00:00:00', '2019-03-10 00:00:00'),
(97, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-11', '2019-03-15', '＃癮人入坐_高負帥の北漂', 'pic1', 'link1', 'count1', '2019-03-11 00:00:00', '2019-03-15 00:00:00'),
(98, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-16', '2019-03-20', '文青不挑片-失戀唱片行＃圓滿休業', 'pic1', 'link1', 'count1', '2019-03-16 00:00:00', '2019-03-20 00:00:00'),
(99, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-21', '2019-03-25', '失戀唱片行政大店-搶先開張', 'pic1', 'link1', 'count1', '2019-03-21 00:00:00', '2019-01-25 00:00:00'),
(100, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-26', '2019-03-31', '政大音樂節X文青不挑片 final call', 'pic1', 'link1', 'count1', '2019-03-26 00:00:00', '2019-03-31 00:00:00'),
(101, 'Spacebar Room 文青不挑片', '54358027', '110 台北市信義區和平東路三段291號453', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-31', '【 早電偵探社 Ｘ 驚喜製造 】', 'pic1', 'link1', 'count1', '2019-03-01 00:00:00', '2019-03-31 00:00:00'),
(102, '光點台北', '28468385', '台北市中山區中山北路二段18號', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '2019台北文學季講座 \r\n王育麟 ╳ 簡莉穎性別跳動的文本迷魅', 'pic1', 'link1', 'count1', '2019-03-01 00:00:00', '2019-03-05 00:00:00'),
(103, '光點台北', '28468385', '台北市中山區中山北路二段18號', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '《家族的色彩》電影講座\r\n', 'pic1', 'link1', 'count1', '2019-03-06 00:00:00', '2019-03-10 00:00:00'),
(104, '光點台北', '28468385', '台北市中山區中山北路二段18號', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '《太陽之女》映後座談― 女性的戰爭與和平', 'pic1', 'link1', 'count1', '2019-03-11 00:00:00', '2019-03-15 00:00:00'),
(105, '光點台北', '28468385', '台北市中山區中山北路二段18號', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '光點選片：《靈山》蘇弘恩作品', 'pic1', 'link1', 'count1', '2019-03-16 00:00:00', '1900-01-20 00:00:00'),
(106, '光點台北', '28468385', '台北市中山區中山北路二段18號', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '【光點珈琲時光/紅氣球】', 'pic1', 'link1', 'count1', '2019-03-21 00:00:00', '2019-03-25 00:00:00'),
(107, '光點台北', '28468385', '台北市中山區中山北路二段18號', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '3月 光點會員招募！', 'pic1', 'link1', 'count1', '2019-03-01 00:00:00', '2019-03-31 00:00:00'),
(108, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-05', '幸福綠皮書 Green Book\r\n\r\n', 'pic1', 'link1', 'count1', '2019-03-01 00:00:00', '2019-03-31 00:00:00'),
(109, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-06', '2019-03-10', '不過就是世界末日-周三口碑電影院 It’s Only the End of the Worl\r\n\r\n', 'pic1', 'link1', 'count1', '2019-03-06 00:00:00', '2019-03-10 00:00:00'),
(110, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-11', '2019-03-15', '騙局 The Realm\r\n', 'pic1', 'link1', 'count1', '2019-03-11 00:00:00', '2019-03-15 00:00:00'),
(111, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-16', '2019-03-20', '來了 It Comes\r\n', 'pic1', 'link1', 'count1', '2019-03-16 00:00:00', '2019-03-20 00:00:00'),
(112, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-21', '2019-03-25', '我們 Us\r\n\r\n\r\n', 'pic1', 'link1', 'count1', '2019-03-21 00:00:00', '2019-03-25 00:00:00'),
(113, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-26', '2019-03-31', '老大人 Dad’s Suit\r\n\r\n\r\n', 'pic1', 'link1', 'count1', '2019-03-26 00:00:00', '2019-03-31 00:00:00'),
(114, '誠品電影院', '23155531', '台北市信義區菸廠路80號B2 ', 'none', 'none', 'none', 'TWD', '2019-03-01', '2019-03-31', 'RBG：不恐龍大法官 RBG\r\n\r\n\r\n', 'pic1', 'link1', 'count1', '2019-03-01 00:00:00', '2019-03-31 00:00:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`sn`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `ad`
--
ALTER TABLE `ad`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
