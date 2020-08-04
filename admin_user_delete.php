<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from users WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('User Deleted Successfully');</script>";
	header('Location: admin_user_list.php');}}
$con->close();
?>