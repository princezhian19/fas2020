<?php


$id=$_GET['id'];
$date1=$_GET['now'];
$user =$_GET['user'];
$date = date('Y-m-d', strtotime($date1));


//echo $id;
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);}
     



$query = mysqli_query($conn, "UPDATE ro_roo set submitteddate ='$date', submittedby='$user' where id = '$id'");

 mysqli_close($conn);

if($query){

    
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' RO and ROO has been successfully submitted.')
    window.location.href='ROandROO.php';
    </SCRIPT>"); 

}
else{
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='ROandROO.php';
    </SCRIPT>");
}




?>