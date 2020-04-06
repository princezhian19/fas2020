<?php
session_start();
$sess_name = $_SESSION['complete_name'];
include 'connection.php';
if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                   $query = "SELECT count(*) as 'count' FROM `tbltechnical_assistance` where  tbltechnical_assistance.STATUS_REQUEST != 'Completed' and REQ_DATE != '0000-00-00'  ";
                   
                   $result = mysqli_query($conn, $query);
                   $val = array();
                   while($row = mysqli_fetch_array($result))
                   {
                    echo $row['count'];
                   }
?>