<?php

include('db.class.php'); // call db.class.php
$mydb = new db(); 

$conn = $mydb->connect();


if(isset($_POST["vrno"]))
{

$q = $_POST["vrno"];

$results = $conn->prepare("SELECT * FROM vr_passsengers WHERE vrid ='$q'");


$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
    $name = $row['name'];
    
    echo  $name.'<br>';
} 

}
?>