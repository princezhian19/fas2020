<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{
if(empty($_POST["query"])){
$q = $_POST["query"];
	


$results = $conn->prepare("SELECT  * FROM saro  WHERE saronumber LIKE '%".$q."%' group by saronumber desc  LIMIT 5 ");
}

else
{
 $q = $_POST["query"];
 $results = $conn->prepare("SELECT  * FROM saro  WHERE saronumber LIKE '%".$q."%' group by saronumber desc  LIMIT 5  ");

}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
     echo '<tr onclick="javascript:showRow1(this);">' .
      
    '<td hidden>' . $row['saronumber'] . '</td>' . 
    '<td hidden>' . $row['uacs'] .'</td>' . 
    '<td hidden>' . $row['saronumber'] . '</td>' . 
    '<td hidden>' . $row['saronumber'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['saronumber'] . '</td>' . 
    '<td  hidden style="text-align: center;">' . $row['sarogroup'] . '</td>' .
	'<td hidden>' . $row['ppa'] . '</td>' .
    '</tr>';
    
    
} 
}

?>