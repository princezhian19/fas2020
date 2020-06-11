<?php
include 'connection.php';
date_default_timezone_set('Asia/Manila');

$timeliness = $_POST['timeliness'];
$quality = $_POST['quality'];
$date_rated = date('Y-m-d');

$insert ="UPDATE `tbltechnical_assistance` SET `STATUS_REQUEST` = 'Rated', `DATE_RATED` = '$date_rated', `TIMELINESS` = '$timeliness', `QUALITY` = '$quality' WHERE `CONTROL_NO` = '".$_POST['control_no']."'";
if (mysqli_query($conn, $insert)) {
} else {
}
?>