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


if(isset($_POST['Add'])){
    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


$category = $_POST['category'];
$issuanceno = $_POST['issuanceno'];
$issuancedate1 = $_POST['issuancedate'];
$issuancedate = date('Y-m-d', strtotime($issuancedate1));
$title = $_POST['title'];

$office = $_POST['office'];
$registeredby = $_POST['registeredby'];

$registereddate1 = $_POST['registereddate'];
$registereddate = date('Y-m-d', strtotime($registereddate1));



$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}



 $query = mysqli_query($conn,"INSERT INTO ro_roo (category ,issuanceno,issuancedate,title,office,registeredby,registereddate) 
 VALUES ('$category','$issuanceno','$issuancedate','$title','$office','$registeredby','$registereddate')");

/* echo "INSERT INTO ro_roo (category ,issuanceno,issuancedate,title,office,registeredby,registereddate) 
VALUES ('$category','$issuanceno','$issuancedate','$title','$office','$registeredby','$registereddate')";
exit();
 */
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