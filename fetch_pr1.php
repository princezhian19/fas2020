<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

/* echo $user_id; */

if(isset($_POST["query"]))
{

    $getPmo = $_POST['name'];
      
      if ($getPmo == "ORD") {
        $getPmo = 1;
      }
      if ($getPmo == "LGMED") {
        $getPmo = 3;
      }
      if ($getPmo == "LGCDD") {
        $getPmo = 4;
      }
      if ($getPmo == "FAD") {
        $getPmo = 5;
      }
      if ($getPmo == "LGMED-PDMU") {
        $getPmo = 6;
      }
      if ($getPmo == "LGCDD-MBRTG") {
        $getPmo =7 ;
      }


if(empty($_POST["query"])){
 
    
$results = $conn->prepare("SELECT * FROM app WHERE procurement LIKE  '%".$q."%' and pmo_id = '$getPmo' group by procurement asc ");
}

else
{
 

$q = $_POST["query"];


$results = $conn->prepare("SELECT * FROM app WHERE procurement LIKE  '%".$q."%' and pmo_id = '$getPmo' group by procurement asc ");
}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
     echo '<tr onclick="javascript:showRow(this); ">' . 
    '<td hidden>' . $row['id'] . '</td>' . 
    '<td hidden>' . $row['price'] . '</td>' . 
    '<td hidden>' . $row['sn'] . '</td>' . 
    '<td hidden>' . $row['price'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['procurement'] . '</td>' . 
    '<td hidden>' . $row['unit_id'] . '</td>' . 

    '</tr>';
} 
}


?>