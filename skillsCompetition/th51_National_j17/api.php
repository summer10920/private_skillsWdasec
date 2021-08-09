<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=th51_n;charset=utf8', 'root', '');
$pathFile = function () {
  if (!$_FILES['img']['error']) {
    $newname = time() . "_" . $_FILES['img']['name'];
    copy($_FILES['img']['tmp_name'], "media/" . $newname);
    return $newname;
  } else return false;
};

switch ($_GET['do']) {
  case 'msgall':
    $rows = $db->query("SELECT * FROM msg ORDER BY tag DESC,cdate DESC")->fetchAll();
    foreach ($rows as $row) {
      echo '
        <div class="item">
          ' . ($row['tag'] ? '<div class="top fc">TOP</div>' : '') . '
          <div class="data fc">
            <img name="img" src="/media/' . $row['img'] . '" class="' . ($row['del'] || !$row['img'] ? 'dn' : '') . '">
            <h5 title="旅客名稱" name="user">' . $row['user'] . '</h5>
            <i name="showtel" data-txt="旅客連絡電話：' . $row['tel'] . '" class="fa fa-phone pop ' . ($row['del'] || !$row['showtel'] ? 'dn' : '') . '"></i>
            <input type="hidden" name="tel" value="' . $row['tel'] . '">
            <i name="showmail" data-txt="旅客電子信箱：' . $row['mail'] . '" class="fa fa-envelope pop ' . ($row['del'] || !$row['showmail'] ? 'dn' : '') . '"></i>
            <input type="hidden" name="mail" value="' . $row['mail'] . '">
          </div>
          <div class="line"></div>
          <div class="words">
            <small>發表於:' . $row['cdate'] . '</small>
            ' . ($row['mdate'] != null ? '<small>' . ($row['del'] ? "刪除" : "修改") . '於:' . $row['mdate'] . '</small>' : '') . '
            ' . ($row['del'] ? '<p class="remove">**本文作者已自行刪除內容，再也看不到了**</p>' : '<p name="info">' . $row['info'] . '</p>') . '
            ' . (!$row['del'] && $row['reply'] ? '<div name="reply" class="reply">' . $row['reply'] . '</div>' : '') . '
            </div>
          ' . (!$row['del'] ? '<label class="ctl">
          <i class="fa fa-pen-square fa-fw"></i>
          <input type="hidden" name="pwd" value="' . $row['pwd'] . '">
          <input placeholder="輸入序號" type="number" name="chk">
          <div class="fn">
            <input type="hidden" name="id" value="' . $row['id'] . '">
            <button class="mdy" onclick="msgmdy(this)">修改</button>
            <button class="del" onclick="msgdel(this)">刪除</button>
          </div>
        </label>' : '') . '
        </div>
      ';
    }
    break;
  case 'msgallAdm':
    $rows = $db->query("SELECT * FROM msg ORDER BY tag DESC,cdate DESC")->fetchAll();
    foreach ($rows as $row) {
      echo '
        <div class="item">
          ' . ($row['tag'] ? '<div class="top fc">TOP</div>' : '') . '
          <div class="data fc">
            <img name="img" src="/media/' . $row['img'] . '" class="' . ($row['del'] || !$row['img'] ? 'dn' : '') . '">
            <h5 title="旅客名稱" name="user">' . $row['user'] . '</h5>
            <i name="showtel" data-txt="旅客連絡電話：' . $row['tel'] . '" class="fa fa-phone pop ' . ($row['del'] || !$row['showtel'] ? 'dn' : '') . '"></i>
            <input type="hidden" name="tel" value="' . $row['tel'] . '">
            <i name="showmail" data-txt="旅客電子信箱：' . $row['mail'] . '" class="fa fa-envelope pop ' . ($row['del'] || !$row['showmail'] ? 'dn' : '') . '"></i>
            <input type="hidden" name="mail" value="' . $row['mail'] . '">
          </div>
          <div class="line"></div>
          <div class="words">
          <small>發表於:' . $row['cdate'] . '</small>
            ' . ($row['mdate'] != null ? '<small>' . ($row['del'] ? "刪除" : "修改") . '於:' . $row['mdate'] . '</small>' : '') . '
            ' . ($row['del'] ? '<p class="remove">**本文作者已自行刪除內容，再也看不到了**</p>' : '<p name="info">' . $row['info'] . '</p>') . '
            ' . (!$row['del'] && $row['reply'] ? '<div name="reply" class="reply">' . $row['reply'] . '</div>' : '') . '
            </div>
          <label class="ctl">
            <i class="fa fa-pen-square fa-fw"></i>
            <input type="hidden" name="pwd" value="' . $row['pwd'] . '">
            <div class="fn">
              <input type="hidden" name="id" value="' . $row['id'] . '">
              <button class="top" onclick="msgtop(this)">至頂</button>
              ' . (!$row['del'] ? '<button class="mdy" onclick="msgmdyAdm(this)">修改</button>' : '') . '
              <button class="del" onclick="msgkill(this)">刪文</button>
            </div>
          </label>
        </div>
      ';
    }
    break;
  case 'msgadd':
    echo $sql = "INSERT INTO msg VALUES(
      null,
      '" . $_POST['user'] . "',
      '" . $_POST['pwd'] . "',
      '" . $_POST['tel'] . "',
      '" . $_POST['mail'] . "',
      '" . ($pathFile() ? $pathFile() : '') . "',
      '" . $_POST['info'] . "',
      " . $_POST['showtel'] . ",
      " . $_POST['showmail'] . ",
      NOW(),
      NULL,
      '',
      0,
      0
    )";
    $db->query($sql);
    break;
  case 'msgmdy':
    echo $sql = "UPDATE msg SET 
    user='" . $_POST['user'] . "',
    pwd='" . $_POST['pwd'] . "',
    tel='" . $_POST['tel'] . "',
    mail='" . $_POST['mail'] . "',
    " . ($pathFile() ? "img='" . $pathFile() . "'," : '') . "
    info='" . $_POST['info'] . "',
    showtel=" . $_POST['showtel'] . ",
    showmail=" . $_POST['showmail'] . ",
    mdate=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    break;
  case 'msgmdyAdm':
    echo $sql = "UPDATE msg SET 
    user='" . $_POST['user'] . "',
    pwd='" . $_POST['pwd'] . "',
    tel='" . $_POST['tel'] . "',
    mail='" . $_POST['mail'] . "',
    " . ($pathFile() ? "img='" . $pathFile() . "'," : '') . "
    info='" . $_POST['info'] . "',
    showtel=" . $_POST['showtel'] . ",
    showmail=" . $_POST['showmail'] . ",
    reply='" . $_POST['reply'] . "',
    mdate=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    break;
  case 'msgdel':
    echo $sql = "UPDATE msg SET 
    del=1, 
    mdate=NOW() WHERE id=" . $_POST['id'];
    $db->query($sql);
    break;
  case 'msgkill':
    echo $sql = "DELETE FROM `msg` WHERE id=" . $_POST['id'];
    $db->query($sql);
    break;
  case 'msgtop':
    echo $sql = "UPDATE msg SET tag=" . $_POST['tag'] . " WHERE id=" . $_POST['id'];
    $db->query($sql);
    break;
  case 'teamallAdm':
    $rows = $db->query("SELECT * FROM team WHERE tag!=0 ORDER BY tag DESC")->fetchAll();
    foreach ($rows as $key => $row) {
      if (!($key % 2)) {
        $cache = '
        <input type="hidden" name="tag" value="' . $row['tag'] . '">
        <div class="data fc">
          <img src="/media/' . $row['img'] . '">
          
          <h5 title="旅客名稱">' . $row['user'] . '</h5>
          <i class="fa fa-phone pop" data-txt="旅客連絡電話：' . $row['tel'] . '"></i>
          <i class="fa fa-envelope pop" data-txt="旅客電子信箱：' . $row['tel'] . '"></i>
        </div>
        ';
      } else {
        $cache .= '
        <div class="data fc">
          <img src="/media/' . $row['img'] . '">
          <h5 title="旅客名稱">' . $row['user'] . '</h5>
          <i class="fa fa-phone pop" data-txt="旅客連絡電話：' . $row['tel'] . '"></i>
          <i class="fa fa-envelope pop" data-txt="旅客電子信箱：' . $row['tel'] . '"></i>
        </div>
        ';
        echo '
        <div class="col">
          <div class="item">
            ' . $cache . '
            <button class="ctl" onclick="teambreak(this)">解除配對</button>
          </div>
        </div>
        ';
      }
    }
    $rows = $db->query("SELECT * FROM team WHERE tag=0 ORDER BY tag DESC")->fetchAll();
    $cache = '';
    foreach ($rows as $row) {
      $cache .= '
        <div class="data fc">
          <img src="/media/' . $row['img'] . '">
          <h5 title="旅客名稱">' . $row['user'] . '</h5>
          <i class="fa fa-phone pop" data-txt="旅客連絡電話：' . $row['tel'] . '"></i>
          <i class="fa fa-envelope pop" data-txt="旅客電子信箱：' . $row['tel'] . '"></i>
        </div>
        ';
    }
    echo '
      <div class="col">
        <div class="item">
          ' . $cache . '
          <button class="ctl" onclick="teamrand()">隨機配對</button>
        </div>
      </div>
      ';
    break;
  case 'teamall':
    $rows = $db->query("SELECT * FROM team WHERE tag!=0 ORDER BY tag DESC")->fetchAll();
    foreach ($rows as $key => $row) {
      if (!($key % 2)) {
        $cache = '
        <div class="data fc">
          <img src="/media/' . $row['img'] . '">
          
          <h5 title="旅客名稱">' . $row['user'] . '</h5>
          <i class="fa fa-phone pop" data-txt="旅客連絡電話：' . $row['tel'] . '"></i>
          <i class="fa fa-envelope pop" data-txt="旅客電子信箱：' . $row['tel'] . '"></i>
        </div>
        ';
      } else {
        $cache .= '
        <div class="data fc">
          <img src="/media/' . $row['img'] . '">
          <h5 title="旅客名稱">' . $row['user'] . '</h5>
          <i class="fa fa-phone pop" data-txt="旅客連絡電話：' . $row['tel'] . '"></i>
          <i class="fa fa-envelope pop" data-txt="旅客電子信箱：' . $row['tel'] . '"></i>
        </div>
        ';
        echo '
        <div class="col">
          <div class="item">
            ' . $cache . '
          </div>
        </div>
        ';
      }
    }
    $rows = $db->query("SELECT * FROM team WHERE tag=0 ORDER BY tag DESC")->fetchAll();
    $cache = '';
    foreach ($rows as $row) {
      $cache .= '
        <div class="data fc">
          <img src="/media/' . $row['img'] . '">
          <h5 title="旅客名稱">' . $row['user'] . '</h5>
          <i class="fa fa-phone pop" data-txt="旅客連絡電話：' . $row['tel'] . '"></i>
          <i class="fa fa-envelope pop" data-txt="旅客電子信箱：' . $row['tel'] . '"></i>
        </div>
        ';
    }
    echo '
      <div class="col">
        <div class="item">
          ' . $cache . '
        </div>
      </div>
      ';
    break;
  case 'teambreak':
    echo $sql = "UPDATE team SET tag=0 WHERE tag=" . $_POST['tag'];
    $db->query($sql);
    break;
  case 'teamrand':
    $rows = $db->query("SELECT * FROM team WHERE tag=0 ORDER BY tag DESC")->fetchAll();

    $idlist = array_column($rows, 'id');
    $sql = '';

    while (count($idlist) > 1) {
      $user1 = array_splice($idlist, array_rand($idlist), 1)[0];
      $user2 = array_splice($idlist, array_rand($idlist), 1)[0];
      $sql .= "UPDATE team SET tag=" . $user1 . " WHERE id=" . $user1 . " OR id=" . $user2 . ";";
    }
    $db->query($sql);
    break;
  case 'teamadd':
    echo $sql = "INSERT INTO team VALUES(
      null,
      '" . $_POST['user'] . "',
      '" . $_POST['tel'] . "',
      '" . $_POST['mail'] . "',
      '" . ($pathFile() ? $pathFile() : '') . "',
      0
    )";
    $db->query($sql);
    break;
}
