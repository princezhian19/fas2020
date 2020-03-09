
<?php
session_start();

$con = mysqli_connect("localhost","root","", "db_dilg_pmis");



$return_arr = array();
$name = $_SESSION['username'];
if($name == 'fad')
{
    $query = "SELECT 
    * FROM `tbltechnical_assistance` WHERE `REQ_DATE` != '0000-00-00' ";
    $result = mysqli_query($con,$query);
}else{
    $query = "SELECT 
    * FROM `tbltechnical_assistance` WHERE `OFFICE` LIKE  '%".$_SESSION['username']."%' ";
    $result = mysqli_query($con,$query);
}

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
    $stat = $row['STATUS'];
    $sr = $row['STATUS_REQUEST'];
    // $rt = round(abs($to_time - $from_time) / 60,2). " minute";
if($sr == 'Pending')
{
    $sr = '<span class="badge badge-pill" style = "background-color:red;">'.$sr.'</span>';
}else if($sr == 'For action')
{
    $sr = '<span class="badge badge-pill" style = "background-color:blue;">'.$sr.'</span>';
}else if($sr == 'Completed')
{
    $sr = '<span class="badge badge-pill" style = "background-color:green;">'.$sr.'</span>';
}
    $return_arr[] = array(
                    "CONTROL_NO" => $cn,
                    "REQ_DATE"   => $rd,
                    "REQ_TIME"   => $rtI,
                    "REQ_BY"     => $rb,
                    "OFFICE"     => $office,
                    "ISSUE_PROBLEM"=>$issue,
                    "TYPE_REQ_DESC"=>$rt,
                    "ASSIGNED_PERSON"=>'sample',
                    "STATUS_REQUEST"=>$sr,
                    );
}

// Encoding array in JSON format
echo json_encode($return_arr);