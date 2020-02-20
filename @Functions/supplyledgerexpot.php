<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/ledger.xlsx");

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


/* $date = date("F, Y", time());
$objPHPExcel->setActiveSheetIndex()->setCellValue('D3',$date); */
if (isset($_POST['submit'])) 
{

  $sn = $_POST['getsn'];
  $datefrom = $_POST['datefrom'];
  $dateto = $_POST['dateto'];

  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));
  
  /* echo "SELECT * FROM a where a between '$d1' and '$d2' order by id asc";
  exit(); */

$sql_items = mysqli_query($conn, "SELECT * FROM old_stock where sn='$sn' and balanceone between '$d1' and '$d2' order by balanceone asc");

//$sql_items = "SELECT * FROM `old_stock` WHERE balanceone like '%01/31/2019%' and balancetwo like '%06/30/2019%' and sn = '$sn' ";
$sql_items1 = mysqli_query($conn, "SELECT * FROM old_stock where sn = '$sn' order by id desc");

$row = mysqli_fetch_array($sql_items1);


$objPHPExcel->setActiveSheetIndex()->setCellValue('C8',$row['items']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K8',$row['sn']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C10',$row['unit']);

}

$row=14;
$roww=14;

$row1 = 15;
$row2 = 15;

$rowi=15;

$c=0;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('J15',$ans);
    
    $ans = '=(C15+I14)-F15';
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row1,$ans);
    
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('G15','=(k14+E15)/(I14+C15)');
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row1,'=(k14+E15)/(I14+C15)');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row1,'=(k'.$row.'+E'.$row1.')/(I'.$row.'+C'.$row1.')');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row1,'=(k'.$row.'+E'.$row1.')/(I'.$row.'+C'.$row1.')');
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('J15','=(k14+E15)/(I14+C15)');
    
    
    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$excelrow['balanceone']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['avail_balance']);
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['issue_month']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['current_price']);  
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J14',$excelrow['current_price']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G14',$excelrow['current_price']);
    
    
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row1,'=(C'.$row1.'+I'.$row.')-(F'.$row1.')');
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('I15',$ans);
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('I14',$excelrow['two']);
    
    /* $I = 'I'.$row;
    $C = 'C'.$row1;
    $F = 'F'.$row2;
    $ans = '=('.$I.'+'.$C.')-('.$F.')'; */
    // echo $ans;
    
    // $ans = $a + $b - $c;
    
    
    /* $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row1,$ans);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row1,'=(k'.$row.'+E'.$row1.')/(I'.$row.'+C'.$row1.')');
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row2,'=(k'.$roww.'+E'.$row2.')/(I'.$roww.'+C'.$row2.')'); */
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['current_price']);
    
   
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('J15'.$row2,'=(k'.$row.'+E'.$row1.')/(I'.$row.'+C'.$row1.')');

    // /$objPHPExcel->setActiveSheetIndex()->setCellValue('J15','=SUM(G'.$row1.'+0)');
    
    $row1++;
    $row++;
    $c++;
    
  }
  /* print_r(mysqli_num_rows($sql_items));
  exit();   */
}

else
{

}

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: supplyledgerexpot.xlsx');


?>
