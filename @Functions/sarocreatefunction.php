
<?php
//include('../@classes/db.php');


/* if (isset($_POST['submit'])) 
{ */

$date1 = $_GET["date"];
$d1 = date('Y-m-d', strtotime($date1));

$saronumber = $_GET["saronumber"];
$fund = $_GET["fund"];
$legalbasis = $_GET["legalbasis"];
$ppa = $_GET["ppa"];
$expenseclass = $_GET["expenseclass"];
$particulars = $_GET["particulars"];
$uacs = $_GET["uacs"];
$amount = $_GET["amount"];
$obligated = $_GET["obligated"];
$balance = $_GET["balance"];
$group = $_GET["group"];



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
$query = mysqli_query($conn,"INSERT INTO saro (sarodate,saronumber,fund,legalbasis,ppa,expenseclass,particulars,uacs,amount,obligated,balance,sarogroup) 
VALUES ('$d1','$saronumber','$fund','$legalbasis','$ppa','$expenseclass','$particulars','$uacs','$amount','$obligated','$amount','$group')");

mysqli_close($conn);



if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../saro.php';
    </SCRIPT>");

    //header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    
    window.location.href='../saro.php?message=Error!';
    </SCRIPT>");
    
}

/* } */
?>
