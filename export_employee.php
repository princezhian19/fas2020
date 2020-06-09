<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_employee.xlsx");
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
$office = $_GET['office'];
// $e_date = $_GET['e_date'];

if ($office == 0) {
$sql_items = mysqli_query($conn, "SELECT tblemployeeinfo.EMP_N,tblemployeeinfo.FIRST_M,tblemployeeinfo.MIDDLE_M,tblemployeeinfo.LAST_M,tblemployeeinfo.BIRTH_D,tblemployeeinfo.EMAIL,tblemployeeinfo.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployeeinfo LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployeeinfo.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployeeinfo.DESIGNATION ORDER BY tblemployeeinfo.LAST_M ASC");

}else{

$sql_items = mysqli_query($conn, "SELECT tblemployeeinfo.EMP_N,tblemployeeinfo.FIRST_M,tblemployeeinfo.MIDDLE_M,tblemployeeinfo.LAST_M,tblemployeeinfo.BIRTH_D,tblemployeeinfo.EMAIL,tblemployeeinfo.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployeeinfo LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployeeinfo.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployeeinfo.DESIGNATION WHERE DIVISION_C = '$office' ORDER BY tblemployeeinfo.LAST_M ASC");
}

// $mont = date('M',strtotime($e_date));
// $year = date('Y',strtotime($e_date));
$selectoffice = mysqli_query($conn,"SELECT DIVISION_M FROM tblpersonneldivision WHERE DIVISION_N = $office");
$rowO = mysqli_fetch_array($selectoffice);
if ($office == 0) {
  $DIVISION_M = 'All';
}else{
$DIVISION_M = $rowO['DIVISION_M'];
  
}
$objPHPExcel->setActiveSheetIndex()->setCellValue('D9',$DIVISION_M);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('D10',$mont);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('H10',$year);

$row = 12;

while($excelrow = mysqli_fetch_assoc($sql_items) ){

  $id = $excelrow["EMP_N"];
  $FIRST_M = $excelrow["FIRST_M"];  
  $MIDDLE_M = $excelrow["MIDDLE_M"];  
  $LAST_M = $excelrow["LAST_M"];
  $DIVISION_M = $excelrow["DIVISION_M"];
  $POSITION_M = $excelrow["POSITION_M"];
  $DESIGNATION_M = $excelrow["DESIGNATION_M"];
  $MOBILEPHONE = $excelrow["MOBILEPHONE"];
  $ALTER_EMAIL = $excelrow["ALTER_EMAIL"];
  $EMAIL = $excelrow["EMAIL"];
  $BIRTH_D = $excelrow["BIRTH_D"];
  $BIRTH = date('F d',strtotime($BIRTH_D));

  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$FIRST_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$MIDDLE_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$LAST_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$DIVISION_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$POSITION_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$DESIGNATION_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$MOBILEPHONE);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$EMAIL);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$MOBILEPHONE);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$ALTER_EMAIL);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$BIRTH);

  $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);
  $row++;
}


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_employee.xlsx');

?>