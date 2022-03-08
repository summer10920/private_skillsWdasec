<?php
require_once("lib.php");
$mainzone = (!empty($_GET['do'])) ? $_GET['do'] : $defaultDo[$_SESSION['mode']];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>旅館網站網頁資訊管理系統</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="recovery/style.css">
  <script src="recovery/recovery.js"></script>
</head>

<body>
	<main>
		<section class="container-fluid bg-dark text-white">
			<header class="row vh-25 justify-content-center align-items-center" style="background:url(https://picsum.photos/1920/250/?random=1);">
				<h1 class="p-3 bg-dark">旅館網站網頁資訊管理系統</h1>
			</header>
		</section>
		<section class="container-fluid bg-dark">
			<nav class="container navbar navbar-expand navbar-dark">
				<div class="navbar-nav">
					<?php
					foreach ($mode[$_SESSION['mode']] as $key => $value)
						echo '<a class="nav-link ' . ($mainzone == $key ? "active" : "") . '" href="?do=' . $key . '">' . $value . '</a>';
					?>
					<!-- /*sample*/ <a class="nav-link <?= ($mainzone == "login") ? "active" : "" ?>" href="#">訪客留言</a>-->
				</div>
			</nav>
		</section>
		<section class="container">
			<nav class="m-3"><a href="index.php">首頁</a> > <?= $title[$_SESSION['mode']][$mainzone] ?></nav>
			<h2 class="text-center"><?= $title[$_SESSION['mode']][$mainzone] ?></h2>
		</section>
		<section class="container">
				<?php include_once($mainzone . ".php") ?>
		</section>
	</main>
	<footer class="bg-dark text-white py-3 text-center" id="myfooter">
		<section class="container">第16屆全國身心障礙者技能競賽 設計者：WebXX</section>
	</footer>

</body>

</html>