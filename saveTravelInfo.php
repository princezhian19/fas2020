<?php 
session_start();
$unique_id = $_SESSION['unique_id'];



include 'connection.php';






$query = "SELECT ID as 'uid' FROM tbltravel_claim_info2  WHERE `NAME` = '".$_SESSION['username']."'  order by ID DESC limit 1  ";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)    
{
    if($row = mysqli_fetch_array($result))
    {



        $uid = $row['uid'];
    




        $meals = '';
        $accomodation = '';

        if(isset($_POST['breakfast'])) { $breakfast2 = 1; }else{ $breakfast2 = 0; } if(isset($_POST['lunch'])) { $lunch2 = 1; }else{ $lunch2 = 0; } if(isset($_POST['dinner'])) { $dinner2 = 1; }else{ $dinner2 = 0; } if(!isset($_POST['with_receipt'])) { $accomodation = $_POST['with_receipt']; }else{ $accomodation = ''; } if($_POST['wor_txt'] == '') { $receipt2 = ''; }else{ $receipt2 = $_POST['wor_txt']; }

        $pdiem1 = '';
        if($_POST['distance'] > 50)
        {
            $pdiem1 = 440;
        }
        else{
            $pdiem1 = 0;
        }
       
        
        for($a=0;$a < count($_POST['date']); $a++)
        {
            if(isset($_POST['breakfast'][$a]) || isset($_POST['lunch'][$a]) || isset($_POST['dinner'][$a]) || isset($_POST['wor_txt'][$a])) 
            { 
              
                $breakfast = $_POST['breakfast'][$a]; 
                $lunch = $_POST['lunch'][$a]; 
                $dinner = $_POST['dinner'][$a]; 
                $receipt = $_POST['wor_txt'][$a]; 
                
                if($breakfast == 'breakfast')   
                { $breakfast = 220; } 
                if($lunch == 'lunch') 
                { $lunch = 220; } 
                if($dinner == 'dinner') 
                { $dinner = 220; } 
                if($receipt == 'Without Receipt') 
                { $receipt = 1100; } 
                
            }
               
                $perdiem = $breakfast+$lunch+$dinner+$receipt+$pdiem1; 

            $from3  = $_POST['from3'][$a];
            $to3 = $_POST['to3'][$a];
            $destination = $from3.' to '.$to3;
            $transpo_fare = $_POST['transpo_fare'][$a];
            $totalamount = $_POST['transpo_fare'][$a]+$perdiem;
            $mot = $_POST['mot'][$a];
            $ro = $_POST['ro'][$a];
            $date = $_POST['date'][$a];

            include 'connection.php';
            $query11 = "SELECT * FROM tbltravel_claim_ro order by id desc limit 1";
            $result11 = mysqli_query($conn, $query11);
            if(mysqli_num_rows($result1) > 0)    
            {
                while($row11 = mysqli_fetch_array($result11))
                {
                    if($row11['RO_OT_OB'] == $ro)
                    {
                        

                    }else{
                        $insert_ro ="INSERT INTO `tbltravel_claim_ro`(`ID`, `RO_OT_OB`, `UNAME`) 
                        VALUES (null, '".$ro."','".$_SESSION['username']."')";
                        if (mysqli_query($conn, $insert_ro)) {
                        } else {
                        }
                    }
                }

            }else{
                $insert_ro ="INSERT INTO `tbltravel_claim_ro`(`ID`, `RO_OT_OB`, `UNAME`) 
                VALUES (null, '".$ro."','".$_SESSION['username']."')";
                if (mysqli_query($conn, $insert_ro)) {
                } else {
                }
            }



           
            $query1 = "SELECT * FROM tbltravel_claim_ro order by id desc limit 1";
            $result1 = mysqli_query($conn, $query1);
            if(mysqli_num_rows($result1) > 0)    
            {
                if($row1 = mysqli_fetch_array($result1))
                {

                    

          
            // ===============================================================
            $insert ="INSERT INTO `tbltravel_claim_info`(`TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`,  `BREAKFAST`,`LUNCH`,`DINNER`, `ACCOMODATION`, `RECEIPT`, `PERDIEM`, `OTHERS`, `TOTAL_AMOUNT`) 
                    VALUES 
                    ('".$uid."',
                    '".$row1['ID']."',
                    '".date('Y-m-d',strtotime($date))."',
                    '".$destination."',
                    '".date('H:i',strtotime($_POST['from1']))."',
                    '".date('H:i',strtotime($_POST['to1']))."',
                    '".$mot."',
                    '".$transpo_fare."',
                    '".$breakfast2."',
                    '".$lunch2."',
                    '".$dinner2."',
                    '".$accomodation."',
                    '".$receipt."',
                    '".$perdiem."',
                    '".$_POST['others']."',
                    '".$totalamount."'
                    )";
            if (mysqli_query($conn, $insert)) {
            } else {
            }
        }
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

header("Location:CreateTravelClaim.php?ui=1&ro=".$_POST['hidden_ro']."&username=".$_SESSION['username']."");

?>