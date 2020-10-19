<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");
$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
if(mysqli_connect_errno()){echo mysqli_connect_error();}  


                $query = "SELECT * FROM `tbltechnical_assistance` WHERE `CONTROL_NO` = '$cn'";
                $name = '';
                $result = mysqli_query($conn, $query);
                $val = array();
                while($row = mysqli_fetch_array($result))
                {
                $name =ucwords(strtolower($row['REQ_BY']));
                }

            
                
                
     
$PHPJasperXML = new PHPJasperXML();

       
                $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory1"=>'correct.png',
                                    "currentuser"=>splitName($name),"resolve"=>$status,"defective"=>$status2,
                                    "assisted_by"=>$assisted_by,
                                    "requested_date"=>$request_date,
                                    "requested_time"=>$request_time,
                                    "office"=>$office,
                                    "position"=>$position,
                                    "contact_no"=>$contact_no,
                                    "email"=>$email_address,
                                    "equipment_type"=>$equipment_type,
                                    "brand_model"=>$brand_model,
                                    "property_no"=>$property_no,
                                    "serial_no"=>$serial_no,
                                    "ip_address"=>$ip_address,
                                    "mac_address"=>$mac_address);
    



$PHPJasperXML->load_xml_file("report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
    $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
