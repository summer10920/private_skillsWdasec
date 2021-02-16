<?php
$cart=unserialize($_SESSION['cart']);
$who=unserialize($_SESSION['msg']);
?>
<div class="col-12 text-center">請確認訂房資訊</div>
<div class="col-6 offset-3">
  <ul class="list-group my-3">
    <li class="list-group-item"><b>訂房日期：</b><?=$cart['checkin']?> ~ <?=$cart['checkout']?></li>
    <li class="list-group-item"><b>房型：</b><?=$roomname[$cart['room']]?></li>
    <li class="list-group-item"><b>房間數：</b><?=$cart['room_num']?></li>
    <li class="list-group-item"><b>姓名：</b><?=$who['who']?></li>
    <li class="list-group-item"><b>電話：</b><?=$who['tel']?></li>
    <li class="list-group-item"><b>地址：</b><?=$who['addr']?></li>
    <li class="list-group-item"><b>備註：</b><?=$who['says']?></li>
  </ul>
</div>

<div class="text-center col-12">
  <a href="?do=book&step=1" class="btn btn-secondary text-white">上一步</a>
  <button type="submit" class="btn btn-primary">確認訂房</button>
</div>