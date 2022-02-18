
<div class="container">
<p class="my-3 text-warning"><a href="index.php">首頁</a> > <span>訪客留言</span></p>
<h3 class="text-center text-warning">訪客留言版</h3>


<form action="">
    <div class="card shadow my-3 mx-auto text-center p-5">
        <div class="row my-3">
            <div class="col-4" ><input type='text' class="w-100" placeholder="訪客姓名" ></div>
            <div class="col-4" ><input type='email' class="w-100" placeholder="Email" ></div>
            <div class="col-4" ><input type='text' class="w-100" placeholder="連絡電話" required pattern=[0-9]{6,12}></div>
            <div class="col-12 mt-4"><textarea class="w-100" rows="5"  placeholder="留言內容"></textarea></div>
            <div class="mx-auto mt-3"><input class="btn btn-info" type="submit" value="送出"></div>
        </div>
    </div>
</form>


<div class="card shadow my-5 mx-auto text-center p-5">
<table class="table table-hover">
  <thead class='alert-warning'>
    <tr>
      <th scope="col">#</th>
      <th scope="col">訪客姓名</th>
      <th scope="col">留言內容</th>
      <th scope="col">Email</th>
      <th scope="col">連絡電話</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
</div>


 
</div>
</div>