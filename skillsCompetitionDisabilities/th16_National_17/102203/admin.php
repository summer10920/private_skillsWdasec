<?php
require_once('sql.php');
if(empty($_SESSION['admin'])) plo("index.php?do=login");
$admain=(empty($_GET['do']))?"admain":$_GET['do'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>影城</title>
  <link rel="stylesheet" href="css/css.css">
  <link href="Manage Page_files/s2.css" rel="stylesheet" type="text/css">
  <script src="scripts/jquery-1.9.1.min.js"></script>
</head>

<body>
  <div id="main">
    <div id="top" style=" background:#999 center; background-size:cover; " title="替代文字">
      <h1>ABC影城</h1>
    </div>
    <!-- <div id="top2"> <a href="03P01.htm">首頁</a> <a href="03P02.htm">線上訂票</a> <a href="#">會員系統</a> <a href="03P03.htm">管理系統</a> </div> -->
    <div id="top2">
      <a href="index.php">首頁</a>
      <a href="order.php">線上訂票</a>
      <a href="#">會員系統</a>
      <a href="admin.php">管理系統</a>
    </div>
    <div id="text"> <span class="ct">最新活動</span>
      <marquee direction="right">
        ABC影城票價全面八折優惠1個月
      </marquee>
    </div>
    <div id="mm">
      <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;">
        <a href="?do=tit">網站標題管理</a>|
        <a href="?do=go">動態文字管理</a>|
        <a href="?do=rr">預告片海報管理</a>|
        <a href="?do=vv">院線片管理</a>|
        <a href="?do=orderlist">電影訂票管理</a>
      </div>

      <div class="rb tab">
        <?php include_once($admain.".php");?>
      </div>
    </div>
    <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
  </div>
</body>

</html>