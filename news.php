
<?php
echo ('</p>');
   // Подключение к базе: где $hostname - сервер, $username - имя юзера БД,
   // $password - пароль юзера, $basename - имя базы с которой мы будем работать
   $hostname = 'localhost';
   $username = 'root';
   $passwordname = 'root';
   $basename = 'testdb';
   $conn = new mysqli($hostname, $username, $passwordname, $basename) or die       ('Невозможно открыть базу');
   // Формируем запрос из таблицы с именем blog
   $sql = "SELECT * FROM `news`";
   $result = $conn->query($sql); 
   // В цикле перебираем все записи таблицы и выводим их
   while ($row = $result->fetch_assoc())
   {
       // Оператором echo выводим на экран поля таблицы name_blog и text_blog
       echo ("------------------------------------------------------".'</p>');
    echo ("Новость N ");
 echo $row['NewsId'];

 echo ('</p>');

 echo ($row['MainNews'].'</p>');

   }
   ?>