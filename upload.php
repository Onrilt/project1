
<?php
if ($_SERVER['REQUEST_METHOD']
==
'POST') {
$targetDirectory = "uploads/"; // Директория для сохранения файла
$targetFile = $targetDirectory . basename($_FILES["uploadedFile"]["name"]); $uploadOk = 1;
}
// // Проверяем, существует ли файл
// if (file_exists($targetFile)) {
// echo "Извините, файл уже существует.";
// $uploadOk = 0;

// }
// // Проверяем размер файла
// if ($_FILES["uploadedFile"]["size"] > 500000) {
// есно "Извините, файл слишком большой.";
// $uploadOk
// = 0;
// }
// // Проверяем, является ли файл изображением
// $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
// if ($imageFileType != "jpg" && $imageFileTyре != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif") {
// есно "Извините, только JPG, JPEG, PNG и GIF файлы разрешены.";
// $uploadOk = 0;
// }
// // Проверяем, можно ли загрузить файл
 if ($uploadok
 ==
 : 0) {
 echo "Извините, файл не был загружен.";
 } 
        else{
 if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $targetFile)) {
 echo "Файл ". htmlspecialchars(basename($_FILES["uploadedFile"]["name"])). " был загружен."; } else {
 }
}
// есно "Извините, произошла ошибка при загрузке вашего файла."s;
