<?php
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT burs_id FROM saroob WHERE id = '$id '");
$row = mysqli_fetch_array($select);
$burs_id = $row['burs_id'];

// $query = mysqli_query($conn,"UPDATE saroob SET datereceived = DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE id = '$id'");
$query = mysqli_query($conn,"UPDATE saroob SET datereceived = NOW() WHERE id = '$id'");
if ($query) {
// $update = mysqli_query($conn,"UPDATE burs SET status = 2, date_received = DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE id = '$burs_id'");
$update = mysqli_query($conn,"UPDATE burs SET status = 2, date_received = NOW() WHERE id = '$burs_id'");
if ($update) {
	# code...
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = 'obligation.php';
    </SCRIPT>");
}
 
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = 'obligation.php';
  </SCRIPT>");
}

?>