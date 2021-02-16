<?php
$rows = $db->query("SELECT * FROM pk")->fetchAll();

$data = [];
foreach ($rows as $row) $data[] = [$row['user'], $row['info']];
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
    if ($item)
      echo '<td>' . $item[0] . '</td><td><img src="img/' . $item[1] . '"></td>';
    else
      echo '<td>人數不足配對中</td><td></td>';
    ?>
  </tr>
<?php
}
?>