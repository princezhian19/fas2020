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

$posteddate1 = $_POST['posteddate'];
$posteddate = date('Y-m-d', strtotime($posteddate1));



$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if(empty($_FILES['file']['name'])  ){

  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached File cannot be empty. </p> </div></div>  '; 


}
else{

  if(empty($_POST['todiv'])){

    //echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Concerned office cannot be empty. </p> </div></div> '; 
      echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Concerned office cannot be empty.')
    window.location.href='issuances.php';
    </SCRIPT>"); 
}else{

    $counted = count($_POST['todiv']);
    
    for ($i=0; $i < $counted ; $i++)
    { 
  
        
        $insertofficerespo = "INSERT INTO issuances_office_responsible (issuance_id,office_responsible) values ( ?,?)";
        $insertofficeresponsible = $conn->prepare($insertofficerespo);
        $insertofficeresponsible->bind_param("ss",$issuances,$_POST['todiv'][$i]);
        $insertofficeresponsible->execute();
    
  
    }

 $query = mysqli_query($conn,"INSERT INTO issuances (issuance_no ,status,subject,summary,keywords,office_responsible,pdf_file,dateposted,date_issued,postedby,type,category,url) 
 VALUES ('$issuances','approved','$title','','','$postedby','$filename','$posteddate','$dateissued','$username1','NULL','$category','$url')");

 

  }
}

mysqli_close($conn);

if($query){

   // echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully added. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Issuances has been successfully added.')
    window.location.href='issuances.php';
    </SCRIPT>");

}
else{

  
  //echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error!')
    window.location.href='issuances.php';
    </SCRIPT>");
}

}



?>