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
              <a class="nav-link" href="?pg=message">訪客留言</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?pg=booking&title=home">訪客訂房</a>
              </li>
          </ul>
          <a class=" btn btn-outline-dark" href="admin.php">網站管理</a>

        </div>
      </div>
    </nav>
<!--   -->

<?php  
include($_GET['pg'].".php");
?>
    <!-- <div class="container">
      <p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>網站管理登入</span></p>
      <h3 class="text-center text-warning">網站管理登入</h3>
      
        <div class="card shadow my-3 w-50 mx-auto text-center p-5 ">


          <p>帳號：<input type="text" name="acc"></p>
          <p>密碼：<input type="password" name="pwd"></p>
          <p>驗證碼：<input type="text" name="check"></p>
          <p><input class="btn btn-warning" type="submit" value="登入"></p>

        </div>
      
    </div> -->
<!--   -->

    <!-- /content -->
  </div>
  <footer class="bg-dark text-white w-100 text-center py-3">第 16 屆全國身心障礙者技能競賽 設計者：WebXX</footer>

    <script src=" js/jquery.min.js"> </script> 
    <script src="js/bootstrap.min.js"></script>
</body>

</html>