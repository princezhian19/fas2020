<?php
$id = $_POST['id'];
$link = mysqli_connect("localhost","fascalab_2020","", "fascalab_2020");
if(mysqli_connect_errno()){echo mysqli_connect_error();}  


$query = "SELECT EMP_N,MOBILEPHONE, EMAIL,DIVISION_N, DIVISION_M , POSITION_M FROM tblpersonneldivision 
          INNER JOIN tblemployeinfo on tblpersonneldivision.DIVISION_N = tblemployeinfo.DIVISION_C 
          INNER JOIN tbldilgposition on tblemployeinfo.POSITION_C = tbldilgposition.POSITION_ID
          where EMP_N =  $id ";
$result = mysqli_query($link, $query);
              while($row = mysqli_fetch_array($result)){
                  $currentuser = $row['EMP_N'];
                  $office = $row['DIVISION_M'];
                  $position = $row['POSITION_M'];
                  $phone = $row['MOBILEPHONE'];
                  $email = $row['EMAIL'];
                  $return_arr[] = array(
                    "currentuser"=>$currentuser,
                    "office" => $office,
                    "position"=> $position,
                    "phone"=>$phone,
                    "email"=>$email
                  
                   );
            }
echo json_encode($return_arr);

              

?>