<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_burs.xlsx");
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
$conn=mysqli_connect("localhost","root","","db_dilg_pmis");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM burs WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$office = $row['office'];
$po_no = $row['po_no'];
$supplier = $row['supplier'];
$address = $row['address'];
$purpose = $row['purpose'];
$amount = $row['amount'];

$sql2 = mysqli_query($conn, "SELECT pmo.pmo_contact_person,pmo.designation FROM pmo LEFT JOIN burs b on b.office = pmo.id WHERE b.id = '$id' ");
$row2 = mysqli_fetch_array($sql2);
$pmo_title = $row2['pmo_contact_person'];
$designation = $row2['designation'];
$chief = strtoupper($pmo_title);

$objPHPExcel->setActiveSheetIndex()->setCellValue('D8',$supplier);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D10',$address);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D17',$purpose);
$objPHPExcel->setActiveSheetIndex()->setCellValue('L17',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C35',$chief);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C37',$designation);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_burs.xlsx');

?>