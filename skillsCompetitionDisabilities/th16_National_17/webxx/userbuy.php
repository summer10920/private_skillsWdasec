<div class="container mb-7">
<p class="my-3 text-warning"><a href="admin.php">後台</a> > <span>訂單管理</span></p><h3 class="text-center text-warning">訂單管理</h3>
<div class="card shadow my-3 mx-auto text-center px-5 py-3">

<div class="my-3">

	<table border="1" class="table table-hover">
		<thead class="thead-dark">
			<tr class="h-50">
				<th>訂房編號</th>
				<th>姓名</th>
                <!-- <th>電話</th> -->
				<!-- <th>地址</th> -->
				<!-- <th>房型</th>
				<th>房號</th>
				<th>房數</th> -->
				<th>入住日期</th>
				<!-- <th>退房日期</th> -->
				<th>總金額</th>
				<th>訂金</th>
				 <th>操作</th> 
			</tr>
		</thead>
		<tr>
			<td>g00001</td>
			<td>nick</td>
			<!-- <td>091234567</td>
			<td>新北市太山區明志路三段149巷17號10樓</td>
			<td>總統套房</td>
			<td>001<br>002<br>003</td>
			<td>3</td> -->
			<td>2020/01/12</td>
			<!-- <td>2020/01/13</td> -->
			<td>$15000</td>
			<td>$5000</td>
			 <td>
			 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#abc123">
  				修改
			</button>
                <buttom class="btn btn-danger btn-sm">刪除</buttom>
            </td> 
		</tr>
		<tr>
			<td>g00002</td>
			<td>nick</td>
			<!-- <td>091234567</td>
			<td>新北市太山區明志路三段149巷17號10樓</td>
			<td>總統套房</td>
			<td>001<br>002<br>003</td>
			<td>3</td> -->
			<td>2020/01/12</td>
			<!-- <td>2020/01/13</td> -->
			<td>$15000</td>
			<td>$5000</td>
			 <td>
			 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#abc123">
  				修改
			</button>
                <buttom class="btn btn-danger btn-sm">刪除</buttom>
            </td> 
		</tr>
	</tbody></table>
</div>

</div>
</div>




<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  確定訂單
</button> -->
<div class="modal fade" id="abc123" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
    
      <div class="modal-body text-left">
      <h3>修改訂單</h3>
	  <form>
      <!-- <p>(1) 訂房編號</p>
					<p>(2) 訂房日期 <input type="text" name="" id="">  </p>
					<p>(3) 房號<input type="text" name="" id=""></p>
					<p>(4) 訂房總金額<input type="text" name="" id=""></p>
					<p>(5) 需繳交訂金<input type="text" name="" id=""></p> -->
					<!-- table#loki>(tr.max>td*2)*10 -->



<table class="table">
	<tr>
		<td>訂房編號：</td>
		<td>g001</td>
	</tr>
	<tr>
		<td>姓名：</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>電話：</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>地址：</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>房型：</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>房號：</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>房數：</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>入住日期：</td>
		<td><input type="date" name="" id=""></td>
	</tr>
	<tr>
		<td>退房日期：</td>
		<td><input type="date" name="" id=""></td>
	</tr>
	<tr>
		<td>總金額：</td>
		<td><input type="number" name="" id=""></td>
	</tr>
	<tr>
		<td>訂金：</td>
		<td>5000</td>
	</tr>
</table>


</form>
      </div>
      <div class="modal-footer">
     
        <button type="button" class="btn btn-secondary" onclick="location.href='admin.php?pg=userbuy'">確定</button>
      </div>
    </div>
  </div>
</div>


<!--
步驟 3 完成訂單，確認訂房資訊-日期、房間數及
連絡方式(姓名、電話及住址)
2
10
確認訂房後能顯示下列資訊：
(1) 訂房編號
(2) 訂房日期
(3) 房號(系統自動給定)
(4) 訂房總金額
(5) 需繳交訂金
-->