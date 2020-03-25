<?php 

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$pr_no = $_GET['pr_no'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];

$DeleteQuery = mysqli_query($conn,"DELETE FROM pr_approved WHERE id = '$id' ");

	 header('location: CreatePR.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');

?>