<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div id="abgne-block-20111227">
      <ul class="lists" style="height:300px;position: absolute;left: 80px;">
        <img id="simg" src="" style="height:90%;width:auto">
        <div id="stxt" class=ct></div>
      </ul>
      <ul class="controls" style="height:100px">
        <img src="img/left.jpg" style="padding:40px 0" onclick="pp(1)">
        <?php
        $re = select("q3t5_img", "dpy=1 order by odr");
        $num = count($re);
        $i = 0;
        foreach ($re as $ro) {
          echo '<img class="im" id="ssaa' . $i . '" onclick="ani(' . $i . ')" style="height:100%" src="upload/' . $ro['img'] . '" alt="' . $ro['text'] . '">';
          $i++;
        }
        ?>
        <img onclick="pp(2)" src="img/right.jpg" style="padding:40px 0">
      </ul>
      <script>
        ///////////////////////////////////////////////////////////////////////按鈕觸發 START
        var nowpage = 0,
          num = <?= $num ?>; //num=6
        function pp(x) {
          var s, t;
          if (x == 1 && nowpage - 1 >= 0) nowpage--;
          if (x == 2 && (nowpage + 1) <= num - 4) nowpage++;

          $(".im").hide(); //all hide

          $("#ssaa" + (nowpage)).show(); //show img one
          $("#ssaa" + (nowpage + 1)).show(); //show img two
          $("#ssaa" + (nowpage + 2)).show(); //show img three
          $("#ssaa" + (nowpage + 3)).show(); //show img four
        }
        pp(1);
        ///////////////////////////////////////////////////////////////////////按鈕觸發 END
        ///////////////////////////////////////////////////////////////////////動畫觸發 START
        function ani(id) { //從每個小圖案的onclick事件
          img = $("#ssaa" + id).attr("src"); //新圖(小)
          txt = $("#ssaa" + id).attr("alt"); //新字(小)
          //t5
          <?php
          $re = select("q3t5_effect", 1);
          $eft = $re[0]['once']; //get 1~3
          ?>
          switch (<?= $eft ?>) { //三種轉場特效 1~3
            case 1: // fade
              $(".lists").fadeToggle(function() { //離場
                $("#simg").attr("src", img); //展示區的圖設定為新圖(小)
                $("#stxt").text(txt); //展示區的字設定為新字(小)
                $(".lists").fadeToggle(); //入場
              });
              break;
            case 2: //slide
              $(".lists").slideToggle(function() {
                $("#simg").attr("src", img);
                $("#stxt").text(txt);
                $(".lists").slideToggle();
              });
              break;
            case 3:
              $(".lists").animate({
                left: "-400px"
              }, function() {
                $(".lists").css("left", "400px");
                $("#simg").attr("src", img);
                $("#stxt").text(txt);
                $(".lists").animate({
                  left: "80px"
                });
              });
              break;
          }
          run = id; //RUN必須是需要目前停留在哪裡
        }
        ///////////////////////////////////////////////////////////////////////動畫觸發 END
        ///////////////////////////////////////////////////////////////////////自動撥放 START
        function auto() { //run=0~5,num=6
          run = (run == (num - 1)) ? 0 : run + 1; //到最後了，回到run=0, run=0~5,每次近來FN都會+1
          ani(run);
        }
        ani(0);
        setInterval(auto, 3000);

        ///////////////////////////////////////////////////////////////////////自動撥放 END
      </script>
    </div>
  </div>
</div>
<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;">
    <table>
      <tr>
        <?php
        $nw = (empty($_GET['page'])) ? 1 : $_GET['page'];
        $ba = ($nw - 1) * 4;
        $re = select("q3t7_movie","'".$minday."'<=date and date<='".$today."' order by odr limit " . $ba . ",4");
        foreach ($re as $ro) {
          ?>
          <td width=210 style="float:left">
            <img src="upload/<?= $ro['img'] ?>" style="float:left;width:50px">
            <?= $ro['title'] ?><br>
            分級: <img src="img/<?= $ro['cls'] ?>.png" alt=""><br>
            上映日期: <?= $ro['date'] ?><br>
            <input type="button" value="劇情簡介" onclick="<?= jlo("?do=info&id=".$ro['id']) ?>">
            <input type="button" value="線上訂票" onclick="<?= jlo("order.php?do=step1&id=" . $ro['id']) ?>">
          </td>
        <?php
        }
        ?>
      </tr>
    </table>
    <div class="ct">
      <?php
      $pg = page("q3t7_movie", "'" . $minday . "'<=date and date<='" . $today . "' order by odr", 4, $nw);
      foreach ($pg as $key => $value) echo '<a href="?page=' . $value . '">' . $key . '</a>';
      ?>
    </div>
  </div>
</div>