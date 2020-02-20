<?php 
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");

$id = $_GET['id'];

$delete = mysqli_query($conn,"DELETE FROM ris_stock WHERE id = '$id' ");
	 header('location: ViewRIS.php ');


?>