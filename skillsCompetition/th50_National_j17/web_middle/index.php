<?php
include("api.php");
$_SESSION['rand'] = rand(1000, 9999);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>電競網站</title>
	<link rel="stylesheet" href="plugin/bootstrap.min.css">
	<link rel="stylesheet" href="plugin/style.css">
	<script src="plugin/jquery.min.js"></script>
	<script src="plugin/bootstrap.min.js"></script>
</head>

<body>
	<header class="row-fluid">
		<div class="span4">第46屆全國競賽電競遊 官方網站</div>
		<div class="span8"></div>
	</header>

	<nav class="navbar navbar-inverse">
		<div class="navbar-inner">
			<div class="container">
				<ul class="nav">
					<li><a href="#">回首頁</a></li>
					<li><a href="#msg">玩家留言板</a></li>
					<li><a href="#pklist">最新消息與賽制公告區塊</a></li>
					<li><a href="#pkadd" data-toggle="modal">玩家參賽</a></li>
					<li><a href="#login" data-toggle="modal">網站管理</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="ad">
		<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore dicta cum aperiam eius. Tempora quisquam odit ad
			in aliquam enim?</p>
	</section>

	<div id="msg"></div>
	<section class="container">
		<h2>玩家留言板</h2>
		<a href="#msgadd" class="btn btn-info" data-toggle="modal" style="float:right;">我要留言</a>
		<div style="clear: both;"></div>

		<?php
		$sql = "SELECT * FROM msg";
		$rows = $db->query($sql)->fetchAll();
		foreach ($rows as $row) {
			if ($row['del']) {
				//如果資料的del為1，輸出delete version
		?>
				<!-- run each del -->
				<div class="thumbnail row-fluid del">
					<div class="span2">#<?= $row['id'] ?></div>
					<div class="span10">本篇已被刪除</div>
				</div>

			<?php
			} else {
				//反之輸出ok version
			?>
				<!-- run each ok-->
				<div class="thumbnail row-fluid">
					<div class="span2">
						<img src="img/user.jpg" class="img-circle" width="100" height="100">
						<h4><?= $row['user'] ?></h4>
						<h5>#<span class="sn"><?= $row['id'] ?></span></h5>
					</div>
					<div class="span10">
						<p><?= $row['info'] ?></p>
						<div class="bottom">
							<span class="badge badge-info">
								TEL：
								<span class="tel"><?= $row['tel'] ?></span>
							</span>
							<span class="badge badge-info">
								MAIL：
								<span class="mail"><?= $row['mail'] ?></span>
							</span>
							<span class="badge badge-info">
								UPDATE：
								<span><?= $row['date'] ?></span>
							</span>
						</div>
					</div>
				</div>
		<?php
			}
		}
		?>
	</section>

	<div id="pklist"></div>
	<section class="container">
		<h2>最新消息與賽制公告區</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="10%">賽事場次</th>
					<th width="10%"></th>
					<th width="30%">玩家</th>
					<th width="10%">匹配</th>
					<th width="30%">玩家</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				//提取報名人資料為$rows陣列，先算出所需賽事(tr)，其次透過array shift方式進行提取陣列，將其輸出
				$sql = "SELECT * FROM pk";
				$rows = $db->query($sql)->fetchAll();

				$num = ceil(count($rows) / 2);
				for ($i = 1; $i <= $num; $i++) {
					echo '
					<tr>
						<td>' . $i . '</td>';
					$row = array_shift($rows); //$rows進行shift提取，頭一筆資料將被傾出
					echo '
						<td><img src="img/' . $row['info'] . '">User</td>
						<td>' . $row['user'] . '</td>
						<td>VS</td>';

					$row = array_shift($rows); //$rows進行shift提取，頭一筆資料將被傾出
					if($row)
						echo '
						<td>' . $row['user'] . '</td>
							<td><img src="img/' . $row['info'] . '">User</td>
						</tr>
						';
					else
						echo '
							<td>等待匹配中</td>
							<td></td>
						';
				}
				?>
			</tbody>
		</table>
	</section>
	<footer>
		<form id="login" class="modal hide fade form-horizontal" action="api.php?do=login" method="post">
			<div class="modal-header">
				<h3>後臺登入</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					<label class="control-label">帳號<br>(玩家名稱)</label>
					<input type="text" name="user" required>
				</div>
				<div class="control-group">
					<label class="control-label">密碼<br>(玩家請輸入Mail)</label>
					<input type="password" name="pwd" required>
				</div>
				<div class="control-group">
					<label class="control-label">驗證碼<br><br><br></label>
					<svg x="0px" y="0px" width="200px" height="50px" viewbox="0 0 200 50" enable-background="new 0 0 200 50">
						<text transform="matrix(0.8758 0.5 0 0.8 70 15)" font-size="36"><?= $_SESSION['rand'] ?></text>
						<radialgradient id="bg" cx="99.9995" cy="25.0005" r="90.1384" gradienttransform="matrix(0.8 0 0 0.9079 19.9994 2.3013)" gradientunits="userSpaceOnUse">
							<stop offset="0.5744" style="stop-color:#000000;stop-opacity:0" />
							<stop offset="0.7977" style="stop-color:#000000;stop-opacity:0.6512" />
							<stop offset="1" style="stop-color:#000000;stop-opacity:0.95" />
						</radialgradient>
						<rect x="-0.001" fill="url(#bg)" stroke="#000000" stroke-miterlimit="10" width="200.001" height="50" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="13.859" y1="29.805" x2="61.359" y2="9.805" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="49.359" y1="6.055" x2="164.109" y2="50" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="55.859" y1="42.64" x2="178.359" y2="31.784" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="133.109" y1="25.998" x2="167.609" y2="9.805" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="47.385" y1="1.806" x2="179.385" y2="44.555" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="51.859" y1="29.805" x2="167.609" y2="22.055" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="68.859" y1="3.305" x2="169.609" y2="29.805" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="155.609" y1="4.805" x2="6.609" y2="25.93" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="16.609" y1="2.055" x2="181.359" y2="44.305" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="77.859" y1="44.305" x2="181.359" y2="12.055" />
						<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="23.859" y1="37.211" x2="178.359" y2="12.99" />
					</svg>
					<input type="text" name="ans" required>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal">取消</button>
				<input class="btn btn-primary" type="submit" value="送出">
			</div>
		</form>
		<form id="msgadd" class="modal hide fade form-horizontal" action="api.php?do=msgadd" method="post">
			<div class="modal-header">
				<h3>新增留言</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					<label class="control-label">玩家姓名</label>
					<input type="text" name="user" required>
				</div>
				<div class="control-group">
					<label class="control-label">留言內容</label>
					<textarea name="info" required></textarea>
				</div>
				<div class="control-group">
					<label class="control-label">Email</label>
					<input type="email" name="mail" required>
				</div>
				<div class="control-group">
					<label class="control-label">連絡電話</label>
					<input type="tel" name="tel" pattern="[0-9\-]{9,12}" required>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal">取消</button>
				<input class="btn btn-primary" type="submit" value="送出">
			</div>
		</form>
		<form id="pkadd" class="modal hide fade form-horizontal" action="api.php?do=pkadd" method="post" enctype="multipart/form-data">
			<div class="modal-header">
				<h3>玩家參賽</h3>
			</div>
			<div class="modal-body">
				<div class="control-group">
					<label class="control-label">玩家姓名</label>
					<input type="text" name="user" required>
				</div>
				<div class="control-group">
					<label class="control-label">玩家頭像</label>
					<input type="file" name="img" required>
				</div>
				<div class="control-group">
					<label class="control-label">Email</label>
					<input type="email" name="mail" required>
				</div>
				<div class="control-group">
					<label class="control-label">連絡電話</label>
					<input type="tel" name="tel" required pattern="[0-9\-]{9,12}">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal">取消</button>
				<input class="btn btn-primary" type="submit" value="送出">
			</div>
		</form>
	</footer>
</body>

</html>