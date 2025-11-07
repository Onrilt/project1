12
<a href="http://localhost/news.php"> Посмотреть новости</a>
<?php

// $lol = $conn->real_escape_string($_GET['delete']);
echo ($_GET['delete']);
   $hostname = 'localhost';
   $username = 'root';
   $passwordname = 'root';
   $basename = 'testdb';
   $conn = new mysqli($hostname, $username, $passwordname, $basename) or die       ('Невозможно открыть базу');
   // Формируем запрос из таблицы с именем blog
   $sql = "SELECT * FROM `news`";
   $result = $conn->query($sql); 
// Create connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$lol = $conn->real_escape_string($_GET['delete']);
$sql = "DELETE FROM News WHERE NewsId=$lol";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

// $conn->close();

// mysqli_close($conn);
	header('Location: news.php');
?>
