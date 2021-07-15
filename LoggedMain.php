<?php
$username = 
session_start();
echo "You're logged in as: " .$_SESSION["username"];echo "<br>";
echo "Your powerleve is: ".$_SESSION['powerlevel'];
echo "<div align='center'>";
echo "<font size='40'";
echo "<h1>Home Page</h1>";
echo "</font>";
echo "</div>";
echo "<form action='Login.php' style='display: inline-block;'>
    <input type='submit' value='Logout' />
</form>";
echo "<hr>";
echo "Vesti:";
echo "<div style='width:100%;overflow:auto;height:44px;white-space;nowrap;'>";
echo "<form action='Vesti/Sport.php' style='display: inline-block;'>
    <input type='submit' value='Sport' />
</form>";
echo "<form action='Vesti/VestiDana.php' style='display: inline-block;'>
    <input type='submit' value='Vesti Dana' />
</form>";

echo "</div>";
echo "Komentari:";

include 'Komentari\komentari.php';
?>
