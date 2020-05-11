<?php
session_start();
$username = $_SESSION['username'];
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");


//Get Office

/* echo $_GET['user']; */
$select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
/* echo "SELECT DIVISION_C FROM tblemployee WHERE UNAME = '".$_GET['user']."'"; */

$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
/* echo $DIVISION_C; */
/* exit(); */
$select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
$rowdiv1 = mysqli_fetch_array($select_office);
$DIVISION_M = $rowdiv1['DIVISION_M'];
?>

<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/to.xlsx");
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
$id = $_GET['id'];

$pos = $_GET['pos'];
/* echo $pos;
exit(); */

$sql_q10 = mysqli_query($conn, "SELECT * from travel_order where id='$id'");

/* echo "SELECT * from travel_order where id='$id'";
exit(); */
    if (mysqli_num_rows($sql_q10)>0) {
    $row = 10;
    while($excelrow= mysqli_fetch_assoc($sql_q10) ) 
    {

        $id=$excelrow['id'];
        $tono = $excelrow['tono'];
        $date1 = $excelrow['date'];
        $date = date('F d, Y', strtotime($date1));
       /*  echo $date;
        exit(); */
        $office = $excelrow['office'];
        $name = $excelrow['name'];
        $purpose = $excelrow['purpose'];
        $place = $excelrow['place'];
        $fromplace = $excelrow['fromplace'];
        $todate1 = $excelrow['todate'];
        $todate = date('F d, Y', strtotime($todate1));
    
        $timefrom1 = $excelrow['timefrom'];
        $timefrom=  date("g A",strtotime($timefrom1));

        $timeto1 = $excelrow['timeto'];
        $timeto=  date("g A",strtotime($timeto1));
        $uc = $excelrow['uc'];

        $submitteddate1 = $excelrow['submitteddate'];
        $submitteddate = date('F d, Y', strtotime($submitteddate1));


        $receiveddate1 = $excelrow['receiveddate'];
        $receiveddate = date('F d, Y', strtotime($receiveddate1));
      
        $status=$row['status'];
        $contact=$excelrow['contact'];
        $vehicle=$excelrow['vehicle'];


       
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G9',$date);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G11',$tono);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B14',$name);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E14',$pos);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B17',$fromplace);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E17',$place);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B20',$contact);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D22',$todate.'  '.$timefrom);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D23',$todate.'  '.$timeto);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B28',$vehicle);
        

        //Person Incharge
        /* code to follow */

        if($DIVISION_C==1){

            $objPHPExcel->setActiveSheetIndex()->setCellValue('B41','Noel R. Bartolabac');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B42','ASST. REGIONAL DIRECTOR');
            }
            
            else if($DIVISION_C==18){
            
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B41','Gilberto L. Tumamac');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B42','OIC - LGMED Chief');
            }
            
            else if($DIVISION_C==17){
            
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B41','Jay-ar T. Beltran');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B42','OIC - LGCDD Chief');
            }
            
            else if($DIVISION_C==10){
            
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B41','Dr. Carina S. Cruz');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B42','Chief, FAD');
            }
            else{
            
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B41','');
            $objPHPExcel->setActiveSheetIndex()->setCellValue('B42','');
            }
      
    
    }
  }





  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  header('location: to_export.xlsx');

?>