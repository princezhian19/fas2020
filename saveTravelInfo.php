<?php 
session_start();
$unique_id = $_SESSION['unique_id'];
$breakfast = $_POST['breakfast'];
$lunch = $_POST['lunch'];
$dinner = $_POST['dinner'];
$receipt = $_POST['wor_txt'];
if($breakfast == 'breakfast')
{
    $breakfast = 200;
}
if($lunch == 'lunch')
{
    $lunch = 200;
}
if($dinner == 'dinner')
{
    $dinner = 200;
}
if($receipt == 'Without Receipt')
{
    $receipt = 1100;
}
$perdiem = $breakfast+$lunch+$dinner+$receipt;


include 'connection.php';
$query = "SELECT ID as 'uid' FROM tbltravel_claim_info2  WHERE `NAME` = '".$_SESSION['username']."'  order by ID DESC limit 1  ";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)    
{
    if($row = mysqli_fetch_array($result))
    {
        $uid = $row['uid'];
        for($a=0;$a < count($_POST['mot']); $a++)
        {
            $from3  = $_POST['from3'][$a];
            $to3 = $_POST['to3'][$a];
            $destination = $from3.' to '.$to3;
            $transpo_fare = $_POST['transpo_fare'][$a];
            $totalamount = $_POST['transpo_fare'][$a]+$perdiem;
            $mot = $_POST['mot'][$a];

            include 'connection.php';
            $insert ="INSERT INTO `tbltravel_claim_info`(`TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `OTHERS`, `TOTAL_AMOUNT`) 
                    VALUES 
                    ('".$uid."',
                    '".$_POST['ro']."',
                    '".date('Y-m-d',strtotime($_POST['date']))."',
                    '".$destination."',
                    '".date('H:i',strtotime($_POST['from1']))."',
                    '".date('H:i',strtotime($_POST['to1']))."',
                    '".$mot."',
                    '".$transpo_fare."',
                    '".$perdiem."',
                    '".$_POST['others']."',
                    '".$totalamount."'
                    )";
            if (mysqli_query($conn, $insert)) {
            } else {
            }

        
        }
        // ========================================================
        // for($b=0;$b < count($_POST['mot'])+1; $b++)
        // {
            
        //     $mot = $_POST['mot'][$b];
        //     include 'connection.php';
        //     $update ="UPDATE `tbltravel_claim_info` SET `MOT`='".$mot."'  WHERE `ID` = '".$b."' ";
        //     if (mysqli_query($conn, $update)) {
        //     } else {
        //     }

        //     echo $update.'<br>';
        }
    }

header("Location:CreateTravelClaim.php?username=".$_SESSION['username']."");

?>