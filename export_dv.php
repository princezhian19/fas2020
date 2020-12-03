<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_dv.xlsx");
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
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM dv WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$office = $row['office'];
$po_no = $row['po_no'];
$supplier = $row['supplier'];
$address = $row['address'];
$purpose = $row['purpose'];
$amount = $row['amount'];

$sql2 = mysqli_query($conn, "SELECT pmo.pmo_contact_person,pmo.designation FROM pmo LEFT JOIN dv on dv.office = pmo.id WHERE dv.id = '$id' ");
// ECHO "SELECT pmo.pmo_contact_person,pmo.designation FROM pmo LEFT JOIN dv on dv.office = pmo.id WHERE dv.id = '$id' ";
// exit();
$row2 = mysqli_fetch_array($sql2);
$pmo_title = $row2['pmo_contact_person'];
$designation = $row2['designation'];
$chief = strtoupper($pmo_title);

$objPHPExcel->setActiveSheetIndex()->setCellValue('E10',$supplier);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E12',$address);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E51','AGNES S. SANGEL');
$objPHPExcel->setActiveSheetIndex()->setCellValue('E53','OIC-Regional Accountant');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B16',$purpose);
$objPHPExcel->setActiveSheetIndex()->setCellValue('AB15',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B33',$chief);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B34',$designation);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_dv.xlsx');

?>