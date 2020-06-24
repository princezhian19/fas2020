<?php 
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
$totalamount = ($_POST['perdiem'] + $_POST['transpo_fare']);
for($a=0;$a <= count($_POST['from3']); $a++)
{
    $from3  = $_POST['from3'][$a];
    $to3 = $_POST['to3'][$a];
    $transpo = $_POST['transpo'][$a];
    $transpo_fare = $_POST['transpo_fare'][$a];
    include 'connection.php';

  $insert ="INSERT INTO `tbltravel_claim_info`(`TC_ID`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `OTHERS`, `TOTAL_AMOUNT`) 
            VALUES 
            ('".$unique_id."',
             '".$_POST['date']."',
             '".$_POST['destination']."',
             '".$_POST['from1']."',
             '".$_POST['to1']."',
             '".$_POST['transpo']."',
             '".$_POST['perdiem']."',
             '".$_POST['others']."',
             '".$_totalamount."'
            )";
    if (mysqli_query($conn, $insert)) {
    } else {
    }
 

}
header("Location:CreateTravelClaim.php?username=".$_SESSION['username']."");

?>