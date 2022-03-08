<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=skillscompetition_th16d17_national;charset=utf8", "skcomp_th16d17", "skcomp_th16d17");

$sql = "
      TRUNCATE TABLE th16_msg;
      TRUNCATE TABLE th16_setting;
      TRUNCATE TABLE th16_odr;
      TRUNCATE TABLE th16_room;

      INSERT INTO `th16_msg` (`id`, `who`, `tel`, `mail`, `addr`, `says`, `dpy`) VALUES
        (1, '旅客A', '02-22223333', 'aa@gmail.com', '桃園市觀音區新廣路20號', '一流大部分政策物流西部高效一對評論攝影通過第二，釣魚本論壇雖然，豐原進步有所，幻想如同配置管理員演員方法獎勵市場價，附件刪除，電池快車審核深深能夠工藝，他不傳。', 1),
        (2, '旅客B', '02-22244333', 'bb@gmail.com', '花蓮縣玉里鎮自由街12號', '消除獲得一大點點精品固定參與用於排行強烈，移動智能看看不住包含讓你，房子內地觀察過去經常每一個諾基亞世界閲讀，雙方某個碩士也要一時機票指揮。', 0),
        (3, '旅客C', '02-22255544', 'cc@gmail.com', '苗栗縣通霄鎮內湖5號', '鮮花第一個一塊當時我把照顧房子排名，調節共同放心標題承擔認為給你，到來將在，負責引導我會大多數交換擔心無門，其實嘿嘿回。', 0),
        (4, '旅客D', '02-22223333', 'dd@gmail.com', '屏東縣新園鄉龍洲路16號', '能源拍攝宅宅我愛我又正常手術無奈創造簡介，差距技巧周圍左右是我檔案衝突讓我訓練已有，期限畫面，改善台北江湖出台學習，優質天下錯誤，完全門派我要一片對此關係基本。', 2),
        (5, '旅客E', '02-22244333', 'ee@gmail.com', '臺南市南區清水路9號', '出去中港路同學接觸其他的他在丈夫人類失望面議超過，觀察進了頻率讓人，僅僅愛情直播主形勢免費治理解釋信號開始，考試重要留下孩子圖片詳細內容。\r\n---\r\n謝謝回應', 1);
      
      INSERT INTO `th16_setting` (`id`, `pse`) VALUES (1, 40);

      TRUNCATE TABLE th16_odr;
      INSERT INTO `th16_odr` (`id`, `who`, `tel`, `addr`, `says`, `roomtype`, `num`, `checkin`, `checkout`, `keynum`, `price`) VALUES
        (1, '錢宜珊', '0950256470', '高雄市苓雅區仁愛三街30號', '國旅卷20000', 'A', 10, NOW() + INTERVAL 1 DAY, NOW() + INTERVAL 6 DAY, 'a:10:{i:0;s:4:\"A001\";i:1;s:4:\"A002\";i:2;s:4:\"A003\";i:3;s:4:\"A004\";i:4;s:4:\"A005\";i:5;s:4:\"A006\";i:6;s:4:\"A007\";i:7;s:4:\"A008\";i:8;s:4:\"A009\";i:9;s:4:\"A010\";}', 50000),
        (2, '李威德', '0959932667', '新竹縣竹北市縣政十街16號', '不需早餐', 'B', 7, NOW() + INTERVAL 8 DAY, NOW() + INTERVAL 13 DAY, 'a:7:{i:0;s:4:\"B001\";i:1;s:4:\"B002\";i:2;s:4:\"B003\";i:3;s:4:\"B004\";i:4;s:4:\"B005\";i:5;s:4:\"B006\";i:6;s:4:\"B007\";}', 70000),
        (3, '徐育德', '0998415275', '臺南市東山區和平街8號', '', 'C', 8, NOW() + INTERVAL 14 DAY, NOW() + INTERVAL 17 DAY, 'a:8:{i:0;s:4:\"C001\";i:1;s:4:\"C002\";i:2;s:4:\"C003\";i:3;s:4:\"C004\";i:4;s:4:\"C005\";i:5;s:4:\"C006\";i:6;s:4:\"C007\";i:7;s:4:\"C008\";}', 72000),
        (4, '林致梅', '0980319149', '桃園市龍潭區龍源路24號', '接駁車2大2小', 'D', 3, NOW() + INTERVAL 7 DAY, NOW() + INTERVAL 10 DAY, 'a:3:{i:0;s:4:\"D001\";i:1;s:4:\"D002\";i:2;s:4:\"D003\";}', 36000),
        (5, '程淑芬', '0906372655', '雲林縣虎尾鎮新生路35號', '', 'A', 7, NOW() + INTERVAL 8 DAY, NOW() + INTERVAL 11 DAY, 'a:7:{i:0;s:4:\"A001\";i:1;s:4:\"A002\";i:2;s:4:\"A003\";i:3;s:4:\"A004\";i:4;s:4:\"A005\";i:5;s:4:\"A006\";i:6;s:4:\"A007\";}', 21000);
      
      INSERT INTO `th16_room` (`id`, `roomtype`, `roomdate`, `sellout`, `remain`, `roomprice`) VALUES
        (1, 'A', NOW() + INTERVAL 1 DAY, 'a:10:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";}', 0, 1000),
        (2, 'A', NOW() + INTERVAL 2 DAY, 'a:10:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";}', 0, 1000),
        (3, 'A', NOW() + INTERVAL 3 DAY, 'a:10:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";}', 0, 1000),
        (4, 'A', NOW() + INTERVAL 4 DAY, 'a:10:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";}', 0, 1000),
        (5, 'A', NOW() + INTERVAL 5 DAY, 'a:10:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";i:9;s:1:\"1\";}', 0, 1000),
        (6, 'A', NOW() + INTERVAL 8 DAY, 'a:7:{i:0;s:1:\"5\";i:1;s:1:\"5\";i:2;s:1:\"5\";i:3;s:1:\"5\";i:4;s:1:\"5\";i:5;s:1:\"5\";i:6;s:1:\"5\";}', 3, 1000),
        (7, 'A', NOW() + INTERVAL 9 DAY, 'a:7:{i:0;s:1:\"5\";i:1;s:1:\"5\";i:2;s:1:\"5\";i:3;s:1:\"5\";i:4;s:1:\"5\";i:5;s:1:\"5\";i:6;s:1:\"5\";}', 3, 1000),
        (8, 'A', NOW() + INTERVAL 10 DAY, 'a:7:{i:0;s:1:\"5\";i:1;s:1:\"5\";i:2;s:1:\"5\";i:3;s:1:\"5\";i:4;s:1:\"5\";i:5;s:1:\"5\";i:6;s:1:\"5\";}', 3, 1000),
        (9, 'B', NOW() + INTERVAL 8 DAY, 'a:7:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";}', 3, 2000),
        (10, 'B', NOW() + INTERVAL 9 DAY, 'a:7:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";}', 3, 2000),
        (11, 'B', NOW() + INTERVAL 10 DAY, 'a:7:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";}', 3, 2000),
        (12, 'B', NOW() + INTERVAL 11 DAY, 'a:7:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";}', 3, 2000),
        (13, 'B', NOW() + INTERVAL 12 DAY, 'a:7:{i:0;s:1:\"2\";i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";}', 3, 2000),
        (14, 'C', NOW() + INTERVAL 14 DAY, 'a:8:{i:0;s:1:\"3\";i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";}', 2, 3000),
        (15, 'C', NOW() + INTERVAL 15 DAY, 'a:8:{i:0;s:1:\"3\";i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";}', 2, 3000),
        (16, 'C', NOW() + INTERVAL 16 DAY, 'a:8:{i:0;s:1:\"3\";i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";}', 2, 3000),
        (17, 'D', NOW() + INTERVAL 7 DAY, 'a:3:{i:0;s:1:\"4\";i:1;s:1:\"4\";i:2;s:1:\"4\";}', 7, 4000),
        (18, 'D', NOW() + INTERVAL 8 DAY, 'a:3:{i:0;s:1:\"4\";i:1;s:1:\"4\";i:2;s:1:\"4\";}', 7, 4000),
        (19, 'D', NOW() + INTERVAL 9 DAY, 'a:3:{i:0;s:1:\"4\";i:1;s:1:\"4\";i:2;s:1:\"4\";}', 7, 4000);
    ";

$result = $db->query($sql);
if ($result) echo "success";
