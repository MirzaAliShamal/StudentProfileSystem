<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from book_categories WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Book Category Deleted Successfully');</script>";
	header('Location: admin_book_category_list.php');}}
$con->close();
?>