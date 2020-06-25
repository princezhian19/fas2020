<?php 
session_start();
$unique_id = $_SESSION['unique_id'];
// destination
// perdiem
// date
// from1
// to1
// meals
// from2
// to2
// accomodation
// others

// from3[]
// to3[]
// transpo[]
// transpo_fare[]

for($a=0;$a < count($_POST['from3']); $a++)
{
    $from3  = $_POST['from3'][$a];
    $to3 = $_POST['to3'][$a];
    $destination = $from3.' to '.$to3;
    $transpo_fare = $_POST['transpo_fare'][$a];
$totalamount = $_POST['transpo_fare'][$a];

    include 'connection.php';
    $insert ="INSERT INTO `tbltravel_claim_info`(`TC_ID`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `OTHERS`, `TOTAL_AMOUNT`) 
            VALUES 
            ('".$unique_id."',
             '".date('Y-m-d',strtotime($_POST['date']))."',
             '".$destination."',
             '".date('g:i',strtotime($_POST['from1']))."',
             '".date('g:i',strtotime($_POST['to1']))."',
            null,
             '".$transpo_fare."',
             null,
             '".$_POST['others']."',
             '".$totalamount."'
            )";
    if (mysqli_query($conn, $insert)) {
    } else {
    }

  
 
}
for($b=0;$b < count($_POST['mot']); $b++)
{
    $mot = $_POST['mot'][$b];
    include 'connection.php';
    $update ="UPDATE `tbltravel_claim_info` SET `MOT`='".$mot."'  WHERE `TC_ID` = '".$unique_id."' ";
    if (mysqli_query($conn, $update)) {
    } else {
    }
    echo $update;
}
header("Location:CreateTravelClaim.php?username=".$_SESSION['username']."");

?>