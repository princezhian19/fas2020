
<?php

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
if (isset($_POST['submit'])) 
{

$requestid = $_POST['requestid'];

//$id = $_POST["ID"]; 
$dv = $_POST["dv"];
$ors = $_POST["ors"];
$sr = $_POST["sr"];
$ppa = $_POST["ppa"];
$uacs = $_POST["uacs"];

$datereceived = $_POST['datereceived'];
$dr = date('Y-m-d', strtotime($datereceived));

//$timereceived = $_POST["timereceived"];
//$tr = date('h:i a', strtotime($timereceived));


$datereleased = $_POST['datereleased'];
$dreleased = date('Y-m-d', strtotime($datereleased));

//$timereleased = $_POST["timereleased"];
//$treleased = date('h:i a', strtotime($timereleased));


$datereturned = $_POST['datereturned'];
$dreturned = date('Y-m-d', strtotime($datereturned));

//$timereturned = $_POST["timereturned"];
//$treturned = date('h:i a', strtotime($timereturned));


$payee = $_POST["payee"];
$particular = $_POST["particular"];
$amount = $_POST["amount"];
$tax = $_POST["tax"];
$gsis = $_POST["gsis"];
$pagibig  = $_POST["pagibig"];
$philhealth = $_POST["philhealth"];
$other = $_POST["other"];

$remarks = $_POST["remarks"];

if($remarks==""){
    $remarks = "N/A";

}else{
    $remarks = $_POST["remarks"];
}


$status = $_POST["status"];

// Perform queries

$do = "UPDATE disbursement set dv ='$dv',
ors='$ors', 
sr='$sr',
ppa='$ppa',
uacs='$uacs',
datereceived='$dr',
timereceived='',
payee='$payee',
particular='$particular',
amount='$amount',
tax='$tax',
gsis='$gsis',
pagibig='$pagibig',
philhealth='$philhealth',
other='$other',
datereleased='$dreleased',
timereleased='',
datereturned='$dreturned',
timereturned='',
remarks='$remarks', status = '$status' where ID = ".$requestid." ";
$query = mysqli_query($conn,$do);


//updating Disbursement
//updating total
$update1 = mysqli_query($conn,"Update disbursement set total = tax+gsis+pagibig+philhealth+other where dv = '$dv'");
//updating net
$update2 = mysqli_query($conn,"Update disbursement set net = amount - total where dv = '$dv' ");

mysqli_close($conn);

if($query){

//if query is successful
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Data Updated Successfully!')
window.location.href='../@disbursement.php';
</SCRIPT>");

}
else{

//if query has error
echo ("<SCRIPT LANGUAGE='JavaScript'>

window.alert('Error!')
window.location.href='../@disbursement.php';
</SCRIPT>");
}

 } 
?>
