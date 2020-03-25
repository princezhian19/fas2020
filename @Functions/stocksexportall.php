<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/STOCKS.xlsx");

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

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$date = date("F, Y", time());
$objPHPExcel->setActiveSheetIndex()->setCellValue('D3',$date);



$sql_items = mysqli_query($conn, "SELECT * FROM old_stock order by id asc");


$row=6;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['sn']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['items']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['unit']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['balanceone']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['delivery']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['avail_balance']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['issue_month']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['balancetwo']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['current_price']);
    
    


    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);


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
header('location: stocksexportall.xlsx');

?>