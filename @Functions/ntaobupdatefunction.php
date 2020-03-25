
<?php
//include('../@classes/db.php');

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
if (isset($_POST['submit'])) 
{

    $requestid = $_POST['requestid'];
    /* echo $requestid;
    exit(); */


    $accountno = $_POST["accountno"];

    $date1 = $_POST["date"];
    $date = date('m-d-Y', strtotime($date1));

    $payee = $_POST["payee"];
    $particular = $_POST["particular"];
    $dvno = $_POST["dvno"];
    $lddap = $_POST["lddap"];
    $orsno = $_POST["orsno"];
    $ppa = $_POST["ppa"];
    $uacs = $_POST["uacs"];

    $gross = $_POST["gross"];
    //$gross = number_format( $gross1,2);

    $totaldeduc = $_POST["totaldeduc"];
    //$tax = number_format( $tax1,2);

    $net = $_POST["net"];
    //$net = number_format( $net1,2);

    $remarks = $_POST["remarks"];
    $status = $_POST["status"];


// Perform queries

$do = "UPDATE ntaob set accountno='$accountno',
date='$date',
payee='$payee',
particular='$particular',
dvno='$dvno',
lddap='$lddap',
orsno='$orsno',
ppa='$ppa',
uacs='$uacs',
gross='$gross',
totaldeduc='$totaldeduc',
net='$net',
remarks='$remarks',
status='$status' where id = ".$requestid."";


$query = mysqli_query($conn,$do);


$total="";
$ans="";


mysqli_close($conn);
//exit();
if($query){

    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Updated Successfully!')
    window.location.href='../@ntaobligation.php';
    </SCRIPT>"); 
    
    //header('Location:../@obligation.php?message=Data Added Successfully!');
    
    }
    else{
    
    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    window.location.href='../@ntaobligation.php';
    </SCRIPT>");
    }

}
?>
