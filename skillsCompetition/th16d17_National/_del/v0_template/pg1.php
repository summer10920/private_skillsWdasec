 <form action="/index.php?pg=booking">
    <div class="card shadow my-3 mx-auto text-center px-5 py-3">
   
   <?php  
    $preoder='
      <form>
        <p>
          訂房訂金：<input type="text" value="30">％
          <button class="btn btn-info btn-sm">修改訂金</button>
        </p>
      </form>

    
    
    ';


   $str2= ( $_GET['title'] != 'input' )? '<p class="text-left"><span class="text-info">步驟1</span> \ 步驟2 \ 步驟3</p>':$preoder;
   
   ?>

    <!-- <p class="text-left">
        <span class="text-info">步驟1</span> \ 步驟2 \ 步驟3
      </p> -->
<?= $str2 ?>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">單人套房</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">雙人套房</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">多人套房</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><?php include('datelv1.php');?>  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?php include('datelv2.php');?>  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><?php include('datelv3.php');?>  </div>
</div>
      
      <!-- <p class="text-left">
        <span class="text-info">步驟1</span> \ 步驟2 \ 步驟3
      </p> -->
      
      
      <div class="mx-auto"> 
        <!-- <input class="btn btn-info" type="submit" value="下一步"> -->
        <a class="btn btn-info" href="?pg=booking&step=pg2">下一步</a>
      </div>
    </div>
</form> 