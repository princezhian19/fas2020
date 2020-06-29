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
if($_POST['flag'] == 1)
{
  $id     = $_POST['eventid'];
  
$title  = $_POST['title'];
$start  = date('Y-m-d',strtotime($_POST['start']));
$end   = date('Y-m-d',strtotime($_POST['end']));
$des    = $_POST['desc'];
$ven    = $_POST['venue'];
$tar    = $_POST['enp'];
$remarks    = $_POST['remarks2'];
}
else{

  $id     = $_POST['eventid'];
  $title  = $_POST['titletxtbox'];
  $start  = date('Y-m-d',strtotime($_POST['startdatetxtbox']));
  $end    = date('Y-m-d',strtotime($_POST['enddatetxtbox']));
  $des    = $_POST['descriptiontxtbox'];
  $ven    = $_POST['venuetxtbox'];
  $tar    = $_POST['enptxtbox'];
$remarks    = $_POST['remarks'];

  
  
}


$sqlUpdate = "UPDATE events SET 
`title`='" . $title . "',
`start`='" . $start . "',
`end`='" . $end . "', 
`description`='" . $des. "',
`venue`='". $ven . "',
`enp`='". $tar . "',
`remarks` = '".$remarks."'
WHERE id=" . $id;

// 
if (mysqli_query($conn, $sqlUpdate)) {
} else {
}
if($_POST['flag'] == 1)
{
header('location:../ManageCalendar.php?division='.$_SESSION['division'].'');

}else{
header('location:../ViewCalendar.php?division='.$_SESSION['division'].'&flag=1');

}
?>
