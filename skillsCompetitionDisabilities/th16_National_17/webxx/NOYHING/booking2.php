<!DOCTYPE html>
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
<!-- <div class="nab-bar">XXX旅遊網</div>     -->
<div class="bg-dark text-center"><img src="img/logo.jpg" ></div>
<nav class="navbar navbar-expand-lg navbar-light bg-warning shadow">
 
<div class="container">
  <!-- <a class="navbar-brand" >旅遊網</a> -->
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
<div class="content">
<!--  -->
<div class="container mb-7">
<p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>訪客訂房</span></p>
<h3 class="text-center text-warning">線上訂房</h3>

<form action="booking3.php">
    <div class="card shadow my-3 mx-auto text-center px-5 py-3">
      <p class="text-left">
        步驟1 \ <span class="text-info">步驟2</span> \ 步驟3
      </p>
      <div class="row my-3">
        <div class="col-6"><input type='text' class="w-100" placeholder="訪客姓名" ></div>
        <div class="col-6"><input type='text' class="w-100" placeholder="連絡電話" required pattern=[0-9,-]{9,12}></div>
        <div class="col-12 mt-3"><input type='text' class="w-100" placeholder="住址" ></div>
      </div>
      <div class="mx-auto">
        <input class="btn btn-info" type="button" value="上一步" onclick="history.go(-1)">
        <input class="btn btn-info" type="submit" value="下一步">
      </div>
    </div>
</form>

</div>



<!--  -->

</div>

<!-- 姓名、電話及住址 -->


<footer class="bg-dark text-white w-100 text-center py-3 fixed-bottom">第 16 屆全國身心障礙者技能競賽 設計者：WebXX</footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>