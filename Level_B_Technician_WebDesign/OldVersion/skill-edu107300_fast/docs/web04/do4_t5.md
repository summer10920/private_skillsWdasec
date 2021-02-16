# 網乙術科題庫分析 - 精品電子商務
(108年度技術士技能檢定-考速版)

!> 事實上這裡分為兩個主題被歸類在同一題目，分別是分類管理與商品管理。所以除了原本指定好的路徑建立th.php，再另外建立為tp.php，兩者之間再建立連結做為切換。

## A. 分類管理之版型

1. 規劃切換選單於h3內並放在起頭
2. 參考main.php取得多重迴圈，主要邏輯在搜尋大類，分類之內容。
3. 設計兩個獨立form表單分開進行大類新增與中類新增
4. 修改另外到admin\_mdyth做修改再到api.php
5. 刪除直接到api.php處理

### 新增th.php\(參考main.php\)
```php
<h3>商品分類 | <a href="?redo=tp">商品管理</a></h3>
<form action="api.php?do=clsadd" method="post">
  <p>新增大類
    <input type="text" name="text" id="">
    <input type="hidden" name="parent" value=0>
    <input type="submit" value="新增">
  </p>
</form>
<form action="api.php?do=clsadd" method="post">
  <p>新增中類
    <select name="parent" id="">
      <?php
      $re = select("q4t4_class", "parent=0");
      foreach ($re as $ro) echo '<option value="' . $ro['id'] . '">' . $ro['text'] . '</option>';
      ?>
    </select>
    <input type="text" name="text" id="">
    <input type="submit" value="新增">
  </p>
</form>
<table>
  <?php
  foreach ($re as $ro) {
    ?>
    <tr bgcolor=#ffc>
      <td><?= $ro['text'] ?></td>
      <td>
        <input type="button" value="修改" onclick="<?= jlo('?redo=thmdy&id=' . $ro['id']) ?>">
        <input type="button" value="刪除" onclick="<?= jlo('api.php?do=thdel&id=' . $ro['id']) ?>">
      </td>
    </tr>
    <?php
    $re2 = select("t4_class", "parent=" . $ro['id']);
    foreach ($re2 as $ro2) {
      ?>
      <tr bgcolor=#ffe>
        <td><?= $ro2['text'] ?></td>
        <td>
          <input type="button" value="修改" onclick="<?= jlo('?redo=thmdy&id=' . $ro2['id']) ?>">
          <input type="button" value="刪除" onclick="<?= jlo('api.php?do=thdel&id=' . $ro2['id']) ?>">
        </td>
      </tr>
    <?php
  }
}
?>
</table>
```

## B. 分類管理之新增

### 增添api.php
```php
  case 'clsadd':
    insert($_POST, "q4t4_class");
    plo("admin.php?redo=th");
    break;
```

## C. 分類管理之修改
修改使用function update，因故要塞入id到陣列之key內，新增admin\_mdyth.php，寫下

### 新增thmdy.php
```php
<form action="api.php?do=thmdy" method="post">
名稱: <input type="text" name="text[<?=$_GET['id']?>]" id=""><br>
<input type="submit" value="修改">
</form>
```

### 增添api.php
```php
case 'thmdy':
  update($_POST, "q4t4_class");
  plo("admin.php?redo=th");
  break;
```

## D. 分類管理之刪除
直接連結到api作處理動作，記得規劃成function del之可接受格式。

### 增添api.php
```php
case 'thdel':
  $post['del'][] = $_GET['id'];
  delete($post, "q4t4_class");
  plo("admin.php?redo=th");
  break;
```

## E. 商品管理之版型
1. 重點同樣在列表新增修改刪除。列表與修改部分較複雜些
2. 新增導向另一個URL參數do=admin&redo=tpadd
3. 修改導向另一個URL參數do=admin&redo=tpmdy
4. 刪除與上下架導向到api直接處理

### 新增tp.php\(參考th.php\)
```php
<h3><a href="?redo=th">商品分類</a> | 商品管理</h3>
<input type="button" value="新增商品" onclick="<?= jlo('?redo=tpadd') ?>">
<table>
  <tr>
    <td>編號</td>
    <td>商品名稱</td>
    <td>庫存量</td>
    <td>狀況</td>
    <td>操作</td>
  </tr>
  <?php
  $re = select("t5_product", 1);
  foreach ($re as $ro) {
    ?>
    <tr bgcolor=#ffc>
      <td><?= $ro['id'] ?></td>
      <td><?= $ro['title'] ?></td>
      <td><?= $ro['num'] ?></td>
      <td><?= ($ro['dpy']) ? "販售中" : "已下架"; ?></td>
      <td>
        <input type="button" value="修改" onclick="<?= jlo('?redo=tpmdy&id=' . $ro['id']) ?>">
        <input type="button" value="刪除" onclick="<?= jlo('api.php?do=tpdel&id=' . $ro['id']) ?>">
        <input type="button" value="上架" onclick="<?= jlo('api.php?do=tpon&id=' . $ro['id']) ?>">
        <input type="button" value="下架" onclick="<?= jlo('api.php?do=tpoff&id=' . $ro['id']) ?>">
      </td>
    </tr>
  <?php
}
?>
</table>
```

## F. 商品管理之新增
1. 複雜的地方在於下拉選單的關聯切換，需要透過JQ去完成替換
2. 由JQ去判別大類之值為何，送ajax取得新的HTML打印輸出
3. 重置與返回題目沒有示意圖有，可以不做不會被扣分

### 新增tpadd.php
```php
<h3 class="ct">新增商品</h3>
<form action="api.php?do=tpadd" method="post" enctype="multipart/form-data">
  所屬大類:
  <select name="fa" id="" onchange="getson()">
    <option value="">請選擇</option>
    <?php
    $re = select("q4t4_class", "parent=0");
    foreach ($re as $ro) echo '<option value="' . $ro['id'] . '">' . $ro['text'] . '</option>';
    ?>
  </select><br>
  所屬中類:
  <select name="son" id="">
  </select><br>
  商品編號: 系統自動生成<br>
  商品名稱: <input type="text" name="title" id=""><br>
  商品價格: <input type="text" name="price" id=""><br>
  規格: <input type="text" name="spec" id=""><br>
  庫存量: <input type="text" name="num" id=""><br>
  商品圖片: <input type="file" name="img" id=""><br>
  商品介紹: <textarea name="text" id="" cols="30" rows="10"></textarea>
  <input type="submit" value="新增">
</form>
```

此時要利用JQ去處理AJAX

```php
<script>
  function getson() {
    id = $("select[name=fa]").val();
    $.post("api.php?do=getson", {
      id
    }, function(re) {
      $("select[name=son]").html(re);
    });
  }
</script>
```

記得head標籤要宣告JQ位置

```php
<script src="scripts/jquery-1.9.1.min.js"></script>
```

### 增添api.php

```php
  case 'getson':
    $re = select("q4t4_class", "parent=" . $_POST['id']);
    foreach ($re as $ro) echo '<option value="' . $ro['id'] . '">' . $ro['text'] . '</option>';
    break;
```

此時可以正常帶子選單了，最後設計提交到api的行為處理

```php
  case 'tpadd':
    $_POST['img'] = addfile($_FILES['img']);
    insert($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
```

## G. 商品管理之單一修改
1. 版型與新增差不多，同樣複雜在預設值，考慮考試速度這裡都不特地設計帶入
2. 重置跟返回功能題目沒有示意圖有，可以考慮不用寫。
3. 更新的做法，必須每個欄位採用array並多夾帶ID。才能在function update運作

### 新增tpmdy.php\(參考tpmdy.php\)
```php
<h3 class="ct">修改商品</h3>
<form action="api.php?do=tpmdy&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
  所屬大類:
  <select id=fa name="fa[<?= $_GET['id'] ?>]" id="" onchange="getson()">
    <option value="">請選擇</option>
    <?php
    $re = select("t4_class", "parent=0");
    foreach ($re as $ro) echo '<option value="' . $ro['id'] . '">' . $ro['text'] . '</option>';
    ?>
  </select><br>
  所屬中類:
  <select id=son name="son[<?= $_GET['id'] ?>]" id="">
  </select><br>
  商品編號: <?= $_GET['id'] ?><br>
  商品名稱: <input type="text" name="title[<?= $_GET['id'] ?>]" id=""><br>
  商品價格: <input type="text" name="price[<?= $_GET['id'] ?>]" id=""><br>
  規格: <input type="text" name="spec[<?= $_GET['id'] ?>]" id=""><br>
  庫存量: <input type="text" name="num[<?= $_GET['id'] ?>]" id=""><br>
  商品圖片: <input type="file" name="img" id=""><br>
  商品介紹: <textarea name="text[<?= $_GET['id'] ?>]" id="" cols="30" rows="10"></textarea>
  <input type="submit" value="修改">
</form>
<script>
  function getson() {
    id = $("#fa").val();
    $.post("api.php?do=getson", {
      id
    }, function(re) {
      $("#son").html(re);
    });
  }
</script>
```

### 增添api.php
修改有可能沒有圖片，所以要多下個判斷。以及額外取的ID做update能讀取的格式整理

```php
  case 'tpmdy':
    $_POST['img'][$_GET['id']] = addfile($_FILES['img']);
    print_r($_POST);
    update($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
```

## H. 商品管理之刪除、上下架
直接在api.php處理，注意需額外整理delete與update的display，為function所能接受格式。

### 增添api.php
```php
  case 'tpon':
    $_POST['dpy'][$_GET['id']] = 1;
    update($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'tpoff':
    $_POST['dpy'][$_GET['id']] = 0;
    update($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'tpdel':
    $post['del'][] = $_GET['id'];
    delete($post, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
```