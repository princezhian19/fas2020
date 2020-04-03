<?php
    require_once "db.php";

    $json = array();
    $sqlQuery = "SELECT id, title, start, end, color, cancelflag FROM events where cancelflag = 0 and status = 1";
    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    echo json_encode($eventArray);
?>