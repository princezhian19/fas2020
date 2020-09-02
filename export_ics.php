<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_ics.xlsx");
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

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

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

 $styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM rpci WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$article = $row['article'];
$description = $row['description'];
$inventory_item_no = $row['inventory_item_no'];
$unit = $row['unit'];
$amount = $row['amount'];
$opc = $row['opc'];
$yrs = $row['yrs'];
$received_by = $row['received_by'];
$position = $row['position'];
$ics_no = $row['ics_no'];
  $date_from = $_POST['date_from'];
  $d1 = date('Y-m-d', strtotime($date_from));
  $date_to = $_POST['date_to'];
  $d2 = date('Y-m-d', strtotime($date_to));
  
$objPHPExcel->setActiveSheetIndex()->setCellValue('G6','ICS No : '.$ics_no);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A11',$opc);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B11',$unit);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C11',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D11',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E11',$article);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E12',$description);
$objPHPExcel->setActiveSheetIndex()->setCellValue('G11',$inventory_item_no);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H11',$yrs.' Years');
$objPHPExcel->setActiveSheetIndex()->setCellValue('F32',$received_by);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F35',$position);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A38',$d1);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F38',$d2);





$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_ics.xlsx');

?>