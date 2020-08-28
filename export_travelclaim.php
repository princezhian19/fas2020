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
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F10','Purpose of Travel: '.$_GET['id']);
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




          $row++;
   
    }
    $lastRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+2;
    $TOTAL = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$TOTAL,'TOTAL');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$TOTAL)->applyFromArray($styleFont);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$TOTAL.':J'.$TOTAL)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$TOTAL)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$TOTAL)->applyFromArray($styleRight);



    $merge = $lastRow+3;
    

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$lastRow,'Prepared by:');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$lastRow)->applyFromArray($styleFont);

    $PREPARED = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+2;
    $APPROVED = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+5;
    $SIGNATORY = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+9;
    $border = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+4;
    $certify = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+2;

    $objPHPExcel->getActiveSheet()->mergeCells("E".$PREPARED."".":J".$PREPARED);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$PREPARED,'______________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$PREPARED)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$border.':J'.$border)->applyFromArray($stylebottom);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$APPROVED,'Approved by:');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$APPROVED)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$SIGNATORY."".":J".$SIGNATORY);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$SIGNATORY,'______________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$SIGNATORY)->applyFromArray($center);
    $PIPIRMA = $SIGNATORY+1;
    $POSITION = $PIPIRMA+1;
    $objPHPExcel->getActiveSheet()->mergeCells("E".$PIPIRMA."".":J".$PIPIRMA);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$PIPIRMA,'NOEL R. BARTOLABAC, CESO V');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$PIPIRMA)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$PIPIRMA)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$POSITION."".":J".$POSITION);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$POSITION,'OIC-Regional Director');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$POSITION)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$POSITION)->applyFromArray($styleFont2);


    for($i = 0; $i <= 5; $i++)
    {
    $objPHPExcel->getActiveSheet()->mergeCells("A".$certify."".":D".$certify);
    $certify++;

    }
    $objPHPExcel->getActiveSheet()->unmergeCells('A26:D27');
    $objPHPExcel->getActiveSheet()->mergeCells("A26:D27");










    for($merge = 24; $merge <= 36; $merge++)
    {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$merge.':J'.$merge)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$merge.':J'.$merge)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$merge)->applyFromArray($styleLeft);
    }
    $lastRow1 = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    $objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow1.':J'.$lastRow1)->applyFromArray($stylebottom);



     

    }else{
      exit();
    }
    //==========================================================//






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');

?>