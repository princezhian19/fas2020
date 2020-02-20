<?php
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT burs_id FROM disbursement WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$burs_id = $row['burs_id'];

$query = mysqli_query($conn,"UPDATE dv SET status = 2, date_received = now() WHERE burs_id = '$burs_id'");

if ($query) {
$update = mysqli_query($conn,"UPDATE disbursement SET datereceived = now(), timereceived = now() WHERE ID = $id");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = '@disbursement.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = '@disbursement.php';
  </SCRIPT>");
}

?>