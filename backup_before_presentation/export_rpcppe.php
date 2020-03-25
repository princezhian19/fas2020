<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_rpcppe.xlsx");

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

$conn=mysqli_connect("localhost","root","","fascalab_2020");
$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];

// $sql = mysqli_query($conn, "SELECT * FROM pr WHERE id = '$id' ");
// $row = mysqli_fetch_array($sql);
// $pr_no = $row['pr_no'];
// $pmo = $row['pmo'];
// $purpose = $row['purpose'];
// $pr_date = $row['pr_date'];

// $objPHPExcel->setActiveSheetIndex()->setCellValue('B7',$pmo);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('C7',"PR No.: ".$pr_no);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('E7',"Date: ".$pr_date);

$date_filter = mysqli_query($conn,"SELECT * FROM rpcppe WHERE date_acquired BETWEEN '$date_from' AND '$date_to' ");

$row = 15;
$rowA = 16;
$rowAa = 17;
$rowB = 18;
$rowC = 19;
$rowCc = 20;
$rowD = 21;
$rowE = 22;
$rowEe = 23;
$rowF = 24;
$rowG = 25;
$rowGg = 26;
$rowGgg = 27;
$rowH = 28;
$rowI = 29;
$rowJ = 30;

while($excelrow = mysqli_fetch_assoc($date_filter) ){

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['article']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['description']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['property_number']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['unit']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['amount']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['property_card']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['physical_count']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$excelrow['shortage_Q']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$excelrow['shortage_V']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$excelrow['remarks']);

       // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['abc']);
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


  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;
  $rowF++;
  $rowG++;
  $rowH++;
  $rowI++;
  $rowJ++;
  $rowAa++;
  $rowCc++;
  $rowEe++;
  $rowGg++;
  $rowGgg++;
}

if (mysqli_num_rows($date_filter)<10) {

 $counter++;
 
 $z=5;
 for($i=0; $i<$z; $i++){
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,'');

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

  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;  
  $rowF++;
  $rowG++;
  $rowH++;
  $rowI++;
  $rowJ++;
  $rowAa++;
  $rowCc++;
  $rowEe++;
  $rowGg++;
  $rowGgg++;
}
$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowA)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowB)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowC)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowD)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowE)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowF)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowG)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowH)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowI)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowJ)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowAa)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowCc)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowEe)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowGg)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowGgg)->applyFromArray($styleLeft);



$objPHPExcel->getActiveSheet()->getStyle('L'.$rowA)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowB)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowC)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowD)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowE)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowF)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowG)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowH)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowI)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowJ)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowAa)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowCc)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowEe)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowGg)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowGgg)->applyFromArray($styleRight);



$objPHPExcel->getActiveSheet()->getStyle('C'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('G'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('J'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('K'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowJ)->applyFromArray($stylebottom);


$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowA,"Certified Correct by:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowB,"BEZALEEL O. SOLTURA");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowC,"Inventory Committee Chair");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowD,"RESTITUTO B. NAÑEZ III");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowE,"Member (Accounting Representative)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowF,"DANILO T. TOMACLAS ");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowG,"Member (Supply Representative)");

$objPHPExcel->getActiveSheet()->getStyle('D'.$rowH)->applyFromArray($styleTop);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowH,"Member (Prov'l Office Representative)");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowI,"Signature over Printed Name of Inventory");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowJ,"Committee Chair and Members");

$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$rowA,"Approved by:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$rowB,"DARRELL I. DIZON, CESO V");
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$rowC,"Provincial Director");


$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$rowA,"Verified by:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$rowB,"JAIME B. ROXAS");
$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$rowC,"State Auditor IV \nAudit Team Leader");

$objPHPExcel->getActiveSheet()->getStyle('E'.$rowD.':I'.$rowE)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->mergeCells('E'.$rowD.':I'.$rowE);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowD)->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowD,"Signature over Printed Name of Head of Agency/Entity or Authorized Representative");
$objPHPExcel->getActiveSheet()->getStyle('L'.$rowD)->applyFromArray($styleTop);
$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$rowD,"Signature over Printed Name of COA Representative");



// $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$State Auditor IV);
// // $objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':F'.$rowA);

// $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
// $objPHPExcel->getActiveSheet()->getStyle('A'.$rowA.':F'.$rowA)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowA)->applyFromArray($styleRight);

// $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowB,"Requested by:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowB,"Approved by:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowC,"Signature:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowD,"Printed Name:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowD,strtoupper($pmo_contact_person));
// $objPHPExcel->getActiveSheet()->getStyle('B'.$rowD)->applyFromArray($styleHeader);
// // $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowC.':C'.$rowC);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowD,"ELIAS F. FERNANDEZ, JR.");
// $objPHPExcel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($styleHeader);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowE,"Designation:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowE,$designation);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowE,"OIC-Regional Director");

// $objPHPExcel->getActiveSheet()->getStyle('A'.$rowE)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('B'.$rowE)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('C'.$rowE)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('D'.$rowE)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('E'.$rowE)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowE)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowB)->applyFromArray($styleRight);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowC)->applyFromArray($styleRight);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowD)->applyFromArray($styleRight);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowE)->applyFromArray($styleRight);

}
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowA,$excelrow['purpose']);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_rpcppe.xlsx');

?>