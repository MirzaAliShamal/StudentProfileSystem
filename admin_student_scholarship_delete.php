<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from student_scholarships WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Scholarship Deleted Successfully');</script>";
	header('Location: admin_student_scholarship_list.php');}}
$con->close();
?>