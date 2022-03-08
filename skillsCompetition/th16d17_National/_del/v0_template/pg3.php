<div class="card shadow my-3 mx-auto text-center px-5 py-3">
      <p class="text-left">
        步驟1 \ 步驟2 \ <span class="text-info">步驟3</span>
      </p> 
		<!-- <form action="index.php"> -->
      <div class="jumbotron">
        <h3>確認訂房下列資訊</h3>
        <hr class="my-4">
        <div class="text-left">
					<p>(1) 訂房編號</p>
					<p>(2) 訂房日期  </p>
					<p>(3) 房號</p>
					<p>(4) 訂房總金額</p>
					<p>(5) 需繳交訂金</p>
        </div>
      </div>
      <div class="mx-auto">
				<input class="btn btn-info" type="button" value="上一步" onclick="history.go(-1)">
				<!-- <input class="btn btn-info" type="submit" value="完成訂單">
      </div> -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  確定訂單
</button>
<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
    
      <div class="modal-body text-left">
      <h3>恭喜訂房成功,以下是您的訂房資訊</h3>
      <p>(1) 訂房編號</p>
					<p>(2) 訂房日期  </p>
					<p>(3) 房號</p>
					<p>(4) 訂房總金額</p>
					<p>(5) 需繳交訂金</p>


      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">確定</button>
      </div>
    </div>
  </div>
</div>



    </div>
</form>