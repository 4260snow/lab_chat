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
```js
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

```
