<?php 
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$id = $_GET['id'];
// $query = mysqli_query($conn,"SELECT pr_no FROM pr WHERE id = '$id' ");
// $row = mysqli_fetch_array($query);
// $pr_no = $row['pr_no'];

// $DeleteQuery = mysqli_query($conn,"DELETE FROM pr_items WHERE id = '$id' ");
$DeleteQuery = mysqli_query($conn,"DELETE FROM pr WHERE id = '$id' ");

	 header('location: ViewPR.php');

?>