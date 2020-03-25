<?php 
$conn = mysqli_connect("localhost","root","","fascalab_2020");
$id = $_GET['id'];

$query = mysqli_query($conn,"UPDATE pr SET received_date = now() WHERE id = $id ");

if ($query) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Submitted!')
    window.location.href = 'ViewRFQ.php';
    </SCRIPT>");
}else{
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!')
    window.location.href = 'ViewRFQ.php';
    </SCRIPT>");
}


?>