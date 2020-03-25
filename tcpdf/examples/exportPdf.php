<?php
require_once('tcpdf_include.php');
date_default_timezone_set('Asia/Manila');
class MYPDF extends TCPDF {
  public function Header() {
    // $image_file = K_PATH_IMAGES.'';
    // $this->Image($image_file, 80,5, 50, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    $this->SetFont('Times', 'B', 20);
    //  $this->Ln(5);
    // $this->Cell(192, 15, 'Mark Anthony Dalope       ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(15);
    // $this->Cell(0, 15, 'DENTAL CLINIC ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    // $this->Ln(8);
  }
  public function Footer() {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}
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

      // $id = $_GET['id'];
      // $conn=mysqli_connect('localhost','root','','fascalab_2020');  
      // $sql = "SELECT * FROM old_stock ";
      // $result = mysqli_query($conn, $sql);
      // $get = mysqli_fetch_array($result);
    

// $pdf->SetFont('Times','B',9);
// $pdf->WriteHTMLCell(50,0,'','',"<i>DENTAL RECORD DETAILS:</i>",0,0);
// $pdf->Ln();

// $pdf->SetFont('Times','B',9);
// $pdf->WriteHTMLCell(30,0,'','',"<b>PATIENT NAME:</b>",0,0);
// $pdf->SetFont('Times','',9);
// $pdf->WriteHTMLCell(35,0,'','',$NAME,0,0);
// $pdf->WriteHTMLCell(24,0,'','',"",0,0);

// $pdf->WriteHTMLCell(14,0,'','',"",0,0);
// $pdf->SetFont('Times','B',9);
// $pdf->WriteHTMLCell(20,0,'','',"<b>ADDRESS:</b>",0,0);
// $pdf->SetFont('Times','',9);
// $pdf->MultiCell(40, 5, $ADDRESS, 0, 'L', 0, 0, '', '', true);
// $pdf->Ln();

// $pdf->SetFont('Times','B',9);
// $pdf->WriteHTMLCell(20,0,'','',"<b>CONTACT:</b>",0,0);
// $pdf->SetFont('Times','',9);
// $pdf->WriteHTMLCell(26,0,'','',$CONTACT,0,0);
// $pdf->SetFont('Times','B',9);
// $pdf->WriteHTMLCell(15,0,'','',"<b>EMAIL:</b>",0,0);
// $pdf->SetFont('Times','',9);
// $pdf->WriteHTMLCell(47  ,0,'','',$EMAIL,0,0);

function fetch_data()  
 {  
      $output = '';  
      // $id = $_GET['id'];
      $conn=mysqli_connect('localhost','root','','fascalab_2020');  
      $sql = "SELECT * FROM old_stock";
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '
      <tr  >  
                          <td>'.$row["code"].'</td>  
                           <td>'.$row["items"].'</td>  
                           <td>'.$row["unit"].'</td>  
                           <td>'.$row["balanceone"].'</td>  
                           <td>'.$row["one"].'</td>  
                           <td>'.$row["delivery"].'</td>  
                           <td>'.$row["avail_balance"].'</td>  
                           <td>'.$row["issue_month"].'</td>  
                           <td>'.$row["balancetwo"].'</td>  
                           <td>'.$row["two"].'</td>  
                           <td>'.$row["current_price"].'</td>  
                         
      </tr>  
                          ';  
      }  
      
      return $output;  
 }  
 $content = '<i><h4>RECORDS</h4></i>
<table border="1" cellspacing="0" cellpadding="5"align="">  
<tr>  
    <th align="Center"><b>CODE</b></th>
    <th align="Center"><b>ITEMS</b></th>
    <th align=""><b>UNIT</b></th>
    <th align=""><b>BALANCE AS OF</b></th>
    <th align=""><b></b></th>
    <th align=""><b>DELIVERY</b></th>
    <th align=""><b>AVAILABLE BALANCE</b></th>
    <th align=""><b>ISSUE FOR THE MONTH</b></th>
    <th align=""><b>BALANCE AS OF</b></th>
    <th align=""><b></b></th>
    <th align=""><b>CURRENT PRICE</b></th>
    
</tr> 
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $pdf->writeHTML($content);  

$pdf->Output();