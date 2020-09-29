
<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_travelclaim.xlsx");

    include 'connection.php';
    $SQL = "SELECT TC_ID, tbltravel_claim_info.RO, RO_OT_OB FROM `tbltravel_claim_info2`
    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
    WHERE  `RO_TO_OB`= 'SAMPLE MEETING 2'";
    $result1 = mysqli_query($conn, $SQL);
    $search = array();

    while($row = mysqli_fetch_array($result1))
    {
      

        $search[] = $row["RO"]; 
        $array = array_unique($search);
        $a = implode(',', $array);
        $pieces = explode(",", $a);
    
     

    }
$data = 16;
    for($i = ; $i < count($pieces); $i++)
    {

        $SQL1 = "SELECT PERDIEM + RECEIPT AS 'a', tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `RECEIPT`,`OTHERS`, `TOTAL_AMOUNT`,
        tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
        INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
        WHERE tbltravel_claim_info.RO = '".$pieces[$i]."' ";
        $result11 = mysqli_query($conn, $SQL1);
            if($row1 = mysqli_fetch_array($result11))
            {

                $place = $row1["PLACE"]; 
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$data,$place);


            }
           
                $data++;
    }
exit();
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    header('location: export_travelclaim.xlsx');
?>