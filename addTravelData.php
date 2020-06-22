<?php
include 'connection.php';

  $insert ="INSERT INTO `tbltravel_claim_info2`(`ID`, `RO_TO_OB`, `TRAVEL_DAYS`, `START_DATE`, `END_DATE`, `ORIGIN`, `DESTINATION`, `VENUE`) 
    VALUES (NULL,
    '".$_POST['rto']."',
    '".$_POST['ntd']."',
    '".date("Y-m-d",strtotime($_POST['start']))."',
    '".date("Y-m-d",strtotime($_POST['end']))."',
    '".$_POST['origin']."',
    '".$_POST['destination']."',
    '".$_POST['venue']."')";
    if (mysqli_query($conn, $insert)) {
    } else {
    }
echo $insert;
// header("Location:CreateTravelClaim.php")
?>