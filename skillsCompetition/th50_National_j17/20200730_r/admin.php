<?php
include("api.php");
if ($_SESSION['user'] == 'guest' || empty($_SESSION['user']))
  echo "<script>alert('你沒有訪問權限，請回前台登入');location.href='index.php';</script>";
$frontsite=FALSE;
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
    <div class="span4">第 50 屆全國競賽電競遊 官方網站</div>
    <div class="span8"></div>
  </header>

  <!-- 選單區 -->
  <nav class="navbar navbar-inverse">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav">
          <li><a href="index.php">回前台首頁</a></li>
          <li><a href="api.php?do=logout">管理登出</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 留言板 -->
  <div id="msg"></div>
  <section class="container">
    <h2>玩家留言板</h2>
    <?php include('msg.php') ?>
  </section>
  <footer>
    <!-- for admin to msgmdy-->
    <form id="msgmdy" class="modal hide fade form-horizontal" action="api.php?do=msgmdy" method="post">
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
          <textarea name="info" required>Old Message....</textarea>
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