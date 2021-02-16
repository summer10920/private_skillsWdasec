<form action="api.php?do=order" method="post">
  <?php
  //Array ( [mm] => 電影名稱A [dd] => 2019-11-17 [tt] => 0 )
  $re = select("q3t8_book", "movie='" . $_POST['mm'] . "' and date='" . $_POST['dd'] . "' and time=" . $_POST['tt']); //找出這個場次的販售狀況
  $set = array();
  foreach ($re as $row)
   $set = array_merge($set, unserialize($row['seat'])); //將所有該時段的多筆座位陣列都倒入到一個新陣列紀載所有已賣之座位表

  for ($i = 1; $i < 21; $i++) {
    if (in_array($i, $set)) echo '<img src="img/03D03.png" style="padding-right:30px">';
    else echo '
    <img src="img/03D02.png" alt="">
    <input class="seat" type="checkbox" name="ss[]" value="' . $i . '">
  ';
    if ($i % 5 == 0) echo '<br>';
  }
  ?>
  <hr>
  <input type="hidden" name="movie" value="<?= $_POST['mm'] ?>">
  <input type="hidden" name="date" value="<?= $_POST['dd'] ?>">
  <input type="hidden" name="time" value="<?= $_POST['tt'] ?>">
  您選擇的電影是：<?= $_POST['mm'] ?><br>
  您選擇的時刻是：<?= $_POST['dd'] ?> <?= $seat[$_POST['tt']] ?><br>
  
  您勾選了<span id=nn>0</span>張票，最多可購買4張票<br>
  <input type="button" value="上一步" onclick="window.close()"> <input type="submit" value="確定">
</form>

<script>
num=0;
$(".seat").click(function(){
    if(this.checked) //目前是選取狀態 (滑鼠事件之後)
        (num<4)?num++:this.checked=false;
    else num--;  //目前是未選取狀態 (滑鼠事件之後)
    $("#nn").text(num);
});
</script>
