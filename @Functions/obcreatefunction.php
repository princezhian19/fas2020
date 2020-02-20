
<?php
//include('../@classes/db.php');

$datereceived = $_GET['datereceived'];
$d1 = date('Y-m-d', strtotime($datereceived));

$datereprocessed = $_GET['datereprocessed'];
$d2 = date('Y-m-d', strtotime($datereprocessed));

// $datereturned = $_GET['datereturned'];
// $d3 = date('Y-m-d', strtotime($datereturned));

$datereturned = $_GET['datereturned'];
if($datereturned==''){
    $d3 = "";
}
else{
    $d3 = date('Y-m-d', strtotime($datereturned));
}

$datereleased = $_GET['datereleased'];
$d4 = date('Y-m-d', strtotime($datereleased));


$ors = $_GET['ors'];
$po = $_GET['ponum'];
$payee = $_GET['payee'];
$particular = $_GET['particular'];
$saronum = $_GET['saronum'];
$ppa = $_GET['ppa'];
$uacs = $_GET['uacs'];
$amount = $_GET['amount'];
$remarks = $_GET['remarks'];x
$sarogroup = $_GET['sarogroup'];
$status = $_GET['status'];



$servername = "localhost";
$username = "root";
$password = "";
$database = "db_dilg_pmis";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

// Perform queries
$query = mysqli_query($conn,"INSERT INTO saroob (datereceived,datereprocessed,datereturned,datereleased,ors,ponum,payee,particular,saronumber,ppa,uacs,amount,remarks,sarogroup,status) 
VALUES ('$d1','$d2 ','$d3','$d4','$ors','$po','$payee','$particular','$saronum','$ppa','$uacs','$amount','$remarks','$sarogroup','$status')");
//updating obligation
$update = mysqli_query($conn,"Update saro set obligated = obligated + $amount where saronumber = '$saronum' and uacs = '$uacs' ");
//updating balance
$update = mysqli_query($conn,"Update saro set balance = amount - obligated where saronumber = '$saronum' and uacs = '$uacs' ");


mysqli_close($conn);

if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
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
