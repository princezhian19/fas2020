
<?php


    include 'connection.php';
    $SQL = "SELECT PERDIEM + RECEIPT AS 'a', tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `RECEIPT`,`OTHERS`, `TOTAL_AMOUNT`,
    tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
    INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
    ";
    $result1 = mysqli_query($conn, $SQL);
    $search = array();
    while($row = mysqli_fetch_array($result1))
    {
        $search[] = $row["DATE"]; 
        $array = array_unique($search);
        $a = implode(',', $array);
        $pieces = explode(",", $a);
    
     

    }
    for($i = 0; $i < count($pieces); $i++)
    {
        echo $pieces[$i].'<BR>';
    }

?>