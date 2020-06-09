
<?php

session_start();
$username = $_SESSION['username'];
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
//Get Office
$select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeinfo WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
//echo $DIVISION_C;
$select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
$rowdiv1 = mysqli_fetch_array($select_office);
$DIVISION_M = $rowdiv1['DIVISION_M'];
?>
<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/OfficialBusinessExport.xlsx");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT obno,date,name,purpose,place,obdate,timefrom,timeto,uc  FROM ob WHERE id = '$id' ");
while ($excelrow = mysqli_fetch_assoc($sql))
{


$obno = $excelrow['obno'];
$date1 = $excelrow['date'];
$date = date('F d, Y', strtotime($date1));
$office = $excelrow['office'];
$name = $excelrow['name'];
$purpose = $excelrow['purpose'];
$place = $excelrow['place'];
$obdate1 = $excelrow['obdate'];
$obdate = date('F d, Y', strtotime($obdate1));
$timefrom1 = $excelrow['timefrom'];
$timeto1 = $excelrow['timeto'];
$uc = $excelrow['uc'];

/* Personnel copy */
$objPHPExcel->setActiveSheetIndex()->setCellValue('J12',$obno);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J13',$date);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F16',$name);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C17',$purpose);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D19',$place);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D21',$obdate);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K19',$timefrom1);

if($uc==1){
$objPHPExcel->setActiveSheetIndex()->setCellValue('K21','UC');
}
else{
$objPHPExcel->setActiveSheetIndex()->setCellValue('K21',$timeto1);

}


$objPHPExcel->setActiveSheetIndex()->setCellValue('I26',$name);

if($DIVISION_C==1){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I33','Noel R. Bartolabac');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I34','ASST. REGIONAL DIRECTOR');
}

else if($DIVISION_C==18){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I33','Gilberto L. Tumamac');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I34','OIC - LGMED Chief');
}

else if($DIVISION_C==17){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I33','Jay-ar T. Beltran');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I34','OIC - LGCDD Chief');
}

else if($DIVISION_C==10){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I33','Dr. Carina S. Cruz');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I34','CAO/FAD-Chief');
}
else{

$objPHPExcel->setActiveSheetIndex()->setCellValue('I33','');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I34','');
}

// "--------------------------------------------------------------------"

/* Employees copy */

$objPHPExcel->setActiveSheetIndex()->setCellValue('J49',$obno);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J50',$date);

$objPHPExcel->setActiveSheetIndex()->setCellValue('F53',$name);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C54',$purpose);


$objPHPExcel->setActiveSheetIndex()->setCellValue('D56',$place);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D58',$obdate);


$objPHPExcel->setActiveSheetIndex()->setCellValue('K56',$timefrom1);
if($uc==1){
$objPHPExcel->setActiveSheetIndex()->setCellValue('K58','UC');

}
else{
$objPHPExcel->setActiveSheetIndex()->setCellValue('K58',$timeto1);

}

$objPHPExcel->setActiveSheetIndex()->setCellValue('I63',$name);

if($DIVISION_C==1){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I71','Noel R. Bartolabac');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I72','ASST. REGIONAL DIRECTOR');
}

else if($DIVISION_C==18){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I70','Gilberto L. Tumamac');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I71','OIC - LGMED Chief');
}

else if($DIVISION_C==17){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I70','Jay-ar T. Beltran');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I71','OIC - LGCDD Chief');
}

else if($DIVISION_C==10){

$objPHPExcel->setActiveSheetIndex()->setCellValue('I70','Dr. Carina S. Cruz');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I71','CAO/FAD-Chief');
}
else{

$objPHPExcel->setActiveSheetIndex()->setCellValue('I70','');
$objPHPExcel->setActiveSheetIndex()->setCellValue('I71','');
}


}


$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('_includes/check.jpg');
$objDrawing->setCoordinates('B30');
//setOffsetX works properly
$objDrawing->setOffsetX(15); 
$objDrawing->setOffsetY(0);
//set width, height
$objDrawing->setWidth(30.5); 
$objDrawing->setHeight(30.5);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 



$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('_includes/check.jpg');
$objDrawing->setCoordinates('D30');
//setOffsetX works properly
$objDrawing->setOffsetX(15); 
$objDrawing->setOffsetY(0);
//set width, height
$objDrawing->setWidth(30.5); 
$objDrawing->setHeight(30.5);$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('_includes/check.jpg');
$objDrawing->setCoordinates('B67');
//setOffsetX works properly
$objDrawing->setOffsetX(15); 
$objDrawing->setOffsetY(0);
//set width, height
$objDrawing->setWidth(30.5); 
$objDrawing->setHeight(30.5);$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('test_img');
$objDrawing->setDescription('test_img');
$objDrawing->setPath('_includes/check.jpg');
$objDrawing->setCoordinates('D67');
//setOffsetX works properly
$objDrawing->setOffsetX(15); 
$objDrawing->setOffsetY(0);
//set width, height
$objDrawing->setWidth(30.5); 
$objDrawing->setHeight(30.5);$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 


//Set Password
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

$objPHPExcel->getActiveSheet()->getProtection()->setPassword('fas2020');


 


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: OfficialBusinessExport.xlsx');

?>