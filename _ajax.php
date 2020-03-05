
<?php
session_start();

$con = mysqli_connect("localhost","root","", "db_dilg_pmis");



$return_arr = array();

$query = "SELECT 
* FROM `tbltechnical_assistance` WHERE `OFFICE` LIKE  '%".$_SESSION['username']."%' ";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
    $cn = $row['CONTROL_NO'];
    $rd = date('M d, Y',strtotime($row['REQ_DATE']));//date format
    $rtI = $row['REQ_TIME'];
    $rb = $row['REQ_BY'];
    $office=$row['OFFICE'];
    $issue=$row['ISSUE_PROBLEM'];
    $rt = $row['TYPE_REQ'];
    $ab = $row['ASSIST_BY'];
    $sd = $row['START_DATE'];//date format
    $st = $row['START_TIME'];
    $cd = $row['COMPLETED_DATE'];
    $ct = $row['COMPLETED_TIME'];
    $to_time = strtotime("2020-03-02 9:00");
    $from_time = strtotime("2020-03-02 10:50:00");
    // $rt = round(abs($to_time - $from_time) / 60,2). " minute";

    $return_arr[] = array(
                    "CONTROL_NO" => $cn,
                    "REQ_DATE"   => $rd,
                    "REQ_TIME"   => $rtI,
                    "REQ_BY"     => $rb,
                    "OFFICE"     => $office,
                    "ISSUE_PROBLEM"=>$issue,
                    "TYPE_REQ_DESC"=>$rt,
                    );
}

// Encoding array in JSON format
echo json_encode($return_arr);