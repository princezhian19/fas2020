<?php
$conn = mysqli_connect("localhost","root","","fascalab_2020");
$id = $_GET['id'];
$insert_select = mysqli_query($conn,"INSERT INTO saroob(burs_id,office,date_submitted,ponum,payee,address,particular,amount) SELECT id,office,date_submit,po_no,supplier,address,purpose,amount FROM burs WHERE id = '$id' ");

if ($insert_select) {
$query = mysqli_query($conn,"UPDATE burs SET status = 1, date_submit = now() WHERE id = '$id'");
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Saved!')
    window.location.href = 'ViewBURS.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Erro Occured!')
  window.location.href = 'ViewBURS.php';
  </SCRIPT>");
}

?>

