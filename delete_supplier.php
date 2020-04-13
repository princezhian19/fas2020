<?php
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$rfq_items_id = $_GET['rfq_items_id'];
$supplier_id = $_GET['supplier_id'];
$select_rfq_items = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
while ($rowitems = mysqli_fetch_assoc($select_rfq_items)) {
	$rowitems_id[] = $rowitems['id'];
}
$implode = implode(',', $rowitems_id);
$delete = mysqli_query($conn,"DELETE FROM supplier_quote WHERE supplier_id = $supplier_id AND rfq_item_id in ($implode) ");
if ($delete) {
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Successfuly Deleted!')
		window.location.href='CreateAoq.php?rfq_id=$rfq_id&rfq_items=$rfq_items_id';
		</SCRIPT>");
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Error Occured!')
		window.location.href='CreateAoq.php?rfq_id=$rfq_id&rfq_items=$rfq_items_id';
		</SCRIPT>");
}
?>