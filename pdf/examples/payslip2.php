<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
  //Page header
  public function Header() {
    // Logo
    // $image_file = K_PATH_IMAGES.'dilg logo.png';
    // $this->Image($image_file, 30, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    // $this->SetFont('Times', 'B', 15);
    // Title
    // $this->Cell(115, 15, 'DILG IV -A ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(8);
    // $this->Cell(0, 15, 'PAYSLIP', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(8);
    // $this->Cell(0, 15, 'Region IV-A (CALABARZON) ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(8);
    // $this->Ln(8);
    // $this->Cell(0, 15, 'ROUTING SLIP ', 0, false, 'C', 0, '', 0, false, 'M', 'M');

    // $image_file1 = K_PATH_IMAGES.'iso.png';
    // $this->Image($image_file1, 150, 36, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
  }
  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('helvetica', 'I', 8);
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DILG REGION-IV A');
$pdf->SetTitle('DILG REGION-IV A');
$pdf->SetSubject('DILG REGION-IV A');
$pdf->SetKeywords('TDILG REGION-IV A');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('times', '', 6);
$pdf->AddPage('L', 'A4');
// $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
$space1 = str_repeat('&nbsp;', 5);
$space2 = str_repeat('&nbsp;', 65);
$space2a = str_repeat('&nbsp;', 75);
$space3 = str_repeat('&nbsp;', 2);
$space4 = str_repeat('&nbsp;', 3);
$space4a = str_repeat('&nbsp;', 6);
$space5 = str_repeat('&nbsp;', 5);
$space6 = str_repeat('&nbsp;', 9);
$space7 = str_repeat('&nbsp;', 80);
$space8 = str_repeat('&nbsp;', 92);
$space9 = str_repeat('&nbsp;', 87);
$space10 = str_repeat('&nbsp;', 88);
$space11 = str_repeat('&nbsp;', 76);
$space12 = str_repeat('&nbsp;', 84);
$space12 = str_repeat('&nbsp;', 93);
$space13 = str_repeat('&nbsp;', 66);
$space14 = str_repeat('&nbsp;', 88);
$space15 = str_repeat('&nbsp;', 61);
$space16 = str_repeat('&nbsp;', 65);
$space17 = str_repeat('&nbsp;', 64);
$space18 = str_repeat('&nbsp;', 69);
$space19 = str_repeat('&nbsp;', 64);
$space20 = str_repeat('&nbsp;', 90);
$space21 = str_repeat('&nbsp;', 58);
$space22 = str_repeat('&nbsp;', 66);
$space23 = str_repeat('&nbsp;', 76);
$space24 = str_repeat('&nbsp;', 91);
$space25 = str_repeat('&nbsp;', 88);
$space26 = str_repeat('&nbsp;', 93);
$space27 = str_repeat('&nbsp;', 86);

$id = $_GET['id'];
$date_loan = $_GET['date_loan'];

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$sql_items1 = mysqli_query($conn, "SELECT tds.id,te.emp_no,te.designation,te.salary,te.step,te.full_name,te.station,te.designation,td.monthly_salary,td.bir,td.rlip,td.philhealth,td.pera,td.rata,td.pagibig_premium,td.pagibig_mp2,tds.consolidated_loan,tds.optional_premium,tds.policy_regular_loan,tds.educational_assistance_loan,tds.emergency_calamity_loan,tds.multi_purpose_loan,tds.pag_ibig_housing,tds.calamity_loan,tds.amswlai,tds.credit_union,tds.national_home FROM tbl_deduction_loans_history tds LEFT JOIN tbl_employee te on te.emp_no = tds.emp_no LEFT JOIN tbl_deductions td on td.emp_no = tds.emp_no WHERE tds.date_loan = '$date_loan' and tds.id = '$id' ");

while ($row = mysqli_fetch_assoc($sql_items1)) {

// employee details
$full_name = $row['full_name'];
$emp_no = $row['emp_no'];
$position = $row['designation'];
$salary = $row['salary'];
$monthly_salary = $row['monthly_salary'];
$station = $row['station'];
//loans and deductions
$monthly_salary = number_format($row['monthly_salary'],2);
$pera = number_format($row['pera'],2);
$rata = number_format($row['rata'],2);
$bir = number_format($row['bir'],2);
$rlip = number_format($row['rlip'],2);
$pagibig_premium = number_format($row['pagibig_premium'],2);
$pagibig_mp2 = number_format($row['pagibig_mp2'],2);
$philhealth = number_format($row['philhealth'],2);
$consolidated_loan = number_format($row['consolidated_loan'],2);
$policy_regular_loan = number_format($row['policy_regular_loan'],2);
$optional_premium = number_format($row['optional_premium'],2);
$emergency_calamity_loan = number_format($row['emergency_calamity_loan'],2);
$educational_assistance_loan = number_format($row['educational_assistance_loan'],2);
$multi_purpose_loan = number_format($row['multi_purpose_loan'],2);
$calamity_loan = number_format($row['calamity_loan'],2);
$pag_ibig_housing = number_format($row['pag_ibig_housing'],2);
$credit_union = number_format($row['credit_union'],2);
$amswlai = number_format($row['amswlai'],2);
$national_home = number_format($row['national_home'],2);


$d1 = $row['bir'];
$d2 = $row['rlip'];
$d3 = $row['pagibig_premium'];
$d4 = $row['pagibig_mp2'];
$d5 = $row['philhealth'];
$d6 = $row['consolidated_loan'];
$d7 = $row['policy_regular_loan'];
$d8 = $row['optional_premium'];
$d9 = $row['emergency_calamity_loan'];
$d10 = $row['educational_assistance_loan'];
$d11 = $row['multi_purpose_loan'];
$d12 = $row['calamity_loan'];
$d13 = $row['pag_ibig_housing'];
$d14 = $row['amswlai'];
$d15 = $row['credit_union'];
$d16 = $row['national_home'];
$total_d1 = $d1 + $d2 + $d3 + $d4 + $d5 + $d6 + $d7 + $d8 + $d9 + $d10 + $d11 + $d12 + $d13 + $d14 + $d15 + $d16;
$total_d = number_format($total_d1,4);

$NET1 = $row['monthly_salary'] - $total_d1;
$half1 = $NET1 / 2;

$NET = number_format($NET1,4);
$half = number_format($half1,4);

// $sample = $full_name;
// $expl = explode(" ", $sample);
// print_r(implode("<br>", $expl)); exit();
    $image_file = K_PATH_IMAGES.'dilg logo.png';

   

$NET2 = $row['pera'] + $row['rata'] + $NET1;
$tbl = <<<EOD
<div>
<p align =''>$space8 Repubic of the Philippines $space8 $space8 $space6 $space6 $space3 $space3 $space3 $space3 $space3 Repubic of the Philippines <br>
$space2a Department of the Interior and Local Government $space2a $space2a $space6 $space6 $space3 $space3 $space3 $space3 Department of the Interior and Local Government<br>
$space2 3/F Andenson Bldg. 1, Brgy. Parian City of Calamba, Laguna $space2 $space2 $space6 $space6 $space3 $space3 $space3 $space3 3/F Andenson Bldg. 1, Brgy. Parian City of Calamba, Laguna</p>
<table cellspacing="0" cellpadding="1" border="1" width = "40%">
    <tr height="50" align="center">
        <td rowspan="5" style="-webkit-transform: rotate(7.5deg);"> $full_name</td>
        <td width="100" rowspan=""><b>Emp No</b></td>
        <td width="100"><b>Employee Name</b></td>
        <td width="80"><b>Office</b></td>
        <td width="100"><b>Position</b></td>
        <td width="47"><b>Pay Period</b></td>

        <td rowspan="5" width="40"></td>
        <td rowspan="5">$full_name</td>
        <td width="100" rowspan=""><b>Emp No</b></td>
        <td width="100"><b>Employee Name</b></td>
        <td width="80"><b>Office</b></td>
        <td width="100"><b>Position</b></td>
        <td width="47"><b>Pay Period</b></td>
    </tr>
    <tr align="center">
        <td width="100" rowspan="">$emp_no</td>
        <td>$full_name</td>
        <td>$station</td>
        <td>$position</td>
        <td>$date_loan</td>

        <td width="100" rowspan="">F-123567</td>
        <td>$full_name</td>
        <td>$station</td>
        <td>$position</td>
        <td>$date_loan</td>
    </tr>
    <tr align="center">
        <td width="100" rowspan=""><b>Earnings</b></td>
        <td><b>Net Pay (Break Down)</b></td>
        <td colspan = "3"><b>Deduction</b></td>

        <td width="100" rowspan=""><b>Earnings</b></td>
        <td><b>Net Pay (Break Down)</b></td>
        <td colspan = "3"><b>Deduction</b></td>
    </tr>
    <tr align="">
        <td width="50" rowspan=""><b>Salary<br>Deduction<br>Net Salary<br>(1-15)<br>(16-31)</b></td>
        <td width="50" align="right">$monthly_salary <br>$total_d<br>$NET<br>$half<br>$half</td>
        <td width="50"><b>PERA<br>RATA<br>(1-15)<br>(16-31)</b></td>
        <td width="50" align="right">$pera<br>$rata<br>$half<br>$half</td>
        <td width="110" align="LEFT" rowspan = "3" colspan ="5">WITHHOLDING TAX<br>GSIS PREMIUM<br>PAG-IBIG MP1 SAVINGS<br>PAG-IBIG MP2 SAVINGS<br>PHILHEALTH<br>GSIS CONSOLIDATED LOAN<br>GSIS REGULAR LOAN(REG)<br>GSIS REGULAR LOAN(OPTL)<br>GSIS EMERGENCY LOAN<br>GSIS EAL<br>PAG-IBIG CALAMITY LOAN<br>PAG-IBIG HOUSING LOAN<br>CCUI<br>AMSWLAI<br>NHMFC<br>Total</td>
        <td width="117" align="LEFT" rowspan = "3">$bir<br>$rlip<br>$pagibig_premium<br>$pagibig_mp2<br>$philhealth<br>$consolidated_loan<br>$policy_regular_loan<br>$optional_premium<br>$emergency_calamity_loan<br>$educational_assistance_loan<br>$calamity_loan<br>$pag_ibig_housing<br>$credit_union<br>$amswlai<br>$national_home<br>$total_d</td>

        <td width="50" rowspan=""><b>Salary<br>Deduction<br>Net Salary<br>(1-15)<br>(16-31)</b></td>
        <td width="50" align="right">$monthly_salary <br>$total_d<br>$NET<br>$half<br>$half</td>
        <td width="50"><b>PERA<br>RATA<br>(1-15)<br>(16-31)</b></td>
        <td width="50" align="right">$pera<br>$rata<br>$half<br>$half</td>
        <td width="110" align="LEFT" rowspan = "3" colspan ="5">WITHHOLDING TAX<br>GSIS PREMIUM<br>PAG-IBIG MP1 SAVINGS<br>PAG-IBIG MP2 SAVINGS<br>PHILHEALTH<br>GSIS CONSOLIDATED LOAN<br>GSIS REGULAR LOAN(REG)<br>GSIS REGULAR LOAN(OPTL)<br>GSIS EMERGENCY LOAN<br>GSIS EAL<br>PAG-IBIG CALAMITY LOAN<br>PAG-IBIG HOUSING LOAN<br>CCUI<br>AMSWLAI<br>NHMFC<br>Total</td>
        <td width="117" align="LEFT" rowspan = "3">$bir<br>$rlip<br>$pagibig_premium<br>$pagibig_mp2<br>$philhealth<br>$consolidated_loan<br>$policy_regular_loan<br>$optional_premium<br>$emergency_calamity_loan<br>$educational_assistance_loan<br>$calamity_loan<br>$pag_ibig_housing<br>$credit_union<br>$amswlai<br>$national_home<br>$total_d</td>
    </tr>
    <tr>
        <td colspan="4"><br><br><br><br><br><br><br><br><br><br><br></td>
    </tr>

    


</table>
</div>
EOD;
 $pdf->Image($image_file, 35, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); 

    $pdf->Image($image_file, 175, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->AddPage('L', 'A4');

}




// }

// }
//  $tbl = <<<EOD
//  <b > $space2 DILG IV-A</b><br />
//   <b > $space2a Payslip</b><br /><br />
// <table cellspacing="0" cellpadding="1" border="0" width = "400">
//   <tr>
//     <th>For the month of: $space1 September 2019</th>
//     <td style="text-align:left;"></td>
//   </tr>
//   <tr>
//     <th>Employee Number: $space1 F15846</th>
//     <td style="text-align:right;"></td>
//   </tr>
//   <tr>
//     <th>Telephone:</th>
//     <td style="text-align:right;">555 77 855</td>
//   </tr>
// </table>
// EOD;




// $pdf->writeHTML($tbl, true, false, false, false, '');





$pdf->Output();

//============================================================+
// END OF FILE
//============================================================+
