<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$division = $_GET['division'];
}

 
?>


<?php


if(isset($_POST['edit'])){


    
$id = $_POST['getid'];

$category = $_POST['category1'];
$issuanceno = $_POST['issuanceno1'];
$issuancedate1 = $_POST['issuancedate1'];
$issuancedate = date('Y-m-d', strtotime($issuancedate1));
$title = $_POST['title1'];
$office = $_POST['office1'];
$registeredby = $_POST['registeredby1'];

$registereddate1 = $_POST['registereddate1'];
$registereddate = date('Y-m-d', strtotime($registereddate1));



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

  
$query = mysqli_query($conn,"UPDATE ro_roo set category='$category',issuanceno='$issuanceno',issuancedate='$issuancedate',title='$title',office='$office',registeredby='$registeredby',registereddate='$registereddate' where id ='$id'");
  /*  echo "UPDATE ro_roo set category='$category',issuanceno='$issuanceno',issuancedate='$issuancedate',title='$title',office='$office',registeredby='$registeredby',registereddate='$registereddate' where id ='$id'";
   exit();
 */
mysqli_close($conn);

if($query){

    // echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Regional Order/Regional Office Order has been successfully updated.')
    window.location.href='ROandROO.php?division=';
    </SCRIPT>"); 
}
else{

    // echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='ROandROO.php?division=';
    </SCRIPT>");
}
}
?>