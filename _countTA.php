<?php
     $link = mysqli_connect("localhost","root","", "fascalab_2020");
     if(mysqli_connect_errno()){echo mysqli_connect_error();}  

                   $query = "SELECT count(*) as 'count' from tbltechnical_assistance where `STATUS_REQUEST` = 'Submitted'  ";
                   $result = mysqli_query($link, $query);
                   $val = array();
                   while($row = mysqli_fetch_array($result))
                   {
                    echo $row['count'];
                   }
?>