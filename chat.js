var _msg_list;

$(document).ready(function(){
	_msg_list = [];
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
		var m = new Object();
		m.date = msgs[i]['date'];
		m.author = msgs[i]['author'];
		m.text = msgs[i]['text'];
		_msg_list.push(m);
	}

	var html = '';
	for (var i = _msg_list.length - 1; i >=0; i--) {
		var m = _msg_list[i];
		if (m.text){
			html +='<div class="qbox clearfix"><div class="bname col-md-2 pull-left center-block"><p>'+m.author+'</p></div>';
			html +='<div class="bnameprobel col-md-10 pull-left"><blockquote class="post bg-success pull-left"><p >'+m.text+'<br><span class="data">'+m.date+'</span></p></blockquote></div></div>';
		}
	}
	_msg_list = [];
	$('#chat').html(html);
}
