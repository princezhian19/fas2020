<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/PML.xlsx");

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

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



//$date = date("F, Y", time());

//$objPHPExcel->setActiveSheetIndex()->setCellValue('F11',$date);
if (isset($_POST['submit'])) 
{

  $datefrom = $_POST['datefrom'];
  
  $dateto = $_POST['dateto'];

  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));

  $d3 = date('F Y', strtotime($datefrom));

  $objPHPExcel->setActiveSheetIndex()->setCellValue('D10','Month of   '.$d3);
  

$sql_items = mysqli_query($conn, "SELECT * FROM  disbursement where datereceived between '$d1' and '$d2' order by datereceived asc ");

}

$row=15;
$rowNo = 1;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

    $amount = number_format($excelrow['amount'],2);
    
    $datefromormat = date('F m, Y', strtotime($excelrow['datereceived']));
    $timeFormat =    date('h:i A', strtotime($excelrow['timereceived']));    

    $datereleased = date('F m, Y', strtotime($excelrow['datereleased']));
    $timereleased =    date('h:i A', strtotime($excelrow['timereleased']));    

    $datereturned = date('F m, Y', strtotime($excelrow['datereturned']));
    $timereturned =    date('h:i A', strtotime($excelrow['timereturned']));    
    

    $a = strtotime($excelrow['datereceived']);
    $b = strtotime($excelrow['timereceived']);


    $c = strtotime($excelrow['datereleased']);
    $d = strtotime($excelrow['timereleased']);

   
    $day='';
    if($c==$a){
    $day='1';

    }else{
      $day = ($c-$a)/86400;

      $d = number_format($day);

    }


    $timeHours = '';
    $timeMins = '';

    if($d==$b){
      $time='0';

      }else{

        $timeHours =($d-$b)/1440;
        $th = number_format($timeHours);

        $timeMins = ($d-$b)/3600;
        $tm = number_format($timeMins);
      }


      $dater = $excelrow['datereturned'];
      $timer = $excelrow['timereturned'];


    /*   echo $d;
      echo $th;
      echo $tm;
      exit(); */

    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$rowNo);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['dv']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['ors']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['sr']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['ppa']);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['uacs']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$datefromormat);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$timeFormat);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['payee']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['particular']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$amount);



    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$datereleased);


    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$timereleased);

    if($dater=="0000-00-00"){
      $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,"");
    }else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$datereturned);
    }

    if($timer=="00:00:00"){
      $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,"");
    }else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$timereturned);
    }
   
   
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,$excelrow['other']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$row,$day/* ."  Day/s, ".$th."  Hour/s,  ".$tm."Minutes" */);
    // $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$row,$excelrow['net']);
    
    
   /*  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
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

    $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleRight);

    $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleRight); */

    $row++;
    $rowNo++;
  }

}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: ddateexport1.xlsx');

?>