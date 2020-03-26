<?php
$link = mysqli_connect("localhost","root","", "db_dilg_pmis");
$id = $_POST['id'];
$insert ="UPDATE `tbltechnical_assistance` SET 
        `STATUS_REQUEST` = 'Received'
        WHERE `CONTROL_NO` = '$id' ";

if (mysqli_query($link, $insert)) {
} else {
}
?>