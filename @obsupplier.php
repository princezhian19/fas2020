<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{
if(empty($_POST["query"])){
$q = $_POST["query"];
	


$results = $conn->prepare("SELECT  * FROM supplier  WHERE supplier_title LIKE '%".$q."%' order by id desc ");
}

else
{
 $q = $_POST["query"];
 $results = $conn->prepare("SELECT  * FROM supplier  WHERE supplier_title LIKE '%".$q."%' order by id desc ");

}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
     echo '<tr onclick="javascript:showRow4(this);">' .
      
    '<td style="text-align: center;" >' . $row['supplier_title'] . '</td>' . 
    '<td hidden>' . $row['supplier_title'] .'</td>' . 
    '<td hidden>' . $row['supplier_title'] . '</td>' . 
    '<td hidden>' . $row['supplier_title'] . '</td>' . 
    '<td hidden>' . $row['supplier_title'] . '</td>' . 
    '<td hidden>' . $row['supplier_title'] . '</td>' .
	'<td hidden>' . $row['supplier_title'] . '</td>' .
    '</tr>';
    
    
} 
}

?>