<form action="?do=step2" method="post" target="_black">
  電影: <select name="mm" id="sm" onchange="gd()">
    <?php
    $re = select("q3t7_movie", "'" . $minday . "'<=date and date<='" . $today . "'");
    foreach ($re as $ro) 
      echo '<option value="'.$ro['title'].'"'.((!empty($_GET['id'])&&$_GET['id']==$ro['id'])?"selected":"").'>'.$ro['title'].'</option>';
    ?>
  </select>
  日期: <select name="dd" id="sd" onchange="gt()">
  </select>
  場次: <select name="tt" id="st">
  </select><br><br>
  <input type="submit" value="確定"> <input type="reset" value="重置">
</form>


<script>
  // if ($("#sm").length > 0) gd(); //如果#sm有內容(selected)時 執行gd()
  gd(); //畫面生成時，刷一次日期表

  function gd() {
    title = $("#sm").val();
    $.post("api.php?do=gd", {
      title
    }, function(re) {
      $("#sd").html(re);
      gt(); //產生日期表後，刷一遍場次表
    });
  }

  function gt() {
    title = $("#sm").val();
    date = $("#sd").val();
    $.post("api.php?do=gt", {
      title,
      date
    }, function(re) {
      $("#st").html(re);
    });
  }

</script>