<?php
include "system/dbconfig.php";

$voucher_no = $_GET['voucher_no'];

$sql = "Delete from fee_vouchers WHERE voucher_no = '$voucher_no'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	echo"<script>alert('Student Deleted Successfully');</script>";
	header('Location: admin_fee_readjust.php');}}
$conn->close();
?>