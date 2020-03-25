<?php
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
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