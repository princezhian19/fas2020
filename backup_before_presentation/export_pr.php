<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_pr.xls");

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
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM pr WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$pr_no = $row['pr_no'];
$pmo = $row['pmo'];
$purpose = $row['purpose'];
$pr_date = $row['pr_date'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('B7','FAD');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C7','PR No.:  '.$pr_no);
if($pr_date == '0000-00-00'){
$objPHPExcel->setActiveSheetIndex()->setCellValue('F7',"");  

}
else{
$objPHPExcel->setActiveSheetIndex()->setCellValue('F7',$pr_date);  
}

$totalcount = mysqli_query($conn, "SELECT sum(pr.qty) as first ,sum(pr.abc) as second FROM pr_items pr left join app a on a.id = pr.items WHERE pr.pr_no = '$pr_no' "); 


  
  //   $ans = $excelrow1['first']*$excelrow1['second'];
  //   echo $ans;
  //   exit();
  // while($excelrow1 = mysqli_fetch_assoc($totalcount) ){
  // }

$sql_items = mysqli_query($conn, "SELECT a.sn,a.id,a.procurement,pr.description,pr.unit,pr.qty,pr.abc FROM pr_items pr left join app a on a.id = pr.items WHERE pr.pr_no = '$pr_no' ");

 
$row = 11;
$rowA = 12;
$rowB = 13;
$rowC = 14;
$rowD = 15;
$rowE = 16;




  while($excelrow = mysqli_fetch_assoc($sql_items) ){

$unit = $excelrow['unit'];


if ($unit == "1") {
  $unit = "piece";
}

if ($unit == "2") {
  $unit = "box";
}

if ($unit == "3") {
  $unit = "ream";
}

if ($unit == "4") {
  $unit = "lot";
}

if ($unit == "5") {
  $unit = "unit";
}

if ($unit == "6") {
  $unit = "crtg";
}

if ($unit == "7") {
  $unit = "pack";
}
if ($unit == "8") {
  $unit = "tube";
}

if ($unit == "9") {
  $unit= "roll";
}

if ($unit == "10") {
  $unit = "can";
}

if ($unit == "11") {
  $unit = "bottle";
}

if ($unit == "12") {
  $unit = "set";
}

if ($unit == "13") {
  $unit = "jar";
}

if ($unit == "14") {
  $unit = "bundle";
}

if ($unit == "15") {
  $unit = "pad";
}

if ($unit == "16") {
  $unit = "book";
}

if ($unit == "17") {
  $unit = "pouch";
}

if ($unit == "18") {
  $unit = "dozen";
}

if ($unit== "19") {
  $unit = "pair";
}

if ($unit == "20") {
  $unit = "gallon";
}

if ($unit == "21") {
  $unit = "cart";
}


    $total = $excelrow['qty']*$excelrow['abc'];
    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['sn']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$unit);


    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['procurement'] ."\n".$excelrow['description']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['qty']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['abc']);
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,number_format($total,2));
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$total);



       // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['abc']);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);

    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);


    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);
    // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
    // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
    $row++;
    $rowA++;
    $rowB++;
    $rowC++;
    $rowD++;
    $rowE++;
  }

if (mysqli_num_rows($sql_items)<10) {

 $counter++;
 
//  $z=15;
//  for($i=0; $i<$z; $i++){
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'');

//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
//     // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
//     // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);

//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);



//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);



//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
//   $row++;
//   $rowA++;
//   $rowB++;
//   $rowC++;
//   $rowD++;
//   $rowE++;

//   if($i==15){

//       $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,'test');


//   }

// }

$select_purpsoe = mysqli_query($conn,"SELECT pr.purpose,pr.pmo,pmo.pmo_contact_person,pmo.designation FROM pr left join pmo on pmo.pmo_title = pr.pmo WHERE pr.id = '$id' ");
$rowP = mysqli_fetch_array($select_purpsoe);
$purpose = $rowP['purpose'];
$pmo_contact_person = $rowP['pmo_contact_person'];
$designation = $rowP['designation'];



$objPHPExcel->setActiveSheetIndex()->setCellValue('B43',$purpose);




// // $objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':F'.$rowA);






// $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
// $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setWrapText(true); 

// $objPHPExcel->getActiveSheet()->getStyle('A'.$rowA.':F'.$rowA)->applyFromArray($stylebottom);
// $objPHPExcel->getActiveSheet()->getStyle('F'.$rowA)->applyFromArray($styleRight);




// $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowB,"Requested by:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowB,"Approved by:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowC,"Signature:");
// $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowD,"Printed Name:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('B49',strtoupper($pmo_contact_person));
// $objPHPExcel->getActiveSheet()->getStyle('B'.$rowD)->applyFromArray($styleHeader);
// // $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowC.':C'.$rowC);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowD,"ELIAS F. FERNANDEZ, JR.");
// $objPHPExcel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($styleHeader);
// $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowE,"Designation:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('B50',$designation);
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

//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowB)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowB)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowB)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowB)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowC)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowC)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowC)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowC)->applyFromArray($styleRight);
  

  

//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowE)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowE)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowE)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$rowE)->applyFromArray($styleRight);
  

  


}
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowA,$excelrow['purpose']);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_pr.xlsx');

?>