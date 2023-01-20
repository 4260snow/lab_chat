<?php
$text = $_POST['text'];
if($text != ''){
    $strings = file('messages.txt');
    if(count($strings)>100){
//получаем все строки из файла в виде нумерованного массива
        $textarr=file('messages.txt');
        $arr=array_slice($textarr, -5);
//переписываем данные в файл записываем только последние 3 строки массива 
        $f = fopen('messages.txt', 'w+');
//в цикле записываем данные в файл, каждое значение массива на новой строке в файле
        foreach($arr as $ar){
            $f = fopen('messages.txt', 'a+');//открыли файл
            fwrite($f, $ar);//запись
            fclose($f);//закрыли файл
        }
    }
    $f = fopen('messages.txt', 'a+');//открыли файл
    fwrite($f, date('Y-m-d H:i:s') . "___");//запись
    fwrite($f, "___");//запись в файл
    fwrite($f, $text . "\n");//запись и добавили конец строки
    fclose($f);//закрыли файл
}
?>
