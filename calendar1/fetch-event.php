<?php
    require_once "db.php";

    $json = array();
    $sqlQuery = "SELECT id ,dispatcher, assigneddate, assigneddateend, av,ad from vr";
    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    

    echo json_encode($eventArray);


?>