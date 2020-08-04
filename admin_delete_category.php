<?php
include "system/dbconfig.php";

$category = $_GET['category'];

$sql = "Delete from books_category WHERE category = '$category'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
		
	header('Location: admin_add_category.php');}}
$conn->close();
?>