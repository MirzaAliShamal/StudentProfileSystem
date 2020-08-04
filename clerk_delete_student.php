<?php
include "system/dbconfig.php";

$rollno = $_GET['rollno'];

$sql = "Delete from students WHERE rollno = '$rollno'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){	
	header('Location: clerk_dashboard.php');}}
$conn->close();
?>