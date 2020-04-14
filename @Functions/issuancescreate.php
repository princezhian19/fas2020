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
    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

    $username1 = $_SESSION['username'];
    
   /*  $filename->file_name = "issuances_".date("Ynj")."_".substr(md5(rand(0,9999999)), 0, 10).strrchr($_FILES["file"]["name"],"."); 
    $filename->upload_dir 		= $directory; 
    $filename->upload_log_dir 	= $directory."logs/"; 
    $filename->max_file_size 	= 5000000; 
    $filename->banned_array 	= array(""); 
    $filename->ext_array 		= array(".pdf"); 			

    $valid_ext 				= $filename->validate_extension();
    $valid_size 			= $filename->validate_size(); 
    $valid_user 			= $filename->validate_user();
    $max_size 				= $filename->get_max_size();
    $file_size 				= $filename->get_file_size(); 
    $file_exists 			= $filename->existing_file(); 			
    
    if (!$valid_ext) { 
        $msg = array("The file extension is invalid, please try again!",'ERROR');
    } 
    elseif (!$valid_size) { 
        $msg = array("The file size is invalid, please try again! The maximum file size is: $max_size and your file was: $file_size",'ERROR');
    } 
    elseif (!$valid_user) { 
        $msg = array("You have been banned from uploading to this server.",'ERROR');
    } 
    elseif ($file_exists) { 
        $msg = array("This file already exists on the server, please try again.",'ERROR');
    } else { 
        $upload_file = $filename->upload_file_with_validation(); 
        if (!$upload_file) { 
            $msg = array("Your file could not be uploaded!",'ERROR');
        } else { 
            $msg = array("Your file has been successfully uploaded to the server.",'INFO'); 			
        } 
    }	
 */
$filename = $_FILES['file']['name'];
$tempname = $_FILES['file']['tmp_name'];
    

    if(isset($filename)){
        if(!empty($_FILES['file']['name'])){

            $location = "../files/";

                 
            
            if(move_uploaded_file($tempname, $location.$filename)){

               

                    //echo 'File Uploaded!';
                
            }
           
        }
        
        

    }

   

$category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued = $_POST['dateissued'];
$title = $_POST['title'];
//$office = $_POST['office'];
//$file = $_POST['file'];
$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];

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

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


 $query = mysqli_query($conn,"INSERT INTO issuances (issuance_no ,status,subject,summary,keywords,office_responsible,pdf_file,dateposted,date_issued,postedby,type,category,url) 
 VALUES ('$issuances','approved','$title','','','$postedby','$filename','$posteddate','$dateissued','$username1','NULL','$category','$url')");

 /* echo "INSERT INTO issuances (issuance_no ,status,subject,summary,keywords,office_responsible,pdf_file,dateposted,date_issued,postedby,type,category,url) 
 VALUES ('$issuances','approved','$title','','','$postedby','$filename','$posteddate','$dateissued','$username1','NULL','$category','$url')";
 exit(); */


mysqli_close($conn);

if($query){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
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
