<?php
require('html_table.php');

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln();
$pdf->SetFont('Times','',11);
$pdf->WriteHTML('Civil Service <br> Form No. 48');
$pdf->Ln();
$pdf->SetFont('Times','B',11);
$pdf->Cell(185,10,'CHARLES ADRIAN T ODI',0,0,'C');
$pdf->Ln(20);
$pdf->SetFont('Times','',11);
$pdf->WriteHTML('Civil Service <br> Form No. 48');
$pdf->Ln();
// $pdf->WriteHTML(0,10,'Civil Service <br> Form No. 48',0,1);
$html='<table border="1">
<tr>
<td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">cell </td><td width="200" height="30">cell 4</td>
</tr>
</table>';

for($i=1;$i<=40;$i++){
$pdf->WriteHTML($html);
}
$pdf->Output();
?>