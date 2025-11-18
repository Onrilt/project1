<?php
$filename = '.gitignore';
if (file_exists($filename)) {
    //  echo "Файл $filename существует ";
    //определяем константу для имени файла
define('FILENAME', '.gitignore');
// проверяем наличие содержимого в файле, считывая содержимое файла в строку
} else {
    
    $myfile = fopen(".gitignore", "w");
    

fwrite($myfile, $txt);

fwrite($myfile, $txt);
fclose($myfile);
    echo "Файл $filename отсутствует////создан пустой файл///";
}
if (filesize(".gitignore")===0){
    echo("ОШИБКА:  файл .gitignore пустой,но он существует");
}
