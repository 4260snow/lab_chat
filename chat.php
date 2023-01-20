<!DOCTYPE html>
<html>
<head>
	<title>Чат</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="chat.js"></script>	
</head>

<body>
	<div class="wraper container">
		<div class="row">
			<form class="form-horizontal" role="form">
				<!--
				<input type="hidden" name="chat_id" value=<?php echo $_POST["chat_id"]?>>
				<input type="hidden" name="author"  value=<?php echo $_POST["author"]?>>
				-->
				<div class="form-group">
					<label for="text" class="col-sm-2 col-sm-offset-1 control-label">Сообщение</label>
					<div class="col-sm-7 ">
						<input type="hidden" id="author" name="author"  value=<?php echo $_GET["author"]?>>
						<input type="hidden" id="chat_id" name="chat_id" value=<?php echo $_GET["chat_id"]?>>
						<textarea class="form-control" rows="3" id="text" placeholder="Сообщение" name="text"></textarea>
					</div>
				</div>
			</form>
			<div class="col-sm-offset-7 col-sm-3">
			<button  id="btnSend" class="submit btn btn-primary col-sm-12 col-xs-8 btn-lg">Отправить</button>
			</div>
		</div>
		
		<div class="row">
			<div id="chat"></div>
		</div>

	</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
