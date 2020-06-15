<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");

function splitName($name){
    $names = explode(' ', $name);
    $lastname = $names[count($names) - 1];
    unset($names[count($names) - 1]);
    $firstname = join(' ', $names);
    return $firstname . ' ' . $lastname;
}

$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');


              if(mysqli_connect_errno()){echo mysqli_connect_error();}  
             $cn = $_GET['id'];


                $query = "SELECT * FROM `tbltechnical_assistance` WHERE `CONTROL_NO` = '$cn'";
                $name = '';
                $result = mysqli_query($conn, $query);
                $val = array();
                while($row = mysqli_fetch_array($result))
                {
                $name =ucwords(strtolower($row['REQ_BY']));
               
            
                
                
                $request_date = date('M d, Y',strtotime($row['REQ_DATE']));


                if($row['START_DATE'] == '' || $row['START_DATE'] == null)
                {
                    $started_date = '';


                }else{
                    $started_date = date('M d, Y',strtotime($row['START_DATE']));

                }
                if($row['START_TIME'] == '' || $row['START_TIME'] == null)
                {
                $started_time ='';

                }else{
                $started_time = date('g:i A',strtotime($row['START_TIME']));

                }




                    if($row['COMPLETED_DATE'] == '' || $row['COMPLETED_DATE'] == null)
                    {
                    $completed_date = '';
                    }else{
                    $completed_date = date('M d, Y',strtotime($row['COMPLETED_DATE']));
                    }


                    if($row['COMPLETED_TIME'] == '' || $row['COMPLETED_TIME'] == null)
                    {
                    $completed_time = '';
                    }else{
                $completed_time = date('g:i A',strtotime($row['COMPLETED_TIME']));
                        
                    }
                  // $req_date_format = date("Y-m-d",strtotime($request_date));
                $control_no = $row['CONTROL_NO'];
                $request_time = date('g:i A',strtotime($row['REQ_TIME']));
                $office = $row['OFFICE'];
                $position = $row['POSITION'];
                $contact_no = $row['CONTACT_NO'];
                $email_address = $row['EMAIL_ADD'];
                $req_type_category = $row['TYPE_REQ'];
                      if(isset($row['TYPE_REQ_DESC']))
                      {
                          $req_type_subcategory = $row['TYPE_REQ_DESC'];

                      }else{
                          $req_type_subcategory = '';
                      }
                      // $site = $row['site'];
                      // $purpose = $row['purpose'];
                      // $purpose2 = $row['purpose2'];
                      // $softwares = $row['softwares'];
                      // $changeaccount = $row['changeaccount'];
                      // $others1 = $row['others1'];
                      // $others2 = $row['others2'];
                      // $others3 = $row['others3'];
                      $issue = $row['ISSUE_PROBLEM'];
                      $status_desc = $row['STATUS_DESC'];
                      $timeliness = $row['TIMELINESS'];
                    
                      
                      $quality = $row['QUALITY'];

                      $assisted_by =ucwords(strtolower($row['ASSIST_BY']));
                     
                      // $status = $row['status'];

                      $equipment_type = $row['EQUIPMENT_TYPE'];
                      $brand_model = $row['BRAND_MODEL'];
                      $property_no = $row['PROPERTY_NO'];
                      $serial_no = $row['SERIAL_NO'];
                      $ip_address = $row['IP_ADDRESS'];
                      $mac_address = $row['MAC_ADDRESS'];
                      $status = $row['STATUS'];
                      $status2 = $row['STATUS'];
                      
              }

               if($status == '' || $status == null){
                $status2 = '';
                $status = '';
            }

else if($status == 1)
{
    $status = 'correct.png';
    $status2 = '';
}
else if($status == 0){
    $status2 = 'correct.png';
    $status = '';
}

$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
switch($req_type_subcategory)
    {
       
        case 'Hardware Error':
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
        break;
        case 'Software Error':
                $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory2"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,
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
        break;
        case 'Computer Assembly':
                      $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory3"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                  
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
        break;
        case 'Parts Replacement':
                      $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory4"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        break;
        case 'Virus Scanning':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory5"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        break;
        // 2nd group of checkbox
        case 'New Connection(Wired or Wireless)':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory6"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        break;
        case 'No Internet (Cross or Exclamation)':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory7"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        break;
        case 'Access to Blocked Site:':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "site"=>$site,
                                    "purpose"=>$purpose,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory8"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        break;
        case 'Internet for Personal Phone/Tablet/Laptop':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "purpose2"=>$purpose2,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory9"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        break;
        // 3rd group of checkbox
        case 'Operating System, Office, Anti-Virus':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory10"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
        case 'Records Tracking System';
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory11"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        
        break;
        case 'Google Drive';
             $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory12"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        
        break;
        case 'DILG Portals/Systems':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory13"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
        
        break;
        case 'Other software/s (please specify)':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "softwares"=>$softwares,    
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory14"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
        // 4th group of checkbox
        case 'Installation':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category4"=>'correct.png',
                                    "req_type_subcategory15"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
        
        case 'Troubleshooting':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,"start_time"=>$started_time,
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category4"=>'correct.png',
                                    "req_type_subcategory16"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
            
        case 'Sharing/Networking':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category4"=>'correct.png',
                                    "req_type_subcategory17"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
        
        case 'New Account':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category5"=>'correct.png',
                                    "req_type_subcategory18"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
        case 'Change Account to':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "changeaccount"=>$changeaccount,
                                    "req_type_category5"=>'correct.png',
                                    "req_type_subcategory19"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
        case 'Password Reset':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,"started_date"=>$started_date,
                                    "timeliness"=>$timeliness,"start_time"=>$started_time,
                                    "quality"=>$quality,"completed_date"=>$completed_date,
                                    "issue"=>$issue,"completed_time"=>$completed_time,"status_desc"=>$status_desc,
                                    "req_type_category5"=>'correct.png',
                                    "req_type_subcategory20"=>'correct.png',
                                    "currentuser"=>$name,"resolve"=>$status,"defective"=>$status2,                                
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
            break;
    


    }


$PHPJasperXML->load_xml_file("report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
    $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
