<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from users WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
		
	header('Location: admin_delete_user.php');}}
$conn->close();
?>