var list_of_msg;

$(document).ready(function(){
	list_of_msg = [];
	chatRequest();
	setInterval(chatRequest, 2000);

	$('#btnSend').click(function(elem){
		var chat_id = $('#chat_id').val();
		var author = $('#author').val();
		var text = $('#text').val();
		if (text){
			$.post('write_bd.php', {chat_id: chat_id, author: author, text : text}, function(){
				$('#text').attr('value', '');
			});
		}
	});
});

function chatRequest()
{
  $.post('get_message.php',  {chat_id: chat_id}, chatResult, 'json');
}

function chatResult(msgs){
	for(var i = 0; i < msgs.length; i++)
	{
		var msg = new Object();
		msg.date = msgs[i]['date'];
		msg.author = msgs[i]['author'];
		msg.text = msgs[i]['text'];
		list_of_msg.push(msg);
	}

	var html = '';
	for (var i = list_of_msg.length - 1; i >= 0; i--) {
		var msg = list_of_msg[i];
		if (m.text){
			html +='<div class="qbox clearfix"><div class="bname col-md-2 pull-left center-block"><p>'+msg.author+'</p></div>';
			html +='<div class="bnameprobel col-md-10 pull-left"><blockquote class="post bg-success pull-left"><p >'+msg.text+'<br><span class="data">'+msg.date+'</span></p></blockquote></div></div>';
		}
	}
	list_of_msg = [];
	$('#chat').html(html);
}
