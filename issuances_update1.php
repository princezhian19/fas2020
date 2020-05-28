<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

 
?>


<?php


if(isset($_POST['edit'])){


    $filename = $_FILES['file1']['name'];
    $tempname = $_FILES['file1']['tmp_name'];
        
    
        if(isset($filename)){
            if(!empty($filename)){
    
                $location = "files/";
                if(move_uploaded_file($tempname, $location.$filename)){
    
                   
    
                        //echo 'File Uploaded!';
                    
                }
               
            }
            
            
    
        }
    
$id = $_POST['getid'];
$issuance = $_POST['issuance1'];


$category = $_POST['category1'];
$issuances = $_POST['issuances1'];
$dateissued1 = $_POST['dateissued1'];

$dateissued = date('Y-m-d', strtotime($dateissued1));
$title = $_POST['title1'];

$getfile = $_POST['getfile1'];

$url = $_POST['url1'];
$postedby = $_POST['postedby1'];


$office_responsible = $_POST['office_responsible1'];


$posteddate1 = $_POST['posteddate1'];
$posteddate = date('Y-m-d', strtotime($posteddate1));


$office = $_POST['office1'];



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

if(empty($_FILES['file1']['name'])){

if(empty($_POST['todiv1'])){

 
  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Concerned office cannot be empty. </p> </div></div> '; 


}else
{

  //getting issuance no.
  
  $query22 = mysqli_query($conn,"DELETE from issuances_office_responsible  where issuance_id ='$issuances'");
   



  $counted = count($_POST['todiv']);
  
  for ($i=0; $i < $counted ; $i++)
  { 

      
      $insertofficerespo = "INSERT INTO issuances_office_responsible (issuance_id,office_responsible) values ( ?,?)";
      $insertofficeresponsible = $conn->prepare($insertofficerespo);
      $insertofficeresponsible->bind_param("ss",$issuances,$_POST['todiv'][$i]);
      $insertofficeresponsible->execute();
  

  }

  $query = mysqli_query($conn,"UPDATE issuances set issuance_no='$issuances',status='approved',subject='$title',office_responsible='$office_responsible',pdf_file='$getfile',dateposted='$posteddate',date_issued='$dateissued',postedby='$postedby',category='$category',url='$url' where id ='$id'");
  

}


}
else
{
  if(empty($_POST['todiv1'])){

 
    echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Concerned office cannot be empty. </p> </div></div> '; 
  
  
  }else
  {
  
    
    
    $query22 = mysqli_query($conn,"DELETE from issuances_office_responsible  where issuance_id ='$issuances'");
  
  
  
  
    $counted = count($_POST['todiv']);
    
    for ($i=0; $i < $counted ; $i++)
    { 
  
        
        $insertofficerespo = "INSERT INTO issuances_office_responsible (issuance_id,office_responsible) values ( ?,?)";
        $insertofficeresponsible = $conn->prepare($insertofficerespo);
        $insertofficeresponsible->bind_param("ss",$issuances,$_POST['todiv'][$i]);
        $insertofficeresponsible->execute();
    
  
    }
    $query = mysqli_query($conn,"UPDATE issuances set issuance_no='$issuances',status='approved',subject='$title',office_responsible='$office_responsible',pdf_file='$filename',dateposted='$posteddate',date_issued='$dateissued',postedby='$username1',category='$category',url='$url' where id ='$id'");
   

    
  
  }

}

mysqli_close($conn);

if($query){

    // echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Issuances has been successfully updated.')
    window.location.href='issuances.php';
    </SCRIPT>"); 
}
else{

    // echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error.')
    window.location.href='issuances.php';
    </SCRIPT>");
}
}
?>