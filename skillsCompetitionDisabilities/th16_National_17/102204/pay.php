<h3 class="ct">確認資料</h3>
<?php
$re = select("q4t9_user", "id=" . $_SESSION['id']);
$x = $re[0];
?>
姓名: <?= $x['name'] ?><br>
帳號: <?= $x['acc'] ?><br>
電話: <?= $x['tel'] ?><br>
地址: <?= $x['addr'] ?><br>
電子信箱: <?= $x['mail'] ?>
<hr>
<table>
  <tr>
    <td>編號</td>
    <td>商品名稱</td>
    <td>數量</td>
    <td>庫存量</td>
    <td>單價</td>
    <td>小計</td>
  </tr>
  <?php
  $total = 0;
  if (!empty($_SESSION['buy'])) foreach ($_SESSION['buy'] as $id => $num) {
    $re = select("q4t5_product", "id=" . $id);
    $x = $re[0];
    ?>
    <tr bgcolor=#ffc>
      <td><?= $id ?></td>
      <td><?= $x['title'] ?></td>
      <td><?= $num ?></td>
      <td><?= $x['num'] ?></td>
      <td><?= $x['price'] ?></td>
      <td><?= $x['price'] * $num ?></td>
    </tr>
  <?php
    $total += $x['price'] * $num;
  }
  ?>
</table>
<hr>
<input type="button" value="確定送出" onclick="<?= jlo('api.php?do=pay&total=' . $total) ?>">
<input type="button" value="返回修改訂單" onclick="window.history.back()">
