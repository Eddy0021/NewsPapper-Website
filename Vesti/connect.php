<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "database_name";
$conn = mysqli_connect($servername, $username, $password, $db);
if(!$conn){
	die("connection failed: ".mysqli_connect_error());
}

?>