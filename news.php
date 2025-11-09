
<?php
include 'connection.php';


echo "<br> Новости" . $_GET['Firstname'];




echo ('</p>');

   $sql = "SELECT * FROM `news`";
   $result = $conn->query($sql); 

   while ($row = $result->fetch_assoc())
   {

       echo ("------------------------------------------------------".'</p>');
    echo ("Новость N ");
 echo $row['NewsId'];

 echo ('</p>');

 echo ($row['MainNews'].'</p>');

   }

   
   ?>