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
  margin:-15px auto 20px auto;
  background-color:white;
  width:80%;
  height:auto;
  padding:30px;
  border:solid 1px black;
 }

 #bt{
  width:50px;
  height:30px;
  margin:5px 0px;
  float:right;
 }

 .id,.name,.created,.update{
  font-size:14px;
  width:auto;
  height:auto;
  float:left;
  margin:0px;
  padding:0px;
 }

 .title{
  clear:left;
  font-size:14px;
  width:auto;
  height:auto;
  margin:0px;
  padding:0px;
 }

 .content{
  width:100%;
  height:auto;
  margin:20px auto;
  overflow:hidden;
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
    foreach ( $pdo->query ( 'select * from post_data' ) as $postRow ) {
     /*投稿データ一覧*/
     $postTime = date('Y/m/d',strtotime($postRow['created_at']));
     echo "<form  method='POST'  action='reply.php' class='post_data'><p class='name'>$postRow[name]</p><p class='created'>$postTime</p><br><p class='title'>$postRow[title]</p><center><p class='content'>'$postRow[content]</p></center><input type='submit' class='reply-bt' value='返信'><input type='hidden' name='id' value=$postRow[id]></form>";

    foreach ( $reply_pdo->query ( 'select * from reply_data' ) as $replyRow) {
    /*postのidとreplyのidが等しかった時の条件式*/
     if($postRow['id'] == $replyRow['post_id']){
      $replyTime = date('Y/m/d',strtotime($replyRow['created_at']));
      echo "<form class='reply'><p class='name'>{$replyRow['name']}</p><p class='created'>$replyTime</p><center><p class='content'>{$replyRow['content']}</p></center></form>";
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
