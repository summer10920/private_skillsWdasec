-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2022 年 02 月 19 日 03:00
-- 伺服器版本: 5.5.68-MariaDB
-- PHP 版本： 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `skillsCompetition_th50j17_National_v2`
--

-- --------------------------------------------------------

--
-- 資料表結構 `msg`
--

CREATE TABLE `msg` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `msg`
--

INSERT INTO `msg` (`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES
(1, 'User A', '留言內容A', 'aa@gmail.com', '02-02345678', '2020-07-20 22:23:04', 0),
(2, 'User B', '留言內容B', 'bb@gmail.com', '02-12345678', '2020-07-20 22:28:02', 1),
(3, 'User C', '留言內容C', 'ccccc@gmail.com', '02-22345678', '2020-07-25 07:51:02', 1),
(4, 'User D', '留言內容D', 'dd@gmail.com', '02-32345678', '2020-07-20 19:55:54', 0),
(5, 'User E', '留言內容E', 'eeeeee@gmail.com', '02-42345678', '2020-07-25 07:51:25', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `pk`
--

CREATE TABLE `pk` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `pk`
--

INSERT INTO `pk` (`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES
(1, 'User A', 'user.jpg', 'aa@gmail.com', '02-02345678', '2020-07-20 22:23:04', 0),
(2, 'User B', 'user.jpg', 'bb@gmail.com', '02-12345678', '2020-07-20 22:28:02', 1),
(3, 'User C', 'user.jpg', 'cc@gmail.com', '02-22345678', '2020-07-20 19:55:54', 0),
(4, 'User D', 'user.jpg', 'dd@gmail.com', '02-32345678', '2020-07-20 19:55:54', 1),
(5, 'User E', 'user.jpg', 'ee@gmail.com', '02-42345678', '2020-07-20 19:55:54', 0);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pk`
--
ALTER TABLE `pk`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用資料表 AUTO_INCREMENT `pk`
--
ALTER TABLE `pk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
