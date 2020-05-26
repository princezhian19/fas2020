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
$category = $_POST['category1'];
$title = $_POST['title1'];

$url = $_POST['url1'];
$postedby = $_POST['postedby1'];

$posteddate = $_POST['posteddate1'];

$office = $_POST['office1'];

$getfile = $_POST['getfile'];
//echo $getfile;

$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
//$username1 = $_SESSION['username'];
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}



if(empty($_FILES['file1']['name'])){

  //echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Attached file cannot be empty. </p> </div></div>  '; 

  $query = mysqli_query($conn,"UPDATE downloads set title='$title',file='$getfile',category='$category',dateposted='$posteddate',postedby='$postedby',url='$url',office='$office' where download_id ='$id'");
  /* echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.alert('Databank has been successfully updated.')
  window.location.href='';
  </SCRIPT>");  */


  if($query){

    //echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Databank has been successfully updated.')
    window.location.href='databank.php';
    </SCRIPT>"); 
  
  }
  else{
  
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error')
    window.location.href='databank.php';
    </SCRIPT>"); 
  
  }
}
else
{
 $query = mysqli_query($conn,"UPDATE downloads set title='$title',file='$filename',category='$category',dateposted='$posteddate',postedby='$postedby',url='$url',office='$office' where download_id ='$id'");
/*  echo ("<SCRIPT LANGUAGE='JavaScript'>
 window.alert('Databank has been successfully updated.')
 window.location.href='';
 </SCRIPT>"); */


 if($query){

    //echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Databank has been successfully updated.')
    window.location.href='databank.php';
    </SCRIPT>"); 
  
  }
  else{
  
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error')
    window.location.href='databank.php';
    </SCRIPT>"); 
  
  }

}

// echo "UPDATE downloads set title='$title',file='$filename',category='$category',dateposted='$posteddate',postedby='$username1',url='$url' where download_id ='$id'";
// exit();

mysqli_close($conn);




}
?>