<?php

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$query1 = mysqli_query($conn,"SELECT burs_id FROM disbursement WHERE id = '$id'");
$row = mysqli_fetch_array($query1);
$burs_id = $row['burs_id'];

$query = mysqli_query($conn,"UPDATE dv SET status = 5,date_release = now() WHERE burs_id = '$burs_id'");
$query = mysqli_query($conn,"UPDATE disbursement SET datereleased = now() WHERE id = '$id'");

if ($query) {
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