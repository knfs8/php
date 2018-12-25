<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>テスト</title>
</head>
<body>
 <form method="POST" action="form2.php">
  <input type="text" name="data">
  <input type="submit" value="button">
 </form>
 <?php
  $pdo = new PDO ( 'mysql:host=localhost;dbname=php_data;charset=utf8', 'root', '' );
  foreach ( $pdo->query ( 'select * from php_data' ) as $row ) {
   echo "<form method='POST'  action='reply.php' ><p>$row[id]:$row[post_data]:$row[regist_data]</p><input type='submit' value='返信'><input type='hidden' name='id' value=$row[id]></form>"; 
  }
?>
<?php
  $pdo = new PDO ( 'mysql:host=localhost;dbname=php_reply_data;charset=utf8', 'root', '' );
foreach ( $pdo->query ( 'select * from php_reply_data' ) as $row ) {
  echo "<p>$row[id]:$row[post_data]:$row[regist_data]</p>";}
 ?>
 <?php
  try{
  $pdo = new PDO('mysql:host=localhost;dbname=php_reply_data;charset=utf8','root','');print '続成功';} catch (PDOException $e){
   print "データベース接続失敗:{.$e->getMessage()}";
  }
  $stmt = $pdo->prepare("INSERT INTO php_reply_data (reply_data,regist_data) VALUES (:reply_data,:regist_data)");
  $reply_data = $_POST["reply_data"];
  $regist_data = date("Y-m-d H:i:s");
  $stmt->bindParam(':reply_data',$reply_data,PDO::PARAM_INT);
  $stmt->bindValue(':regist_data',$regist_data,PDO::PARAM_INT);
  $stmt->execute();
 ?>
</body>
</html>
