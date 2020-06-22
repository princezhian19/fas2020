-<?php



if (isset($_POST['approved'])){
 
$id=$_POST["rvalue"];
$now1=$_POST["nowr"];
$date = date('Y-m-d', strtotime($now1));
$user=$_POST["userr"];



$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
     

$query = mysqli_query($conn, "UPDATE vr set recommenddate='$date', recommendby='$user', rstatus='Approved' where id = '$id'");

/* echo "UPDATE vr set recommenddate='$date', recommendby='$user' rstatus='Approved' where id = '$id'";
exit(); */

 mysqli_close($conn);

if($query){
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Vehicle Request Approved successfully.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>"); 
}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>");
}

}

else if(isset($_POST['disapproved'])){

    $id=$_POST["rvalue"];
    $now1=$_POST["nowr"];
    $date = date('Y-m-d', strtotime($now1));
    $user=$_POST["userr"];
    
    
    
    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
         
    
    $query = mysqli_query($conn, "UPDATE vr set recommenddate='$date', recommendby='$user', rstatus='Disapproved' where id = '$id'");
    
   /*  echo "UPDATE vr set recommenddate='$date', recommendby='$user' rstatus='Disapproved' where id = '$id'";
    exit(); */
    
     mysqli_close($conn);
    
    if($query){
       
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Vehicle Request Disapproved successfully.')
        window.location.href='VehicleRequest.php';
        </SCRIPT>"); 
    }
    else{
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Error.')
        window.location.href='VehicleRequest.php';
        </SCRIPT>");
    }



}





?>