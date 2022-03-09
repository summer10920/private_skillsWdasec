-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022 年 03 月 09 日 00:34
-- 伺服器版本： 10.5.8-MariaDB-log
-- PHP 版本： 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `skillsCompetition_th50j17_National`
--
CREATE DATABASE IF NOT EXISTS `skillsCompetition_th50j17_National` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `skillsCompetition_th50j17_National`;

-- --------------------------------------------------------

--
-- 資料表結構 `pk`
--

CREATE TABLE `pk` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `pk`
--

INSERT INTO `pk` (`id`, `user`, `msg`, `mail`, `tel`, `date`, `del`) VALUES
(1, '錢宜珊', 'user.jpg', 'aa@gmail.com', '0950256470', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
(2, '李威德', 'user.jpg', 'bb@gmail.com', '0959932667', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1),
(3, '徐育德', 'user.jpg', 'cc@gmail.com', '0998415275', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
(4, '林致梅', 'user.jpg', 'dd@gmail.com', '0980319149', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1),
(5, '程淑芬', 'user.jpg', 'ee@gmail.com', '0906372655', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
(6, '李柏揚', 'user.jpg', 'ff@gmail.com', '0973250425', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
(7, '張柏雄', 'user.jpg', 'gg@gmail.com', '0992370171', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `talk`
--

CREATE TABLE `talk` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `talk`
--

INSERT INTO `talk` (`id`, `user`, `msg`, `mail`, `tel`, `date`, `del`) VALUES
(1, '錢宜珊', '一流大部分政策物流西部高效一對評論攝影通過第二，釣魚本論壇雖然，豐原進步有所，幻想如同配置管理員演員方法獎勵市場價，附件刪除，電池快車審核深深能夠工藝，他不傳。', 'aa@gmail.com', '0950256470', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
(2, '李威德', '消除獲得一大點點精品固定參與用於排行強烈，移動智能看看不住包含讓你，房子內地觀察過去經常每一個諾基亞世界閲讀，雙方某個碩士也要一時機票指揮。', 'bb@gmail.com', '0959932667', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1),
(3, '徐育德', '鮮花第一個一塊當時我把照顧房子排名，調節共同放心標題承擔認為給你，到來將在，負責引導我會大多數交換擔心無門，其實嘿嘿回。', 'cc@gmail.com', '0998415275', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
(4, '林致梅', '能源拍攝宅宅我愛我又正常手術無奈創造簡介，差距技巧周圍左右是我檔案衝突讓我訓練已有，期限畫面，改善台北江湖出台學習，優質天下錯誤，完全門派我要一片對此關係基本。', 'dd@gmail.com', '0980319149', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `pk`
--
ALTER TABLE `pk`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `talk`
--
ALTER TABLE `talk`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pk`
--
ALTER TABLE `pk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `talk`
--
ALTER TABLE `talk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
