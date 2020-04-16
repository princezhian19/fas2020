<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{

if(empty($_POST["query"])){


$q = $_POST["query"];
    

$results = $conn->prepare("SELECT DISTINCT * FROM saro  WHERE uacs LIKE '%".$q."%' LIMIT 1 ");




}
else
{
    $q = $_POST["query"];
    
 
 $results = $conn->prepare("SELECT DISTINCT * FROM saro  WHERE uacs LIKE '%".$q."%' LIMIT 1 ");


}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
     echo '<tr onclick="javascript:showRow2(this);">' .
      
    '<td hidden>' . $row['uacs'] . '</td>' . 
    '<td hidden>' . $row['uacs'] .'</td>' . 
    '<td hidden>' . $row['uacs'] . '</td>' . 
    '<td hidden>' . $row['uacs'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['uacs'] . '</td>' . 
    '<td hidden>' . $row['uacs'] . '</td>' .
	'<td hidden>' . $row['uacs'] . '</td>' .
    '</tr>';
    
    
} 
}

?>