<?php 
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c

$id = $_GET['id'];

$delete = mysqli_query($conn,"DELETE FROM ris_stock WHERE id = '$id' ");
	 header('location: ViewRIS.php ');


?>