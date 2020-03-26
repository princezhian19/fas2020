<?php
include 'connection.php';$id = $_POST['id'];
$option = $_POST['option'];
switch ($option) {
    case 'released':
        $insert ="UPDATE `tbltechnical_assistance` SET 
        `STATUS_REQUEST` = 'Received'
        WHERE `CONTROL_NO` = '$id' ";
        if (mysqli_query($conn, $insert)) {
        } else {
        }
        break;
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