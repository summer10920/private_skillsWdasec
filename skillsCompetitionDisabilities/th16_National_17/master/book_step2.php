<div class="form-group col-4">
  <p>
    姓名：
    <input type="text" class="form-control" required name="who">
  </p>
  <p>
    電話：
    <input type="text" class="form-control" required pattern="[0-9\-]{9,12}" name="tel">
  </p>
</div>
<div class="form-group offset-2 col-6">
  <p>
    地址：
    <input type="text" class="form-control" required name="addr">
  </p>
  <p>
    備註：
    <input type="text" class="form-control" name="says">
  </p>
</div>
<div class="text-center col-12">
  <a href="?do=book&step=1" class="btn btn-secondary text-white">上一步</a>
  <button type="submit" class="btn btn-primary">下一步</button>
</div>