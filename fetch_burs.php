<?php
//Artworks of Scanhead   HNU 2017
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

$conn = $mydb->connect();

if(isset($_POST["query"]))
{

$q = $_POST["query"];
	
$results = $conn->prepare("SELECT DISTINCT qq.purpose,po.po_date,rfq_items.abc,po.po_no,supplier.supplier_address, supplier.supplier_title, pmo.pmo_title,supplier_quote.supplier_id,supplier_quote.rfq_item_id,rfq_items.rfq_id,app.id FROM supplier_quote LEFT JOIN selected_quote ON supplier_quote.id = selected_quote.supplier_quote_id LEFT JOIN supplier ON supplier.id = supplier_quote.supplier_id LEFT JOIN po ON po.id = selected_quote.po_id LEFT JOIN rfq_pmo ON rfq_pmo.rfq_id = selected_quote.rfq_id LEFT JOIN pmo on pmo.id = rfq_pmo.pmo_id LEFT JOIN rfq ON rfq.id = selected_quote.rfq_id LEFT JOIN  rfq_items on rfq_items.rfq_id = selected_quote.rfq_id LEFT JOIN app on app.id = rfq_items.app_id LEFT JOIN rfq qq on qq.id = rfq_items.rfq_id WHERE po.po_date IS NOT NULL and po.po_no IS NOT NULL AND supplier.supplier_title LIKE '%" . $q . "%'
OR po.po_no LIKE '%".$q."%' LIMIT 1
");


}
else
{
 
 // $results = $conn->prepare("SELECT DISTINCT * FROM app a left join rfq_items rfq on a.id = rfq.app_id where a.id = rfq.app_id ");
 // $results = $conn->prepare("SELECT DISTINCT po.po_date, po.po_no,supplier.supplier_address, supplier.supplier_title, pmo.pmo_title,supplier_quote.supplier_id,supplier_quote.rfq_item_id,rfq_items.rfq_id,app.id FROM supplier_quote LEFT JOIN selected_quote ON supplier_quote.id = selected_quote.supplier_quote_id LEFT JOIN supplier ON supplier.id = supplier_quote.supplier_id LEFT JOIN po ON po.id = selected_quote.po_id LEFT JOIN rfq_pmo ON rfq_pmo.rfq_id = selected_quote.rfq_id LEFT JOIN pmo on pmo.id = rfq_pmo.pmo_id LEFT JOIN rfq ON rfq.id = selected_quote.rfq_id LEFT JOIN  rfq_items on rfq_items.rfq_id = selected_quote.rfq_id LEFT JOIN app on app.id = rfq_items.app_id where po_date IS NOT NULL and po_no IS NOT NULL");

}

$results->execute();
while($row = $results->fetch(PDO::FETCH_ASSOC))
{
	 echo '<tr onclick="javascript:showRow(this);" >' . 
    '<td hidden>' . $row['po_no'] . '</td>' . 
    '<td hidden>' . $row['supplier_title'] . '</td>' . 
    '<td hidden>' . $row['supplier_address'] . '</td>' .
    '<td hidden>' . $row['purpose'] . '</td>' .
    '<td hidden>' . $row['abc'] . '</td>' .
    '<td style="text-align:center; background-color:lightgray;" >' . $row['po_no'] . '</td>' . 
	'</tr>';
} 


?>