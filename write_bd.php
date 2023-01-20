<?php
	$table = "messages";
	$author = $_POST["author"];
	$chat_id = $_POST["chat_id"];
	$text = $_POST["text"];

	$con = mysqli_connect("localhost", "root", "", "chat");
	$sql = "INSERT INTO `$table` (`author`, `chat_id`, `date`, `text`) VALUES ('$author', '$chat_id', NOW(),'$text')";

	$res = mysqli_query($con, $sql);
	print_r($res);
	//header("Location: ../main.php");	
?>
