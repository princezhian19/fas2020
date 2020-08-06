<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_rfq.xlsx");

$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
);

$styleContent = array('font'  => array('size'  => 9, 'name'  => 'Cambria'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$styleContent31 = array('font'  => array('size'  => 11, 'name'  => 'Cambria'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
$styleLabel2 = array('font'  => array('size'  => 12, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT rfq.rfq_mode_id,rfq.quotation_date,rfq.rfq_date,rfq.rfq_no,rfq.purpose,pr.pmo,rfq.pr_no,rfq.pr_received_date FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no WHERE rfq.id = '$id' ");
$row = mysqli_fetch_array($sql);
$pr_no = $row['pr_no'];
$pmo = $row['pmo']; 
$rfq_no = $row['rfq_no'];
$rfq_mode_id = $row['rfq_mode_id'];
$rfq_date = $row['rfq_date'];
$quotation_date = $row['quotation_date'];
$purpose = $row['purpose'];
$pr_date = $row['pr_received_date'];

if ($rfq_mode_id == 1) {
  $rfq_mode_id = "Small Value Procurement";
}
if ($rfq_mode_id == 2) {
  $rfq_mode_id = "Shopping";
}
if ($rfq_mode_id == 4) {
  $rfq_mode_id = "NP Lease of Venue";
}
if ($rfq_mode_id == 5) {
  $rfq_mode_id = "Direct Contracting";
}
if ($rfq_mode_id == 6) {
  $rfq_mode_id = "Agency to Agency";
}
if ($rfq_mode_id == 7) {
  $rfq_mode_id = "Public Bidding";
}
if ($rfq_mode_id == 8) {
  $rfq_mode_id = "Not Applicable N/A";
}

$objPHPExcel->setActiveSheetIndex()->setCellValue('D12',$rfq_mode_id);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J11',$rfq_no);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J12',date('F d, Y',strtotime($rfq_date)));
$objPHPExcel->setActiveSheetIndex()->setCellValue('C14',$pmo);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C15',$purpose);

$sql_items1 = mysqli_query($conn, "SELECT sum(pr.qty*pr.abc) as totalABC,pr.id,item.item_unit_title,app.procurement,pr.unit,pr.qty,pr.abc FROM pr_items pr LEFT JOIN app on app.id = pr.items left join item_unit item on item.id = pr.unit WHERE pr_no = '$pr_no' ");
while($rowA = mysqli_fetch_assoc($sql_items1) ){

  $totalABC = $rowA["totalABC"];
  $totalABC1 = number_format($totalABC,2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C33',$totalABC1);
}


$sql_items = mysqli_query($conn, "SELECT pr.description,pr.id,item.item_unit_title,app.procurement,pr.unit,pr.qty,pr.abc FROM pr_items pr LEFT JOIN app on app.id = pr.items left join item_unit item on item.id = pr.unit WHERE pr_no = '$pr_no' ");
$row        = 45;
$rowssE     = 46;
$rowssE1    = 47;
$rowssF     = 48;
$rowssG     = 49;
$rowssH     = 50;
$rowssI     = 51;
$rowssJ     = 52;
$rowssK     = 53;
$countn     = 1;
while($rowE = mysqli_fetch_assoc($sql_items) ){

  $items = $rowE["procurement"];  
  $unit = $rowE["item_unit_title"];
  $qty = $rowE["qty"];
  $abc1 = $rowE["abc"];
  $abc11 = number_format($abc1,2);
  $total_cost = $qty * $abc1;
  $total_cost11 = number_format($total_cost,2);

  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLabel2);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLabel2);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLabel2);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLabel2);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLabel2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$countn);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$unit);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$rowE['procurement'] ."\n".$rowE['description']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$rowE['qty']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,number_format($rowE['abc'],2));

  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);

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

  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleRight);



  $countn++;
  $row++;
  $rowssDD++;
  $rowssE++;
  $rowssE1++;
  $rowssF++;
  $rowssG++;
  $rowssH++;
  $rowssI++;
  $rowssJ++;
  $rowssK++;
}

$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':N'.$row)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':N'.$row);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleContent31);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':N'.$row)->applyFromArray($styleRight);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':N'.$row)->applyFromArray($styleLeft);
// $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
// $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setItalic(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$select_notes = mysqli_query($conn,"SELECT n.note FROM rfq_notes rn LEFT JOIN new_rfq_notes n on n.id = rn.note_id WHERE rn.rfq_id = $id ");
// echo "SELECT * FROM rfq_notes rn LEFT JOIN notes n on n.id = rn.note_id WHERE rn.rfq_id = $id AND n.id != 1 AND n.id != 6 AND n.id !=7";exit;
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(206.25);
if (mysqli_num_rows($select_notes) > 0) {
  # code...
  while ($rowN = mysqli_fetch_assoc($select_notes)){
    $notes_group = $rowN['note'];
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,"NOTE:\n*In order to be eligible for this procurement, suppliers/service providers must submit together with the quotation the following Eligibility Documents:\n   1. Valid Business Peromit 2020 ( Application for renewal with Official Receipt 2020)\n   2. PhilGEPS Registration No. (Please indicate on the space provided above)\n   3. a. Any documents to prove that the signatory of the quotation is autorized representative of the company.\n       b. Photocopy of ID bearing the pictures/ signature of the representatives.\n   ".$notes_group."\n * Please submit your quotation using our official Request for Quotation (RFQ) Form. You can secure a copy of the \nRFQ from the General Services and Supply Section, Finance and Administrative Division. \n *Please submit your quotation together with the Eligibility Documents through any of the following : \n       a. Email us at dilg4a.bac@gmail.com\n       b. Deliver on hand at the receiving area of DILG IV-A CALABARZON, Andenson Bldg1. National Highway, Parian, Calamba City, Laguna");
  // echo $notes_group;
  // echo '<br>';
    $row++;

  }
}else{
 $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,"NOTE:\n*In order to be eligible for this procurement, suppliers/service providers must submit together with the quotation the following Eligibility Documents:\n   1. Valid Business Peromit 2020 ( Application for renewal with Official Receipt 2020)\n   2. PhilGEPS Registration No. (Please indicate on the space provided above)\n   3. a. Any documents to prove that the signatory of the quotation is autorized representative of the company.\n     b. Photocopy of ID bearing the pictures/ signature of the representatives.\n * Please submit your quotation using our official Request for Quotation (RFQ) Form. You can secure a copy of the \nRFQ from the General Services and Supply Section, Finance and Administrative Division.\n *Please submit your quotation together with the Eligibility Documents through any of the following : \n       a. Email us at dilg4a.bac@gmail.com\n         b. Deliver on hand at the receiving area of DILG IV-A CALABARZON, Andenson Bldg1. National Highway, Parian, Calamba City, Laguna");
}

  // echo $notes_group;
  // echo '<br>';
// exit();


$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':N'.$rowssDD)->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()
->getStyle('A'.$rowssE)
->getFill()
->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Border::BORDER_DASHDOT);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowssE.':A'.$rowssE1);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE.':A'.$rowssE1)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE.':A'.$rowssE1)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE.':A'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE.':A'.$rowssE1)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleContent);
            // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->getFont()->setBold(true);
             // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getRowDimension($rowssE1)->setRowHeight(6);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowssE,'Warranty:');

        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowssE.':D'.$rowssE1);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE.':D'.$rowssE1)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE.':D'.$rowssE1)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE.':D'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE.':D'.$rowssE1)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE)->applyFromArray($styleContent);
            // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowssE,'');

            // $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $objPHPExcel->getActiveSheet()
        ->getStyle('E'.$rowssE)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowssE.':G'.$rowssE1);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE.':G'.$rowssE1)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE.':G'.$rowssE1)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE.':G'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE.':G'.$rowssE1)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE)->applyFromArray($styleContent);
            // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE)->getFont()->setBold(true);
             // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowssE)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowssE,'Price Validity:');

        $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowssE.':J'.$rowssE1);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE.':J'.$rowssE1)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE.':J'.$rowssE1)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE.':J'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE.':J'.$rowssE1)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE)->applyFromArray($styleContent);
            // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$rowssE,'');

        $objPHPExcel->getActiveSheet()
        ->getStyle('K'.$rowssE)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Border::BORDER_DASHDOT);
        $objPHPExcel->getActiveSheet()->mergeCells('K'.$rowssE.':L'.$rowssE1);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE.':L'.$rowssE1)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE.':L'.$rowssE1)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE.':L'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE.':L'.$rowssE1)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE)->applyFromArray($styleContent);
            // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssE)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowssE)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$rowssE,'TOTAL');

        $objPHPExcel->getActiveSheet()->getStyle('N'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->mergeCells('M'.$rowssE.':N'.$rowssE1);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE)->applyFromArray($styleContent);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE.':N'.$rowssE1)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE.':N'.$rowssE1)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE.':N'.$rowssE1)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE.':N'.$rowssE1)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowssE)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$rowssE,'');

        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$rowssG.':N'.$rowssG)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowssG.':N'.$rowssG);
        $objPHPExcel->getActiveSheet()->getRowDimension($rowssG)->setRowHeight(15.75);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowssG,'SUPPLIER');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG.':N'.$rowssG)->applyFromArray($styleContent);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG.':N'.$rowssG)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG.':N'.$rowssG)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG.':N'.$rowssG)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssG.':N'.$rowssG)->applyFromArray($styleTop);


        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$rowssH.':N'.$rowssH)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssH)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowssH.':N'.$rowssH);
        $objPHPExcel->getActiveSheet()->getRowDimension($rowssH)->setRowHeight(15.75);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssH)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowssH,'After having carefully read and accepted your General Conditions, I / WE quote on the item(s) at prices noted above.');
        // 
        $objPHPExcel->getActiveSheet()->getStyle('N'.$rowssF)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssF)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssH.':N'.$rowssH)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssH.':N'.$rowssH)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssH.':N'.$rowssH)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssH.':N'.$rowssH)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$rowssI)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssI)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension($rowssI)->setRowHeight(15.75);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssI)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowssI,'Name:');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssI)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssI)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssI)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssI)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowssI.':N'.$rowssI);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssI)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowssI,'');
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssI.':N'.$rowssI)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssI.':N'.$rowssI)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssI.':N'.$rowssI)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssI.':N'.$rowssI)->applyFromArray($styleTop);


        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$rowssJ)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssJ)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension($rowssJ)->setRowHeight(15.75);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssJ)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowssJ,'Contact:');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssJ)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssJ)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssJ)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssJ)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowssJ.':N'.$rowssJ);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssJ)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowssJ,'');
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssJ.':N'.$rowssJ)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssJ.':N'.$rowssJ)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssJ.':N'.$rowssJ)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssJ.':N'.$rowssJ)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()
        ->getStyle('A'.$rowssK)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssK)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension($rowssK)->setRowHeight(15.75);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssK)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowssK,'Signature');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssK)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssK)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssK)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowssK)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowssK.':H'.$rowssK);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssK)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowssK,'');
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssK.':H'.$rowssK)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssK.':H'.$rowssK)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssK.':H'.$rowssK)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowssK.':H'.$rowssK)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()
        ->getStyle('I'.$rowssK)
        ->getFill()
        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        ->getStartColor()
        ->setRGB('b5b8bc');##b5b8bc
        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowssK)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowssK)->applyFromArray($styleContent31);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$rowssK,'Date:');
        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowssK)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowssK)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowssK)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowssK)->applyFromArray($styleTop);

        $objPHPExcel->getActiveSheet()->mergeCells('J'.$rowssK.':N'.$rowssK);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowssK)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$rowssK,'');
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowssK.':N'.$rowssK)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowssK.':N'.$rowssK)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowssK.':N'.$rowssK)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$rowssK.':N'.$rowssK)->applyFromArray($styleTop);


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        header('location: export_rfq.xlsx');

        ?>