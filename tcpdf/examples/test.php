<?php
// require_once('tcpdf/config/lang/eng.php');
// require_once('tcpdf/tcpdf.php');
require_once('tcpdf_include.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dario Balas');
$pdf->SetTitle('PDF');
$pdf->SetSubject('PDF');
$pdf->SetKeywords('PDF');
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
// $pdf->setLanguageArray($l);
// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// Set some content to print
$tbl_header = '<table border="1">';
$tbl_footer = '</table>';
$tbl ='';
$con=mysqli_connect("localhost","fascalab_2020","","loop");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT FLAGAS, URL, ROUTING_N, ROUTED_TO, ROUTED_FROM, concat(FIRST_M,' ', LAST_M) as NAME, UNAME, ACTION, REMARKS, DATE_ROUTED, TIME_ROUTED
                                     from tblrouting
                                    left join tblemployee on tblrouting.SENDER_M=tblemployee.EMP_N
                                     where RECORD_N='".$_GET['id']."'
                                     ORDER BY ROUTING_N DESC");
while($row = mysqli_fetch_array($result))
  {
  $id = $row['ROUTED_TO'];
  if ($id == 1) {
   $id ="ORD";
  }
  if ($id == 24) {
   $id ="FAD-BAC";
  }
  if ($id == 3) {
   $id ="ORD-LEGAL";
  }
   if ($id == 23) {
   $id ="DILG RIZAL";
  }
  $key = $row['ROUTED_FROM'];
$tbl = '<tr><td>'.$id.'</td><td>'.$key.'</td></tr>';

$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
}
// Print text using writeHTMLCell()
// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('', 'I');
//====+
// END OF FILE
//====+
?>