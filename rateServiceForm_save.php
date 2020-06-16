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

$query = "SELECT * FROM `ta_monitoring` WHERE `STATUS_REQUEST` LIKE '%RATED%' ";

$result = mysqli_query($conn, $query);
$COUNT = '';
while($row = mysqli_fetch_array($result))
{
    $COUNT = $row['COUNT']+1;
}

$insert1 ="UPDATE `ta_monitoring` SET 
`COUNT` = '$COUNT'
 WHERE `ta_monitoring`.`ID` = 4";
if (mysqli_query($conn, $insert1)) {
} else {
}
?>