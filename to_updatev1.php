<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $query = mysqli_query($conn, "SELECT FIRST_M,MIDDLE_M, LAST_M, DIVISION_C FROM tblemployee where UNAME  = '$username'");
  
  $row = mysqli_fetch_array($query);
  
  
      $f = $row['FIRST_M'];
      $m = $row['MIDDLE_M'];
      $l= $row['LAST_M'];
     
  
  
  // echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
  // echo '<br>';
  
  
//Get Office
$select_user = mysqli_query($conn,"SELECT DIVISION_C, DESIGNATION FROM tblemployee WHERE UNAME = '$username'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
$DESIGNATION = $rowdiv['DESIGNATION'];
//echo $DESIGNATION;


//Get Position
$select_position = mysqli_query($conn,"SELECT  POSITION_M FROM tblposition WHERE POSITION_C = '$DESIGNATION'");
$rowdiv1 = mysqli_fetch_array($select_position);
$POSITION_M = $rowdiv1['POSITION_M'];
//echo $POSITION_M;
  
  $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
  $rowdiv1 = mysqli_fetch_array($select_office);
  $DIVISION_M = $rowdiv1['DIVISION_M'];
  
  $checked = "";

// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';
?>

<?php

$id=$_GET['id'];
//echo $id;
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$view_query = mysqli_query($conn, "SELECT * from travel_order where id = '$id'");



    while ($row = mysqli_fetch_assoc($view_query)) {

      $id=$row['id'];

      $kita=$row['kita'];

      $lastdate1=$row['lastdate'];
      $lastdate = date('m/d/Y', strtotime($lastdate1));

      $tono = $row['tono'];
     
      $date1 = $row['date'];
      $date = date('m/d/Y', strtotime($date1));
      $office = $row['office'];
      $name = $row['name'];
      $purpose = $row['purpose'];
      $place = $row['place'];

      $fromdate1 = $row['fromdate'];
      $fromdate = date('m/d/Y', strtotime($fromdate1));

      $todate1 = $row['todate'];
      $todate = date('m/d/Y', strtotime($todate1));

      //echo $todate;
      
      $timefrom1 = $row['timefrom'];
      $timefrom=  date("h:i",$timefrom1);


      $timeto1 = $row['timeto'];
      $timeto=  date("h:i",$timeto1);


      $uc = $row['uc'];

      $submitteddate1 = $row['submitteddate'];
      $submitteddate = date('m/d/Y', strtotime($submitteddate1));


      $receiveddate = $row['receiveddate'];
      $receiveddate = date('m/d/Y', strtotime($receiveddate1));



      $fromplace = $row['fromplace'];
      $contact = $row['contact'];
      $vehicle = $row['vehicle'];
      $pos = $row['pos'];

      
    }

?>

<!-- Upadte Queries -->


<?php


if(isset($_POST['submit'])){


      $checked = $_POST['check'];
     // echo $checked;


      $id = $_POST['getid'];
      //echo $id;

      $tono = $_POST['tono'];
     
      $date1 = $_POST['date'];
      $date = date('Y-m-d', strtotime($date1));
      $office = $_POST['office'];
      $name = $_POST['name'];
      $purpose = $_POST['purpose'];
      $place = $_POST['place'];
      $todate1 = $_POST['todate'];
      $todate = date('Y-m-d', strtotime($todate1));
      
      $timefrom1 = $_POST['timefrom'];
      $timefrom=  date("h:i A",$timefrom1);


      $timeto1 = $_POST['timeto'];
      $timeto=  date("h:i A",$timeto1);
      

      $uc = $row['uc'];

      $submitteddate1 = $_POST['submitteddate'];
      $submitteddate = date('Y-m-d', strtotime($submitteddate1));


      $receiveddate = $_POST['receiveddate'];
      $receiveddate = date('Y-m-d', strtotime($receiveddate1));

      $fromplace = $_POST['fromplace'];
      $contact = $_POST['contact'];
      $vehicle = $_POST['vehicle'];

      $kita = $_POST['kita'];


      $lastdate1 = $_POST['lastdate'];
      if($lastdate1==''){
        $lastdate = '0000-00-00';
      }else{

      $lastdate = date('Y-m-d', strtotime($lastdate1));
      }
      
      $fromdate1 = $_POST['fromdate'];
      $fromdate = date('Y-m-d', strtotime($fromdate1));
      $pos = $row['pos'];


$servername = "localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
$username1 = $_SESSION['username'];
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
$query = mysqli_query($conn,"UPDATE  travel_order set tono='$tono',date='$date',office='$office',name='$name',purpose='$purpose',place='$place',todate='$todate',timefrom='$timefrom1',timeto='$timeto1',uc='0',fromplace='$fromplace',contact='$contact',vehicle='$vehicle', kita='$kita', lastdate='$lastdate',fromdate='$fromdate'  where id = '$id'");
  
 
mysqli_close($conn);

if($query){

    //echo '<div class=""><div class="panel-heading " style = "background-color:Green"> <p style = "color:white;font-size:16px;"> Data has been successfully updated. </p> </div></div>  '; 
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert(' Travel Order has been successfully updated.')
    window.location.href='TravelOrder.php';
    </SCRIPT>");
}
else{

    echo '<div class=""><div class="panel-heading " style = "background-color:Red"> <p style = "color:white;font-size:16px;"> Error. </p> </div></div>  '; 
    
}
}

?>
<!-- Upadte Queries -->
<div class="box">
          <div class="box-body">
      
            <h1 align="">Edit Travel Order</h1>
         
        <br>
      <li class="btn btn-success"><a href="TravelOrder.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <div class="class" >
        <form method="POST" action='' enctype="multipart/form-data" >
                <table class="table"> 
                <input value="<?php echo $id;?>" hidden  type="text"  class="" style="height: 35px;" id="getid" placeholder="" name="getid">
                <input hidden  class="" type="text" class="" style="height: 35px;" id="check" name="check" placeholder="check" >
                <input  hidden  type="text"  class="" style="height: 35px;" id="office" placeholder="office" name="office" value = "<?php echo $DIVISION_M ?>">
              
               <!-- ATAS-LAKBAY -->
             <tr>
                <td class="col-md-1"></td>
                    
                <td colspan="2" style="text-align:center">
                <h1>ATAS-LAKBAY</h1>
                </td>
             
                <td class="col-md-1"></td> 
                
               
                </tr>
                <!-- ATAS-LAKBAY -->
              
                <!-- Code -->
              <tr>
                <td class="col-md-1"></td>
                    
                <td class="col-md-5" >
                    <br>
                    Binago Ika-22
                    <br>
                    Ng Marso 1984                                    
                    <br>
                </td>

               

                <td class="col-md-5" >
                <br>
                <label></label>
                
                <br>
                <br>
                <label></label>
                <br>

                </td>

                <td class="col-md-1"></td> 
                
               
                </tr>
                <!-- Code -->
               
                

                <!-- Header -->
                <tr>
                <td class="col-md-1"></td>
                    
                <td colspan="1" style =" border:1px solid black;" >
                    <br>
                    
                    <img id="img" class="pull-left"  style="margin-top:0px; margin-bottom:0px; margin-right:40px; margin-left:50px; width:100;height:80px;" src='images/male-user.png' title = "" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    DILG – Rehiyon 4A
                    <br>
                    
                    3rd Floor Andenson Building I,
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    National Highway, Brgy.
                    <br>
                    Parian, City of Calamba, Laguna

                    <br>
                    <br>
                </td>

                <td class="col-md-5" style =" border:1px solid black;">
                <br>
                <label>Petsa:</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input readonly required type="text" class="" style=" border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:300px;" name="date" id="" value = "<?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" >
                
                <br>
                <br>
                <label>A.L. Blg.</label>
                

                &nbsp;&nbsp;&nbsp;
                <input value = "<?php echo $tono;?>" readonly required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; color:red; height: 40px; width:300px;" name="tono" id="" >
                <br>
                </td>

               

                <td class="col-md-1">
                    
                </td> 
                
               
                </tr>
                <!-- Header -->

                 <!-- Name and position -->
                 <tr>
                <td class="col-md-1"></td>
                    
                <td class="col-md-5" style =" border:1px solid black;" >
                    
                    <label>Pangalan:</label>
                    <br>
                   
                    <input readonly required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:500px;" name="name" id="" value = "<?php echo $name;?>" >
                  
                </td>

                <td class="col-md-5 " style =" border:1px solid black;">
              
               


                <label>Katungkulan: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       
                Taunang Kita:</label>
                
               <br>
                <input readonly required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:220px;" name="pos" id="pos" value = "<?php echo $pos;?>"  >
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input   type="number" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:240px;" name="kita" id="kita" value = "<?php echo $kita;?>">
                <br>

               
                

              </td>

               

                <td class="col-md-1"></td> 
                </tr>
                <!-- Name and position -->


                 <!-- Destination -->
                 <tr>
                <td class="col-md-1"></td>
                    
                <td class="col-md-5" style =" border:1px solid black;" >
                    <label>Pinagmulan:</label>
                  <br>
                    <input value = "<?php echo $fromplace;?>"  required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:500px;" name="fromplace" id="fromplace" value = "" >
                  
                </td>

                <td class="col-md-5" style =" border:1px solid black;">
              
                <label>Patutunguhan:</label>
               <br>
                    <input value = "<?php echo $place;?>"  required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:500px;" name="place" id="" value = "" >
                </td>


                <td class="col-md-1"></td> 
                </tr>
                 <!-- Destination -->


                 <!-- Contact Person -->
                 <tr>
                <td class="col-md-1"></td>

                <td colspan="2" class="" style =" border:1px solid black;" >
                
                <label>Makikipagkita kay:</label>

               <br>
                <input value = "<?php echo $contact;?>"  required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 40px; width:1020px;" name="contact" id="contact" value = "" >

                </td>
                <td class="col-md-1"></td> 
                </tr>
                <!-- Contact Person -->

                    <!-- Time out -->
                    <tr>
                <td class="col-md-1"></td>
                    
                <td colspan ="2" class="" style =" border:1px solid black;" >
                    
                    <label>Oras at Petsang Pag-alis:</label>
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;

                    <input value = "<?php echo $fromdate;?>" required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:410px;" name="fromdate" id="datepicker1" value = "" placeholder="mm/dd/yyyy">
                    &nbsp;&nbsp;&nbsp;

                    <input value = "<?php echo $timefrom1;?>" required  type="time" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:410px;" name="timefrom" id="timefrom"></td>
                </td>
               


                <td class="col-md-1"></td> 
                </tr>
                 <!-- Time out --> 

                 
                 <!-- Time in -->
                 <tr>
                <td class="col-md-1"></td>
                    
                <td colspan="2" class="" style =" border:1px solid black;" >
                    
                    <label>Oras at Petsang Pagbabalik:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <input value = "<?php echo $todate;?>" required type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:400px;" name="todate" id="datepicker2" value = "" placeholder="mm/dd/yyyy">

                    &nbsp;&nbsp;&nbsp;

                    <input value = "<?php echo $timeto1;?>" required  type="time" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:410px;" name="timeto" id="timeto"></td>
                                    
                </td>
               


                <td class="col-md-1"></td> 
                </tr>
                 <!-- Time in -->

                <!-- Purpose -->
                <tr>
                <td class="col-md-1"></td>
                    
                <td colspan="2" class="" style =" border:1px solid black;" >
                    
                    <label>Layunin ng Paglalakbay:</label>
                   <br>
                    <input value = "<?php echo $purpose;?>" required id="purpose" name="purpose" autocomplete ="off" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:1020px;" type="text" class="" placeholder="purpose">
                  
                </td>

                <td class="col-md-1"></td> 
                </tr>
                 <!-- Purpose -->

                 
                <!-- vehicle -->
                <tr>
                <td class="col-md-1"></td>
                    
                <td  class="col-md-5" style =" border:1px solid black;" >
                    
                    <label>Uri ng Sasakyan:</label>
                    <br>
                    <input value = "<?php echo $vehicle;?>" required id="vehicle" name="vehicle" autocomplete ="off" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:300px;" type="text" class="" placeholder="vehicle">
                  
                </td>

                <td  class="col-md-5" style =" border:1px solid black;" >

                <label>Paunang-bayad Nilikida:</label>
                <br>
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <!-- <input readonly required id="" name="" autocomplete ="off" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:300px;" type="text" class="" placeholder=""> -->
                __________________________________________________
                
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                <label> Punong Tagatuos</label>
               
                  
                </td>

                <td class="col-md-1"></td> 
                </tr>
                 <!-- vehicle -->

                  <!-- last date -->
                <tr>
                <td class="col-md-1"></td>
                    
                <td  class="col-md-5" style =" border:1px solid black;" >
                    
                    <label>Petsang Huling Paglalakbay:</label>
                    <br>
                    <input type="text" class="" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:300px;" name="lastdate" id="datepicker3" value = "<?php if($lastdate1=='0000-00-00'){echo "";}else{echo  $lastdate;} ?>" placeholder="mm/dd/yyyy">
                    <br>
                  
                  
                </td>

                <td  class="col-md-5" style =" border:1px solid black;" >

                <label>Nagbigay-ulat sa Huling Paglalakbay:</label>
                <br>
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
               <!--  <input readonly required id="" name="" autocomplete ="off" style="border:none;border-bottom:1px solid black; font-weight:bold; height: 35px; width:300px;" type="text" class="" placeholder=""> -->
               __________________________________________________
              
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                <label> Lagda ng Naglakbay</label>
               
                  
                </td>

                <td class="col-md-1"></td> 
                </tr>
                 <!-- last date -->

                 <!-- Pagtibayin -->
                 <tr>
                <td class="col-md-1"></td>
                    
                <td  class="col-md-5" style =" border:1px solid black;" >
                <?php
                session_start();
                $username = $_SESSION['username'];
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                //Get Office
                $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployee WHERE UNAME = '$username'");
                $rowdiv = mysqli_fetch_array($select_user);
                $DIVISION_C = $rowdiv['DIVISION_C'];
                //echo $DIVISION_C;
                $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                $rowdiv1 = mysqli_fetch_array($select_office);
                $DIVISION_M = $rowdiv1['DIVISION_M'];
                //GET Chief    
               /*  $select_office = mysqli_query($conn, "SELECT pmo_contact_person from pmo where id = '$DIVISION_C'");
                $rowdiv1 = mysqli_fetch_array($select_office);
                $DIVISION_M = $rowdiv1['DIVISION_M']; */
                $approved="";
                $pos="";
                if($DIVISION_M=='ORD'){
                  $approved="NOEL R. BARTOLABAC";
                  $pos="ASST. REGIONAL DIRECTOR";
                  }
                  else if($DIVISION_M=='LGMED'){

                  $approved="GILBERTO L. TUMAMAC";
                  $pos="OIC-Chief, LGMED";

                
                  }
                  
                  else if($DIVISION_M=='LGCDD'){

                  $approved="JAY-AR T. BELTRAN";
                  $pos="OIC-Chief, LGCDD";
                  
                  }
                  
                  else if($DIVISION_M=='FAD'){

                  $approved="DR. CARINA S. CRUZ";
                  $pos = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chief, FAD';
                 
                  }
                  else{
                  
                    $approved="";
                    $pos="";
                  }
                ?>
                    <label>Mungkahing Pagtibayin:</label>
                    <br>
                    <br>
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    <b><?php echo $approved;?></b>
                    <br>
                    &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    <b><?php echo $pos;?></b>
                  
                </td>

                <td  class="col-md-5" style =" border:1px solid black;" >

                <label>P I N A G T I B A Y :</label>
                <br>
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <label>ARIEL O. IGLESIA, CESO III</label>
                <br>
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                <label>Regional Director</label>
               
                  
                </td>

                <td class="col-md-1"></td> 
                </tr>
                 <!-- Pagtibayin -->
              
                  <!-- Patunay -->
                <tr>
                <td class="col-md-1" ></td>
                    
                <td colspan="2" class="" style ="  border:1px solid black;" >
                    <div class="div" style =" text-align:center; ">

                    <b><u>PATUNAY NG PAKIKIPAGKITA</u></b>
                    <br>
                    </div>

                    <div class="div" style =" text-align:left; ">

                    <br>
                   Ito ay pagpapatunay na ang tauhang nasasaad ay nagsadya sa akin tungkol sa kadahilanang 
                   <br>
                   nabanggit at mga araw na inilahad.
                  
                    </div>
                    
                 
                </td>

                <td class="col-md-1"></td> 
                </tr>
                 <!-- Patunay -->


                   <!-- Mula -->
                <tr>
                <td class="col-md-1" ></td>
                    
                <td  class="col-md-5" style =" border:1px solid black;" >
                    
                    <label>Mula:</label>
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 

                    <label>Hanggang:</label>
                  
                </td>

                <td  class="col-md-5" style =" border:1px solid black;" >
                    
                    <label>Lugar:</label>
                    <br>
                  
                  
                </td>

                <td class="col-md-1"></td> 
                </tr>
                 <!-- Mula -->
                    
                  <!-- footer -->
            <tr>
                <td class="col-md-1"></td>
                    
                <td class="col-md-5" >
                <br>
                    
                Patunay Blg.
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                _________________
                <br>
                Tala Blg.
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; 
                _________________
                <br>
                Pahina Blg.
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;
                _________________            		
                <br>
                Aklat Talaan Blg.
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                _________________ 			 
                <br>
                Seryeng
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp; &nbsp;
                _________________
                <br>                                
                <br>
                </td>

               

                <td class="col-md-5" >
                <br>
                <label></label>
                
                <br>
                <br>
                <label></label>
                <br>

                </td>

                <td class="col-md-1"></td> 
                
               
                </tr>
                <!-- footer -->

                </table>

                <br>
                <br>
               

               


               

                
                    <input type="submit" name="submit" class="btn btn-primary pull-left" value="Save" id="butsave">

                    <br>
                    <br>
                    </div>
              </form>
                
          </div>

        
       
    
  
   


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


 
<script>


$(document).ready(function(){
  $('#checkbox').checkBox({
      

    

    })
});


function myFunction() {
 var checkBox = document.getElementById("uc");
 var text = document.getElementById("timeto");
 var check = $("input[name='check']");
 //var str = $("input[name='timeto']");
 if (checkBox.checked == true){
   text.readOnly = true ;

   check.val('checked');
   
 } else {
   text.readOnly = false;

   check.val('');
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
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


</body>
</html>