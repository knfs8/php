<DOCTYPE! html>
<html>
<meta charset="UTF-8">
<head>
</head>
<title>
</title>
<body>
 <?php
  $id = $_POST["id"];
  $pdo = new PDO('mysql:host=localhost;dbname=php_data;charset=utf8','root','');
  foreach ( $pdo->query ( "select * from php_data where id=".$id ) as $row ) {
     echo "<p>$row[id]:$row[post_data]:$row[regist_data]</p>";}
 ?> 
 <form method="POST" action="pract.php"> 
  <label>名前
  <br>
  <input type="text" name="name">
  <br>
  <input type="text" name="reply_data">
  </label>
  <input type="submit" value="返信">
 </form>
 <?php
  try{
   $pdo = new PDO ( 'mysql:host=localhost;dbname=php_reply_data;charset=utf8', 'root', '' ); print '接続成功' ;
  }
  catch(PDOException $e){
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

