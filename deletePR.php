<?php 
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];
$pr_no = $_GET['pr_no'];
$pmo = $_GET['pmo'];
$pr_date = $_GET['pr_date'];
$purpose = $_GET['purpose'];
$target_date = $_GET['target_date'];
$type = $_GET['type'];

$DeleteQuery = mysqli_query($conn,"DELETE FROM pr_approved WHERE id = '$id' ");

	 header('location: CreatePR.php?pr_no='.$pr_no.'&pr_date='.$pr_date.'&pmo='.$pmo.'&purpose='.$purpose.'&target_date='.$target_date.'&type='.$type.' ');

?>