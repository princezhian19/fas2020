

<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
 
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$query = mysqli_query($conn, "SELECT FIRST_M,MIDDLE_M, LAST_M, DIVISION_C FROM tblemployeeinfo where UNAME  = '$username'");

$row = mysqli_fetch_array($query);


    $f = $row['FIRST_M'];
    $mi = $row['MIDDLE_M'];
    $m = substr($mi, 0, 1);
    $l= $row['LAST_M'];
   
    $firstname = ucwords(strtolower($f));

    $lname = ucfirst($l);             // HELLO WORLD!
    $lastname = ucfirst(strtolower($l));

  $fullname = $firstname.' '.$m.' '.$lastname;

// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';

//Get Office
$select_user = mysqli_query($conn,"SELECT POSITION_C, DESIGNATION, MOBILEPHONE FROM tblemployeeinfo WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$POSITION_C = $rowdiv['POSITION_C'];
$DESIGNATION = $rowdiv['DESIGNATION'];
$MOBILEPHONE = $rowdiv['MOBILEPHONE'];
//echo $MOBILEPHONE;


//Get Position
$select_position = mysqli_query($conn,"SELECT  POSITION_M FROM tbldilgposition WHERE POSITION_ID = '$POSITION_C'");
$rowdiv1 = mysqli_fetch_array($select_position);
$POSITION_M = $rowdiv1['POSITION_M'];
//echo $POSITION_M;


$select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
$rowdiv1 = mysqli_fetch_array($select_office);
$DIVISION_M = $rowdiv1['DIVISION_M'];

$checked = "";



//count ob
$idGet='';
$getDate = date('Y');
$m = date('m');
$auto = mysqli_query($conn,"SELECT max(count)+1 as a FROM vr_count order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {

  $idGet = $row["a"];
  echo $idget;
}
  
if($idGet<9){
  $vrcount =$getDate.'-'.'00'.$idGet;
  
  
  }
  else if($idGet<99){
  
  $vrcount =$getDate.'-'.'0'.$idGet;
  
  
  }
  else{
  $vrcount =$getDate.'-'.$idGet;
  
  }
  $vrcount11 =''.$idGet;
  

?>


<?php

$id=$_GET['id'];
$typeget=$_GET['type'];


$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$view_query = mysqli_query($conn, "SELECT * from vr where id = '$id'");

    while ($row = mysqli_fetch_assoc($view_query)) {

        $id=$row['id'];
        $vrno = $row['vrno'];

        $vrdate1 = $row['vrdate'];
        $vrdate = date('F d, Y', strtotime($vrdate1));

        $vrtime1 = $row['vrtime'];
        $vrtime=  date("h:i A",strtotime($vrtime1));

        $type = $row['type'];
        $nod = $row['nod'];
        
        $name = $row['name'];
        $office = $row['office'];
        $position = $row['position'];
        $mobile = $row['mobile'];
        $remarks = $row['remarks'];
        $purpose = $row['purpose'];
        $destination = $row['destination'];
        $nop = $row['nop'];


        $departuredate1 = $row['departuredate'];
        $departuredate = date('m/d/Y', strtotime($departuredate1));


        $departuretime1 = $row['departuretime'];
        $departuretime=  date("g:i A",strtotime($departuretime1));


        $returndate1 = $row['returndate'];
        $returndate = date('m/d/Y', strtotime($returndate1));


        $returntime1 = $row['returntime'];
        $returntime=  date("g:i A",strtotime($returntime1));




        $reason = $row['reason'];
        $status=$row['status'];
        $pos=$row['pos'];
    }

?>


<!-- Update Query -->

<?php


if(isset($_POST['submit'])){


$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$username1 = $_SESSION['username'];
//input check value
$checked = $_POST['check'];
echo $checked;
/* Requset vr_count */
$vr_c = $_POST['vr_c'];


$vrno1 = $_POST['vrno'];
$vrdate11 = $_POST['vrdate'];
$vrdate1 = date('Y-m-d', strtotime($vrdate11));


$vrtime11 = $_POST['vrtime'];
$vrtime1 = date('H:i', strtotime($vrtime11));

$nod1 = $_POST['nod'];

$type1="";

if($checked=='dropoff'){
$type1="Drop Off";

}
else if($checked=='pickup'){
  $type1="Pick-up";

}
else if($checked=='wholeday'){

  $type1="Whole Day";
}
else if($checked=='Day/s'){
  $type1=$nod." Day/s";

}
else{
 // $type1="";
 
}

/* echo $type;
exit(); */
$name1 = $_POST['name'];
$office1 = $_POST['office'];
$pos1 = $_POST['pos'];
$mobile1 = $_POST['mobile'];
$purpose1 = $_POST['purpose'];
$destination1 = $_POST['destination'];
$nop1 = $_POST['nop'];

$departuredate11= $_POST['departuredate'];
$departuredate1 = date('Y-m-d', strtotime($departuredate11));

$departuretime1 = $_POST['departuretime'];

$returndate11= $_POST['returndate'];
$returndate1 = date('Y-m-d', strtotime($returndate11));

$returntime1 = $_POST['returntime'];



$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if($checked==''){
 echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Type is a required field.  </p> </div></div>  '; 

}
else
{
  $query2 = mysqli_query($conn, "DELETE from vr_passengers where vrid='$vrno' ");
  /* echo "DELETE from vr_passengers where vrid='$vrno' ";
  exit(); */

  /* insert to vr_passengers table */
  $passengers = $_POST["passengers"];
  $p  = preg_split('/\r\n|\n|\r/', $passengers);


  foreach($p as $ps)
  {

  $query2 = mysqli_query($conn, "INSERT INTO  vr_passengers (vrid,name) VALUES ('".$vrno."','".$ps."')");

  }

  /* insert to vr table */
  $query = mysqli_query($conn,"UPDATE vr set vrno='$vrno1',vrdate='$vrdate1',vrtime='$vrtime1',type='$type1',name='$name1',office='$office1',position='$pos1',mobile='$mobile1',purpose='$purpose1',destination='$destination1',nop='$nop1',departuredate='$departuredate1',departuretime='$departuretime1',returndate='$returndate1',returntime='$returntime1',pos='$pos1' where id = '$id'");

 /*  echo "UPDATE vr set vrno='$vrno1',vrdate='$vrdate1',vrtime='$vrtime1',type='$type1',name='$name1',office='$office1',position='$pos1',mobile='$mobile1',purpose='$purpose1',destination='$destination1',nop='$nop1',departuredate='$departuredate1',departuretime='$departuretime1',returndate='$returndate1',returntime='$returntime1',pos='$pos1' where id = '$id'";
  exit();
   */


mysqli_close($conn);

if($query){
  


    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Vehicle Request has been successfully updated.')
    window.location.href='VehicleRequest.php';
    </SCRIPT>");

}
else{
  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
   
}
}

}


?>
<!-- Insert Query -->
       
<div class="box">
          <div class="box-body">
      
            <h1 align="">Update Vehicle Request</h1>
            
        <br>
      <li class="btn btn-warning"><a href="VehicleRequest.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
     
      


      <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
                <table class="table"> 
              
                <input hidden  class="" type="text" class="" style="height: 35px;" id="check" name="check" placeholder="check"  value ="<?php echo $type?>">
                <input  hidden class="" type="text" class="" style="height: 35px;" id="vr_c" name="vr_c" placeholder="" value ="<?php echo $vrcount11?>">
                
                
            
        
                <!-- Header -->
                <tr>
                <td class="col-md-1">

                </td>
                    
                <td class="col-md-8"  colspan="1">
                   
                    <img id="img" class="pull-left"  style="margin-top:0px; margin-bottom:0px; width:100;height:120px;" src='images/male-user.png' title = "" />
                    &nbsp; &nbsp; &nbsp;
                    <b>Republic of the Philippines</b>
                    <br>
                    &nbsp; &nbsp; &nbsp;
                    <b>Department of the Interior and Local Government</b>
                    <br>
                    &nbsp; &nbsp; &nbsp;
                    <b>Region IV-A (CALABARZON)</b>
                    <br>
                    &nbsp; &nbsp; &nbsp;
                    3/F Andenson Bldg. 1, National Highway, Brgy. Parian, City of Calamba, Laguna 4027
                    <br>
                    &nbsp; &nbsp; &nbsp;
                    827-4745; 827-4560; 827-4587; 827-3143  827-4745
                    <br>
                    &nbsp; &nbsp; &nbsp;
                    dilg4a.calabarzon@gmail.com  www.calabarzon.dilg.gov.ph
                   
                </td>
                <td class="col-md-0" >
                
                </td>

                <td class="col-md-2" >
                <img id="img" class="pull-right"  style="margin-top:0px; margin-bottom:0px; width:100;height:120px;" src='vehicle.PNG' title = "" />
                </td>

               

                <td class="col-md-1">
                
                </td> 
           
               
                </tr>
                <!-- Header -->

            
                </table>


                <table class="table">
                
                        <!-- Header -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-6" style="text-align:center">
                        <h2><b>VEHICLE REQUEST FORM (VRF)</b></h2>
                        </td>

                        <td class="col-md-0" >
                        
                        </td>

                        <td class="col-md-2  label-text" style =" border:1px solid black; background-color:#CFD8DC; text-align:center">
                        <input readonly required type="text" class="" style="text-align:center; margin-top:15px; border:none; font-size:23px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Control Number:" >
                        </td>
                        <td class="col-md-2" style =" border:1px solid black; text-align:center">
                        
                        <input  readonly required type="text" class="" style="text-align:center; border:none; margin-top:15px; font-size:30px; color:red; font-weight:bold; height: 30px; width:100%;" name="vrno" id="vrno" value = "<?php echo $vrno?>" >
                        </td>
                        
                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- Header -->

                </table>

                
                <table class="table">
                
                        <!-- A -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=8 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                      
                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:20px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "A. REQUEST FOR VEHICLE (To be Accomplished by Requesting Personnel)" >
                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- A -->

                        <!-- body -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <!-- <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="vrno" id="vrno" value = "Requested Date:" > -->
                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 10px; width:100%;" wrap="soft" row='2' name="" id="" value = "Requested" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#CFD8DC; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Date:" >
                        </td>

                        <td class="col-md-2 " style=" border:1px solid black; text-align:left; ">
                        <input readonly required type="text" class="" style=" text-align:left; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:100%;" name="vrdate" id="vrdate" value = "<?php echo $vrdate?>" >
                       
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                      
                      <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 10px; width:100%;" wrap="soft" row='2' name="" id="" value = "Requested" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#CFD8DC; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Time:" >  
                        <!-- <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Requested Time:" > -->
                      
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:left; ">
                      
                      <input readonly required type="text" class="" style=" text-align:left; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:100%;" name="vrtime" id="" value = "<?php echo $vrtime?>" >
                      </td>

                     
                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; ">
                        
                        <?php if($type == 'Drop Off'): ?>
                        <input type="checkbox"  onclick="myFunction()" class = "checkboxgroup_g1" id="dropoff" <?php echo "checked='checked'"; ?>>
                        <input readonly  type="text" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:60%;" name="" id="" value = "Drop Off" >
                        <?php else:?>
                        <input type="checkbox"  onclick="myFunction()" class = "checkboxgroup_g1" id="dropoff" >
                        <input readonly  type="text" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:60%;" name="" id="" value = "Drop Off" >
                        <?php endif?>
                     
                        
                        </td> 
                      

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center;">
                      <?php if($type == 'Pick-up'): ?>
                      <input type="checkbox" onclick="myFunction1()" class = "checkboxgroup_g2" id="pickup"<?php echo "checked='checked'"; ?>>
                      <input readonly  type="text" class="" style=" text-align:left; border:none; font-weight:bold; font-size:14px; height: 30px; width:60%;" name="" id="" value = "Pick-up" >
                      <?php else:?>
                        <input type="checkbox" onclick="myFunction1()" class = "checkboxgroup_g2" id="pickup">
                      <input readonly  type="text" class="" style=" text-align:left; border:none; font-weight:bold; font-size:14px; height: 30px; width:60%;" name="" id="" value = "Pick-up" >
                      <?php endif?>
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; ">
                      <?php if($type == 'Whole Day'): ?>
                      <input type="checkbox" onclick="myFunction2()" class = "checkboxgroup_g3" id="wholeday" <?php echo "checked='checked'"; ?>>
                      <input readonly  type="text" class="" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:70%;" name="" id="" value = "Whole Day" >
                      <?php else:?> 
                        <input type="checkbox" onclick="myFunction2()" class = "checkboxgroup_g3" id="wholeday" >
                      <input readonly  type="text" class="" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:70%;" name="" id="" value = "Whole Day" >
                      <?php endif?>
                      </td>

                      <td class="col-md-2 " style=" border:1px solid black; text-align:center; ">
                      <?php if($type == 'Day/s'): ?>
                      <input type="checkbox" onclick="myFunction3()" class = "checkboxgroup_g4" id="days" <?php echo "checked='checked'"; ?>>
                      <input type="number" class="" style=" text-align:center; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:40%;" name="nod" id="nod" value = "<?php echo $nod?>" placeholder="">
                      <input readonly  type="text" class="" style=" text-align:left; border:none; font-weight:bold; font-size:12px; height: 30px; width:40%;" name="" id="" value = "Day/s" >
                      <?php else:?>
                        <input type="checkbox" onclick="myFunction3()" class = "checkboxgroup_g4" id="days">
                      <input  disabled type="number" class="" style=" text-align:center; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:40%;" name="nod" id="nod" value = "" placeholder="0">
                      <input readonly  type="text" class="" style=" text-align:left; border:none; font-weight:bold; font-size:12px; height: 30px; width:40%;" name="" id="" value = "Day/s" > 
                      
                      <?php endif?>
                      </td>
                    
                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- Body -->



                        <!-- body details -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Requested By:" >
                       
                        </td>

                        <td colspan=3 style=" border:1px solid black; text-align:center; ">
                        <input readonly  type="text"  class="" style="  text-align:left; border:none; border-bottom:1px solid black;  font-size:15px;  font-weight:bold; height: 30px; width:100%;" id="name" placeholder="name" name="name" value = "<?php echo $name ?>">
                       
                        </td>



                        <td rowspan="2" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="margin-top:20px; text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Purpose:" >
                       
                        </td>
                        <td colspan=3 rowspan="2" style=" border:1px solid black; text-align:center; ">
                        <input  required type="text" class="" style="text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 80px; width:100%;" name="purpose" id="purpose" value = "<?php echo $purpose ?>" placeholder="" >
                       
                        </td>
                        
                     
                      

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body details -->

                        <!-- body details1 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input  required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Office:" >

                        </td>

                        <td colspan=3 style=" border:1px solid black; text-align:center; ">
                        <input readonly  type="text"  class="" style=" text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  font-weight:bold; height: 30px; width:100%;" id="office" placeholder="office" name="office" value = "<?php echo $office ?>">
                       
                        </td>

                      

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body details1 -->

                        <!-- body details2 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 
                    
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                         <input readonly  required type="text" class="" style=" text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Position/" >
                       <input readonly  required type="text" class="" style=" text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 13px; width:100%;" wrap="soft" row='2' name="" id="" value = "Designation:" >

                        </td>

                        <td colspan=3 style=" border:1px solid black; text-align:center; ">
                        <input readonly  type="text"  class="" style=" text-align:left; border:none; border-bottom:1px solid black;  font-size:15px;  font-weight:bold; height: 40px; width:100%;" id="pos" placeholder="" name="pos" value = "<?php echo $pos ?>">

                        </td>

                        <td rowspan="2" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="margin-top:20px; text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Destination:" >
                       
                        </td>
                        <td colspan=3 rowspan="2" style=" border:1px solid black; text-align:center; ">
                        <input required  required type="text" class="" style="text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 100px; width:100%;" name="destination" id="destination" value = "<?php echo $destination ?>" placeholder="" >
                       
                        </td>


                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body details2 -->

                        <!-- body details3 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 15px; width:100%;" name="" id="" value = "Mobile" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 15px; width:100%;" name="" id="" value = "Number:" >
                        </td>

                        <td colspan=3 style=" border:1px solid black; text-align:center; ">
                        <input readonly  type="text"   class="" style=" text-align:left; border:none; border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 40px; width:100%;" id="mobile" placeholder="" name="mobile" value = "<?php echo $mobile?>">
                        </td>


                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body details3 -->

                        <!-- body remarks -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                       
                        <td rowspan="3" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style=" margin-top:70px;text-align:left; border:none;  font-size:15px; background-color:#CFD8DC; font-weight:bold; height: 13px; width:100%;" wrap="soft" row='2' name="" id="" value = "Remarks/" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:15px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Instructions:" >
                       
                        </td>
                        <td colspan=3 rowspan="3" style=" border:1px solid black; text-align:center; ">
                        <input  type="text" class="" style="margin-top:0px;text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 190px; width:100%;" name="remarks" id="remarks" value = "<?php echo $remarks ?>" placeholder="" >
                       
                        </td>

                        <!-- Passengers/: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style=" margin-top:10px;margin-bottom:10px;text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" wrap="soft" row='2' name="" id="" value = "Passengers/:" >
                        </td>
                        
                        </td>
                        <td colspan=3 rowspan="2" style=" border:1px solid black; text-align:left; ">
                        <!-- Get Multiple data from passengers -->
                        <?php
                        $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
                        function passengers($connect)
                        {
                        $vrnoget=$_GET['vrno'];
                       
                        $output = '';
                        
                        $query11 = "SELECT name FROM vr_passengers where vrid = '$vrnoget'";
                        
                        $statement1 = $connect->prepare($query11);
                        $statement1->execute();
                        $result1 = $statement1->fetchAll();
                        foreach($result1 as $row11)
                        {
                        $output .= $row11["name"]."\n";
                        
                        }
                        return $output;
                        }
                        ?>
                        
                        <textarea required rows = "50" cols="1" name="passengers" id="passengers" style="text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 135px; width:100%;"><?php echo passengers($connect)?></textarea>
                        
                      </td>
                      <!-- Passengers/: -->

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body remarks -->

                        <!-- body passengers -->
                        <tr>

                        <td class="col-md-1">

                        </td> 


                       <!--  No. of Passengers -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:left; ">
                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px;  font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "No of " >
                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:12px;  font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Passengers:" >
                        <br>
                        <input required type="number" class="" style=" margin-top:0px;text-align:left; border:none; border-bottom:1px solid black; font-weight:bold;  font-size:13px; height: 30px; width:100%; "  name="nop" id="nop" value = "<?php echo $nop;?>" placeholder="0" >
                        </td> 
                        

                        

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body passengers -->

                        <!-- body passengers1 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                       <!--  Departure Date: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:11px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Departure Date:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100;" name="departuredate" id="datepicker1" value = "<?php echo $departuredate;?>" placeholder="mm/dd/yyyy">
                        </td>   
                      <!--  Departure Date: -->  
                       <!--  Departure Time: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:11px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Departure Time:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required  type="time" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100%;" name="departuretime" id="departuretime" value = "<?php echo $departuretime1;?>">
                        </td>   
                         <!--  Departure Time: -->

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body passengers1 -->

                        <!-- body sign -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                       
                       <input readonly  required type="text" class="" style="margin-top:10px;text-align:left; border:none;  font-size:15px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Signature:" >
                        </td>
                        <td colspan=3  style=" border:1px solid black; text-align:center; ">
                        <!-- <input  required type="text" class="" style="margin-top:0px;text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 30px; width:100%;" name="purpose" id="purpose" value = "" placeholder="Remarks/Instructions" > -->
                       
                        </td>
                       

                       <!--  Return Date: -->
                       <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:11px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Return Date:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100%;" name="returndate" id="datepicker2" value = "<?php echo $returndate;?>" placeholder="mm/dd/yyyy">
                        </td>   
                      <!--  Return Date: -->  
                       <!--  Return Time: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:11px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Return Time:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required  type="time" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100%;" name="returntime" id="returntime" value = "<?php echo $returntime1;?>">
                        </td>   
                         <!--  Return Time: -->


                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body sign -->


                        <!-- B -->
                        <tr >

                        <td class="col-md-1">

                        </td> 

                        <td  colspan=8 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:20px; background-color:#D0D0D0; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "B.	RECEIVED BY GSS  SECTION (To be Accomplished by GSS Staff)" >
                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>
                       

                       
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Received" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Date:" >

                        </td>

                        <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                      

                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Received" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Time:" >
                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                      
                        </td>


                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">

                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Received" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "By:" >
                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                       

                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">
                        <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Signature:" >

                        </td>

                        <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
              

                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- B -->


                        <!-- C -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=8 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:20px; background-color:#D0D0D0; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "C. ASSIGN VEHICLE (To be Accomplished by Dispatcher)" >
                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>
                       
                        <!-- c1 -->
                       
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Assigned" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Date:" >

                        </td>

                        <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                      

                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Assigned" >
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Time:" >
                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                      
                        </td>


                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">

                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Dispatcher:" >
     
                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                       
                        </td>

                        <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">
                        <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Signature:" >

                        </td>

                        <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
              

                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- c2 --> 
                          <tr>

                          <td class="col-md-1">

                          </td> 

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                          <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Assigned Vehicle" >
                         
                          </td>

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                          <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Assigned Driver" >
                          </td>

                          <td colspan=2 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                          <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Vehicle’s Plate Number" >
                          </td>

                          <td class="col-md-1">

                          </td> 

                          </tr>

                          <!-- c3 --> 
                          <tr>

                          <td class="col-md-1">

                          </td> 

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                          <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0;  font-weight:bold; height: 25px; width:100%;" name="" id="" value = "1." >

                          </td>

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                         
                          </td>

                          <td colspan=2 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;;">

                         
                          </td>

                          <td class="col-md-1">

                          </td> 

                          </tr>

                          <!-- c4 --> 
                          <tr>

                          <td class="col-md-1">

                          </td> 

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">
                          <input readonly  required type="text" class="" style="text-align:left; border:none; background-color:#D0D0D0;font-size:13 px;  font-weight:bold; height: 25px; width:100%;" name="" id="" value = "2." >

                          </td>

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center;background-color:#D0D0D0;">


                          </td>

                          <td colspan=2 class=" label-text" style=" border:1px solid black; text-align:center; ;background-color:#D0D0D0;">


                          </td>

                          <td class="col-md-1">

                          </td> 

                          </tr>

                          <!-- c5 --> 
                          <tr>

                          <td class="col-md-1">

                          </td> 

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                          <input readonly  required type="text" class="" style="text-align:left; border:none; background-color:#D0D0D0;font-size:13 px;  font-weight:bold; height: 25px; width:100%;" name="" id="" value = "3." >

                          </td>

                          <td colspan=3 class=" label-text" style=" border:1px solid black; text-align:center;background-color:#D0D0D0; ">


                          </td>

                          <td colspan=2 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;;">


                          </td>

                          <td class="col-md-1">

                          </td> 

                          </tr>

                          <!-- c6 --> 
                          <tr>

                          <td class="col-md-1">

                          </td> 

                          <td colspan=8 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                          <input readonly  required type="text" class="" style="text-align:left; border:none; background-color:#D0D0D0;font-size:13 px;  font-weight:bold; height: 40px; width:100%;" name="" id="" value = "Remarks" >

                          </td>

                         

                          <td class="col-md-1">

                          </td> 

                          </tr>



                    </tr>
                        <!-- C -->


                        <!-- D -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=8 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:20px; background-color:#D0D0D0; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "D. APPROVAL/DISAPPROVAL" >
                        </td>

                       

                        <td class="col-md-1">

                        </td> 

                        </tr>

                        <!-- D11 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=8 class=" label-text" style=" border:1px solid black; background-color:#D0D0D0;">
                        <!-- <input type="checkbox" class="form-check-input " id="dropoff" style="background-color:#D0D0D0;"> -->
                        <input readonly  type="text" class="" style=" text-align:left; border:none; background-color:#D0D0D0; font-weight:bold; font-size:20px; height: 30px; width:60%;" name="" id="" value = "APPROVED" >
                       
                        </td>

                       

                        <td class="col-md-1">

                        </td> 

                        </tr>




                        <!-- D1 -->

                        
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=4 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:15px;background-color:#D0D0D0; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "RECOMMENDING APPROVAL" >
                        </td>

                        <td colspan=4 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:15px; background-color:#D0D0D0;font-weight:bold; height: 20px; width:100%;" name="" id="" value = "APPROVED BY" >
                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>

                        <!-- D2 -->
                        <tr>


                            <td class="col-md-1">

                            </td> 

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                            <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Recommended" >
                            <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Date:" >

                            </td>

                            <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">


                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                            <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Recommended" >
                            <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Time:" >
                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">


                            </td>


                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">

                            <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Approved" >
                            <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Date:" >
                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">
                            <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Approved" >
                            <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Time:" >
                            </td>

                            <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">


                            </td>

                            <td class="col-md-1">

                            </td>

                        </tr>

                        <!-- D3 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=4 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="background-color:#D0D0D0; margin-top:20px;text-align:center; border:none; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "_____________________________" >
                        <input readonly required type="text" class="" style="background-color:#D0D0D0;text-align:center; border:none; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "BEZALEEL O. SOLTURA" >
                        <input readonly required type="text" class="" style="background-color:#D0D0D0;margin-bottom:10px; text-align:center; border:none; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "Chief, GSS Section" >
                        </td>

                        <td colspan=4 class=" label-text" style=" border:1px solid black; text-align:center;background-color:#D0D0D0;">

                       
                        <input readonly required type="text" class="" style="background-color:#D0D0D0;margin-top:20px; text-align:center; border:none; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "_____________________________" >
                        <input readonly required type="text" class="" style="background-color:#D0D0D0;text-align:center; border:none; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "ARIEL O. IGLESIA" >
                        <input readonly required type="text" class="" style="background-color:#D0D0D0;margin-bottom:10px; text-align:center; border:none; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "Regional Director" >
                        </td>

                        <td class="col-md-1">

                        </td> 

                        </tr>

                        <!-- D4 -->
                        <tr>

                        <td class="col-md-1">

                        </td> 

                        <td colspan=4 class=" label-text" style=" border:1px solid black; text-align:left; background-color:#D0D0D0; ">
                        <!-- <input type="checkbox" class="form-check-input " id="dropoff" > -->
                        <input readonly  type="text" class="" style=" background-color:#D0D0D0;text-align:left; border:none; font-weight:bold; font-size:20px; height: 30px; width:60%;" name="" id="" value = "DISAPPROVED" >
                       
                        </td>

                        <td rowspan="2" class=" label-text" style=" border:1px solid black; text-align:left; background-color:#D0D0D0;">

                        <input readonly required type="text" class="" style="margin-top:30px;text-align:center; border:none; background-color:#D0D0D0; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "Reason/s:" >
                       
                        </td>

                        <td colspan=3 rowspan="2" class=" label-text" style=" border:1px solid black; text-align:center;background-color:#D0D0D0;">


                       
                        </td>

                    

                        <td class="col-md-1">

                        </td> 

                        </tr>

                          <!-- D5 -->
                          <tr>

                          <td class="col-md-1">

                          </td> 

                            <td class="col-md-1 " style=" border:1px solid black; text-align:left; background-color:#D0D0D0; ">
                            <input readonly required type="text" class="" style="margin-top:10px;text-align:left; border:none; background-color:#D0D0D0; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "Date:" >
                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">
                            
                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:left; background-color:#D0D0D0; ">
                            <input readonly required type="text" class="" style="margin-top:10px;text-align:left; border:none; background-color:#D0D0D0; font-size:15px; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "Time:" >
                            </td>

                            <td class="col-md-1 " style=" border:1px solid black; text-align:center;background-color:#D0D0D0; ">
                         
                            </td>
                         
                          <td class="col-md-1">

                          </td> 

                          </tr>
                      <!-- D -->

                      <!-- D(1) -->
                      <tr>

                      <td class="col-md-1">

                      </td> 

                      <td colspan=8 class=" label-text" style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                      <input readonly required type="text" class="" style="text-align:center; border:none; font-size:20px; background-color:#D0D0D0; font-weight:bold; height: 20px; width:100%;" name="" id="" value = "D. SERVE COPY TO REQUESTING OFFICE " >
                      </td>



                      <td class="col-md-1">

                      </td> 

                      </tr>

                      <td class="col-md-1">

                      </td> 

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">
                      <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Served" >
                      <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Date:" >

                      </td>

                      <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">


                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">

                      <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Served" >
                      <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Time:" >
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">


                      </td>


                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">

                      <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "Served " >
                      <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:12px; background-color:#D0D0D0; font-weight:bold; height: 15px; width:100%;" wrap="soft" row='2' name="" id="" value = "To:" >
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center;background-color:#D0D0D0;">

                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0; ">
                      <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#D0D0D0; font-weight:bold; height: 25px; width:100%;" name="" id="" value = "Signature:" >
                 
                      </td>

                      <td class="col-md-2 " style=" border:1px solid black; text-align:center; background-color:#D0D0D0;">


                      </td>

                      <td class="col-md-1">

                      </td>

                      </tr>
                      <!-- D(1) -->
                </table>


                <br>
                <br>
               

               


               

                
                    <input type="submit" name="submit" class="btn btn-primary pull-left" value="Save" id="butsave">

                    <br>
                    <br>  
                </div>
              </form>
                
          </div>
          </div>

      
   
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 
 <script>
function myFunction() {
  var date = document.getElementById("datepicker1");
  var text = document.getElementById("datepicker2");
  

 
  if (date==""){
   

    text.val('');
    
  } else {
   

    check.val(date);
  }


}
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker1').timepicker({
      showInputs: true
    })

    $('.timepicker2').timepicker({
      showInputs: true
    })
  })
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
function myFunction() {
  var dropoff = document.getElementById("dropoff");
 

  var check = $("input[name='check']");

  if (dropoff.checked == true)
  {
    $("#nod").attr("disabled", "disabled");

    check.val('dropoff');
    // alert(check.val());
    
  }
  else{

    $("#nod").attr("disabled", "disabled");

    check.val('');
    // alert(check.val());
  }

  
}

function myFunction1() {
 
  var pickup = document.getElementById("pickup");
 
  var check1 = $("input[name='check']");

  if (pickup.checked == true)
  {
    $("#nod").attr("disabled", "disabled");

    check1.val('pickup');
    // alert(check1.val());
    
  }
  else{

    $("#nod").attr("disabled", "disabled");

    check1.val('');
    // alert(check1.val());
  }

  
}

function myFunction2() {
 
  var wholeday = document.getElementById("wholeday");
 
  var check2 = $("input[name='check']");

  if (wholeday.checked == true)
  {
    $("#nod").attr("disabled", "disabled");

    check2.val('wholeday');
    // alert(check2.val());
    
  }
  else{

    $("#nod").attr("disabled", "disabled");

    check2.val('');
    // alert(check2.val());
  }

  
}

function myFunction3() {
  
  var days = document.getElementById("days");

  var check3 = $("input[name='check']");

  if (days.checked == true)
  {
    $("#nod").removeAttr("disabled");
    $("#nod").focus();

    check3.val('Day/s');
    // alert(check3.val());
    
  }
  else{
    check3.val('');
    $("#nod").attr("disabled", "disabled");

   
    // alert(check3.val());
  }

  
}

</script>

<script>
$(document).ready(function(){

  var check = $("input[name='check']");

  $('.checkboxgroup_g1').on('change', function() {
      $('.checkboxgroup_g2').not(this).prop('checked', false);  
      $('.checkboxgroup_g3').not(this).prop('checked', false); 
      $('.checkboxgroup_g4').not(this).prop('checked', false);
      // check.val('');
      check.val('dropoff');
  });

  
  $('.checkboxgroup_g2').on('change', function() {
      $('.checkboxgroup_g1').not(this).prop('checked', false);  
    
      $('.checkboxgroup_g3').not(this).prop('checked', false); 
      $('.checkboxgroup_g4').not(this).prop('checked', false);
      // check.val('');
      check.val('pickup');

  });
  $('.checkboxgroup_g3').on('change', function() {
    $('.checkboxgroup_g1').not(this).prop('checked', false);  
    
    $('.checkboxgroup_g2').not(this).prop('checked', false); 
    $('.checkboxgroup_g4').not(this).prop('checked', false); 
    // check.val('');
    check.val('wholeday'); 
  });

  
  $('.checkboxgroup_g4').on('change', function() {
    $('.checkboxgroup_g1').not(this).prop('checked', false);  
    
    $('.checkboxgroup_g2').not(this).prop('checked', false); 
    $('.checkboxgroup_g3').not(this).prop('checked', false);
    // check.val('');
   
    check.val('Day/s');
    
    
  });
  

});
</script>
<script>

/* $("#passengers").on("change keyup", function(){
    $("#passengers").val($(this).val()+';');
}); */

</script>  



</body>
</html>