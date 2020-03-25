<?php 
$id = $_GET['id'];

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$delete = mysqli_query($conn,"DELETE FROM rpcppe WHERE id = '$id' ");
if ($delete) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Successfuly Deleted!')
      window.location.href = 'ViewRPCPPE.php';
      </SCRIPT>");
}else{
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error Occured!');
      </SCRIPT>");
}
?>