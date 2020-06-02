<?php

include('db.class.php'); // call db.class.php
$mydb = new db(); 

$conn = $mydb->connect();


if(isset($_POST["issuance_no"]))
{

$q = $_POST["issuance_no"];

$results = $conn->prepare("SELECT * FROM issuances_office_responsible WHERE issuance_id ='$q'");


$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
    $office_responsible1 = $row['office_responsible'];
    
    echo  $office_responsible1.';';
} 

}
?>