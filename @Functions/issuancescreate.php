
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

   

$category = $_POST['category'];
$issuances = $_POST['issuances'];
$dateissued = $_POST['dateissued'];
$title = $_POST['title'];
$office = $_POST['office'];
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
 VALUES ('$issuances','approved','$title','','','$office','$filename','$posteddate','$dateissued','$postedby','NULL','$category','$url')");


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
