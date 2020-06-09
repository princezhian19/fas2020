<?php

include('db.class.php'); // call db.class.php
$mydb = new db(); 

$conn = $mydb->connect();


if(isset($_POST["cat"]))
{

/* $q = $_POST["cat"]; */

$results = $conn->prepare("SELECT max(count)+1 as a FROM roo_count order by id desc limit 1");


$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
   $count = $row['a'];
    
    echo  $count;
} 

}
?>