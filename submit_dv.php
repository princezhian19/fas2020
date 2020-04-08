<?php

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$query = mysqli_query($conn,"UPDATE dv SET status = 1,date_submit = DATE_ADD(NOW(), INTERVAL 1 DAY) WHERE id = '$id'");

if ($query) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = 'ViewDV.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = 'ViewDV.php';
  </SCRIPT>");
}

?>