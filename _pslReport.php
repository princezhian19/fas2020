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



$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$month = $_GET['month'];
$year = $_GET['year'];

$sql_q10 = mysqli_query($conn, "SELECT MONTHNAME(`REQ_DATE`) AS 'month', YEAR(`REQ_DATE`) AS 'year', `ID`, `CONTROL_NO`, `REQ_DATE`, `REQ_TIME`, `REQ_BY`, `OFFICE`, `POSITION`, `CONTACT_NO`, `EMAIL_ADD`, `EQUIPMENT_TYPE`, `BRAND_MODEL`, `PROPERTY_NO`, `SERIAL_NO`, `IP_ADDRESS`, `MAC_ADDRESS`, `TYPE_REQ`, `TYPE_REQ_DESC`, `ISSUE_PROBLEM`, `START_DATE`, `START_TIME`, `STATUS_DESC`, `COMPLETED_DATE`, `COMPLETED_TIME`, `ASSIST_BY`, `PERSON_ASSISTED`, `TIMELINESS`, `QUALITY`, `STATUS` FROM `tbltechnical_assistance` WHERE MONTH(REQ_DATE) = $month and YEAR(REQ_DATE) = $year ");
    if (mysqli_num_rows($sql_q10)>0) {
  
   
  }




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: _pslReport.xlsx');

?>