<div class="card bg-light">
  <form action="api.php?do=msgadd" method="post">
    <div class="card-header">新增留言</div>
    <div class="card-body row">
      <div class="form-group col-4">
        <p>
          姓名：
          <input type="text" class="form-control" required name="who">
        </p>
        <p>
          電話：
          <input type="text" class="form-control" required pattern="[0-9\-]{9,12}" name="tel">
        </p>
      </div>
      <div class="form-group offset-2 col-6">
        <p>
          信箱：
          <input type="email" class="form-control" required name="mail">
        </p>
        <p>
          地址：
          <input type="text" class="form-control" required name="addr">
        </p>
      </div>
      <div class="form-group col-12">
        內容：
        <textarea class="form-control" required name="says"></textarea>
      </div>
      <div class="text-center col-12">
        <button type="submit" class="btn btn-primary">新增留言</button>
      </div>
    </div>
  </form>
</div>
<hr class="my-5"/>
<?php
$sql = "SELECT * FROM th16_msg WHERE 1 order by id desc";
$rows = $db->query($sql)->fetchAll();
foreach ($rows as $row) {

  switch ($row['dpy']) {
    case 2: //delete mode
?>
      <div class="card container alert-secondary">
        <div class="card-header row">本篇已不存在</div>
        <div class="card-body">
          <?= $row['dpy'] ? '<footer class="blockquote-footer"><span class="text-danger">管理員</span>對此留言已刪除</footer>' : '' ?>
        </div>
      </div>
    <?php
      break;
    default:
    ?>
      <div class="card container">
        <div class="card-header row">
          <div class="col">
            訪客：<?= $row['who'] ?><br>
            電話：<?= $row['tel'] ?>
          </div>
          <div class="col-6">
            信箱：<?= $row['mail'] ?><br>
            地址：<?= $row['addr'] ?>
          </div>
        </div>
        <div class="card-body">
          <p><?= nl2br($row['says']) ?></p>
          <?= $row['dpy'] ? '<footer class="blockquote-footer"><span class="text-danger">管理員</span>對此留言已修改</footer>' : '' ?>
        </div>
      </div>
<?php
      break;
  }
}

?>