<?php
include 'connection.php';
 $SQL = "SELECT PERDIEM + RECEIPT AS 'a', tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `RECEIPT`,`OTHERS`, `TOTAL_AMOUNT`,
 tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
 INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
";
 $result1 = mysqli_query($conn, $SQL);
 $a = array();
     while($row = mysqli_fetch_array($result1))
     {
        $a[] = $row['DATE'];

            $count = count($a);
            $b = [];
            for($i=0; $i<$count; $i++){
                if(!in_array($a[$i], $b)){
                    array_push($b, $a[$i]);
                }
            }

        }
print_r ($b);

?>