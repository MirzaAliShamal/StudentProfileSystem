<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from students WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
		
	header('Location: clerk_student_list.php');}}
$conn->close();
?>