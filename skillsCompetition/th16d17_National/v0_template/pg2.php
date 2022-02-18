<form action="booking3.php">
    <div class="card shadow my-3 mx-auto text-center px-5 py-3">
      <p class="text-left">
        步驟1 \ <span class="text-info">步驟2</span> \ 步驟3
      </p>
      <div class="row my-3">
        <div class="col-6"><input type='text' class="w-100" placeholder="訪客姓名" ></div>
        <div class="col-6"><input type='text' class="w-100" placeholder="連絡電話" required pattern=[0-9,-]{9,12}></div>
        <div class="col-12 mt-3"><input type='text' class="w-100" placeholder="住址" ></div>
      </div>
      <div class="mx-auto">
        <input class="btn btn-info" type="button" value="上一步" onclick="history.go(-1)">
        <!-- <input class="btn btn-info" type="submit" value="下一步"> -->
        <a class="btn btn-info" href="?pg=booking&step=pg3">下一步</a>
      </div>
    </div>
</form>