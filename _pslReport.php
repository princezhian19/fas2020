<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/_pslReport.xlsx");

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
$fontStyle = [
  'font' => [
      'size' => 8
  ]
];



$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$month = $_GET['month'];
$year = $_GET['year'];

$sql_q10 = mysqli_query($conn, "SELECT  MONTHNAME(`REQ_DATE`) AS 'month',`REQ_DATE`, COUNT(`REQ_DATE`) as 'count' FROM `tbltechnical_assistance` WHERE MONTH(`REQ_DATE`) = $month and YEAR(`REQ_DATE`) = $year GROUP BY `REQ_DATE` ORDER BY `REQ_DATE`");
if (mysqli_num_rows($sql_q10)>0) 
{
    $row = 18;
    $no = 1;
    $count = (mysqli_num_rows($sql_q10));
   $total = ($row + $count)+1;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {
      
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$excelrow['REQ_DATE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$excelrow['count']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,$excelrow['count']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,$excelrow['count']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,$excelrow['count']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E13','Month of '.$excelrow['month'].' '.$year);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,$excelrow['count']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$row,$excelrow['count']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,'100%');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row,'100%');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$total,'Total');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$total,'1');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$total,'100%');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$total,'100%');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$total,'1');

        $objPHPExcel->getActiveSheet(0) ->setCellValue('B'.$total,'=SUM(B18:B'.($row).')' );
        $objPHPExcel->getActiveSheet(0) ->setCellValue('E'.$total,'=SUM(E18:E'.($row).')' );
        $objPHPExcel->getActiveSheet(0) ->setCellValue('G'.$total,'=SUM(G18:G'.($row).')' );
        $objPHPExcel->getActiveSheet(0) ->setCellValue('H'.$total,'=SUM(H18:H'.($row).')' );

        $objPHPExcel->getActiveSheet()->getStyle('A'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('B'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('E'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('G'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('H'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('I'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('J'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('M'.$total)->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('N'.$total)->getFont()->setBold( true );
        
        $objPHPExcel->getActiveSheet()
        ->getStyle("A".$total.":Q".$total)
        ->applyFromArray($fontStyle);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':Q'.$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$total.':Q'.$total)->applyFromArray($styleArray);
        
      
   
    

      $row++;
    }
}




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: _pslReport.xlsx');

?>