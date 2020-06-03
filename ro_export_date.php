<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/ro_export_date.xlsx");
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
//echo $office;


/* echo $month1;
echo '<br>';
echo $year;
echo '<br>';
echo $office;
exit(); */


if($office=='ALL'){
  $sql_q10 = mysqli_query($conn, "SELECT * FROM ro_roo WHERE issuancedate like  '%".$year."-".$month1."%'  order by issuancedate asc" );

 /*  echo "SELECT * FROM ob WHERE date like  '%".$year."-".$month1."%'  order by date asc";
  exit(); */
/* 
  echo "SELECT * FROM ro_roo WHERE issuancedate like  '%".$year."-".$month1."%'  order by issuancedate asc";
  exit(); */
}
else{
  $sql_q10 = mysqli_query($conn, "SELECT * FROM ro_roo WHERE issuancedate like  '%".$year."-".$month1."%' and office = '$office' order by issuancedate asc" );

   /* echo "SELECT * FROM ob WHERE date like  '%".$year."-".$month1."%' and office = '$office' order by date asc";
  exit(); */
}


/* echo "SELECT * FROM ob WHERE date like  '%".$year."-".$month."%' and office = '$office' order by date asc";
exit(); */



    if (mysqli_num_rows($sql_q10)>0) {

    $row = 8;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {


        $id=$excelrow['id'];
        $category = $excelrow['category'];
        $issuanceno = $excelrow['issuanceno'];
        $issuancedate1 = $excelrow['issuancedate'];
        $issuancedate = date('F d, Y', strtotime($issuancedate1));
        $title = $excelrow['title'];
        $office = $excelrow['office'];
       
        $registeredby = $excelrow['registeredby'];
    

        $registereddate1 = $excelrow['registereddate'];
        $registereddate = date('F d, Y', strtotime($registereddate1));

     

      
        $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$category);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$issuanceno);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$issuancedate);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$title);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$office);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$registeredby);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$registereddate);
       
       

       
    
        
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
      $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

       

        $objPHPExcel->setActiveSheetIndex()->setCellValue('A9','*********No RO and ROO data.*********');
        $objPHPExcel->setActiveSheetIndex()->mergeCells("A9:G9");

        $objPHPExcel->setActiveSheetIndex()->getStyle("A9:G9")->applyFromArray($style);
    }
  


}


  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: ro_export_date.xlsx');

?>