<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
}
?>
<?php


if(isset($_POST['submit'])){


    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];
        
    
        if(isset($filename)){
            if(!empty($filename)){
    
                $location = "../files/";
                if(move_uploaded_file($tempname, $location.$filename)){
    
                   
    
                        //echo 'File Uploaded!';
                    
                }
               
            }
            
            
    
        }
    
$id = $_POST['getid'];
$category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued1 = $_POST['dateissued'];

$dateissued = date('Y-m-d', strtotime($dateissued1));
$title = $_POST['title'];

$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];



$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
$username1 = $_SESSION['username'];
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}




 $query = mysqli_query($conn,"UPDATE downloads set title='$title',file='$filename',category='$category',dateposted='$posteddate',postedby='$username1',url='$url' where download_id ='$id'");


// echo "UPDATE downloads set title='$title',file='$filename',category='$category',dateposted='$posteddate',postedby='$username1',url='$url' where download_id ='$id'";
// exit();

mysqli_close($conn);

if($query){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Updated Successfully!')
    window.location.href='../databank.php';
    </SCRIPT>"); 

}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='../databank.php';
    </SCRIPT>");
}
}
?>
