<?php
if ($frontsite || $_SESSION['user'] == 'admin')
  $sql = "SELECT * FROM msg";
else
  $sql = "SELECT * FROM msg WHERE user='{$_SESSION['user']}' AND mail='{$_SESSION['mail']}'";

$rows = $db->query($sql)->fetchAll();
foreach ($rows as $row) {
  if ($row['del']) { //del
?>
    <div class="thumbnail row-fluid del">
      <div class="span2">
        #<span class="sn"><?= $row['id'] ?></span>
      </div>
      <div class="span10">
        此樓留言已被刪除
      </div>
    </div>
  <?php
  } else { //show
  ?>
    <div class="thumbnail row-fluid">
      <div class="span2">
        <img src="https://fakeimg.pl/100x100" class="img-circle" width="100" height="100">
        <h4><?= $row['user'] ?></h4>
        <h5>#<span class="sn"><?= $row['id'] ?></span></h5>
      </div>
      <div class="span10">
        <p class="info"><?= $row['info'] ?></p>
        <div class="bottom">

          <span class="badge badge-info">&phone; <span class="tel"><?= $row['tel'] ?></span></span>
          <span class="badge badge-info"><i class="icon-envelope icon-white"></i> <span class="mm"><?= $row['mail'] ?></span></span>
          <span class="badge badge-info"><i class="icon-time icon-white"></i> <span><?= $row['date'] ?></span></span>

          <?php
          if (!$frontsite) echo '<span class="control">
            <a href="#msgmdy" class="btn btn-warning" data-toggle="modal" onclick="setval(this)">編輯</a>
            <a href="api.php?do=msgdel&id=' . $row['id'] . '" class="btn btn-danger">刪除</a>
            </span>';
          ?>
        </div>
      </div>
    </div>
<?php
  }
}
?>

<script>
  function setval(who) {
    bigroot = $(who).parents(".row-fluid");

    //read
    id = bigroot.find(".sn").text();
    user = bigroot.find("h4").text();
    info = bigroot.find("p").text();
    tel = bigroot.find(".tel").text();
    mail = bigroot.find(".mm").text();

    //write
    $("#msgmdy").find("input[name=user]").val(user);
    $("#msgmdy").find("input[name=id]").val(id);
    $("#msgmdy").find("input[name=tel]").val(tel);
    $("#msgmdy").find("input[name=mail]").val(mail);
    $("#msgmdy").find("textarea[name=info]").text(info);

    console.log(id,user,info,tel,mail);
  }
</script>