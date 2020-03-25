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
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM burs WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$office = $row['office'];
$po_no = $row['po_no'];
$supplier = $row['supplier'];
$address = $row['address'];
$purpose = $row['purpose'];
$amount = $row['amount'];

if ($po_no == '') {
  $sql2 = mysqli_query($conn, "SELECT pmo.pmo_contact_person,pmo.designation FROM pmo LEFT JOIN burs b on b.office = pmo.id WHERE b.id = '$id' ");
}else{
  
  $selectpo = mysqli_query($conn,"SELECT id FROM po WHERE po_no = '$po_no'");
  $rowid = mysqli_fetch_array($selectpo);
  $poid = $rowid['id'];

  $selected = mysqli_query($conn,"SELECT rfq_id FROM selected_quote WHERE po_id = $poid");
  $rowselected = mysqli_fetch_array($selected);
  $rfqpoid = $rowselected['rfq_id'];

  $selectprfromrfq = mysqli_query($conn,"SELECT pr_no FROM rfq WHERE id = $rfqpoid");
  $rowpr = mysqli_fetch_array($selectprfromrfq);
  $pr_no = $rowpr['pr_no'];

  $selecpmopr = mysqli_query($conn,"SELECT pmo FROM pr WHERE pr_no = '$pr_no' ");
  $rowpmo = mysqli_fetch_array($selecpmopr);
  $prpmo = $rowpmo['pmo'];

  if ($prpmo == 'FAD') {
    $prpmo = 5;
  }
  if ($prpmo == 'ORD') {
    $prpmo = 1;
  }
  if ($prpmo == 'LGMED') {
    $prpmo = 3;
  }
  if ($prpmo == 'LGCDD') {
    $prpmo = 4;
  }
  if ($prpmo == 'LGMED-PDMU') {
    $prpmo = 6;
  }
  if ($prpmo == 'LGCDD-MBRTG') {
    $prpmo = 7;
  }

  $sql2 = mysqli_query($conn, "SELECT pmo_contact_person,designation FROM pmo WHERE id = $prpmo ");

}
$row2 = mysqli_fetch_array($sql2);
$pmo_title = $row2['pmo_contact_person'];
$designation = $row2['designation'];
$chief = strtoupper($pmo_title);


$objPHPExcel->setActiveSheetIndex()->setCellValue('E40','BURS/JEV/RCI/        RADAI/RTRAI No.S');
$objPHPExcel->setActiveSheetIndex()->setCellValue('A3','BUDGET UTILIZATION REQUEST AND STATUS');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D6',$supplier);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D10',$address);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D16',$purpose);
$objPHPExcel->setActiveSheetIndex()->setCellValue('L16',$amount);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C31',$chief);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C34',$designation);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_burs.xlsx');

?>