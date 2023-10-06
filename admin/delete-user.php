<?php 
	include 'config.php';
	$user_id = $_GET['id'];
	$sql = "DELETE FROM users WHERE user_id='{$user_id}'";
	$result =mysqli_query($conn,$sql);
	header('location:users.php');
?>