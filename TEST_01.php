

<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_travelclaim.xlsx");
define('FORMAT_CURRENCY_PHP', '₱#,##0.00_-');
    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


function countTravelDetails($id)
{
    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    $query = "SELECT count(*) as 'count' FROM `tbltravel_claim_info`WHERE `RO`= '$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)    
    {
        while($row1 = mysqli_fetch_array($result))
        {
            $excelRow = $row1['count'];
        }
    }
    return $excelRow;
}

    $query = "SELECT DISTINCT(RO_OT_OB), tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
    WHERE  `RO_TO_OB`= 'SAMPLE MEETING' ";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)    
    {
        $row_title = 15;
        while($row1 = mysqli_fetch_array($result))
        {
            $count = countTravelDetails($row1['ID']);

            // $objPHPExcel->getActiveSheet()->mergeCells("A".$row_title."".":J".$row_title);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_title,'TOTAL');

            echo $row_title;
        $row_title++;
        }
    }


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');


?>