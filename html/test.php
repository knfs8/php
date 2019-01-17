
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>テスト</title>
<body>

 <form>
  <input type="text" id="text">
  <input type="button"  onclick="test()">
 </form>
 <div id="output">
 </div>

<script>
 function test(){
  var text = document.getElementById("text").value;
  console.log(text);
  var output = document.getElementById("output");
  output.innerHTML = text; 
 }
 
</script>

</body>
</html>
