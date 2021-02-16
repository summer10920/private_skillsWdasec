<?php
session_start();
$db = new PDO("mysql:host=127.0.0.1;dbname=db00;charset=utf8", "root", "", null);

// 如果目前還沒有SESSION也就是沒有登入前都是訪客
// $_SESSION['user']="guest";  
if (empty($_SESSION['user'])) $_SESSION['user'] = "guest";

if (!empty($_GET['do'])) switch ($_GET['do']) {
  case 'login':
    if ($_POST['ans'] != $_SESSION['rand']) {
      echo "<script>alert('你的驗證碼錯誤請重新登入');location.href='index.php';</script>";
    } else if ($_POST['acc'] == "admin" && $_POST['pwd'] == "1234") {
      $_SESSION['user'] = "admin";
      echo "<script>alert('歡迎管理者登入');location.href='admin.php';</script>";
    } else {
      // $sql = "select * FROM msg WHERE user=" . $_POST['acc'] . "' AND mail='" . $_POST['pwd'] . "'";
      $sql = "select * FROM msg WHERE user='{$_POST['acc']}' AND mail='{$_POST['pwd']}'";
      $rows = $db->query($sql)->fetchAll();
      if ($rows) {
        $_SESSION['user'] = $_POST['acc'];
        $_SESSION['mail'] = $_POST['pwd'];
        echo "<script>alert('歡迎" . $_POST['acc'] . "登入');location.href='admin.php';</script>";
      } else {
        echo "<script>alert('登入資訊錯誤請重新登入');location.href='index.php';</script>";
      }
    }
    break;
  case 'logout':
    unset($_SESSION['user']);
    echo "<script>location.href='index.php';</script>";
    break;
  case 'msgadd':
    $sql = "INSERT INTO `msg`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'{$_POST['user']}','{$_POST['info']}','{$_POST['mail']}','{$_POST['tel']}',NOW(),0)";
    $db->query($sql);
    echo "<script>location.href='index.php';</script>";
    break;
  case 'msgdel':
    $sql = "UPDATE msg SET del=1 WHERE id={$_GET['id']}";
    $db->query($sql);
    echo "<script>location.href='admin.php';</script>";
    break;
  case 'msgmdy':
    $sql = "UPDATE msg SET user='{$_POST['user']}',mail='{$_POST['mail']}',info='{$_POST['info']}',tel='{$_POST['tel']}',date=NOW() WHERE id={$_POST['id']}";
    $db->query($sql);
    if ($_SESSION['user'] != "admin")
      echo "<script>alert('更新完成！注意：如果您已修改異動人名或信箱，此筆異動將無法歸入您目前的身分條件，請重新登入身分(新人名與信箱)刷新列表！');location.href='admin.php';</script>";
    else echo "<script>location.href='admin.php';</script>";
    break;
  case 'pkadd':
    // print_r($_GET);
    // print_r($_POST);
    // print_r($_FILES);
    $newName = time() . "_" . $_FILES['img']['name'];
    copy($_FILES['img']['tmp_name'], 'img/' . $newName);

    $sql = "INSERT INTO `pk`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'{$_POST['user']}','{$newName}','{$_POST['mail']}','{$_POST['tel']}',NOW(),0)";
    $db->query($sql);
    echo "<script>alert('參賽成功');location.href='index.php#pk';</script>";
    break;
}
