<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from results WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Result Record Deleted Successfully');</script>";
	header('Location: clerk_student_result_list.php');}}
$con->close();
?>