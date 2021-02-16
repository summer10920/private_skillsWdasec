<div class="card bg-light text-center">
  <div class="card-header">
    房型選擇：
    <select name="room" onchange="pricecals('<?=date('Y-m-d')?>')">
      <?php foreach ($roomname as $key => $value) echo '<option value="' . $key . '">' . $value . '</option>'; ?>
    </select>
  </div>
  <form action="api.php?do=pricemdy" method="post">
    <div class="card-body row">
      <div class="col-12">
        BB
      </div>
      <div class="text-center col-12">
        <button type="submit" class="btn btn-primary">修改</button>
      </div>

    </div>
  </form>
</div>


<script>
  pricecals('<?=date('Y-m-d')?>'); //run 1st
  function pricecals(getym) {
    let data = {
      y: getym.split("-")[0],
      m: getym.split("-")[1],
      room: $("select[name=room]").val(),
    };
    //生成cals
    $.get("api.php?do=pricemake", data, function(re) {
      $('.card-body').children().eq(0).html(re);
      /*
      $('#popcals .modal-header').html((data.mode == 'checkin') ? "入住日期" : "退房日期");
      $('#popcals').modal('show');

      //宣告所有日子的td按鈕觸發
      $("td:not(.disabled)").click(function() { //this= all td
        $("input[name=" + data.mode + "]").val($(this).find(".d-none").html());
        if (data.mode == "checkin") $("input[name=checkout]").trigger("click");
        else $('#popcals').modal('hide');
        reloadNum();
      });
       */
    });
  }
</script>