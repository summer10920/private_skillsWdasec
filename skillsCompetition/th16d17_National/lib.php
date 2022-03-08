<?php
session_start();
date_default_timezone_set('Asia/Taipei');
$db=new PDO("mysql:host=localhost;dbname=skillsCompetition_th16d17_National;charset=utf8","skcomp_th16d17","skcomp_th16d17");

if(empty($_SESSION['mode'])) $_SESSION['mode']="user";

$codestr = "ABCDEFG123456789";

$mode=array(
  "user"=>array(
    "msg"=>"訪客留言",
    "book"=>"訪客訂房",
    "login"=>"網站管理"
  ),
  "admin"=>array(
    "msgadmin"=>"留言管理",
    "book"=>"後台訂房",
    "sell"=>"每日房價",
    "orderadmin"=>"訂單管理",
    "setting"=>"參數設定",
    "logout"=>"後台登出"
  )
);

$title=array(
  "user"=>array(
    "msg"=>"訪客留言",
    "book"=>"訪客訂房",
    "login"=>"網站管理登入"
  ),
  "admin"=>array(
    "msgadmin"=>"留言管理",
    "book"=>"後台訂房",
    "sell"=>"每日房價",
    "orderadmin"=>"訂單管理",
    "setting"=>"參數設定",
    "logout"=>"後台登出"
  )
);

$defaultDo=array(
  "user"=>"login",
  "admin"=>"book"
);


$steps=array("步驟1","步驟2","步驟3","完成訂房");

$roomprice=array("A"=>1000,"B"=>2000,"C"=>3000,"D"=>4000);
$roomtotal=array("A"=>10,"B"=>10,"C"=>10,"D"=>10);
$roomname=array("A"=>"A型房","B"=>"B型房","C"=>"C型房","D"=>"D型房");