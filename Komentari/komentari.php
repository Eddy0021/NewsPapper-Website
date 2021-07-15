<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "php_assignment03";
$conn = mysqli_connect($servername, $username, $password, $db);
if(!$conn){
	die("connection failed: ".mysqli_connect_error());
}

date_default_timezone_set('Europe/Belgrade');

echo "<form method='POST' action='".setComments($conn)."'>
	<input type='hidden' name='uid' value='".$_SESSION["username"]."'>
	<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
	<textarea name='message' style='width:400px;height:80px;background-color:#fff;'></textarea><br>
	<button type='submit' name='commentSubmit' style='width:100px;height:30px;background-color:#282828;border:none;color:#fff;font-family:arial;font-weigth:400;cursor:pointer;margin-bottom:40px;'>Comment</button>
</form>";
getComments($conn);
function setComments($conn){
	if(isset($_POST['commentSubmit'])){		
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		
		$sql = "INSERT INTO commentsection (uid, date, message) VALUES ('$uid','$date','$message')";
		$result = $conn->query($sql);
	}
}
function getComments($conn){
	$sql = "SELECT * FROM commentsection";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		echo "<div style='width:815px;padding:20px;margin-bottom:4px;background-color:#D5E5E4;border-radius:4px;color:#000000;position:relative;'>";
			echo $row['uid']."<br>";
			echo $row['date']."<br>";
			echo nl2br($row['message']);
			if($row['uid'] == $_SESSION["username"] || $_SESSION['powerlevel'] >= 1){
				echo "
			<form method='POST' action='".deleteComment($conn)."' style='position:absolute;top:0px;right:40px;'>
				<input type='hidden' name='id' value='".$row['id']."'>
				<button type='submit' name='commentDelete'>Delete</button>
			</form>
			<form method='POST' action='Komentari/edit.php' style='position:absolute;top:0px;right:0px;'>
				<input type='hidden' name='id' value='".$row['id']."'>
				<input type='hidden' name='uid' value='".$row['uid']."'>
				<input type='hidden' name='date' value='".$row['date']."'>
				<input type='hidden' name='message' value='".$row['message']."'>
				<button>Edit</button>
			</form>";
			}
			
		echo "</div>";
	}
	
}

function deleteComment($conn){
	if(isset($_POST['commentDelete'])){	
		$id = $_POST['id'];	
		$sql = "DELETE FROM commentsection WHERE id='$id'";
		$result = $conn->query($sql);
		header("Location: LoggedMain.php");
	}

	
}
?>