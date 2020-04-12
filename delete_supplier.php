<?php

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$rfq_items_id = $_GET['rfq_items'];
$remarks = $_GET['remarks'];
$date_opened1 = $_GET['date_opened'];
$supplier_id_create = $_GET['supplier_id_create'];
$abstract_no = $_GET['abstract_no'];
$supplier_title_c = $_GET['supplier_title_c'];
$rfq_item_id = $_GET['rfq_item_id'];
$supplier_id = $_GET['supplier_id'];


$delete = mysqli_query($conn,"DELETE FROM supplier_quote WHERE supplier_id = supplier_id AND rfq_item_id =$rfq_item_id ");


if ($delete) {

	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Successfuly Deleted!')
		window.location.href='CreateAoq.php?rfq_id=$rfq_id&rfq_items=$rfq_items_id&remarks=$remarks&date_opened=$date_opened&supplier_id_create=$supplier_id_create&abstract_no=$abstract_no&supplier_title_c=$supplier_title_c';
		</SCRIPT>");

}else{

	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Error Occured!')
		window.location.href='CreateAoq.php?rfq_id=$rfq_id&rfq_items=$rfq_items_id&remarks=$remarks&date_opened=$date_opened&supplier_id_create=$supplier_id_create&abstract_no=$abstract_no&supplier_title_c=$supplier_title_c';
		</SCRIPT>");

}


?>