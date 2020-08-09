<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from books WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Book Deleted Successfully');</script>";
	header('Location: admin_book_list.php');}}
$con->close();
?>