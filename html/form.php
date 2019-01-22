<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>テスト</title>
<head>
<style>
 body{
  width:100%;
  height:auto;
  padding:0px;
  margin:0px;
 }

 #wrapping{
  width:50%;
  height:auto;
  padding:40px;
  margin:10px auto;
  background-color:#FFCC00;
 }

 form{
  width:100%;
  height:auto;
  margin:0px auto;
 }

 h1{
  margin:10px auto;
 } 

 p{
  margin:0px;
  padding:0px;
  float:left;
  text-size:0.3em;
 }

 label{
  clear:left;
  width:100%;
  height:auto;
  margin:2px auto;
 }

 #content{
  clear:left;
  width:80%;
  height:70px;
  margin:0px auto;
 }

 p{
  float:left;
  text-size:0.3em;
 }

 #name,#title{
  clear:left;
  width:100%;
  height:20px;
  margin:0px auto;
 }

 #content{
  clear:left;
  width:100%;
  height:70px;
  margin:0px auto;
 }


 #bt{
  float:right;
  width:30px;
  height:auto;
  background-color:white;
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
 #modal p{
  width:auto;
  height:auto;
  float:none; 
}
 #modal-close{
  border-bottom:solid 1px black;
 }
 #modal-close:hover{
  color:blue;
 }

 .okButton{
  width:100px;
  float:left;
  margin:5px 0px 5px 30px;
 }

 .cancelButton{
  width:100px;
  height:auto;
  float:right;
  margin:5px 30px 5px 0px;
 }

</style>

<script type="text/javascript">
 //モーダル表示off
 function modal_onclick_close(){
  document.getElementById("modal").style.display = "none"; 
 }
 function modal_onclick_send(){
  document.getElementById("modal").style.display = "none"; 
 }
 //投稿ボタンのモーダル表示on
 function check(){
  document.getElementById("modal").style.display = "block";
  var name = document.getElementById("name").value;
  var title = document.getElementById("title").value;
  var content = document.getElementById("content").value;
  var text = "name:"+name+"&nbsp"+"title:"+title+"&nbsp"+"content:"+content;
  document.getElementById("modal").innerHTML = "<center><p>この内容で投稿します。<br>よろしいですか。<br>"+text+"</p></center><br><input type='submit' name='submit' class='okButton' value='OK' onclick='modal_onclick_send()'><input type='button' class='cancelButton'onclick='modal_onclick_close()' value='キャンセル'>";
 }

</script>

<body>
 <div id="wrapping">
 <form method="POST">
   <center>   
     <h1>掲示板</h1>
   </center>
   <label>
     <p>名前</p>
     <input type="text" name="name" id="name">
   </label>
   <br>
   <label>
     <p>タイトル</p>
     <input type="text" name="title" id="title">
   </label>
   <label>
     <p>内容</p>
     <input type="text" name="content" id="content">
   </label>
   <br>
   <input type="button" id="bt" value="投稿" onclick="check()">
   <div id="modal-overlay">
   </div>
   <div id="modal">
   </div>
 </form>

<?php
 try{
  $pdo = new PDO('mysql:host=localhost;dbname=post_data;charset=utf8','root','');
 if(!empty($_POST["submit"])){
    $stmt = $pdo->prepare("INSERT INTO post_data (name,title,content,created_at,updated_at) VALUES (:name,:title,:content,:created_at,:updated_at)");
    $name = $_POST["name"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
    $stmt->bindParam(':name',$name,PDO::PARAM_INT);
    $stmt->bindParam(':title',$title,PDO::PARAM_INT);
    $stmt->bindParam(':content',$content,PDO::PARAM_INT);
    $stmt->bindValue(':created_at',$created_at,PDO::PARAM_INT);
    $stmt->bindValue(':updated_at',$updated_at,PDO::PARAM_INT);
    $stmt->execute();
    header('Location:pract.php');
  }
}
 catch (PDOException $e){
  print "データベース接続失敗:{.$e->getMessage()}";
 }
?>
 </div>
</body>
</html>
