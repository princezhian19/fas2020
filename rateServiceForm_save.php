<?php
include 'connection.php';

$timeliness = $_POST['timeliness'];
$quality = $_POST['quality'];

$insert ="UPDATE `tbltechnical_assistance` SET `TIMELINESS` = '$timeliness', `STATUS` = '$quality' WHERE `CONTROL_NO` = '".$_POST['control_no']."'";
if (mysqli_query($conn, $insert)) {
} else {
}
?>