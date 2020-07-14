<?php 

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$pr_no = $_GET['pr_no'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];
$target_date = $_GET['target_date'];
$type = $_GET['type'];
$items = $_GET['items'];

$selectRFQ_id = mysqli_query($conn,"SELECT id FROM rfq WHERE pr_no = '$pr_no");
$rowRFQ = mysqli_fetch_array($selectRFQ_id);
$rfq_id = $rowRFQ['id'];

$DeleteQuery = mysqli_query($conn,"DELETE FROM pr_approved WHERE id = '$id' ");

$deleteRFQ_items = mysqli_query($conn,"DELETE FROM rfq_items WHERE rfq_id = $rfq_id AND app_id = '$items'");

	 header('location: CreatePR1.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.'&target_date='.$target_date.'&type='.$type.' ');

?>