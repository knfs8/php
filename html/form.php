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
  padding:0px;
  margin:0px;
  margin-top:20px;
 }
 form{
  width:50%;
  height:auto;
  padding:20px;
  background-color:orange;
 }

 #modal{
  z-index:2;
  display:block;
  position:fixed;
  top:10%;
  left:25%;
  width:50%;
  height:auto;
  padding:20px;
  border:1px black solid;
  background:white;
 }
 #modal-close{
  border-bottom:solid 1px black;
 }
 #modal-close:hover{
  color:blue;
 }
</style>

<script type="text/javascript">
 function modal_onclick_close(){
  document.getElementById("modal").style.display = "none";
 }
 
 function modal_onclick_send(){

 }
 function check(){

 }

</script>

<body>
 <center>
 <form method="POST">
 <h1>掲示板</h1>
 <label>名前 
  <input type="text" name="name">
 </label>
 <br>
 <label>タイトル
  <input type="text" name="title">
 </label>
 <br>
 <label>内容
  <input type="text" name="content">
 </label>
 <br>
 <input type="submit" name="submit" value="投稿" onclick="check()">
</form>
</center>
<div id="modal">
 <?php echo "<p>この内容で投稿します。<br>よろしいですか。</p><p><a id='modal-close' onclick='modal_onclick_send()'> OK</a><p><a id='modal-close' onclick='modal_onclick_close()'> キャンセル</a>";?>
</div>
<div id="modal-overlay">
</div>


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


</body>
</html>
