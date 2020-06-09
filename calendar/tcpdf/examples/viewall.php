<?php
session_start();
date_default_timezone_set('Asia/Manila');
$currentuser=$_SESSION['inet_credentials']['id'];

require_once('bdd.php');
$ronum = 2019-001;
$rodate1 = 2019-10-01;
$rodate2 = new DateTime($rodate1);
$rodate = $rodate2->format('M d, Y');
$robody = 'aaa';
$robody1 ='aa';
$eventid = 2;
$title = '';
$stmt = $bdd->query("SELECT * FROM events where id = '$eventid'");
while ($row = $stmt->fetch()) {

  $title = $row['title'];
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
        $image_file = K_PATH_IMAGES.'logo_dilg.jpg';
// only jpg allows in tcpdf to view header in 2nd page
		$this->Image($image_file, 138, 7, 25, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('times', 'B', 10);
		// Title
		
		$this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(30);
		$this->Cell(0, 20, 'Republic of the Philippines', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
		$this->Cell(0, 20, 'DEPARTMENT OF INTERIOR AND LOCAL GOVERNMENT', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);
		$this->SetFont('times', '', 10);	
		$this->Cell(0, 30, 'REGION IV-A CALABARZON', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(4);

		$this->Cell(0, 30, 'CALENDAR OF EVENTS 2019', 0, false, 'C', 0, '', 0, false, 'M', 'M');

		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DILG REGION IV-A CALABARZON');
$pdf->SetTitle('Calendar of Events');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25, 55, 25, 15);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, 25);



// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
// add a page
$pdf->AddPage('L');
$pdf->SetFillColor(255,255,0);




// create some HTML content
$html = '

<table border="1" style = "text-align:center;" align="center">
<thead>
<tr>
<th bgcolor="#B0BEC5" style = "font-weight:bold;width:5%;padding:50px;">No.</th>
<th bgcolor="#B0BEC5" style = "font-weight:bold;width:15%;padding:10px;">Title</th>
<th bgcolor="#B0BEC5" style = "font-weight:bold;width:15%;padding:50px;">Start Date</th>
<th bgcolor="#B0BEC5" style = "font-weight:bold;width:15%;padding:50px;">End Date</th>

<th bgcolor="#B0BEC5" style = "font-weight:bold;width:15%;padding:10px;">Venue</th>
<th bgcolor="#B0BEC5" style = "font-weight:bold;padding:10px;">No. of Participants</th>
<th bgcolor="#B0BEC5" style = "font-weight:bold;width:15%;padding:10px;">Target Participants</th>
<th bgcolor="#B0BEC5" style = "font-weight:bold;width:9%;padding:10px;">Posted By</th>
</tr>
</thead>
';



    $stmt5 = $bdd->query("SELECT * FROM events inner join tblemployeeinfo ON events.postedby = tblemployeeinfo.emp_n  ");
    $count = 1;
	while ($row5 = $stmt5->fetch()) {
        $postedby = $row5['UNAME'];

        if(strtotime($row5['end'])== strtotime('0000-00-00 00:00:00')){
            $enddate = '';
                 
                 }else{
                   $enddate = date("M d, Y",strtotime($row5['end']));
                 }
                 if(strtotime($row5['start'])== strtotime('0000-00-00 00:00:00')){
                    $startdate = '';
                         
                         }else{
                           $startdate = date("M d, Y",strtotime($row5['start']));
                         }



$html .='<tr nobr="true">
            <td style = "text-align:center;width:5%;">'.$count++.'</td>
            <td style = "text-align:center;width:15%;">'.$row5['title'].'</td>
            <td style = "text-align:center;width:15%;">'.$startdate.'</td>            
            <td style = "text-align:center;width:15%;">'.$enddate.'</td>
            <td style = "text-align:center;width:15%;">'.$row5['venue'].'</td>
            <td style = "text-align:center;">'.$row5['enp'].' participants</td>
            <td style = "text-align:center;width:15%;">'.$row5['remarks'].'</td>
            <td style = "text-align:center;width:9%;">'.$postedby.'</td>



            






</tr>';
		}








$html .='
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+


