<?php
require "connadmin.php";
$item = $_POST["item1"];
$date = $_POST["date"];
session_start();
$username =  $_SESSION["username"];
$budget = $_POST["budget"];
$sql = "INSERT INTO searched_items (username,item,budget,priority) VALUES ('$username','$item','$budget','$date')";
if ($conn->query($sql) === TRUE) {
    header("Location: /home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
