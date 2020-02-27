<?php 
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$id = $_GET['id'];

$query = mysqli_query($conn,"UPDATE pr SET received_date = now() WHERE id = $id ");

if ($query) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Submitted!')
    window.location.href = 'ViewPRreceived.php';
    </SCRIPT>");
}else{
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!')
    window.location.href = 'ViewPRreceived.php';
    </SCRIPT>");
}


?>