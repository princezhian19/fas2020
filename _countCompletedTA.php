<?php
session_start();
$sess_name = $_SESSION['complete_name'];
     $link = mysqli_connect("localhost","root","", "db_dilg_pmis");
     if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                   $query = "SELECT count(*) as 'count' FROM `tbltechnical_assistance` where  tbltechnical_assistance.STATUS_REQUEST = 'Completed' and REQ_BY LIKE '%$sess_name%'  ";
                   $result = mysqli_query($link, $query);
                   $val = array();
                   while($row = mysqli_fetch_array($result))
                   {
                    echo $row['count'];
                   }
?>