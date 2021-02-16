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
    <li class="nav-item">
        <a class="nav-link" href="#">訪客留言</a>
      </li><li class="nav-item">
        <a class="nav-link" href="booking.php">訪客訂房</a>

    </ul>
    <a class=" btn btn-outline-dark" href="#">網站管理</a>
  
  </div>
  </div>
</nav>
-->
<div class="container">
<p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>訪客留言</span></p>
<h3 class="text-center text-warning">訪客留言版</h3>


<form action="">
    <div class="card shadow my-3 mx-auto text-center p-5">
        <div class="row my-3">
            <div class="col-4" ><input type='text' class="w-100" placeholder="訪客姓名" ></div>
            <div class="col-4" ><input type='email' class="w-100" placeholder="Email" ></div>
            <div class="col-4" ><input type='text' class="w-100" placeholder="連絡電話" required pattern=[0-9]{6,12}></div>
            <div class="col-12 mt-4"><textarea class="w-100" rows="5"  placeholder="留言內容"></textarea></div>
            <div class="mx-auto mt-3"><input class="btn btn-info" type="submit" value="送出"></div>
        </div>
    </div>
</form>


<div class="card shadow my-5 mx-auto text-center p-5">
<table class="table table-hover">
  <thead class='alert-warning'>
    <tr>
      <th scope="col">#</th>
      <th scope="col">訪客姓名</th>
      <th scope="col">留言內容</th>
      <th scope="col">Email</th>
      <th scope="col">連絡電話</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
</div>


 
</div>
</div>
<!--  
<footer class="bg-dark text-white w-100 text-center py-3 fixed-bottom">第 16 屆全國身心障礙者技能競賽 設計者：WebXX</footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html> -->