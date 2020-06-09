<?php 

include 'connection.php';
$id = $_POST['id'];
    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
    $query = "SELECT * FROM `events` inner join tblemployeinfo on events.postedby = tblemployeinfo.EMP_N where `ID` ='$id' ";
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