<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_pr.xlsx");

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

$sql = mysqli_query($conn, "SELECT * FROM pr WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$pr_no = $row['pr_no'];
$pmo = $row['pmo'];
$purpose = $row['purpose'];
$pr_date = $row['pr_date'];

$d1 = date('F d, Y', strtotime($pr_date));
$objPHPExcel->setActiveSheetIndex()->setCellValue('B7',$pmo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C7','PR No.:  '.$pr_no);
if($pr_date == '0000-00-00'){
$objPHPExcel->setActiveSheetIndex()->setCellValue('F7',"");  

}
else{
  

$objPHPExcel->setActiveSheetIndex()->setCellValue('F7',$d1);  
}

$totalcount = mysqli_query($conn, "SELECT sum(pr.qty) as first ,sum(pr.abc) as second FROM pr_items pr left join app a on a.id = pr.items WHERE pr.pr_no = '$pr_no' "); 

<<<<<<< HEAD



=======
>>>>>>> 292bab72c218de7b426f9977399769eba65c63e3
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

if ($unit == "22") {
  $unit = "cart";
}
    $total = $excelrow['qty']*$excelrow['abc'];
    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['sn']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$unit);

    $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['procurement'] ."\n".$excelrow['description']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['qty']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['abc']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$total);
<<<<<<< HEAD



       

=======
>>>>>>> 292bab72c218de7b426f9977399769eba65c63e3
    $objPHPExcel->getActiveSheet()->getProtection()->setPassword('fas2020');


    // $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
    // $objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
    // $objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
    // $objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
    
    $row++;
    $rowA++;
    $rowB++;
    $rowC++;
    $rowD++;
    $rowE++;
  }

  $select_purpsoe = mysqli_query($conn,"SELECT pr.purpose,pr.pmo,pmo.pmo_contact_person,pmo.designation FROM pr left join pmo on pmo.pmo_title = pr.pmo WHERE pr.id = $id ");
$rowP = mysqli_fetch_array($select_purpsoe);
$pmo_contact_person = $rowP['pmo_contact_person'];
$pmo_contact_person;
$designation = $rowP['designation'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('B37',$purpose);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B43',strtoupper($pmo_contact_person));
$objPHPExcel->setActiveSheetIndex()->setCellValue('B44',$designation);

<<<<<<< HEAD




=======
>>>>>>> 292bab72c218de7b426f9977399769eba65c63e3
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_pr.xlsx');

?>