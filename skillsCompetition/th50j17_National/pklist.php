<?php
$sql = "SELECT * FROM `pk` WHERE 1";
$rows = $db->query($sql)->fetchAll();

$data = [];
foreach ($rows as $row) $data[] = [$row['user'], $row['msg']];
$data = array_reverse($data);
$num = ceil(count($data) / 2);

for ($i = 1; $i <= $num; $i++) {
  $item = array_pop($data);
?>

  <tr>
    <td><?= $i ?></td>
    <td><img src="img/<?= $item[1] ?>"></td>
    <td><?= $item[0] ?></td>
    <td>VS</td>
    <?php
    $item = array_pop($data);
    if ($item) echo '<td>' . $item[0] . '</td><td><img src="img/' . $item[1] . '"></td>';
    else echo '<td>等待匹配中…</td><td></td>';
    ?>
  </tr>

<?php
}
?>