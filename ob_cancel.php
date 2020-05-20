<?php



if (isset($_POST['cancel'])){
 
$id=$_POST["id1"];
$now1=$_POST["now"];
$user=$_POST["user"];
$reason=$_POST["reason"];

$date = date('Y-m-d', strtotime($now1));






$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
     




$query = mysqli_query($conn, "UPDATE ob set status='cancelled', cancelledby='$user', cancelleddate='$date', reason ='$reason' where id = '$id'");

/* echo "UPDATE ob set status='cancelled', cancelledby='$user', cancelleddate='$date', reason ='$reason' where id = '$id'";
exit();
 */
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

}


?>