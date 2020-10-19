<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");



$conn=mysqli_connect("localhost","root","","test1");

              if(mysqli_connect_errno()){echo mysqli_connect_error();}  
             $cn = $_GET['id'];


              $query = "SELECT * FROM tbltechnical_assistance where CONTROL_NO = '$cn'";
              $name = '';
              $result = mysqli_query($conn, $query);
              $val = array();
              while($row = mysqli_fetch_array($result))
              {
                $name = $row['REQ_BY'];
                $request_date = date('M d, Y',strtotime($row['REQ_DATE']));
                  // $req_date_format = date("Y-m-d",strtotime($request_date));
                $control_no = $row['CONTROL_NO'];
                $request_time = date('H:i A',strtotime($row['REQ_TIME']));
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
                      $timeliness = $row['TIMELINESS'];
                      $quality = $row['QUALITY'];
                      // $assisted_by ='';
                      // $status = $row['status'];

                      $equipment_type = $row['EQUIPMENT_TYPE'];
                      $brand_model = $row['BRAND_MODEL'];
                      $property_no = $row['PROPERTY_NO'];
                      $serial_no = $row['SERIAL_NO'];
                      $ip_address = $row['IP_ADDRESS'];
                      $mac_address = $row['MAC_ADDRESS'];
              }



$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
switch($req_type_subcategory)
    {
       
        case 'Hardware Error':
                $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
                                    "issue"=>$issue,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory1"=>'correct.png',
                                    "currentuser"=>$name,
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
                                    "control_no"=>$control_no,
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
                                    "issue"=>$issue,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory2"=>'correct.png',
                                    "currentuser"=>$name,
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory3"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory4"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category1"=>'correct.png',
                                    "req_type_subcategory5"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory6"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
        case 'No Internet Connection(Cross or Exclamation)':
            $PHPJasperXML->arrayParameter=array(
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory7"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "site"=>$site,
                                    "purpose"=>$purpose,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory8"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "purpose2"=>$purpose2,
                                    "req_type_category2"=>'correct.png',
                                    "req_type_subcategory9"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory10"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory11"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory12"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory13"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "softwares"=>$softwares,    
                                    "req_type_category3"=>'correct.png',
                                    "req_type_subcategory14"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category4"=>'correct.png',
                                    "req_type_subcategory15"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category4"=>'correct.png',
                                    "req_type_subcategory16"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category4"=>'correct.png',
                                    "req_type_subcategory17"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category5"=>'correct.png',
                                    "req_type_subcategory18"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "changeaccount"=>$changeaccount,
                                    "req_type_category5"=>'correct.png',
                                    "req_type_subcategory19"=>'correct.png',
                                    "currentuser"=>$name,                                     
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
                                    "control_no"=>$control_no,
"timeliness"=>$timeliness,
                                    "quality"=>$quality,
"issue"=>$issue,
                                    "req_type_category5"=>'correct.png',
                                    "req_type_subcategory20"=>'correct.png',
                                    "currentuser"=>$name,                                     
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


$PHPJasperXML->load_xml_file("tmp/report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','root','','test1');
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
