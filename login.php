<?php
require "connadmin.php";
$user_name = $_POST["username"];
session_start();
$_SESSION["username"] = $_POST["username"];
$user_pass = $_POST["password"];
// $user_name = $_GET["username"];
// session_start();
// $_SESSION["username"] = $_GET["username"];
// $user_pass = $_GET["password"];
// $latitude = $_GET["latitude"];
// $longitude = $_GET["longitude"];
$mysql_qry = "select * from admin where username like '$user_name' and password like '$user_pass';";
$result = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result)>0)
{
	// $mysql_qry = "UPDATE `admin` SET `latitude`='$latitude',`longitude`='$longitude' WHERE username='$user_name';";
	// $result = mysqli_query($conn ,$mysql_qry);
	header("Location: /home.php"); /* Redirect browser */
	exit();
}
	//echo "loginsuccess";
else
header("Location: /loginincorrect.html");
	//echo"login not successful";
?>
