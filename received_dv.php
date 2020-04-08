<?php

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT burs_id FROM disbursement WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$burs_id = $row['burs_id'];

$query = mysqli_query($conn,"UPDATE dv SET status = 2, date_received = DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE burs_id = '$burs_id'");

if ($query) {
$update = mysqli_query($conn,"UPDATE disbursement SET datereceived = DATE_ADD(NOW(), INTERVAL 1 DAY), timereceived = now() WHERE ID = $id");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = 'disbursement.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = 'disbursement.php';
  </SCRIPT>");
}

?>