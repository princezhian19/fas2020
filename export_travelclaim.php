<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_travelclaim.xlsx");
//---- PHP FUNCTIONS --------//

function countEntry($id,$date)
{
  include 'connection.php';
  $query1 = "SELECT count(*) as 'count' 
             FROM tbltravel_claim_info 
             INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
             WHERE tbltravel_claim_info.`RO` = '".$id."' and 
             tbltravel_claim_info.`DATE` = '".$date."' 
             ORDER BY DATE";
  $result1 = mysqli_query($conn, $query1);
  
      if($row1 = mysqli_fetch_array($result1))
      {
     $row1['count'];
     echo $query1;
      }
}










//--- PHP FUNCTIONS --------//
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
      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
    )
  )
);
$styleFont = array(
  'font'  => array(
      'bold' => true,
      'size'  => 11,
      'name' => 'Times New Roman'
  ));
  $styleFont2 = array(
    'font'  => array(
        'bold' => false,
        'size'  => 11,
        'name' => 'Times New Roman'
    ));
  $center = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    )
);

  $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    // =========== table 1 ============================//
        $sql_q11 = mysqli_query($conn, "
        SELECT * FROM `tbltravel_claim_info2`
        INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
        INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
        INNER join tblemployeeinfo ON tbltravel_claim_info2.NAME = tblemployeeinfo.UNAME
        INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
        WHERE `RO_TO_OB`= '".$_GET['id']."'
        GROUP by tbltravel_claim_info.RO ");
        while($excelrow1= mysqli_fetch_assoc($sql_q11) ) 
          {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B9',$_GET['username']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B10',$excelrow1['POSITION_M']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C11','Regional Office');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F10','Purpose of Travel: '.$excelrow1['RO_TO_OB']);
            $objPHPExcel->getActiveSheet()->getStyle("F10") ->getAlignment()->setWrapText(true); 

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G9',$excelrow1['DATE']);
          }
    //======================================================//             
    
    //============ table 2 ============================//
  
    $sql_q10 = mysqli_query($conn, "
    SELECT *, PERDIEM + RECEIPT AS 'a' FROM `tbltravel_claim_info2`
    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
    INNER join tblemployeeinfo ON tbltravel_claim_info2.NAME = tblemployeeinfo.UNAME
    INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
    WHERE `RO_TO_OB`= '".$_GET['id']."'
    ");
    $saved = array();

    if (mysqli_num_rows($sql_q10)>0) {
      $row = 16;
      $travel_title = 15;
      // $row_cnt = mysqli_num_rows($sql_q10)+1;


      while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {
     
        $perdiem = $excelrow['a'];

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$excelrow['DATE']);     
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$excelrow['PLACE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,date('g:i A',strtotime($excelrow['ARRIVAL'])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,date('g:i A',strtotime($excelrow['DEPARTURE'])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,$excelrow['MOT']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,sprintf("%.2f",$excelrow['TRANSPORTATION']));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,$perdiem);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,$excelrow['OTHERS']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,sprintf("%.2f",$excelrow['TOTAL_AMOUNT']));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray($styleArray);


        $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleFont2);
       


          $row++;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$travel_title,$excelrow['RO_OT_OB']);     

          $travel_title++;
   
    }

    
    $row1 = $row+1;
    $row2 = $row+3;
    $row3 = $row+5;
    $row4 = $row+6;
    $row5 = $row+10;
    $row6 = $row+11;
    $row7 = $row+12;
    $row8 = $row+13;
    $row9 = $row+14;
    $row10 = $row+3;
    $row11 = $row+7;

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,'TOTAL');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleFont);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':J'.$row)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row1,'Prepared by:');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row1)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row2."".":J".$row2);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row2,'______________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row2)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row3.':J'.$row3)->applyFromArray($stylebottom);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row4,'Approved by:');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row4)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row5."".":J".$row5);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row5,'______________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row5)->applyFromArray($center);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row6."".":J".$row6);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row6,'NOEL R. BARTOLABAC, CESO V');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row6)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row6)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row7."".":J".$row7);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row7,'OIC-Regional Director');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row7)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row7)->applyFromArray($styleFont2);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row8.':J'.$row8)->applyFromArray($stylebottom);
  

   

   


    $objPHPExcel->getActiveSheet()->mergeCells("A".$row10.":"."D".$row11);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row10,'I certify that : (1) I have reviewed the foregoing  itinerary,    (2)  the  travel  is necessary to  the service, (3) the period covered   is   reasonable   and   (4)  the expenses claimed are proper.');
    $objPHPExcel->getActiveSheet()->getStyle("A".$row10.":"."D".$row11) ->getAlignment()->setWrapText(true); 
    $objPHPExcel->getActiveSheet()->getStyle("A".$row10.":"."D".$row11)->applyFromArray($styleFont2);

   

    $aa = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    $bb = $aa-14;


    for($merge = $aa; $merge >= $bb; $merge--)
    {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$merge.':J'.$merge)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$merge.':J'.$merge)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$merge)->applyFromArray($styleLeft);
    }
    $lastRow1 = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

 

    }else{
      exit();
    }
    //==========================================================//






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');

?>