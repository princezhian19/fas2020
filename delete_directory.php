<?php 
$id = $_GET['id'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$activate = mysqli_query($conn,"DELETE FROM phone_directory WHERE id = $id");

if ($activate) {
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Deleted!');
    window.location.href='Directory.php';
    </SCRIPT>");
}else{
 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!');
    window.location.href='Directory.php';
    </SCRIPT>");
}
?>