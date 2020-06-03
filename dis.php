<?php

    
$id = $_GET['id'];
/* echo $id;
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


 $query = mysqli_query($conn,"DELETE from saro  where id ='$id'");


mysqli_close($conn);

if($query){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Disbursement Deleted Successfully!')
    window.location.href='saro.php';
    </SCRIPT>"); 

}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='saro.php';
    </SCRIPT>");
}
// }
?>
