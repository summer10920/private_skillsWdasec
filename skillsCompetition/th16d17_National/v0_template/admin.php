<?php
$_GET['pg']=(!empty($_GET['pg']))?$_GET['pg']:"login";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>XXXXXX</title>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-light ">

  <div class="content">
    <!-- content -->

    <!-- <div class="nab-bar">XXX旅遊網</div>     -->
    <div class="bg-dark text-center"><img src="img/logo.jpg"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning shadow">

      <div class="container">
        <!-- <a class="navbar-brand" >旅遊網</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="?pg=booking&title=admin">線上訂房</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?pg=booking&title=input">房務管理</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?pg=userbuy">訂單管理</a>
            </li>
          
          </ul>

          <a class=" btn btn-outline-dark" href="index.php">後臺登出</a>

        </div>
      </div>
    </nav>
    <?php  
include($_GET['pg'].".php");
?>


  </div>
  <footer class="bg-dark text-white w-100 text-center py-3">第 16 屆全國身心障礙者技能競賽 設計者：WebXX</footer>

    <script src=" js/jquery.min.js"> </script> 
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
<!-- 
1 能利用管理者帳號登入「訂房管理」進入管理頁面
2 管理者能設定及修改每日可訂房的房間數 
3 管理者能設定及修改每日的住宿房價 
4 管理者能設定及修改訂房訂金的金額(使用訂房金額百分比設定，如 50%、35%、20%等…)
5 管理者能由後台操作訂房功能 
6 管理者能由後台操作修改訂房資料(由訂單編號查詢或由列表挑選)後修改 
7 管理者能由後台操作刪除訂房資料(由訂單編號查詢或由列表挑選)後刪除 
8 線上訂房前台版面美術設計 
 -->