<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=dbj17;charset=utf8", "root", "");
$row = $db->query("SELECT * FROM admin")->fetch();

if ($_GET['code'] != $_GET['chk']) echo '
    <script>
      alert("驗證碼不一至請重新登入！");
      history.go(-1);
    </script>
  ';
else if ($_GET['acc'] != $row['acc']) echo '
    <script>
      alert("帳號錯誤請重新登入！");
      history.go(-1);
    </script>
  ';
else if ($_GET['pwd'] != $row['pwd']) echo '
    <script>
      alert("密碼錯誤請重新登入！");
      history.go(-1);
    </script>
  ';
else echo '
  <script>
    alert("登入成功！");
    location.href="./";
  </script>
';