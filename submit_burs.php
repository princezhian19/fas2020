<?php
<<<<<<< HEAD
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
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

