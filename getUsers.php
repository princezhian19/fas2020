<?php
include "config.php";

$departid = $_POST['depart'];   // department id

$sql = "SELECT citymun_c,citymun_m FROM tblcitymun WHERE province_c=".$departid;

$result = mysqli_query($con,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['citymun_c'];
    $name = $row['citymun_m'];

    $users_arr[] = array("citymun_c" => $userid, "citymun_m" => $name);
}

// encoding array to json format
echo json_encode($users_arr);