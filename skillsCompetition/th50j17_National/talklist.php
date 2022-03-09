<?php
if ($_SESSION['who'] == "guest" || $_SESSION['who'] == "admin") $where = "1";
else $where = "mail='" . $_SESSION['whomail'] . "' AND user='" . $_SESSION['who'] . "'";

echo $sql = "SELECT * FROM talk WHERE " . $where;
$rows = $db->query($sql)->fetchAll();
foreach ($rows as $row) {
  if ($row['del']) {
?>
    <div class="thumbnail row-fluid del">
      <div class="span2">#<?= $row['id'] ?></div>
      <div class="span10">本篇已被刪除</div>
    </div>
  <?php
  } else {
  ?>
    <div class="thumbnail row-fluid">
      <div class="caption span2">
        <img src="img/user.jpg" class="img-circle" width="100" height="100">
        <h4><?= $row['user'] ?></h4>
        <h5>#<span id="sn"><?= $row['id'] ?></span></h5>
      </div>
      <div class="caption span10">
        <p><?= $row['msg'] ?></p>
        <div class="bottom">
          <span class="badge badge-info">
            <span>&phone;</span>
            <span class="tel"><?= $row['tel'] ?></span>
          </span>
          <span class="badge badge-info">
            <i class="icon-envelope icon-white"></i>
            <span class="mail"><?= $row['mail'] ?></span>
          </span>
          <span class="badge badge-info">
            <i class="icon-time icon-white"></i>
            <span><?= $row['date'] ?></span>
          </span>
          <!-- for admin -->
          <?php
          if ($backsite) {
          ?>
            <span class="control">
              <a href="#talkmdy" class="btn btn-warning" data-toggle="modal" onclick="setval(this)">編輯</a>
              <a href="api.php?do=talkdel&id=<?= $row['id'] ?>" class="btn btn-danger">刪除</a>
            </span>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
<?php
  }
}
?>
<script>
  function setval(e) {
    let bigroot = $(e).parents(".row-fluid");
    let name = bigroot.find("h4").text();
    let msg = bigroot.find("p").text();
    let mail = bigroot.find(".mail").text();
    let tel = bigroot.find(".tel").text();
    let id = bigroot.find(".sn").text();

    // console.log(name, msg, mail, tel);

    $("#talkmdy").find("input[name=user]").val(name);
    $("#talkmdy").find("textarea[name=msg]").text(msg);
    $("#talkmdy").find("input[name=mail]").val(mail);
    $("#talkmdy").find("input[name=tel]").val(tel);
    $("#talkmdy").find("input[name=id]").val(id);
  }
</script>