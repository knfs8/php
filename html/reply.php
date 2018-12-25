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
  echo $id; 
  $pdo = new PDO('mysql:host=localhost;dbname=php_data;charset=utf8','root','');
  foreach ( $pdo->query ( 'select * from php_data where id={$id}' ) as $row ) {
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
</body>
</html>
