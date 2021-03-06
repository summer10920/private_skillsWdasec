<?php
// 最後是創造出設計師想要丟出來的HTML檔案
$rows=$db->query("SELECT * FORM teacher where id=3")->fetchAll();
$teacherName=$rows[0];
echo '

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>'.$teacherName.'</h1>
</body>
</html>

';


?>