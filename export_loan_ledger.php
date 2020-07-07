<?php
ob_start();
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_loan_ledger.xlsx");

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
$station = $_GET['station'];


$objPHPExcel->setActiveSheetIndex()->setCellValue('A1',$station."  -  PAYROLL");
$objPHPExcel->setActiveSheetIndex()->setCellValue('A2',$date_loan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Y4',$date_loan." 1        -15 Salary");
$objPHPExcel->setActiveSheetIndex()->setCellValue('Z4',$date_loan." 16        -30 Salary");
$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Salary for the month of ".$date_loan);


$sql = mysqli_query($conn, "SELECT tds.id,te.full_name,te.m_name,te.f_name,te.l_name,te.station,te.designation,td.monthly_salary,td.bir,td.rlip,td.philhealth,td.pera,td.rata,td.pagibig_premium,td.pagibig_mp2,tds.consolidated_loan,tds.optional_premium,tds.optional_policy_loan,tds.rel,tds.policy_regular_loan,tds.educational_assistance_loan,tds.emergency_calamity_loan,tds.multi_purpose_loan,tds.pag_ibig_housing,tds.calamity_loan,tds.amswlai,tds.credit_union,tds.national_home FROM  tbl_employee te  LEFT JOIN  tbl_deduction_loans_history tds on tds.emp_no = te.emp_no LEFT JOIN tbl_deductions td on td.emp_no = tds.emp_no WHERE tds.date_loan = '$date_loan' AND tds.station ='$station' AND te.status = 0 ORDER BY te.l_name ASC");

$row = 8;
$rowA = 14;
$rowB = 15;
$rowC = 16;
$rowD = 17;
$rowE = 18;
while($excelrow = mysqli_fetch_assoc($sql) ){

  $policy_regular_loan = $excelrow['policy_regular_loan'];
  $optional_policy_loan = $excelrow['optional_policy_loan'];
  $educational_assistance_loan = $excelrow['educational_assistance_loan'];
  $rel = $excelrow['rel'];
  $salary = $excelrow['monthly_salary'];
  $bir = $excelrow['bir'];
  $rlip = $excelrow['rlip'];
  $optional_premium = $excelrow['optional_premium'];
  $consolidated_loan = $excelrow['consolidated_loan'];
  $emergency_calamity_loan = $excelrow['emergency_calamity_loan'];
  $calamity_loan = $excelrow['calamity_loan'];
  $pagibig_mp2 = $excelrow['pagibig_mp2'];
  $pagibig_premium = $excelrow['pagibig_premium'];
  $multi_purpose_loan = $excelrow['multi_purpose_loan'];
  $pag_ibig_housing = $excelrow['pag_ibig_housing'];
  $philhealth = $excelrow['philhealth'];
  $amswlai = $excelrow['amswlai'];
  $credit_union = $excelrow['credit_union'];
  $national_home = $excelrow['national_home'];

  $l_name = $excelrow['l_name'];
  $f_name = $excelrow['f_name'];
  $m_name = $excelrow['m_name'];

  $fullName = $l_name . ' ' .",".' '. $f_name . ' ' . $m_name;

  $PLoan = $policy_regular_loan + $optional_policy_loan;
  $REAL = $educational_assistance_loan + $rel;
  $Tots = $calamity_loan + $emergency_calamity_loan;

  $total_deduction = $bir + $rlip + $optional_premium + $pagibig_premium + $consolidated_loan + $PLoan + $REAL + $emergency_calamity_loan + $calamity_loan + $pagibig_mp2 + $multi_purpose_loan + $pag_ibig_housing + $philhealth + $amswlai + $credit_union  + $national_home ;
  // (td.bir + td.rlip + td.philhealth + td.pagibig_premium + td.pagibig_premium + td.pagibig_mp2 + tds.consolidated_loan + tds.optional_premium + tds.optional_policy_loan + tds.rel + tds.policy_regular_loan + tds.educational_assistance_loan + tds.emergency_calamity_loan + tds.multi_purpose_loan + tds.pag_ibig_housing + tds.calamity_loan + tds.amswlai + tds.credit_union + tds.national_home )

  $net_pay = $salary - $total_deduction;

  $divNet = $net_pay / 2;


  

  $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,$fullName);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$excelrow['designation']);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$salary);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$salary);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$bir);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$rlip);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$optional_premium);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$consolidated_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$policy_regular_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$optional_policy_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$educational_assistance_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$rel);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,$emergency_calamity_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$row,$pagibig_premium);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$row,$calamity_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$row,$pagibig_mp2);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$row,$multi_purpose_loan);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$row,$pag_ibig_housing);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('S'.$row,$philhealth);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('T'.$row,$amswlai);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('U'.$row,$credit_union);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('V'.$row,$national_home);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('W'.$row,$total_deduction);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('X'.$row,$net_pay);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('Y'.$row,$divNet);
  $objPHPExcel->setActiveSheetIndex()->setCellValue('Z'.$row,$divNet);

  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);




  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleRight);


  $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('U'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('U'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('U'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('U'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('V'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('V'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('V'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('V'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('W'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('W'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('W'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('W'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('X'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('X'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('X'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('X'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('Y'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('Y'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('Y'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('Y'.$row)->applyFromArray($styleRight);

  $objPHPExcel->getActiveSheet()->getStyle('Z'.$row)->applyFromArray($stylebottom);
  $objPHPExcel->getActiveSheet()->getStyle('Z'.$row)->applyFromArray($styleTop);
  $objPHPExcel->getActiveSheet()->getStyle('Z'.$row)->applyFromArray($styleLeft);
  $objPHPExcel->getActiveSheet()->getStyle('Z'.$row)->applyFromArray($styleRight);

  

  $row++;
  $rowA++;
  $rowB++;
  $rowC++;
  $rowD++;
  $rowE++;
}

$sql2 = mysqli_query($conn, "SELECT tds.id,te.full_name,te.station,te.designation,sum(td.monthly_salary) as STotal,sum(td.bir) as TBIR,sum(td.rlip) as TRLIP,sum(td.philhealth) as THEALTH,td.pera,td.rata, sum(td.pagibig_premium) as pagibig_premium ,sum(td.pagibig_mp2) as TMP2,sum(tds.consolidated_loan) as TConsloan,sum(tds.optional_premium) as TOP,sum(tds.optional_policy_loan) as optional_policy_loan,sum(tds.rel) as rel,sum(tds.policy_regular_loan) as policy_regular_loan,sum(tds.educational_assistance_loan) as educational_assistance_loan,sum(tds.emergency_calamity_loan) as TEmergencyLoan,sum(tds.multi_purpose_loan) as TMPL,sum(tds.pag_ibig_housing) as THousing,sum(tds.calamity_loan) as calamity_loan,sum(tds.amswlai) as TAMS,sum(tds.credit_union) as TUnion,sum(tds.national_home) as THome,
  sum(td.bir + td.rlip + td.philhealth + td.pagibig_premium + td.pagibig_premium + td.pagibig_mp2 + tds.consolidated_loan + tds.optional_premium + tds.optional_policy_loan + tds.rel + tds.policy_regular_loan + tds.educational_assistance_loan + tds.emergency_calamity_loan + tds.multi_purpose_loan + tds.pag_ibig_housing + tds.calamity_loan + tds.amswlai + tds.credit_union + tds.national_home ) as Total_D FROM tbl_deduction_loans_history tds LEFT JOIN tbl_employee te on te.emp_no = tds.emp_no LEFT JOIN tbl_deductions td on td.emp_no = tds.emp_no WHERE tds.date_loan = '$date_loan' AND tds.station ='$station' ");


// $sql2 = mysqli_query($conn, "SELECT tds.id,te.full_name,te.station,te.designation,sum(td.monthly_salary) as STotal,sum(td.bir) as TBIR,sum(td.rlip) as TRLIP,sum(td.philhealth) as THEALTH,td.pera,td.rata, sum(td.pagibig_premium) as pagibig_premium ,sum(td.pagibig_mp2) as TMP2,sum(tds.consolidated_loan) as TConsloan,sum(tds.optional_premium) as TOP,sum(tds.optional_policy_loan) as optional_policy_loan,sum(tds.rel) as rel,sum(tds.policy_regular_loan) as policy_regular_loan,sum(tds.educational_assistance_loan) as educational_assistance_loan,sum(tds.emergency_calamity_loan) as TEmergencyLoan,sum(tds.multi_purpose_loan) as TMPL,sum(tds.pag_ibig_housing) as THousing,sum(tds.calamity_loan) as calamity_loan,sum(tds.amswlai) as TAMS,sum(tds.credit_union) as TUnion,sum(tds.national_home) as THome,
//   sum(td.bir + td.rlip + td.philhealth + td.pagibig_premium +td.pagibig_mp2 + tds.consolidated_loan + tds.optional_premium + tds.optional_policy_loan + tds.rel + tds.policy_regular_loan + tds.educational_assistance_loan + tds.emergency_calamity_loan + tds.multi_purpose_loan + tds.pag_ibig_housing + tds.calamity_loan + tds.amswlai + tds.credit_union + tds.national_home ) as Total_D FROM tbl_deduction_loans_history tds LEFT JOIN tbl_employee te on te.emp_no = tds.emp_no LEFT JOIN tbl_deductions td on td.emp_no = tds.emp_no WHERE tds.date_loan = '$date_loan' AND tds.station ='$station' ");



// sum(TBIR+TRLIP+THEALTH+TMP2+TConsloan+TOP+TOPL+TREL+TPRL+TEAL+TEmergencyLoan+TMPL+THousing+TCL+TAMS+TUnion+THome) as Total_D

$RW = mysqli_fetch_array($sql2);
$STotal = $RW['STotal'];
$TBIR = $RW['TBIR'];
$TRLIP = $RW['TRLIP'];
$TOP = $RW['TOP'];
$TConsloan = $RW['TConsloan'];
$Tpolicy_regular_loan = $RW['policy_regular_loan'];
$Toptional_policy_loan = $RW['optional_policy_loan'];
$Teducational_assistance_loan = $RW['educational_assistance_loan'];
$Trel = $RW['rel'];
$TEmergencyLoan = $RW['TEmergencyLoan'];
$Tcalamity_loan = $RW['calamity_loan'];
$TMP2 = $RW['TMP2'];
$Tpagibig_premium = $RW['pagibig_premium'];
$TMPL = $RW['TMPL'];
$THousing = $RW['THousing'];
$THEALTH = $RW['THEALTH'];
$TAMS = $RW['TAMS'];
$TUnion = $RW['TUnion'];
$THome = $RW['THome'];
$Total_D = $RW['Total_D'];

$Total1 = $TPRL + $TOPL;
$Total2= $TEAL + $TREL;
// $Total3= $TEmergencyLoan + $TCL;
$TotalNet = $STotal - $Total_D;
$TotalSal1 = $TotalNet / 2;
$TotalSal2 = $TotalNet / 2 ;




$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,"GRAND TOTAL:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$STotal);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,$STotal);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,$TBIR);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,$TRLIP);
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$TOP);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,$TConsloan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,$Tpolicy_regular_loan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,$Toptional_policy_loan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,$Teducational_assistance_loan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,$Trel);

$objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,$TEmergencyLoan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$row,$Tpagibig_premium);
$objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$row,$Tcalamity_loan);
$objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$row,$TMP2);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$row,$TMPL);
$objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$row,$THousing);
$objPHPExcel->setActiveSheetIndex()->setCellValue('S'.$row,$THEALTH);
$objPHPExcel->setActiveSheetIndex()->setCellValue('T'.$row,$TAMS);
$objPHPExcel->setActiveSheetIndex()->setCellValue('U'.$row,$TUnion);
$objPHPExcel->setActiveSheetIndex()->setCellValue('V'.$row,$THome);
$objPHPExcel->setActiveSheetIndex()->setCellValue('W'.$row,$Total_D);
$objPHPExcel->setActiveSheetIndex()->setCellValue('X'.$row,$RW['STotal'] - $RW['Total_D']);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Y'.$row,$TotalSal1);
$objPHPExcel->setActiveSheetIndex()->setCellValue('Z'.$row,$TotalSal2);

$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowA,"Certified Correct:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowB,"Dr. CARINA S. CRUZ");
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$rowC,"CAO/CHIEF-FAD");

$objPHPExcel->getActiveSheet()->getStyle('E'.$rowA)->applyFromArray($styleLabel1);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowB)->applyFromArray($styleHeader);
$objPHPExcel->getActiveSheet()->getStyle('E'.$rowC)->applyFromArray($styleLabel);

$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowA,"Funds Available:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowB,"RESTITUTO B. NAÑEZ III");
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$rowC,"Regional Accountant");

$objPHPExcel->getActiveSheet()->getStyle('H'.$rowA)->applyFromArray($styleLabel1);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowB)->applyFromArray($styleHeader);
$objPHPExcel->getActiveSheet()->getStyle('H'.$rowC)->applyFromArray($styleLabel);


$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$rowA,"Approved for Payment:");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$rowB,"ELIAS F. FERNANDEZ JR.");
$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$rowC,"OIC - Regional Director");

$objPHPExcel->getActiveSheet()->getStyle('K'.$rowA)->applyFromArray($styleLabel1);
$objPHPExcel->getActiveSheet()->getStyle('K'.$rowB)->applyFromArray($styleHeader);
$objPHPExcel->getActiveSheet()->getStyle('K'.$rowC)->applyFromArray($styleLabel);


// if (mysqli_num_rows($sql_items)<10) {

//  $counter++;

//  $z=15;
//  for($i=0; $i<$z; $i++){
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('S'.$row,'');
//   $objPHPExcel->setActiveSheetIndex()->setCellValue('T'.$row,'');



//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('I'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('J'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('K'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('L'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('M'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('N'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('O'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('P'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('Q'.$row)->applyFromArray($styleRight);


//   $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('R'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('S'.$row)->applyFromArray($styleRight);

//   $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($stylebottom);
//   $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($styleTop);
//   $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($styleLeft);
//   $objPHPExcel->getActiveSheet()->getStyle('T'.$row)->applyFromArray($styleRight);

//   $row++;
//   $rowA++;
//   $rowB++;
//   $rowC++;
//   $rowD++;
//   $rowE++;
// }


// }

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_loan_ledger.xlsx');
ob_end_flush();

?>