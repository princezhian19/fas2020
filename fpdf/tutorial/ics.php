<?php
require('code128.php');

$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('helvetica','',10);

$id = $_GET['id'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$query = mysqli_query($conn,"SELECT * FROM rpci WHERE id = '$id'");
$row = mysqli_fetch_array($query);
$pn = $row['stock_number'];

$pn1 = str_replace(' ', '', $pn);

$pn2 = strtolower($pn1);


//A set
$pdf->Cell(0, 0, '                                                                 DILG IV - A ICS', 0, 1);
$pdf->Code128(50,20,$pn2,80,20);
$pdf->SetXY(50,45);
// $pdf->Write(5,$pn2);



// //C set
// $code='12345678901234567890';
// $pdf->Code128(50,120,$code,110,20);
// $pdf->SetXY(50,145);
// $pdf->Write(5,'C set: "'.$code.'"');

//A,C,B sets
// $code='ABCDEFG1234567890AbCdEf';
// $pdf->Code128(50,170,$code,125,20);
// $pdf->SetXY(50,195);
// $pdf->Write(5,'ABC sets combined: "'.$code.'"');

$pdf->Output('ics_sticker.pdf', 'I');
?>