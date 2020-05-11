<?php


$id=$_GET['id'];
//echo $id;
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);}
     



$query = mysqli_query($conn, "UPDATE travel_order set status='cancelled' where id = '$id'");

 mysqli_close($conn);

if($query){

    
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Data has been successfully cancelled.')
    window.location.href='TravelOrder.php';
    </SCRIPT>"); 

}
else{
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='TravelOrder.php';
    </SCRIPT>");
}




?>