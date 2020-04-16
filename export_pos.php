<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_pos.xlsx");

$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
);

$styleContent = array('font'  => array('size'  => 9, 'name'  => 'Cambria'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));


$id = $_GET['id'];
$supName = $_GET['supName'];
$supContact = $_GET['supContact'];
$supAddress = $_GET['supAddress'];
$rfq_no = $_GET['rfq_no'];
$purpose = $_GET['purpose'];
$totalABC = $_GET['totalABC'];
$pmo = $_GET['pmo'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('A13',$supName);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A14',$supContact);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A15',$supAddress);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D23',$rfq_no);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D24',number_format($totalABC),2);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D25',$purpose);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D29',$pmo);


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        header('location: export_pos.xlsx');

        ?>