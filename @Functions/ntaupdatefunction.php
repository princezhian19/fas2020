
<?php
//include('../@classes/db.php');

$servername = "localhost";
$username = "fascalab_2020";
$password = "7one@2019";
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


    $datenta1 = $_POST["datenta"];
    $datenta = date('Y-m-d', strtotime($datenta1));

    $datereceived1 = $_POST["datereceived"];
    $datereceived = date('Y-m-d', strtotime($datereceived1));

    $accountno = $_POST["accountno"];
    $ntano = $_POST["ntano"];
    $saronumber = $_POST["saronumber"];
    $particular = $_POST["particular"];
    $amount = $_POST["amount"];
    $obligated = $_POST["obligated"];
    $balance = $_POST["balance"];


// Perform queries

$do = "UPDATE nta set datenta='$datenta',
datereceived='$datereceived', 
accountno='$accountno',
ntano='$ntano',
saronumber='$saronumber',
particular='$particular',
amount='$amount',
obligated='$obligated',
balance='$balance'
where id = ".$requestid."";

/* echo "UPDATE nta set datenta='$datenta',
datereceived='$datereceived', 
accountno='$accountno',
ntano='$ntano',
saronumber='$saronumber',
particular='$particular',
amount='$amount',
obligated='$obligated',
balance='$balance'
where id = ".$requestid."";
exit(); */
$query = mysqli_query($conn,$do);

//updating obligation
$total="";
$ans="";

// $query1  = mysqli_query($conn,"SELECT sum(amount) as total FROM  saroob where saronumber = '$saronumber' and uacs = '$uacs' ");

// while ($row = mysqli_fetch_assoc($query1)) 
// {
// $total = $row["total"]; 

// // $ans = $total + ($amount - $newamount);
// // echo $ans;
// // exit();


// $update = mysqli_query($conn,"Update saro set obligated = $total where saronumber = '$saronumber' and uacs = '$uacs'");
// //updating balance
// $update = mysqli_query($conn,"Update saro set balance = amount - obligated where saronumber = '$saronumber' and uacs = '$uacs'");
// }

mysqli_close($conn);

if($query){

    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Updated Successfully!')
    window.location.href='../@nta.php';
    </SCRIPT>"); 
    
    //header('Location:../@obligation.php?message=Data Added Successfully!');
    
    }
    else{
    
    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    window.location.href='../@nta.php';
    </SCRIPT>");
    }

}
?>
