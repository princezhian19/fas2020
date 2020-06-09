<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_calendar.xlsx");

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
$office = $_GET['office_id'];

$sql_q10 = mysqli_query($conn, "SELECT e.title,e.start,e.end,e.posteddate,DIVISION_M, e.venue,e.enp,e.remarks,te.UNAME FROM events e 
LEFT JOIN tblemployeinfo te on te.EMP_N = e.postedby
LEFT JOIN tblpersonneldivision on e.office = tblpersonneldivision.DIVISION_N
WHERE office IN(".$office.") and e.cancelflag = 0 and MONTH(start) = '".$_GET['month']."' and YEAR(start) = '".$_GET['year']."'");
    if (mysqli_num_rows($sql_q10)>0) {
    $row = 8;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {

        $start1 = $excelrow['start'];
        $start = str_replace("00:00:00","",$start1);
        if($excelrow['end'] == '' || $excelrow['end'] == null || $excelrow['end'] == '0000-00-00 00:00:00')
        {
          $realenddate = '';
        }else{
          $end1 = $excelrow['end'];
          $end = str_replace("00:00:00","",$end1);
          $realenddate = date("F d, Y",strtotime($end));
        }
       
        
        if(strlen($excelrow['title']) > 20)
        {
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(100);

        }else{
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(50);

        }

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getAlignment()->setWrapText(true);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A4',date("F",strtotime($_GET['year']."-".$_GET['month']."-01"))." ".$_GET['year']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['title']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,date("F d, Y",strtotime($start)));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$realenddate);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['DIVISION_M']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['venue']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['enp']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['remarks']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['UNAME']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,date("F d, Y",strtotime($excelrow['posteddate'])));
    
        
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    
        $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);

        
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);

        $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight);
          $row++;
    }
  }





  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: export_calendar.xlsx');

?>