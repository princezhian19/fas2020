<?php


session_start();
$conn=mysqli_connect("localhost","fascalab_2020","","loop");

$sql = "SELECT FLAGAS, URL, ROUTING_N, ROUTED_TO, ROUTED_FROM, concat(FIRST_M,' ', LAST_M) as NAME, UNAME, ACTION, REMARKS, DATE_ROUTED, TIME_ROUTED
                                     from tblrouting
                                    left join tblemployeinfo on tblrouting.SENDER_M=tblemployeinfo.EMP_N
                                     where RECORD_N='R190326-10' ";  
      $result = mysqli_query($conn, $sql);  
      
      $routingN = mysqli_fetch_array($result);
      $RoutN = $routingN['ROUTING_N'];
      $Rmarks = $routingN['REMARKS'];
      
      $select_fp = "SELECT * from tblroutingfiles where ROUTING_N ='".$RoutN."' ORDER BY ROUTING_N DESC ";
      $result_fp = mysqli_query($conn, $select_fp); 
      $FP = mysqli_fetch_array($result_fp);
      $f_path = $FP['FILE_M'];
      $f1_path = $FP['ROUTING_N'];
      echo $f1_path;
//====+
// END OF FILE
//====+
