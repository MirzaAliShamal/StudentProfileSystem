<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "Delete from fee_voucher WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Voucher Deleted Successfully');</script>";
	header('Location: admin_voucher_list.php');}}
$con->close();
?>