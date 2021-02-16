<?php
include("api.php");
$_SESSION['rand'] = rand(1000, 9999);  //產生隨機數四碼
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

          <!-- at index.php, msg.php -->
          <li><a href="#">首頁</a></li>
          <li><a href="msg.php">留言板</a></li>
          <li><a href="#pkadd" data-toggle="modal">玩家參賽</a></li>
          <li><a href="#login" data-toggle="modal">網站管理</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- 賽事版 at index.php-->
  <section class="container">
    <h2>最新消息與賽制公告區塊</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th width="10%">賽事場次</th>
          <th width="10%"></th>
          <th width="30%">玩家</th>
          <th width="10%">匹配</th>
          <th width="30%">玩家</th>
          <th width="10%"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        //選手資料全部帶出後，計算所需場次進行重複輸出畫面，玩家資料使用陣列FIFO方式推出。
        $sql = "SELECT * FROM pk";
        $rows = $db->query($sql)->fetchAll();
        $num = ceil(count($rows) / 2);

        for ($i = 1; $i <= $num; $i++) {
          echo '
            <tr>
              <td>' . $i . '</td>';
          $row = array_shift($rows);
          echo '
              <td><img src="img/' . $row['info'] . '"></td>
              <td>' . $row['user'] . '</td>
              <td>VS</td>';
          $row = array_shift($rows);
          if ($row) echo '
              <td>' . $row['user'] . '</td>
              <td><img src="img/' . $row['info'] . '"></td>
            </tr>
          ';
          else echo '
              <td>等待匹配中...</td>
              <td></td>
            </tr>
          ';
        }
        ?>
      </tbody>
    </table>
  </section>
  <footer>
    <!-- login, at index.php, msg.php -->
    <form id="login" class="modal hide fade" action="api.php?do=login" method="post">
      <div class="modal-body">
        <h3>後台登入</h3>

        帳號（玩家名稱）<br>
        <input type="text" name="user" required>
        <br><br>

        密碼（玩家請輸入 Mail）<br>
        <input type="password" name="pwd" required>
        <br><br>

        驗證碼<br>
        <svg x="0px" y="0px" viewBox="0 0 100 30">
          <style type="text/css">
            .st0 {
              fill: #CCCCCC;
              stroke: #000000;
              stroke-miterlimit: 10;
            }

            .st1 {
              fill: none;
            }

            .st2 {
              font-family: 'Arial-BoldMT';
            }

            .st3 {
              font-size: 24px;
            }

            .st4 {
              letter-spacing: 7;
            }
          </style>
          <g>
            <path class="st0" d="M90,30c-28.7,0-57.3,0-86,0c0.6-4.7,1.3-9.4,1.9-13.9C4,16.7,2,17.3,0,18C0,12,0,6,0,0c3,0,6,0,9,0   C6.5,3.5,4.7,7.2,5.9,11.7c4.4,0.7,6-1.7,6.2-5.3C12.3,4.3,12.1,2.1,12,0c4,0,8,0,12,0c-0.9,1.7-2.9,4.4-2.4,5c1.9,2.3,4.4,5,7,5.4   c5.3,0.8,10.6-0.4,13.7-5.8c1.9,0.7,3.5,1.4,5.2,2c0.4-0.3,0.9-0.6,1.3-0.9C47.8,3.8,46.9,1.9,46,0c11.3,0,22.7,0,34,0   c0,3,0.1,6,0.1,9c0.5,0,1-0.1,1.5-0.1C83.1,5.9,84.5,2.9,86,0c4.6,0,9.2,0,14,0c0,8,0,16,0,24c-4-3.6-3.7,0.8-4,1.5   c-4.3-1.4-8.5-2.1-12-4.1c-3.7-2.1-6.7-5.5-10.2-8.5c0,2.9,0,5.4,0,8c-1.2-2.3-2.4-4.6-3.5-6.9c-0.6-0.1-1.1-0.2-1.7-0.2   c-1.4,3.2-2.8,6.4-4.3,9.6c0.3,0.4,0.6,0.8,0.9,1.1c1.5-0.6,3-1.2,4.4-1.9c1.4-0.6,2.9-1.3,4.3-1.9c-0.6,1.2-1.2,2.4-2.1,4.2   c2.7,0.3,4.6,1,6.1,0.6C86,23.4,86,23.3,90,30z M41.6,17.6c-5.7-2.6-18.1,2-20.4,7.3C28.4,27.6,37.3,24.5,41.6,17.6z M13.8,21.8   c0.8-0.1,1.7-0.2,2.5-0.4c3.5-3.7-0.5-5.4-2.6-7.5c-0.6,0.1-1.1,0.3-1.7,0.4C12.6,16.9,13.2,19.3,13.8,21.8z M44.1,6   c-4.8,4.5-3.5,6.3,1.9,7.7C45.4,11,44.9,9,44.1,6z" />
            <path class="st0" d="M46,0c0.9,1.9,1.8,3.8,2.7,5.7c-0.4,0.3-0.9,0.6-1.3,0.9c-1.6-0.6-3.3-1.3-5.2-2c-3,5.5-8.3,6.6-13.7,5.8   C26,10,23.5,7.3,21.6,5c-0.5-0.6,1.5-3.3,2.4-5C31.3,0,38.7,0,46,0z" />
            <path class="st0" d="M90,30c-4-6.7-4-6.6-12-4.5c-1.6,0.4-3.5-0.3-6.1-0.6c0.9-1.8,1.5-3,2.1-4.2c0,0-0.2,0.2-0.2,0.2   c0-2.5,0-5.1,0-8c3.6,3.1,6.6,6.4,10.2,8.5c3.5,2,7.7,2.7,12,4.1c0.4-0.7,0.1-5.2,4-1.5c0,2,0,4,0,6C96.7,30,93.3,30,90,30z" />
            <path class="st0" d="M0,18c2-0.7,4-1.3,5.9-1.9C5.3,20.6,4.6,25.3,4,30c-1.3,0-2.7,0-4,0C0,26,0,22,0,18z" />
            <path class="st0" d="M12,0c0.1,2.1,0.3,4.3,0.1,6.4c-0.3,3.6-1.8,6-6.2,5.3C4.7,7.2,6.5,3.5,9,0C10,0,11,0,12,0z" />
            <path class="st0" d="M86,0c-1.5,2.9-2.9,5.9-4.4,8.8c-0.5,0-1,0.1-1.5,0.1c0-3-0.1-6-0.1-9C82,0,84,0,86,0z" />
            <path class="st0" d="M41.6,17.6c-4.3,6.9-13.1,10-20.4,7.3C23.5,19.6,35.9,15,41.6,17.6z" />
            <path class="st0" d="M73.8,20.9c0,0,0.2-0.2,0.2-0.2c-1.4,0.6-2.9,1.3-4.3,1.9c-1.5,0.6-3,1.2-4.4,1.9c-0.3-0.4-0.6-0.8-0.9-1.1   c1.4-3.2,2.8-6.4,4.3-9.6c0.6,0.1,1.1,0.2,1.7,0.2C71.4,16.3,72.6,18.6,73.8,20.9z" />
            <path class="st0" d="M13.8,21.8c-0.6-2.5-1.2-5-1.8-7.4c0.6-0.1,1.1-0.3,1.7-0.4c2.1,2.2,6,3.8,2.6,7.5   C15.5,21.6,14.6,21.7,13.8,21.8z" />
            <path class="st0" d="M44.1,6c0.8,3,1.3,5,1.9,7.7C40.6,12.3,39.3,10.6,44.1,6z" />
          </g>
          <rect x="1" y="3" class="st1" width="98" height="24" />
          <text transform="matrix(1 0 0 1 12.505 23.5904)" class="st2 st3 st4"><?= $_SESSION['rand'] ?></text>
        </svg>
        <input type="text" name="ans" required>
        <br><br>

        <div class="btn-group pull-right">
          <button class="btn" data-dismiss="modal">取消</button>
          <input class="btn btn-primary" type="submit" value="送出">
        </div>
      </div>
    </form>

    <!-- pkadd, at index.php -->
    <form id="pkadd" class="modal hide fade " action="api.php?do=pkadd" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <h3>玩家參賽</h3>

        玩家姓名<br>
        <input type="text" name="user" required>
        <br><br>

        玩家頭像<br>
        <input type="file" name="img" required>
        <br><br>

        Email<br>
        <input type="email" name="mail" required>
        <br><br>

        連絡電話<br>
        <input type="tel" name="tel" pattern="[0-9\-]{9,12}" required>
        <br><br>

        <div class="btn-group pull-right">
          <button class="btn" data-dismiss="modal">取消</button>
          <input class="btn btn-primary" type="submit" value="送出">
        </div>
      </div>
    </form>

  </footer>
</body>

</html>