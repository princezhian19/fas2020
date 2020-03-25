
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


$date1 = $_POST["sarodate"];
$d1 = date('Y-m-d', strtotime($date1));

$saronumber = $_POST["saronumber"];
$fund = $_POST["fund"];
$legalbasis = $_POST["legalbasis"];
$ppa = $_POST["ppa"];
$expenseclass = $_POST["expenseclass"];
$particulars = $_POST["particulars"];
$uacs = $_POST["uacs"];
$amount = $_POST["amount"];
$obligated = $_POST["obligated"];
$balance = $_POST["balance"];
$group = $_POST["group"];


// Perform queries

$do = "UPDATE saro set sarodate='$d1',
saronumber='$saronumber', 
fund='$fund',
legalbasis='$legalbasis',
ppa='$ppa',
expenseclass='$expenseclass',
particulars='$particulars',
uacs='$uacs',
amount='$amount',
obligated='$obligated',
balance='$balance', sarogroup ='$group'  where id = ".$requestid."";
$query = mysqli_query($conn,$do);

//updating obligation
$total="";
$ans="";

$query1  = mysqli_query($conn,"SELECT sum(amount) as total FROM  saroob where saronumber = '$saronumber' and uacs = '$uacs' ");

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
window.location.href='../@saro.php?message=Data Updated Successfully!';
</SCRIPT>"); 

//header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

//if query has error
echo ("<SCRIPT LANGUAGE='JavaScript'>

window.alert('Error!')
window.location.href='../@saro.php?message=Error!';
</SCRIPT>");
}

}
?>
