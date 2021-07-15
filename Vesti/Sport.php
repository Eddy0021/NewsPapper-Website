<?php
include 'connect.php';
session_start();
date_default_timezone_set('Europe/Belgrade');
echo "<div align='center'>";
echo "<font size='40'";
echo "<h1>Sport</h1>";
echo "</font>";
echo "</div>";

echo "<div>";
echo "<form action='..\LoggedMain.php'>
		<input type='submit' value='Home' />
	</form>";
	if($_SESSION['powerlevel'] >= 1){
		echo"<form align='right' action='NoviVestiSport.php'>
		<input type='submit' value='Dodaj Novi Vest'/>
	</form>";
	}
echo "</div>";
echo "<hr>";


getNews($conn);
function getNews($conn){
	$sql = "SELECT * FROM sport";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		echo"<div style='width:815px;padding:20px;margin-bottom:4px;background-color:#D5E5E4;border-radius:4px;color:#000000;position:relative;'>";
		echo "<b>".$row['naslov']."<br></b>";
		echo $row['date']."<br><hr>";
		echo $row['message']."<br>";
		if($_SESSION['powerlevel'] >= 1){
			echo"<form method='POST' action='".deleteVesti($conn)."' style='position:absolute;top:0px;right:0px;'>
				<input type='hidden' name='id' value='".$row['id']."'>
				<button type='submit' name='deleteVesti'>Delete</button>
			</form>";
		}
		
		echo"</div>";
	}
}
function deleteVesti($conn){
	if(isset($_POST['deleteVesti'])){	
		$id = $_POST['id'];	
		$sql = "DELETE FROM sport WHERE id='$id'";
		$result = $conn->query($sql);
		header("Location: Sport.php");
	}

	
}
?>