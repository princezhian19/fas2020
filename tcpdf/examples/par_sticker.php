<?php
require_once('tcpdf_include.php');
class MYPDF extends TCPDF {
  public function Header() {
    $this->ln(5);

  }
  public function Footer() {
    $this->SetY(-15);
    $this->SetFont('helvetica', 'I', 8);
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf = new CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
//Add a custom size  
// $width = 200;  
// $height = 100; 
// // $orientation = ($height>$width) ? 'P' : 'L';  
// // $pdf->addFormat("custom", $width, $height);  
// // $pdf->reFormat("custom", $orientation);  


// $pageLayout = array($width, $height); //  or array($height, $width) 
// $pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false);

// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('DILG REGION-IV A');
// $pdf->SetTitle('DILG REGION-IV A');
// $pdf->SetSubject('DILG REGION-IV A');
// $pdf->SetKeywords('TDILG REGION-IV A');
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// $pdf->AddPage();

$pageLayout = array( 50 , 75 );
$pdf = new TCPDF('p', 'mm', $pageLayout, true, 'UTF-8', false, true);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Par_Sticker');
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);
$pdf->SetMargins(0, 0, 0, true);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 10, '', true);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setCellHeightRatio(0.5);


 // $style = array(
 //  'position' => 'C',
 //  'align' => 'C',
 //  'stretch' => true,
 //  'fitwidth' => true,
 //  'cellfitalign' => '',
 //  'border' => false,
 //  'hpadding' => 'auto',
 //  'vpadding' => 'auto',
 //  'fgcolor' => array(0,0,0),
 //    'bgcolor' => false, //array(255,255,255),
 //    'text' => true,
 //    'font' => 'helvetica',
 //    'fontsize' => 8,
 //    'stretchtext' => 4
 //  );


    $id = $_GET['id'];
    $conn = mysqli_connect("localhost","root","","db_dilg_pmis");
    $query = mysqli_query($conn,"SELECT * FROM rpcppe WHERE id = '$id'");
    $row = mysqli_fetch_array($query);
    $pn = $row['property_number'];

    $pn1 = str_replace(' ', '', $pn);

    $pn2 = strtolower($pn1);

 //    $space1 = str_repeat('&nbsp;', 12);
 //    $pdf->Ln(10);
 //    $pdf->Rotate(90);
 //    $pdf->write1DBarcode($pn, 'C39', '', 'C', '', 50, 100, $style, 'N');

// $style = array(
//     'position' => '',
//     'align' => 'C',
//     'stretch' => true,
//     'fitwidth' => true,
//     'width' => 100,
//     'cellfitalign' => '',
//     'border' => false,
//     'hpadding' => 'auto',
//     'vpadding' => 'auto',
//     'fgcolor' => array(0,0,0),
//     'bgcolor' => false, //array(255,255,255),
//     'text' => true,
//     'font' => 'helvetica',
//     'fontsize' => 8,
//     'stretchtext' => 4
// );

// add a page
$pdf->AddPage();
$pdf->Ln(5);
$pdf->SetFillColor(255, 255, 255);

$pdf->setCellPaddings(0,0,0,0);
$pdf->setCellMargins(0, 0, 0, 0);

// $pdf->Ln();

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => '2',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

$space1 = str_repeat('&nbsp;', 5);

$pdf->Ln(45);
$pdf->Cell(0, 0, '              DILG IV - A PAR', 0, 1);
$pdf->write1DBarcode($pn2, 'C128', 'L', '', '48', 20, 0.6, $style, 'N');
// $pdf->Rotate(-60);
// $pdf->Cell(30,0,'','',"<b>Recieve Mode:</b><br/>",0,0);
// $pdf->Ln(5);
// $pdf->WriteHTMLCell(30,0,'','',"<b>Recieve Mode:</b><br/>",0,0);
// $pdf->write1DBarcode('DILG-LAPTOP-18-383', 'C39', '', '', '48', 70, 2, $style, 'N');
// $pdf->write1DBarcode('123-456-789', 'C128', '', '', '45', 60, 0.4, $style, 'N');
$pdf->Output('par_sticker.pdf', 'I');

// $pdf->Output();

//============================================================+
// END OF FILE
//============================================================+
                