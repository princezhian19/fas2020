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

$Getid="";

$conn=mysqli_connect("localhost","root","","db_dilg_pmis");

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

$sql_items = mysqli_query($conn, "SELECT a.sn,a.procurement,b.description,b.unit_id,b.qty from app as a left join rfq_items as b on a.id = b.app_id where b.rfq_id = '$rfq_id'");
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
  }
}

$selimg = mysqli_query($conn,"SELECT officer from iar where officer = '$officer'");
$imgrow = mysqli_fetch_array($selimg);
$officerIncharge = $imgrow['officer'];

if ($officerIncharge == 1) {
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('iar1.png');
  $objDrawing->setCoordinates('A'.$row);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(241.5);
  $objDrawing->setHeight(251.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

}elseif($officerIncharge == 2){

  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('iar2.png');
  $objDrawing->setCoordinates('A'.$row);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5);
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(251.5); 
  $objDrawing->setHeight(261.5); 
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

}elseif($officerIncharge == 3){
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('iar3.png');
  $objDrawing->setCoordinates('A'.$row);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(241.5); 
  $objDrawing->setHeight(251.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

}elseif($officerIncharge == 4){
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('iar4.png');
  $objDrawing->setCoordinates('A'.$row);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(241.5); 
  $objDrawing->setHeight(251.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    
}
else{


  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('iar.png');
  $objDrawing->setCoordinates('A'.$row);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(241.5); 
  $objDrawing->setHeight(251.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_iar.xlsx');

?>