
<?php
//include('../@classes/db.php');

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
if (isset($_POST['submit'])) 
{



$requestid = $_POST['requestid'];



$datereceived = $_POST['datereceived'];
$datereceived11 = date('Y-m-d', strtotime($datereceived));

$datereprocessed = $_POST['datereprocessed'];
$datereprocessed11 = date('Y-m-d', strtotime($datereprocessed));

$datereturned11="";
$datereturned = $_POST['datereturned'];
if($datereturned==''){
    $datereturned11 = "";
}
else{
    $datereturned11 = date('Y-m-d', strtotime($datereturned));
}
// echo $datereturned11;
// exit();

$datereleased = $_POST['datereleased'];
$datereleased11 = date('Y-m-d', strtotime($datereleased));

$ors = $_POST['ors'];
$ponum = $_POST['ponum'];
$payee = $_POST['payee'];
$particular = $_POST['particular'];
$saronumber = $_POST['saronum'];
$ppa = $_POST['ppa'];
$uacs = $_POST['uacs'];
$amount = $_POST['amount'];
$newamount = $_POST['newamount'];
$remarks = $_POST['remarks'];
$sarogroup = $_POST['sarogroup'];
$status = $_POST['status'];

// if($status=="Select Status"){
// // 	echo ("<SCRIPT LANGUAGE='JavaScript'>

// // window.alert('Error! -- required Fields Detected')
// // window.location.href='../@obupdate.php';

// // </SCRIPT>");
// }
// else{


// Perform queries

$do = "UPDATE saroob set datereceived='$datereceived11',
datereprocessed='$datereprocessed11', 
datereturned='$datereturned11',
datereleased='$datereleased11',
ors='$ors',
ponum='$ponum',
payee='$payee',
particular='$particular',
saronumber='$saronumber',
ppa='$ppa',
uacs='$uacs',
amount='$newamount',
remarks='$remarks', sarogroup='$sarogroup', status='$status' where id = ".$requestid."";
$query = mysqli_query($conn,$do);

//updating obligation
$total="";
$ans="";

$query1 = mysqli_query($conn,"SELECT sum(amount) as total FROM  saroob where saronumber = '$saronumber' and uacs = '$uacs' ");

while ($row = mysqli_fetch_assoc($query1)) 
{
$total = $row["total"];

// $ans = $total + ($amount - $newamount);
// echo $ans;
// exit();


$update = mysqli_query($conn,"Update saro set obligated = $total where saronumber = '$saronumber' and uacs = '$uacs'");
//updating balance
$update = mysqli_query($conn,"Update saro set balance = amount - obligated where saronumber = '$saronumber' and uacs = '$uacs'");
}

mysqli_close($conn);

if($query){

//if query is successful
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Data Updated Successfully!')

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

// }

}
?>
