<?php


$id=$_GET['id'];
//echo $id;
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);}
     



$query = mysqli_query($conn, "UPDATE ob set status='cancelled' where id = '$id'");

 mysqli_close($conn);

if($query){

    
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Official Business has been successfully cancelled.')
    window.location.href='ob.php';
    </SCRIPT>"); 

}
else{
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='ob.php';
    </SCRIPT>");
}




?>