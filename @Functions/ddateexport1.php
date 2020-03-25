<?php

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$conn=mysqli_connect("localhost","root","","fascalab_2020");




//begin DV
if (isset($_POST['Summary'])) 
{


require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/dvsummary.xlsx");

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

$conn=mysqli_connect("localhost","root","","fascalab_2020");


  $datefrom = $_POST['datefrom'];
  
  
  $dateto = $_POST['dateto'];

  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));

  $d3 = date('F Y', strtotime($datefrom));
  $d4 = date('F d, Y', strtotime($datefrom));


  $objPHPExcel->setActiveSheetIndex()->setCellValue('D12',$d3);
  $sql_items = mysqli_query($conn, "SELECT * FROM  disbursement where datereleased between '$d1' and '$d2' group by datereleased asc ");


  $row=16;
  $row111=19;
  $rowCount = 1;
  if (mysqli_num_rows($sql_items)>1) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){


    $datereceived = $excelrow["datereceived"];
    $datereceived11 = date('F d, Y', strtotime($datereceived));

    

    $datereturned = $excelrow["datereturned"];
    $datereturned11 = date('F d, Y', strtotime($datereturned));

    $datereleased = $excelrow["datereleased"];
    $datereleased11 = date('F d, Y', strtotime($datereleased));
   



    //Getting all Received
    $count = mysqli_query($conn, "SELECT count(datereceived) as a FROM  disbursement where  datereceived = '$datereceived' ");
    $excelReceived = mysqli_fetch_array($count);

    $getValue1 = $excelReceived['a'];


     //Getting all Returned
     if($datereturned=='0000-00-00'){

      $getValueReturned = '0';
     }
     else{
      $count1 = mysqli_query($conn, "SELECT count(id) as b FROM  disbursement where  datereturned = '$datereturned' and status = 'Pending' ");
      $excelReceived = mysqli_fetch_array($count1);
      $getValueReturned = $excelReceived['b'];

     }
   
     //Getting all released
    $count2 = mysqli_query($conn, "SELECT count(datereleased) as c FROM  disbursement where  datereleased = '$datereleased' ");
    $excelReleased = mysqli_fetch_array($count2);

    $getValueRealeased = $excelReleased['c'];
   


     $getAns = $getValueRealeased/$getValue1;
     $finalAns = $getAns*100;
    /*  echo $finalAns;
     exit(); */


    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$rowCount);

     $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$datereleased11);

     $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$getValue1);
   
       $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$getValueRealeased);
     
       if($finalAns==100){
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'1');

       }
       else{

        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'1');

       }
     // $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'0');
 /* 
   

     $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$ans1." %");

     if($ans1>=80){
     $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'1');
     }
     else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'1');

     }
     */

    
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
    

    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight);
    

    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleRight);
    

    $objPHPExcel->getActiveSheet()->mergeCells('I'.$row.':K'.$row);
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$row.':F'.$row);
   
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleRight);
    

    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleRight);

    $row++;
    $row111++;
    $rowCount++;


    
  }
  //$objPHPExcel->getActiveSheet()->mergeCells('I'.$row.':J'.$row.':K'.$row);
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('../dv.png');
  $objDrawing->setCoordinates('B'.$row111);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(100.5); 
  $objDrawing->setHeight(140.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

 /*  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: ddateexport1.xlsx'); */
  

}





}


//$date = date("F, Y", time());

//$objPHPExcel->setActiveSheetIndex()->setCellValue('F11',$date);
if (isset($_POST['submit'])) 
{

require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/PML.xlsx");

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

  $datefrom = $_POST['datefrom'];
  
  $dateto = $_POST['dateto'];

  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));

  $d3 = date('F Y', strtotime($datefrom));

  $objPHPExcel->setActiveSheetIndex()->setCellValue('D10',$d3);
  


  


$sql_items = mysqli_query($conn, "SELECT * FROM  disbursement where datereceived between '$d1' and '$d2' order by datereceived asc ");



$row=15;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

    
      $datefromormat = date('F m, Y', strtotime($excelrow['datereceived']));
      $timeFormat =    date('h:i A', strtotime($excelrow['timereceived']));
      

      $dreleased = date('F m, Y', strtotime($excelrow['datereleased']));
      $treleased =    date('h:i A', strtotime($excelrow['timereceived']));

      $dateReturnedPML = $excelrow['timereturned'];
      if($dateReturnedPML=="0000-00-00"){
        $dreturned = "";

      }
      else{
        $dreturned = date('F m, Y', strtotime( $dateReturnedPML));

      }
     

      $timeReturnedPML = $excelrow['timereturned'];
      if( $timeReturnedPML=="00:00:00"){
        $treturned = "";
      }
      else{
        $treturned =    date('h:i A', strtotime($timeReturnedPML));
      }

      $a = strtotime($excelrow['datereceived']);
      $b = strtotime($excelrow['datereleased']);


      $c = strtotime($excelrow['timereceived']);
      $d = strtotime($excelrow['timereleased']);

     
      $day='';
      if($b==$a){
      $day='1';

      }else{
        $day = ($a-$b)/86400;

      }
      $timeHours = '';
      $timeMins = '';

      if($c==$d){
        $time='0';
  
        }else{

          $timeHours = ($d-$c)/1440;
          $timeMins = ($d-$c)/3600;

  
        }



    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['dv']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$excelrow['ors']);
    //$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$excelrow['sr']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$datefromormat);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$timeFormat);

 /*    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$excelrow['ppa']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['payee']); */
    
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['payee']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['particular']);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['amount']);

    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$dreleased);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$treleased);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$dreturned );
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$treturned );

    $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$row, $day."Day/s  " );
   /*  $objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$row,$excelrow['other']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$row,$excelrow['total']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$row,$excelrow['net']); */
    
    
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

    /* $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($stylebottom);
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
  }

}
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: ddateexport1.xlsx');

?>