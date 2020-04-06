<?php 
$id = $_GET['id'];
$username = $_GET['username'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$activate = mysqli_query($conn,"UPDATE tblemployee SET ACTIVATED = 'Yes', APPROVEDBY = '$username' WHERE EMP_N = $id");
if ($activate) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Account Activated!')
    window.location.href='Approval.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    window.location.href='Approval.php';
    </SCRIPT>");
}
?>