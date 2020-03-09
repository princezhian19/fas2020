<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_ris.xlsx");

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

$styleFont = array(
  'font'  => array(
    'bold'  => true,
        // 'color' => array('rgb' => 'FF0000'),
    'size'  => 12,
    'name'  => 'Time New Roman'
  ));

$styleContent = array('font'  => array('size'  => 10, 'name'  => 'Times New Roman'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::VERTICAL_JUSTIFY));

$styleContent2 = array('font'  => array('size'  => 12, 'name'  => 'Times New Roman','bold'  => true),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$styleContent3 = array('font'  => array('size'  => 12, 'name'  => 'Times New Roman','bold'  => false),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));



$conn=mysqli_connect("localhost","root","","db_dilg_pmis");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM ris_stock_issuetomany WHERE id = '$id' ");
$row = mysqli_fetch_array($sql);
$dept = $row['dept'];
$ris_no = $row['ris_no'];
$procurement_id = $row['procurement_id'];
$status = $row['status'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('B8',$dept);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H8','');
$objPHPExcel->setActiveSheetIndex()->setCellValue('G9',$ris_no);

$selectProc = mysqli_query($conn,"SELECT * from iar_stock where id ='$procurement_id' ");
$fetchProc = mysqli_fetch_array($selectProc);
$rfq_id = $fetchProc['rfq_id'];
$unit_id = $fetchProc['unit_id'];

// $sql_items = mysqli_query($conn, "SELECT unit_id,rsi.qty,iar_stock.qty_original,procurement,description from iar_stock left join ris_stock_issuetomany rsi on iar_stock.id = rsi.procurement_id  where procurement_id = '$procurement_id'");
$sql_items = mysqli_query($conn, "SELECT procurement,unit_id,qty_original,description,rsi.qty from iar_stock left join ris_stock_issuetomany rsi on iar_stock.id = rsi.procurement_id where rsi.ris_no = '$ris_no' AND status = 1");

// SELECT procurement,unit_id,qty_original,description,rsi.qty from iar_stock left join ris_stock_issuetomany rsi on iar_stock.id = rsi.procurement_id where procurement_id = 8



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

$row = 12;
$rowA = 13;
$rowB = 14;
$rowC = 15;
$rowD = 16;
$rowE = 17;
$rowF = 18;
$rowG = 19;
$rowH = 20;
$rowI = 21;
$rowJ = 22;
$rowK = 23;
$counter=0;

if ($status == 0 ) {
    
        echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Please Confirm First!')
      window.location.href='ViewRISmany.php';
      </SCRIPT>");
}

if ($status == 1 ) {

if (mysqli_num_rows($sql_items)>0) {
  $count = mysqli_num_rows($sql_items);
  while($excelrow = mysqli_fetch_assoc($sql_items) )
  {
    if ($excelrow['unit_id'] == 1) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$piece);
    }if ($excelrow['unit_id'] == 2) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$box);
    } if ($excelrow['unit_id'] == 3) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$ream);
    } if ($excelrow['unit_id'] == 4) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$lot);
    } if ($excelrow['unit_id'] == 5) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$unit);
    } if ($excelrow['unit_id'] == 6) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$crtg);
    } if ($excelrow['unit_id'] == 7) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$pack);
    } if ($excelrow['unit_id'] == 8) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$tube);
    } if ($excelrow['unit_id'] == 9) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$roll);
    } if ($excelrow['unit_id'] == 10) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$can);
    } if ($excelrow['unit_id'] == 11) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$bottle);
    } if ($excelrow['unit_id'] == 12) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$set);
    } if ($excelrow['unit_id'] == 13) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$jar);
    } if ($excelrow['unit_id'] == 14) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$bundle);
    } if ($excelrow['unit_id'] == 15) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$pad);
    } if ($excelrow['unit_id'] == 16) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$book);
    } if ($excelrow['unit_id'] == 17) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$pouch);
    } if ($excelrow['unit_id'] == 18) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$dozen);
    } if ($excelrow['unit_id'] == 19) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$pair);
    } if ($excelrow['unit_id'] == 20) {
      $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$gallon);
    } 
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['procurement']." ".$excelrow['description']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['qty']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['qty_original']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['remarks']);

    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);

    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);

    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('test_img');
    $objDrawing->setDescription('test_img');
    $objDrawing->setPath('checked.png');
    $objDrawing->setCoordinates('F'.$row);                      
//setOffsetX works properly
    $objDrawing->setOffsetX(40); 
    $objDrawing->setOffsetY(1);                
//set width, height
    $objDrawing->setWidth(15); 
    $objDrawing->setHeight(15); 
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

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
    $rowH++;
    $rowI++;
    $rowJ++;
    $rowK++;

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

      $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
      $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
      $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
      $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);

      $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);
      $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
      $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
      $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);


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
      $rowH++;
      $rowI++;
      $rowJ++;
      $rowK++;

    

  }



}





$sql_items1 = mysqli_query($conn, "SELECT * FROM ris_stock_issuetomany where id = '$id'");
$rowP = mysqli_fetch_array($sql_items1);
$purpose = $rowP['purpose'];
$request_by = $rowP['request_by'];
$approved_by = $rowP['approved_by'];
$issued_by = $rowP['issued_by'];
$recieved_by = $rowP['recieved_by'];

$objPHPExcel->getActiveSheet()->getStyle('H'.$row.':H'.$row)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowA)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowB)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowC)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowD)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowE)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowF)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowG)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowH)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowI)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowJ)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowK)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleContent2);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':A'.$rowA);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,"Purpose:");

$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleContent);
$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':H'.$rowA);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$purpose);
$objPHPExcel->getActiveSheet()->getStyle('B'.$row.':H'.$rowA)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('H'.$row.':H'.$rowA)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->getStyle('B'.$rowB)->applyFromArray($styleContent);
$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowB.':H'.$rowC);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowB,'');
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowB.':H'.$rowC)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowB.':H'.$rowC)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowD.':H'.$rowE);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowD.':H'.$rowE)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->getStyle('A'.$rowF.':H'.$rowF)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$rowF.':C'.$rowG);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowF,"Requested by:");
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowF)->applyFromArray($styleContent2);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowF.':C'.$rowG)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowF.':C'.$rowG)->applyFromArray($styleRight);

if ($request_by == 1 ) {
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowI,"JAY-AR T. BELTRAN");
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowJ,"Chief, LGCDD");

}
if ($request_by == 2 ) {
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowI,"JOHN M. CEREZO");
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowJ,"Chief, LGMED");

}
if ($request_by == 3 ) {
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowI,"DR. CARINA S. CRUZ");
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowJ,"CAO/ Chief, FAD");
}

$objPHPExcel->getActiveSheet()->getStyle('C'.$rowI)->applyFromArray($styleContent3);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowI,$approved_by);
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowI)->applyFromArray($styleContent3);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$rowI,$issued_by);
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowI)->applyFromArray($styleContent3);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowI,$recieved_by);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowI)->applyFromArray($styleContent3);


$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowF.':E'.$rowG);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowF,"Approved by:");
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowF)->applyFromArray($styleContent2);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowF.':E'.$rowG)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->mergeCells('F'.$rowF.':G'.$rowG);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$rowF,"Issued by:");
$objPHPExcel->getActiveSheet()->getStyle('F'.$rowF)->applyFromArray($styleContent2);
$objPHPExcel->getActiveSheet()->getStyle('G'.$rowF.':G'.$rowG)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->mergeCells('H'.$rowF.':H'.$rowG);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowF,"Recieved by:");
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowF)->applyFromArray($styleContent2);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowF.':H'.$rowG)->applyFromArray($styleRight);

$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowH,"Signature:");
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowH)->applyFromArray($styleContent3);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowH.':H'.$rowH)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowH)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowH)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('G'.$rowH)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowH)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowH)->applyFromArray($styleRight);

$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowI,"Printed Name:");
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowI)->applyFromArray($styleContent3);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowI.':H'.$rowI)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowI)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowI)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('G'.$rowI)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowI)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowI)->applyFromArray($styleRight);

$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowJ,"Designation:");
$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowJ.':E'.$rowJ);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowJ,"Assistant Regional Director");
$objPHPExcel->getActiveSheet()->mergeCells('F'.$rowJ.':G'.$rowJ);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$rowJ,"Chief, GSS");
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowJ)->applyFromArray($styleContent3);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowJ.':H'.$rowJ)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowJ)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowJ)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('G'.$rowJ)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowJ)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowJ)->applyFromArray($styleRight);

$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowK,"Date:");
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowK)->applyFromArray($styleContent3);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowK.':H'.$rowK)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowK)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowK)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('G'.$rowK)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowK)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowK)->applyFromArray($styleRight);




// $selimg = mysqli_query($conn,"SELECT officer from iar where officer = '$officer'");
// $imgrow = mysqli_fetch_array($selimg);
// $officerIncharge = $imgrow['officer'];

// if ($officerIncharge == 1) {
//   $objDrawing = new PHPExcel_Worksheet_Drawing();
//   $objDrawing->setName('test_img');
//   $objDrawing->setDescription('test_img');
//   $objDrawing->setPath('iar1.png');
//   $objDrawing->setCoordinates('A'.$row);                      
// //setOffsetX works properly
//   $objDrawing->setOffsetX(5); 
//   $objDrawing->setOffsetY(5);                
// //set width, height
//   $objDrawing->setWidth(251); 
//   $objDrawing->setHeight(260); 
//   $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

// }elseif($officerIncharge == 2){

//   $objDrawing = new PHPExcel_Worksheet_Drawing();
//   $objDrawing->setName('test_img');
//   $objDrawing->setDescription('test_img');
//   $objDrawing->setPath('iar2.png');
//   $objDrawing->setCoordinates('A'.$row);                      
// //setOffsetX works properly
//   $objDrawing->setOffsetX(5); 
//   $objDrawing->setOffsetY(5);                
// //set width, height
//   $objDrawing->setWidth(251); 
//   $objDrawing->setHeight(260); 
//   $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    

// }elseif($officerIncharge == 3){
//   $objDrawing = new PHPExcel_Worksheet_Drawing();
//   $objDrawing->setName('test_img');
//   $objDrawing->setDescription('test_img');
//   $objDrawing->setPath('iar3.png');
//   $objDrawing->setCoordinates('A'.$row);                      
// //setOffsetX works properly
//   $objDrawing->setOffsetX(5); 
//   $objDrawing->setOffsetY(5);                
// //set width, height
//   $objDrawing->setWidth(251); 
//   $objDrawing->setHeight(260); 
//   $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    
// }
// else{


//   $objDrawing = new PHPExcel_Worksheet_Drawing();
//   $objDrawing->setName('test_img');
//   $objDrawing->setDescription('test_img');
//   $objDrawing->setPath('iar.png');
//   $objDrawing->setCoordinates('A'.$row);                      
// //setOffsetX works properly
//   $objDrawing->setOffsetX(5); 
//   $objDrawing->setOffsetY(5);                
// //set width, height
//   $objDrawing->setWidth(251); 
//   $objDrawing->setHeight(260); 
//   $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());    
// }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_ris_many.xlsx');
}
?>