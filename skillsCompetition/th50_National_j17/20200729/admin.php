<?php
include("api.php");
if ($_SESSION['user'] == 'guest' || empty($_SESSION['user']))
  echo "<script>alert('你沒有權限請回前台登入');location.href='index.php';</script>";
$frontsite = FALSE;
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
  <!-- 網站標題 -->
  <header class="row-fluid">
    <div class="span4">第50屆全國競賽電競遊 官方網站</div>
    <div class="span4"><img src="https://fakeimg.pl/200x80/"></div>
    <div class="span4"></div>
  </header>

  <!-- 選單區 -->
  <nav class="navbar navbar-inverse">
    <div class="navbar-inner">
      <div class="container">
        <!-- <a class="brand" href="#">Title</a> -->
        <ul class="nav">
          <li><a href="index.php">回前台首頁</a></li>
          <li><a href="api.php?do=logout">帳號登出</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 留言板 -->
  <div id="msg"></div>
  <section class="container">
    <h2>玩家留言板</h2>
    <!-- <a href="#msgadd" class="btn btn-info" data-toggle="modal">我要留言</a> -->

    <?php include('msg.php') ?>
  </section>

  <footer>
    <!-- msg mdy -->
    <form id="msgmdy" class="modal hide fade form-horizontal" action="api.php?do=msgmdy" method="post">
      <div class="modal-header">
        <h3>修改留言</h3>
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label">姓名</label>
          <input type="text" name="user" required value="User Name">
        </div>
        <div class="control-group">
          <label class="control-label">留言內容</label>
          <!-- <input type="text" name="info"> -->
          <textarea name="info" required>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus eligendi autem accusantium nam illo commodi voluptates vero consectetur eum beatae?</textarea>
        </div>
        <div class="control-group">
          <label class="control-label">Email</label>
          <input type="email" name="mail" required value="sss@gmail.com">
        </div>
        <div class="control-group">
          <label class="control-label">電話</label>
          <input type="tel" name="tel" required pattern="[0-9\-\(\)]{9,12}" value="0999555-555">
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id">
        <button class="btn" data-dismiss="modal">取消</button>
        <button class="btn btn-primary">送出</button>
      </div>
    </form>
  </footer>

</body>

</html>