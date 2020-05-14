<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/ob_export_date.xlsx");
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
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);


if (isset($_POST['submit'])) 
{

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    
$month1 = $_POST['month'];
$month = date('m', strtotime($month1));
$year = $_POST['year'];

$office = $_POST['office'];

/* echo $month;
echo '<br>';
echo $year;
echo '<br>';
echo $office; */




$sql_q10 = mysqli_query($conn, "SELECT * FROM ob WHERE date like  '%".$year."-".$month."%' and office = '$office' order by date asc" );
/* echo "SELECT * FROM ob WHERE date like  '%".$year."-".$month."%' and office = '$office' order by date asc";
exit(); */



    if (mysqli_num_rows($sql_q10)>0) {

    $row = 8;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {


        $id=$excelrow['id'];
        $obno = $excelrow['obno'];
        $date1 = $excelrow['date'];
        $date = date('F d, Y', strtotime($date1));
        $office = $rexcelroww['office'];
        $name = $excelrow['name'];
        $purpose = $excelrow['purpose'];
        $place = $excelrow['place'];

        $obdate1 = $excelrow['obdate'];
        $obdate = date('F d, Y', strtotime($obdate1));
        
        $timefrom1 = $excelrow['timefrom'];
        $timefrom=  date("g:i A",strtotime($timefrom1));
      

        $timeto1 = $excelrow['timeto'];
        $timeto=  date("g:i A",strtotime($timeto1));

    

        $uc = $excelrow['uc'];

        $submitteddate1 = $excelrow['submitteddate'];
        $submitteddate = date('F d, Y', strtotime($submitteddate1));


        $receiveddate1 = $excelrow['receiveddate'];
        $receiveddate = date('F d, Y', strtotime($receiveddate1));
      
        $status=$excelrow['status'];

        
      

      
        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$obno);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$date);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$obdate);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$name);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$purpose);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$place);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$timefrom);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$timeto);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$status);
       

       
    
        
     /*    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);
    
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
    
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
        $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight); */
          $row++;
    }
    }
    else{


        $objPHPExcel->setActiveSheetIndex()->setCellValue('A9','*********No official business data.*********');
        $objPHPExcel->setActiveSheetIndex()->mergeCells("A9:I9");
       
    }
  


}


  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: ob_export_date.xlsx');

?>