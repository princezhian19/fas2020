<?php
session_start();
$complete_name = $_SESSION['complete_name'];
date_default_timezone_set("Asia/Manila");
include 'connection.php';
$id = $_POST['id'];
$option = $_POST['option'];
$date_recieved = date('Y-m-d');

$time =  date("h:i:sa");
$time_recieved= date("H:i", strtotime($time));





switch ($option) {
    case 'released':
        $insert ="UPDATE `tbltechnical_assistance` SET 
        `STATUS_REQUEST` = 'Received',
        `START_DATE` = '$date_recieved',
        `START_TIME` = '$time_recieved',
        `ASSIST_BY`  = '$complete_name'
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