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
$pdf->SetFont('times', '', 11);
$pdf->AddPage('P', 'A4');
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

$office = $_GET['office'];
$emp_status = $_GET['emp_status'];
$month = $_GET['month'];
$year = '2020';
$this_date = $year.'-'.$month;

$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
if ($emp_status == '') {
    $sql_items = mysqli_query($conn, "SELECT DISTINCT te.EMP_N FROM tblemployeeinfo te LEFT JOIN dtr on dtr.UNAME = te.UNAME WHERE te.DIVISION_C = '$office' AND dtr.date_today LIKE '%$this_date%' ");
    while ($allS = mysqli_fetch_assoc($sql_items)) {
      $EMP_N[] = $allS['EMP_N'];
  }
}else{
  $sql_items = mysqli_query($conn, "SELECT DISTINCT te.EMP_N FROM tblemployeeinfo te LEFT JOIN dtr on dtr.UNAME = te.UNAME WHERE te.DIVISION_C = '$office' AND te.ACTIVATED = '$emp_status' AND dtr.date_today LIKE '%$this_date%' ");
  while ($allS = mysqli_fetch_assoc($sql_items)) {
      $EMP_N[] = $allS['EMP_N'];
  }
}

$implode1 = implode(',', $EMP_N);

if ($emp_status == '') {
    $sql_items1 = mysqli_query($conn, "SELECT concat(te.LAST_M,',',te.FIRST_M,' ',te.MIDDLE_M) as FNAME,te.LAST_M,dtr.date_today,dtr.time_in, dtr.lunch_out,dtr.lunch_in,dtr.time_out,SUBTIME(dtr.time_out,'01:00:00') as time_out1 FROM tblemployeeinfo te LEFT JOIN dtr on dtr.UNAME = te.UNAME WHERE te.DIVISION_C = '$office' AND te.EMP_N in ($implode1) AND dtr.date_today LIKE '%$this_date%' ");
}else{
  $sql_items1 = mysqli_query($conn, "SELECT concat(te.LAST_M,',',te.FIRST_M,' ',te.MIDDLE_M) as FNAME,te.LAST_M,dtr.date_today,dtr.time_in, dtr.lunch_out,dtr.lunch_in,dtr.time_out,SUBTIME(dtr.time_out,'01:00:00') as time_out1 FROM tblemployeeinfo te LEFT JOIN dtr on dtr.UNAME = te.UNAME WHERE te.DIVISION_C = '$office' AND te.ACTIVATED = '$emp_status' AND  te.EMP_N in ($implode1) AND  dtr.date_today LIKE '%$this_date%' ");
}

while ($excelrow = mysqli_fetch_assoc($sql_items1)) {

    $date1 = $excelrow['date_today'];
    $date = date('F d, Y',strtotime($date1));
    $time_in = $excelrow['time_in'];
    $lunch_in = $excelrow['lunch_in'];
    $lunch_out = $excelrow['lunch_out'];
    $time_out = $excelrow['time_out'];
    $time_out1 = $excelrow['time_out1'];


    $tbl = <<<EOD
    <p align =''>$space8 Repubic of the Philippines $space8 $space8 $space6 $space6 $space3 $space3 $space3 $space3 $space3 Repubic of the Philippines <br>
    $space2a Department of the Interior and Local Government $space2a $space2a $space6 $space6 $space3 $space3 $space3 $space3 Department of the Interior and Local Government<br>
    $space2 3/F Andenson Bldg. 1, Brgy. Parian City of Calamba, Laguna $space2 $space2 $space6 $space6 $space3 $space3 $space3 $space3 3/F Andenson Bldg. 1, Brgy. Parian City of Calamba, Laguna</p>
    <table cellspacing="0" cellpadding="1" border="1" width = "40%">
    <tr height="50" align="center">
    <td width = "100" rowspan = "2"><b>Date</b></td>
    <td width = "150" colspan ="2"><b>A.M</b></td>
    <td width = "150" colspan ="2"><b>P.M</b></td>
    <td width = "150" colspan ="2"><b>Undertime</b></td>
    </tr>
    <tr align="center">
    <td>Arrival</td>
    <td>Departure</td>
    <td>Arrival</td>
    <td>Departure</td>
    <td>Hours</td>
    <td>Minutes</td>
    </tr>
    <tr align="center">
    <td>$date</td>
    <td>$time_in</td>
    <td>$lunch_in</td>
    <td>$lunch_out</td>
    <td>$time_out</td>
    <td>Minutes</td>
    <td>Minutes</td>
    </tr>
    </table>
    EOD;


    // $pdf->Image($image_file, 40, 10, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); 
    // $pdf->Image($image_file, 180, 10, 10, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    $pdf->writeHTML($tbl, true, false, false, false, '');
    $pdf->AddPage('P', 'A4');

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
