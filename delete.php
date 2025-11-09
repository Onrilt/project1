12
<a href="http://localhost/news.php"> Посмотреть новости</a>
<?php


echo ($_GET['delete']);
include 'connection.php';

   $sql = "SELECT * FROM `news`";
   $result = $conn->query($sql); 

$lol = $conn->real_escape_string($_GET['delete']);
$sql = "DELETE FROM News WHERE NewsId=$lol";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

	header('Location: news.php');
?>
