<?php
$sql = "SELECT * FROM th16_msg WHERE dpy!=2 order by id desc";
$rows = $db->query($sql)->fetchAll();
foreach ($rows as $row) {
  ?>
  <div class="card bg-light container">
    <div class="card-header row">
      <div class="col">
        訪客：<?= $row['who'] ?><br>
        電話：<?= $row['tel'] ?>
      </div>
      <div class="col-6">
        信箱：<?= $row['mail'] ?><br>
        地址：<?= $row['addr'] ?>
      </div>
      <div>
        <!-- Button trigger modal -->
        <button class="btn btn-info" data-toggle="modal" data-target="#msg<?= $row['id'] ?>">修改</button>
        <a class="btn btn-danger" href="api.php?do=msgdel&id=<?= $row['id'] ?>">刪除</a>
      </div>
    </div>
    <div class="card-body">
      <p><?= $row['says'] ?></p>
      <?= $row['dpy'] ? '<footer class="blockquote-footer"><span class="text-danger">管理員</span>對此留言已修改</footer>' : '' ?>
    </div>
  </div>
  <!-- Modal -->
  <form class="modal fade" id="msg<?= $row['id'] ?>" action="api.php?do=msgmdy&id=<?= $row['id'] ?>" method="post">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header h3">修改留言</div>
        <div class="modal-body">
          <div class="form-group col">
            姓名：<input type="text" class="form-control" required name="who" value="<?= $row['who'] ?>">
          </div>
          <div class="form-group col">
            電話：<input type="text" class="form-control" required pattern="[0-9\-]{9,12}" name="tel" value="<?= $row['tel'] ?>">
          </div>
          <div class="form-group col">
            地址：<input type="text" class="form-control" required name="addr" value="<?= $row['addr'] ?>">
          </div>
          <div class="form-group col-12">
            內容：<textarea class="form-control" required name="says" rows="10"><?= $row['says'] ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-info">修改確定</button>
        </div>
      </div>
    </div>
  </form>
<?php
}
?>