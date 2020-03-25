<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_pc.xlsx");

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

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT ph.name,ppe.amount,ppe.remarks,ph.position,ph.office,ph.par_date,ppe.property_number FROM par_history ph LEFT JOIN rpcppe ppe on ppe.id = ph.ppe_id WHERE ph.ppe_id = '$id' ");
$row = mysqli_fetch_array($sql);
$name = $row['name'];
$position = $row['position'];
$office = $row['office'];
$par_date = $row['par_date'];
$property_number = $row['property_number'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('I9',$property_number);

$sql_items = mysqli_query($conn, "SELECT ph.name,ppe.amount,ppe.remarks,ph.position,ph.office,ph.par_date,ppe.property_number FROM par_history ph LEFT JOIN rpcppe ppe on ppe.id = ph.ppe_id WHERE ph.ppe_id = '$id' ");

$row = 13;
$rowA = 14;
$rowB = 15;
$rowC = 16;
$rowD = 17;
$rowE = 18;



while($excelrow = mysqli_fetch_assoc($sql_items) ){

  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['par_date']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['property_number']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,"1");
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,"1");
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['office'] ."\n".$excelrow['name']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['physical_count']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,"1");
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['amount']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['remarks']);

       // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['abc']);
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

  $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;
}

if (mysqli_num_rows($sql_items)<10) {

 $counter++;
 
 $z=15;
 for($i=0; $i<$z; $i++){
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,'');

  

  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
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

  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);

  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);

  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($stylebottom);

  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);

  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;
}


}


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_pc.xlsx');

?>