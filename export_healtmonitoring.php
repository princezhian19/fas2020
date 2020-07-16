<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_healtmonitoring.xlsx");

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

$fontStyle = [
  'font' => [
      'size' => 11
  ]
];


$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


$sql_q10 = mysqli_query($conn, "SELECT * from `tblhealth_monitoring` 
INNER JOIN  tblemployeeinfo ON tblhealth_monitoring.UNAME = tblemployeeinfo.UNAME 
INNER JOIN tblpersonneldivision on tblemployeeinfo.DIVISION_C = tblpersonneldivision.DIVISION_N
LEFT JOIN tbldilgposition d on d.POSITION_ID = tblemployeeinfo.POSITION_C
LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployeeinfo.DESIGNATION
WHERE 
DIVISION_M LIKE '%".$_GET['division']."%' and
`DATE` LIKE '%".$_GET['datee']."%' ");

if (mysqli_num_rows($sql_q10)>0) 
{
    $row = 9;
    $no = 1;
    // $count = (mysqli_num_rows($sql_q10));
//    $total = ($row + $count)+1;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {
     
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$no++);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,$excelrow['FIRST_M'].''.$excelrow['LAST_M']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,$excelrow['BODY_TEMPERATURE']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,$excelrow['CURRENT_ADDRESS']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,$excelrow['OFFICE_STATION']);
                if($excelrow['DETAILS_1'] == '' || $excelrow['DETAILS_1'] == null) 
                {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,$excelrow['QUESTION_1']);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row,$excelrow['QUESTION_1'].'  ('.$excelrow['DETAILS_1'].')');
                }      
                
                if($excelrow['DETAILS_2'] == '' || $excelrow['DETAILS_2'] == null) 
                {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,$excelrow['QUESTION_2']);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,$excelrow['QUESTION_2'].'  ('.$excelrow['DETAILS_2'].')');
                } 

                if($excelrow['DETAILS_3'] == '' || $excelrow['DETAILS_3'] == null) 
                {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,$excelrow['QUESTION_3']);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,$excelrow['QUESTION_3'].'  ('.$excelrow['DETAILS_3'].')');
                } 

                if($excelrow['DETAILS_4'] == '' || $excelrow['DETAILS_4'] == null) 
                {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,$excelrow['QUESTION_4']);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,$excelrow['QUESTION_4'].'  ('.$excelrow['DETAILS_4'].')');
                } 

                if($excelrow['DETAILS_5'] == '' || $excelrow['DETAILS_5'] == null) 
                {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,$excelrow['QUESTION_5']);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,$excelrow['QUESTION_5'].'  ('.$excelrow['DETAILS_5'].')');
                } 
                
                if($excelrow['WORK_ARRANGEMENT'] == 'SWF' )
                {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row,'Skeletal Work Force');
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row,'Alternate Work Arrangement');
                } 
                

                $objPHPExcel->getActiveSheet()->getStyle('B'.$row.':B'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':D'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row.':F'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row.':G'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row.':H'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('I'.$row.':I'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('J'.$row.':J'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 
                $objPHPExcel->getActiveSheet()->getStyle('K'.$row.':K'.$objPHPExcel->getActiveSheet()->getHighestRow()) ->getAlignment()->setWrapText(true); 


        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':K'.$row)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':K'.$row)->applyFromArray($fontStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':K'.$row)->getAlignment() ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    
                $row++;
    }
}
      


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_healtmonitoring.xlsx');

?>