<?php 
$id = $_GET['id'];

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");

$delete2 = mysqli_query($conn,"DELETE FROM estimated_budget WHERE app_id = '$id' ");
$select = mysqli_query($conn,"SELECT * FROM app WHERE id = '$id'");
$row = mysqli_fetch_array($select);
$sn = $row['sn'];
$delete = mysqli_query($conn,"DELETE FROM app WHERE sn = '$sn' ");


if ($delete) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Deleted!');
      window.location.href = 'ViewApp.php';
      </SCRIPT>");
}else{
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!');
      </SCRIPT>");
}
?>