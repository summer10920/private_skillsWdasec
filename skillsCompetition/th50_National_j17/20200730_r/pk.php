<?php
$rows = $db->query("SELECT * FROM pk")->fetchAll();

$data = array();
foreach ($rows as $row) $data[] = [$row['user'], $row['info']];
$num = ceil(count($data) / 2);

for ($i = 1; $i <= $num; $i++) {
?>
  <tr>
    <?php 
      echo '<td>'.$i.'</td>';

      $item = array_shift($data); 
      echo '
        <td><img src="img/'.$item[1].'"></td>
        <td>'.$item[0].'</td>
        <td>VS</td>
      ';

      $item = array_shift($data);
      if($item) echo '
        <td>'.$item[0].'</td>
        <td><img src="img/'.$item[1].'"></td>
      ';
      else echo '
        <td>等待匹配中。..</td>
        <td></td>
      ';
    ?>
  </tr>
<?php
}
?>