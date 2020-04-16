<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{

$q = $_POST["query"];
	
$results = $conn->prepare("SELECT id,price,procurement FROM app WHERE procurement LIKE  '%" . $q . "%'
OR id LIKE '%".$q."%' LIMIT 1
");

}
else
{
 
 $results = $conn->prepare("SELECT * FROM app");

}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
	 echo '<tr onclick="javascript:showRow(this);">' . 
    '<td hidden>' . $row['id'] . '</td>' . 
    '<td hidden>' . $row['price'] . '</td>' . 
    '<td hidden>' . $row['price'] . '</td>' . 
    '<td hidden>' . $row['price'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['procurement'] . '</td>' . 
    '<td hidden>' . $row['price'] . '</td>' . 

	'</tr>';
} 


?>