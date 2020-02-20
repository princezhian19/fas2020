<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{

$q = $_POST["query"];
	
$results = $conn->prepare("SELECT purpose,iar.id,iar.rfq_id,iar.app_id,iar.dept,iar.po_no FROM rfq left join iar on iar.rfq_id = rfq.id WHERE ccode LIKE '%" . $q . "%'
OR po_no LIKE '%".$q."%' LIMIT 1
");


}
else
{
 
 $results = $conn->prepare("SELECT purpose,iar.id,iar.rfq_id,iar.app_id,iar.dept,iar.po_no FROM rfq left join iar on iar.rfq_id = rfq.id");

}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{

	 $div = $row['dept'];
	if ($div == 'LGCDD') {
		$person = "ELOISA G. ROZUL";
	}
	if ($div == 'LGCDD-MBRTG') {
		$person = "ELOISA G. ROZUL";
	}
	if ($div == 'LGMED') {
		$person = "JOHN M. CEREZO";
	}
	if ($div == 'FAD') {
		$person = "DR. CARINA S. CRUZ";
	}
	if ($div == 'ORD') {
		$person = "DR. CARINA S. CRUZ";
	}
	 echo '<tr onclick="javascript:showRow(this);">' . 
    '<td hidden>' . $row['id'] . '</td>' . 
    '<td hidden>' . $row['rfq_id'] . '</td>' . 
    '<td hidden>' . $row['app_id'] . '</td>' . 
    '<td hidden>' . $row['dept'] . '</td>' . 
    '<td style="text-align: center;" >' . $row['po_no'] . '</td>' . 
    '<td hidden >' . 'Procurement of  '.$row['purpose'] . '</td>' . 
    '<td hidden>' . $person . '</td>' . 

	'</tr>';
} 



?>