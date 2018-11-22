<?php
require "connadmin.php";
$user_name = $_POST["username"];
$user_pass = $_POST["password"];
$mysql_qry = "select * from admin where username like '$user_name';";
$result = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result)>0)
{
	header("Location: /registeragain.html"); /* Redirect browser */
	exit();
}

	//echo "loginsuccess";
else
{
$sql = "INSERT INTO admin (username, password)
VALUES ('$user_name','$user_pass')";

if ($conn->query($sql) === TRUE) {
    header("Location: /login2.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>
