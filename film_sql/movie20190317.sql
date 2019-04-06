-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 17 日 07:51
-- 伺服器版本: 10.1.37-MariaDB
-- PHP 版本： 7.1.26

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
-- 資料表結構 `activity`
--

CREATE TABLE `activity` (
  `sid` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '活動名稱',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '活動內容',
  `dateStart` date NOT NULL COMMENT '活動開始日期',
  `dateEnd` date NOT NULL COMMENT '活動結束日期',
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '活動圖片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `activity`
--

INSERT INTO `activity` (`sid`, `name`, `content`, `dateStart`, `dateEnd`, `picture`) VALUES
(1, '【朝代大戲院】看電影送冷飲！', '來朝代大戲院看電影，一張門票即可兌換中杯可樂乙杯！', '2018-02-03', '2019-06-30', 'https://picsum.photos/200/150/?random'),
(2, '【光點之家】光點會員招募！', '辦卡優惠價NT$5OO，可享【光點台北】、 【光點華山】兩館購票優惠，【光點生活】、【光點珈琲時光】消費優惠，並可獲得 YIRI LIVING							提供當月會員禮。（如右圖，數量有限，送完為止！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/100/?random'),
(3, '【台北電影節】實習生招募！', '第二十一屆台北電影節節目組早鳥實習生招募開始！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/150/?random'),
(5, '【朝代大戲院】看電影送冷飲！', '來朝代大戲院看電影，一張門票即可兌換中杯可樂乙杯！', '2018-02-03', '2019-06-30', 'https://picsum.photos/200/150/?random'),
(6, '【光點之家】光點會員招募！', '辦卡優惠價NT$5OO，可享【光點台北】、 【光點華山】兩館購票優惠，【光點生活】、【光點珈琲時光】消費優惠，並可獲得 YIRI LIVING							提供當月會員禮。（如右圖，數量有限，送完為止！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/100/?random'),
(7, '【台北電影節】實習生招募！', '第二十一屆台北電影節節目組早鳥實習生招募開始！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/150/?random'),
(9, '【朝代大戲院】看電影送冷飲！', '來朝代大戲院看電影，一張門票即可兌換中杯可樂乙杯！', '2018-02-03', '2019-06-30', 'https://picsum.photos/200/150/?random'),
(10, '【光點之家】光點會員招募！', '辦卡優惠價NT$5OO，可享【光點台北】、 【光點華山】兩館購票優惠，【光點生活】、【光點珈琲時光】消費優惠，並可獲得 YIRI LIVING							提供當月會員禮。（如右圖，數量有限，送完為止！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/100/?random'),
(11, '【台北電影節】實習生招募！', '第二十一屆台北電影節節目組早鳥實習生招募開始！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/150/?random'),
(13, '【朝代大戲院】看電影送冷飲！', '來朝代大戲院看電影，一張門票即可兌換中杯可樂乙杯！', '2018-02-03', '2019-06-30', 'https://picsum.photos/200/150/?random'),
(14, '【光點之家】光點會員招募！', '辦卡優惠價NT$5OO，可享【光點台北】、 【光點華山】兩館購票優惠，【光點生活】、【光點珈琲時光】消費優惠，並可獲得 YIRI LIVING							提供當月會員禮。（如右圖，數量有限，送完為止！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/100/?random'),
(15, '【台北電影節】實習生招募！', '第二十一屆台北電影節節目組早鳥實習生招募開始！', '2018-02-03', '2019-06-30', 'https://picsum.photos/150/150/?random');

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `sid` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `admins`
--

INSERT INTO `admins` (`sid`, `admin_id`, `password`, `create_at`) VALUES
(1, 'shawnlin', 'bacbf346c615194c7343a1b9ced26f0440be57d5', '0000-00-00 00:00:00'),
(2, 'charles', '549ec1647159ab9f1f7b2f2c5d7731fecc549908', '2019-03-19 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `film_primary_table`
--

CREATE TABLE `film_primary_table` (
  `sid` int(11) NOT NULL,
  `name_tw` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `intro_tw` varchar(1500) NOT NULL,
  `intro_en` varchar(1500) NOT NULL,
  `movie_pic` varchar(255) NOT NULL,
  `movie_genre` varchar(255) NOT NULL,
  `movie_ver` varchar(255) NOT NULL,
  `movie_rating` varchar(255) NOT NULL,
  `trailer` varchar(255) NOT NULL,
  `pirce` int(11) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `in_theaters` date NOT NULL,
  `out_theaters` date NOT NULL,
  `runtime` int(11) NOT NULL,
  `director_tw` varchar(255) NOT NULL,
  `director_en` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `subtitle_lang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='影片相關';

--
-- 資料表的匯出資料 `film_primary_table`
--

INSERT INTO `film_primary_table` (`sid`, `name_tw`, `name_en`, `intro_tw`, `intro_en`, `movie_pic`, `movie_genre`, `movie_ver`, `movie_rating`, `trailer`, `pirce`, `schedule`, `in_theaters`, `out_theaters`, `runtime`, `director_tw`, `director_en`, `country`, `subtitle`, `subtitle_lang`) VALUES
(1, 'Fate/stay night：II.迷途之蝶 Fate/stay night', '', '延續第一章預示之花劇情，聖杯戰爭進入中盤，隨著間桐家的當家間桐臓硯正式參戰，不只情勢更詭譎，戰況亦持續激化。士郎失去了Saber後，能否順利保護小櫻，守護兩人之間的約定？', 'The story focuses on the Holy Grail War and explores the relationship between Shirou Emiya and Sakura Matou, two teenagers participating in this conflict. The story continues immediately from Fate/stay night: Heaven\'s Feel I. presage flower, following Shirou as he continues to participate in the Holy Grail War even after being eliminated as a master.', '', '', '', '輔導級', '', 0, '', '2019-03-15', '0000-00-00', 118, '須藤友德', 'Tomonori Sudo', 'Japan', '有', '中');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- 資料表索引 `film_primary_table`
--
ALTER TABLE `film_primary_table`
  ADD PRIMARY KEY (`sid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `activity`
--
ALTER TABLE `activity`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表 AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `film_primary_table`
--
ALTER TABLE `film_primary_table`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
