<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_iar.xlsx");

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
$styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$Getid="";

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$Getid = $_GET['getiar'];

$sql = mysqli_query($conn, "SELECT * FROM iar WHERE id = '$Getid' ");

// echo "SELECT * FROM iar WHERE id = '$Getid'";
// exit();
$row = mysqli_fetch_array($sql);
$po_no = $row['po_no'];
$rfq_id = $row['rfq_id'];
$app_id = $row['app_id'];
$supplier = $row['supplier'];
$po_date = $row['po_date'];
$dept = $row['dept'];
$ccode = $row['ccode'];
$iar_no = $row['iar_no'];
$iar_date = $row['iar_date'];
$invoice_no = $row['invoice_no'];
$invoice_date = $row['invoice_date'];
$stock_no = $row['stock_no'];
$officer = $row['officer'];



$objPHPExcel->setActiveSheetIndex()->setCellValue('B8',$supplier);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B9',$po_no. ' / '.  $po_date);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B10',$dept);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B11',$ccode);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8',$iar_no);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E9',$iar_date);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E10',$invoice_no);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E11',$invoice_date);

$sql_items = mysqli_query($conn, "SELECT a.sn,a.procurement,b.description,b.unit_id,b.qty FROM rfq_items b LEFT JOIN app a on a.id = b.app_id WHERE b.rfq_id = '$rfq_id' ");

/* echo "SELECT sn,unit_id,qty,procurement,abc,description from rfq_items left join app on app.id = rfq_items.app_id where rfq_id = '$rfq_id'";
exit(); */

$piece = "piece";
$box = "box";
$ream = "ream";
$lot = "lot";
$unit = "unit";
$crtg = "crtg";
$pack = "pack";
$tube = "tube";
$roll = "roll";
$can = "can";
$bottle = "bottle";
$set = "set";
$jar = "jar";
$bundle = "bundle";
$pad = "pad";
$book = "book";
$pouch = "pouch";
$dozen = "dozen";
$pair = "pair";
$gallon = "gallon";
// if 2 different procurement title how to get ? 
$row = 14;
$row1 = 15;
$row2 = 18;
$row3 = 19;
$row4 = 23;
$row5 = 24;
$row6 = 26;
if (mysqli_num_rows($sql_items)>0) {

  while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['sn']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['procurement'] ."\n".$excelrow['description']);
    if ($excelrow['unit_id'] == 1) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$piece);
    }if ($excelrow['unit_id'] == 2) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$box);
    } if ($excelrow['unit_id'] == 3) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$ream);
    } if ($excelrow['unit_id'] == 4) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$lot);
    } if ($excelrow['unit_id'] == 5) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$unit);
    } if ($excelrow['unit_id'] == 6) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$crtg);
    } if ($excelrow['unit_id'] == 7) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$pack);
    } if ($excelrow['unit_id'] == 8) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$tube);
    } if ($excelrow['unit_id'] == 9) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$roll);
    } if ($excelrow['unit_id'] == 10) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$can);
    } if ($excelrow['unit_id'] == 11) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$bottle);
    } if ($excelrow['unit_id'] == 12) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$set);
    } if ($excelrow['unit_id'] == 13) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$jar);
    } if ($excelrow['unit_id'] == 14) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$bundle);
    } if ($excelrow['unit_id'] == 15) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$pad);
    } if ($excelrow['unit_id'] == 16) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$book);
    } if ($excelrow['unit_id'] == 17) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$pouch);
    } if ($excelrow['unit_id'] == 18) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$dozen);
    } if ($excelrow['unit_id'] == 19) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$pair);
    } if ($excelrow['unit_id'] == 20) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$gallon);
    } 

    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['qty']);
       // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['abc']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);

    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);

    $row++;
    $row1++;
    $row2++;
    $row3++;
    $row4++;
    $row5++;
    $row6++;
  }

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
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'');

  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);

  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
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
  $row1++;
  $row2++;
  $row3++;
  $row4++;
  $row5++;
  $row6++;
}
}

$selimg = mysqli_query($conn,"SELECT officer from iar where officer = '$officer'");
$imgrow = mysqli_fetch_array($selimg);
$iar = $imgrow['officer'];
if ($iar == 1) {
  $iofficer = 'Reschiel B. Veridiano';
}
if ($iar == 2) {
  $iofficer = 'Leticia A. Delgado';
}
if ($iar == 3) {
  $iofficer = 'Medel A. Saturno';
}
if ($iar == 4) {
  $iofficer = 'Rafael M. Saturno';
}
if ($iar == 5) {
  $iofficer = 'Camille T. Ronquillo';
}
if ($iar == 6) {
  $iofficer = 'Art Brian G. Rubio';
}
if ($iar == 7) {
  $iofficer = 'Hannah Grace P. Solis';
}
if ($iar == 8) {
  $iofficer = 'Eunice A. Sales';
}
$objPHPExcel->getActiveSheet()->getStyle('B'.$row.':B'.$row6)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('E'.$row.':E'.$row6)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':A'.$row6)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row6.':E'.$row6)->applyFromArray($stylebottom);
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('iar1.png');
$objDrawing->setCoordinates('A'.$row1);                      
//setOffsetX works properly
$objDrawing->setOffsetX(5); 
$objDrawing->setOffsetY(5);                
//set width, height
$objDrawing->setWidth(80); 
$objDrawing->setHeight(80);  
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('iar2.png');
$objDrawing->setCoordinates('D'.$row1);                      
//setOffsetX works properly
$objDrawing->setOffsetX(5); 
$objDrawing->setOffsetY(5);                
//set width, height
$objDrawing->setWidth(120); 
$objDrawing->setHeight(90);  
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$objPHPExcel->getActiveSheet()->getStyle('A'.$row4)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$row4.':B'.$row4);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row4)->applyFromArray($styleLabel);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row4,strtoupper($iofficer));

$objPHPExcel->getActiveSheet()->mergeCells('A'.$row5.':B'.$row5);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row5)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row5)->applyFromArray($styleLabel);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row5,'Inspection Officer/Inspection Committee');

$objPHPExcel->getActiveSheet()->getStyle('D'.$row4)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->mergeCells('D'.$row4.':E'.$row4);
$objPHPExcel->getActiveSheet()->getStyle('D'.$row4)->applyFromArray($styleLabel);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row4,'BEZALEEL O. SOLTURA');

$objPHPExcel->getActiveSheet()->mergeCells('D'.$row5.':E'.$row5);
$objPHPExcel->getActiveSheet()->getStyle('D'.$row5)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D'.$row5)->applyFromArray($styleLabel);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row5,'Supply and/or Property Custodian');
// $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
// $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
// $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_iar.xlsx');

?>