<?php
$link = mysqli_connect("localhost","root","", "db_dilg_pmis");
$started_date =  date("Y-m-d",strtotime($_POST['started_date']));
$requested_date = date("Y-m-d",strtotime($_POST['requested_date']));
$completed_date =  date("Y-m-d",strtotime($_POST['completed_date']));
// $request_time = $_POST['request_time'];
if (strstr($_POST['started_time'], 'PM' ) ) {
    $a = str_replace("PM","",$_POST['started_time']);
    $started_time  = date("H:i",strtotime($a));

}else{
    $a = str_replace("AM","",$_POST['started_time']);
    $started_time  = date("H:i",strtotime($a));
}
if (strstr($_POST['completed_time'], 'PM' ) ) {
    $b = str_replace("PM","",$_POST['completed_time']);
    $completed_time  = date("H:i",strtotime($b));
}else{
    $b = str_replace("AM","",$_POST['completed_time']);
    $completed_time  = date("H:i",strtotime($b));
}

// ========================================================================
if(strstr($_POST['requested_time'],'PM'))
{
    $c = str_replace("PM","",$_POST['requested_time']);
    $requested_time  = date("H:i",strtotime($c));
}else{
    $c = str_replace("AM","",$_POST['requested_time']);
    $requested_time  = date("H:i",strtotime($c));

}
$insert ="UPDATE `tbltechnical_assistance` SET 
`REQ_DATE`='".$requested_date."',
`REQ_TIME`='".$requested_time."',
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
`START_DATE`= '".$started_date."',
`START_TIME`= '".$started_time."',
`STATUS_DESC`= '".$_POST['diagnose_desc']."',
`COMPLETED_DATE`= '".$completed_date."',
`COMPLETED_TIME`= '".$completed_time."',
`STATUS_REQUEST`='Completed'
WHERE `CONTROL_NO` = '".$_POST['control_no']."'";
if (mysqli_query($link, $insert)) {
} else {
}
?>

