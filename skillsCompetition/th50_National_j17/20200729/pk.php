<?php
$sql = "SELECT * FROM pk";
$rows = $db->query($sql)->fetchAll();

$data = array();

foreach ($rows as $row) {
  $data[] = [$row['user'], $row['info']];
}

// print_r($data);

$num = ceil(count($rows) / 2);

for ($i = 1; $i <= $num; $i++) {
?>
  <tr>
    <td><?= $i ?></td>

    <?php
    $item = array_shift($data);
    ?>

    <td>
      <img src="img/<?= $item[1] ?>" width="50" height="50" class="img-rounded">
    </td>
    <td><?= $item[0] ?></td>
    <td>VS</td>
    <?php
    $item = array_shift($data);
    if ($item) {
      echo '
      <td>' . $item[0] . '</td>
      <td>
        <img src="img/' . $item[1] . '" width="50" height="50" class="img-rounded">
      </td>
      ';
    } else {
      echo '
      <td>系統匹配中...</td>
      <td></td>
  ';
    }
    ?>

  </tr>
<?php
}
?>