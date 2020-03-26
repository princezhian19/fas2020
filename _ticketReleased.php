<?php
include 'connection.php';$id = $_POST['id'];
$option = $_POST['option'];
$date_recieved = date('Y-m-d');
$time = date('H:m');
$time_recieved  = date("H:i",strtotime($date_recieved." ".$time));


switch ($option) {
    case 'released':
        $insert ="UPDATE `tbltechnical_assistance` SET 
        `STATUS_REQUEST` = 'Received',
        `START_DATE` = '$date_recieved',
        `START_TIME` = '$time_recieved'
        WHERE `CONTROL_NO` = '$id' ";
        if (mysqli_query($conn, $insert)) {
        } else {
        }
        break;
        echo $insert;
    case 'complete':
        $insert ="UPDATE `tbltechnical_assistance` SET 
        `STATUS_REQUEST` = 'Completed'
        WHERE `CONTROL_NO` = '$id' ";
        if (mysqli_query($conn, $insert)) {
        } else {
        }
            break;
    
    default:
        # code...
        break;
}

?>