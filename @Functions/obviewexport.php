<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/saroobdate.xlsx");

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

$conn=mysqli_connect("localhost","root","","db_dilg_pmis");

if (isset($_POST['submit'])) 
{

$saro = $_POST['saro'];
$uacs = $_POST['uacs'];



$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
  

/* echo $saro;
echo $uacs; 
echo $totalob;
exit(); */
  
$d1 = date('Y-m-01', strtotime($datefrom));
$d2 = date('Y-m-31', strtotime($dateto));

//From to Dates for Monthly
$df = date('Y-m-01', strtotime($dateto));
$dt = date('Y-m-31', strtotime($dateto));


//Getting  All Month Amount
$sql_items = mysqli_query($conn, "SELECT * FROM  saroob where datereprocessed between '$d1' and '$d2' and saronumber = '$saro' and uacs = '$uacs' order by datereprocessed asc ");
//Getting total SARO Amount
$getAmount = mysqli_query($conn, "SELECT * FROM  saro where  saronumber = '$saro' and uacs = '$uacs' ");
$rowAmount = mysqli_fetch_array($getAmount);
$amount = $rowAmount['amount'];



//Getting all data based on date
$monthly = mysqli_query($conn, "SELECT sum(amount) as damount FROM  saroob where datereprocessed between '$df' and '$dt' and saronumber = '$saro' and uacs = '$uacs' order by datereprocessed asc ");
$rowmonthly = mysqli_fetch_array($monthly);
$monthAmount = $rowmonthly['damount'];
//Monthly End


/* echo "SELECT sum(amount) as damount FROM  saroob where datereprocessed between '$df' and '$dt' and saronumber = '$saro' and uacs = '$uacs' order by datereprocessed asc ";
echo $monthAmount;
exit(); */

//Getting Total OB
$totalob = $_POST['totalob'];
/* echo $totalob;
exit(); */


//Getting The Balance

$rowBalance = mysqli_query($conn, "SELECT * FROM  saro where  saronumber = '$saro' and uacs = '$uacs' ");
$rowBalance = mysqli_fetch_array($rowBalance);
$balance = $rowBalance['balance'];


$objPHPExcel->setActiveSheetIndex()->setCellValue('I2',number_format($amount,2));

// echo "SELECT * FROM  saroob where datereprocessed like '$d1' and datereprocessed like '$d2' order by datereprocessed asc ";
//exit();

$row=3;
$rowA=6;
$rowB=7;
$rowC=8;

if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){
    
    $d = $excelrow['datereprocessed'];
    $d3 = date('F d, Y', strtotime($d));

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$d3);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['ors']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['saronumber']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['remarks']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['ppa']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['uacs']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['payee']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['particular']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,number_format($excelrow['amount'],2));
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$excelrow['']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$excelrow['']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,$excelrow['']);
    
    
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
    

    /* $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight); */
    

    // $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleRight);
    

    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleRight);
    

    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleRight);

    $row++;
    $rowA++;
    $rowB++;
    $rowC++;

  }

  
  /* $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowA,$monthAmount);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowA,$monthAmount); */



}
/* Monthly Obligation */
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowA,'Obligation Incurred (This Report)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$rowA,number_format($monthAmount,2));

$objPHPExcel->getActiveSheet()->getStyle('H'.$rowA)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowA)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowA)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowA)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->getStyle('I'.$rowA)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowA)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowA)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowA)->applyFromArray($styleRight);

//All Obligations
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowB,'Obligation Incurred (To Date)');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$rowB,number_format($totalob,2));

$objPHPExcel->getActiveSheet()->getStyle('H'.$rowB)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowB)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowB)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowB)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->getStyle('I'.$rowB)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowB)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowB)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowB)->applyFromArray($styleRight);


//Balance
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowC,'Unobligated Balance of Allotment');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$rowC,number_format($balance,2));

$objPHPExcel->getActiveSheet()->getStyle('H'.$rowC)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowC)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowC)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowC)->applyFromArray($styleRight);

$objPHPExcel->getActiveSheet()->getStyle('I'.$rowC)->applyFromArray($stylebottom);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowC)->applyFromArray($styleTop);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowC)->applyFromArray($styleLeft);
$objPHPExcel->getActiveSheet()->getStyle('I'.$rowC)->applyFromArray($styleRight);

}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: obviewexport.xlsx');
?>