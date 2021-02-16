<?php
session_start(); //open session
//SQL 連結 PDO 物件
$db = new PDO("mysql:host=127.0.0.1;dbname=db00;charset=utf8", "b17300user", "b17300user", null);
date_default_timezone_set('Asia/Taipei'); //修正時區

//select SQL
function select($tb, $wh)
{  //提供資料表名稱跟條件，我能操作 SQL-Select 回傳
  global $db;
  return $db->query("SELECT * FROM " . $tb . " WHERE " . $wh)->fetchAll();
}

//insert SQL
function insert($ary, $tb)
{ //若給我資料跟資料表名稱，我自動的新增一筆資料
  global $db;
  $field = "id";
  $data = "null";
  foreach ($ary as $key => $value) {
    $field .= "," . $key;
    $data .= ",'" . $value . "'";
  }
  $db->query("INSERT INTO " . $tb . "(" . $field . ") VALUES (" . $data . ")");
  return $db->lastInsertId(); //取得剛剛新增的索引
}

//update SQL
function update($ary, $tb)
{
  global $db;
  foreach ($ary as $do => $data) {
    switch ($do) {
      case 'num+1': //如果陣列 key 是 num+1，對 value(id 值） 做 num+1
        $db->query("UPDATE " . $tb . " SET num=num+1 WHERE id=" . $data);
        break;
      case 'num-1': //如果陣列 key 是 num-1，對 value(id 值） 做 num-1
        $db->query("UPDATE " . $tb . " SET num=num-1 WHERE id=" . $data);
        break;
      default: //多組批次更新，key = id，暴力的一次只更新 1 個欄位
        foreach ($data as $key => $value)
          $db->query("UPDATE " . $tb . " SET " . $do . "='" . $value . "' WHERE id=" . $key);
        break;
    }
  }
}

//delete SQL 
function delete($ary, $tb)
{
  global $db;
  foreach ($ary as $do => $data) {
    switch ($do) {
      case 'del': //多筆刪除，前端 $_POST['del'][5]=這個 POST 陣列裡面有 del 這個維度陣列
        foreach ($data as $value)
          $db->query("DELETE FROM " . $tb . " WHERE id=" . $value);
        break;
      case 'delwh': //依條件做特殊狀況刪除
        $db->query("DELETE FROM " . $tb . " WHERE " . $data);
        break;
    }
  }
}

//php 轉址
function plo($link)
{
  return header("location:" . $link);
}

//JS 轉址
function jlo($link)
{
  return "location.href='" . $link . "'";
}

//add file 單筆，不要整個$_FILES 丟過來
function addfile($file)
{
  $newname = time() . "_" . $file['name'];
  copy($file['tmp_name'], "img/" . $newname);
  return $newname;
}

//分頁導覽
function navpage($tb, $wh, $range, $nowpage)
{
  $total = count(select($tb, $wh));
  $many = ceil($total / $range);
  $pg['<'] = ($nowpage == 1) ? $nowpage : $nowpage - 1;
  for ($i = 1; $i <= $many; $i++) $pg[$i] = $i;
  $pg['>'] = ($nowpage == $many) ? $many : $nowpage + 1;
  return $pg;
}

////////////////////////////////////////////// q1 need start

//t3
$re = select("q1t3_title", "dpy=1");
$t3_img = "img/" . $re[0]['img'];
$t3_text = $re[0]['text'];

//t4
$re = select("q1t4_maqe", "dpy=1");
$t4_text = "";
foreach ($re as $data) $t4_text .= $data['text'] . "　　";

//t5
$re = select("q1t5_mvim", "dpy=1");
foreach ($re as $data) $t5_ary[] = "img/" . $data['text'];

//t6
$re = select("q1t6_img", "dpy=1");
$t6_many = count($re);
$t6_text = "";
foreach ($re as $key => $value) $t6_text .= '<img src="img/' . $value['text'] . '" class="im" id="ssaa' . $key . '" width="150" height="103"/>';

//t7
if (empty($_SESSION['visit'])) {
  $_SESSION['visit'] = "check";
  $post['num+1'] = 1;
  update($post, "q1t7_total");
} //先判斷是否更新，之後才撈取
$re = select("q1t7_total", 1);
$t7_text = $re[0]['num'];

//t8
$re = select("q1t8_footer", 1);
$t8_text = $re[0]['text'];

//t9

//for index.php
$re = select("q1t9_news", "dpy=1");
$t9_more = (count($re) > 5) ? '<a style="float:right" href="news.php">More..</a>' : '';
$re = select("q1t9_news", "dpy=1 limit 5");
$t9_text = "";
foreach ($re as $data)
  $t9_text .= '<li>' . mb_substr($data['text'], 0, 20) . '<span class="all" style="display:none">' . $data['text'] . '</span></li>';

//for news.php
$nowpage = (empty($_GET['page'])) ? 1 : $_GET['page'];
$t9_begin = ($nowpage - 1) * 5;
$re = select("q1t9_news", "dpy=1 limit " . $t9_begin . ",5");
$t9_list = "";
foreach ($re as $data)
  $t9_list .= '<li>' . mb_substr($data['text'], 0, 20) . '<span class="all" style="display:none">' . $data['text'] . '</span></li>';

//for news.php pagenav
$re = navpage("q1t9_news", "dpy=1", 5, $nowpage);
$t9_page = "";
foreach ($re as $key => $value)
  $t9_page .= '<a class="bl" style="font-size:' . (($nowpage == $key) ? "60" : "30") . 'px;" href="?page=' . $value . '">' . $key . '</a>';

//t12
$t12_text = "";
$re1 = select("q1t12_menu", "fa=0 and dpy=1");
foreach ($re1 as $fa) {
  $t12_text .= '
    <a style="color:#000; font-size:13px; text-decoration:none;" href="' . $fa['link'] . '">
      <div class="mainmu">
        <span>' . $fa['text'] . '</span>
  ';
  $re2 = select("q1t12_menu", "fa=" . $fa['id']);
  foreach ($re2 as $son) {
    $t12_text .= '
        <div class="mw mainmu2" style="display:none">
          <a style="color:#000; font-size:13px; text-decoration:none;" href="' . $son['link'] . '">' . $son['text'] . '</a>
        </div>
    ';
  }
  $t12_text .= '
      </div>
    </a>
  ';
}
