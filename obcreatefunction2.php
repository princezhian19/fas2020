
<?php
//include('../@classes/db.php');

$datereceived = $_POST['datereceived'];
$d1 = date('Y-m-d', strtotime($datereceived));

$datereprocessed = $_POST['datereprocessed'];
$d2 = date('Y-m-d', strtotime($datereprocessed));

// $datereturned = $_GET['datereturned'];
// $d3 = date('Y-m-d', strtotime($datereturned));

$datereturned = $_POST['datereturned'];
if($datereturned==''){
    $d3 = "";
}
else{
    $d3 = date('Y-m-d', strtotime($datereturned));
}

$datereleased = $_POST['datereleased'];
$d4 = date('Y-m-d', strtotime($datereleased));

$ors = $_POST['ors'];
$po = $_POST['ponum'];
$payee = $_POST['payee'];
$supplier = $_POST['supplier'];
$particular = $_POST['particular'];
$saronum = $_POST['saronum'];
$ppa = $_POST['ppa'];
$uacs = $_POST['uacs'];
$amount = $_POST['amount'];
$remarks = $_POST['remarks'];
$sarogroup = $_POST['sarogroup'];
$status = $_POST['status'];

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

// Perform queries


if($supplier==""){
    $query ="INSERT INTO saroob (datereceived,datereprocessed,datereturned,datereleased,ors,ponum,payee,particular,saronumber,ppa,uacs,amount,remarks,sarogroup,status) 
    VALUES ('$d1','$d2 ','$d3','$d4','$ors','$po','$payee','$particular','$saronum','$ppa','$uacs','$amount','$remarks','$sarogroup','$status')";
   

        if (mysqli_query($conn, $query)) {
            echo json_encode(array("statusCode"=>200));
            

        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }


}

if($payee==""){

    $query ="INSERT INTO saroob (datereceived,datereprocessed,datereturned,datereleased,ors,ponum,payee,particular,saronumber,ppa,uacs,amount,remarks,sarogroup,status) 
    VALUES ('$d1','$d2 ','$d3','$d4','$ors','$po','$supplier','$particular','$saronum','$ppa','$uacs','$amount','$remarks','$sarogroup','$status')";

    if (mysqli_query($conn, $query)) {
        echo json_encode(array("statusCode"=>200));
        
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }

}


//updating obligation
$update = mysqli_query($conn,"Update saro set obligated = obligated + $amount where saronumber = '$saronum' and uacs = '$uacs' ");
//updating balance
$update = mysqli_query($conn,"Update saro set balance = amount - obligated where saronumber = '$saronum' and uacs = '$uacs' ");

mysqli_close($conn);

/* if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../@obcreate.php';
    </SCRIPT>");

    //header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    window.location.href='../@obcreate.php';
    </SCRIPT>");
} */


?>
