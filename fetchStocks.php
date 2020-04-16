<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{


if(empty($_POST["query"])){

    $results = $conn->prepare("SELECT * FROM item_list WHERE code LIKE '%" . $q . "%'
    OR item LIKE '%".$q."%' OR sn LIKE '%".$q."%' LIMIT 1");
    
    
}
else{
    $q = $_POST["query"];
    $results = $conn->prepare("SELECT * FROM item_list WHERE code LIKE '%" . $q . "%'
    OR item LIKE '%".$q."%' OR sn LIKE '%".$q."%' LIMIT 1");
    
    $results->execute();
    while($row = $results->fetch(PDO::FETCH_ASSOC))
    {   
        
         echo '<tr onclick="javascript:showRow(this);">' . 
        '<td hidden>' . $row['id'] . '</td>' . 
        '<td >' . $row['item'] . '</td>' .
        '</tr>';
    }
}	



}


 


?>