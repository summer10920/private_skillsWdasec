<?php
include "lib.php";
switch ($_GET['do']) {
  case 'adlogin':
    $re = select("q4t10_admin", "acc='" . $_POST['acc'] . "' and pwd='" . $_POST['pwd'] . "'");
    if ($re != null) {
      $_SESSION['admin'] = $_POST['acc'];
      plo("admin.php");
    } else echo "<script>alert('輸入錯誤');window.history.back()</script>";
    break;
  case 'adlogout':
    unset($_SESSION['admin']);
    plo("index.php");
    break;
  case 'adminadd':
    $_POST['access'] = serialize($_POST['access']);
    insert($_POST, "q4t10_admin");
    plo("admin.php");
    break;
  case 'adminmdy':
    $_POST['access'][$_GET['id']] = serialize($_POST['cc']);
    unset($_POST['cc']);
    update($_POST, "q4t10_admin");
    plo("admin.php");
    break;
  case 'admindel':
    $post['del'][] = $_GET['id'];
    delete($post, "q4t10_admin");
    plo("admin.php");
    break;
  case 'thadd':
    insert($_POST, "q4t4_class");
    plo("admin.php?redo=th");
    break;
  case 'thmdy':
    update($_POST, "q4t4_class");
    plo("admin.php?redo=th");
    break;
  case 'thdel':
    $post['del'][] = $_GET['id'];
    delete($post, "q4t4_class");
    plo("admin.php?redo=th");
    break;
  case 'getson':
    $re = select("q4t4_class", "parent=" . $_POST['id']);
    foreach ($re as $ro) echo '<option value="' . $ro['id'] . '">' . $ro['title'] . '</option>';
    break;
  case 'tpadd':
    $_POST['img'] = addfile($_FILES['img']);
    $newid = insert($_POST, "q4t5_product");
    $post['seq'][$newid] = $newid + 100000;
    update($post, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'tpmdy':
    $_POST['img'][$_GET['id']] = addfile($_FILES['img']);
    update($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'tpon':
    $_POST['dpy'][$_GET['id']] = 1;
    update($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'tpoff':
    $_POST['dpy'][$_GET['id']] = 0;
    update($_POST, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'tpdel':
    $post['del'][] = $_GET['id'];
    delete($post, "q4t5_product");
    plo("admin.php?redo=tp");
    break;
  case 'want':
    $_SESSION['buy'][$_GET['id']] = $_POST['num'];
    if (empty($_SESSION['user'])) plo("index.php?do=login");
    else plo("index.php?do=buycart");
    break;
  case 'checkuser':
    $re = select("q4t9_user", "acc='" . $_POST['id'] . "'");
    if ($re != null) echo "帳號重複";
    else echo "可使用此帳號";
    break;
  case 'reg':
    $_POST['date'] = date("Y-m-d");
    insert($_POST, "q4t9_user");
    plo("index.php?do=login");
    break;
  case 'login':
    $re = select("q4t9_user", "acc='" . $_POST['acc'] . "' and pwd='" . $_POST['pwd'] . "'");
    if ($re != null) {
      $_SESSION['user'] = $_POST['acc'];
      $_SESSION['id'] = $re[0]['id'];
      plo("index.php");
    } else echo "<script>alert('輸入錯誤');window.history.back()</script>";
    break;
  case 'logout':
    unset($_SESSION['user']);
    plo("index.php");
    break;
  case 'cartdel':
    unset($_SESSION['buy'][$_GET['id']]);
    plo("index.php?do=buycart");
    break;
  case 'pay':
    $re = select("q4t9_user", "id=" . $_SESSION['id']);
    $ro = $re[0];
    $_POST['acc'] = $ro['acc'];
    $_POST['name'] = $ro['name'];
    $_POST['tel'] = $ro['tel'];
    $_POST['addr'] = $ro['addr'];
    $_POST['mail'] = $ro['mail'];
    $_POST['total'] = $_GET['total'];
    $_POST['date'] = date("Y-m-d");
    $_POST['buy'] = serialize($_SESSION['buy']);
    unset($_SESSION['buy']);
    insert($_POST, "q4t8_order");
    echo "<script>alert('訂購成功感謝您的參與');" . jlo("index.php") . "</script>";
    break;
  case 'odrdel':
    $post['del'][] = $_GET['id'];
    delete($post, "q4t8_order");
    plo("admin.php?redo=order");
    break;
  case 'memmdy':
    update($_POST, "q4t9_user");
    plo('admin.php?do=admin&redo=mem');
    break;
  case 'memdel':
    $post['del'][] = $_GET['id'];
    delete($post, "q4t9_user");
    plo("admin.php?redo=mem");
    break;
  case 'bot':
    update($_POST, "q4t11_footer");
    plo("admin.php?redo=bot");
    break;
}
