<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/ORS_Fund_Monitoring_export.xlsx");

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

$conn=mysqli_connect("localhost","root","","db_dilg_pmis");



if (isset($_POST['Summary'])) 
{


require_once '../library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("../library/orssummary.xlsx");

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

$conn=mysqli_connect("localhost","root","","db_dilg_pmis");


  $datefrom = $_POST['datefrom'];
  
  
  $dateto = $_POST['dateto'];

  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));

  $d3 = date('F Y', strtotime($datefrom));
  $d4 = date('F d, Y', strtotime($datefrom));

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C12',$d3);
  $sql_items = mysqli_query($conn, "SELECT * FROM  saroob where datereceived between '$d1' and '$d2' group by datereceived  asc ");

  //getting total ob date received process on month
  $getTotal = mysqli_query($conn, "Select COUNT(DISTINCT ors, datereceived) as total from saroob where datereceived between '$d1' and '$d2' ");
  $excelrowTot = mysqli_fetch_array($getTotal);
  $total = $excelrowTot['total'];

 //getting total ob date released process on month
 $getTotal1 = mysqli_query($conn, "Select COUNT(DISTINCT ors, datereleased) as total1 from saroob where datereleased between '$d1' and '$d2' ");
 $excelrowTot1 = mysqli_fetch_array($getTotal1);
 $totalr = $excelrowTot1['total1'];

  
  /* echo $totalr;
  exit(); */


  $row=17;

  $rowTotal=17;
  $row111=21;
  //$rowCount = 1;
  if (mysqli_num_rows($sql_items)>1) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){

    
    
    $a = strtotime($excelrow['datereprocessed']);

  

    $b = strtotime($excelrow['datereceived']);
    $day='';
    if($b==$a){
    $day='1';

    }else{
      $day = ($a-$b)/86400;

    }



    $datereceived = $excelrow["datereceived"];
    $datereceived11 = date('F d, Y', strtotime($datereceived));

    $datereprocessed = $excelrow["datereprocessed"];
    $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

    $datereturned = $excelrow["datereturned"];
    $datereturned11 = date('F d, Y', strtotime($datereturned));

    $datereleased = $excelrow["datereleased"];
    $datereleased11 = date('F d, Y', strtotime($datereleased));
   



    //Getting all Received
    $count = mysqli_query($conn, "SELECT count( distinct ors) as a FROM  saroob where  datereceived = '$datereceived'  ");

    $excelReceived = mysqli_fetch_array($count);

    $getValue1 = $excelReceived['a'];

    // echo $getValue1;
    // exit();


     //Getting all Returned
     if($datereturned=='0000-00-00'){

      $getValueReturned = '0';
     }
     else{
      $count1 = mysqli_query($conn, "SELECT count(id) as b FROM  saroob where  datereturned = '$datereturned' and status = 'Pending' ");
      $excelReceived = mysqli_fetch_array($count1);
      $getValueReturned = $excelReceived['b'];

     }
   
     //Getting all released
    $count2 = mysqli_query($conn, "SELECT count( distinct ors) as c FROM  saroob where  datereleased = '$datereleased' ");
    $excelReleased = mysqli_fetch_array($count2);

    $getValueRealeased = $excelReleased['c'];
    
    $minus =$getValue1-$getValueReturned;
    $num1= number_format($minus,0);
    echo $num1;
    
    $num2 = $minus;

    $ans = $num2/$minus*100;
    $ans1 = number_format($ans,0);



    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$datereprocessed11);

     $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,  $getValue1);
     $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$getValueReturned);
    // if($datereturned=='0000-00-00'){
       $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$num1);

       
    // }
    // else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'0');
    // }
   

     $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$ans1." %");

     if($ans1>=80){
     $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'1');
     }
     else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'1');

     }
    
    
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
    $rowTotal++;
    // $rowCount++;
  }
  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$rowTotal,'TOTAL');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$rowTotal, $total);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$rowTotal, '0');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$rowTotal, '0');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowTotal, $totalr);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$rowTotal, '100%');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$rowTotal, '1');


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
  

  $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowTotal.':K'.$rowTotal);



  //$objPHPExcel->getActiveSheet()->mergeCells('I'.$row.':J'.$row.':K'.$row);
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('../ors.png');
  $objDrawing->setCoordinates('B'.$row111);                      
//setOffsetX works properly
  $objDrawing->setOffsetX(5); 
  $objDrawing->setOffsetY(5);                
//set width, height
  $objDrawing->setWidth(100.5); 
  $objDrawing->setHeight(130.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: obdateexport.xlsx');
  
}

}

//$date = date("F, Y", time());


//$objPHPExcel->setActiveSheetIndex()->setCellValue('F11',$date);
if (isset($_POST['submit'])) 
{

  $datefrom = $_POST['datefrom'];
  
  
  $dateto = $_POST['dateto'];

  $d1 = date('Y-m-d', strtotime($datefrom));
  $d2 = date('Y-m-d', strtotime($dateto));

  $d3 = date('F', strtotime($datefrom));
  $d4 = date('F d, Y', strtotime($datefrom));

  $objPHPExcel->setActiveSheetIndex()->setCellValue('F11',"Month of :     ".$d3."             Date :   ".$d4);
  

$sql_items = mysqli_query($conn, "SELECT * FROM  saroob where datereprocessed between '$d1' and '$d2' order by datereprocessed asc ");

/* echo("SELECT * FROM  saroob where datereprocessed between '$d1' and '$d2' order by datereprocessed asc ");
exit(); */

}
//$id = $row["id"];  
// $datereceived = $row["datereceived"];
// $datereprocessed = $row["dateprocessed"];
// $datereturned = $row["datereturned"];
// $datereleased = $row["datereleased"];
// $ors = $row["ors"];
// $ponum = $row["ponum"];
// $payee = $row["payee"];
// $particular = $row["particular"];
// $saronumber = $row["saronumber"];
// $ppa = $row["ppa"];
// $uacs = $row["uacs"];
// $amount = $row["amount"];
// $date = $row["date"];
// $remarks = $row["remarks"];
$row=16;
$rowCount = 1;
if (mysqli_num_rows($sql_items)>0) {
    while($excelrow = mysqli_fetch_assoc($sql_items) ){
   

    $a = strtotime($excelrow['datereprocessed']);
    $b = strtotime($excelrow['datereceived']);
    $day='';
    if($b==$a){
    $day='1';

    }else{
      $day = ($a-$b)/86400;

    }

    $datereceived = $excelrow["datereceived"];
    $datereceived11 = date('F d, Y', strtotime($datereceived));

    $datereprocessed = $excelrow["datereprocessed"];
    $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

    $datereturned = $excelrow["datereturned"];
    $datereturned11 = date('F d, Y', strtotime($datereturned));

    $datereleased = $excelrow["datereleased"];
    $datereleased11 = date('F d, Y', strtotime($datereleased));
   
    $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$rowCount);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$datereceived11);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$datereprocessed11);
    if($datereturned=='0000-00-00'){
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
    }
    else{
      $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$datereturned11);
    }
    
    $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$datereleased11);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$excelrow['ors']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$excelrow['payee']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$excelrow['particular']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$excelrow['saronumber']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$excelrow['ppa']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$excelrow['uacs']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$excelrow['amount']);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,$day);
    $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$row,$excelrow['remarks']);
    
  
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);


    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);


    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);


    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);

    
    // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);


    // $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);
    

    // $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);

    // $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight);
    

    // $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($stylebottom);
    // $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleTop);
    // $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
    // $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight);
    

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
    $rowCount++;
  }

}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: obdateexport.xlsx');

?>