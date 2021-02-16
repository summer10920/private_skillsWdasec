<?php
session_start(); //open session
$db = new PDO("mysql:host=127.0.0.1;dbname=db00;charset=utf8", "root", "", null);

if (empty($_SESSION['user'])) $_SESSION['user'] = "guest";

/*表單提交處理*/
if (!empty($_GET['do'])) switch ($_GET['do']) {
  case 'login':
    if ($_SESSION['rand'] != $_POST['ans'])
      echo '<script>alert("驗證碼錯誤，請重新登入");location.href="index.php";</script>';
    else if ($_POST['user'] == "admin" && $_POST['pwd'] == "1234") {
      $_SESSION['user'] = "admin";
      echo '<script>alert("歡迎管理員");location.href="admin.php";</script>';
    } else {
      $sql = "SELECT * FROM msg WHERE user='{$_POST['user']}' AND mail='{$_POST['pwd']}'";
      $msglist = $db->query($sql)->fetchAll();
      if ($msglist) {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['mail'] = $_POST['pwd'];
        echo '<script>alert("歡迎，' . $_SESSION['user'] . '");location.href="admin.php";</script>';
      } else echo '<script>alert("帳密錯誤，請重新登入");location.href="index.php";</script>';
    }
    break;
  case 'logout':
    unset($_SESSION['user']);
    echo '<script>location.href="index.php";</script>';
    break;
  case 'msgadd':
    $sql = "INSERT INTO `msg`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'" . $_POST['user'] . "','" . $_POST['info'] . "','" . $_POST['mail'] . "','" . $_POST['tel'] . "',NOW(),0)";
    $db->query($sql);
    echo '<script>alert("留言完成");location.href="index.php";</script>';
    break;
  case 'msgmdy':
    $sql = "UPDATE `msg` SET `user`='" . $_POST['user'] . "',`info`='" . $_POST['info'] . "',`mail`='" . $_POST['mail'] . "',`tel`='" . $_POST['tel'] . "',`date`=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    echo '<script>alert("更新完成！\n注意：如果有變動人名或信箱將無法於本次載入，請重新登入身分刷新列表！");location.href="admin.php";</script>';
    break;
  case 'msgdel':
    $sql = "UPDATE `msg` SET `del`=1 WHERE id={$_GET['id']}";
    $db->query($sql);
    echo '<script>alert("刪除完成");location.href="admin.php";</script>';
    break;
  case 'pkadd':
    // print_r($_FILES);
    $newname = time() . "_" . $_FILES['img']['name'];
    copy($_FILES['img']['tmp_name'], "img/" . $newname);

    $sql = "INSERT INTO `pk`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'" . $_POST['user'] . "','" . $newname . "','" . $_POST['mail'] . "','" . $_POST['tel'] . "',NOW(),0)";
    $db->query($sql);
    echo '<script>alert("參賽完成");location.href="index.php";</script>';
    break;
}
