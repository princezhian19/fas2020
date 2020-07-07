<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_summary.xlsx");

$styleTop = array(
  'borders' => array(
    'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
);

$styleLeft = array(
  'borders' => array(
    'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
  ),
);

$styleRight = array(
  'borders' => array(
    'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
);

$stylebottom = array(
  'borders' => array(
    'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
  ),
);

$styleHeader = array('font'  => array('bold'  => true, 'size'  => 12, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$styleLabel = array('font'  => array('italic'  => true,'size'  => 12, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$styleLabel1 = array('font'  => array(true,'size'  => 12, 'name'  => 'Calibri'),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$date_loan = $_GET['date_loan'];


$objPHPExcel->setActiveSheetIndex()->setCellValue('B2',"for the month of ".$date_loan);

// tdl.consolidated_loan,tdl.optional_premium,tdl.policy_regular_loan,tdl.educational_assistance_loan,tdl.emergency_calamity_loan - GSIS 
// tdl.calamity_loan, tdl.multi_purpose_loan, tdl.pag_ibig_housing - PAGIBIG 
// tdl.amswlai, tdl.credit_union, tdl.national_home,  - Others

$sql = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' AND tdl.station = 'REGIONAL OFFICE' ");

$row = mysqli_fetch_array($sql);
$monthly_salary = $row['monthly_salary'];
$bir = $row['bir'];
$GSIS = $row['GSIS'];
$philhealth = $row['philhealth'];
$PAGIBIG = $row['PAGIBIG'];
$Others = $row['Others'];
$Total_D = $row['Total_D'];

$NET = $monthly_salary - $Total_D;

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C4',$date_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C5',$monthly_salary);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D5',$bir);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E5',$GSIS);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F5',$philhealth);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G5',$PAGIBIG);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H5',$Others);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I5',$Total_D);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J5',$NET);

$sql2 = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' AND tdl.station = 'BATANGAS' ");

$row2 = mysqli_fetch_array($sql2);
$monthly_salary2 = $row2['monthly_salary'];
$bir2 = $row2['bir'];
$GSIS2 = $row2['GSIS'];
$philhealth2 = $row2['philhealth'];
$PAGIBIG2 = $row2['PAGIBIG'];
$Others2 = $row2['Others'];
$Total_D2 = $row2['Total_D'];

$NET2 = $monthly_salary2 - $Total_D2;

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C6',$monthly_salary2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D6',$bir2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E6',$GSIS2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F6',$philhealth2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G6',$PAGIBIG2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H6',$Others2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I6',$Total_D2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J6',$NET2);

  $sql3 = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' AND tdl.station = 'CAVITE' ");

$row3 = mysqli_fetch_array($sql3);
$monthly_salary3 = $row3['monthly_salary'];
$bir3 = $row3['bir'];
$GSIS3 = $row3['GSIS'];
$philhealth3 = $row3['philhealth'];
$PAGIBIG3 = $row3['PAGIBIG'];
$Others3 = $row3['Others'];
$Total_D3 = $row3['Total_D'];

$NET3 = $monthly_salary3 - $Total_3;

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C7',$monthly_salary3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D7',$bir3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E7',$GSIS3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F7',$philhealth3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G7',$PAGIBIG3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H7',$Others3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I7',$Total_D3);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J7',$NET3);

  $sql4 = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' AND tdl.station = 'LAGUNA' ");

$row4 = mysqli_fetch_array($sql4);
$monthly_salary4 = $row4['monthly_salary'];
$bir4 = $row4['bir'];
$GSIS4 = $row4['GSIS'];
$philhealth4 = $row4['philhealth'];
$PAGIBIG4 = $row4['PAGIBIG'];
$Others4 = $row4['Others'];
$Total_D4 = $row4['Total_D'];

$NET4 = $monthly_salary4 - $Total_4;

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C8',$monthly_salary4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D8',$bir4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E8',$GSIS4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F8',$philhealth4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G8',$PAGIBIG4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H8',$Others4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I8',$Total_D4);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J8',$NET4);

  $sql5 = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' AND tdl.station = 'QUEZON' ");

$row5 = mysqli_fetch_array($sql5);
$monthly_salary5 = $row5['monthly_salary'];
$bir5 = $row5['bir'];
$GSIS5 = $row5['GSIS'];
$philhealth5 = $row5['philhealth'];
$PAGIBIG5 = $row5['PAGIBIG'];
$Others5 = $row5['Others'];
$Total_D5 = $row5['Total_D'];

$NET5 = $monthly_salary5 - $Total_5;

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C9',$monthly_salary5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D9',$bir5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E9',$GSIS5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F9',$philhealth5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G9',$PAGIBIG5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H9',$Others5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I9',$Total_D5);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J9',$NET5);

  $sql6 = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' AND tdl.station = 'RIZAL' ");

$row6 = mysqli_fetch_array($sql6);
$monthly_salary6 = $row6['monthly_salary'];
$bir6 = $row6['bir'];
$GSIS6 = $row6['GSIS'];
$philhealth6 = $row6['philhealth'];
$PAGIBIG6 = $row6['PAGIBIG'];
$Others6 = $row6['Others'];
$Total_D6 = $row6['Total_D'];

$NET6 = $monthly_salary6 - $Total_6;

  $objPHPExcel->setActiveSheetIndex()->setCellValue('C10',$monthly_salary6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D10',$bir6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E10',$GSIS6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F10',$philhealth6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G10',$PAGIBIG6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H10',$Others6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I10',$Total_D6);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J10',$NET6);

   $sql_TOTAL = mysqli_query($conn, "SELECT sum(td.monthly_salary) as monthly_salary,sum(td.bir) as bir,sum(td.philhealth) as philhealth,sum(tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan) as GSIS,sum(tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing) as PAGIBIG,sum(tdl.amswlai + tdl.credit_union + tdl.national_home) as Others, 
  sum(td.bir + tdl.consolidated_loan + tdl.optional_premium + tdl.policy_regular_loan + tdl.educational_assistance_loan + tdl.emergency_calamity_loan+tdl.calamity_loan + tdl.multi_purpose_loan + tdl.pag_ibig_housing+td.philhealth + tdl.amswlai + tdl.credit_union + tdl.national_home) as Total_D 
  FROM  tbl_deduction_loans_history tdl LEFT JOIN tbl_deductions td on td.emp_no = tdl.emp_no WHERE tdl.date_loan = '$date_loan' ");
   $rowW = mysqli_fetch_array($sql_TOTAL);
   $TOTAL_SAL = $rowW['monthly_salary'];
   $total_bir = $rowW['bir'];
   $total_GSIS = $rowW['GSIS'];
   $total_PAGIBIG = $rowW['PAGIBIG'];
   $total_philhealth = $rowW['philhealth'];
   $total_Others = $rowW['Others'];
   $Total_DD = $row6['Total_D'];

    $NET6 = $TOTAL_SAL - $Total_DD;




  $objPHPExcel->setActiveSheetIndex()->setCellValue('C13',$TOTAL_SAL);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D13',$total_bir);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E13',$total_GSIS);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F13',$total_PAGIBIG);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G13',$total_philhealth);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H13',$total_Others);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I13',$Total_DD);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J13',$NET6);
   


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_summary.xlsx');

?>