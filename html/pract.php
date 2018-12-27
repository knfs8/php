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
  background-color:rgb(200,200,200);
  width:50%;
  margin:20px;
  padding:10px;
 }
</style>
<body>
 <center>
 <form method="POST" action="form.php">
  <input type="submit" value="投稿画面">
 </form>
 </center>
 <?php
  try{
   $pdo = new PDO ( 'mysql:host=localhost;dbname=post_data;charset=utf8', 'root', '' );
   $reply_pdo = new PDO ( 'mysql:host=localhost;dbname=reply_data;charset=utf8', 'root', '' );
   foreach ( $pdo->query ( 'select * from post_data' ) as $row ) {
     /*投稿データ一覧か*/
     echo "<center><form  method='POST'  action='reply.php' ><p>$row[id]:$row[name]:$row[title]:$row[content]:$row[created_at]:$row[updated_at]</p><input type='submit' value='返信'><input type='hidden' name='id' value=$row[id]></form></center>";

    foreach ( $reply_pdo->query ( 'select * from reply_data' ) as $reply_row ) {
    /*postのidとreplyのidが等しかった時の条件式*/
    if($row['id'] == $reply_row['post_id']){
     echo "<center><form><p>{$reply_row['id']}:{$reply_row['post_id']}:{$reply_row['name']}:{$reply_row['content']}:{$reply_row['created_at']}:{$reply_row['update_at']}</p></form></center>";
     } 
    }
   }
  }
  catch(PDOException $e){
   print "データベース接続失敗:{.$e->getMessage()}";
  }

 ?>
</body>
</html>
