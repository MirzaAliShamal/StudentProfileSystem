<?php
include "system/dbconfig.php";

$id = $_GET['id'];

$sql = "UPDATE `books` SET `issue`='' WHERE id = '$id'";
if($result = mysqli_query($con, $sql)){
    if($result > 0){
	header('Location: librarian_recieve_book.php');}}
$conn->close();
?>