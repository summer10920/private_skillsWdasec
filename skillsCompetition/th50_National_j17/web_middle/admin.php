<?php
include("api.php");
//只要是訪客都不能進入本頁面
if ($_SESSION['user'] == "guest") echo '<script>alert("無訪問權限");location.href="index.php";</script>';
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
					<!-- for admin.php -->
					<li><a href="api.php?do=logout">後台登出</a></li>
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

		<?php
		if($_SESSION['user']=="admin") // for admin
			$sql = "SELECT * FROM msg"; 
		else // for login user
			$sql = "SELECT * FROM msg WHERE user='".$_SESSION['user']."' AND mail='".$_SESSION['mail']."'";

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
							<!-- for admin used-->
							<a href="#msgmdy" class="btn btn-warning" data-toggle="modal" onclick="setval(this)">編輯</a>
							<a href="api.php?do=msgdel&id=<?=$row['id']?>" class="btn btn-danger">刪除</a>
						</div>
					</div>
				</div>
		<?php
			}
		}
		?>
	</section>

	<footer>
		<form id="msgmdy" class="modal hide fade form-horizontal" action="api.php?do=msgmdy" method="post">
			<div class="modal-header">
				<h3>修改留言</h3>
				<input type="hidden" name="id">
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
		<script>
			function setval(e) {
				let bigroot = $(e).parents(".row-fluid");
				let name = bigroot.find("h4").text();
				let info = bigroot.find("p").text();
				let mail = bigroot.find(".mail").text();
				let tel = bigroot.find(".tel").text();
				let id = bigroot.find(".sn").text();

				$("#msgmdy").find("input[name=user]").val(name);
				$("#msgmdy").find("textarea[name=info]").text(info);
				$("#msgmdy").find("input[name=mail]").val(mail);
				$("#msgmdy").find("input[name=tel]").val(tel);
				$("#msgmdy").find("input[name=id]").val(id);
			}
		</script>
	</footer>
</body>

</html>