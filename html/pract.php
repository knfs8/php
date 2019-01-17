<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>テスト</title>
</head>
<style>
 body{
  margin:0px;
  padding:0px;
  width:100%;
  height:auto;
 }
 #wrapping{
  width:50%;
  height:auto;
  padding:40px;
  margin:10px auto;
  background-color:#FFCC00;
 }

 h1{
  margin:0px auto;
 }
 
 form{
  width:70px;
  height:30px;
 }
 
 .post_data{
  background-color:white;
  width:80%;
  height:auto;
  padding:30px;
  border:solid 1px black;
  margin:20px auto;
 }
 
 .reply{
  margin:5px auto;
  background-color:white;
  width:80%;
  height:auto;
  padding:30px;
  border:solid 1px black;
 }

 #bt{
  width:50px;
  height:30px;
  float:right;
  margin:5px 0px;
 }

 .id,.name,.created,.update{
  font-size:10px;
  width:auto;
  height:auto;
  float:left;
 }

 .title{
  clear:left;
  font-size:10px;
  width:auto;
  height:auto;
 }

 .content{
  overflow:hidden;
  width:80%;
  height:auto;
  margin:10px auto;
 }

 .reply-bt{
  background-color:#FFCC00;
  float:right;
  margin-bottm:5px;
  margin-right:5px;
 }

</style>
<body>
 <div id = "wrapping">
    <center>
      <h1>掲示板</h1>
    </center> 
    <form method="POST" action="form.php">
      <input type="submit" id="bt" value="投稿画面">
    </form>
  <?php
   try{
    $pdo = new PDO ( 'mysql:host=localhost;dbname=post_data;charset=utf8', 'root', '' );
    $reply_pdo = new PDO ( 'mysql:host=localhost;dbname=reply_data;charset=utf8', 'root', '' );
    foreach ( $pdo->query ( 'select * from post_data' ) as $row ) {
     /*投稿データ一覧*/
    echo "<form  method='POST'  action='reply.php' class='post_data'><p class='name'>$row[name]</p><p class='created'>$row[created_at]</p><p class='update'>$row[updated_at]</p><br><p class='title'>$row[title]</p><center><p class='content'>'$row[content]</p></center><input type='submit' class='reply-bt' value='返信'><input type='hidden' name='id' value=$row[id]></form>";

    foreach ( $reply_pdo->query ( 'select * from reply_data' ) as $reply_row ) {
    /*postのidとreplyのidが等しかった時の条件式*/
     if($row['id'] == $reply_row['post_id']){
      echo "<form class='reply'><p class='name'>{$reply_row['name']}</p><p class='created'>{$reply_row['created_at']}</p><p class='update'>{$reply_row['update_at']}</p><center><p class='content'>{$reply_row['content']}</p></center></form>";
      } 
     }
    }
   }
   catch(PDOException $e){
    print "データベース接続失敗:{.$e->getMessage()}";
   }
  ?>
 </div>
</body>
</html>
