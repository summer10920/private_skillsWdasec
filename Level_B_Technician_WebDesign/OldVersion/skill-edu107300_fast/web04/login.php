<h3>第一次登入</h3>
<a href="?do=reg"><img src="img/0413.jpg" alt=""></a>
<h3>會員登入</h3>
<form action="api.php?do=login" method="post" onsubmit="return check()">
  帳號: <input type="text" name="acc" id=""><br>
  密碼: <input type="text" name="pwd" id=""><br>
  驗證碼<?= $a1 ?>+<?= $a2 ?>= <input type="text" name="ans" id="">
  <input type="submit" value="登入">
</form>
<script>
  function check() {
    if ($("input[name=ans]").val() != <?= $ans ?>) {
      alert("對不起，您輸入的驗證碼有務請您重新輸入");
      return false;
    }
  }
</script>