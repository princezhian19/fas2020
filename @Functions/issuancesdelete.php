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


/* if(isset($_POST['submit'])){ */

/* 
    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];
        
    
        if(isset($filename)){
            if(!empty($filename)){
    
                $location = "../files/";
                if(move_uploaded_file($tempname, $location.$filename)){
    
                   
    
                        //echo 'File Uploaded!';
                    
                }
               
            }
            
            
    
        } */
    
$id = $_GET['id'];
/* $category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued = $_POST['dateissued'];
$title = $_POST['title'];

$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate']; */


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


 $query = mysqli_query($conn,"DELETE from issuances  where id ='$id'");
/* echo "UPDATE issuances set issuance_no='$issuances',status='approved',subject='$title',office_responsible='$office',pdf_file='$file',dateposted='$posteddate',date_issued='$dateissued',postedby='$postedby',category='$category',url='$url' where id ='$id'";
exit(); */

mysqli_close($conn);

if($query){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Deleted Successfully!')
    window.location.href='../issuances.php';
    </SCRIPT>"); 

}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='../issuances.php';
    </SCRIPT>");
}
// }
?>
