
<?php
include('../@classes/db.php');

$servername = "localhost";
$username = "root";
$password = "";
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

$do = "DELETE FROM disbursement where ID = ".$getid."";
$query = mysqli_query($conn,$do);



mysqli_close($conn);

if($query){

//if query is successful
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Data Deleted Successfully!')
window.location.href='../@disbursement.php';
</SCRIPT>"); 

//header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

//if query has error
echo ("<SCRIPT LANGUAGE='JavaScript'>

window.alert('Error!')
window.location.href='../@disbursement.php';
</SCRIPT>");
}



?>
