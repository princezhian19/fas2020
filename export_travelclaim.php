<?php
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once 'library/PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("library/export_travelclaim.xlsx");
//---- PHP FUNCTIONS --------//







    //--- PHP FUNCTIONS --------//
    $styleTop = array(
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
    ),
    );

    $styleLeft = array(
    'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
    ),
    );

    $styleRight = array(
    'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
    );

    $stylebottom = array(
    'borders' => array(
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
    );
    
    $styleArray = array(
    'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_MEDIUM
        )
    )
    );
    $styleFont = array(
    'font'  => array(
        'bold' => true,
        'size'  => 11,
        'name' => 'Times New Roman'
    ));
    $styleFont2 = array(
        'font'  => array(
            'bold' => false,
            'size'  => 11,
            'name' => 'Times New Roman'
        ));
    $center = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

  $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    // =========== table 1 ============================//
        $sql_q11 = mysqli_query($conn, "
        SELECT * FROM `tbltravel_claim_info2`
        INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
        INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
        INNER join tblemployeeinfo ON tbltravel_claim_info2.NAME = tblemployeeinfo.UNAME
        INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
        WHERE `RO_TO_OB`= '".$_GET['id']."'
        GROUP by tbltravel_claim_info.RO ");
        $prepared_by = '';
        while($excelrow1= mysqli_fetch_assoc($sql_q11) ) 
          {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B9',$_GET['username']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B10',$excelrow1['POSITION_M']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C11','Regional Office');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F10','Purpose of Travel: '.$excelrow1['RO_TO_OB']);
            $objPHPExcel->getActiveSheet()->getStyle("F10") ->getAlignment()->setWrapText(true); 
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G9',$excelrow1['DATE']);
          }
    //======================================================//             

    //============ table 2 ============================//

$query = "SELECT TC_ID, tbltravel_claim_info.RO, RO_OT_OB FROM `tbltravel_claim_info2`
INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
WHERE  `RO_TO_OB`= '".$_GET['id']."' ";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)    
{
  $title1 = 15;
  $data = 16;
  $tc_id = '';
  $array = array();

  while($row1 = mysqli_fetch_array($result))
  {
    $array[] = $row1[1];
    $tc_id = $row1[0];
    $travel_title[] = $row1[2];

    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$title1,$row1['RO_OT_OB']);
    
  }
  $SQL = "SELECT PERDIEM + RECEIPT AS 'a', tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `RECEIPT`,`OTHERS`, `TOTAL_AMOUNT`,
  tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
  INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
  WHERE tbltravel_claim_info.RO IN (" . implode( ',', $array ) . ")  ";
  $result1 = mysqli_query($conn, $SQL);
  $rnums = '';
  $search = array();
  $title = array();
  $AA = array();
      while($row = mysqli_fetch_array($result1))
      {

       
            $search[] = $row["DATE"]; 
            $title[] = $row['RO_OT_OB'];
            $places_format[] = $row['PLACE'];
            $departure[] = $row['DEPARTURE'];
            $arrival[] = $row['ARRIVAL'];
            $mot[] = $row['MOT'];
            $transpo[] = $row['TRANSPORTATION'];
            $perdiem[] = $row['PERDIEM'];
            $others[] = $row['OTHERS'];
            $total_amount[] = $row['TOTAL_AMOUNT'];

            $rnums = mysqli_num_rows($result1);
            $perdiem = $row['a'];
            $arr = array($row['RO_OT_OB']);

            $array = array_unique($search);
            $a = implode(',', $array);
            $pieces = explode(",", $a);

            // $array3 = array_unique($places_format);
            $c = implode(',', $places_format);
            $places = explode(",", $c);

            
            $d = implode(',',$departure);
            $departure_format = explode(",",$d);

            $e = implode(',',$arrival);
            $arrival_format = explode(",",$e);

            $f = implode(',',$mot);
            $mot_format = explode(",",$f);

            $g = implode(',',$transpo);
            $transpo_format = explode(",",$g);

            $h = implode(',',$perdiem);
            $perdiem_transpo = explode(",",$h);

            $i = implode(',',$others);
            $others_format = explode(",",$i);

            $j = implode(',',$total_amount);
            $total_amount_format = explode(",",$j);

            $array2 = array_unique($title);
            $b = implode(',',$array2);
            $title_format = explode(",", $b);






        
        //     // FOR TRAVEL TITLE
             

              $objPHPExcel->getActiveSheet()->mergeCells("B".$data."".":C".$data);
              $objPHPExcel->getActiveSheet()->getStyle('B'.$data.':C'.$data)->applyFromArray($styleArray);
              $objPHPExcel->getActiveSheet()->getStyle('B'.$data.''.':C'.$data) ->getAlignment()->setWrapText(true);

           
            if($rnums > 0)
            {
        
          
            $data = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();



              $title1++;

              $data++;
            }else{
              $title1++;
              $data++;
            }
 

      }
     
      $data = 16;

      for($i = 0; $i < count($places); $i++)
      {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$data,$places[$i]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$data,date('g:H A',strtotime($departure_format[$i])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$data,date('g:H A',strtotime($arrival_format[$i])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$data,$mot_format[$i]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$data,$transpo_format[$i]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$data,$perdiem_transpo[$i]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$data,$others_format[$i]);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$data,sprintf("%.2f",$total_amount_format[$i]));
        $objPHPExcel->getActiveSheet()->getStyle('B'.$data)->applyFromArray($styleArray);

        $objPHPExcel->getActiveSheet()->getStyle('D'.$data)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$data)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$data)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$data)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$data)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$data)->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$data)->applyFromArray($styleArray);

        $objPHPExcel->getActiveSheet()->getStyle('A'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$data)->applyFromArray($styleFont2);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$title1)->applyFromArray($styleFont);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$title1)->applyFromArray($styleFont);
        $data++;
      }
     
      // TRAVEL TITLE
      $title1 = 15;
      for($i = 0; $i < count($title_format); $i++)
      {
        $SQL = "SELECT * FROM `tbltravel_claim_ro` WHERE RO_OT_OB = '".$title_format[$i]."'";
        $result1 = mysqli_query($conn, $SQL);
            if($row = mysqli_fetch_array($result1))
            {
              $rnums11 = mysqli_num_rows($result1);
              $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$title1,$row['RO_OT_OB']);
              // $objPHPExcel->getActiveSheet()->mergeCells("A".$title1."".":J".$title1);
              $objPHPExcel->getActiveSheet()->getStyle('A'.$title1.':J'.$title1)->applyFromArray($styleArray);
              // $objPHPExcel->getActiveSheet()->getStyle('A'.$data)->applyFromArray($styleLeft);
              // $objPHPExcel->getActiveSheet()->getStyle('A'.$data)->applyFromArray($styleRight);
              $title1 = ($title1+$rnums11);
              $title1++;
            }
      }
       // DATES
       $data = 16;
       $lastRow= $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    

       for($i = 0; $i < count($pieces); $i++)
       {
         $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$data,$pieces[$i]);
         $objPHPExcel->getActiveSheet()->getStyle('A'.$data)->applyFromArray($styleFont2);
         // $rnums = $rnums - 2;
         $data = ($lastRow-$rnums)+count($pieces);
         $data++;
         $title1++;
       }
}



// exit();
// TABLE 2 - ALL SIGNATORIES
$lastRow= $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()+1;
$row1 = $lastRow+1;
$row2 = $lastRow+3;
$row33 = $lastRow+4;
$row3 = $lastRow+5;
$row4 = $lastRow+6;
$row5 = $lastRow+10;
$row6 = $lastRow+11;
$row7 = $lastRow+12;
$row8 = $lastRow+13;
$row9 = $lastRow+14;
$row10 = $lastRow+3;
$row11 = $lastRow+7;


    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$lastRow,'TOTAL');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$lastRow)->applyFromArray($styleFont);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow.':J'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow)->applyFromArray($styleLeft);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$lastRow)->applyFromArray($styleRight);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row1,'Prepared by:');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row1)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row2."".":J".$row2);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row2,'______________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row2)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row3.':J'.$row3)->applyFromArray($stylebottom);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row33."".":J".$row33);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row33,$_GET['username']);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row33)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row33)->applyFromArray($styleFont);


    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row4,'Approved by:');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row4)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row5."".":J".$row5);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row5,'______________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row5)->applyFromArray($center);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row6."".":J".$row6);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row6,'NOEL R. BARTOLABAC, CESO V');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row6)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row6)->applyFromArray($styleFont);

    $objPHPExcel->getActiveSheet()->mergeCells("E".$row7."".":J".$row7);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row7,'OIC-Regional Director');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row7)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row7)->applyFromArray($styleFont2);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row8.':J'.$row8)->applyFromArray($stylebottom);


    $objPHPExcel->getActiveSheet()->mergeCells("A".$row5."".":D".$row5);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row5,'_________________________________________________');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row5)->applyFromArray($center);

    $objPHPExcel->getActiveSheet()->mergeCells("A".$row6."".":D".$row6);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row6,'DR. CARINA S. CRUZ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row6)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row6)->applyFromArray($styleFont);


    $objPHPExcel->getActiveSheet()->mergeCells("A".$row7."".":D".$row7);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row7,'Chief,FAD');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row7)->applyFromArray($center);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row7)->applyFromArray($styleFont2);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row8.':D'.$row8)->applyFromArray($stylebottom);
  

   

   


    $objPHPExcel->getActiveSheet()->mergeCells("A".$row10.":"."D".$row11);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row10,'I certify that : (1) I have reviewed the foregoing  itinerary,    (2)  the  travel  is necessary to  the service, (3) the period covered   is   reasonable   and   (4)  the expenses claimed are proper.');
    $objPHPExcel->getActiveSheet()->getStyle("A".$row10.":"."D".$row11) ->getAlignment()->setWrapText(true); 
    $objPHPExcel->getActiveSheet()->getStyle("A".$row10.":"."D".$row11)->applyFromArray($styleFont2);

   

    $aa = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    $bb = $aa-14;


    for($merge = $aa; $merge >= $bb; $merge--)
    {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$merge.':J'.$merge)->applyFromArray($styleRight);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$merge.':J'.$merge)->applyFromArray($styleLeft);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$merge)->applyFromArray($styleLeft);
    }
    $lastRow1 = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D16',$_GET['username']);




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');

?>