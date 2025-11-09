
<a href="http://localhost/news.php"> Посмотреть новости</a>
<?php

if($_GET['Firstname']==NULL){

    echo("лалка");}
else{
  include 'connection.php';

echo "<br> Ваше имя" . $_GET['Firstname'];
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$age = $conn->real_escape_string($_GET['Firstname']);
$sql = "INSERT INTO News (MainNews)
VALUES  ('$age')";





if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}
	header('Location: news.php');