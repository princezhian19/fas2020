<?php


$id=$_GET['id'];
$date1=$_GET['now'];
$date = date('Y-m-d', strtotime($date1));
//echo $id;

$user =$_GET['user'];


$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);}
     



$query = mysqli_query($conn, "UPDATE vr set receiveddate ='$date',receivedby='$user' where id = '$id'");

 mysqli_close($conn);

if($query){

    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Vehicle Request has been successfully received.')
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