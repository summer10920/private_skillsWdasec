<?php
// $odr=unserialize($_SESSION['odr']);

$row = $db->query("SELECT * FROM th16_odr WHERE id=" . $_SESSION['odrid'])->fetch();
$pse = $db->query("SELECT * FROM th16_setting WHERE 1")->fetch();
?>
<div class="col-12 text-center">訂房成功，您的訂單資訊如下</div>
<div class="col-6 offset-3">
  <ul class="list-group my-3">
    <li class="list-group-item"><b>訂房編號：</b><?= str_pad($row['id'], 6, '0', STR_PAD_LEFT) ?></li>
    <li class="list-group-item"><b>訂房日期：</b><?= $row['checkin'] ?> ~ <?= $row['checkout'] ?></li>
    <li class="list-group-item"><b>房號：</b>
<?php
    foreach (unserialize($row['keynum']) as $value) echo '
      <span class="badge badge-dark">' . $value . '</span>
  ';
?>
    </li>
    <li class="list-group-item"><b>訂房總金額：</b>$<?= $row['price'] ?></li>
    <li class="list-group-item"><b>需繳交訂金：</b>$<?= $row['price']*$pse['pse']/100 ?> (<?=$pse['pse']?>%)</li>
  </ul>
</div>