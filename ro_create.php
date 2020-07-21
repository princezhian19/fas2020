<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

 
?>
<?php
date_default_timezone_set('Asia/Manila');
$timeNow1 = (new DateTime('now'))->format('F d, Y H:i:s');
//Replace now() Variable
echo $timeNow1;

?>

<?php


if(isset($_POST['Add'])){

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$category = $_POST['category'];
$issuanceno = $_POST['issuanceno'];
$issuancedate1 = $_POST['issuancedate'];
$issuancedate = date('Y-m-d', strtotime($issuancedate1));
$title = $_POST['title'];



$timeNow = date('Y-m-d', strtotime($timeNow1));
/* echo $timeNow;
exit(); */


$office = $_POST['office'];
$registeredby = $_POST['registeredby'];
/* echo $registeredby;
exit(); */
$registereddate1 = $_POST['registereddate'];
$registereddate = date('Y-m-d', strtotime($registereddate1));
$rocount = $_POST['rocount'];
/* echo $rocount;
exit(); */

$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


if( $registeredby == 'cvferrer' || $registeredby == 'itdummy1' || $registeredby == 'seolivar' || $registeredby == 'magonzales' || $registeredby == 'jbaco' || $registeredby == 'gpvillanueva'|| $registeredby == 'hpsolis'|| $registeredby == 'rmsaturno'){
    if($category=='Regional Order'){
        $query = mysqli_query($conn,"INSERT INTO ro_roo (category ,issuanceno,issuancedate,title,office,registeredby,registereddate,submitteddate,submittedby,receiveddate,receivedby) 
        VALUES ('$category','$issuanceno','$issuancedate','$title','$office','$registeredby','$registereddate','$timeNow','$registeredby','$timeNow','$registeredby')");
    
       

        $query1 = mysqli_query($conn,"INSERT INTO ro_count (count) VALUES ('$rocount')");
        /* echo "INSERT INTO ro_count (count) VALUES ('$rocount')";
        exit(); */
    }
    
    else if($category =='Regional Office Order'){
        $query = mysqli_query($conn,"INSERT INTO ro_roo (category ,issuanceno,issuancedate,title,office,registeredby,registereddate,submitteddate,submittedby,receiveddate,receivedby) 
        VALUES ('$category','$issuanceno','$issuancedate','$title','$office','$registeredby','$registereddate','$timeNow','$registeredby','$timeNow','$registeredby')");
    
        $query1 = mysqli_query($conn,"INSERT INTO roo_count (count) VALUES ('$rocount')");
        /* echo "INSERT INTO roo_count (count) VALUES ('$rocount')";
        exit(); */
    }
    else{
    
    }
 
}
else{

    if($category=='Regional Order'){
        $query = mysqli_query($conn,"INSERT INTO ro_roo (category ,issuanceno,issuancedate,title,office,registeredby,registereddate) 
        VALUES ('$category','$issuanceno','$issuancedate','$title','$office','$registeredby','$registereddate')");
    
        $query1 = mysqli_query($conn,"INSERT INTO ro_count (count) VALUES ('$rocount')");
        /* echo "INSERT INTO ro_count (count) VALUES ('$rocount')";
        exit(); */
    }
    
    else if($category =='Regional Office Order'){
        $query = mysqli_query($conn,"INSERT INTO ro_roo (category ,issuanceno,issuancedate,title,office,registeredby,registereddate) 
        VALUES ('$category','$issuanceno','$issuancedate','$title','$office','$registeredby','$registereddate')");
    
        $query1 = mysqli_query($conn,"INSERT INTO roo_count (count) VALUES ('$rocount')");
        /* echo "INSERT INTO roo_count (count) VALUES ('$rocount')";
        exit(); */
    }
    else{
    
    }



}

mysqli_close($conn);

if($query){

   


    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Regional Order/Regional Office Order has been successfully added.')
    window.location.href='ROandROO.php?division=';
    </SCRIPT>");

}
else{

  
  
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='ROandROO.php?division=';
    </SCRIPT>");
}

}



?>