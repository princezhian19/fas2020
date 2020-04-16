<?php
include 'connection.php';
if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                   $query = "SELECT count(*) as 'count' from tbltechnical_assistance where `STATUS_REQUEST` = 'Submitted'  ";
                   $result = mysqli_query($conn, $query);
                   $val = array();
                   while($row = mysqli_fetch_array($result))
                   {
                    echo $row['count'];
                   }
?>