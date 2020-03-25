<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
date_default_timezone_set('Asia/Manila');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
  //Page header
  public function Header() {
    // Logo
    $image_file = K_PATH_IMAGES.'D2.jpg';
    $this->Image($image_file, 80,5, 50, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->SetFont('Times', 'B', 20);
    // Title
    //  $this->Ln(5);
    // $this->Cell(192, 15, 'Mark Anthony Dalope       ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(15);
    // $this->Cell(0, 15, 'DENTAL CLINIC ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(8);
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
$pdf->SetAuthor('DILG REGION-IV A');
$pdf->SetTitle('DILG REGION-IV A');
$pdf->SetSubject('DILG REGION-IV A');
$pdf->SetKeywords('DILG REGION-IV A');
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->setPrintFooter(false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// add a page
$pdf->AddPage();

      $id = $_GET['id'];
      $conn=mysqli_connect('localhost','fascalab_2020','','midterm_zamora');  
      $sql = "SELECT CONCAT( customerFN, ' ', customerLN ) AS firstlast,customerAddress,contact,email FROM customer WHERE customerID = '$id'";
      $result = mysqli_query($conn, $sql);
      $get = mysqli_fetch_array($result);
      $NAME = $get['firstlast'];
      $ADDRESS = $get['customerAddress'];
      $CONTACT = $get['contact'];
      $EMAIL = $get['email'];

$pdf->SetFont('Times','B',9);
$pdf->WriteHTMLCell(50,0,'','',"<i>DENTAL RECORD DETAILS:</i>",0,0);
$pdf->Ln();

$pdf->SetFont('Times','B',9);
$pdf->WriteHTMLCell(30,0,'','',"<b>PATIENT NAME:</b>",0,0);
$pdf->SetFont('Times','',9);
$pdf->WriteHTMLCell(35,0,'','',$NAME,0,0);
$pdf->WriteHTMLCell(24,0,'','',"",0,0);

$pdf->WriteHTMLCell(14,0,'','',"",0,0);
$pdf->SetFont('Times','B',9);
$pdf->WriteHTMLCell(20,0,'','',"<b>ADDRESS:</b>",0,0);
$pdf->SetFont('Times','',9);
$pdf->MultiCell(40, 5, $ADDRESS, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();

$pdf->SetFont('Times','B',9);
$pdf->WriteHTMLCell(20,0,'','',"<b>CONTACT:</b>",0,0);
$pdf->SetFont('Times','',9);
$pdf->WriteHTMLCell(26,0,'','',$CONTACT,0,0);
$pdf->SetFont('Times','B',9);
$pdf->WriteHTMLCell(15,0,'','',"<b>EMAIL:</b>",0,0);
$pdf->SetFont('Times','',9);
$pdf->WriteHTMLCell(47  ,0,'','',$EMAIL,0,0);

function fetch_data()  
 {  
      $output = '';  
      $id = $_GET['id'];
      $conn=mysqli_connect('localhost','fascalab_2020','','midterm_zamora');  
      $sql = "SELECT * FROM purchase WHERE visitID = '$id'";
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
    $problem = $row["problem"];  
    $findings = $row["findings"]; 
      $output .= '
      <tr  >  
                          <td>'.$row["problem"].'</td>  
                           <td>'.$row["findings"].'</td>  
                            <td>'.$row["dateVisit"].'</td>  
                         
      </tr>  
                          ';  
      }  
      
      return $output;  
 }  
 $content = '<i><h4>PATIENT HISTORY</h4></i>
<table border="1" cellspacing="0" cellpadding="5"align="">  
<tr>  
    <th align="Center"><b>PROBLEM</b></th>
    <th align="Center"><b>FINDINGS</b></th>
    <th align=""><b>Date</b></th>
</tr> 
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $pdf->writeHTML($content);  

$pdf->Output();