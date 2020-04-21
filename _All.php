
<?php 
include './_includes/Database.php';
// $servername = "localhost";
// $username = "fascalab_2020";
// $password = "w]zYV6X9{*BN";
// $database = "fascalab_2020";

// $conn = new mysqli($servername, $username, $password,$database);

// // Check connection
// if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
// }

// $conn = new mysqli($servername, $username, $password,$database);
// $view_query = mysqli_query($conn, "SELECT file from downloads ");

//     $index = 0;
//     while ($row = mysqli_fetch_assoc($view_query)) {
//      // $count = count($row["file"]);
//       echo '<br>';

//      $file = $row["file"];
//       echo $file;
//       echo '<br>';
//       var_dump($row) ;
    
    
//     }
//$location = "files/".$file;
//echo $location;




           



    $dao = new Database();

    try {
        $sql = "SELECT id, pdf_file from issuances order by id asc";
        $pdo = Database::openConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([]);
        $data = $stmt->fetchAll();
        foreach ($data as $key => $value) {
            $location = "files/".$value['pdf_file'];

            var_dump('key: '.$key.' ID: '.$value['id'].' location: '.$location.'</br>'.'</br>');
            echo '<a  href="<?php echo $location?>" title="View" class = "btn btn-info btn-xs"> View   </a>';
            
        }

        
        // var_dump($data);
        // var_dump('Count: '.count($data));
    } catch (\Exception $e) {
        $pdo->rollback();
        echo "There is some problem in connection: " . $e->getMessage();
    }


    // echo $count;

    // for($i=0; $i<$count;$i++){
    //     $file = $row["file"][$i];
    //     echo $file;

    // }


    

?>