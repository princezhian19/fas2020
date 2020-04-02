<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/_fmlReport.xlsx");

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
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);




$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$month = $_GET['month'];
$year = $_GET['year'];

$sql_q10 = mysqli_query($conn, "SELECT MONTHNAME(`REQ_DATE`) AS 'month', YEAR(`REQ_DATE`) AS 'year', `ID`, `CONTROL_NO`, `REQ_DATE`, `REQ_TIME`, `REQ_BY`, `OFFICE`, `POSITION`, `CONTACT_NO`, `EMAIL_ADD`, `EQUIPMENT_TYPE`, `BRAND_MODEL`, `PROPERTY_NO`, `SERIAL_NO`, `IP_ADDRESS`, `MAC_ADDRESS`, `TYPE_REQ`, `TYPE_REQ_DESC`, `ISSUE_PROBLEM`, `START_DATE`, `START_TIME`, `STATUS_DESC`, `COMPLETED_DATE`, `COMPLETED_TIME`, `ASSIST_BY`, `PERSON_ASSISTED`, `TIMELINESS`, `QUALITY`, `STATUS` FROM `tbltechnical_assistance` WHERE MONTH(REQ_DATE) = $month and YEAR(REQ_DATE) = $year ");
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

      $startTime = date('Y-m-d',strtotime($excelrow['START_DATE']));
      $endTime = date('Y-m-d',strtotime($excelrow['COMPLETED_DATE']));
      


      $date1 = strtotime($startTime."".$excelrow['START_TIME']);  
      $date2 = strtotime($endTime."".$excelrow['COMPLETED_TIME']);  
    
      // Formulate the Difference between two dates 
      $diff = abs($date2 - $date1);  
    
    
      // To get the year divide the resultant date into 
      // total seconds in a year (365*60*60*24) 
      $years = floor($diff / (365*60*60*24));  
        
        
      // To get the month, subtract it with years and 
      // divide the resultant date into 
      // total seconds in a month (30*60*60*24) 
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
        
        
      // To get the day, subtract it with years and  
      // months and divide the resultant date into 
      // total seconds in a days (60*60*24) 
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
        
        
      // To get the hour, subtract it with years,  
      // months & seconds and divide the resultant 
      // date into total seconds in a hours (60*60) 
      $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
        
      // To get the minutes, subtract it with years, 
      // months, seconds and hours and divide the  
      // resultant date into total seconds i.e. 60 
      $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);  
        
        
      // To get the minutes, subtract it with years, 
      // months, seconds, hours and minutes  
      $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));  
        
      // Print the result 
      $calc_mins = sprintf("%d hours and %d minutes",$hours, $minutes);
      // echo $excelrow['START_TIME'];

      
    
    

      
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
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row,$calc_mins);
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$row,$excelrow['QUALITY']);
          $objPHPExcel->getActiveSheet(0)->mergeCells("E11"."".":Q11");
          $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E11','Month of '.$excelrow['month'].' '.$year);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':Q'.$row)->applyFromArray($styleArray);



          $row++;
          $no++;
    }
  }




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: _fmlReport.xlsx');

?>