<DOCTYPE! html>
<html>
<meta charset="UTF-8">
<head>
</head>
<title>
</title>
<body>
 <?php
  /*データ出力*/
  $id = $_POST["id"];
  try{
   $pdo = new PDO('mysql:host=localhost;dbname=php_data;charset=utf8','root','');
   foreach ( $pdo->query ( "select * from php_data where id=".$id ) as $row ) {
    echo "<p>$row[id]:$row[post_data]:$row[regist_data]</p>";
   }
  }
   catch(PDOException $e){
    print "データベース接続失敗:{.$e->getMessage()}";
   }

 try{
  $pdo = new PDO('mysql:host=localhost;dbname=reply_data;charset=utf8','root','');
  if(!empty($_POST["submit"])){
    $stmt = $pdo->prepare("INSERT INTO reply_data (post_id,name,content,created_at,update_at) VALUES (:post_id,:name,:content,:created_at,:update_at)");
    $post_id = $_POST["id"];
    $name = $_POST["name"];
    $content = $_POST["reply_data"];
    $created_at = date("Y-m-d H:i:s");
    $update_at = date("Y-m-d H:i:s");
    $stmt->bindValue(':post_id',$post_id,PDO::PARAM_INT);
    $stmt->bindParam(':name',$name,PDO::PARAM_INT);
    $stmt->bindParam(':content',$content,PDO::PARAM_INT);
    $stmt->bindValue(':created_at',$created_at,PDO::PARAM_INT);
    $stmt->bindValue(':update_at',$update_at,PDO::PARAM_INT);
    $stmt->execute();
    header('Location:pract.php');
    echo $id;
   }   
  }
   catch(PDOException $e){
    print "データベース接続失敗:{.$e->getMessage()}";
   }
 ?> 
 <form method="POST"> 
  <label>名前
  <br>
  <input type="text" name="name">
  <br>
  <input type="text" name="reply_data">
  </label>
  <input type="submit" name="submit" value="返信">
  <?php echo "<input type='hidden' name='id' value=".$id.">";?> 
 </form>

</body>
</html>

