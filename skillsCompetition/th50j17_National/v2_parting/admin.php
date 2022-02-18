<?php
include("api.php");
if ($_SESSION['user'] == "guest") //如果身分是訪客則沒權限看後台，將踢回前台
  echo '<script>alert("無權限使用，將返回前台！");location.href="index.php";</script>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>競賽網站</title>
  <link rel="stylesheet" href="plugin/bootstrap.min.css">
  <script src="plugin/jquery.min.js"></script>
  <script src="plugin/bootstrap.min.js"></script>
  <style>
    * {
      font-family: "微軟正黑體" !important;
    }

    section {
      margin: 80px auto;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav">
          <li class="brand">第 50 屆全國競賽電競遊 官方網站</li>

          <!--at admin.php-->
          <li><a href="api.php?do=logout">管理登出</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--留言版 at msg.php, admin.php-->
  <section class="container">
    <h2>玩家留言板</h2>

    <?php
    //如果是管理者則撈取全部，否則只撈取特定對象(用戶之名稱&信箱)之資料
    if ($_SESSION['user'] == "admin") $sql = "SELECT * FROM msg";
    else $sql = "SELECT * FROM msg WHERE user='" . $_SESSION['user'] . "' AND mail='" . $_SESSION['mail'] . "'";
    $rows = $db->query($sql)->fetchAll();
    foreach ($rows as $row) {
      if ($row['del']) {
        //delete version
    ?>
        <!-- HTML start in foreach-->
        <div class="thumbnail row-fluid del">
          <div class="span2">#<?= $row['id'] ?></div>
          <div class="span10">此樓留言已被刪除</div>
        </div>
        <!-- HTML end in foreach-->
      <?php
      } else {
        //ok version
      ?>
        <!-- HTML start in foreach-->
        <div class="thumbnail row-fluid">
          <div class="span2">
            <img src="img/user.jpg" class="img-circle" width="100" height="100">
            <h4><?= $row['user'] ?></h4>
            <h5>#<span class="sn"><?= $row['id'] ?></span></h5>
          </div>
          <div class="span10">
            <p class="info"><?= $row['info'] ?></p>
            <div class="bottom">
              <span class="badge badge-info">TEL: <span class="tel"><?= $row['tel'] ?></span></span>
              <span class="badge badge-info">MAIL: <span class="mail"><?= $row['mail'] ?></span></span>
              <span class="badge badge-info">UPDATE: <?= $row['date'] ?></span>
              <a href="#msgmdy" data-toggle="modal" class="btn btn-warning" onclick="setval(this)">修改</a>
              <a href="api.php?do=msgdel&id=<?= $row['id'] ?>" class="btn btn-danger">刪除</a>
            </div>
          </div>
        </div>
        <!-- HTML end in foreach-->
    <?php
      }
    }
    ?>
  </section>
  <footer>
    <!--msgmdy,at admin.php-->
    <form id="msgmdy" class="modal hide fade " action="api.php?do=msgmdy" method="post">
      <div class="modal-body">
        <h3>編輯留言</h3>
        <input type="hidden" name="id">

        玩家姓名<br>
        <input type="text" name="user" required value="Loki">
        <br><br>

        留言內容<br>
        <textarea name="info" required>Old Message....</textarea>
        <br><br>

        Email<br>
        <input type="email" name="mail" required value="summer10920@gmail.com">
        <br><br>

        連絡電話<br>
        <input type="tel" name="tel" pattern="[0-9\-]{9,12}" value="0204888988">
        <br><br>

        <div class="btn-group pull-right">
          <button class="btn" data-dismiss="modal">取消</button>
          <input class="btn btn-primary" type="submit" value="送出">
        </div>
      </div>
    </form>

    <!--msgmdy need, at admin.php-->
    <script>
      function setval(e) {
        let bigroot = $(e).parents(".row-fluid");
        let name = bigroot.find("h4").text();
        let info = bigroot.find("p").text();
        let mail = bigroot.find(".mail").text();
        let tel = bigroot.find(".tel").text();
        let id = bigroot.find(".sn").text();

        $("#msgmdy").find("input[name=user]").val(name);
        $("#msgmdy").find("textarea[name=info]").text(info);
        $("#msgmdy").find("input[name=mail]").val(mail);
        $("#msgmdy").find("input[name=tel]").val(tel);
        $("#msgmdy").find("input[name=id]").val(id);
      }
    </script>
  </footer>
</body>

</html>