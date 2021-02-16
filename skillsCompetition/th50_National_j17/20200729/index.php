<?php
include("api.php");
$_SESSION['rand'] = rand(1000, 9999);
$frontsite = TRUE;


for ($i = 0; $i < 8; $i++) $fake[] = rand(100, 999);
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
          <li><a href="#">回首頁</a></li>
          <li><a href="#msg">玩家留言板</a></li>
          <li><a href="#pk">最新消息與賽制公告區塊</a></li>
          <li><a href="#gameadd" data-toggle="modal">玩家參賽</a></li>
          <!-- 
          <li><a href="#login" data-toggle="modal">網站管理</a></li>
          <li><a href="admin.php">網站管理</a></li>
          -->
          <?php
          if ($_SESSION['user'] == "guest")
            echo '<li><a href="#login" data-toggle="modal">網站管理</a></li>';
          else
            echo '<li><a href="admin.php">網站管理</a></li>';
          // echo 
          //   ($_SESSION['user'])=="guest"
          //   ?
          //     '<li><a href="#login" data-toggle="modal">網站管理</a></li>'
          //   :
          //     '<li><a href="admin.php">網站管理</a></li>'
          //   ;

          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 廣告區 -->
  <section class="ad">
    <p>根據市調公司Newzoo發布的全球電競市場報告指出，今年全球電競產值將達9.1億美元（約新台幣300億元），年增38%，隨著電競產業逐漸成熟，預估2020年產值將達到14億美元。由於電子競技成長猛烈，國際奧林匹克委員會（
      IOC ）公布第六屆奧林匹克會議細節，其中包括先前奧委會委員 Tony Estanguet
      承諾帶進奧委會的電子競技相關討論。簡單來說，奧委會確切認識到，電競作為一種產業與運動，而電競又在年輕世代中特別受歡迎，且許多奧運相關權益關係者，或多或少都有參與電競產業。所以電競很有可能納入奧林匹克的競賽項目之中。</p>
  </section>

  <!-- 留言板 -->
  <div id="msg"></div>
  <section class="container">
    <h2>玩家留言板</h2>
    <a href="#msgadd" class="btn btn-info" data-toggle="modal">我要留言</a>

    <?php include('msg.php') ?>
  </section>

  <!-- 賽事版 -->
  <div id="pk"></div>
  <section class="container">
    <h2>最新消息與賽制公告區塊</h2>
    <table class="table table-striped">
      <thead>
        <th>賽事場次</th>
        <th></th>
        <th>玩家</th>
        <th>匹配</th>
        <th>玩家</th>
        <th></th>
      </thead>
      <tbody>
        <?php include('pk.php') ?>
      </tbody>
    </table>
  </section>



  <footer>
    <!-- msg add -->
    <form id="msgadd" class="modal hide fade form-horizontal" action="api.php?do=msgadd" method="post">
      <div class="modal-header">
        <h3>新增留言</h3>
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label">姓名</label>
          <input type="text" name="user" required>
        </div>
        <div class="control-group">
          <label class="control-label">留言內容</label>
          <!-- <input type="text" name="info"> -->
          <textarea name="info" required></textarea>
        </div>
        <div class="control-group">
          <label class="control-label">Email</label>
          <input type="email" name="mail" required>
        </div>
        <div class="control-group">
          <label class="control-label">電話</label>
          <input type="tel" name="tel" required pattern="[0-9\-\(\)]{9,12}">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal">取消</button>
        <button class="btn btn-primary">送出</button>
      </div>
    </form>

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
        <button class="btn" data-dismiss="modal">取消</button>
        <button class="btn btn-primary">送出</button>
      </div>
    </form>

    <!-- game add -->
    <form id="gameadd" class="modal hide fade form-horizontal" action="api.php?do=pkadd" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h3>玩家參賽</h3>
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label">姓名</label>
          <input type="text" name="user" required>
        </div>
        <div class="control-group">
          <label class="control-label">頭像上傳</label>
          <!-- <input type="text" name="info"> -->
          <!-- <textarea name="info" required></textarea> -->
          <input type="file" name="img">
        </div>
        <div class="control-group">
          <label class="control-label">Email</label>
          <input type="email" name="mail" required>
        </div>
        <div class="control-group">
          <label class="control-label">電話</label>
          <input type="tel" name="tel" required pattern="[0-9\-\(\)]{9,12}">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal">取消</button>
        <button class="btn btn-primary">送出</button>
      </div>
    </form>

    <!--  login -->
    <form id="login" class="modal hide fade form-horizontal" action="api.php?do=login" method="post">
      <div class="modal-header">
        <h3>後台登入</h3>
      </div>
      <div class="modal-body">
        <div class="control-group">
          <label class="control-label">帳號<br>(玩家名稱)</label>
          <input type="text" name="acc" required>
        </div>
        <div class="control-group">
          <label class="control-label">密碼<br>(玩家信箱)</label>
          <input type="password" name="pwd">
          <!-- <textarea name="info" required></textarea> -->
        </div>
        <div class="control-group">
          <label class="control-label">驗證碼<br>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="圖層_1" x="0px" y="0px" width="200px" height="50px" viewBox="0 0 200 50" enable-background="new 0 0 200 50" xml:space="preserve">
              <text transform="matrix(1.9166 -0.3142 0.1618 0.9868 50.1309 41.627)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="25.756"><?= $_SESSION['rand'] ?></text>
              <text transform="matrix(1 0 0 1 11.5 23.2505)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[0] ?></text>
              <text transform="matrix(1 0 0 1 55.7031 23.2505)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[1] ?></text>
              <text transform="matrix(1 0 0 1 67.0786 47.4121)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[2] ?></text>
              <text transform="matrix(1 0 0 1 25.7256 46.0039)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[3] ?></text>
              <text transform="matrix(1 0 0 1 105.2813 46.0039)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[4] ?></text>
              <text transform="matrix(1 0 0 1 86.6235 19.4653)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[5] ?></text>
              <text transform="matrix(1 0 0 1 135.3262 19.4648)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[6] ?></text>
              <text transform="matrix(1 0 0 1 147.9053 41.627)" font-family="'AdobeMingStd-Light-B5pc-H'" font-size="21.1956"><?= $fake[7] ?></text>
            </svg>

          </label>
          <input type="text" name="ans" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal">取消</button>
        <button class="btn btn-primary">送出</button>
      </div>
    </form>
  </footer>

</body>

</html>