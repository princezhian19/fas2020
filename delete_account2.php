<?php 
$id = $_GET['id'];
$division = $_GET['division'];
$username = $_GET['username'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$activate = mysqli_query($conn,"DELETE FROM tblemployeeinfo WHERE EMP_N = $id");

if ($activate) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Deleted!');
    window.location.href='ViewEmployees.php?division=$division&username=$username';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    window.location.href='ViewEmployees.php?division=$division&username=$username';
    </SCRIPT>");
}
?>