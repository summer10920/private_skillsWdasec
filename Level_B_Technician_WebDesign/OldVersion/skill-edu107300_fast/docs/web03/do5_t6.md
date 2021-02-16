# 網乙術科題庫分析 - ABC影城
(108年度技術士技能檢定-考速版)

!> 做好第七題，你已經擁有一些資料。便可以開始設計前台。

## A. 設計院線片顯示區域
一開始需要設定一個有效時間差異三天\(含當天\)，所以是今天，昨天，前天的上映日期為有效。則就是今天日期減兩天等於前天。設定好此時間差異做之後的判斷

### 增添sql.php
```php
//t6
$minday=date("Y-m-d",strtotime("-2days"));
$today=date("Y-m-d");
```

### 修改main.php
預設給的填寫空間是&lt;tr&gt;&lt;/tr&gt;，在內部建立四組td。透過td指定寬度並設定float:left，能製造出2X2的排版效果。先試著以假資訊模擬出適合的版型

另外記得將四張分級圖片重新命名為普=>1.png,保=>2.png,輔=>3.png,限=>4.png，方便之後比較快使用這些小圖。

```php
<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;">
    <table width="100%">
      <tr>
        <td width=210 style="float:left">
          <img src="upload/03B01.png" style="float:left;width:50px">
          AAA<br>
          分級: <img src="img/1.png" alt=""><br>
          上映日期: 2019-04-21<br>
          <input type="button" value="劇情簡介" onclick="<?= jlo("?do=info&id=x") ?>">
          <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=x") ?>">
        </td>
        <td width=210 style="float:left">
          <img src="upload/03B01.png" style="float:left;width:50px">
          AAA<br>
          分級: <img src="img/1.png" alt=""><br>
          上映日期: 2019-04-21<br>
          <input type="button" value="劇情簡介" onclick="<?= jlo("?do=info&id=x") ?>">
          <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=x") ?>">
        </td>
        <td width=210 style="float:left">
          <img src="upload/03B01.png" style="float:left;width:50px">
          AAA<br>
          分級: <img src="img/1.png" alt=""><br>
          上映日期: 2019-04-21<br>
          <input type="button" value="劇情簡介" onclick="<?= jlo("?do=info&id=x") ?>">
          <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=x") ?>">
        </td>
        <td width=210 style="float:left">
          <img src="upload/03B01.png" style="float:left;width:50px">
          AAA<br>
          分級: <img src="img/1.png" alt=""><br>
          上映日期: 2019-04-21<br>
          <input type="button" value="劇情簡介" onclick="<?= jlo("?do=info&id=x") ?>">
          <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=x") ?>">
        </td>
      </tr>
    </table>
    <div class="ct"> </div>
  </div>
</div>
```

接著在前置作業進行select limit 每次四筆。規劃迴圈並指定好超連結。並注意題目要求上映有效為三天含當日。所以需要特別去計算：期限日&lt;=上映日期，上映日期&lt;=今天。

```php
<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;">
    <table>
      <tr>
        <?php
        $nw = (empty($_GET['page'])) ? 1 : $_GET['page'];
        $ba = ($nw - 1) * 4;
        $re = select("q3t7_movie", "'" . $minday . "'<=date and date<='" . $today . "' order by odr limit " . $ba . ",4");
        foreach ($re as $ro) {
          ?>
          <td width=210 style="float:left">
            <img src="upload/<?= $ro['img'] ?>" style="float:left;width:50px">
            <?= $ro['title'] ?><br>
            分級: <img src="img/<?= $ro['cls'] ?>.png" alt=""><br>
            上映日期: <?= $ro['date'] ?><br>
            <input type="button" value="劇情簡介" onclick="<?= jlo("?do=info&id=" . $ro['id']) ?>">
            <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=" . $ro['id']) ?>">
          </td>
        <?php
      }
      ?>
      </tr>
    </table>
    <div class="ct">
    </div>
  </div>
</div>
```

## B. 規劃分頁導覽
使用函式庫設計的page\_link\(table,sql,range,page\)回傳陣列，並轉為連接網址。找到

### 修改main.php
```php
<div class="ct"> </div>
```

為
```php
<div class="ct">
  <?php
  $pg = page("q3t7_movie", "'" . $minday . "'<=date and date<='" . $today . "' order by odr", 4, $nw);
  foreach ($pg as $key => $value) echo '<a href="?page=' . $value . '">' . $key . '</a>';
  ?>
</div>
```

## C. 劇情簡介版面
素材有提供劇情簡介版面，先前被放在booking.php內而跟booking.php內容無關，找到以下代碼存到info.php內 \(被div\#mm所包覆\)

### 新增info.php（抽取自order.php）
```php
<div style="background:#FFF; width:100%; color:#333; text-align:left">
  <video src="movie/03B20v.avi" width="300px" height="250px" controls="" style="float:right;"></video>
  <font style="font-size:24px"> <img src="Profile page_files/03B20.png" width="200px" height="250px" style="margin:10px; float:left">
    <p style="margin:3px">影片名稱 ：
      <input type="button" value="線上訂票" onclick="lof(&#39;?do=order&amp;id=4&#39;)" style="margin-left:50px; padding:2px 4px" class="b2_btu">
    </p>
    <p style="margin:3px">影片分級 ： <img src="Profile page_files/03C04.png" style="display:inline-block;">限制級 </p>
    <p style="margin:3px">影片片長 ： 時/分</p>
    <p style="margin:3px">上映日期 2014/02/14</p>
    <p style="margin:3px">發行商 ： </p>
    <p style="margin:3px">導演 ： </p>
    <br>
    <br>
    <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
    </p>
  </font>
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td align="center"><input type="button" value="院線片清單" onclick="lof(&#39;?&#39;)"></td>
      </tr>
    </tbody>
  </table>
</div>
```

並加入select，調整為正確的內容顯示。ID為透過GET取得該資訊。按鈕導向到booking.php?do=step1&id=xx．

```php
<?php
$re = select("q3t7_movie", "id=" . $_GET['id']);
$ro = $re[0];
?>
<div style="background:#FFF; width:100%; color:#333; text-align:left">
  <video src="upload/<?= $ro['video'] ?>" width="300px" height="250px" controls="" style="float:right;"></video>
  <font style="font-size:24px"> <img src="upload/<?= $ro['img'] ?>" width="200px" height="250px" style="margin:10px; float:left">
    <p style="margin:3px">影片名稱 ：<?= $ro['title'] ?>
      <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=" . $ro['id']) ?>">
    </p>
    <p style="margin:3px">影片分級 ： <img src="img/<?= $ro['cls'] ?>.png" style="display:inline-block;"></p>
    <p style="margin:3px">影片片長 ： <?= $ro['length'] ?></p>
    <p style="margin:3px">上映日期 <?= $ro['date'] ?></p>
    <p style="margin:3px">發行商 ： <?= $ro['corp'] ?></p>
    <p style="margin:3px">導演 ： <?= $ro['maker'] ?></p>
    <br>
    <br>
    <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br><?= $ro['text'] ?>
    </p>
  </font>
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td align="center"><input type="button" value="院線片清單" onclick="<?= jlo("index.php") ?>"></td>
      </tr>
    </tbody>
  </table>
</div>
```

導向到Order的畫面於第八題時設計，記住要設計會有GET\[id\]能提供給booking做自動選取電影。第八題會有step1,step2,step3等不同的動作。