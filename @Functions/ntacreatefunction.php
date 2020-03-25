
<?php
//include('../@classes/db.php');


/* if (isset($_POST['submit'])) 
{ */




    $datenta1 = $_GET["datenta"];
    $datenta = date('Y-m-d', strtotime($datenta1));

    $datereceived1 = $_GET["datereceived"];
    $datereceived = date('Y-m-d', strtotime($datereceived1));


    $accountno = $_GET["accountno"];
    $ntano = $_GET["ntano"];
    $saronumber = $_GET["saronumber"];
    $particular = $_GET["particular"];
    $amount = $_GET["amount"];
    $obligated = $_GET["obligated"];
    $balance = $_GET["balance"];
  

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
//$query = mysqli_query($conn,"INSERT INTO  saro values (default,'$date','$saronumber ','$fund','$legalbasis','$ppa','$expenseclass','$particulars','$uacs','$amount','$obligated','$balance')");
//$query = mysqli_query($conn,"INSERT INTO  saro values (default,'$date','$saronumber ','$fund','$legalbasis','$ppa','$expenseclass','$particulars','$uacs','$amount','$obligated','$amount')");
//updating obligation
$query = mysqli_query($conn,"INSERT INTO nta (datenta,datereceived,accountno,ntano,saronumber,particular,amount,obligated,balance) 
VALUES ('$datenta','$datereceived','$accountno','$ntano','$saronumber','$particular','$amount','$obligated','$amount')");

mysqli_close($conn);



if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../nta.php';
    </SCRIPT>");

    //header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    
    window.location.href='../nta.php';
    </SCRIPT>");
    
}