<?php


if (isset($_POST['submit'])){
 
    $id=$_POST["id1"];
    $now1=$_POST["now"];
    $user=$_POST["user"];
    $reason=$_POST["reason"];
    
    $date = date('Y-m-d', strtotime($now1));
    
    
    echo $id.'<br>';
    echo $now1.'<br>';
    echo $user.'<br>';
    echo $reason.'<br>';
    echo $date.'<br>';


$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);}
     



$query = mysqli_query($conn, "UPDATE travel_order set status='cancelled', cancelledby='$user', cancelleddate='$date', reason ='$reason' where id = '$id'");

 mysqli_close($conn);

if($query){

    
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Travel Order has been successfully cancelled.')
    window.location.href='TravelOrder.php';
    </SCRIPT>"); 

}
else{
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='TravelOrder.php';
    </SCRIPT>");
}


}

?>