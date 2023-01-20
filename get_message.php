<?php
	$id = $_POST["chat_id"]; 

	$table = "messages";
	$con = mysqli_connect("localhost", "root", "", "chat");
	
	$sql = "DELETE FROM `messages` WHERE `date` < DATE_SUB(NOW(), INTERVAL 1 DAY)";
	mysqli_query($con, $sql);
	
	$sql = "SELECT * FROM `$table` WHERE chat_id=$id";
	$info = mysqli_query($con, $sql);
	$res = mysqli_fetch_all($info, MYSQLI_ASSOC);

	print_r(json_encode($res));
?>
