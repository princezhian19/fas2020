<?php
include 'connection.php';
$ict_staff = $_POST['ict_staff'];
$control_no = $_POST['control_no'];
$assign_date = date('Y-m-d');

$insert ="UPDATE `tbltechnical_assistance` SET 
        `ASSIST_BY` = '$ict_staff',
        `STATUS_REQUEST` = 'For action',
        `ASSIGN_DATE` = '$assign_date'
        WHERE `CONTROL_NO` = '$control_no' ";
        echo $insert;

if (mysqli_query($conn, $insert)) {
} else {
}
?>