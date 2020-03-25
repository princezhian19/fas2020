<?php
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];
$validate = mysqli_query($conn,"SELECT * FROM dv WHERE burs_id = '$id'");
$row = mysqli_fetch_array($validate);
$office = $row['office'];
$po_no = $row['po_no'];
$supplier = $row['supplier'];
$purpose = $row['purpose'];
$address = $row['address'];
$amount = $row['amount'];
$status = $row['status'];
$date_received = $row['date_received'];
$date_release = $row['date_release'];
$date_proccess = $row['date_proccess'];
$date_return = $row['date_return'];
if (mysqli_num_rows($validate)>0) {
	// kpag my dv na update lang
$query = mysqli_query($conn,"UPDATE dv set office = '$office',po_no = '$po_no',supplier = '$supplier',purpose = '$purpose',address = '$address',amount = '$amount',date_received = '$date_received',date_release = '$date_release',date_proccess = '$date_proccess',date_return = '$date_return' WHERE id = '$id' ");
}else{
	// pag walang dv insert to dv
$query = mysqli_query($conn,"INSERT INTO dv(burs_id,office,po_no,supplier,purpose,address,amount,status,date_received)
	SELECT id,office,po_no,supplier,purpose,address,amount,0,date_received FROM burs WHERE id = '$id' ");
}

if ($query) {
	$created_dv = mysqli_query($conn,"UPDATE burs SET dv_create = 1, status = 6 WHERE id = '$id' ");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('DV Successfuly Created!')
    window.location.href = 'ViewABURS.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = 'ViewABURS.php';
  </SCRIPT>");
}

?>