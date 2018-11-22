<?php
require "connadmin.php";
session_start();
$username =  $_SESSION["username"];
$mysql_qry = "select * from history where username like '$username';";
$result = mysqli_query($conn ,$mysql_qry);
$items=array();
if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_assoc($result))
	 {
		 //echo "<center>";
		// echo '<font color=\'blue\'><div style="border:1px solid red; padding:16px;"></font>';
    array_push($items,$row["item"]);
	//	echo " Item Name: " . $row["item"]. " <br>";
		echo "</center>";
	}
  $result = array_unique($items);
  for($m=0;$m<sizeof($result);$m++)
  {
    echo "<center>";
   echo '<font color=\'blue\'><div style="border:1px solid red; padding:16px;"></font>';
  echo " Item Name: " . $result[$m]. " <br>";
   echo "</center>";
  }
}
else
{
	echo 'no items';
}
?>
