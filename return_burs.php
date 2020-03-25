<?php 
$id = $_GET['id'];
$conn=mysqli_connect("localhost","root","","fascalab_2020");
$decline_stat = mysqli_query($conn,"UPDATE burs SET status = 3, date_return = now() WHERE id = '$id' ");
if ($decline_stat) {
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfully Return!');
    window.location.href='ViewABURS.php';
    </SCRIPT>");
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!');
    </SCRIPT>");
}
?>