<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/STOCKS.xlsx");

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


if (isset($_POST['submit'])) 
{

  $datefrom = $_POST['datefrom'];
  
  $dateto = $_POST['dateto'];
  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));


$date = date("F, Y", time());
$objPHPExcel->setActiveSheetIndex()->setCellValue('D3',$d2);

$objPHPExcel->setActiveSheetIndex()->setCellValue('H5',$d2);



$sql_items = mysqli_query($conn, "SELECT * FROM old_stock where balancetwo like '%$d2%' order by id asc");

}
$row=6;
$row1=7;
$row2=9;
$row3=10;
$row4=12;
$row5=14;
$row6=15;

if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $objPHPExcel->setActiveSheetIndex()->setCellValue('D5',$excelrow['balanceone']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['sn']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['items']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['unit']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['one']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['delivery']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['avail_balance']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['issue_month']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['two']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['current_price']);
    
    
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);

    
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);
    

    $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight);
    


    $row++;
    $row1++;
    $row2++;
    $row3++;
    $row4++;
    $row5++;
    $row6++;
  }
  
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row1,'Prepared by:');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row2,'BEZALEEL O. SOLTURA');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row3,'Chief GSS & Supply Section');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row4,'Noted by:');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row5,'DR. CARINA S. CRUZ');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row6,'Chief-FAD');




}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: stocksdateexport.xlsx');

?>