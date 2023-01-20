var _maxId;
var _msg_list;

$(document).ready(function(){
	_maxId = 0;
	_msg_list = [];
	chatRequest();
	//setInterval(chatRequest, 2000);

	$('#btnSend').click(function(elem){
		var text = $('#text').val();
		$.post('add.php', {text: text}, function(){
			$('#text').attr('value', '');
		});
	});
});

function chatRequest()
{
  $.post('get_chats.php', {maxId: _maxId}, chatResult, 'json');
}

function chatResult(msgs){
	for(var i = 0; i < msgs.length; i++)
	{
		var m = new Object();
		m.dt = msgs[i]['date'];
		m.name = msgs[i]['name'];
		m.text = msgs[i]['text'];
		_msg_list.push(m);
		_maxId++;
	}

	var html = '';
	for (var i = _msg_list.length - 1; i >=0; i--) {
		var m = _msg_list[i];
		html +='<div class="qbox clearfix"><div class="bname col-md-2 pull-left center-block"><p>'+m.name+'</p></div>';
		html +='<div class="bnameprobel col-md-10 pull-left"><blockquote class="post bg-success pull-left"><p >'+m.text+'<span class="data">'+m.dt+'</span></p></blockquote></div></div>';
		}
	$('#chat').html(html);
}

