<?php
session_start();
$db = new PDO("mysql:host=127.0.0.1;dbname=db00;charset=utf8", "root", "", null);

//判斷目前訪客的身分，若不認識則初始化為guset身分
if (empty($_SESSION['user'])) $_SESSION['user'] = "guest";

//如果$_GET['do']不是空(empty)的
if (!empty($_GET['do'])) switch ($_GET['do']) {
  case 'login':
    //如果前頁產生的隨機數不等於用戶輸入的答案時，JS指令顯示資訊並踢回指定頁
    if ($_SESSION['rand'] != $_POST['ans'])
      echo '<script>alert("驗證碼錯誤！請重新輸入");history.go(-1);</script>';
    //反之如果輸入的帳密是admin與1234代表是管理者做登入
    else if ($_POST['user'] == "admin" && $_POST['pwd'] == "1234") {
      $_SESSION['user'] = "admin";
      echo '<script>alert("歡迎管理者登入！");location.href="admin.php";</script>';
    }
    //反之那就是訪客登入的驗證
    else {
      $sql = "SELECT * FROM msg WHERE user='" . $_POST['user'] . "' AND mail='" . $_POST['pwd'] . "'";
      $rows = $db->query($sql)->fetchAll();
      if ($rows) {  //如果有找到任何東西時
        $_SESSION['user'] = $_POST['user']; //儲存該身分之名稱
        $_SESSION['mail'] = $_POST['pwd']; //儲存該身分之信箱
        echo '<script>alert("歡迎' . $_POST['user'] . '登入！");location.href="admin.php";</script>';
      } else { //沒有找到時
        echo '<script>alert("帳密錯誤！請重新輸入");history.go(-1);</script>';
      }
    }

    break;
  case 'logout':
    //清除訪客身分，踢回到前台頁
    unset($_SESSION['user']);
    echo '<script>alert("登出成功");location.href="index.php";</script>';
    break;
  case 'msgadd':
    //將留言之資料轉成SQL INSERT(新增)代碼提交PDO。注意變數與文字串的銜接符號，時間為NOW()
    $sql = "INSERT INTO `msg`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'" . $_POST['user'] . "','" . $_POST['info'] . "','" . $_POST['mail'] . "','" . $_POST['tel'] . "',NOW(),0)";
    $db->query($sql);
    //完成後踢回留言板
    echo '<script>alert("留言成功");location.href="msg.php";</script>';
    break;
  case 'msgdel':
    //將指定ID($_GET['id'])之SQL欄位值del更改為1
    $sql = "UPDATE `msg` SET `del`=1 WHERE id=" . $_GET['id'];
    $db->query($sql);
    //完成後踢回後台
    echo '<script>alert("刪除成功");location.href="admin.php";</script>';
    break;
  case 'msgmdy':
    //將所有提交之資料進行修改翻新，時間為NOW()
    echo $sql = "UPDATE `msg` SET `user`='" . $_POST['user'] . "',`info`='" . $_POST['info'] . "',`mail`='" . $_POST['mail'] . "',`tel`='" . $_POST['tel'] . "',`date`=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    //完成後踢回後台
    echo '<script>alert("修改成功");location.href="admin.php";</script>';
    break;
  case 'pkadd':
    /*
      *  1. 先將原檔名翻新=> "時間代碼_原檔名" 
      *  2. 使用copy(來源,目標)函式，將檔案複製到指定img資料夾
      *  3. 將報名之資料轉成SQL INSERT(新增)代碼提交PDO。注意變數與文字串的銜接符號，時間為NOW()，del 為 0
      *  4. 完成後踢回上一頁 (對應 index.php & msg.php 兩種來源)
    */
    $newname = time() . "_" . $_FILES['img']['name'];
    copy($_FILES['img']['tmp_name'], "img/" . $newname);

    $sql = "INSERT INTO `pk`(`id`, `user`, `info`, `mail`, `tel`, `date`, `del`) VALUES (null,'" . $_POST['user'] . "','" . $newname . "','" . $_POST['mail'] . "','" . $_POST['tel'] . "',NOW(),0)";
    $db->query($sql);
    echo '<script>alert("參賽成功");history.go(-1);</script>';
    break;
}
