<?php
require('html_table.php');
require('rpdf.php');

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4');
// $pdf->AddPage('L');
$pdf->Ln();
$pdf->SetFont('times', '', 6);
$text = 'sample text here';

// $pdf->WriteHTML(0,10,'Civil Service <br> Form No. 48',0,1);
$html='
<table cellspacing="0" cellpadding="1" border="1" width = "40%">
<tr height="50" align="center">

<td width="100" rowspan=""><b>Emp No</b></td>
<td width="100"><b>Employee Name</b></td>
<td width="80"><b>Office</b></td>
<td width="100"><b>Position</b></td>
<td width="47"><b>Pay Period</b></td>

</tr>

<tr align="center">

<td width="100" rowspan="">F-123567</td>
<td width="100">$full_name</td>
<td width="80">$station</td>
<td width="100">$position</td>
<td width="47">$date_loan</td>

</tr>

<tr align="center">
<td width="100" rowspan=""><b>Earnings</b></td>
<td width="100" ><b>Net Pay (Break Down)</b></td>
<td  width="227" ><b>Deduction</b></td>

</tr>

<tr>

<td width="50" style="text-align:center;">cell </td>
<td width="50" valign="middle">cell </td>
<td width="50" valign="middle">cell </td>
<td width="50" valign="middle">cell </td>
<td width="150">'.$text.' 1</td>
<td width="77">'.$text.' 1</td>

</tr>
</table>

';



// for($i=1;$i<=40;$i++){
$pdf->WriteHTML($html);
// }
$pdf->Output();
?>