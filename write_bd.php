<?php
	$table = "messages";
	$author = $_POST["author"];
	$chat_id = $_POST["chat_id"];
	$text = $_POST["text"];

	$con = mysqli_connect("localhost", "root", "", "chat");
	# Запрос $sql "SELECT * FROM $table WHERE `author`=$author", затем узнать время последнего сообщения
	# Если меньше чем 30 секунд, то не записывать сообщение
	# с помощью strripos найти запрещённые слова и заменить на "*" с помощью str_replace

	$sql = "INSERT INTO `$table` (`author`, `chat_id`, `date`, `text`) VALUES ('$author', '$chat_id', NOW(),'$text')";
	$res = mysqli_query($con, $sql);
	print_r($res);	
?>
