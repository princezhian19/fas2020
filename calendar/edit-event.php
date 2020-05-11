<?php
session_start();
date_default_timezone_set('Asia/Manila');

if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
require_once "db.php";

$id     = $_POST['eventid'];
$title  = $_POST['titletxtbox'];
$start  = date('Y-m-d',strtotime($_POST['startdatetxtbox']));
$end    = date('Y-m-d',strtotime($_POST['enddatetxtbox']));
$des    = $_POST['descriptiontxtbox'];
$ven    = $_POST['venuetxtbox'];
$tar    = $_POST['enptxtbox'];



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
header('location:../ViewCalendar.php?division='.$_SESSION['division'].'&flag=1');
?>
