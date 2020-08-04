<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from programs WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Program Deleted Successfully');</script>";
	header('Location: admin_program_list.php');}}
$con->close();
?>