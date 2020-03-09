<?php
$link = mysqli_connect("localhost","root","", "db_dilg_pmis");
$ict_staff = $_POST['ict_staff'];
$control_no = $_POST['control_no'];
$insert ="UPDATE `tbltechnical_assistance` SET 
        `ASSIST_BY` = '$ict_staff',
        `STATUS_REQUEST` = 'For action'
        WHERE `CONTROL_NO` = '$control_no' ";

if (mysqli_query($link, $insert)) {
} else {
}
?>