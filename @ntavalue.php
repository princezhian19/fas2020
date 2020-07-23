<?php

include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{
if(empty($_POST["query"])){
$q = $_POST["query"];
	

$results = $conn->prepare("SELECT * FROM nta  WHERE ntano ='$q'");
}
else
{
 
$q = $_POST["query"];
$results = $conn->prepare("SELECT ntano,balance  FROM nta  WHERE ntano = '$q' ");
echo "SELECT ntano,balance  FROM nta  WHERE ntano = '$q' ";
exit();

}


$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{

     echo '<tr onclick="javascript:showRow2(this);">' .
      
    '<td style="text-align: center;" >' . $row['ntano'] . '</td>' . 
    '<td hidden>' . $row['balance'] .'</td>' . 
    '<td hidden>' . $row['balance'] . '</td>' . 
    '<td hidden>' . $row['balance'] . '</td>' . 
    '<td hidden>' . $row['balance'] . '</td>' .
	
    '</tr>';
    
    
} 
}


?>