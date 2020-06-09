<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{


if(empty($_POST["query"])){







$q = $_POST["query"];
	
$results = $conn->prepare("SELECT * FROM app WHERE procurement LIKE  '%".$q."%'  group by procurement asc");
}

else
{
 
$q = $_POST["query"];


$results = $conn->prepare("SELECT * FROM app WHERE procurement LIKE  '%".$q."%' group by procurement asc ");
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