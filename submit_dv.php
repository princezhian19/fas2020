<?php
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$id = $_GET['id'];
$query = mysqli_query($conn,"UPDATE dv SET status = 1,date_submit = now() WHERE id = '$id'");

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