<?php

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$id = $_GET['id'];
$query = mysqli_query($conn,"INSERT INTO disbursement(burs_id,office,po_no,payee,particular,address,amount)
	SELECT id,office,po_no,supplier,purpose,address,amount FROM burs WHERE id = '$id' ");

if ($query) {
	$created_dv = mysqli_query($conn,"UPDATE burs SET dv_create = 1 WHERE id = '$id' ");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('DV Successfuly Created!')
    window.location.href = 'ViewBURS.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Error Occured!')
  window.location.href = 'ViewBURS.php';
  </SCRIPT>");
}

?>