<?php
$backsite=true;
include("api.php");
if($_SESSION['who']=="guest") echo '<script>alert("尚未登入");location.href="index.php";</script>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>電競網站</title>
  <link rel="stylesheet" href="plugin/bootstrap.min.css">
  <link rel="stylesheet" href="plugin/style.css">
  <script src="plugin/jquery.min.js"></script>
  <script src="plugin/bootstrap.min.js"></script>
</head>

<body>
  <!--網站標題-->
  <header class="row-fluid">
    <div class="span4">第46屆全國競賽電競遊 官方網站</div>
    <div class="span8"></div>
  </header>

  <!-- 選單區 -->
  <nav class="navbar navbar-inverse">
    <div class="navbar-inner">
      <div class="container">
        <!-- <a class="brand" href="#">Title</a> -->
        <ul class="nav">
          <!-- <li class="active"><a href="#">Home</a></li> -->
          <li><a href="index.php">回前台首頁</a></li>
          <li><a href="api.php?do=logout">管理登出</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 留言板管理 -->
  <section class="container">
    <h2>玩家留言版後台管理</h2>
    <!-- <a href="#msgadd" class="btn btn-info" data-toggle="modal" style="float:right">我要留言</a> -->
    <div style="clear: both;"></div>
    <?php include("talklist.php") ?>
  </section>

  <footer>
    <!-- for backsite modify talklist -->
    <form id="talkmdy" class="modal hide fade form-horizontal" action="api.php?do=talkmdy" method="post">
      <div class="modal-header">
        <h3>編輯留言</h3>
        <input type="hidden" name="id">
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label">玩家姓名</label>
          <input type="text" name="user" required value="Loki">
        </div>
        <div class="control-group">
          <label class="control-label">留言內容</label>
          <textarea name="msg" required>Old Message....</textarea>
        </div>
        <div class="control-group">
          <label class="control-label">Email</label>
          <input type="email" name="mail" required value="summer10920@gmail.com">
        </div>
        <div class="control-group">
          <label class="control-label">連絡電話</label>
          <input type="tel" name="tel" pattern="[0-9\-]{9,12}" value="0204888988">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal">取消</button>
        <input class="btn btn-primary" type="submit" value="送出">
      </div>
    </form>
  </footer>
</body>

</html>