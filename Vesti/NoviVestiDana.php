<?php
include 'connect.php';
date_default_timezone_set('Europe/Belgrade');
echo "<form method='POST' action='".dodajVestDana($conn)."'>
	Naslov: <input type='text' name='naslov' value=''><br>
	<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'> Vesti:<br>
	<textarea name='message' style='width:400px;height:80px;position:relative;resize:none;'></textarea><br><br>
	<button type='submit' name='NewVesti' style='width:100px;height:30px;background-color:#282828;border:none;color:#fff;font-family:arial;font-weigth:400;cursor:pointer;margin-bottom:40px;'>Dodaj Novi Vest</button>
</form>";
echo "<hr>";


function dodajVestDana($conn){
	if(isset($_POST['NewVesti'])){			
		$naslov = $_POST['naslov'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		
		$sql = "INSERT INTO vesti (naslov, date, message) VALUES ('$naslov','$date','$message')";
		$result = $conn->query($sql);
		header("Location: VestiDana.php");
	}
	
}
?>