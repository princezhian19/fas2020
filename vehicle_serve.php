<?php


 
$id=$_GET['id'];
$date1=$_GET['now'];
$user =$_GET['user'];
$date = date('Y-m-d', strtotime($date1));

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
     

$query = mysqli_query($conn, "UPDATE vr set servedby='$user', serveddate='$date'  where id = '$id'");

/* echo "UPDATE vr set approvedby='$user', approveddate='$date'  where id = '$id'";
exit(); */

 mysqli_close($conn);

if($query){
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Vehicle Request has been successfully served.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>"); 
}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>");
}



?>