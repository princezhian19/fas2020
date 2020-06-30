<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2030 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
?>
<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
$division = $_SESSION['division'];



}
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

  //Get Office
$select_user = mysqli_query($conn,"SELECT FIRST_M,MIDDLE_M,LAST_M,DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username1'");
$rowdiv = mysqli_fetch_array($select_user);
$DIVISION_C = $rowdiv['DIVISION_C'];
$f = $rowdiv['FIRST_M'];
$m = $rowdiv['MIDDLE_M'];
$l= $rowdiv['LAST_M'];

$fullname = $f.' '.$m.' '.$l;


//Get Office
$select_user = mysqli_query($conn,"SELECT DIVISION_C, DESIGNATION FROM tblemployeeinfo WHERE UNAME = '$username'");
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

//echo $DIVISION_M;

// echo '<div class=""><div class="panel-heading " style = "background-color:orange"> <p style = "color:white;font-size:16px;"> This module is under development </p> </div></div>  '; 
// echo '<br>';
?>

<?php
//index.php




?>
<!DOCTYPE html>
<html>
 <head>
 <title>FAS</title>
<div class="box">
<div class="box-body">

<h1>Trip Schedule</h1>
<br>
<li class="btn btn-warning"><a href="VehicleRequest.php" style="color:white;text-decoration: none;">Back</a></li>

<div class="row">
    <div class="col-md-4" id='modes'>

        <br>
        <br>
            


            
            <div class = "col-xs-2 col-sm-2 col-md-2 col-lg-12">
            <table  class="table" id='table' style="border-width: 3px;max-width:100%;">

            <tr>

            <form method = "POST" action = "vr_export_date.php">
            <td class="col-md-1" >

            <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial' ):?>
          
            <select class="" name="month" id = "selectMonth" style="width: 150px; Height:30px;">
            <?php 
            $current_month =  date('F');
            switch($current_month){
            case 'January':
            echo '
            <option value="01" selected>January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'February':
            echo '
            <option value="01">January</option>
            <option value="02" selected>February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'March':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03" selected>March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'April':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04" selected>April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'May':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05" selected>May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'June':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06" selected>June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'July':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07" selected>July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'August':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08" selected>August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'September':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09" selected>September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'October':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10" selected>October</option>
            <option value="11">November</option>
            <option value="12">December</option>';
            break;
            case 'November':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11" selected>November</option>
            <option value="12">December</option>';
            break;
            case 'December':
            echo '
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12" selected>December</option>';
            break;
            }
            ?>

            </select>
            </td>

            <td class="col-md-1" >
         
            <select class="pull-right" id="year" name="year" style="width: 150px; Height:30px;">
            <!-- <option value="">Year</option> -->
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>

            </select>

            </td>
           
           

            <?php else:?>

            <?php endif?>

           

            </tr>
            <tr>
            

            <td colspan = "2"><b><input  class='calFilter' type="checkbox" name = "drivers[]" value="0"  id = "all" ></label>
            All Drivers</b></td>
            </tr>

            <td style="background-color: #D5D911; color:white;WIDTH:50%;">
            <input class='calFilter' type="checkbox" name = "drivers[]" value="Reynaldo Parale" id = "ReynaldoParale" ><label style = "margin-left:15%;">Reynaldo Parale</label>
            <input hidden class='' type="text" name = "" value="#D5D911;" id = "colorPicker1">
            </td>
            <td style="background-color: #607D8B; color:#fff;padding:9px;WIDTH:50%;">
            <input class='calFilter' type="checkbox" name = "drivers[]" value="Louie Blanco" id = "LouieBlanco"><label style = "margin-left:15%;">Louie Blanco</label>
            <input hidden class='' type="text" name = "" value="#607D8B;" id = "colorPicker2">
            </td>
            </tr>
            <tr>
            <td style="background-color: #E60785; color:white;">
            <input class='calFilter' type="checkbox" name = "drivers[]" value="Joachim Lacdang" id = "JoachimLacdang"><label style = "margin-left:15%;">Joachim Lacdang</label>
            <input hidden class='' type="text" name = "" value="#E60785;" id = "colorPicker3">
            </td>
            <td style="background-color:#FF9800 ; color:white;;padding:9px;">
            <input class='calFilter' type="checkbox" name = "drivers[]" value="Medel Saturno" id = "MedelSaturno"><label style = "margin-left:15%;">Medel Saturno</label>
            <input hidden class='' type="text" name = "" value="#FF9800;" id = "colorPicker4">
            </td>
            </tr>
            <tr>
            <td style="background-color: #48BD0D; color:white;">
            <input class='calFilter' type="checkbox" name = "drivers[]" value="Daniel Narciso" id = "DanielNarciso"><label style = "margin-left:15%;">Daniel Narciso</label>
            <input hidden class='' type="text" name = "colorPicker5" value="#48BD0D" id = "colorPicker5">
            </td>

           
            </tr>
            <tr>
            <td>
            <?php if ($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial' ):?>
            
            <br>
            <button class="btn btn-success pull-left"><a style = "color:#fff; "  id = "export"  >Export</a></button>

            <?php else: ?>

            <td>

            </td>

            <?php endif ?>
            </td>
            </tr>
            </table>
          
            </div>
        </form>

    </div>

    <!-- Calendar -->
    <div class="col-md-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
 <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function(event) {

   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
     
    },

    events: 'vehicle_load.php',
    selectable:true,
    selectHelper:true,
    
    // eventColor: $("#colorPicker5").val(),
    
    
    

    /* select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    }, */
    
    editable:false,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })

     
    },

    

    /* eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    }, */

    eventClick:function(event)
    {
     /* if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     } */

    

    $('#assigneddate').prop("disabled", true); 
    $('#assignedtime').prop("disabled", true); 
    $('#dispatcher').prop("disabled", true); 
    $('#nov').prop("disabled", true); 
    $('#av').prop("disabled", true); 
    $('#ad').prop("disabled", true); 
    $('#plate').prop("disabled", true); 
    $('#vremarks').prop("disabled", true); 

    $('#myModal2').find('#purpose').val(event.title);
    $('#myModal2').find('#assigneddate').val(event.assigneddate);
    $('#myModal2').find('#assignedtime').val(event.assignedtime);
    $('#myModal2').find('#dispatcher').val(event.dispatcher);
    $('#myModal2').find('#nov').val(event.nov);

    $('#myModal2').find('#av').val(event.av);
    $('#myModal2').find('#ad').val(event.ad);
    $('#myModal2').find('#plate').val(event.plate);

    $('#myModal2').find('#av1').val(event.av1);
    $('#myModal2').find('#ad1').val(event.ad1);
    $('#myModal2').find('#plate1').val(event.plate1);

    $('#myModal2').find('#av2').val(event.av2);
    $('#myModal2').find('#ad2').val(event.ad2);
    $('#myModal2').find('#plate2').val(event.plate2);

    $('#myModal2').find('#vremarks').val(event.vremarks);
    
    
   
    $("#myModal2").modal("show");
    //  alert(event.assigneddate);



    },
    
   



   });

   
  });
   
  </script>
 </head>
 <body>
  <br />
  <!-- <h2 align="center"><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2> -->
  <br />
  <!-- <div class="container"> -->
   <div id="calendar"></div>
  <!-- </div> -->


    </div>
     <!-- Calendar -->
</div>




</div>
</div>

 </body>
</html>