<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/StockCard.xlsx");

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

$conn=mysqli_connect("localhost","root","","fascalab_2020");



/* $date = date("F, Y", time());
$objPHPExcel->setActiveSheetIndex()->setCellValue('D3',$date); */
if (isset($_POST['submit'])) 
{

  $sn = $_POST['getsn'];
  
  

$sql_items = mysqli_query($conn, "SELECT * FROM old_stock where sn = '$sn' order by id asc");

$sql_items1 = mysqli_query($conn, "SELECT * FROM old_stock where sn = '$sn' order by id desc");

$row = mysqli_fetch_array($sql_items1);


$objPHPExcel->setActiveSheetIndex()->setCellValue('C8',$row['items']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C10',$row['unit']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('G8',$row['sn']);



}
$row=13;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

   
    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['balancetwo']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['avail_balance']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['issue_month']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['two']);
    

    $row++;
  }

}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: stockcardexport.xlsx');

?>