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
$select_user = mysqli_query($conn,"SELECT POSITION_C, DESIGNATION FROM tblemployeeinfo WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$POSITION_C = $rowdiv['POSITION_C'];
$DESIGNATION = $rowdiv['DESIGNATION'];
//echo $DESIGNATION;


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
  //$idGet = '100';
}

//$tocount = 'TO '.$getDate.'-'.'00'.$idGet;

if($idGet<9){
  $vrcount =$getDate.'-'.'00'.$idGet;
  
  }
  else if($idGet<99){
  
  $vrcount =$getDate.'-'.'0'.$idGet;
  
  }
  else{
  $vrcount =$getDate.'-'.$idGet;
  }


?>

<!-- value ="<?php echo date("h:i:s A");?>" -->

<!-- Insert Query -->

<?php


if(isset($_POST['submit'])){



$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$username1 = $_SESSION['username'];
 
$checked = $_POST['check'];

$pos = $_POST['pos'];
//echo $checked;

$tono = $_POST['tono'];
$date1 = $_POST['date'];
$date = date('Y-m-d', strtotime($date1));


$lastdate1 = $_POST['lastdate'];
if($lastdate1==''){
  $lastdate = '0000-00-00';
}else{

$lastdate = date('Y-m-d', strtotime($lastdate1));
}

$kita = $_POST['kita'];

$office = $_POST['office'];

$name = $_POST['name'];
$purpose = $_POST['purpose'];
$place = $_POST['place'];


$todate1 = $_POST['todate'];
$todate = date('Y-m-d', strtotime($todate1));


$fromdate1 = $_POST['fromdate'];


$fromdate = date('Y-m-d', strtotime($fromdate1));

$timefrom = $_POST['timefrom'];
$timeto = $_POST['timeto'];
$timefrom = $_POST['timefrom'];


$fromplace = $_POST['fromplace'];
$contact = $_POST['contact'];
$vehicle = $_POST['vehicle'];

$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";

$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}


  $query = mysqli_query($conn,"INSERT INTO travel_order (tono,date,office,name,purpose,place,todate,timefrom,timeto,fromplace,contact,vehicle,kita,lastdate,fromdate,pos) 
  VALUES ('$tocount','$date','$office','$name','$purpose','$place','$todate','$timefrom','$timeto','$fromplace','$contact','$vehicle','$kita','$lastdate','$fromdate','$pos')");



mysqli_close($conn);

if($query){

    // echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully added. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Travel Order has been successfully added.')
    window.location.href='TravelOrder.php';
    </SCRIPT>");

}
else{

  
  echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
   
}

}


?>
<!-- Insert Query -->
       
<div class="box">
          <div class="box-body">
      
            <h1 align="">Vehicle Request</h1>
         
        <br>
      <li class="btn btn-success"><a href="VehicleRequest.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
     
      


      <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
                <table class="table"> 
              
                <input hidden  class="" type="text" class="" style="height: 35px;" id="check" name="check" placeholder="check" >
                <input  hidden  type="text"  class="" style="height: 35px;" id="office" placeholder="office" name="office" value = "<?php echo $DIVISION_M ?>">
            
        
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

                        <td class="col-md-5 label-text" style="text-align:center">
                        <h2><b>VEHICLE REQUEST FORM (VRF)</b></h2>
                        </td>

                        <td class="col-md-0" >
                        
                        </td>

                        <td class="col-md-2  label-text" style =" border:1px solid black; background-color:#CFD8DC; text-align:center">
                        <input readonly required type="text" class="" style="text-align:center; margin-top:15px; border:none; font-size:25px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="vrno" id="vrno" value = "Control Number:" >
                        </td>
                        <td class="col-md-2" style =" border:1px solid black; text-align:center">
                        
                        <input  readonly required type="text" class="" style="text-align:center; border:none; margin-top:15px; font-size:30px; font-weight:bold; height: 30px; width:100%;" name="vrno" id="vrno" value = "<?php echo $vrcount?>" >
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
                      
                        <input readonly required type="text" class="" style="text-align:center; border:none; font-size:20px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="vrno" id="vrno" value = "A. REQUEST FOR VEHICLE (To be Accomplished by Requesting Personnel)" >
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
                        <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="vrno" id="vrno" value = "Requested Date:" >
                       
                        </td>

                        <td class="col-md-2 " style=" border:1px solid black; text-align:center; ">
                        <input readonly required type="text" class="" style=" text-align:center; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:100%;" name="vrdate" id="" value = "<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" >
                       
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                      
                      <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13 px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Requested Time:" >
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; ">
                      
                      <input readonly required type="text" class="" style=" text-align:center; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:100%;" name="vrtime" id="" value = "<?php date_default_timezone_set('Asia/Manila'); echo date('H:i A') ?>" >
                      </td>

                     
                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; ">
                      
                      <input type="checkbox" class="form-check-input " id="dropoff">
                      <input readonly  type="text" class="" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:60%;" name="" id="" value = "Drop Off" >
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center;">
                      <input type="checkbox" class="form-check-input " id="pickup">
                      <input readonly  type="text" class="" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:60%;" name="" id="" value = "Pick-up" >
                       
                      </td>

                      <td class="col-md-1 " style=" border:1px solid black; text-align:center; ">
                      <input type="checkbox" class="form-check-input " id="pickup">
                      <input readonly  type="text" class="" style=" text-align:center; border:none; font-weight:bold; font-size:12px; height: 30px; width:70%;" name="" id="" value = "Whole Day" >
                       
                      </td>

                      <td class="col-md-2 " style=" border:1px solid black; text-align:center; ">
                      <input type="checkbox" class="form-check-input " id="days">
                      <input   type="number" class="" style=" text-align:center; border:none;border-bottom:1px solid black; font-weight:bold; font-size:15px; height: 30px; width:40%;" name="nod" id="" value = "0" >
                      <input readonly  type="text" class="" style=" text-align:left; border:none; font-weight:bold; font-size:12px; height: 30px; width:40%;" name="" id="" value = "Day/s" >
                       
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
                        <input readonly  type="text"  class="" style="  text-align:left; border:none; border-bottom:1px solid black;  font-size:15px;  font-weight:bold; height: 30px; width:100%;" id="office" placeholder="office" name="office" value = "<?php echo $fullname ?>">
                       
                        </td>



                        <td rowspan="2" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="margin-top:20px; text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Purpose:" >
                       
                        </td>
                        <td colspan=3 rowspan="2" style=" border:1px solid black; text-align:center; ">
                        <input  required type="text" class="" style="text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 80px; width:100%;" name="purpose" id="purpose" value = "" placeholder="Purpose" >
                       
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
                        <input readonly  type="text"  class="" style=" text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  font-weight:bold; height: 30px; width:100%;" id="office" placeholder="office" name="office" value = "<?php echo $DIVISION_M ?>">
                       
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
                       <input readonly  required type="text" class="" style=" text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 13px; width:100%;" wrap="soft" row='2' name="" id="" value = "designation:" >

                        </td>

                        <td colspan=3 style=" border:1px solid black; text-align:center; ">
                        <input readonly  type="text"  class="" style=" text-align:left; border:none; border-bottom:1px solid black;  font-size:15px;  font-weight:bold; height: 40px; width:100%;" id="office" placeholder="office" name="office" value = "<?php echo $POSITION_M ?>">

                        </td>

                        <td rowspan="2" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="margin-top:20px; text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Destination:" >
                       
                        </td>
                        <td colspan=3 rowspan="2" style=" border:1px solid black; text-align:center; ">
                        <input  required type="text" class="" style="text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 80px; width:100%;" name="destination" id="destination" value = "" placeholder="Destination" >
                       
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
                        <input readonly  required type="text" class="" style="text-align:left; border:none; font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" name="" id="" value = "Mobile Number:" >

                        </td>

                        <td colspan=3 style=" border:1px solid black; text-align:center; ">
                        <input   type="number"   class="" style=" text-align:left; border:none; border-bottom:1px solid black; font-size:15px; height: 30px; width:100%;" id="mobile" placeholder="Mobile" name="mobile" value = "">
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
                        <input  required type="text" class="" style="margin-top:50px;text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 120px; width:100%;" name="purpose" id="purpose" value = "" placeholder="Remarks/Instructions" >
                       
                        </td>

                        <!-- Passengers/: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style=" margin-top:10px;margin-bottom:10px;text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 30px; width:100%;" wrap="soft" row='2' name="" id="" value = "Passengers/:" >
                        </td>
                        
                        </td>
                        <td colspan=3 rowspan="2" style=" border:1px solid black; text-align:center; ">
                        <input  required type="text" class="" style="text-align:left; border:none; border-bottom:1px solid black; font-size:15px;  height: 120px; width:100%;" name="passengers" id="passengers" value = "" placeholder="Passenger/s Name" >
                       
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
                        <input readonly  required type="text" class="" style=" margin-top:0px;text-align:left; border:none;  font-size:13px;  font-weight:bold; height: 30px; width:100%;" wrap="soft" row='2' name="" id="" value = "No of Passengers:" >
                        <br>
                        <input  required type="number" class="" style=" margin-top:0px;text-align:left; border:none; border-bottom:1px solid black;  font-size:13px; height: 30px; width:100%; "  name="nop" id="nop" value = "" >
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
                        
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Departure Date:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100;" name="departuredate" id="datepicker1" value = "" placeholder="mm/dd/yyyy">
                        </td>   
                      <!--  Departure Date: -->  
                       <!--  Departure Time: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Departure Time:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required  type="time" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100%;" name="departuretime" id="departuretime"></td>
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
                        
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Departure Date:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100%;" name="returndate" id="datepicker2" value = "" placeholder="mm/dd/yyyy">
                        </td>   
                      <!--  Return Date: -->  
                       <!--  Return Time: -->
                        <td class="col-md-1" style=" border:1px solid black; text-align:center; background-color:#CFD8DC;">
                        <input readonly  required type="text" class="" style="text-align:left; border:none;  font-size:13px; background-color:#CFD8DC; font-weight:bold; height: 12px; width:100%;" wrap="soft" row='2' name="" id="" value = "Departure Time:" >
                        </td>   

                        <td class="col-md-1" style=" border:1px solid black; text-align:center; ">
                        <input required  type="time" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:100%;" name="returntime" id="returntime"></td>
                        </td>   
                         <!--  Return Time: -->


                        <td class="col-md-1">

                        </td> 

                        </tr>
                        <!-- body sign -->

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


</body>
</html>