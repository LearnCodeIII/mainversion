-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 21 日 09:40
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
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `fav_type` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'null.jpg',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pwd` varchar(255) NOT NULL,
  `pwd_change_d` datetime NOT NULL,
  `pwd_err_c` int(11) DEFAULT '0',
  `last_login_d` datetime DEFAULT CURRENT_TIMESTAMP,
  `login_c` int(11) DEFAULT '1',
  `rank` int(11) NOT NULL DEFAULT '0',
  `permission` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`sid`, `name`, `nickname`, `gender`, `age`, `birthday`, `email`, `mobile`, `fav_type`, `avatar`, `join_date`, `pwd`, `pwd_change_d`, `pwd_err_c`, `last_login_d`, `login_c`, `rank`, `permission`) VALUES
(1, '皮卡丘', '皮卡', '男', 10, '2000-01-01', 'pokemon1@mm.com', '0910-000-001', '動作片,動畫片,紀錄片', '3fb26cc1614aca6cec678ee3313793e38072cf22.png', '2019-03-14 07:54:31', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(2, '小火龍', '火龍', '男', 11, '2000-01-02', 'pokemon2@mm.com', '0910-000-002', '動畫片,武俠片', '1b6453892473a467d07372d45eb05abc2031647a.png', '2019-03-14 08:06:10', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '2'),
(3, '傑尼龜', '傑尼', '女', 9, '2000-01-03', 'pokemon3@mm.com', '0910-000-003', '動作片', '902ba3cda1883801594b6e1b452790cc53948fda.png', '2019-03-14 08:06:10', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(4, '妙蛙種子', '種子', '女', 12, '2000-01-04', 'pokemon4@mm.com', '0910-000-004', '動作片,戲劇片', '356a192b7913b04c54574d18c28d46e6395428ab.png', '2019-03-14 08:06:10', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(5, '伊布', '小伊', '男', 10, '2000-01-05', 'pokemon5@mm.com', '0910-000-005', '', '17ba0791499db908433b80f37c5fbc89b870084b.png', '2019-03-14 08:06:10', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(6, '假人1號', '小假1', '女', 1, '2000-01-01', 'fakeman1@fake.com', '0920-000-001', '科幻片,懸疑片,驚悚片,愛情片', 'null.jpg', '2019-03-14 08:31:07', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(7, '假人2號', '小假2', '女', 2, '2000-01-01', 'fakeman2@fake.com', '0920-000-002', '', 'null.jpg', '2019-03-14 08:31:07', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(8, '假人3號', '小假3', '女', 3, '2000-01-01', 'fakeman3@fake.com', '0920-000-003', '', 'null.jpg', '2019-03-14 08:31:07', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(9, '假人4號', '小假4', '女', 4, '2000-01-01', 'fakeman4@fake.com', '0920-000-004', '', 'null.jpg', '2019-03-14 08:31:07', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(10, '假人5號', '小假5', '男', 5, '2000-01-01', 'fakeman5@fake.com', '0920-000-005', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '0'),
(11, '假人6號', '小假6', '女', 6, '2000-01-01', 'fakeman6@fake.com', '0920-000-006', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(12, '假人7號', '小假7', '女', 7, '2000-01-01', 'fakeman7@fake.com', '0920-000-007', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(13, '假人8號', '小假8', '女', 8, '2000-01-01', 'fakeman8@fake.com', '0920-000-008', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(14, '假人9號', '小假9', '女', 9, '2000-01-01', 'fakeman9@fake.com', '0920-000-009', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(15, '假人10號', '小假10', '男', 10, '2000-01-01', 'fakeman10@fake.com', '0920-000-010', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '0'),
(16, '假人11號', '小假11', '女', 11, '2000-01-01', 'fakeman11@fake.com', '0920-000-011', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(17, '假人12號', '小假12', '女', 12, '2000-01-01', 'fakeman12@fake.com', '0920-000-012', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(18, '假人13號', '小假13', '女', 13, '2000-01-01', 'fakeman13@fake.com', '0920-000-013', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(19, '假人14號', '小假14', '女', 14, '2000-01-01', 'fakeman14@fake.com', '0920-000-014', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(20, '假人15號', '小假15', '男', 15, '2000-01-01', 'fakeman15@fake.com', '0920-000-015', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '0'),
(21, '假人16號', '小假16', '女', 16, '2000-01-01', 'fakeman16@fake.com', '0920-000-016', '動作片,動畫片,喜劇片', 'null.jpg', '2019-03-14 08:31:08', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(22, '假人17號', '小假17', '女', 17, '2000-01-01', 'fakeman17@fake.com', '0920-000-017', '動作片,紀錄片', '283863d984e402aecacee4fd2726bf7db39582e6.png', '2019-03-14 08:31:08', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(23, '假人18號', '小假18', '女', 18, '2000-01-01', 'fakeman18@fake.com', '0920-000-018', '喜劇片,英雄片', 'null.jpg', '2019-03-14 08:31:08', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(24, '假人19號', '小假19', '女', 19, '2000-01-01', 'fakeman19@fake.com', '0920-000-019', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(25, '假人20號', '小假20', '男', 20, '2000-01-01', 'fakeman20@fake.com', '0920-000-020', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '0'),
(26, '假人21號', '小假21', '女', 21, '2000-01-01', 'fakeman21@fake.com', '0920-000-021', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(27, '假人22號', '小假22', '女', 22, '2000-01-01', 'fakeman22@fake.com', '0920-000-022', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(28, '假人23號', '小假23', '女', 23, '2000-01-01', 'fakeman23@fake.com', '0920-000-023', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(29, '假人24號', '小假24', '女', 24, '2000-01-01', 'fakeman24@fake.com', '0920-000-024', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(30, '假人25號', '小假25', '男', 25, '2000-01-01', 'fakeman25@fake.com', '0920-000-025', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(31, '假人26號', '小假26', '女', 26, '2000-01-01', 'fakeman26@fake.com', '0920-000-026', '偵探片', 'null.jpg', '2019-03-14 08:31:08', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(32, '假人27號', '小假27', '女', 27, '2000-01-01', 'fakeman27@fake.com', '0920-000-027', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(33, '假人28號', '小假28', '女', 28, '2000-01-01', 'fakeman28@fake.com', '0920-000-028', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(34, '假人29號', '小假29', '女', 29, '2000-01-01', 'fakeman29@fake.com', '0920-000-029', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(35, '假人30號', '小假30', '男', 30, '2000-01-01', 'fakeman30@fake.com', '0920-000-030', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(36, '假人31號', '小假31', '女', 31, '2000-01-01', 'fakeman31@fake.com', '0920-000-031', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(37, '假人32號', '小假32', '女', 32, '2000-01-01', 'fakeman32@fake.com', '0920-000-032', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(38, '假人33號', '小假33', '女', 33, '2000-01-01', 'fakeman33@fake.com', '0920-000-033', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(39, '假人34號', '小假34', '女', 34, '2000-01-01', 'fakeman34@fake.com', '0920-000-034', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(40, '假人35號', '小假35', '男', 35, '2000-01-01', 'fakeman35@fake.com', '0920-000-035', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(41, '假人36號', '小假36', '女', 36, '2000-01-01', 'fakeman36@fake.com', '0920-000-036', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(42, '假人37號', '小假37', '女', 37, '2000-01-01', 'fakeman37@fake.com', '0920-000-037', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(43, '假人38號', '小假38', '女', 38, '2000-01-01', 'fakeman38@fake.com', '0920-000-038', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(44, '假人39號', '小假39', '女', 39, '2000-01-01', 'fakeman39@fake.com', '0920-000-039', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(45, '假人40號', '小假40', '男', 40, '2000-01-01', 'fakeman40@fake.com', '0920-000-040', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(46, '假人41號', '小假41', '女', 41, '2000-01-01', 'fakeman41@fake.com', '0920-000-041', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(47, '假人42號', '小假42', '女', 42, '2000-01-01', 'fakeman42@fake.com', '0920-000-042', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(48, '假人43號', '小假43', '女', 43, '2000-01-01', 'fakeman43@fake.com', '0920-000-043', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(49, '假人44號', '小假44', '女', 44, '2000-01-01', 'fakeman44@fake.com', '0920-000-044', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(50, '假人45號', '小假45', '男', 45, '2000-01-01', 'fakeman45@fake.com', '0920-000-045', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(51, '假人46號', '小假46', '女', 46, '2000-01-01', 'fakeman46@fake.com', '0920-000-046', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(52, '假人47號', '小假47', '女', 47, '2000-01-01', 'fakeman47@fake.com', '0920-000-047', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(53, '假人48號', '小假48', '女', 48, '2000-01-01', 'fakeman48@fake.com', '0920-000-048', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(54, '假人49號', '小假49', '女', 49, '2000-01-01', 'fakeman49@fake.com', '0920-000-049', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(55, '假人50號', '小假50', '男', 50, '2000-01-01', 'fakeman50@fake.com', '0920-000-050', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(56, '假人51號', '小假51', '女', 51, '2000-01-01', 'fakeman51@fake.com', '0920-000-051', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(57, '假人52號', '小假52', '女', 52, '2000-01-01', 'fakeman52@fake.com', '0920-000-052', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(58, '假人53號', '小假53', '女', 53, '2000-01-01', 'fakeman53@fake.com', '0920-000-053', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(59, '假人54號', '小假54', '女', 54, '2000-01-01', 'fakeman54@fake.com', '0920-000-054', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(60, '假人55號', '小假55', '男', 55, '2000-01-01', 'fakeman55@fake.com', '0920-000-055', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(61, '假人56號', '小假56', '女', 56, '2000-01-01', 'fakeman56@fake.com', '0920-000-056', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(62, '假人57號', '小假57', '女', 57, '2000-01-01', 'fakeman57@fake.com', '0920-000-057', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(63, '假人58號', '小假58', '女', 58, '2000-01-01', 'fakeman58@fake.com', '0920-000-058', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(64, '假人59號', '小假59', '女', 59, '2000-01-01', 'fakeman59@fake.com', '0920-000-059', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(65, '假人60號', '小假60', '男', 60, '2000-01-01', 'fakeman60@fake.com', '0920-000-060', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(66, '假人61號', '小假61', '女', 61, '2000-01-01', 'fakeman61@fake.com', '0920-000-061', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(67, '假人62號', '小假62', '女', 62, '2000-01-01', 'fakeman62@fake.com', '0920-000-062', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(68, '假人63號', '小假63', '女', 63, '2000-01-01', 'fakeman63@fake.com', '0920-000-063', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(69, '假人64號', '小假64', '女', 64, '2000-01-01', 'fakeman64@fake.com', '0920-000-064', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(70, '假人65號', '小假65', '男', 65, '2000-01-01', 'fakeman65@fake.com', '0920-000-065', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(71, '假人66號', '小假66', '女', 66, '2000-01-01', 'fakeman66@fake.com', '0920-000-066', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(72, '假人67號', '小假67', '女', 67, '2000-01-01', 'fakeman67@fake.com', '0920-000-067', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(73, '假人68號', '小假68', '女', 68, '2000-01-01', 'fakeman68@fake.com', '0920-000-068', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(74, '假人69號', '小假69', '女', 69, '2000-01-01', 'fakeman69@fake.com', '0920-000-069', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(75, '假人70號', '小假70', '男', 70, '2000-01-01', 'fakeman70@fake.com', '0920-000-070', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(76, '假人71號', '小假71', '女', 71, '2000-01-01', 'fakeman71@fake.com', '0920-000-071', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(77, '假人72號', '小假72', '女', 72, '2000-01-01', 'fakeman72@fake.com', '0920-000-072', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(78, '假人73號', '小假73', '女', 73, '2000-01-01', 'fakeman73@fake.com', '0920-000-073', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(79, '假人74號', '小假74', '女', 74, '2000-01-01', 'fakeman74@fake.com', '0920-000-074', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(80, '假人75號', '小假75', '男', 75, '2000-01-01', 'fakeman75@fake.com', '0920-000-075', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(81, '假人76號', '小假76', '女', 76, '2000-01-01', 'fakeman76@fake.com', '0920-000-076', '動作片,動畫片,喜劇片,偵探片,紀錄片,戲劇片,英雄片,恐怖片,武俠片,靈異片,文藝片,警匪片,科幻片,懸疑片,驚悚片,戰爭片,愛情片', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(82, '假人77號', '小假77', '女', 77, '2000-01-01', 'fakeman77@fake.com', '0920-000-077', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(83, '假人78號', '小假78', '女', 78, '2000-01-01', 'fakeman78@fake.com', '0920-000-078', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(84, '假人79號', '小假79', '女', 79, '2000-01-01', 'fakeman79@fake.com', '0920-000-079', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(85, '假人80號', '小假80', '男', 80, '2000-01-01', 'fakeman80@fake.com', '0920-000-080', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(86, '假人81號', '小假81', '女', 81, '2000-01-01', 'fakeman81@fake.com', '0920-000-081', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(87, '假人82號', '小假82', '女', 82, '2000-01-01', 'fakeman82@fake.com', '0920-000-082', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(88, '假人83號', '小假83', '女', 83, '2000-01-01', 'fakeman83@fake.com', '0920-000-083', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(89, '假人84號', '小假84', '女', 84, '2000-01-01', 'fakeman84@fake.com', '0920-000-084', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(90, '假人85號', '小假85', '男', 85, '2000-01-01', 'fakeman85@fake.com', '0920-000-085', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(91, '假人86號', '小假86', '女', 86, '2000-01-01', 'fakeman86@fake.com', '0920-000-086', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(92, '假人87號', '小假87', '女', 87, '2000-01-01', 'fakeman87@fake.com', '0920-000-087', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(93, '假人88號', '小假88', '女', 88, '2000-01-01', 'fakeman88@fake.com', '0920-000-088', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(94, '假人89號', '小假89', '女', 89, '2000-01-01', 'fakeman89@fake.com', '0920-000-089', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(95, '假人90號', '小假90', '男', 90, '2000-01-01', 'fakeman90@fake.com', '0920-000-090', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(96, '假人91號', '小假91', '女', 91, '2000-01-01', 'fakeman91@fake.com', '0920-000-091', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(97, '假人92號', '小假92', '女', 92, '2000-01-01', 'fakeman92@fake.com', '0920-000-092', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(98, '假人93號', '小假93', '女', 93, '2000-01-01', 'fakeman93@fake.com', '0920-000-093', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(99, '假人94號', '小假94', '女', 94, '2000-01-01', 'fakeman94@fake.com', '0920-000-094', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(100, '假人95號', '小假95', '男', 95, '2000-01-01', 'fakeman95@fake.com', '0920-000-095', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(101, '假人96號', '小假96', '女', 96, '2000-01-01', 'fakeman96@fake.com', '0920-000-096', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(102, '假人97號', '小假97', '女', 97, '2000-01-01', 'fakeman97@fake.com', '0920-000-097', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(103, '假人98號', '小假98', '女', 98, '2000-01-01', 'fakeman98@fake.com', '0920-000-098', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(104, '假人99號', '小假99', '女', 99, '2000-01-01', 'fakeman99@fake.com', '0920-000-099', '', 'null.jpg', '2019-03-14 08:31:08', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(105, '測試1號', '測1', '男', 22, '2019-03-17', 'test@tt.com', '0900-000-000', '', 'null.jpg', '2019-03-17 15:23:41', 'qwe', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, '1'),
(106, '測試2號', '測2', '男', 20, '1999-09-09', 'test02@tt.com', '0919191919', '', 'null.jpg', '2019-03-18 06:02:02', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 14:02:02', 1, 0, '1'),
(110, '測試3號', '測3', '男', 20, '1999-09-09', 'test03@tt.com', '0919191919', '動畫片,喜劇片,科幻片', 'null.jpg', '2019-03-18 06:19:53', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 14:19:53', 1, 0, '1'),
(112, '測試4號', '測4', '女', 20, '1999-09-09', 'test04@tt.com', '0922-222-222', '動作片,動畫片,喜劇片,紀錄片,戲劇片,英雄片', 'null.jpg', '2019-03-18 06:21:47', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 14:21:47', 1, 0, '1'),
(113, '測試5號', '測5', '男', 20, '1999-09-09', 'test05@tt.com', '0919191919', '動作片,紀錄片,武俠片,科幻片', 'null.jpg', '2019-03-18 06:43:57', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 14:43:57', 1, 0, '1'),
(117, '測試6號', '測6', '男', 31, '1988-11-11', 'test06@tt.com', '0919191919', '動畫片,喜劇片,英雄片', '7087c4ee9cfef9b5885af49aeb00de5db04daad5.jpg', '2019-03-18 06:50:43', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 14:50:43', 1, 0, '1'),
(118, '測試7號', '測7', '男', 31, '1988-11-11', 'test07@tt.com', '0919191919', '動畫片,喜劇片,戲劇片,英雄片', 'b973459997725d6d02e1e01761ebb0e65103b16a.jpg', '2019-03-18 06:56:25', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 14:56:25', 1, 0, '1'),
(119, '測試8號', '測8', '男', 20, '1999-09-09', 'test08@tt.com', '0919191919', '動作片,動畫片,喜劇片,偵探片,紀錄片,戲劇片,英雄片,恐怖片,武俠片,靈異片,文藝片,警匪片,科幻片,懸疑片,驚悚片,戰爭片,愛情片', 'eb457c4c4961b1eb04f7edba8ef098156717d3ae.jpg', '2019-03-18 08:10:10', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-18 16:10:10', 1, 0, '1'),
(120, '測試9號', '測9', '男', 20, '1999-09-09', 'test09@tt.com', '0919191919', '動作片,喜劇片', 'null.jpg', '2019-03-18 08:27:39', 'a9c50c3d9395c7fce34d7dc1e678236b2129600e', '0000-00-00 00:00:00', 0, '2019-03-18 16:27:39', 1, 0, '1'),
(133, '測試10號', '測10', '女', 20, '1988-11-11', 'test10@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 03:43:05', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 11:43:05', 1, 0, '1'),
(137, '測試11號', '測11', '女', 20, '1988-11-11', 'test11@tt.com', '0919191919', '動畫片', 'null.jpg', '2019-03-19 03:43:38', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 11:43:38', 1, 0, '1'),
(141, '測試12號', '測12', '男', 20, '1988-11-11', 'test12@tt.com', '0919191919', '動作片', 'null.jpg', '2019-03-19 03:47:04', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 11:47:04', 1, 0, '1'),
(142, '測試13號', '測13', '女', 20, '1999-09-09', 'test13@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 03:51:40', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 11:51:40', 1, 0, '1'),
(143, '測試14號', '測14', '女', 20, '1999-09-09', 'test14@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:02:06', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:02:06', 1, 0, '1'),
(145, '測試15號', '測15', '女', 20, '1999-09-09', 'test15@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:02:36', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:02:36', 1, 0, '1'),
(147, '測試16號', '測16', '女', 20, '1999-09-09', 'test16@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:04:26', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:04:26', 1, 0, '1'),
(150, '測試17號', '測17', '男', 20, '1988-11-11', 'test17@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:05:57', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:05:57', 1, 0, '1'),
(152, '測試18號', '測18', '男', 20, '1988-11-11', 'test18@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:07:27', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:07:27', 1, 0, '1'),
(154, '測試19號', '測19', '男', 20, '1988-11-11', 'test19@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:07:49', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:07:49', 1, 0, '1'),
(155, '測試20號', '測20', '男', 20, '1988-11-11', 'test20@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:09:30', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:09:30', 1, 0, '1'),
(158, '測試21號', '測21', '男', 20, '1988-11-11', 'test21@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:10:24', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:10:24', 1, 0, '1'),
(162, '測試22號', '測22', '女', 20, '1988-11-11', 'test22@tt.com', '0919191919', '動畫片', 'null.jpg', '2019-03-19 04:13:55', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:13:55', 1, 0, '1'),
(164, '測試23號', '測23', '女', 20, '1988-11-11', 'test23@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 04:14:23', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 12:14:23', 1, 0, '1'),
(168, '測試24號', '測24', '男', 20, '1988-11-11', 'test24@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:42:06', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:42:06', 1, 0, '1'),
(175, '測試25號', '測25', '男', 20, '1988-11-11', 'test25@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:46:13', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:46:13', 1, 0, '1'),
(177, '測試26號', '測26', '男', 20, '1988-11-11', 'test26@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:46:35', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:46:35', 1, 0, '1'),
(178, '測試27號', '測27', '男', 20, '1988-11-11', 'test27@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:48:34', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:48:34', 1, 0, '1'),
(180, '測試28號', '測28', '男', 20, '1988-11-11', 'test28@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:49:20', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:49:20', 1, 0, '1'),
(182, '測試29號', '測29', '男', 20, '1988-11-11', 'test29@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:49:43', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:49:43', 1, 0, '1'),
(184, '測試30號', '測30', '男', 20, '1988-11-11', 'test30@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:52:29', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:52:29', 1, 0, '1'),
(186, '測試31號', '測31', '男', 20, '1988-11-11', 'test31@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:52:46', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:52:46', 1, 0, '1'),
(189, '測試32號', '測32', '男', 20, '1988-11-11', 'test32@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:56:35', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:56:35', 1, 0, '1'),
(190, '測試33號', '測33', '男', 20, '1988-11-11', 'test33@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:56:48', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:56:48', 1, 0, '1'),
(192, '測試34號', '測34', '男', 20, '1988-11-11', 'test34@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 05:57:06', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 13:57:06', 1, 0, '1'),
(193, '測試35號', '測35', '男', 20, '1988-11-11', 'test35@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 06:03:12', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 14:03:12', 1, 0, '1'),
(195, '測試36號', '測36', '男', 20, '1988-11-11', 'test36@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 06:03:27', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 14:03:27', 1, 0, '1'),
(196, '測試37號', '測37', '男', 20, '1988-11-11', 'test37@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 06:07:46', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 14:07:46', 1, 0, '1'),
(198, '測試38號', '測38', '男', 20, '1988-11-11', 'test38@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 06:08:05', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 14:08:05', 1, 0, '1'),
(199, '測試40號', '測40', '男', 20, '1988-11-11', 'test40@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 10:06:38', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 18:06:38', 1, 0, '1'),
(201, '測試41號', '測41', '男', 20, '1988-11-11', 'test41@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 10:07:03', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-19 18:07:03', 1, 0, '1'),
(214, '測試42號', '測42', '男', 20, '1988-11-11', 'test42@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 10:28:22', '2622cf19571c82b10ee7f9305542dd652acd23ff', '0000-00-00 00:00:00', 0, '2019-03-19 18:28:22', 1, 0, '1'),
(216, '測試43號', '測43', '男', 20, '1988-11-11', 'test43@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 10:28:35', '2622cf19571c82b10ee7f9305542dd652acd23ff', '0000-00-00 00:00:00', 0, '2019-03-19 18:28:35', 1, 0, '1'),
(218, '測試44號', '測44', '男', 20, '1988-11-11', 'test44@tt.com', '0919191919', '', 'null.jpg', '2019-03-19 10:29:17', '2622cf19571c82b10ee7f9305542dd652acd23ff', '0000-00-00 00:00:00', 0, '2019-03-19 18:29:17', 1, 0, '1'),
(219, '圖片測試', '圖片測試', '男', 20, '1988-11-11', 'pic@ddd.com', '0919191919', '', 'null.jpg', '2019-03-20 03:59:44', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 11:59:44', 1, 0, '1'),
(221, '圖片測試2', '圖測2', '女', 20, '1988-11-11', 'pic2@ddd.com', '0919191919', '', 'null.jpg', '2019-03-20 04:00:41', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 12:00:41', 1, 0, '1'),
(222, '圖片測試3', '圖測3', '男', 20, '1988-11-11', 'pic3@ddd.com', '0919191919', '', 'a211a2eecd1a9835239130e08d2aedddf44f46c8.jpg', '2019-03-20 04:01:24', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 12:01:24', 1, 0, '1'),
(223, '測試圖片4', '測圖4', '女', 20, '1988-11-11', 'pic4@ddd.com', '0919191919', '動畫片', '9b33ce21a69e23f2b29d437e78eb6727a244c07a.png', '2019-03-20 05:49:29', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 13:49:29', 1, 0, '1'),
(224, 'p1', '1', '男', 20, '1988-11-11', 'p1@ddd.com', '0919191919', '', '7620bc5a2162c6abda204c5386968b1cb39da776.jpg', '2019-03-20 06:37:49', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 14:37:49', 1, 0, '1'),
(225, 'p2', '2', '男', 20, '1988-11-11', 'p2@ppp.com', '0919191919', '', '593e1c783d7526a668e1a7d084f909d8a1dd909d.png', '2019-03-20 06:42:24', 'eadc1dd8fc279583d5552700ae5d248e3fa123bd', '0000-00-00 00:00:00', 0, '2019-03-20 14:42:24', 1, 0, '1'),
(226, 'p3', 'p3', '男', 0, '1988-11-11', 'p3@ppp.com', '0919191919', '', 'b18d7afcacdf0949b16ba985dd0b9853ea8ce89a.jpg', '2019-03-20 06:51:35', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 14:51:35', 1, 0, '1'),
(227, 'p5', 'p5', '男', 20, '1988-11-11', 'pg@ppp.com', '0919191919', '動畫片', '7611d35162370d7225c091250e68f2368d9afc6a.jpg', '2019-03-20 07:09:50', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-20 15:09:50', 1, 0, '1'),
(228, '空一', '空1', '男', 20, '1988-11-11', 'oo1@ddd.com', '0919191919', '動作片', 'null.jpg', '2019-03-21 03:38:25', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-21 11:38:25', 1, 0, '1'),
(229, '空值二', '空2', '女', 20, '1988-11-11', 'o2@ddd.com', '0919191919', NULL, 'null.jpg', '2019-03-21 03:40:00', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-21 11:40:00', 1, 0, '1'),
(230, '空值三', '空3', '女', 20, '1988-11-11', 'o3@ddd.com', '0919191919', NULL, 'null.jpg', '2019-03-21 03:41:28', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0000-00-00 00:00:00', 0, '2019-03-21 11:41:28', 1, 0, '1'),
(231, '空值四', '空4', '女', 20, '1988-11-11', 'o4@ddd.com', '0919191919', NULL, 'null.jpg', '2019-03-21 03:44:51', '056eafe7cf52220de2df36845b8ed170c67e23e3', '0000-00-00 00:00:00', 0, '2019-03-21 11:44:51', 1, 0, '1');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
