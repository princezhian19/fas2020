
<?php
//include('../@classes/db.php');


/* if (isset($_POST['submit'])) 
{ */
    $accountno = $_GET["accountno"];
    $date1 = $_GET["date"];
    $date = date('Y-m-d', strtotime($date1));


    $payee = $_GET["payee"];
    $particular = $_GET["particular"];
    $dvno = $_GET["dvno"];
    $lddap = $_GET["lddap"];
    $orsno = $_GET["orsno"];
    $ppa = $_GET["ppa"];
    $uacs = $_GET["uacs"];
    $gross = $_GET["gross"];
    $totaldeduc = $_GET["totaldeduc"];
    $status = $_GET["status"];
    $remarks = $_GET["remarks"];
    $net = $_GET["net"];
    
    //$net = $gross-$tax;
    
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

// Perform queries
//$query = mysqli_query($conn,"INSERT INTO  saro values (default,'$date','$saronumber ','$fund','$legalbasis','$ppa','$expenseclass','$particulars','$uacs','$amount','$obligated','$balance')");
//$query = mysqli_query($conn,"INSERT INTO  saro values (default,'$date','$saronumber ','$fund','$legalbasis','$ppa','$expenseclass','$particulars','$uacs','$amount','$obligated','$amount')");
//updating obligation
$query = mysqli_query($conn,"INSERT INTO ntaob (accountno,date,payee,particular,dvno,lddap,orsno,ppa,uacs,gross,totaldeduc,net,remarks,status) 
VALUES ('$accountno','$date','$payee','$particular','$dvno','$lddap','$orsno','$ppa','$uacs','$gross','$totaldeduc','$net','$remarks','$status')");

mysqli_close($conn);


if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../ntaobligation.php';
    </SCRIPT>");

    //header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    
    window.location.href='../ntaobligation.php';
    </SCRIPT>");
    
}