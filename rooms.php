<?php

$roomname=$_GET['roomname'];
include 'db_connect.php';
$sql = "SELECT * FROM rooms WHERE roomname = '{$roomname}'";
$result = mysqli_query($conn,$sql) or die("Query Failed");
if($result){
	
	if(mysqli_num_rows($result)==0){
		$msg="Room doesn't exits ";
		echo '<script language="javascript">';
		echo 'alert("'.$msg.'");';
		echo 'window.location="http://localhost/ChatRoom1";';
		echo '</script>';
	}
	else{
		echo "Errors : ".mysqli_error($conn);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
  
}
.anyClass{
	height:350px;
	overflow-y:scroll;
}
</style>
</head>
<body>

<h2>Chat Messages</h2>

<div class="container">
<div class="anyClass">
  
</div>
</div>
<input type="text" class="form-control" id="usermsg" name="usermsg" placeholder="Add Messages"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">Send</button>

<script>

	setInterval(runFunction,1000);
	function runFunction(){
	$.ajax({
		url:"htcont.php",
		type:"POST",
		data:{room:'<?php echo $roomname?>'},
		success:function(data){
			document.getElementsByClassName('anyClass')[0].innerHTML=data;
		}
});
}


$(document).ready(function(){

	$('#submitmsg').click(function(){
		var clientmsg = $("#usermsg").val();
		$.ajax({
			url:'postmsg.php',
			type:'POST',
			data:{
				text:clientmsg,
				room:'<?php echo $roomname ?>',
				ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
			success:function(data){
				document.getElementsByClassName('anyClass')[0].innerHTML = data;
			}
			
		});
		$("#usermsg").val("");
		return false;
	});
});
</script>


</body>
</html>