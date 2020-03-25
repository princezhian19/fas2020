<?php 

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

$id = $_GET['id'];
/* echo $id;
exit(); */

/* $query = mysqli_query($conn,"SELECT id FROM rfq WHERE id = '$id' ");
$row = mysqli_fetch_array($query);
$rfq_id = $row['id']; */

$query_2 = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $id ");
$row_2 = mysqli_fetch_array($query_2);
$rfq_items_id = $row_2['id'];

$query_3 = mysqli_query($conn,"SELECT * FROM supplier_quote WHERE rfq_item_id = '$rfq_items_id'");
// $row_3 = mysqli_fetch_array($query_3);
// $supplier_id = $row_3['supplier_id'];
if (mysqli_num_rows($query_3) > 0 ) {

echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = 'ViewSupplierItems.php?rfq=$rfq_items_id';
      </SCRIPT>");
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href = '/pmis/frontend/web/supplier-quote/encode?rfq=$id';
      </SCRIPT>");
}

?>