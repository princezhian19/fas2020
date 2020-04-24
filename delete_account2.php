<?php 
$id = $_GET['id'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$activate = mysqli_query($conn,"DELETE FROM tblemployee WHERE EMP_N = $id");

if ($activate) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='ViewEmployees.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    window.location.href='ViewEmployees.php';
    </SCRIPT>");
}
?>