$(document).ready(function () {
  $("body").append(`<button id="recovery">R</button><div id="gray"></div>`);
  $("#recovery").on("click", () => {
    $("#gray").fadeToggle(function () {
      let ans = confirm("如果測試資料太亂你可以選擇回溯到初始狀態。\n你是否要進行網站還原??");
      if (ans) {
        $.get("recovery/redb.php", function (re) {
          if (re == "success") {
            $("body").append(`<div id='loading'>正在努力還原網站資料...</div>`);
            $("#loading").fadeToggle();
            setTimeout(() => {
              location.reload();
            }, 5000);
          } else {
            alert("GG，操作失敗請洽作者反應！");
          }
        });
      } else {
        $(this).fadeToggle();
      }
    });
  });
});