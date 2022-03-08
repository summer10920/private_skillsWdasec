<div class="card bg-light">
  <div class="card-header">
    <nav class="navbar-expand">
      <div class="navbar-nav">
        訂房設定
      </div>
    </nav>
  </div>
  <form action="api.php?do=setting" method="post">
    <div class="card-body row">
      <div class="col-4">
          訂金比例：
          <div class="input-group">
            <?php $row=$db->query("SELECT * FROM th16_setting WHERE 1")->fetch(); ?>
            <input type="text" class="form-control" name="pse" value="<?= $row['pse'] ?>">
            <div class="input-group-append"><span class="input-group-text">%</span></div>
          </div>
        <br>
      </div>
      <div class="text-center col-12">
        <button type="submit" class="btn btn-primary">修改</button>
      </div>

    </div>
  </form>
</div>