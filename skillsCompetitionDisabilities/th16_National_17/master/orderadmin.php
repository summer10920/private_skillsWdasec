<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">訂單查詢</span>
  </div>
  <input type="text" class="form-control" id="odrsearch">
  <div class="input-group-append">
    <!-- <button class="btn btn-outline-secondary" type="button">Button</button>
    <button class="btn btn-outline-secondary" type="button">Button</button> -->
  </div>
</div>
<?php
if (empty($_GET['id'])) { //show list mode
  $sql = "SELECT * FROM th16_odr WHERE 1 order by id desc";
  $rows = $db->query($sql)->fetchAll();
  $pse = $db->query("SELECT * FROM th16_setting WHERE 1")->fetch();
  foreach ($rows as $row) {
    ?>
    <div class="card bg-light container">
      <div class="card-header row">
        <div class="col">訂房編號：<span class="keyword"><?= str_pad($row['id'], 6, '0', STR_PAD_LEFT) ?></span></div>
        <div>
          <!-- Button trigger modal -->
          <a class="btn btn-info" href="?do=orderadmin&id=<?= $row['id'] ?>">修改</a>
          <a class="btn btn-danger" href="api.php?do=odrdel&id=<?= $row['id'] ?>">刪除</a>
        </div>
      </div>
      <div class="card-body row">
        <div class="col">
          訂房日期：</b><?= $row['checkin'] ?> ~ <?= $row['checkout'] ?><br>
          姓名：<?= $row['who'] ?><br>
          電話：<?= $row['tel'] ?><br>
          地址：<?= $row['addr'] ?><br>
          備註：<?= $row['says'] ?>
        </div>
        <div class="col">
          房型類別：<?= $roomname[$row['roomtype']] ?><br>
          房間數量：<?= $row['num'] ?><br>
          訂房金額：<?= $row['price'] ?><br>
          訂金金額：</b>$<?= $row['price'] * $pse['pse'] / 100 ?> (<?= $pse['pse'] ?>%)<br>
          房間號碼：
          <?php
              foreach (unserialize($row['keynum']) as $value) echo '
      <span class="badge badge-dark">' . $value . '</span>';
              ?>
        </div>
      </div>
    </div>
  <?php
    }
    ?>
  <script>
    $("#odrsearch").on("input propertychange", function(){
      $(".card").hide();
      $(".keyword:contains("+$(this).val()+")").parents(".card").show();
    });
  </script>
<?php
} else { //modify mode to id
  $sql = "SELECT * FROM th16_odr WHERE id=" . $_GET['id'];
  $row = $db->query($sql)->fetch();
  ?>
  <form action="api.php?do=bookmdy&id=<?= $row['id'] ?>" method="post">
    <div class="card container">
      <div class="card-header row">
        <div class="col">訂房編號：<?= str_pad($row['id'], 6, '0', STR_PAD_LEFT) ?></div>
      </div>
      <div class="card-body row">
        <!-- now you need to copy book_step1.php & book_step2.php start , and need add default values for this order data-->
        <div class="col-3">
          房型選擇：
          <select class="form-control" name="room" onchange='$("input[name=checkin]").trigger("click");reloadNum();'>
            <?php foreach ($roomname as $key => $value) echo '<option value="' . $key . '" ' . ($key == $row['roomtype'] ? "selected" : "") . '>' . $value . '</option>'; ?>
          </select>
        </div>
        <div class="col-3">
          入住日期：
          <input type="text" class="form-control" name="checkin" value="<?= $row['checkin'] ?>" onclick="newcals(this)">
        </div>
        <div class="col-3">
          退房日期：
          <input type="text" class="form-control" name="checkout" value="<?= $row['checkout'] ?>" onclick="newcals(this)">
          </p>
        </div>
        <div class="col-3">
          房間數量：
          <select class="form-control" name="room_num">
            <option value="0">0</option>
          </select>
          </p>
        </div>
        <div class="col-12">
          <hr>
        </div>
        <div class="form-group col-4">
          <p>
            姓名：
            <input type="text" class="form-control" required name="who" value="<?= $row['who'] ?>">
          </p>
          <p>
            電話：
            <input type="text" class="form-control" required pattern="[0-9\-]{9,12}" name="tel" value="<?= $row['tel'] ?>">
          </p>
        </div>
        <div class="form-group offset-2 col-6">
          <p>
            地址：
            <input type="text" class="form-control" required name="addr" value="<?= $row['addr'] ?>">
          </p>
          <p>
            備註：
            <input type="text" class="form-control" name="says" value="<?= $row['says'] ?>">
          </p>
        </div>
        <div class="text-center col-12">
          <button type="submit" class="btn btn-primary">修改確定</button>
        </div>


        <!-- Modal cals-->
        <section class="modal fade" id="popcals" method="post">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
              <div class="modal-header justify-content-center h3"></div>
              <div class="modal-body"></div>
            </div>
          </div>
        </section>

        <script>
          function newcals(getym) {
            let data = {
              y: $(getym).val().split("-")[0],
              m: $(getym).val().split("-")[1],
              mode: $(getym).attr("name"),
              room: $("select[name=room]").val(),
              checkinDate: $("input[name=checkin]").val(),
              odrin: "<?= $row['checkin'] ?>",
              odrout: "<?= $row['checkout'] ?>",
              odrnum: <?= $row['num'] ?>,
              odrtype: "<?= $row['roomtype'] ?>"
            };

            //生成cals
            $.get("api.php?do=calmakeKeepOld", data, function(re) {
              $('#popcals .modal-body').html(re);
              $('#popcals .modal-header').html((data.mode == 'checkin') ? "入住日期" : "退房日期");
              $('#popcals').modal('show');

              //宣告所有日子的td按鈕觸發
              $("td:not(.disabled)").click(function() { //this= all td
                $("input[name=" + data.mode + "]").val($(this).find(".d-none").html());
                if (data.mode == "checkin") $("input[name=checkout]").trigger("click");
                else $('#popcals').modal('hide');
                reloadNum();
              });
            });
          }
          // add locknum for this module
          function reloadNum(act) {
            let data = {
              room: $("select[name=room]").val(),
              checkin: $("input[name=checkin]").val(),
              checkout: $("input[name=checkout]").val(),
              odrin: "<?= $row['checkin'] ?>",
              odrout: "<?= $row['checkout'] ?>",
              odrnum: <?= $row['num'] ?>,
              odrtype: "<?= $row['roomtype'] ?>",
              first: act
            }
            $.get("api.php?do=roomNumKeepOld", data, function(re) {
              $("select[name=room_num]").html(re);
            });
          }
          reloadNum(1);

          $("form").submit(() => {
            let msg = "";
            if ($("input[name=checkin]").val() >= $("input[name=checkout]").val()) msg += "退房日期不可早於入住日期！\n";
            if ($("select[name=room_num]").val() == 0) msg += "房間數不可為0或該期間內已無房可訂！\n";
            if (msg.length != 0) {
              alert(msg);
              return false;
            }
            // else alert("輸入正確!");
          });
        </script>
        <!-- now you need to copy book_step1.php & book_step2.php end , and need add default values for this order data-->
      </div>
    </div>
  </form>
<?php
}
?>