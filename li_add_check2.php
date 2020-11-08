<?php

$li_list = $_POST['list'];
$li_point = $_POST['point'];

if ($li_list == '' || $li_point == '') {
  print 'リストが入力されていません。<br/>';
  print '<a href="li_add.php">戻る</a>';
  exit();
}

$dsn = 'mysql:dbname=yurutto;host=localhost;charset=utf8';
$user = 'root';
$password ='';

try {
  $db = new PDO($dsn,$user,$password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $stmt = $db->prepare("
    INSERT INTO actions(list,point)
    VALUES (:list, :point)"
  );

  $stmt->bindParam(':list', $li_list, PDO::PARAM_STR);
  $stmt->bindParam(':point', $li_point, PDO::PARAM_STR);

  $stmt->execute();

  header('Location: index.php');
  exit();
} catch(PDOException $e){
  die ('エラー：' . $e->getMessage());
}

?>