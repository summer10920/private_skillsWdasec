<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=skillsCompetition_th50j17_National;charset=utf8", "skcomp_th50j17", "skcomp_th50j17");

$sql = "
      TRUNCATE TABLE pk;
      TRUNCATE TABLE talk;

      INSERT INTO `pk` (`id`, `user`, `msg`, `mail`, `tel`, `date`, `del`) VALUES
        (1, '錢宜珊', 'user.jpg', 'aa@gmail.com', '0950256470', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
        (2, '李威德', 'user.jpg', 'bb@gmail.com', '0959932667', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1),
        (3, '徐育德', 'user.jpg', 'cc@gmail.com', '0998415275', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
        (4, '林致梅', 'user.jpg', 'dd@gmail.com', '0980319149', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1),
        (5, '程淑芬', 'user.jpg', 'ee@gmail.com', '0906372655', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
        (6, '李柏揚', 'user.jpg', 'ff@gmail.com', '0973250425', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
        (7, '張柏雄', 'user.jpg', 'gg@gmail.com', '0992370171', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0);

      INSERT INTO `talk` (`id`, `user`, `msg`, `mail`, `tel`, `date`, `del`) VALUES
        (1, '錢宜珊', '一流大部分政策物流西部高效一對評論攝影通過第二，釣魚本論壇雖然，豐原進步有所，幻想如同配置管理員演員方法獎勵市場價，附件刪除，電池快車審核深深能夠工藝，他不傳。', 'aa@gmail.com', '0950256470', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
        (2, '李威德', '消除獲得一大點點精品固定參與用於排行強烈，移動智能看看不住包含讓你，房子內地觀察過去經常每一個諾基亞世界閲讀，雙方某個碩士也要一時機票指揮。', 'bb@gmail.com', '0959932667', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1),
        (3, '徐育德', '鮮花第一個一塊當時我把照顧房子排名，調節共同放心標題承擔認為給你，到來將在，負責引導我會大多數交換擔心無門，其實嘿嘿回。', 'cc@gmail.com', '0998415275', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 0),
        (4, '林致梅', '能源拍攝宅宅我愛我又正常手術無奈創造簡介，差距技巧周圍左右是我檔案衝突讓我訓練已有，期限畫面，改善台北江湖出台學習，優質天下錯誤，完全門派我要一片對此關係基本。', 'dd@gmail.com', '0980319149', NOW()- INTERVAL FLOOR(RAND() * 14 * 86400) SECOND, 1);
    ";

$result = $db->query($sql);
if ($result) echo "success";
