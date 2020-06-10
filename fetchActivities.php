<?php 

include 'connection.php';
$id = $_POST['id'];
    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
<<<<<<< HEAD
    $query = "SELECT * FROM `events` inner join tblemployeeinfo on events.postedby = tblemployeeinfo.EMP_N  where `ID` ='$id' ";
=======
    $query = "SELECT * FROM `events` inner join tblemployeeinfo on events.postedby = tblemployeeinfo.EMP_N where `ID` ='$id' ";
>>>>>>> c1d384fe41c784350383fc2e6fdd7c85ec8d41fa
    $result = mysqli_query($conn, $query);
    $data = array();
    while($row = mysqli_fetch_array($result))
      {
        $data[] = array(
            "title" => $row['title'],
            "start" => date("F d, Y",strtotime($row['start'])),
            "end" => date("F d, Y",strtotime($row['end'])),
            "description" => $row['description'],
            "venue" => $row['venue'],
            "enp" => $row['enp'],
            "remarks" => $row['remarks'],
            "postedby" => $row['UNAME'],
            "posteddate" =>date("F d, Y",strtotime($row['posteddate']))
        
        );

      }
      echo json_encode($data);
?>