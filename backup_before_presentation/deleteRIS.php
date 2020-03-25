<?php 
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];

$selectId = mysqli_query($conn,"SELECT ris_no FROM ris WHERE id = '$id'");
$rowID = mysqli_fetch_array($selectId);
$ris_no = $rowID['ris_no'];

$deleteRISitems = mysqli_query($conn,"DELETE FROM ris_stock where ris_no = '$ris_no' ");

if ($deleteRISitems) {
	$deleteRIS = mysqli_query($conn,"DELETE FROM ris where id = '$id' ");
}
 header('location: ViewRIS.php ');

?>