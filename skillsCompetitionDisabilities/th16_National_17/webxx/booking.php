<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XXXXXX</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"  type="text/css">
    <link href="css/style.css" rel="stylesheet"  type="text/css">
</head>

<body class="bg-light ">

<div class="bg-dark text-center"><img src="img/logo.jpg" ></div>
<nav class="navbar navbar-expand-lg navbar-light bg-warning shadow">
 
<div class="container">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" >
    <span class="navbar-toggler-icon"></span>
  </button>
 
  <div class="collapse navbar-collapse"  id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="message.php">訪客留言</a></li>
      <li class="nav-item"><a class="nav-link" href="#">訪客訂房</a></li>
    </ul>
    <a class=" btn btn-outline-dark" href="#">網站管理</a>
  </div>
</div>
</nav>
<div class="content"> -->
<?php
$_GET['step']=(!empty($_GET['step']))?$_GET['step']:"pg1";
$_GET['title']=(empty($_GET['title']))?'home':$_GET['title'];
?>

<div class="container mb-7">
  <?php 
  


  switch ($_GET['title'])
  {
  case 'home':
    $str='<p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>訪客訂房</span></p><h3 class="text-center text-warning">線上訂房</h3>';
  break;
  case 'admin':
    $str='<p class="my-3 text-warning"><a href="admin.php">後台</a> > <span>後臺訂房</span></p><h3 class="text-center text-warning">後臺訂房</h3>';
  break;
  case 'input':
    $str='<p class="my-3 text-warning"><a href="admin.php">後台</a> > <span>房務管理</span></p><h3 class="text-center text-warning">房務管理</h3>';
  break;
  
  }


//  $str=($_GET['title']=='home')? '<p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>訪客訂房</span></p><h3 class="text-center text-warning">線上訂房</h3>'
//  :'<p class="my-3 text-warning"><a href="index.php">後台</a> > <span>後臺訂房</span></p><h3 class="text-center text-warning">後臺訂房</h3>';
  ?>
<!-- <p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>訪客訂房</span></p>
<h3 class="text-center text-warning">線上訂房</h3> -->
<?= $str ?>

<?php include($_GET['step'].".php") ?> 
<!-- <form action="/index.php?pg=booking">
    <div class="card shadow my-3 mx-auto text-center px-5 py-3">
      <p class="text-left">
        <span class="text-info">步驟1</span> \ 步驟2 \ 步驟3
      </p>
      
      <h3>
        <a href="#" class="badge badge-pill badge-info">上一月</a>
        2020年 4月
        <a href="#" class="badge badge-pill badge-info">下一月</a>
      </h3>
      <div class="my-3">
        
      </div>
      <div class="mx-auto"> -->
        <!-- <input class="btn btn-info" type="submit" value="下一步"> -->
        <!-- <a class="btn btn-info" href="?pg=booking&step=2">下一步</a>
      </div>
    </div>
</form> -->

</div>

</div>

<!-- <footer class="bg-dark text-white w-100 text-center py-3 fixed-bottom">第 16 屆全國身心障礙者技能競賽 設計者：WebXX</footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html> -->