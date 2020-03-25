
<?php
include('../@classes/db.php');

$sn = $_POST['sn'];
$item = $_POST['item'];


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
$query = mysqli_query($conn,"INSERT INTO item_list (code,item) 
VALUES ('$sn','$item ')");



mysqli_close($conn);

if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../@items.php?message=Data Added Successfully!';
    </SCRIPT>");

 

}
else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    window.location.href='../@items.php?message=Error!';
    </SCRIPT>");
}


?>
