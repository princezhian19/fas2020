
<?php
// include('../@classes/db.php');

$servername = "localhost";

$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";

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
$getid = $_GET['getidDelete'];
//echo $getid;



// Perform queries
$back = mysqli_query($conn,"SELECT * FROM saroob where id = ".$getid."");
/* echo "SELECT * FROM saroob where id = ".$getid."";
exit(); */
while ($row = mysqli_fetch_assoc($back)) {

    
$saro = $row['saronumber'];
$uacs = $row['uacs'];
$amount = $row['amount'];
//echo $saro;
/* echo $uacs; */

//echo $amount;
/* exit(); */

//updating obligation
$update = mysqli_query($conn,"Update saro set obligated = obligated - $amount where saronumber = '$saro' and uacs = '$uacs' ");
//updating balance
$update = mysqli_query($conn,"Update saro set balance = amount - obligated where saronumber = '$saro' and uacs = '$uacs' ");
}

$do = "DELETE FROM saroob where id = ".$getid."";


$query = mysqli_query($conn,$do);
mysqli_close($conn);

if($query){

  
//if query is successful
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Data Deleted Successfully!')

window.location.href='../@obligation.php';
</SCRIPT>"); 

//header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

//if query has error
echo ("<SCRIPT LANGUAGE='JavaScript'>

window.alert('Error!')
window.location.href='../@obligation.php';
</SCRIPT>");
}




?>
