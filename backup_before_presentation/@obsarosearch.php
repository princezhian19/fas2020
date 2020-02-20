<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{
if(empty($_POST["query"])){
$q = $_POST["query"];
	

$results = $conn->prepare("SELECT DISTINCT * FROM saro  WHERE saronumber LIKE '%".$q."%' LIMIT 1 ");
}

else
{
 $q = $_POST["query"];
 $results = $conn->prepare("SELECT DISTINCT * FROM saro  WHERE saronumber LIKE '%".$q."%' LIMIT 1 ");

}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
     echo '<tr onclick="javascript:showRow1(this);">' .
      
    '<td hidden>' . $row['saronumber'] . '</td>' . 
    '<td hidden>' . $row['saronumber'] .'</td>' . 
    '<td hidden>' . $row['saronumber'] . '</td>' . 
    '<td hidden>' . $row['saronumber'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['saronumber'] . '</td>' . 
    '<td  hidden style="text-align: center;">' . $row['sarogroup'] . '</td>' .
	'<td hidden>' . $row['saronumber'] . '</td>' .
    '</tr>';
    
    
} 
}

?>