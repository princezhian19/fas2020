<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
}
?>
<?php


    
$id = $_GET['id'];

$issuance = $_GET['issuance'];

$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
$username1 = $_SESSION['username'];
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$query = mysqli_query($conn,"DELETE from issuances  where id ='$id'");


$query1 = mysqli_query($conn,"DELETE from issuances_office_responsible  where issuance_id ='$issuance'");

mysqli_close($conn);

if($query){

    
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Data has been successfully deleted.')
    window.location.href='../issuances.php';
    </SCRIPT>"); 

}
else{
   
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='../issuances.php';
    </SCRIPT>");
}

?>
