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
$e_date = $_GET['e_date'];

if ($office == 0) {
$sql_items = mysqli_query($conn, "SELECT tblemployee.EMP_N,tblemployee.FIRST_M,tblemployee.MIDDLE_M,tblemployee.LAST_M,tblemployee.BIRTH_D,tblemployee.EMAIL,tblemployee.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployee LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployee.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployee.DESIGNATION WHERE DATE_CREATED LIKE '%$e_date%' ");

}else{

$sql_items = mysqli_query($conn, "SELECT tblemployee.EMP_N,tblemployee.FIRST_M,tblemployee.MIDDLE_M,tblemployee.LAST_M,tblemployee.BIRTH_D,tblemployee.EMAIL,tblemployee.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployee LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployee.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployee.DESIGNATION WHERE DIVISION_C = '$office' AND DATE_CREATED LIKE '%$e_date%' ");
}

$mont = date('M',strtotime($e_date));
$year = date('Y',strtotime($e_date));
$objPHPExcel->setActiveSheetIndex()->setCellValue('D9',$office);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D10',$mont);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H10',$year);

$row = 13;

while($excelrow = mysqli_fetch_assoc($sql_items) ){

  $id = $excelrow["EMP_N"];
  $FIRST_M = $excelrow["FIRST_M"];  
  $MIDDLE_M = $excelrow["MIDDLE_M"];  
  $LAST_M = $excelrow["LAST_M"];
  $DIVISION_M = $excelrow["DIVISION_M"];
  $POSITION_M = $excelrow["POSITION_M"];
  $DESIGNATION_M = $excelrow["DESIGNATION_M"];
  $MOBILEPHONE = $excelrow["MOBILEPHONE"];
  $EMAIL = $excelrow["EMAIL"];
  $BIRTH_D = $excelrow["BIRTH_D"];
  $BIRTH = date('F d',strtotime($BIRTH_D));

  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$LAST_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$FIRST_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$MIDDLE_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$DIVISION_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$POSITION_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$DESIGNATION_M);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$MOBILEPHONE);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$EMAIL);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$MOBILEPHONE);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$BIRTH);

  $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);
  $row++;
}


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_employee.xlsx');

?>