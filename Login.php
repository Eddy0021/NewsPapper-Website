<?php
echo "<form align='center' method='POST'>";
echo "<div id='1'>";
echo "Username  <input type='text' name='username' value='' />";  echo "<br/>";
echo "Password  <input type='password' name='password' value='' />";  echo "<br/>";
echo "<input type='submit' name='login' value='Login' />";
echo "<input type='submit' name='register' value='Register'/>";
echo "</div>";
echo "<div id='2' style='display:none'>";
echo "New Username  <input type='text' name='Newusername' value='' />";  echo "<br/>";
echo "New Password  <input type='password' name='Newpassword' value='' />";  echo "<br/>";
echo "<input type='submit' name='CreateAccount' value='Create Account' />"; echo "<br/>";
echo "Already has an acconut? Click here to :<input type='submit' name='AlreadyHasAnAccount' value='Login' />";
echo "</div>";
echo "</fonm>";


if (isset($_POST['register'])) {
	echo"<script>";
	echo"onsubmit=document.getElementById('1').style.display = 'none';document.getElementById('2').style.display = '';";
	echo"</script>";
}
if (isset($_POST['AlreadyHasAnAccount'])) {
	echo"<script>";
	echo"onsubmit=document.getElementById('2').style.display = 'none';document.getElementById('1').style.display = '';";
	echo"</script>";
}
if (isset($_POST['login'])){
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "database_name";

	$conn = mysqli_connect($servername, $username, $password, $db) or die("Could not connect to database!");
	

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$query2 = "SELECT powerlevel FROM users WHERE username='$username'";
	$result = mysqli_query($conn ,$query2);
	$value = mysqli_fetch_object($result);
	
	
	
	
	$query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
	
	$result=mysqli_query($conn, $query);
	if(mysqli_num_rows($result)){
		$_SESSION["username"]=$username;
		$_SESSION['powerlevel']=$value->powerlevel;
		header("location: LoggedMain.php");
	}else{
		echo "Failed to login!";
	}

	
	mysqli_close($conn);
}
if(isset($_POST['CreateAccount'])){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "database_name";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);
	
	if(!empty($_POST['Newusername'] && !empty($_POST['Newpassword']))){
		$Newusername = ($_POST['Newusername']);
		$Newpassword = ($_POST['Newpassword']);
	}else{
		echo "Check your input!";
	}
	$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$Newusername'");
	if(mysqli_num_rows($query) > 0){
		echo "Username already exists";
	}
	else{
		if(mysqli_query($conn,"INSERT INTO users (username, password) VALUES ('$Newusername','$Newpassword')")){
		echo "Successfully registerd your account, now you can login :)";
		
		}else{
			echo "Failed to register your account";
		}
	}
	
	
	
	mysqli_close($conn);
}



?>
