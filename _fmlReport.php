
<?php
$connection=mysqli_connect("localhost","root","","db_dilg_pmis");
date_default_timezone_set('Asia/Manila');
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/fml.xlsx");
$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
  ),
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
  ),
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  ),
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  ),
);

 $styleCenter = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

 $styleLeft= array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        )
    );
$month = $_GET['month'];
$year = $_GET['year'];
    $sql_q10 = mysqli_query($connection, "SELECT MONTHNAME(`REQ_DATE`) AS 'month', YEAR(`REQ_DATE`) AS 'year', `ID`, `CONTROL_NO`, `REQ_DATE`, `REQ_TIME`, `REQ_BY`, `OFFICE`, `POSITION`, `CONTACT_NO`, `EMAIL_ADD`, `EQUIPMENT_TYPE`, `BRAND_MODEL`, `PROPERTY_NO`, `SERIAL_NO`, `IP_ADDRESS`, `MAC_ADDRESS`, `TYPE_REQ`, `TYPE_REQ_DESC`, `ISSUE_PROBLEM`, `START_DATE`, `START_TIME`, `STATUS_DESC`, `COMPLETED_DATE`, `COMPLETED_TIME`, `ASSIST_BY`, `PERSON_ASSISTED`, `TIMELINESS`, `QUALITY`, `STATUS` FROM `tbltechnical_assistance` WHERE MONTH(REQ_DATE) = $month and YEAR(REQ_DATE) = $year ");
    if (mysqli_num_rows($sql_q10)>0) {
    $row = 15;
    $no = 1;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {

    if(strlen($excelrow['REQ_BY']) >= 10)
    {
    $objPHPExcel->getActiveSheet(0)->getRowDimension($row)->setRowHeight(53);
    $objPHPExcel->getActiveSheet(0)->getStyle('E'.$row)->getAlignment()->setWrapText(true);

    }else{
    $objPHPExcel->getActiveSheet(2)->getRowDimension($row)->setRowHeight(14.40);
    $objPHPExcel->getActiveSheet(2)->getStyle('E'.$row)->getAlignment()->setWrapText(true);
    }


    $to_time_format = date('g:i',strtotime($excelrow['START_DATE'].''.$excelrow['START_TIME']));
    $from_time_format = date('g:i',strtotime($excelrow['COMPLETED_DATE'].''.$excelrow['COMPLETED_TIME']));
    $to_time = strtotime($excelrow['START_DATE'].''.$to_time_format);
    $from_time = strtotime($excelrow['COMPLETED_DATE'].''.$from_time_format);
    $rt= round(abs($to_time - $from_time) / 60,2). "minutes";
    // $date = date("h:m A");
    // $a = str_replace("AM","",'16:03 AM');

    // $time_in_24_hour_format  = date("H:i",strtotime($a));

    // echo $time_in_24_hour_format;
    // exit();

  

    
    $requested_time = date('g:i A',strtotime($excelrow['START_DATE'].' '.$excelrow['REQ_TIME']));
    $start_time     = date('g:i A',strtotime($excelrow['START_DATE'].' '.$excelrow['START_TIME']));
    $completed_time = date('g:i A',strtotime($excelrow['COMPLETED_DATE'].' '.$excelrow['COMPLETED_TIME']));


        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$no);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$excelrow['CONTROL_NO']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,$excelrow['REQ_DATE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,$requested_time);
        $objPHPExcel->getActiveSheet(0)->mergeCells("E".$row.":F".$row);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,$excelrow['REQ_BY']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,$excelrow['OFFICE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,$excelrow['ISSUE_PROBLEM']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,$excelrow['TYPE_REQ']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,$excelrow['ASSIST_BY']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$row,$excelrow['START_DATE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row,$start_time);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$row,$excelrow['COMPLETED_DATE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$row,$completed_time);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row,$rt);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$row,$excelrow['QUALITY']);
        $objPHPExcel->getActiveSheet(0)->mergeCells("E11"."".":Q11");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E11','Month of '.$excelrow['month'].' '.$year);


        $row++;
        $no++;
    }
}


                            
                            




$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location:_fmlReport.xlsx');

?>