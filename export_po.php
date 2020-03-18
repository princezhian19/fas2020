<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_po.xlsx");

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

$border = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM, 'color' => array( 'rgb' => '6a6d6d'))));


$styler = array('font'  => array('size'  => 11, 'name'  => 'Cambria'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$styleLabel = array('font'  => array('size'  => 9, 'name'  => 'Cambria'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
$styleLabel2 = array('font'  => array('size'  => 11, 'name'  => 'Cambria'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

// function convertToWords($number)
//     {
//         $hyphen      = '-';
//         $conjunction = ' ';
//         $separator   = ' ';
//         $negative    = 'negative ';
//         $decimal     = ' and ';
//         $dictionary  = array(
//             0                   => 'Zero',
//             1                   => 'One',
//             2                   => 'Two',
//             3                   => 'Three',
//             4                   => 'Four',
//             5                   => 'Five',
//             6                   => 'Six',
//             7                   => 'Seven',
//             8                   => 'Eight',
//             9                   => 'Nine',
//             10                  => 'Ten',
//             11                  => 'Eleven',
//             12                  => 'Twelve',
//             13                  => 'Thirteen',
//             14                  => 'Fourteen',
//             15                  => 'Fifteen',
//             16                  => 'Sixteen',
//             17                  => 'Seventeen',
//             18                  => 'Eighteen',
//             19                  => 'Nineteen',
//             20                  => 'Twenty',
//             30                  => 'Thirty',
//             40                  => 'Fourty',
//             50                  => 'Fifty',
//             60                  => 'Sixty',
//             70                  => 'Seventy',
//             80                  => 'Eighty',
//             90                  => 'Ninety',
//             100                 => 'Hundred',
//             1000                => 'Thousand',
//             1000000             => 'Million',
//             1000000000          => 'Billion',
//             1000000000000       => 'Trillion',
//             1000000000000000    => 'Quadrillion',
//             1000000000000000000 => 'Quintillion'

//         );

$conn=mysqli_connect("localhost","root","","db_dilg_pmis");
$rfq_id = $_GET['rfq_id'];
$supplier_id = $_GET['supplier_id'];
$po_id = $_GET['po_id'];

$sql1 = mysqli_query($conn, "SELECT * FROM po WHERE id = $po_id ");
$row1 = mysqli_fetch_array($sql1);
$po_no = $row1['po_no'];
$po_date = $row1['po_date'];
$d1 = date('F d, Y', strtotime($po_date));

$sql2 = mysqli_query($conn, "SELECT supplier_title,supplier_address FROM supplier WHERE id = $supplier_id ");
$row2 = mysqli_fetch_array($sql2);
$supplier_title = $row2['supplier_title'];
$supplier_address = $row2['supplier_address'];

$sql3 = mysqli_query($conn, "SELECT mop.mode_of_proc_title FROM rfq LEFT JOIN mode_of_proc mop on mop.id = rfq.rfq_mode_id WHERE rfq.id = $rfq_id ");
$row3 = mysqli_fetch_array($sql3);
$mode_of_proc_title = $row3['mode_of_proc_title'];

$objPHPExcel->setActiveSheetIndex()->setCellValue('B7',$supplier_title);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B8',$supplier_address);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E7',$po_no);  
$objPHPExcel->setActiveSheetIndex()->setCellValue('E8',$d1);  
$objPHPExcel->setActiveSheetIndex()->setCellValue('F9',$mode_of_proc_title);  

$select_rfqitems = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
while ($rfqitems = mysqli_fetch_assoc($select_rfqitems)) {
  $rfq_items_id_abc[] = $rfqitems['id'];
}
$implode = implode(',', $rfq_items_id_abc);

$sql_items = mysqli_query($conn, "SELECT rq.description,rq.total_amount as abc,iu.item_unit_title,rq.qty,app.procurement,app.sn,sq.ppu,sq.remarks FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN supplier_quote sq on sq.rfq_item_id = rq.id LEFT JOIN item_unit iu on iu.id = rq.unit_id WHERE rq.id in($implode) AND sq.supplier_id = $supplier_id ");

$sql_items5 = mysqli_query($conn, "SELECT sum(rq.qty*sq.ppu) as totalamnt,rq.description,rq.total_amount as abc,iu.item_unit_title,rq.qty,app.procurement,app.sn,sq.ppu,sq.remarks FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN supplier_quote sq on sq.rfq_item_id = rq.id LEFT JOIN item_unit iu on iu.id = rq.unit_id WHERE rq.id in($implode) AND sq.supplier_id = $supplier_id ");
$sqlrw = mysqli_fetch_array($sql_items5);
$sumtotal = $sqlrw['totalamnt'];

$row = 16;
$rowA = 18;
$rowB = 19;
$rowC = 21;
$rowD = 23;
$rowE = 24;
$rowF = 29;
$rowG = 30;
$rowH = 33;
$rowI = 34;
$rowJ = 35;
$rowK = 36;
$rowL = 37;
$rowM = 38;
$rowN = 39;
$rowO = 40;
$rowP = 41;
$rowQ = 42;

while($excelrow = mysqli_fetch_assoc($sql_items) ){

  $ppu1 = $excelrow["ppu"];  
  $sn1 = $excelrow["sn"];
  $procurement1 = $excelrow["procurement"];
  $qty1 = $excelrow["qty"];
  $description = $excelrow["description"];
  $item_unit_title1 = $excelrow["item_unit_title"];

  $total = $excelrow['qty']*$excelrow['ppu'];
  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['sn']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$item_unit_title1);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['procurement'] ."\n".$excelrow['description']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['qty']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['ppu']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$total);

  $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($border);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($border);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($border);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($border);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($border);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($border);

  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;
}

$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
$range = 'A'.$row;
$objPHPExcel->getActiveSheet()
->getStyle($range)
->getNumberFormat()
->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLabel);
//$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$sumtotal);
$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($border); 
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$sumtotal);

   $objPHPExcel->getActiveSheet()->getStyle('A'.$rowA)->getFont()->setItalic( true );
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowA)->applyFromArray($styleLabel2);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowA,'In case of failure to make full delivery within time specified above, a penalty of one-tenth (1/10) of one percent for');
   $objPHPExcel->getActiveSheet()->getStyle('A'.$rowB)->getFont()->setItalic( true );
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowB)->applyFromArray($styleLabel2);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowB,'every day of delay shall be imposedon the undelivered item/s.');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowC)->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowC,'Coforme:');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowC,'Very Truly Yours:');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowD,'       ______________________________________');
        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowD)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowD)->applyFromArray($styleLabel2);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowD,'NOEL R. BARTOLABAC, CESO V');
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowD.':F'.$rowD)->applyFromArray($stylebottom); 
$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowE.':C'.$rowE);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowE,'Signature over Printed Name of Supplier');
$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowE.':F'.$rowE);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowE,'Signature over Printed Name of Authorized Official');

$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowF,'               __________________________');
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowF.':F'.$rowF)->applyFromArray($stylebottom); 
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowF)->applyFromArray($styleLabel2);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowF,'       Assistant Regional Director');
$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowG.':C'.$rowG);
// $objPHPExcel->getActiveSheet()->getStyle('B'.$rowG)->applyFromArray($styler);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowG,'                               Date');
$objPHPExcel->getActiveSheet()->mergeCells('D'.$rowG.':F'.$rowG);
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowG)->applyFromArray($styler);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowG,'Designation');

$objPHPExcel->getActiveSheet()->getStyle('A'.$rowH.':F'.$rowH)->applyFromArray($styleTop); 
$objPHPExcel->getActiveSheet()->getStyle('C'.$rowH.':C'.$rowQ)->applyFromArray($styleRight); 
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowQ.':F'.$rowQ)->applyFromArray($stylebottom); 
$objPHPExcel->getActiveSheet()->getStyle('F'.$row.':F'.$rowQ)->applyFromArray($styleRight); 
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowJ,'Fund Cluster : _____________________________________________');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowJ,'ORS/BURS No. : _______________________');
$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowK,'Fund Available : ___________________________________________');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowK,'Date of the ORS/BURS: ___________________');

$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowM.':C'.$rowM);
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowM.':C'.$rowM)->applyFromArray($stylebottom); 
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowM)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B'.$rowM)->applyFromArray($styler);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowM,'RESTITUTO B. NAÑEZ, III');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowN,'Signature over Printed Name of Chief Accountant/Head of');
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowM,'Amount : _____________________________');
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowO,'Accounting Division/Unit');



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_po.xlsx');

?>