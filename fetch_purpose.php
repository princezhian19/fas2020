<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{
if(empty($_POST["query"])){

$q = $_POST["query"];
	
$results = $conn->prepare("SELECT * FROM pr WHERE pr_no LIKE  '%".$q."%'
OR id LIKE '%".$q."%' LIMIT 1
");
}

else
{

$q = $_POST["query"];
   	
$results = $conn->prepare("SELECT * FROM pr WHERE pr_no LIKE  '%".$q."%'
OR id LIKE '%".$q."%' LIMIT 1
");
    
}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
	 echo '<tr onclick="javascript:showRow(this);">' . 
    '<td hidden>' . $row['purpose'] . '</td>' . 
    '<td hidden>' . $row['pr_date'] . '</td>' . 
    '<td hidden>' . $row['pr_date'] . '</td>' . 
    '<td hidden>' . $row['pr_date'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['pr_no'] . '</td>' . 
    '<td hidden>' . $row['pr_date'] . '</td>' . 
	'</tr>';
} 
}

?>