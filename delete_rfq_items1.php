<?php 

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");




$id = $_GET['id'];
$id2 = $_GET['id2'];
$pr_no = $_GET['pr_no'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];

$del = mysqli_query($conn,"DELETE FROM pr_items WHERE id = '$id' ");

$selectr = mysqli_query($conn,"SELECT pr_no FROM pr_items WHERE id = '$id'");
$rowPr = mysqli_fetch_array($selectr);
$pr_no = $rowPr['pr_no'];
$app_id = $rowPr['app_id'];

$selectRfqNO = mysqli_query($conn,"SELECT id FROM rfq WHERE pr_no = '$pr_no'");
$rowP = mysqli_fetch_array($selectRfqNO);
$rfqid = $rowP['id'];
$del2 = mysqli_query($conn,"DELETE FROM rfq_items WHERE rfq_id = '$rfqid' AND app_id = '$app_id'");

	 header('location: ViewRFQdetails1.php?id='.$id2.' ');
	 // header('location: ViewRFQdetails.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');






?>