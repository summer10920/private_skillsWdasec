<?php
session_start(); //open session
$db = new PDO("mysql:host=127.0.0.1;dbname=db00;charset=utf8", "root", "", null);
// date_default_timezone_set('Asia/Taipei'); //修正時區

if (empty($_SESSION['user'])) $_SESSION['user'] = "guest";

/*特殊do事件處理*/
if (!empty($_GET['do'])) switch ($_GET['do']) {
  case 'login':
    // print_r($_SESSION);
    // print_r($_GET);
    // print_r($_POST);
    if ($_SESSION['rand'] != $_POST['ans'])
      echo '<script>alert("驗證碼錯誤，請重新登入");location.href="index.php";</script>';
    else if ($_POST['user'] == "admin" && $_POST['pwd'] == "1234") {
      $_SESSION['user'] = "admin";
      echo '<script>alert("歡迎管理員");location.href="admin.php";</script>';
    } else {
      $msglist = $db->query("SELECT * FROM msg WHERE user='" . $_POST['user'] . "' AND mail='" . $_POST['pwd'] . "'")->fetchAll();
      if ($msglist) {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['pwd'] = $_POST['pwd'];
        echo '<script>alert("歡迎");location.href="admin.php";</script>';
      } else echo '<script>alert("帳密錯誤，請重新登入");location.href="index.php";</script>';
    }
    break;
  case 'logout':
    unset($_SESSION['user']);
    echo '<script>alert("已登出");location.href="index.php";</script>';
    break;
  case 'msgadd':
    // print_r($_GET);
    // print_r($_POST);
    $sql = "INSERT INTO `msg`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'" . $_POST['user'] . "','" . $_POST['msg'] . "','" . $_POST['mail'] . "','" . $_POST['tel'] . "',NOW(),0)";
    $db->query($sql);
    echo '<script>alert("留言完成");location.href="index.php";</script>';
    break;
  case 'msgmdy':
    $sql = "UPDATE `msg` SET `user`='" . $_POST['user'] . "',`info`='" . $_POST['info'] . "',`mail`='" . $_POST['mail'] . "',`tel`='" . $_POST['tel'] . "',`date`=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    echo '<script>alert("更新完成！注意聲明：如果有變動人名或信箱將無法再載入（已不符合原先登入之查詢條件），可另登入新帳戶信箱為新的查詢條件");location.href="admin.php";</script>';
    break;
  case 'msgdel':
    $sql = "UPDATE `msg` SET `del`=1 WHERE id=" . $_GET['id'];
    $db->query($sql);
    echo '<script>alert("刪除完成");location.href="admin.php";</script>';
    break;
    
  case 'gameadd':
    // print_r($_FILES);
    $newname = time() . "_" . $_FILES['img']['name'];
    copy($_FILES['img']['tmp_name'], "img/" . $newname);

    $sql = "INSERT INTO `pk`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'" . $_POST['user'] . "','" . $newname . "','" . $_POST['mail'] . "','" . $_POST['tel'] . "',NOW(),0)";
    $db->query($sql);
    echo '<script>alert("參賽完成");location.href="index.php";</script>';
    break;
}