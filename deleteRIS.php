<?php 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$selectId = mysqli_query($conn,"SELECT ris_no FROM ris WHERE id = '$id'");
$rowID = mysqli_fetch_array($selectId);
$ris_no = $rowID['ris_no'];
$deleteRISitems = mysqli_query($conn,"DELETE FROM ris_stock where ris_no = '$ris_no' ");
if ($deleteRISitems) {
	$deleteRIS = mysqli_query($conn,"DELETE FROM ris where id = '$id' ");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Deleted!')
      window.location.href = 'ViewRIS.php';
      </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!')
      window.location.href = 'ViewRIS.php';
      </SCRIPT>");
}

?>