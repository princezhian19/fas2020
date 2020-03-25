<?php 
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

$id = $_GET['id'];

$delete = mysqli_query($conn,"DELETE FROM ris_stock WHERE id = '$id' ");
	 header('location: ViewRIS.php ');


?>