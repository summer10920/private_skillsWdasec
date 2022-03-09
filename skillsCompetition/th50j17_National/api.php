<?php
session_start(); //open session
//SQL 連結 PDO 物件
$db = new PDO("mysql:host=127.0.0.1;dbname=skillsCompetition_th50j17_National;charset=utf8", "skcomp_th50j17", "skcomp_th50j17", null);
date_default_timezone_set('Asia/Taipei'); //修正時區

$rand = rand(1000, 9999);
if (empty($_SESSION['who'])) $_SESSION['who'] = "guest";

// print_r($_SESSION);

/*特殊do事件處理*/
if (!empty($_GET['do'])) switch ($_GET['do']) {
  case 'login':
    if ($_POST['check'] != $_POST['ans'])
      echo '<script>alert("驗證碼錯誤，請重新登入");location.href="index.php";</script>';
    else if ($_POST['user'] == "admin" && $_POST['pwd'] == "1234") {
      $_SESSION['who'] = "admin";
      echo '<script>alert("歡迎管理員");location.href="admin.php";</script>';
    } else {
      $talklist = $db->query("SELECT * FROM talk WHERE user='" . $_POST['user'] . "' AND mail='" . $_POST['pwd'] . "'")->fetchAll();
      if ($talklist) {
        $_SESSION['who'] = $_POST['user'];
        $_SESSION['whomail'] = $_POST['pwd'];
        echo '<script>alert("歡迎");location.href="admin.php";</script>';
      } else echo '<script>alert("帳密錯誤，請重新登入");location.href="index.php";</script>';
    }
    break;

  case 'logout':
    unset($_SESSION['who']);
    echo '<script>alert("已登出");location.href="index.php";</script>';
    break;

  case 'talkmdy':
    $sql = "UPDATE `talk` SET `user`='" . $_POST['user'] . "',`msg`='" . $_POST['msg'] . "',`mail`='" . $_POST['mail'] . "',`tel`='" . $_POST['tel'] . "',`date`=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    unset($_SESSION['who']);
    echo '<script>alert("更新完成！由於名稱與信箱可能異動，請重新登入管理更新查詢");location.href="index.php";</script>';
    break;
  case 'talkdel':
    $sql="UPDATE `talk` SET `del`=1 WHERE id=".$_GET['id'];
    $db->query($sql);
    echo '<script>alert("刪除完成");location.href="admin.php";</script>';
    break;
    case 'talkadd':
      $sql="INSERT INTO `talk`(`id`, `user`, `msg`, `mail`, `tel`, `date`, `del`) VALUES (null,'".$_POST['user']."','".$_POST['msg']."','".$_POST['mail']."','".$_POST['tel']."',NOW(),0)";
      $db->query($sql);
      echo '<script>alert("留言完成");location.href="index.php";</script>';
    break;
    case 'gameadd':
      // print_r($_FILES);
      $newname=time()."_".$_FILES['img']['name'];
      copy($_FILES['img']['tmp_name'],"img/".$newname);

      $sql="INSERT INTO `pk`(`id`, `user`, `msg`, `mail`, `tel`, `date`, `del`) VALUES (null,'".$_POST['user']."','".$newname."','".$_POST['mail']."','".$_POST['tel']."',NOW(),0)";
      $db->query($sql);
      echo '<script>alert("參賽完成");location.href="index.php";</script>';

}
