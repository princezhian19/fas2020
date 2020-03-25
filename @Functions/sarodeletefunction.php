
<?php
include('../@classes/db.php');

$servername = "localhost";
<<<<<<< HEAD
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
=======
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$database = "fascalab_2020";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

//Get Data
$getid = $_GET['getid'];


// Perform queries

$do = "DELETE FROM saro where id = ".$getid."";
$query = mysqli_query($conn,$do);



mysqli_close($conn);

if($query){

//if query is successful
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Data Deleted Successfully!')
window.location.href='../@saro.php?message=Data Deleted Successfully!';
</SCRIPT>"); 

//header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

//if query has error
/* echo ("<SCRIPT LANGUAGE='JavaScript'>

window.alert('Error!')
window.location.href='../@saro.php?message=Error!';
</SCRIPT>"); */
}



?>
