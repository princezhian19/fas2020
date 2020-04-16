
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


$getid = $_GET['id'];
//echo $getid;
$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);
/* $view_query = mysqli_query($conn, "SELECT * from downloads where download_id = '$getid'");

    while ($row = mysqli_fetch_assoc($view_query)) {
        

        $id = $row['download_id'];
       
        $file = $row['file'];
       
        
    } */

    // $path = "files/".$file;
    // readfile($file);
   

    //echo $cat;

    if (!empty($getid))
	{

        $conn = new mysqli($servername, $username, $password,$database);
		$query = "SELECT download_id, title, file, hits, url FROM downloads WHERE download_id = '$getid' LIMIT 1";
		//echo $query;					
		$queryRs = $conn->query( $query );	
				
		if ($queryRs->num_rows)
		{
			$row = $queryRs->fetch_assoc(); 
			$row['hits'] += 1;
            $file = "files/".$row['file'];
        /* echo ($file);
        exit(); */
            if(empty($row['file'])){
              $file = $row['url'];
            }
			$updateHits = "UPDATE `downloads` SET `hits`='".$row['hits']."' WHERE WHERE download_id = '$getid' LIMIT 1";
			/* Select queries return a resultset */
			if ($row = $conn->query($updateHits)) 
			{
				$conn->close();

                header('Location:'.$file);
                readfile($file);
				exit();
			} 
		}
		else
		{			
			header('Location: databank.php.php');
			exit();
		}
	}
   

?>
