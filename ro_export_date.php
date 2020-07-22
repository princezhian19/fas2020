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


if (isset($_POST['export'])) 
{

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$month1 = $_POST['month'];
$month = date('m', strtotime($month1));
$year = $_POST['year'];

$office = $_POST['office'];



if($office=='ALL'){
$sql_q10 = mysqli_query($conn, "SELECT * FROM ro_roo WHERE issuancedate like  '%".$year."-".$month1."%'  order by issuancedate asc" );


}
else{
$sql_q10 = mysqli_query($conn, "SELECT * FROM ro_roo WHERE issuancedate like  '%".$year."-".$month1."%' and office = '$office' order by issuancedate asc" );

}




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

$status = $excelrow['status'];
$registereddate1 = $excelrow['registereddate'];
$registereddate = date('F d, Y', strtotime($registereddate1));


$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$category);
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$issuanceno);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$issuancedate);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$title);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$office);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$registeredby);
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$registereddate);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$status);



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