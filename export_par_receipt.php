<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_par_receipt.xlsx");

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

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 12),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

 $styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$conn=mysqli_connect("localhost","root","","fascalab_2020");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT par_assign WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$name = $row['name'];
$position = $row['position'];
$office = $row['office'];
$par_date = $row['par_date'];

$sql_items1 = mysqli_query($conn, "SELECT * FROM rpcppe WHERE id = '$id' ");
$row1 = mysqli_fetch_array($sql_items1);
$par = $row1['property_number'];


$objPHPExcel->setActiveSheetIndex()->setCellValue('F8',$par);
$sql_items = mysqli_query($conn, "SELECT * FROM rpcppe WHERE id = '$id' ");

$row = 11;
$rowA = 12;
$rowB = 13;
$rowC = 14;
$rowD = 15;
$rowE = 16;
$rowF = 17;
$rowG = 18;



  while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['physical_count']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['unit']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['description']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['property_number']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['date_acquired']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['amount']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['procurement'] ."\n".$excelrow['description']);

       // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['abc']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);

    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);


    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
    $row++;
    $rowA++;
    $rowB++;
    $rowC++;
    $rowD++;
    $rowE++;
    $rowF++;
    $rowG++;
  }

if (mysqli_num_rows($sql_items)<10) {

 $counter++;
 
 $z=15;
 for($i=0; $i<$z; $i++){
  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,'');

  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);

  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);



  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);



  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;
  $rowF++;
  $rowG++;
}

$select_purpsoe = mysqli_query($conn,"SELECT * FROM par_assign WHERE id = '$id' ");
$rowP = mysqli_fetch_array($select_purpsoe);
$name = $rowP['name'];
$position = $rowP['position'];
$office = $rowP['office'];

$objPHPExcel->getActiveSheet()->getStyle('A'.$rowA)->applyFromArray($styleHeader);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowA,"Received by: ");
$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowA.':B'.$rowA);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowC,$name);
$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowA)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowB)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowC)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowD)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowE)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowF)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->getStyle('D'.$rowA)->applyFromArray($styleHeader);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowA,"Issued by: ");



$objPHPExcel->getActiveSheet()->getRowDimension($rowB)->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension($rowC)->setRowHeight(33);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowC.':C'.$rowC);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowC,"Signatue over Printed Name of End User ");
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowC)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowC.':F'.$rowC);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowC," Signatue over Printed Name of Supply and/or Property Custodian");

$objPHPExcel->getActiveSheet()->getStyle('A'.$rowE)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowE)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowE.':C'.$rowE);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowE,"Position/Office ");
$objPHPExcel->getActiveSheet()->getRowDimension($rowE)->setRowHeight(19);


$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowE.':F'.$rowE);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowE,"Position/Office ");


$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowG.':C'.$rowG);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowG)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowG)->applyFromArray($styleRight);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowG,"Date ");
$objPHPExcel->getActiveSheet()->getRowDimension($rowG)->setRowHeight(19);


$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowG.':F'.$rowG);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowG,"Date ");


$objPHPExcel->getActiveSheet()->getStyle('A'.$rowG.':F'.$rowG)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowA)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowB)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowC)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowD)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowE)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowF)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowG)->applyFromArray($styleRight);





}
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowA,$excelrow['purpose']);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_par_receipt.xlsx');

?>