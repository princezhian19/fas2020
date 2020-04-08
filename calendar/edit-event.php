<?php
require_once "db.php";

$id     = $_POST['eventid'];
$title  = $_POST['titletxtbox'];
$start  = date('Y-m-d',strtotime($_POST['startdatetxtbox']));
$end    = date('Y-m-d',strtotime($_POST['enddatetxtbox']));
$des    = $_POST['descriptiontxtbox'];
$ven    = $_POST['venuetxtbox'];
$tar    = $_POST['targetparticipants'];



$sqlUpdate = "UPDATE events SET 
`title`='" . $title . "',
`start`='" . $start . "',
`end`='" . $end . "', 
`description`='" . $des. "',
`venue`='". $ven . "',
`enp`='". $tar . "'
WHERE id=" . $id;
if (mysqli_query($conn, $sqlUpdate)) {
} else {
}
echo $sqlUpdate;
?>