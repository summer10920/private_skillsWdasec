<?php
// $_SESSION['checkcode'] = "";
// for ($i = 0; $i < 4; $i++) $_SESSION['checkcode'] .= $codestr[rand(0, strlen($codestr) - 1)];
?>
<div class="row justify-content-center">
  <div class="card bg-light mb-5" style="width:auto">
    <!-- <div class="card-header">Header</div> -->
    <div class="card-body">
      <form action="api.php">
        <input type="hidden" name="do" value="login">
        <div class="form-group card-title">
          帳號：
          <input type="text" class="form-control" required>
        </div>
        <div class="form-group">
          密碼：
          <input type="password" class="form-control" required>
        </div>
        <div class="form-group">
          驗證碼：<img id="codeimg" src="#" class="m-1" /><input type="button" value="點擊更換" />
          <input type="code" class="form-control" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">登入</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  var anscode;
  $.get("api.php", {do: "codechg"}, function(re) {
    $("#codeimg").attr("src", "api.php?do=codeget");
    anscode = re;
  });

  $("form").submit(() => {
    let msg = "";
    if ($("input[type=code]").val() != anscode) msg += "驗證碼輸入錯誤！\n";
    if ($("input[type=text]").val() != "admin" || $("input[type=password]").val() != "1234") msg += "帳密輸入錯誤！\n";
    if (msg.length != 0) {
      alert(msg);
      return false;
    } else alert("輸入正確!");
  });

  $("input[type=button]").click(() => {
    $.get("api.php", {
      do: "codechg"
    }, function(re) {
      $("#codeimg").attr("src", "api.php?do=codeget");
      anscode = re;
    });
  });
</script>