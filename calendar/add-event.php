<?php
session_start();
date_default_timezone_set('Asia/Manila');

require_once "db.php";

$title      =       isset($_POST['title']) ? $_POST['title'] : "";
$start      =       isset($_POST['start']) ? $_POST['start'] : "";
$startdate  =       date('Y-m-d',strtotime($_POST['startdatetxtbox']));
$enddate    =       date('Y-m-d',$_POST['enddatetxtbox']));
$description=       $_POST['descriptiontxtbox'];
$venue      =       $_POST['venuetxtbox']; 
$enp        =       $_POST['enptxtbox'];
$title      =       $_POST['titletxtbox'];
$color      =       $_POST['colortxtbox'];
$end        =       isset($_POST['end']) ? $_POST['end'] : "";
$starttime  =       date("H:i:s", mktime(0, 0, 0));
$endtime    =       date("H:i:s", mktime(0, 0, 0));
$today      =       date("Y-m-d h:i:s"); 
$startdatetime =    $startdate . "\n" . $starttime;
$postedby   =       $name;
$posteddate =       $today;
$realenddate=       $enddate . "\n" . $endtime;
$dateplusone=       new DateTime($realenddate);
$dateplusone->modify('+12 hours');
$enddatetime=       $dateplusone->format('Y-m-d h:i:s');
$remarks    =       $_POST['remarks'];
$datetime1  =       strtotime($startdatetime);
$datetime2  =       strtotime($enddatetime);
$secs       =       $datetime2 - $datetime1;
$days       =       $secs / 86400;
$cancelflag =       0;
$office     =       $_SESSION['division'];
$currentuser=       $_SESSION['currentuser'];


$sql = "INSERT INTO events 
(office,title, 
color, start, 
end, description, 
venue, enp, 
postedby, posteddate, 
realenddate, cancelflag, 
status,remarks) 
VALUES 
('$office','$title','$color','$startdatetime','$enddate','$description','$venue','$enp','$currentuser','$posteddate','$realenddate','$cancelflag','1','$remarks')";

$result = mysqli_query($conn, $sql);

if (! $result) {
    $result = mysqli_error($conn);
}
echo $sql;
?>