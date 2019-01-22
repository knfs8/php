<DOCTYPE! html>
<html>
<meta charset="UTF-8">
<head>
</head>
<title>掲示板返信フォーム</title>
<style>
 body{
  width:100%;
  height:auto;
  padding:0px;
  margin:0px;
 }

 #wrapping{
  margin:10px auto;
  width:50%;
  height:auto;
  padding:40px;
  background-color:#FFCC00;
 }

 #postdata{
  width:80%;
  height:auto;
  margin:20px auto;
  padding:20px;
  background-color:white;
 }

 #replydata{
  width:80%;
  height:auto;
  margin:-15px auto 20px auto;
  padding:20px;
  background-color:white;
}

 #reply{
  width:85%;
  height:auto;
  margin:10px auto;
  padding:20px;
 }

.name,.id,.created{
  width:auto;
  height:auto;
  float:left;  
  font-size:10px;
 }

.title{
  width:30px;
  height:auto;
  font-size:10px;
  margin:5px;
  clear:left;
 }

 .content{
  overflow:hidden;
  width:100%;
  height:auto;
  margin:10px;
 }

 
 label{
  width:100%; 
  height:100px;
  margin:0px;
  padding:0px;
  border:solid white 1px;
}

 #reply_data{
  width:100%;
  height:70px;
  margin:2px 0px;
 }
 
 #reply p{
  margin:0px;
  padding:0px;
  width:auto;
  height:auto;
  float:left;
  clear:left;
 }

 #reply_name{
  width:100%;
  height:20px;
  margin:2px 0px;
 }

  #reply_bt{
   float:right;
   margin:2px 0px;
  }

/*モーダル表示　displayで表示非表示*/
 #modal{
  z-index:2;
  display:none;
  position:fixed;
  top:10%;
  left:25%;
  width:50%;
  height:auto;
  padding:20px;
  border:1px black solid;
  background:white;
 }

 #modal p {
  width:auto;
  clear:left;
  float:none;
 }

 #okButton{
  width:100px;
  float:left;
  margin:5px 0px 5px 30px ;
 }
 
 #cancelButton{
  width:100px;
  height:auto;
  float:right;
  margin:5px 30px 5px 0px;
 }
</style>

<body>
<div id="wrapping">
  <center>
    <h1>掲示板</h1>
  </center>
 <?php
  /*データ出力*/
  $id = $_POST["id"];
  try{
   $pdo = new PDO('mysql:host=localhost;dbname=post_data;charset=utf8','root','');
   foreach ( $pdo->query ( "select * from post_data where id=".$id ) as $postRow ) {
    $postTime = date('Y/m/d',strtotime($postRow['created_at'])); 
    echo "<form id='postdata'><p class='name'>$postRow[name]</p><p class='created'>$postTime</p><p class='title'>$postRow[title]</p><center><p class='content'>$postRow[content]</p></center></form>";
   }
  }
  catch(PDOException $e){
    print "データベース接続失敗:{.$e->getMessage()}";
  }

  try{
    $pdo = new PDO('mysql:host=localhost;dbname=reply_data;charset=utf8','root','');
    /*返信データの表示*/
    foreach ( $pdo->query ( "select * from reply_data where post_id=".$id ) as $replyRow ) {
      //時刻データの出力変更
      $replyTime=$replyRow['created_at'];
      $time= date('Y/m/d', strtotime($replyTime));

      //データの出力
      echo "<form id='replydata'><p class='name'>$replyRow[name]</p><p class='created'>$time</p><center><p class='content'>$replyRow[content]</p></center></form>";
     }
   if(!empty($_POST["submit"])){
    $stmt = $pdo->prepare("INSERT INTO reply_data (post_id,name,content,created_at,update_at) VALUES (:post_id,:name,:content,:created_at,:update_at)");
    $post_id = $_POST["id"];
    $name = $_POST["name"];
    $content = $_POST["reply_data"];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

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
 <form method="POST" id="reply"> 
  <p class="reply_title">返信フォーム</p> 
  <p class="reply_name">名前</p>
  <label>
    <input type="text" name="name" id="reply_name">
    <br>
    <input type="text" name="reply_data" id="reply_data">
  </label>
  <input type="button" value="返信" onclick="check()" id="reply_bt">
  <?php echo "<input type='hidden' name='id' value=".$id.">";?>
  <div id="modal"></div>

  <script>
     function modal_onclick_close(){
       document.getElementById("modal").style.display = "none";
      }
     function modal_onclick_send(){
       document.getElementById("modal").style.display = "none";
     }
     function check(){
       document.getElementById("modal").style.display = "block";
       var name=document.getElementById("reply_name").value;
       var reply_data=document.getElementById("reply_data").value;
       var text="name:"+name+"&nbsp"+"reply_data:"+"&nbsp"+reply_data;
       document.getElementById("modal").innerHTML="<center><p>この内容で投稿します。<br>よろしいですか。<br>"+text+"</p></center><br><input type='submit' name='submit' value='OK' onclick='modal_onclick_send()' id='okButton'><input type = 'button' id='cancelButton' onclick='modal_onclick_close()'  value='キャンセル'>";
     }
   </script>
 </form>
</div>
</body>
</html>

