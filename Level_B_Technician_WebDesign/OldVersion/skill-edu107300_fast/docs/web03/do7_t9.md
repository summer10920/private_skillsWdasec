# 網乙術科題庫分析 - ABC影城
(108年度技術士技能檢定-考速版)

!> 先試著在前台新增多筆訂單，接著在進行後台設計。主要重點在於刪除功能，分為單筆刪除與批次刪除。難度不高，只需記得單筆刪除直接使用onclick帶GET網址到api處理即可。至於批次刪除利用form表單搭配input typey到api處理。處理批次只需對where描述正確即可。

## A. 清單檢視版型
這題不適合參考任何前面的版型，重新畫一個table會比較快。

### 新增orderlist.php
```php
<table width="100%">
  <tr>
    <td>訂單編號</td>
    <td>電影名稱</td>
    <td>觀看日期</td>
    <td>場次時間</td>
    <td>訂購數量</td>
    <td>訂購位置</td>
    <td>操作</td>
  </tr>
  <?php
  $re = select("q3t8_book", "1 order by id desc");
  foreach ($re as $ro) {
    $seq = date("Ymd0000", strtotime($ro['buydate'])) + $ro['id'];
    $ss = unserialize($ro['seat']);
    ?>
    <tr>
      <td><?= $seq ?></td>
      <td><?= $ro['movie'] ?></td>
      <td><?= $ro['date'] ?></td>
      <td><?= $seat[$ro['time']] ?></td>
      <td><?= count($ss) ?></td>
      <td><?php foreach ($ss as $value) echo $value . '號<br>'; ?></td>
      <td><input type="button" value="刪除" onclick="<?= jlo("api.php?do=orderdel&id=" . $ro['id']) ?>"></td>
    </tr>
  <?php
  }
  ?>
</table>
```

## B. 單獨刪除功能
取得訂單ID，針對訂單刪除

### 增添api.php
```php
case 'orderdel':
  $_POST['del'][] = $_GET['id'];
  delete($_POST, "q3t8_book");
  plo("admin.php?do=orderlist");
  break;
```

## C. 快速刪除之版型
題目要求需要快速刪除前有提示，所以from多個onsubmit的JS動作。radio咬個required比較不會被亂搞。

### 修改orderlisit.php

```php
<h3 class="ct">訂單清單</h3>
<hr>
<form action="api.php?do=orderfast" method="post" onsubmit="return confirm('幹你確定嗎?')">
  <input type="radio" name="sw" value="1" required>依日期 <input type="date" name="date">
  <input type="radio" name="sw" value="2">電影名稱
  <select name="movie">
    <?php
    $re = select("q3t7_movie", 1);
    foreach ($re as $ro) echo '<option value="' . $ro['title'] . '">' . $ro['title'] . '</option>';
    ?>
  </select>
  <input type="submit" value="快速刪除">
</form>
<hr>
```

### 增添api.php
判斷何種刪除法，做對應刪除之條件

```php
case 'orderfast':
  switch ($_POST["sw"]) {
    case 1:
      $post['delat'] = "date='" . $_POST['date'] . "'";
      break;
    case 2:
      $post['delat'] = "movie='" . $_POST['movie'] . "'";
      break;
  }
  delete($post, "q3t8_book");
  plo("admin.php?do=orderlist");
  break;
```