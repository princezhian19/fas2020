<?php
$link = mysqli_connect("localhost","root","", "db_dilg_pmis");
$insert ="UPDATE `tbltechnical_assistance` SET 
`REQ_BY`='".$_POST['requested_by']."',
`OFFICE`='".$_POST['office']."',
`POSITION`='".$_POST['position']."',
`CONTACT_NO`='".$_POST['contact_no']."',
`EMAIL_ADD`='".$_POST['email_address']."',
`EQUIPMENT_TYPE`='".$_POST['equipment_type']."',
`BRAND_MODEL`='".$_POST['model']."',
`PROPERTY_NO`='".$_POST['property_no']."',
`SERIAL_NO`='".$_POST['serial_no']."',
`IP_ADDRESS`='".$_POST['ip_address']."',
`MAC_ADDRESS`='".$_POST['mac_address']."',
`ISSUE_PROBLEM`='".$_POST['issue_concern']."',
`ASSIST_BY` = '".$_POST['assist_by']."'
WHERE `CONTROL_NO` = '".$_POST['control_no']."'";

if (mysqli_query($link, $insert)) {
} else {
}
?>