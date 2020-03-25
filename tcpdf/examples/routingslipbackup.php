<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

  //Page header
  public function Header() {
    // Logo
    $image_file = K_PATH_IMAGES.'dilg logo.png';
    $this->Image($image_file, 30, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Set font
    $this->SetFont('Times', 'B', 15);
    // Title

    $this->Cell(115, 15, 'Republic of the Philippines ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(8);
    $this->Cell(0, 15, '                Department of the Interior and Local Government ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(8);
    $this->Cell(0, 15, '             Region IV-A (CALABARZON) ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $this->Ln(8);
    $this->Ln(8);
    $this->Cell(0, 15, '             ROUTING SLIP ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
      
    $image_file1 = K_PATH_IMAGES.'iso.png';
    $this->Image($image_file1, 150, 36, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    
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
$pdf->SetKeywords('TDILG REGION-IV A');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//  require_once(dirname(__FILE__).'/lang/eng.php');
//  $pdf->setLanguageArray($l);
// }

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

// set some text to print

// $txt = <<<EOD
// TCPDF Example 003

// Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
// EOD;

// print a block of text using Write()
// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);



session_start();
$conn=mysqli_connect("localhost","fascalab_2020","","loop");


// $sqltable = "tblrecords";
//   $query = "SELECT    `$sqltable`.RECORD_N,
                        
//                           FROM `$sqltable`
                       
//                         WHERE md5(`$sqltable`.RECORD_N) = '".md5($_GET['id'])."' LIMIT 1";
// $queryinfo  = select_info_multiple_key($query)
$id = $_SESSION['inet_credentials']['id'];
$record_number = mysqli_query( $conn,"select RECORD_N from tblrecords where ADDED_BY = '".$_GET['id']."' order by RECORD_N DESC");
 $row = mysqli_fetch_array($record_number);
 $rn = $row['RECORD_N'];
$rec = $_GET['id'];
$sqltable = "tblrecords";
  $query = "SELECT    `$sqltable`.RECORD_N,
                        `$sqltable`.TYPE,
                        `$sqltable`.DATE,
                        `$sqltable`.TIME,
                        `$sqltable`.SUBJECT,
                        `$sqltable`.SOURCE,
                        `$sqltable`.RECEIVE_MODE,
                        `$sqltable`.CATEGORY,
                        `$sqltable`.URL,
                        `$sqltable`.SUMMARY,
                        `$sqltable`.STATUS,
                        `$sqltable`.date_received,
                        `$sqltable`.time_added,
                        tblrouting.FLAGAS,
                        tblrouting.DATE_ROUTED as DATE_R,
                        tblrouting.TIME_ROUTED as TIME_R,
                        tblrouting.ROUTED_TO as TO_R,
                        tblrouting.ROUTED_FROM as FROM_R,
                        tblrouting.SENDER_M as SENDER_M,
                        tblrouting.ACTION as ACTION,
                        tblrouting.REMARKS as REMARKS,
                        tblrecordsources.SOURCE_M,
                        tblrecordcategory.CATEGORY_M
                          FROM `$sqltable`
                        left join tblrouting on tblrouting.RECORD_N=`$sqltable`.RECORD_N
                        left join tblrecordsources on tblrecordsources.SOURCE_N=`$sqltable`.SOURCE
                        left join tblrecordcategory on tblrecordcategory.CATEGORY_N=`$sqltable`.CATEGORY
                        WHERE md5(`$sqltable`.RECORD_N) = '".md5($_GET['id'])."' LIMIT 1";
$resultHeader = mysqli_query($conn, $query);
$fdata = mysqli_fetch_array($resultHeader);
$subj = $fdata['SUBJECT'];
$ddate = $fdata['DATE'];
$ttime = $fdata['TIME'];
$ttype = $fdata['TYPE'];
$ssource = $fdata['SOURCE_M'];
$ccategory = $fdata['CATEGORY_M'];
$rrecievemode = $fdata['RECEIVE_MODE'];
$uurl = $fdata['URL'];
$sstatus = $fdata['STATUS'];
  // echo $rn;
$conn = mysqli_connect("localhost", "fascalab_2020", "", "loop");   
      $sql = "SELECT FLAGAS, URL, ROUTING_N, ROUTED_TO, ROUTED_FROM, concat(FIRST_M,' ', LAST_M) as NAME, UNAME, ACTION, REMARKS, DATE_ROUTED, TIME_ROUTED
                                     from tblrouting
                                    left join tblemployee on tblrouting.SENDER_M=tblemployee.EMP_N
                                     where RECORD_N='".$_GET['id']."'
                                     ORDER BY ROUTING_N DESC";  
      $result = mysqli_query($conn, $sql);  
      
      $routingN = mysqli_fetch_array($result);
      $RoutN = $routingN['ROUTING_N'];
      $Rmarks = $routingN['REMARKS'];

      $select_fp = " SELECT FILE_M from tblroutingfiles where ROUTING_N ='".$RoutN."' ";
      $result_fp = mysqli_query($conn, $select_fp); 
      $FP = mysqli_fetch_array($result_fp);
      $f_path = $FP['FILE_M'];
   /*     while($row = mysqli_fetch_array($result_fp))  
      {
         $f_path = $FP['FILE_M'];
        }*/




$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(33,0,'','',"<b>Record Number:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->WriteHTMLCell(35,0,'','',$rec,0,0);
$pdf->WriteHTMLCell(21,0,'','',"",0,0);
$pdf->SetFont('Times','',11);
$pdf->WriteHTMLCell(26,0,'','',"",0,0);
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(30,0,'','',"<b>Record Type:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->MultiCell(40, 5, $ttype, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(12,0,'','',"<b>Date:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->WriteHTMLCell(26,0,'','',$ddate,0,0);
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(13,0,'','',"<b>Time:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->WriteHTMLCell(64	,0,'','',$ttime,0,0);
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(30,0,'','',"<b>Source:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->MultiCell(40, 5, $ssource, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(18,0,'','',"<b>Subject:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->MultiCell(70, 5, $subj, 0, 'L', 0, 0, '', '', true);
$pdf->WriteHTMLCell(27,0,'','',"  ",0,0);
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(30,0,'','',"<b>Category:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->MultiCell(40, 5, $ccategory, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(115,0,'','',"",0,0);
$pdf->WriteHTMLCell(30,0,'','',"<b>Recieve Mode:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->WriteHTMLCell(37,0,'','',$rrecievemode,0,0);
$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(115,0,'','',"",0,0);
$pdf->WriteHTMLCell(30,0,'','',"<b>Attachment:</b>",0,0);
$pdf->SetFont('Times','',11);
// $pdf->WriteHTMLCell(37,0,'','',"Courier.pdf",0,0);
$pdf->MultiCell(25, 5, $f_path, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->WriteHTMLCell(115,0,'','',"",0,0);
$pdf->WriteHTMLCell(30,0,'','',"<b>URL:</b>",0,0);
$pdf->SetFont('Times','',11);
$pdf->WriteHTMLCell(37,0,'','',$uurl,0,0);

$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->WriteHTMLCell(15,0,'','',"<b>Status:</b>",0,0);
$pdf->SetFont('Times','',12);
$pdf->WriteHTMLCell(30,0,'','',$sstatus,0,0);
// $pdf->Ln();
// $pdf->WriteHTMLCell(37,0,'','',"<b><i>ROUTING</i></b>",0,0);

// $pdf->Ln();
// $pdf->SetFont('Times','B',12);
// $pdf->Cell(37, 0, 'Date Routed', 1, 1, 'C', 0, '', 0);
// $pdf->Cell(37, 0, 'Time Routed', 1, 1, 'C', 0, '', 0);

function fetch_data()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "fascalab_2020", "", "loop");   
      $sql = "SELECT FLAGAS, URL, ROUTING_N, ROUTED_TO, ROUTED_FROM, concat(FIRST_M,' ', LAST_M) as NAME, UNAME, ACTION, REMARKS, DATE_ROUTED, TIME_ROUTED
                                     from tblrouting
                                    left join tblemployee on tblrouting.SENDER_M=tblemployee.EMP_N
                                     where RECORD_N='".$_GET['id']."'
                                     ORDER BY ROUTING_N DESC";  
      $result = mysqli_query($conn, $sql);  

      $routingN = mysqli_fetch_array($result);
      $RoutN = $routingN['ROUTING_N'];
        
      // $queryfiles = "SELECT * from tblroutingfiles where ROUTING_N='".$RoutN."' ";
      // $result1 = mysqli_query($conn, $queryfiles);  
      // $fetch = mysqli_fetch_array($result1);
      // $files = $routingN['FILE_NAME'];

      while($row = mysqli_fetch_array($result))  
      {       
      $RT = $row["ROUTED_TO"];
      if ($RT == 1) {
        $RT = "ORD";
      }
       if ($RT == 2) {
        $RT = "AORD";
      }
       if ($RT == 3) {
        $RT = "ORD-Legal";
      }
        if ($RT == 5) {
        $RT = "ORD-Planning";
      }
       if ($RT == 6) {
        $RT = "ORD-Info";
      }
        if ($RT == 7) {
        $RT = "LGCDD-MBRTG";
      }
        if ($RT == 8) {
        $RT = "LGCDD-ISF";
      }
       if ($RT == 9) {
        $RT = "LGMED-PDMU";
      }
       if ($RT == 10) {
        $RT = "FAD";
      }
       if ($RT == 11) {
        $RT = "FAD-Accounting";
      }
       if ($RT == 12) {
        $RT = "FAD-Budget";
      }
       if ($RT == 13) {
        $RT = "FAD-Cash";
      }
       if ($RT == 14) {
        $RT = "FAD-GSS";
      }
       if ($RT == 15) {
        $RT = "FAD-HRS";
      }
       if ($RT == 16) {
        $RT = "FAD-RICTU";
      }
       if ($RT == 17) {
        $RT = "LGCDD";
      }
       if ($RT == 18) {
        $RT = "LGMED";
      }
       if ($RT == 19) {
        $RT = "DILG BATANGAS";
      }
       if ($RT == 20) {
        $RT = "DILG CAVITE";
      }
       if ($RT == 21) {
        $RT = "DILG LAGUNA";
      }
       if ($RT == 22) {
        $RT = "DILG QUEZON";
      }
        if ($RT == 23) {
        $RT = "DILG RIZAL";
      }
        if ($RT == 24) {
        $RT = "DILG LUCENA";
      }
       if ($RT == 25) {
        $RT = "FAD";
      }
       if ($RT == 26) {
        $RT = "FAD";
      }

    $RF = $row["ROUTED_FROM"];
      if ($RF == 1) {
        $RF = "ORD";
      }
       if ($RF == 2) {
        $RF = "AORD";
      }
       if ($RF == 3) {
        $RF = "ORD-Legal";
      }
        if ($RF == 5) {
        $RF = "ORD-Planning";
      }
       if ($RF == 6) {
        $RF = "ORD-Info";
      }
        if ($RF == 7) {
        $RF = "LGCDD-MBRTG";
      }
        if ($RF == 8) {
        $RF = "LGCDD-ISF";
      }
       if ($RF == 9) {
        $RF = "LGMED-PDMU";
      }
       if ($RF == 10) {
        $RF = "FAD";
      }
       if ($RF == 11) {
        $RF = "FAD-Accounting";
      }
       if ($RF == 12) {
        $RF = "FAD-Budget";
      }
       if ($RF == 13) {
        $RF = "FAD-Cash";
      }
       if ($RF == 14) {
        $RF = "FAD-GSS";
      }
       if ($RF == 15) {
        $RF = "FAD-HRS";
      }
       if ($RF == 16) {
        $RF = "FAD-RICTU";
      }
       if ($RF == 17) {
        $RF = "LGCDD";
      }
       if ($RF == 18) {
        $RF = "LGMED";
      }
       if ($RF == 19) {
        $RF = "DILG BATANGAS";
      }
       if ($RF == 20) {
        $RF = "DILG CAVITE";
      }
       if ($RF == 21) {
        $RF = "DILG LAGUNA";
      }
       if ($RF == 22) {
        $RF = "DILG QUEZON";
      }
        if ($RF == 23) {
        $RF = "DILG RIZAL";
      }
        if ($RF == 24) {
        $RF = "DILG LUCENA";
      }
       if ($RF == 25) {
        $RF = "FAD";
      }
       if ($RF == 26) {
        $RF = "FAD";
      }
      $output .= '<tr>  
                          <td>'.$row["DATE_ROUTED"].'</td>  
                          <td>'.$row["TIME_ROUTED"].'</td>  
                          <td>'.$RT.'</td>  
                          <td>'.$RF.'</td>  
                          <td>'.$row["UNAME"].'</td>  
                          <td>'.$row["ACTION"].'</td> 
                          <td>'.$row["REMARKS"].'</td> 
                     </tr>  
                          ';  
      }  
      return $output;  
 }  
 $content = '  <i><h3>ROUTING</h3></i>
        <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
        <th align="Center"><b>Date Routed</b></th>
    <th align="Center"><b>Time Routed</b></th>

    <th align="Center"><b>Routed to/for</b></th>
    <th align="Center"><b>Routed From</b></th>
    <th align="Center"><b>Routers Name</b></th>
    <th align="Center"><b>Action Requested</b></th>
    <th align="Center"><b>Remarks</b></th>
           </tr>  
      ';  
      $pdf->Ln();
      $content .= fetch_data();  
      $content .= '</table>';  
      $pdf->writeHTML($content);  


$pdf->SetFont('Times','',10);
$pdf->WriteHTMLCell(78,0,'','',"<b>ARD / RD's REMARKS / INSTRUCTIONS:</b>",0,0);
// // $pdf->Ln();
// $pdf->SetFont('Times','',11);
// $pdf->WriteHTMLCell(100,0,'','',"Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions Instructions ",0,0);
// $pdf->Cell(37,0,'Record Number: ',0,0);
// $pdf->SetFont('Times','',14);
// $pdf->Cell(10,0,$data,0,0);
// ---------------------------------------------------------
$queryrelease = "select TYPE, UNAME, URL, RELEASED_N, RELEASED_TO, RELEASED_FROM, concat(FIRST_M,' ', LAST_M) as NAME, REMARKS, DATE_RELEASED, TIME_RELEASED
                                     from tblrecordrelease
                                    left join tblemployee on tblrecordrelease.SENDER_M=tblemployee.EMP_N
                                     where md5(RECORD_N)='".md5($_GET['id'])."'";
$resultrelease = mysqli_query($conn, $queryrelease);  

$fre = mysqli_fetch_array($resultrelease);
$uname = $fre['UNAME'];
$drelease = $fre['DATE_RELEASED'];
$trelease = $fre['TIME_RELEASED'];
$reto = $fre['RELEASE_TO'];
$refor = $fre['RELEASED_FROM'];
$remarksre = $fre['REMARKS'];


$pdf->Ln();

function fetch_dataRelease()  
 {  
  $conn = mysqli_connect("localhost", "fascalab_2020", "", "loop");   
      $output1 = '';  
      $queryrelease = "select TYPE, UNAME, URL, RELEASED_N, RELEASED_TO, RELEASED_FROM, concat(FIRST_M,' ', LAST_M) as NAME, REMARKS, DATE_RELEASED, TIME_RELEASED
                                     from tblrecordrelease
                                    left join tblemployee on tblrecordrelease.SENDER_M=tblemployee.EMP_N
                                     where md5(RECORD_N)='".md5($_GET['id'])."'";
$resultrelease = mysqli_query($conn, $queryrelease);  

      while($row = mysqli_fetch_array($resultrelease))  
      {       
      $RT = $row["RELEASED_TO"];
      if ($RT == 1) {
        $RT = "ORD";
      }
       if ($RT == 2) {
        $RT = "AORD";
      }
       if ($RT == 3) {
        $RT = "ORD-Legal";
      }
        if ($RT == 5) {
        $RT = "ORD-Planning";
      }
       if ($RT == 6) {
        $RT = "ORD-Info";
      }
        if ($RT == 7) {
        $RT = "LGCDD-MBRTG";
      }
        if ($RT == 8) {
        $RT = "LGCDD-ISF";
      }
       if ($RT == 9) {
        $RT = "LGMED-PDMU";
      }
       if ($RT == 10) {
        $RT = "FAD";
      }
       if ($RT == 11) {
        $RT = "FAD-Accounting";
      }
       if ($RT == 12) {
        $RT = "FAD-Budget";
      }
       if ($RT == 13) {
        $RT = "FAD-Cash";
      }
       if ($RT == 14) {
        $RT = "FAD-GSS";
      }
       if ($RT == 15) {
        $RT = "FAD-HRS";
      }
       if ($RT == 16) {
        $RT = "FAD-RICTU";
      }
       if ($RT == 17) {
        $RT = "LGCDD";
      }
       if ($RT == 18) {
        $RT = "LGMED";
      }
       if ($RT == 19) {
        $RT = "DILG BATANGAS";
      }
       if ($RT == 20) {
        $RT = "DILG CAVITE";
      }
       if ($RT == 21) {
        $RT = "DILG LAGUNA";
      }
       if ($RT == 22) {
        $RT = "DILG QUEZON";
      }
        if ($RT == 23) {
        $RT = "DILG RIZAL";
      }
        if ($RT == 24) {
        $RT = "DILG LUCENA";
      }
       if ($RT == 25) {
        $RT = "FAD";
      }
       if ($RT == 26) {
        $RT = "FAD";
      }

    $RF = $row["RELEASED_FROM"];
      if ($RF == 1) {
        $RF = "ORD";
      }
       if ($RF == 2) {
        $RF = "AORD";
      }
       if ($RF == 3) {
        $RF = "ORD-Legal";
      }
        if ($RF == 5) {
        $RF = "ORD-Planning";
      }
       if ($RF == 6) {
        $RF = "ORD-Info";
      }
        if ($RF == 7) {
        $RF = "LGCDD-MBRTG";
      }
        if ($RF == 8) {
        $RF = "LGCDD-ISF";
      }
       if ($RF == 9) {
        $RF = "LGMED-PDMU";
      }
       if ($RF == 10) {
        $RF = "FAD";
      }
       if ($RF == 11) {
        $RF = "FAD-Accounting";
      }
       if ($RF == 12) {
        $RF = "FAD-Budget";
      }
       if ($RF == 13) {
        $RF = "FAD-Cash";
      }
       if ($RF == 14) {
        $RF = "FAD-GSS";
      }
       if ($RF == 15) {
        $RF = "FAD-HRS";
      }
       if ($RF == 16) {
        $RF = "FAD-RICTU";
      }
       if ($RF == 17) {
        $RF = "LGCDD";
      }
       if ($RF == 18) {
        $RF = "LGMED";
      }
       if ($RF == 19) {
        $RF = "DILG BATANGAS";
      }
       if ($RF == 20) {
        $RF = "DILG CAVITE";
      }
       if ($RF == 21) {
        $RF = "DILG LAGUNA";
      }
       if ($RF == 22) {
        $RF = "DILG QUEZON";
      }
        if ($RF == 23) {
        $RF = "DILG RIZAL";
      }
        if ($RF == 24) {
        $RF = "DILG LUCENA";
      }
       if ($RF == 25) {
        $RF = "FAD";
      }
       if ($RF == 26) {
        $RF = "FAD";
      }
      $output1 .= '<tr>  
                          <td>'.$row["DATE_RELEASED"].'</td>  
                          <td>'.$row["TIME_RELEASED"].'</td>  
                          <td>'.$RT.'</td>  
                          <td>'.$RF.'</td>  
                          <td>'.$row["UNAME"].'</td>  
                          <td>'.$row["REMARKS"].'</td> 
                     </tr>  
                          ';  
      }  
      return $output1;  
 }  
 $content1 = '  <i><h3>RELEASE</h3></i>
        <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
        <th align="Center"><b>Date Routed</b></th>
    <th align="Center"><b>Time Routed</b></th>

    <th align="Center"><b>Routed to/for</b></th>
    <th align="Center"><b>Routed From</b></th>
    <th align="Center"><b>Routers Name</b></th>
    <th align="Center"><b>Remarks</b></th>
           </tr>  
      ';  
      $pdf->Ln();
      $content1 .= fetch_dataRelease();  
      $content1 .= '</table>';  
      $pdf->writeHTML($content1);  



// $pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetFont('Times','',11);
// $pdf->WriteHTMLCell(40,0,'','',"<i>ACTION REQUESTED</i>",0,0);
// $pdf->Ln();
// $pdf->SetFont('Times','',10);
// $pdf->WriteHTMLCell(0,0,'','',"<i>(1)Approval/Signature  (2)Appropriate Action  (3)Comment/Recommendation  (4)Information/Reference  (5)Prepare Speech/Talking Points/Message  (6)Disseminate/Circularize  (7)Noted/File</i>",0,0);
$pdf->Output();

//============================================================+
// END OF FILE
//============================================================+
