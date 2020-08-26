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
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
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
    $sql_q10 = mysqli_query($conn, "
    SELECT * FROM `tbltravel_claim_info2`
    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
    INNER join tblemployeeinfo ON tbltravel_claim_info2.NAME = tblemployeeinfo.UNAME
    INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
    WHERE `RO_TO_OB`= '".$_GET['id']."'
    GROUP by tbltravel_claim_info.RO ");
    $saved = array();

    if (mysqli_num_rows($sql_q10)>0) {
      $row = 16;
      // $objPHPExcel->getActiveSheet()->getHighestRow()-10;
      while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {
      $saved[] = $excelrow["DATE"]; // you are missing []
        if($excelrow['DATE'] == $excelrow['DATE'])
          {
            if($excelrow['DATE'] == $saved[1])
            {
              echo '';
            }else
            {
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$excelrow['DATE']);
            }   
        }else{
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$excelrow['PLACE']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,date('g:i A',strtotime($excelrow['ARRIVAL'])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,date('g:i A',strtotime($excelrow['DEPARTURE'])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,$excelrow['MOT']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,sprintf("%.2f",$excelrow['TRANSPORTATION']));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,$excelrow['PERDIEM'] + $excelrow['RECEIPT']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,$excelrow['OTHERS']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,sprintf("%.2f",$excelrow['TOTAL_AMOUNT']));

  
    //   if(strlen($excelrow['REQ_BY']) >= 10)
    //   {
    //   $objPHPExcel->getActiveSheet(0)->getRowDimension($row)->setRowHeight(53);
    //   $objPHPExcel->getActiveSheet(0)->getStyle('E'.$row)->getAlignment()->setWrapText(true);

    //   }else{
    //   $objPHPExcel->getActiveSheet(2)->getRowDimension($row)->setRowHeight(14.40);
    //   $objPHPExcel->getActiveSheet(2)->getStyle('E'.$row)->getAlignment()->setWrapText(true);
    //   }
    
       
          // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$excelrow['RO_OT_OB']);




          $row++;
    }
  }else{
    exit();
  }






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');

?>