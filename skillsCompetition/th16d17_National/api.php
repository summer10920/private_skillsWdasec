<?php
require_once("lib.php");
switch ($_GET['do']) {
		//圖形驗證產生
	case 'codeget':
		$width = 100;
		$height = 30;
		$imgzone = imagecreate($width, $height); // create 100x30's img
		$purple = imagecolorallocate($imgzone, 255, 255, 0);  //黃字
		$gray = imagecolorallocate($imgzone, 100, 100, 100);  //灰底
		imagefill($imgzone, 0, 0, $gray); // background
		imagestring($imgzone, 5, rand(0, $width / 2), rand(0, $height / 2), $_SESSION['checkcode'], $purple);

		header("content-type:image/png"); //宣告圖片型態
		imagepng($imgzone); //產生圖片
		imagedestroy($imgzone); // 清除memory

		/*
    http://ep.ckvs.tyc.edu.tw/blog/files/6-5919-9318.php
    https://www.haorooms.com/post/php_yzm
    http://poterp.iem.mcut.edu.tw/class_php/phpd.htm
    */
		break;

	case 'codechg':
		$_SESSION['checkcode'] = "";
		for ($i = 0; $i < 4; $i++) $_SESSION['checkcode'] .= $codestr[rand(0, strlen($codestr) - 1)];
		echo $_SESSION['checkcode'];
		break;
	case 'login':
		$_SESSION['mode'] = "admin";
		header("location:./");
		break;
	case 'msgadd':
		$sql = "INSERT INTO th16_msg (who,tel,mail,addr,says) VALUES('" . $_POST['who'] . "','" . $_POST['tel'] . "','" . $_POST['mail'] . "','" . $_POST['addr'] . "','" . $_POST['says'] . "')";
		$db->query($sql);
		header("location:./?do=msg");
		break;
	case 'msgmdy':
		$sql = "UPDATE th16_msg SET who='" . $_POST['who'] . "',tel='" . $_POST['tel'] . "',addr='" . $_POST['addr'] . "',says='" . $_POST['says'] . "',dpy=1 WHERE id='" . $_GET['id'] . "'";
		$db->query($sql);
		header("location:./?do=msgadmin");
		break;
	case 'msgdel':
		$db->query("UPDATE th16_msg SET dpy=2 WHERE ID=" . $_GET['id']);
		header("location:./?do=msgadmin");
		break;
	case 'calmake':
		?>
		<div class="text-center">
			<h3>
				<button type="button" class="btn btn-info" name="<?= $_GET['mode'] ?>" onclick="newcals(this)" value="<?= date("Y-m-d", strtotime($_GET['y'] . "-" . $_GET['m'] . ", -1 month")) ?>">上個月</button>
				<span> <?= $_GET['y'] ?>年 <?= $_GET['m'] ?>月 </span>
				<button type="button" class="btn btn-info" name="<?= $_GET['mode'] ?>" onclick="newcals(this)" value="<?= date("Y-m-d", strtotime($_GET['y'] . "-" . $_GET['m'] . ", +1 month")) ?>">下個月</button>
				<!-- https://gist.github.com/garak/1000118 -->
			</h3>
			<table border="1" class="table text-center table-cals">
				<thead class="thead-dark">
					<tr>
						<th>星期日</th>
						<th>星期一</th>
						<th>星期二</th>
						<th>星期三</th>
						<th>星期四</th>
						<th>星期五</th>
						<th>星期六</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$firstDayNum = date("w", strtotime($_GET['y'] . "-" . $_GET['m'] . "-1")); //該月1號於周幾  0(SUN) ~ 6 (SAT)
						$maxDay = date("t", strtotime($_GET['y'] . "-" . $_GET['m'])); //該月最大日
						$num = 0; // 顯示幾日
						for ($i = 0; $i < 35; $i++) {
							echo ($i % 7 == 0) ? "<tr>" : "";
							if ($firstDayNum <= $i && $i - $firstDayNum < $maxDay) { //打印日期
								$num++; //日子號碼
								$showDay = strtotime($_GET['y'] . "-" . $_GET['m'] . "-" . $num);
								switch ($_GET['mode']) {
									case 'checkin':
										$lineDay = strtotime(date("Y-m-d"));
										break;
									case 'checkout':
										$lineDay = strtotime($_GET['checkinDate'] . "+1 days");
										break;
								}

								$thisday = date("Y-m-d", strtotime($_GET['y'] . '-' . $_GET['m'] . '-' . $num));
								$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $thisday . "' and roomtype='" . $_GET['room'] . "'")->fetch();

								if (!$row) { //補上不存在的房況
									$db->query("INSERT INTO th16_room VALUES(null,'" . $_GET['room'] . "','" . $thisday . "','" . serialize(array()) . "'," . $roomtotal[$_GET['room']] . "," . $roomprice[$_GET['room']] . ")");
									$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $thisday . "' and roomtype='" . $_GET['room'] . "'")->fetch(); //再刷新$row有值
								}

								if ($showDay < $lineDay) echo '<td class="disabled">' . $num . '</td>';  //日子已過去，暗化關閉
								else if ($row && $row['remain'] < 1) { //有效日但無房間 (入住拒絕但退房可選)
									if ($_GET['mode'] == 'checkin') echo '<td class="disabled">' . $num . '<br>剩餘0間<br>已售完</td>';
									else echo '<td>
										' . $num . '<br>剩餘0間<br>已售完
										<span class="d-none">' . $thisday . '</span>
									</td>';
								} else echo //有效日且尚有空房數，若找不到資料對象(未訂房紀錄)則採預設值而定
									'<td>
										<h3><span class="badge badge-warning">' . $num . '</span></h3>
										$' . $row['roomprice'] . '<br>
										剩餘' . $row['remain'] . '間
										<span class="d-none">' . $thisday . '</span>
									</td>'; //可選的日子
							} else echo '<td class="disabled"></td>';
							echo ($i + 1 % 7 == 0 && $i != 0) ? "</tr>" : "";
						}
						?>
				</tbody>
			</table>
		</div>
	<?php
		break;
	case 'roomreloadnum':
		$sql = "SELECT MIN(remain) FROM th16_room WHERE '" . $_GET['checkin'] . "'<=roomdate and roomdate<'" . $_GET['checkout'] . "' and roomtype='" . $_GET['room'] . "'";
		$row = $db->query($sql)->fetch();
		$total = is_null($row['0']) ? $roomtotal[$_GET['room']] : $row['0']; //可能在沒RUN過cal情況下房況皆不存在，因此抓Default房量
		if (!$total) echo '<option value="0">0</option>';
		else for ($i = 1; $i <= $total; $i++) echo '<option value="' . $i . '">' . $i . '</option>';
		break;

	case 'bookadd1':
		$_SESSION['cart'] = serialize($_POST);
		header("location:./?do=book&step=2");
		break;

	case 'bookadd2':
		$_SESSION['msg'] = serialize($_POST);
		header("location:./?do=book&step=3");
		break;

	case 'bookadd3': //先建立訂單但還沒有房號與總價格，接著檢查房況待產生有效房號後，才修回訂單正確資料
		//解壓縮陣列
		$cart = unserialize($_SESSION['cart']);
		$who = unserialize($_SESSION['msg']);

		//建立訂單
		$sql = "INSERT INTO th16_odr VALUES(null,'" . $who['who'] . "','" . $who['tel'] . "','" . $who['addr'] . "','" . $who['says'] . "','" . $cart['room'] . "'," . $cart['room_num'] . ",'" . $cart['checkin'] . "','" . $cart['checkout'] . "','',0)";
		$db->query($sql);
		$odrid = $db->lastInsertId(); //訂單編號

		//先補足所有房況，使其都有資料可受查詢
		// for ($i = 0; $i < $days; $i++) {
		// 	$theday = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($cart['checkin'])));
		// 	$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $theday . "' AND roomtype='" . $cart['room'] . "'")->fetch();
		// 	if (!$row) { //補上不存在的房況
		// 		$sql = "INSERT INTO th16_room VALUES(null,'" . $cart['room'] . "','" . $theday . "','" . serialize(array()) . "'," . $roomtotal[$cart['room']] . "," . $roomprice[$cart['room']] . ")";
		// 		$db->query($sql);
		// 	}
		// }

		//抽取出日期範圍內的佔房狀況，順便計算總價
		$sql = "SELECT * FROM th16_room WHERE '" . $cart['checkin'] . "' <= roomdate AND roomdate < '" . $cart['checkout'] . "' AND roomtype='" . $cart['room'] . "'";
		$rows = $db->query($sql)->fetchAll();
		$priceSum = array_sum(array_column($rows, 'roomprice'));
		$sellcols = (array_column($rows, 'sellout'));
		foreach ($sellcols as $key => $value) $sellcols[$key] = unserialize($value); //解壓縮value回存

		$keynum = array();
		for ($i = 1; $i <= $cart['room_num']; $i++) { //需要幾把鎖匙?
			$j = 0;
			while (array_column($sellcols, $j)) $j++; //如果有找到對象，跳下一號，$j將會是可以販售的keyNumber
			foreach ($sellcols as $key => $value) $sellcols[$key][$j] = $odrid; //更新已售的keyNumber
			array_push($keynum, $cart['room'] . str_pad($j + 1, 3, '0', STR_PAD_LEFT)); //紀錄將售號碼鎖匙 ex C001
		}
		//將已售之['房編'=>'訂單號']塞回SQL修正房況
		$days = (strtotime($cart['checkout']) - strtotime($cart['checkin'])) / (60 * 60 * 24); //many days
		for ($i = 0; $i < $days; $i++) {
			$theday = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($cart['checkin'])));
			$db->query("UPDATE th16_room SET remain=remain-" . $cart['room_num'] . ", sellout='" . serialize($sellcols[$i]) . "' WHERE roomdate='" . $theday . "' AND roomtype='" . $cart['room'] . "'");
		}

		//將鎖匙號碼修正回訂單內
		$db->query("UPDATE th16_odr SET keynum='" . serialize($keynum) . "',price=" . $priceSum * $cart['room_num'] . " WHERE id=" . $odrid);

		//清除與紀錄訂單ID之SESSION供前端查詢
		unset($_SESSION['cart'], $_SESSION['msg']);
		$_SESSION['odrid'] = $odrid;
		header("location:./?do=book&step=4");
		break;

	case 'setting':
		$db->query("UPDATE th16_setting SET pse=" . $_POST['pse'] . " WHERE 1");
		header("location:./?do=setting");
		break;

	case 'pricemake':
		?>
		<div class="text-center">
			<h3>
				<button type="button" class="btn btn-info" onclick="pricecals('<?= date('Y-m-d', strtotime($_GET['y'] . '-' . $_GET['m'] . ', -1 month')) ?>')">上個月</button>
				<span> <?= $_GET['y'] ?>年 <?= $_GET['m'] ?>月 </span>
				<button type="button" class="btn btn-info" onclick="pricecals('<?= date('Y-m-d', strtotime($_GET['y'] . '-' . $_GET['m'] . ', +1 month')) ?>')">下個月</button>
			</h3>
			<table border="1" class="table text-center table-cals">
				<thead class="thead-dark">
					<tr>
						<th>星期日</th>
						<th>星期一</th>
						<th>星期二</th>
						<th>星期三</th>
						<th>星期四</th>
						<th>星期五</th>
						<th>星期六</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$firstDayNum = date("w", strtotime($_GET['y'] . "-" . $_GET['m'] . "-1")); //該月1號於周幾  0(SUN) ~ 6 (SAT)
						$maxDay = date("t", strtotime($_GET['y'] . "-" . $_GET['m'])); //該月最大日
						$num = 0; // 顯示幾日
						for ($i = 0; $i < 35; $i++) {
							echo ($i % 7 == 0) ? "<tr>" : "";
							if ($firstDayNum <= $i && $i - $firstDayNum < $maxDay) { //打印日期
								$num++; //日子號碼
								$showDay = strtotime($_GET['y'] . "-" . $_GET['m'] . "-" . $num);
								$lineDay = strtotime(date("Y-m-d"));

								$thisday = date("Y-m-d", strtotime($_GET['y'] . '-' . $_GET['m'] . '-' . $num));
								$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $thisday . "' and roomtype='" . $_GET['room'] . "'")->fetch();

								if (!$row) { //補上不存在的房況
									$db->query("INSERT INTO th16_room VALUES(null,'" . $_GET['room'] . "','" . $thisday . "','" . serialize(array()) . "'," . $roomtotal[$_GET['room']] . "," . $roomprice[$_GET['room']] . ")");
									$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $thisday . "' and roomtype='" . $_GET['room'] . "'")->fetch(); //再刷新$row有值
								}

								if ($showDay < $lineDay) echo '<td class="disabled">' . $num . '</td>';  //舊日子不給修改
								else echo '
									<td>
										<h3><span class="badge badge-warning">' . $num . '</span></h3>
										$<input type="text" class="w-50" name="price[]" value="' . $row['roomprice'] . '"><br>
										剩餘<input type="text" class="w-25" name="num[]" value="' . $row['remain'] . '">間<br>
										<input type="hidden" name="date[]" value="' . $thisday . '">
									</td>
								'; //可選的日子


								/*
								else if ($row && $row['remain'] < 1) echo '<td class="disabled">' . $num . '<br>剩餘0間<br>已售完</td>';  //有效日但無房間
								*/
							} else echo '<td class="disabled"></td>';
							echo ($i + 1 % 7 == 0 && $i != 0) ? "</tr>" : "";
						}
						?>
				</tbody>
			</table>
		</div>
	<?php
		break;
	case 'pricemdy':
		foreach ($_POST['price'] as $key => $value)
			$db->query("UPDATE th16_room SET remain=" . $_POST['num'][$key] . ", roomprice=" . $_POST['price'][$key] . " WHERE roomdate='" . $_POST['date'][$key] . "'");
		header("location:./?do=sell");
		break;

	case 'odrdel':
		$odr = $db->query("SELECT * FROM th16_odr WHERE id=" . $_GET['id'])->fetch();

		//抽取出日期範圍內的佔房狀況
		$sql = "SELECT * FROM th16_room WHERE '" . $odr['checkin'] . "' <= roomdate AND roomdate < '" . $odr['checkout'] . "' AND roomtype='" . $odr['roomtype'] . "'";
		$rows = $db->query($sql)->fetchAll();
		$sellcols = (array_column($rows, 'sellout'));
		foreach ($sellcols as $key => $value) $sellcols[$key] = unserialize($value); //解壓縮value回存

		foreach ($sellcols as $day => $sellout) //清除房況內的訂單ID
			foreach ($sellout as $key => $value) if ($value === $_GET['id']) unset($sellcols[$day][$key]);

		//將已售之翻新結果狀況塞回SQL，修正房況
		$days = (strtotime($odr['checkout']) - strtotime($odr['checkin'])) / (60 * 60 * 24) + 1; //many days
		for ($i = 0; $i < ($days - 1); $i++) {
			$theday = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($odr['checkin'])));
			$sql = "UPDATE th16_room SET remain=remain+" . $odr['num'] . ", sellout='" . serialize($sellcols[$i]) . "' WHERE roomdate='" . $theday . "' AND roomtype='" . $odr['roomtype'] . "'";
			$db->query($sql);
		}
		//刪除該訂單
		$db->query("DELETE FROM th16_odr WHERE id=" . $odr['id']);
		header("location:./?do=orderadmin");
		break;

	case 'roomNumKeepOld': //need add 
		//先整理出SQL的房量，再添加原訂單的房量(如果條件成立)
		$sql = "SELECT * FROM th16_room WHERE '" . $_GET['checkin'] . "'<=roomdate and roomdate<'" . $_GET['checkout'] . "' and roomtype='" . $_GET['room'] . "'";
		$rows = $db->query($sql)->fetchAll();

		foreach ($rows as $key => $row)  //所有資料都要調整回來房量
			if ($_GET['odrin'] <= $row['roomdate'] && $row['roomdate'] < $_GET['odrout'] && $_GET['room'] == $_GET['odrtype']) $rows[$key]['remain'] += $_GET['odrnum'];

		$total = min(array_column($rows, 'remain'));

		// 舊訂單沒有下面問題，不需要寫
		// $total = is_null($row['0']) ? $roomtotal[$_GET['room']] : $row['0']; //可能在沒RUN過cal情況下房況皆不存在，因此抓Default房量

		if (!$total) echo '<option value="0">0</option>';
		else for ($i = 1; $i <= $total; $i++) echo '<option value="' . $i . '" ' . ($_GET['first'] && $_GET['odrnum'] == $i ? "selected" : "") . '>' . $i . '</option>';
		break;

	case 'calmakeKeepOld':
		?>
		<div class="text-center">
			<h3>
				<button type="button" class="btn btn-info" name="<?= $_GET['mode'] ?>" onclick="newcals(this)" value="<?= date("Y-m-d", strtotime($_GET['y'] . "-" . $_GET['m'] . ", -1 month")) ?>">上個月</button>
				<span> <?= $_GET['y'] ?>年 <?= $_GET['m'] ?>月 </span>
				<button type="button" class="btn btn-info" name="<?= $_GET['mode'] ?>" onclick="newcals(this)" value="<?= date("Y-m-d", strtotime($_GET['y'] . "-" . $_GET['m'] . ", +1 month")) ?>">下個月</button>
				<!-- https://gist.github.com/garak/1000118 -->
			</h3>
			<table border="1" class="table text-center table-cals">
				<thead class="thead-dark">
					<tr>
						<th>星期日</th>
						<th>星期一</th>
						<th>星期二</th>
						<th>星期三</th>
						<th>星期四</th>
						<th>星期五</th>
						<th>星期六</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$firstDayNum = date("w", strtotime($_GET['y'] . "-" . $_GET['m'] . "-1")); //該月1號於周幾  0(SUN) ~ 6 (SAT)
						$maxDay = date("t", strtotime($_GET['y'] . "-" . $_GET['m'])); //該月最大日
						$num = 0; // 顯示幾日
						for ($i = 0; $i < 35; $i++) {
							echo ($i % 7 == 0) ? "<tr>" : "";
							if ($firstDayNum <= $i && $i - $firstDayNum < $maxDay) { //打印日期
								$num++; //日子號碼
								$showDay = strtotime($_GET['y'] . "-" . $_GET['m'] . "-" . $num);
								switch ($_GET['mode']) {
									case 'checkin':
										$lineDay = strtotime(date("Y-m-d"));
										break;
									case 'checkout':
										$lineDay = strtotime($_GET['checkinDate'] . "+1 days");
										break;
								}

								$thisday = date("Y-m-d", strtotime($_GET['y'] . '-' . $_GET['m'] . '-' . $num));
								$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $thisday . "' and roomtype='" . $_GET['room'] . "'")->fetch();

								if (!$row) { //補上不存在的房況
									$db->query("INSERT INTO th16_room VALUES(null,'" . $_GET['room'] . "','" . $thisday . "','" . serialize(array()) . "'," . $roomtotal[$_GET['room']] . "," . $roomprice[$_GET['room']] . ")");
									$row = $db->query("SELECT * FROM th16_room WHERE roomdate='" . $thisday . "' and roomtype='" . $_GET['room'] . "'")->fetch(); //再刷新$row有值
								}

								//所有資料都要調整回來房量,在正確的房型下生效
								if ($_GET['odrin'] <= $row['roomdate'] && $row['roomdate'] < $_GET['odrout'] && $_GET['room'] == $_GET['odrtype']) $row['remain'] += $_GET['odrnum'];

								if ($showDay < $lineDay) echo '<td class="disabled">' . $num . '</td>';  //日子已過去，暗化關閉
								else if ($row && $row['remain'] < 1) { //有效日但無房間 (入住拒絕但退房可選)
									if ($_GET['mode'] == 'checkin') echo '<td class="disabled">' . $num . '<br>剩餘0間<br>已售完</td>';
									else echo '<td>
										' . $num . '<br>剩餘0間<br>已售完
										<span class="d-none">' . $thisday . '</span>
									</td>';
								} else echo //有效日且尚有空房數,順便舊訂單的日期上淡紅色，需符合房型日期與類別
									'<td ' . ($_GET['odrin'] <= $row['roomdate'] && $row['roomdate'] <= $_GET['odrout'] && $_GET['room'] == $_GET['odrtype'] ? 'class="alert-danger"' : '') . '>
										<h3><span class="badge badge-warning">' . $num . '</span></h3>
										$' . $row['roomprice'] . '<br>
										剩餘' . $row['remain'] . '間
										<span class="d-none">' . $thisday . '</span>
									</td>'; //可選的日子
							} else echo '<td class="disabled"></td>';
							echo ($i + 1 % 7 == 0 && $i != 0) ? "</tr>" : "";
						}
						?>
				</tbody>
			</table>
		</div>
	<?php
		break;
	case 'bookmdy':
		$odr = $db->query("SELECT * FROM th16_odr WHERE id=" . $_GET['id'])->fetch();

		//抽取出OLD日期範圍內的佔房狀況
		$sql = "SELECT * FROM th16_room WHERE '" . $odr['checkin'] . "' <= roomdate AND roomdate < '" . $odr['checkout'] . "' AND roomtype='" . $odr['roomtype'] . "'";
		$rows = $db->query($sql)->fetchAll();
		$sellcols = (array_column($rows, 'sellout'));
		foreach ($sellcols as $key => $value) $sellcols[$key] = unserialize($value); //解壓縮value回存

		foreach ($sellcols as $day => $sellout) //清除房況內的訂單ID
			foreach ($sellout as $key => $value) if ($value === $_GET['id']) unset($sellcols[$day][$key]);

		//將已售之翻新結果狀況塞回SQL，翻新房況釋放
		$days = (strtotime($odr['checkout']) - strtotime($odr['checkin'])) / (60 * 60 * 24) + 1; //many days
		for ($i = 0; $i < ($days - 1); $i++) {
			$theday = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($odr['checkin'])));
			$sql = "UPDATE th16_room SET remain=remain+" . $odr['num'] . ", sellout='" . serialize($sellcols[$i]) . "' WHERE roomdate='" . $theday . "' AND roomtype='" . $odr['roomtype'] . "'";
			$db->query($sql);
		}

		//抽取出NEW日期範圍內的佔房狀況，順便計算總價
		$sql = "SELECT * FROM th16_room WHERE '" . $_POST['checkin'] . "' <= roomdate AND roomdate < '" . $_POST['checkout'] . "' AND roomtype='" . $_POST['room'] . "'";
		$rows = $db->query($sql)->fetchAll();
		$priceSum = array_sum(array_column($rows, 'roomprice'));
		$sellcols = (array_column($rows, 'sellout'));
		foreach ($sellcols as $key => $value) $sellcols[$key] = unserialize($value); //解壓縮value回存

		$keynum = array();
		for ($i = 1; $i <= $_POST['room_num']; $i++) { //需要幾把鎖匙?
			$j = 0;
			while (array_column($sellcols, $j)) $j++; //如果有找到對象，跳下一號，$j將會是可以販售的keyNumber
			foreach ($sellcols as $key => $value) $sellcols[$key][$j] = $_GET['id']; //更新已售的keyNumber
			array_push($keynum, $_POST['room'] . str_pad($j + 1, 3, '0', STR_PAD_LEFT)); //紀錄將售號碼鎖匙 ex C001
		}
		//將已售之$sellcols['房編'=>'訂單號']塞回SQL修正房況
		$days = (strtotime($_POST['checkout']) - strtotime($_POST['checkin'])) / (60 * 60 * 24); //many days
		for ($i = 0; $i < $days; $i++) {
			$theday = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($_POST['checkin'])));
			$db->query("UPDATE th16_room SET remain=remain-" . $_POST['room_num'] . ", sellout='" . serialize($sellcols[$i]) . "' WHERE roomdate='" . $theday . "' AND roomtype='" . $_POST['room'] . "'");
		}

		//將所有資料以及新鎖匙號碼全部修正回訂單內
		$db->query("UPDATE th16_odr SET who='" . $_POST['who'] . "', tel='" . $_POST['tel'] . "', addr='" . $_POST['addr'] . "', says='" . $_POST['says'] . "', roomtype='" . $_POST['room'] . "', num=" . $_POST['room_num'] . ", checkin='" . $_POST['checkin'] . "', checkout='" . $_POST['checkout'] . "', keynum='" . serialize($keynum) . "',price=" . $priceSum * $_POST['room_num'] . " WHERE id=" . $_GET['id']);

		header("location:./?do=orderadmin");
		break;
}
