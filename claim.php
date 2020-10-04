<?php
$room = $_POST["room"];
if(strlen($room)>20 or strlen($room)<2){
	
	$msg="Please choose a name between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$msg.'");';
	echo 'window.location="http://localhost/ChatRoom1";';
	echo '</script>';
}
else if(!ctype_alnum($room)){
	$msg="Please choose an alphanumeric roomname";
	echo '<script language="javascript">';
	echo 'alert("'.$msg.'");';
	echo 'window.location="http://localhost/ChatRoom1";';
	echo '</script>';
}
else{
	include 'db_connect.php';
}

$sql = "SELECT * FROM rooms WHERE roomname = '{$room}'";
$result = mysqli_query($conn,$sql) or die("Query Failed");
if($result){
	if(mysqli_num_rows($result)>0){
		$msg="Please choose a different roomname ";
		echo '<script language="javascript">';
		echo 'alert("'.$msg.'");';
		echo 'window.location="http://localhost/ChatRoom1";';
		echo '</script>';
	}
	else{
		$sql = "INSERT INTO rooms (roomname) VALUES('{$room}')";
		if(mysqli_query($conn,$sql)){
			$msg="Please choose a name between 2 to 20 characters";
			echo '<script language="javascript">';
			
			echo 'window.location="http://localhost/ChatRoom1/rooms.php?roomname='.$room.'";';
			echo '</script>';
		}
	}
	
}
?>
