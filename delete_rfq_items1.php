<?php 
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

$id = $_GET['id'];
$id2 = $_GET['id2'];
$pr_no = $_GET['pr_no'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];

$del = mysqli_query($conn,"DELETE FROM pr_items WHERE id = '$id' ");

	 header('location: ViewRFQdetails1.php?id='.$id2.' ');
	 // header('location: ViewRFQdetails.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.' ');






?>