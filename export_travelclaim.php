<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_travelclaim.xlsx");
//---- PHP FUNCTIONS --------//







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
        $prepared_by = '';
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

   


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');

?>