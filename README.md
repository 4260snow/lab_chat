# Лабораторная работа 3. Изучение технологии AJAX
*****
##Цель работы
Разработать и реализовать анонимный чат. В интерфейсе отображается список каналов. Пользователь может либо подключится к существующему каналу, либо создать новый. Сообщения доставляются без обновления страницы

## Дополнительные задания
* Приватные каналы (с доступом по имени)
* автоматическое удаление сообщений через заданный интервал
* автоматическое удаление старых (неактивных) каналов
* защита от флуда (ограничение количества сообщений в минуту)
* фильтр слов

## Ход работы
### Пользовательский интерфейс
* Страница входа

![Рис. 1 - Вход](https://github.com/4260snow/lab_chat/blob/main/images/login.png)

* Главная страница

![Рис. 2 - Интерфейс](https://github.com/4260snow/lab_chat/blob/main/images/ui.png)

* Чат

![Рис. 3 - Чат](https://github.com/4260snow/lab_chat/blob/main/images/chat.png)

### Сценарии работы

* Пользователь вводит username и попадает на главную страницу. Он может выполнить поиск каналов. Если в названии открытого канала встерчается введённая последовательность символов, то он отобразится. И пользователь сможет к нему присоеденится
* Пользователь вводит название приватного канала. Если его имя есть в списке, тех кому доступен чат, то чат отобразится, иначе приватного канала не будет в списке.
* Созднаие нового канала. Пользователь вводит название. При желании создать приватный канал отмечает соответствующий чекбокс и вводит желаемые имена через запятую
* Пользователь может войти в доступный канал и написать сообщение. Перед отправкой сообщение проверяется на наличие запрещённых слов. Чат с переодичностью в 2 секунды посылает запрос к базе данных. В случае наличия сообщений выводит их на экран, изменяя страницу (без обновлений)

## Описание client-server
* Получение сообщений

![Рис. 4 - Чат](https://github.com/4260snow/lab_chat/blob/main/images/get_msg.svg)

## Структура базы данных MySQL
Для хранения данных используется MySQL.Которая содержит 2 таблицы: чаты, сообщения

* Таблица с чатами
party - список разрешённых пользователей

```sh
{
    "username_1": True,
    ....
    "username_n": True,
}
```

| Имя        | Тип                | доп.  |
| -----------|:------------------:| -----:|
| id         | int (unsigned)     | A_I   |
| name       | tinytext           |       |
| party      | JSON               | NULL  |
| last_msg   | datetime           |       |

* Таблица сообщений

| Имя        | Тип                | доп.  |
| -----------|:------------------:| -----:|
| id         | int (unsigned)     | A_I   |
| author     | tinytext           |       |
| chat_id    | int (unsigned)     |       |
| date       | datetime           |       |
| text       | text               |       |

## Значимые фрагменты кода
* Обработка события отправки сообщения и отправление запросов о получении новых сообщений
```js
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
```

* Формирование списка сообщений (без обновлений страницы)
```js
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
```

* Получение списка соообщений и удаление тех, которые старше 1 дня
```php
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
```
