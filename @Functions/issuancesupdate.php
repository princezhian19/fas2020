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
$dateissued = $_POST['dateissued'];
$title = $_POST['title'];
//$office = $_POST['office'];
//$file = $_POST['file'];
$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];

/* echo $id; */

/* echo $category;
echo '<br>';
echo $issuances;
echo '<br>';
echo $dateissued;
echo '<br>';
echo $title;
echo '<br>';
echo $offices;
echo '<br>';
echo $file;
echo '<br>';
echo $url;
echo '<br>';
echo $postedby;
echo '<br>';
echo $posteddate;
exit();
 */

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


 $query = mysqli_query($conn,"UPDATE issuances set issuance_no='$issuances',status='approved',subject='$title',office_responsible='$postedby',pdf_file='$filename',dateposted='$posteddate',date_issued='$dateissued',postedby='$username1',category='$category',url='$url' where id ='$id'");
/* echo "UPDATE issuances set issuance_no='$issuances',status='approved',subject='$title',office_responsible='$office',pdf_file='$file',dateposted='$posteddate',date_issued='$dateissued',postedby='$postedby',category='$category',url='$url' where id ='$id'";
exit(); */

mysqli_close($conn);

if($query){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Updated Successfully!')
    window.location.href='../issuances.php';
    </SCRIPT>"); 

}
else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='../issuances.php';
    </SCRIPT>");
}
}
?>
