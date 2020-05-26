<?php
session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}



if(isset($_POST['Add'])){
    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

    $username1 = $_SESSION['username'];
    
  
$filename = $_FILES['file']['name'];
$tempname = $_FILES['file']['tmp_name'];
    

    if(isset($filename)){
        if(!empty($_FILES['file']['name'])){

            $location = "files/";

                 
            
            if(move_uploaded_file($tempname, $location.$filename)){

               

                    //echo 'File Uploaded!';
                
            }
           
        }
        
        

    }

   

$category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued1 = $_POST['dateissued'];
$dateissued = date('Y-m-d', strtotime($dateissued1));
$title = $_POST['title'];

$url = $_POST['url'];
$postedby = $_POST['postedby'];

$posteddate = $_POST['posteddate'];
$office = $_POST['office'];


$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if(empty($_FILES['file']['name'])){

 // echo '<div class="addmodal"><div class="" style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached file cannot be empty. </p> </div></div>  '; 
 echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Attached file cannot be empty.!')
  window.location.href='databank.php';
  </SCRIPT>");

}
else{
  $query = mysqli_query($conn,"INSERT INTO downloads (title,file,category,dateposted,postedby,url,office) 
  VALUES ('$title','$filename','$category','$posteddate','$username1','$url','$office')");

if($query){

  // echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Databank has been successfully added. </p> </div></div>  '; 
   echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.alert(' Databank has been successfully added.')
   window.location.href='databank.php';
   </SCRIPT>"); 
 
 }
 else{
 
 
 //echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
 
   echo ("<SCRIPT LANGUAGE='JavaScript'>
   window.alert('Error!')
   window.location.href='databank.php';
   </SCRIPT>");
 }
 

}

 /* echo "INSERT INTO issuances (issuance_no ,status,subject,summary,keywords,office_responsible,pdf_file,dateposted,date_issued,postedby,type,category,url) 
 VALUES ('$issuances','approved','$title','','','$postedby','$filename','$posteddate','$dateissued','$username1','NULL','$category','$url')";
 exit(); */

/*  echo "INSERT INTO downloads (title,file,category,dateposted,postedby,url) VALUES ('$title','$filename','$category','$posteddate','$username1','$url')";
 exit(); */


mysqli_close($conn);



}



?>
