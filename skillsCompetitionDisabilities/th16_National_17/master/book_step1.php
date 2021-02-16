<div class="col">
  房型選擇：
  <select class="form-control" name="room" onchange='$("input[name=checkin]").trigger("click");reloadNum();'>
    <?php foreach ($roomname as $key => $value) echo '<option value="' . $key . '">' . $value . '</option>'; ?>
  </select>
</div>
<div class="col">
  入住日期：
  <input type="text" class="form-control" name="checkin" value="<?= date("Y-m-d") ?>" onclick="newcals(this)">
</div>
<div class="col">
  退房日期：
  <input type="text" class="form-control" name="checkout" value="<?= date("Y-m-d", strtotime("+1 days")) ?>" onclick="newcals(this)">
  </p>
</div>
<div class="col">
  房間數量：
  <select class="form-control" name="room_num">
    <option value="0">0</option>
  </select>
  </p>
</div>
<div class="text-center col-12">
  <button type="submit" class="btn btn-primary">下一步</button>
</div>


<!-- Modal cals-->
<section class="modal fade" id="popcals" method="post">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header justify-content-center h3">
      </div>
      <div class="modal-body">
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
      </div> -->
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
      checkinDate: $("input[name=checkin]").val()
    };

    //生成cals
    $.get("api.php?do=calmake", data, function(re) {
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

  function reloadNum() {
    let data = {
      room: $("select[name=room]").val(),
      checkin: $("input[name=checkin]").val(),
      checkout: $("input[name=checkout]").val()
    }
    $.get("api.php?do=roomreloadnum", data, function(re) {
      $("select[name=room_num]").html(re);
    });
  }
  reloadNum();

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