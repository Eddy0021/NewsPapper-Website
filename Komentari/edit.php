<?php
include 'connect.php';
date_default_timezone_set('Europe/Belgrade');

$id = $_POST['id'];
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];

echo "<form method='POST' action='".editComments($conn)."'>
	<input type='hidden' name='id' value='".$id."'>
	<input type='hidden' name='uid' value='".$uid."'>
	<input type='hidden' name='date' value='".$date."'>
	<textarea name='message' style='width:400px;height:80px;background-color:#fff;resize:none;'>".$message."</textarea><br>
	<button type='submit' name='commentSubmit' style='width:100px;height:30px;background-color:#282828;border:none;color:#fff;font-family:arial;font-weigth:400;cursor:pointer;margin-bottom:40px;'>Edit</button>
</form>";
echo "<hr>";
function editComments($conn){
	if(isset($_POST['commentSubmit'])){	
		$id = $_POST['id'];	
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		
		$sql = "UPDATE commentsection SET message='$message' WHERE id='$id'";
		$result = $conn->query($sql);
		header("Location: ..\LoggedMain.php");
	}
}

?>