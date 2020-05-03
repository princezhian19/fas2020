<?php 
session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];





}
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

  //Get Office
$select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
//echo $DIVISION_C;

$select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
$rowdiv1 = mysqli_fetch_array($select_office);
$DIVISION_M = $rowdiv1['DIVISION_M'];

//echo $DIVISION_M;

// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';

$id = $_GET['id'];


?>


<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/ob.xlsx");

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

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

 $styleLabel = array('font'  => array('size'  => 11, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));






$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$sql = mysqli_query($conn, "SELECT * FROM ob WHERE id = '$id' ");

/* echo "SELECT * FROM ob WHERE id = '$id' ";
exit();
 */

while ($row = mysqli_fetch_assoc($sql)) {

  $id=$row['id'];
  $obno = $row['obno'];
  $date1 = $row['date'];
  $date = date('F d, Y', strtotime($date1));
  $office = $row['office'];
  $name = $row['name'];
  $purpose = $row['purpose'];
  $place = $row['place'];
  
  $obdate1 = $row['obdate'];
  $obdate = date('F d, Y', strtotime($obdate1));
  
  $timefrom1 = $row['timefrom'];
  $timefrom=  date("H:i",$timefrom1);


  $timeto1 = $row['timeto'];
  $timeto=  date("H:i",$timeto1);

 
  $uc = $row['uc'];

  $submitteddate = date('F d, Y', strtotime($submitteddate1));


  $receiveddate1 = $row['receiveddate'];
  $receiveddate = date('F d, Y', strtotime($receiveddate1));


}



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

$objPHPExcel->setActiveSheetIndex()->setCellValue('J50',$obno);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J51',$date);

$objPHPExcel->setActiveSheetIndex()->setCellValue('F54',$name);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C55',$purpose);


$objPHPExcel->setActiveSheetIndex()->setCellValue('D57',$place);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D59',$obdate);


$objPHPExcel->setActiveSheetIndex()->setCellValue('K57',$timefrom1);
if($uc==1){
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K59','UC');

}
else{
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K59',$timeto1);

}




$objPHPExcel->setActiveSheetIndex()->setCellValue('I64',$name);

if($DIVISION_C==1){

  $objPHPExcel->setActiveSheetIndex()->setCellValue('I71','Noel R. Bartolabac');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I72','ASST. REGIONAL DIRECTOR');
}

else if($DIVISION_C==18){

  $objPHPExcel->setActiveSheetIndex()->setCellValue('I71','Gilberto L. Tumamac');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I72','OIC - LGMED Chief');
}

else if($DIVISION_C==17){

  $objPHPExcel->setActiveSheetIndex()->setCellValue('I71','Jay-ar T. Beltran');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I72','OIC - LGCDD Chief');
}

else if($DIVISION_C==10){

  $objPHPExcel->setActiveSheetIndex()->setCellValue('I71','Dr. Carina S. Cruz');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I72','CAO/FAD-Chief');
}
else{

  $objPHPExcel->setActiveSheetIndex()->setCellValue('I71','');
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I72','');
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
  $objDrawing->setHeight(30.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

  
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('test_img');
  $objDrawing->setDescription('test_img');
  $objDrawing->setPath('_includes/check.jpg');
  $objDrawing->setCoordinates('B68');                      
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
  $objDrawing->setCoordinates('D68');                      
//setOffsetX works properly
  $objDrawing->setOffsetX(15); 
  $objDrawing->setOffsetY(0);                
//set width, height
  $objDrawing->setWidth(30.5); 
  $objDrawing->setHeight(30.5);  
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: OfficialBusinessExport.xlsx');

?>