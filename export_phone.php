<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_phone.xlsx");
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
// $office = $_GET['office'];
// $e_date = $_GET['e_date'];

// $mont = date('M',strtotime($e_date));
// $year = date('Y',strtotime($e_date));
// $objPHPExcel->setActiveSheetIndex()->setCellValue('B7',$office);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('B8',$mont);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('E8',$year);

// if ($office == 'All') {
//   $sql_items = mysqli_query($conn,"SELECT *  FROM `phone_directory` WHERE `posted_date` LIKE '%$e_date%'");
// }else{
//   $sql_items = mysqli_query($conn,"SELECT *  FROM `phone_directory` WHERE `group` = '$office' AND `posted_date` LIKE '%$e_date%'");
  
// }
  $sql_items = mysqli_query($conn,"SELECT *  FROM `phone_directory`");

$row = 11;

while($excelrow = mysqli_fetch_assoc($sql_items) ){

  $group = $excelrow["group"];  
  $agency = $excelrow["agency"];
  $head_director = $excelrow["head_director"];
  $contact_no = $excelrow["contact_no"];
  $email = $excelrow["email"];
  $address = $excelrow["address"];

  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$group);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$agency);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$head_director);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$contact_no);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$email);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$address);

  $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);
  $row++;
}


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_phone.xlsx');

?>