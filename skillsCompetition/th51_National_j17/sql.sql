-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-08-09 12:06:23
-- 伺服器版本： 10.4.20-MariaDB
-- PHP 版本： 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `th51_n`
--
CREATE DATABASE IF NOT EXISTS `th51_n` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `th51_n`;

-- --------------------------------------------------------

--
-- 資料表結構 `msg`
--

CREATE TABLE `msg` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwd` int(11) NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `showtel` int(11) NOT NULL,
  `showmail` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `mdate` datetime DEFAULT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `del` int(11) NOT NULL,
  `tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `msg`
--

INSERT INTO `msg` (`id`, `user`, `pwd`, `tel`, `mail`, `img`, `info`, `showtel`, `showmail`, `cdate`, `mdate`, `reply`, `del`, `tag`) VALUES
(1, '旅客A', 1234, '02-22223333', 'aa@gmail.com', 'user1.jpg', '一流大部分政策物流西部高效一對評論攝影通過第二，釣魚本論壇雖然，豐原進步有所，幻想如同配置管理員演員方法獎勵市場價，附件刪除，電池快車審核深深能夠工藝，他不傳。', 1, 1, '2021-08-01 17:59:26', NULL, '警察召開色彩能否配合尋找一陣羅東帳號化學接口試試，該公司，可惜批發能力幾個歌手還能樂隊眼睛，更好在。', 0, 0),
(2, '旅客B', 1234, '02-22244333', 'bb@gmail.com', 'user2.jpg', '消除獲得一大點點精品固定參與用於排行強烈，移動智能看看不住包含讓你，房子內地觀察過去經常每一個諾基亞世界閲讀，雙方某個碩士也要一時機票指揮。', 1, 1, '2021-08-02 17:59:26', '2021-08-17 13:18:27', '', 0, 0),
(3, '旅客C', 1234, '02-22255544', 'cc@gmail.com', 'user3.jpg', '鮮花第一個一塊當時我把照顧房子排名，調節共同放心標題承擔認為給你，到來將在，負責引導我會大多數交換擔心無門，其實嘿嘿回。', 1, 1, '2021-08-03 17:59:26', '2021-08-17 13:18:27', '警察召開色彩能否配合尋找一陣羅東帳號化學接口試試，該公司，可惜批發能力幾個歌手還能樂隊眼睛，更好在。', 1, 0),
(4, '旅客D', 1234, '02-22223333', 'dd@gmail.com', 'user4.jpg', '能源拍攝宅宅我愛我又正常手術無奈創造簡介，差距技巧周圍左右是我檔案衝突讓我訓練已有，期限畫面，改善台北江湖出台學習，優質天下錯誤，完全門派我要一片對此關係基本。', 1, 1, '2021-08-04 17:59:26', '2021-08-17 13:18:27', '警察召開色彩能否配合尋找一陣羅東帳號化學接口試試，該公司，可惜批發能力幾個歌手還能樂隊眼睛，更好在。', 1, 0),
(5, '旅客E', 1234, '02-22244333', 'ee@gmail.com', 'user5.jpg', '球隊意大利雙手思維等待世界上，很多眾人負責回家不大，教授我要堅決男子壓縮貫徹，召開技術，提醒一切項目現代回憶隊伍上班老師將會幻想對待目的工。', 1, 1, '2021-08-05 17:59:26', NULL, '', 0, 0),
(6, '旅客F', 1234, '02-22255544', 'ff@gmail.com', 'user6.jpg', '提供說法效率一份圖文合適代理語音三年，打擊交流全體是我精選具有動作律師也就是，就是刷新，動作提示訊。', 1, 0, '2021-08-06 17:59:26', NULL, '', 0, 0),
(7, '旅客G', 1234, '123456789', 'gg@gmail.com', 'user7.jpg', '免費版法律因為說話，新聞回憶，到了學會。', 0, 1, '2021-08-07 17:59:26', NULL, '', 0, 0),
(8, '旅客H', 1234, '232323232323', 'hh@gmail.com', 'user8.jpg', '高達說到保密股份聰明更新時間製造刷新分配本地下載，收費相比瘋狂經營許可證電子郵。', 0, 0, '2021-08-08 17:59:26', NULL, '', 0, 0),
(9, '旅客I', 1234, '22', 'ii@gmail.com', 'user9.jpg', '也可當我今後業績放在對外規則暫無主營宣傳對此本人突然，分鐘。', 1, 1, '2021-08-09 12:59:26', '2021-08-09 17:51:54', '', 0, 0),
(10, '旅客J', 1234, '0914556676', 'jj@mail.com', 'user10.jpg', '遵守屬於，元素感受說話，當中體育時間虛擬一級舉辦最多插入警察對不起，建議少年收集特別正確留下，許可爭取，對待我不處理器，上下美國是從遊客有。', 1, 1, '2021-08-09 13:59:26', '2021-08-17 13:18:27', '', 1, 0),
(11, '旅客K', 1234, '0988-555-555', 'kk@gmai.com', '', '出去中港路同學接觸其他的他在丈夫人類失望面議超過，觀察進了頻率讓人，僅僅愛情直播主形勢免費治理解釋信號開始，考試重要留下孩子圖片詳細內容，無限漸漸，關鍵必須看。', 1, 1, '2021-08-09 14:59:26', NULL, '', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `team`
--

CREATE TABLE `team` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `team`
--

INSERT INTO `team` (`id`, `user`, `tel`, `mail`, `img`, `tag`) VALUES
(1, '旅客A', '02-22223333', 'aa@gmail.com', 'user1.jpg', 0),
(2, '旅客B', '02-22244333', 'bb@gmail.com', 'user2.jpg', 7),
(3, '旅客C', '02-22255544', 'cc@gmail.com', 'user3.jpg', 10),
(4, '旅客D', '02-22223333', 'dd@gmail.com', 'user4.jpg', 9),
(5, '旅客E', '02-22244333', 'ee@gmail.com', 'user5.jpg', 5),
(6, '旅客F', '02-22255544', 'ff@gmail.com', 'user6.jpg', 5),
(7, '旅客G', '123456789', 'ggg@gmail.com', 'user7.jpg', 7),
(8, '旅客H', '232323232323', 'er@gmail.com', 'user8.jpg', 8),
(9, '旅客I', '123456789', 'gjao@rg.com', 'user9.jpg', 9),
(10, '旅客J', '0914556676', 'hh@mail.com', 'user10.jpg', 10),
(11, '旅客K', '0988-555-555', 'aa@gmai.com', 'user11.jpg', 8);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `team`
--
ALTER TABLE `team`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
