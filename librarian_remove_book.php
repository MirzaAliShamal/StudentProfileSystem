<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from books WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
		
	header('Location: librarian_dashboard.php');}}
$conn->close();
?>