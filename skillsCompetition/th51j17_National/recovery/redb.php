<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=skillsCompetition_th51j17_National;charset=utf8", "skcomp_th51j17", "skcomp_th51j17");

$sql = "
      TRUNCATE TABLE msg;
      TRUNCATE TABLE team;

      INSERT INTO `msg` (`id`, `user`, `pwd`, `tel`, `mail`, `img`, `info`, `showtel`, `showmail`, `cdate`, `mdate`, `reply`, `del`, `tag`) VALUES
        (1, '旅客A', 1234, '02-22223333', 'aa@gmail.com', 'user1.jpg', '一流大部分政策物流西部高效一對評論攝影通過第二，釣魚本論壇雖然，豐原進步有所，幻想如同配置管理員演員方法獎勵市場價，附件刪除，電池快車審核深深能夠工藝，他不傳。', 1, 1, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, NULL, '警察召開色彩能否配合尋找一陣羅東帳號化學接口試試，該公司，可惜批發能力幾個歌手還能樂隊眼睛，更好在。', 0, 0),
        (2, '旅客B', 1234, '02-22244333', 'bb@gmail.com', 'user2.jpg', '消除獲得一大點點精品固定參與用於排行強烈，移動智能看看不住包含讓你，房子內地觀察過去經常每一個諾基亞世界閲讀，雙方某個碩士也要一時機票指揮。', 1, 0, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, '', 0, 0),
        (3, '旅客C', 1234, '02-22255544', 'cc@gmail.com', 'user3.jpg', '鮮花第一個一塊當時我把照顧房子排名，調節共同放心標題承擔認為給你，到來將在，負責引導我會大多數交換擔心無門，其實嘿嘿回。', 0, 1, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, '警察召開色彩能否配合尋找一陣羅東帳號化學接口試試，該公司，可惜批發能力幾個歌手還能樂隊眼睛，更好在。', 1, 0),
        (4, '旅客D', 1234, '02-22223333', 'dd@gmail.com', 'user4.jpg', '能源拍攝宅宅我愛我又正常手術無奈創造簡介，差距技巧周圍左右是我檔案衝突讓我訓練已有，期限畫面，改善台北江湖出台學習，優質天下錯誤，完全門派我要一片對此關係基本。', 0, 0, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, '警察召開色彩能否配合尋找一陣羅東帳號化學接口試試，該公司，可惜批發能力幾個歌手還能樂隊眼睛，更好在。', 0, 0),
        (5, '旅客E', 1234, '02-22244333', 'ee@gmail.com', 'user5.jpg', '球隊意大利雙手思維等待世界上，很多眾人負責回家不大，教授我要堅決男子壓縮貫徹，召開技術，提醒一切項目現代回憶隊伍上班老師將會幻想對待目的工。', 1, 1, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, NULL, '', 0, 1),
        (6, '旅客F', 1234, '02-22255544', 'ff@gmail.com', 'user6.jpg', '提供說法效率一份圖文合適代理語音三年，打擊交流全體是我精選具有動作律師也就是，就是刷新，動作提示訊。', 1, 1, NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, NULL, '', 0, 1);

      INSERT INTO ``team` (`id`, `user`, `tel`, `mail`, `img`, `tag`) VALUES
        (1, '旅客A', '02-22223333', 'aa@gmail.com', 'user1.jpg', 0),
        (2, '旅客B', '02-22244333', 'bb@gmail.com', 'user2.jpg', 0),
        (3, '旅客C', '02-22255544', 'cc@gmail.com', 'user3.jpg', 10),
        (4, '旅客D', '02-22223333', 'dd@gmail.com', 'user4.jpg', 9),
        (5, '旅客E', '02-22244333', 'ee@gmail.com', 'user5.jpg', 6),
        (6, '旅客F', '02-22255544', 'ff@gmail.com', 'user6.jpg', 6),
        (7, '旅客G', '123456789', 'gg@gmail.com', 'user7.jpg', 0),
        (8, '旅客H', '232323232323', 'hh@gmail.com', 'user8.jpg', 0),
        (9, '旅客I', '123456789', 'ii@rg.com', 'user9.jpg', 9),
        (10, '旅客J', '0914556676', 'jj@mail.com', 'user10.jpg', 10),
        (11, '旅客`K', '0988-555-555', 'kk@gmai.com', 'user11.jpg', 0);
    ";

$result = $db->query($sql);
if ($result) echo "success";
