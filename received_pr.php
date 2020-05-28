<?php 
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$id = $_GET['id'];
$username = $_GET['username'];

$query = mysqli_query($conn,"UPDATE pr SET received_date = NOW(),received_by='$username' WHERE id = $id ");
// $query = mysqli_query($conn,"UPDATE pr SET received_date = DATE_ADD(NOW(), INTERVAL 1 DAY),received_by='$username' WHERE id = $id ");

if ($query) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Successfuly Received!')
    window.location.href = 'ViewRFQ.php';
    </SCRIPT>");
}else{
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error Occured!')
    window.location.href = 'ViewRFQ.php';
    </SCRIPT>");
}


?>