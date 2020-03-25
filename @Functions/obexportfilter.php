<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/ORS_Fund_Monitoring_export.xlsx");

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



$date = date("F, Y", time());

$objPHPExcel->setActiveSheetIndex()->setCellValue('F11',$date);
if (isset($_POST['submit'])) 
{

  $saronumber = $_POST['saronumber'];
  
  $uacs = $_POST['uacs'];

$sql_items = mysqli_query($conn, "SELECT * FROM  saroob where saronumber = '$saronumber' and uacs = '$uacs' order by datereprocessed asc");
}
//$id = $row["id"];  
// $datereceived = $row["datereceived"];
// $datereprocessed = $row["dateprocessed"];
// $datereturned = $row["datereturned"];
// $datereleased = $row["datereleased"];
// $ors = $row["ors"];
// $ponum = $row["ponum"];
// $payee = $row["payee"];
// $particular = $row["particular"];
// $saronumber = $row["saronumber"];
// $ppa = $row["ppa"];
// $uacs = $row["uacs"];
// $amount = $row["amount"];
// $date = $row["date"];
// $remarks = $row["remarks"];
$row=16;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['datereceived']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['datereprocessed']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['datereturned']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['datereleased']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['ors']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['payee']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['particular']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['saronumber']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$excelrow['ppa']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$excelrow['uacs']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$excelrow['amount']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,$excelrow['remarks']);
    
    
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
    

    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight);
    

    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleRight);
    

    $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleRight);
    

    $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleRight);

        
    
    $row++;
  }

}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: obexportfilter.xlsx');

?>