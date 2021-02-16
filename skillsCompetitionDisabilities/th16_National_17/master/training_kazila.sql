-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020 年 02 月 03 日 14:03
-- 伺服器版本： 10.1.40-MariaDB
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `training_kazila`
--

-- --------------------------------------------------------

--
-- 資料表結構 `th16_msg`
--

CREATE TABLE `th16_msg` (
  `id` int(10) UNSIGNED NOT NULL,
  `who` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `says` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dpy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `th16_msg`
--

INSERT INTO `th16_msg` (`id`, `who`, `tel`, `mail`, `addr`, `says`, `dpy`) VALUES
(1, '小黑0', '0986592651', 'aa@bb.cc', '新北市泰山區明志路三段149巷17號', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.\r\n\r\n幹\r\nAAAe04', 0),
(2, '小黑1', '0986592651', 'aa@bb.cc', '新北市泰山區明志路三段149巷17號', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.', 0),
(3, '小黑2', '0986592651', 'aa@bb.cc', '新北市泰山區明志路三段149巷17號', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.', 0),
(4, '老王', '0986592651', 'cc@cc.cc', '台北市重慶南路一段一號', '我好恨喔!!', 0),
(5, '歌姬旯', '0986-555333', 'sasd@12.cc', 'asdad', 'asda', 0),
(6, 'AA', '0986592651', 'BB@cc.DD', 'DD', 'EE\r\n\r\n-感謝您的回應', 0),
(7, 'sss', '0988888888', '22@99.99', '222', '22222', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `th16_odr`
--

CREATE TABLE `th16_odr` (
  `id` int(10) UNSIGNED NOT NULL,
  `who` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `says` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `roomtype` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `keynum` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `th16_room`
--

CREATE TABLE `th16_room` (
  `id` int(11) UNSIGNED NOT NULL,
  `roomtype` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `roomdate` date NOT NULL,
  `sellout` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remain` int(11) NOT NULL,
  `roomprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `th16_setting`
--

CREATE TABLE `th16_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `pse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `th16_setting`
--

INSERT INTO `th16_setting` (`id`, `pse`) VALUES
(1, 20);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `th16_msg`
--
ALTER TABLE `th16_msg`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `th16_odr`
--
ALTER TABLE `th16_odr`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `th16_room`
--
ALTER TABLE `th16_room`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `th16_setting`
--
ALTER TABLE `th16_setting`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `th16_msg`
--
ALTER TABLE `th16_msg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `th16_odr`
--
ALTER TABLE `th16_odr`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `th16_room`
--
ALTER TABLE `th16_room`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `th16_setting`
--
ALTER TABLE `th16_setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
