<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>テスト</title>
</head>
<style>
 body{
  width:100%;
  height:auto;
 }
 form{
  width:50%;
  background-color:rgb(200,200,200);
  margin:20px;
  padding:10px;
 }
</style>
<body>
 <form method="POST" action="form2.php">
  <input type="text" name="data">
  <input type="submit" value="button">
 </form>
 <?php
  $pdo = new PDO ( 'mysql:host=localhost;dbname=php_data;charset=utf8', 'root', '' );
  foreach ( $pdo->query ( 'select * from php_data' ) as $row ) {
   echo "<center><form id='data' method='POST'  action='reply.php' ><p>$row[id]:$row[post_data]:$row[regist_data]</p><input type='submit' value='返信'><input type='hidden' name='id' value=$row[id]></form></center>";
  }
?>
<?php
  $pdo = new PDO ( 'mysql:host=localhost;dbname=php_reply_data;charset=utf8', 'root', '' );
foreach ( $pdo->query ( 'select * from php_reply_data' ) as $row ) {
  echo "<p>$row[id]:$row[reply_data]:$row[regist_data]</p>";}
 ?>
</body>
</html>
