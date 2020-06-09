<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");

$request_date = $_POST['request_date'];
$req_date_format = date("Y-m-d",strtotime($request_date));

// $request_time = $_POST['request_time'];
if (strstr($_POST['request_time'], 'PM' ) ) {
    $a = str_replace("PM","",$_POST['request_time']);
    $request_time  = date("H:i",strtotime($a));

}else{
    $a = str_replace("AM","",$_POST['request_time']);
    $request_time  = date("H:i",strtotime($a));
}
$office = $_POST['office'];
$position = $_POST['position'];
$contact_no = $_POST['contact_no'];
$email_address = $_POST['email_address'];
$req_type_category = $_POST['req_type_category'];
if(isset($_POST['req_type_subcategory']))
{
    $req_type_subcategory = $_POST['req_type_subcategory'];

}else{
    $req_type_subcategory = '';

}
$site = $_POST['site'];
$purpose = $_POST['purpose'];
$purpose2 = $_POST['purpose2'];
$softwares = $_POST['softwares'];
$changeaccount = $_POST['changeaccount'];
$others1 = $_POST['others1'];
$others2 = $_POST['others2'];
$others3 = $_POST['others3'];
$issue = $_POST['issue'];
$timeliness = $_POST['timeliness'];
$quality = $_POST['quality'];
$control_no = $_POST['control_no'];
$assisted_by ='';
$status = $_POST['status'];

$equipment_type = $_POST['equipment_type'];
$brand_model = $_POST['brand_model'];
$property_no = $_POST['property_no'];
$serial_no = $_POST['serial_no'];
$ip_address = $_POST['ip_address'];
$mac_address = $_POST['mac_address'];



            $link = mysqli_connect('localhost','fascalab_2020','','fascalab_2020');
              if(mysqli_connect_errno()){echo mysqli_connect_error();}  
             $currentuser = $_POST['curuser'];


              $query = "SELECT * FROM tblemployeeinfo where EMP_N = $currentuser";
              $name = '';
              $result = mysqli_query($link, $query);
              $val = array();
              while($row = mysqli_fetch_array($result))
              {
                $name = $row['FIRST_M'].' '.$row['MIDDLE_M'].' '.$row['LAST_M'];
              }

              
              $query = "SELECT * FROM tbltechnical_assistance where CONTROL_NO = $control_no";
              $name = '';
              $result = mysqli_query($link, $query);
              $val = array();
              while($row = mysqli_fetch_array($result))
              {
                $req_date_format = $row['REQ_DATE'];
                echo $req_date_format;
              }
exit();




$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
for($i = 0; $i < count($_POST['req_type_category']); $i++)
{
    
    
    $type_req = $_POST['req_type_category'][$i];
    $type_subreq = $_POST['req_type_subcategory'][$i];
    
     $sql_insert ="INSERT INTO `tbltechnical_assistance`(
               `ID`, 
               `CONTROL_NO`, 
               `REQ_DATE`, 
               `REQ_TIME`, 
               `REQ_BY`, 
               `OFFICE`, 
               `POSITION`, 
               `CONTACT_NO`, 
               `EMAIL_ADD`, 
               `EQUIPMENT_TYPE`, 
               `BRAND_MODEL`, 
               `PROPERTY_NO`, 
               `SERIAL_NO`, 
               `IP_ADDRESS`,
               `MAC_ADDRESS`, 
               `TYPE_REQ`,
               `TYPE_REQ_DESC`, 
               `ISSUE_PROBLEM`, 
               `START_DATE`,
               `START_TIME`, 
               `STATUS_DESC`,
               `COMPLETED_DATE`, 
               `COMPLETED_TIME`, 
               `ASSIST_BY`,
               `PERSON_ASSISTED`, 
               `TIMELINESS`, 
               `QUALITY`, 
               `STATUS`)
               VALUES (null,
               '$control_no',
               '$req_date_format',
               '$request_time',
               '$name',
               '$office',
               '$position',
               '$contact_no',
               '$email_address',
               '$equipment_type',
               '$brand_model',
               '$property_no',
               '$serial_no',
               '$ip_address',
               '$mac_address',
               '$type_req',
               '$type_subreq',
               '$issue',
               '0000-00-00',
               null,
               null,
               '0000-00-00',
               null,
               '$assisted_by',
               '$name',
               '$timeliness',
               '$quality',
               null
               )";
            //    echo $sql_insert;
            //    exit();
if (mysqli_query($link, $sql_insert)) {
 } else {
 }
    // ======
   if($_POST['req_type_category'][$i] == "Others"){
        $PHPJasperXML->arrayParameter=array(
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
                                    "others1"=> $others1,
                                    "others2"=> $others2,
                                    "others3"=> $others3,
                                    "req_type_subcategory21"=>'correct.png',
                                    "currentuser"=>$name,                                     "assisted_by"=>$assisted_by,
                                    "requested_date"=>$request_date,
                                    "requested_time"=>$request_time,
                                    "office"=>$office,
                                    "position"=>$position,
                                    "contact_no"=>$contact_no,
                                    "email"=>$email_address);
   }
    
    switch($_POST['req_type_subcategory'][$i])
    {
       
        case 'Hardware Error':
                $PHPJasperXML->arrayParameter=array(
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
                                    "timeliness"=>$timeliness,
                                    "quality"=>$quality,
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
}

$PHPJasperXML->load_xml_file("report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','','fascalab_2020');
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
