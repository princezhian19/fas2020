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
    'font'  => array(
        'size'  => 11,
        'name' => 'Times New Roman'
    )
    );

    $styleRight = array(
    'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
    'font'  => array(
        'size'  => 11,
        'name' => 'Times New Roman'
    )
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
    $Italic = array(
        'font'  => array(
            'bold' => true,
            'italic' => true,
            'size'  => 9,
            'name' => 'Arial'
        )
        );
    $styleFont = array(
    'font'  => array(
        'bold' => true,
        'size'  => 11,
        'name' => 'Times New Roman'
    )
);
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
    $ro_id = '';
    $ro = '';
    $lastRow = '';
    $countItems = '';
    function countTravelDetails($id)
    {
        $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
        $query = "SELECT count(*) as 'count'  FROM `tbltravel_claim_info`WHERE `RO`= '$id'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
            while($row1 = mysqli_fetch_array($result))
            {
                $excelRow = $row1['count'];
            }
        }
        return $excelRow;
    }
    function getByTCID()
    {
        $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
        $query = "SELECT COUNT(DISTINCT(RO)) as count FROM `tbltravel_claim_info2`
        INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
        INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
        WHERE  `RO_TO_OB`= '".$_GET['id']."' ";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
            while($row1 = mysqli_fetch_array($result))
            {
                $excelRow = $row1['count'];
            }
        }
        return $excelRow;
    }
   
    
        $query = "SELECT DISTINCT(RO_OT_OB),DATE, PLACE, DEPARTURE, ARRIVAL, MOT, TRANSPORTATION, PERDIEM, OTHERS, tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
        INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
        INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
        WHERE  `RO_TO_OB`= '".$_GET['id']."' group by RO_OT_OB ";

        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
            $row_title = 15;
            $firstTitle = '';
            $secondTitle = '';
            $thirdTitle = '';
            $count = '';
            while($row1 = mysqli_fetch_array($result))
            {

                $count = countTravelDetails($row1['ID']);
                $countItems = $count;
                $tc_id = getByTCID();

                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_title,$row1['RO_OT_OB']);
                $objPHPExcel->getActiveSheet(0)->mergeCells("A".$row_title."".":J".$row_title);


                $objPHPExcel->getActiveSheet(0)->getStyle('A'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('B'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('C'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('D'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('E'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('F'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('G'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('H'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('I'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('J'.$row_title)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet(0)->getStyle('J'.$row_title)->applyFromArray($styleRight);

                  // border
                 
                  $objPHPExcel->getActiveSheet(0)->getStyle('A'.$row_title)->applyFromArray($Italic);
                 
                  
    
                $row_title += $count;


                $title[] = $row1['RO_OT_OB'];
                $row_title++;
            }
            // SET THE DATE FOR EVERY ACTIVITY
               
     
        }


        $rowZero = '';
        $rowOne = '';
        $TOTAL1 = '';
        $TOTAL2 = '';
        $TOTAL3 = '';
        $TOTAL4 = '';
        $TOTAL5 = '';
        $TOT = '';
      for ($i=0; $i < $tc_id; $i++)
       { 
            if($i == 0)
            {
                    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                    $query1 = "SELECT  tbltravel_claim_ro.RO_OT_OB as 'title' , PLACE, DEPARTURE, TOTAL_AMOUNT, ARRIVAL, MOT, TRANSPORTATION, PERDIEM, OTHERS, tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
                    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
                    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
                    WHERE  `tbltravel_claim_ro`.RO_OT_OB= '".$title[0]."'  ";
                    $result1 = mysqli_query($conn, $query1);
                    $rowZero = mysqli_num_rows($result1); 

                    if(mysqli_num_rows($result1) > 0)    
                    {
                        $row_data = 16;
                        while($row11 = mysqli_fetch_array($result1))
                        {
                            $TOTAL1 = $row11['TOTAL_AMOUNT'];
                            $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                            // border
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleLeft);

                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleRight);
                            $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleRight);


                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_data,$row11['PLACE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_data,$row11['ARRIVAL']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_data,$row11['DEPARTURE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row_data,$row11['MOT']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_data,$row11['TRANSPORTATION']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_data,$row11['PERDIEM']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_data,$row11['OTHERS']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_data,$row11['TOTAL_AMOUNT']);     

                              
                            if(strlen($row1['PLACE']) > 20)
                            {
                                $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                                $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                                $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.''.':C'.$row_data) ->getAlignment()->setWrapText(true);
                                $objPHPExcel->getActiveSheet()->getRowDimension($row_data)->setRowHeight(28);
                            }

                            $row_data++;
                        
                        }
                        $r = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                   
                    }
            }else if($i == 1){
                $hRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

                    $query1 = "SELECT  tbltravel_claim_ro.RO_OT_OB as 'title' , PLACE, DEPARTURE, TOTAL_AMOUNT, ARRIVAL, MOT, TRANSPORTATION, PERDIEM, OTHERS, tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
                    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
                    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
                    WHERE  `tbltravel_claim_ro`.RO_OT_OB= '".$title[1]."'  ";
                    $result1 = mysqli_query($conn, $query1);
                $rowOne = mysqli_num_rows($result1); 
                if($tc_id >= 2)
                {
                    $r = $hRow - $rowOne;
                
                }else{
                    $r = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()-1;
                }

                    if(mysqli_num_rows($result1) > 0)    
                    {
                        $row_data = $r;
                        while($row11 = mysqli_fetch_array($result1))
                        {
                            $TOTAL2 = $row11['TOTAL_AMOUNT'];

                            $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                            // border
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleLeft);
                            

                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_data,$row11['PLACE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_data,$row11['ARRIVAL']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_data,$row11['DEPARTURE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row_data,$row11['MOT']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_data,$row11['TRANSPORTATION']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_data,$row11['PERDIEM']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_data,$row11['OTHERS']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_data,$row11['TOTAL_AMOUNT']);

                             // border
                             $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleRight);

                             if(strlen($row1['PLACE']) > 20)
                             {
                                 $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                                 $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                                 $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.''.':C'.$row_data) ->getAlignment()->setWrapText(true);
                                 $objPHPExcel->getActiveSheet()->getRowDimension($row_data)->setRowHeight(28);
                             }
 
                            $row_data++;
                        }
                    }
            }else if($i == 2){
                $hRow2 = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

                    $query1 = "SELECT  tbltravel_claim_ro.RO_OT_OB as 'title' , PLACE, DEPARTURE, TOTAL_AMOUNT, ARRIVAL, MOT, TRANSPORTATION, PERDIEM, OTHERS, tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
                    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
                    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
                    WHERE  `tbltravel_claim_ro`.RO_OT_OB= '".$title[2]."'  ";
                    $result1 = mysqli_query($conn, $query1);
                $rowTwo = mysqli_num_rows($result1); 
                if($tc_id >= 2)
                {
                    $r = $hRow2+1;
                
                }else{
                    $r = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()-1;
                }

                    if(mysqli_num_rows($result1) > 0)    
                    {
                        $row_data = $r;
                        while($row11 = mysqli_fetch_array($result1))
                        {
                            $TOTAL3 = $row11['TOTAL_AMOUNT'];

                            $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                            // border
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleLeft);
                            

                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_data,$row11['PLACE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_data,$row11['ARRIVAL']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_data,$row11['DEPARTURE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row_data,$row11['MOT']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_data,$row11['TRANSPORTATION']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_data,$row11['PERDIEM']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_data,$row11['OTHERS']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_data,$row11['TOTAL_AMOUNT']);

                             // border
                             $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleRight);

                             if(strlen($row1['PLACE']) > 20)
                             {
                                 $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                                 $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                                 $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.''.':C'.$row_data) ->getAlignment()->setWrapText(true);
                                 $objPHPExcel->getActiveSheet()->getRowDimension($row_data)->setRowHeight(28);
                             }
 
                            $row_data++;
                        }
                    }
            }else if($i == 3){
                $hRow3 = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

                    $query1 = "SELECT  tbltravel_claim_ro.RO_OT_OB as 'title' , PLACE, DEPARTURE, TOTAL_AMOUNT, ARRIVAL, MOT, TRANSPORTATION, PERDIEM, OTHERS, tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
                    INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
                    INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
                    WHERE  `tbltravel_claim_ro`.RO_OT_OB= '".$title[3]."'  ";
                    $result1 = mysqli_query($conn, $query1);
                $rowTwo = mysqli_num_rows($result1); 
                if($tc_id >= 2)
                {
                    $r = $hRow3+1;
                
                }else{
                    $r = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow()-1;
                }

                    if(mysqli_num_rows($result1) > 0)    
                    {
                        $row_data = $r;
                        while($row11 = mysqli_fetch_array($result1))
                        {
                            $TOTAL2 = $row11['TOTAL_AMOUNT'];

                            $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                            // border
                            $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleLeft);
                            $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleLeft);
                            

                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_data,$row11['PLACE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_data,$row11['ARRIVAL']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_data,$row11['DEPARTURE']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row_data,$row11['MOT']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_data,$row11['TRANSPORTATION']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_data,$row11['PERDIEM']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_data,$row11['OTHERS']);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_data,$row11['TOTAL_AMOUNT']);

                             // border
                             $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('D'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('E'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('F'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('G'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('H'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('I'.$row_data)->applyFromArray($styleRight);
                             $objPHPExcel->getActiveSheet()->getStyle('J'.$row_data)->applyFromArray($styleRight);

                             if(strlen($row1['PLACE']) > 20)
                             {
                                 $objPHPExcel->getActiveSheet()->mergeCells("B".$row_data."".":C".$row_data);
                                 $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.':C'.$row_data)->applyFromArray($styleLeft);
                                 $objPHPExcel->getActiveSheet()->getStyle('B'.$row_data.''.':C'.$row_data) ->getAlignment()->setWrapText(true);
                                 $objPHPExcel->getActiveSheet()->getRowDimension($row_data)->setRowHeight(28);
                             }
 
                            $row_data++;
                        }
                    }
            }
       }
  
       $TOT = $TOTAL1 + $TOTAL2 + $TOTAL3 + $TOTAL4 + $TOTAL5;
       echo $TOT;
       EXIT();
       $SQL = "SELECT DISTINCT(RO_OT_OB),DATE, PLACE, DEPARTURE, ARRIVAL, MOT, TRANSPORTATION, PERDIEM, OTHERS, tbltravel_claim_ro.ID, TC_ID, tbltravel_claim_info.RO FROM `tbltravel_claim_info2`
       INNER JOIN `tbltravel_claim_info` on `tbltravel_claim_info2`.`ID` = `tbltravel_claim_info`.`TC_ID` 
       INNER JOIN `tbltravel_claim_ro` on `tbltravel_claim_info`.RO = `tbltravel_claim_ro`.ID 
       WHERE  `RO_TO_OB`= '".$_GET['id']."' group by RO_OT_OB ";

       $result5 = mysqli_query($conn, $SQL);
       if(mysqli_num_rows($result5) > 0)    
       {
           $row_date = 16;
           while($row5 = mysqli_fetch_array($result5))
           {

               $forDate = countTravelDetails($row5['ID']);
               $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_date,$row5['DATE']);
               $row_date += $forDate;
               $row_date++;
           }
    
       }
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
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$lastRow,$TOT);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$lastRow)->applyFromArray($stylebottom);

    $objPHPExcel->getActiveSheet()->getStyle('E'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('H'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('I'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$lastRow)->applyFromArray($styleTop);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('H'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('I'.$lastRow)->applyFromArray($stylebottom);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$lastRow)->applyFromArray($stylebottom);

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


    // ================== SHEET 2 =======================
    // $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D6',$_GET['username']);








$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
header('location: export_travelclaim.xlsx');

?>