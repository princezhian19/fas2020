<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");
$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
    $SQL = "SELECT PERDIEM + RECEIPT AS 'a', tbltravel_claim_info.`ID` as 'dID', `TC_ID`, `RO`, `DATE`, `PLACE`, `ARRIVAL`, `DEPARTURE`, `MOT`, `TRANSPORTATION`, `PERDIEM`, `RECEIPT`,`OTHERS`, `TOTAL_AMOUNT`,
    tbltravel_claim_ro.`ID`, `RO_OT_OB`, `UNAME`  FROM tbltravel_claim_info 
    INNER JOIN tbltravel_claim_ro on tbltravel_claim_info.RO = tbltravel_claim_ro.ID 
    WHERE tbltravel_claim_info.RO != 10";
    $result1 = mysqli_query($conn, $SQL);
    $rnums = '';
    $search = array();
    $title = array();
    $AA = array();
$PHPJasperXML = new PHPJasperXML();

        while($row = mysqli_fetch_array($result1))
        {
            $search[] = $row["DATE"]; 
            if($row1['DATE'] == $row1['DATE'])
            {
            
                $date = $row['DATE'];
                $PHPJasperXML->arrayParameter=array(
                "DATE"=>$date
            );
            
        }
      
     
                }
$PHPJasperXML->load_xml_file("travel_template.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
    $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
