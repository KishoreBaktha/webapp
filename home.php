<?php
require "connadmin.php";
session_start();
$username =  $_SESSION["username"];
echo '<form action="/index.html" method="POST"><button style="float: right; margin-left: -50%;background-color: #4CAF50; /* Green */
	 border: none;
	 color: white;
	 padding: 15px 32px;
	 text-align: center;
	 text-decoration: none;
	 display: inline-block;
	 font-size: 16px;">LOGOUT</button></form><br><br><br><br>';
echo '<form action="/history.php" method="POST"><button style="float: right; margin-left: -50%;background-color: #FF0000; /* Green */
	 border: none;
	 color: white;
	 padding: 15px 32px;
	 text-align: center;
	 text-decoration: none;
	 display: inline-block;
	 font-size: 16px;">VIEW HISTORY</button></form><br>';
echo '<center><h1>Planned items!!!</h1></center><br><br>';
$mysql_qry = "select * from searched_items where username like '$username';";
$result = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_assoc($result))
	 {
		 echo "<center>";
		 echo '<font color=\'blue\'><div style="border:1px solid red; padding:16px;"></font>';
		echo " Item Name: " . $row["item"]. " <br>";
		echo " Budget: " . $row["budget"]. " <br>";
		echo " Date: " . $row["priority"]. " <br>";
		echo "</center>";
	}
	echo "<center>";
	echo '<form action="/search.php" method="POST"><button style="background-color: #FF0000; /* Green */
     border: none;
     color: white;
     padding: 15px 32px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 16px;">SEARCH</button></form><br><br>';
  echo "</center>";
}
else
{
	echo "<center>";
	echo '<img height="400" width=300" src="noitem.png">',"<br>";
	echo "<center>";
}
echo "<br><br><br><br><br><br>";
 echo '<form action="/home.html" method="POST"><button style="float: right; margin-left: -50%; background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;">ADD NEW ITEM</button></form><br><br>';
	//echo"login not successful";
?>
