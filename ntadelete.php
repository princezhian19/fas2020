
<?php


$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

//Get Data
$id = $_GET['id'];
//echo $getid;

$do = "DELETE FROM nta where id = ".$id."";
/* echo "DELETE FROM nta where id = ".$id."";
exit(); */

$query = mysqli_query($conn,$do);
mysqli_close($conn);

if($query){

  
//if query is successful
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('NTA/NCA Deleted Successfully!')

window.location.href='nta.php';
</SCRIPT>"); 


}
else{

//if query has error
echo ("<SCRIPT LANGUAGE='JavaScript'>

window.alert('Error!')
window.location.href='nta.php';
</SCRIPT>");
}




?>
