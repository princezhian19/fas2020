
<?php
/* include('../@classes/db.php'); */

/* $datereceived = $_GET['datereceived'];
$d1 = date('Y-m-d', strtotime($datereceived));

$datereprocessed = $_GET['datereprocessed'];
$d2 = date('Y-m-d', strtotime($datereprocessed));

$datereturned = $_GET['datereturned'];
$d3 = date('Y-m-d', strtotime($datereturned));

$datereleased = $_GET['datereleased'];
$d4 = date('Y-m-d', strtotime($datereleased)); */
$dv = $_GET['dv'];
$ors = $_GET['ors'];
$sr = $_GET['sr'];
$ppa = $_GET['ppa'];
$uacs = $_GET['uacs'];
$payee = $_GET['payee'];
$particular = $_GET['particular'];
$amount = $_GET['amount'];

$datereceived = $_GET['datereceived'];
$dr = date('Y-m-d', strtotime($datereceived));
/* $timereceived = $_GET['timereceived'];
$tr = date('h:i a', strtotime($timereceived)); */


$datereleased = $_GET['datereleased'];
$dreleased = date('Y-m-d', strtotime($datereleased));
/* $timereleased = $_GET['timereleased'];
$treleased = date('h:i a', strtotime($timereleased)); */
$datereturned = $_GET['datereturned'];
if($datereturned ==""){
    $dreturned = "0000-00-00";

}
else{
   
    $dreturned = date('Y-m-d', strtotime($datereturned));
}
/* $timereturned = $_GET['timereturned'];
$treturned = date('h:i a', strtotime($timereturned)); */

$tax = $_GET['tax'];
$gsis = $_GET['gsis'];
$pagibig = $_GET['pagibig'];
$philhealth = $_GET['philhealth'];
$other = $_GET['other'];
$remarks = $_GET['remarks'];

if($remarks==""){
    $remarks = "N/A";

}else{
    $remarks = $_POST["remarks"];
}

$status = $_GET['status'];

$ntaid = $_GET['ntaid'];
$ntano = $_GET['ntano'];
$ntaparticular = $_GET['ntaparticular'];

$totaldeduc = $tax+$gsis+$pagibig+$philhealth+$other;
$net = $amount - $totaldeduc;

/*  */

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


// Perform queries
$query = mysqli_query($conn,"INSERT INTO disbursement (nta,ntaparticular,dv,ors,sr,ppa,uacs,payee,particular,amount,datereceived,timereceived,tax,gsis,pagibig,philhealth,other,datereleased,timereleased,datereturned,timereturned,remarks,status) 
VALUES ('$ntano','$ntaparticular','$dv','$ors ','$sr','$ppa','$uacs','$payee','$particular','$amount','$dr','','$tax','$gsis','$pagibig','$philhealth','$other','$dreleased','','$dreturned','','$remarks','$status')");

    // echo "INSERT INTO disbursement (dv,ors,sr,ppa,uacs,payee,particular,amount,datereceived,timereceived,tax,gsis,pagibig,philhealth,other,datereleased,timereleased,datereturned,timereturned,remarks,status) 
    // VALUES ('$dv','$ors ','$sr','$ppa','$uacs','$payee','$particular','$amount','$dr','$tr','$tax','$gsis','$pagibig','$philhealth','$other','$dreleased','$treleased','$dreturned','$treturned','$remarks','$status')";
    // exit();
//updating total
$update = mysqli_query($conn,"Update disbursement set total = tax+gsis+pagibig+philhealth+other where dv = '$dv'");
//updating net
$update3 = mysqli_query($conn,"Update disbursement set net = amount - total where dv = '$dv' ");


//updating nta obligated
$update11 = mysqli_query($conn,"Update nta set obligated = obligated + $net where id = '$ntaid' ");
//updating nta balance
$update22 = mysqli_query($conn,"Update nta set balance = amount - obligated where where id = '$ntaid' ");
// $update = mysqli_query($conn,"Update nta set amount = amount - $totaldeduc where id = '$ntaid' ");

/*  echo "Update nta set obligated = obligated + $net where id = '$ntaid'";
// echo $totaldeduc;
 echo "Update nta set balance = amount - obligated where where id = '$ntaid'"; */



mysqli_close($conn);
/* exit(); */
if($query){
    
    //if query is successfulxx
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../disbursement.php';
    </SCRIPT>");

    //header('Location:../@obligation.php?message=Data Added Successfully!');

}

else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    window.location.href='../disbursement.php';
    </SCRIPT>");
}


?>
