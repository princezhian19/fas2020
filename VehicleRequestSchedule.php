<?php session_start();
date_default_timezone_set('Asia/Manila');

if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
}
$division = $_GET['division'];
require_once 'calendar/sample/bdd.php';
require_once 'calendar/sample/dbaseCon.php';
require_once 'calendar/sample/sql_statements.php';

$sql = "SELECT * from vr";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

function viewEvents()
{
        ?>
            <form method = "POST" action = "calendar/add-event.php">
                <input  type = "hidden" name = "eventid" id = "eventid">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assined Date</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "assigneddate" id = "assigneddate"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Time</td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control " name = "assignedtime" id="assignedtime" value = ""   required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Dispatcher</td>
                            <td class="col-md-5">
                                <input  type = "text"  class = "form-control datepicker2" id = "dispatcher" name = "dispatcher"    autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">No. of Vehicles</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "nov" id = "nov" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Vehicle</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "ac" id= "av" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Driver</td>
                            <td class="col-md-5"><input required type = "number" min = "" name = "ad" id= "ad" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Plate</td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "plate" id= "plate" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Remarks</td>
                            <td class="col-md-5">                              
                            <input  type = "text"  class = "form-control" id= "vremarks"  name = "vremarks" />
                                    </td>
                                        </tr>
                
                    
                </table>
                <input type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save"> 

            </form>
        <?php
    
}

function getCurrentID()
{
    include 'connection.php';
    $sqlQuery = "SELECT ID FROM `vr`  ORDER BY ID DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlQuery);
    if ($row = mysqli_fetch_array($result)) {
        echo $row['ID'];
    }
}

function viewEvents2()
{
  ?>

    <form method = "POST" action = "calendar/edit-event.php" id = "edit_act">
    <input  type = "hidden" name = "eventid" id = "eventid">
<?php 

if($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial')
{
  ?>
  <input  type = "hidden" name = "eventid" id = "eventid">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assined Date</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "assigneddate" id = "assigneddate"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Time</td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control " name = "assignedtime" id="assignedtime" value = ""   required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Dispatcher</td>
                            <td class="col-md-5">
                                <input  type = "text"  class = "form-control datepicker2" id = "dispatcher" name = "dispatcher"    autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">No. of Vehicles</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "nov" id = "nov" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Vehicle</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "ac" id= "av" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Driver</td>
                            <td class="col-md-5"><input required type = "number" min = "" name = "ad" id= "ad" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Plate</td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "plate" id= "plate" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Remarks</td>
                            <td class="col-md-5">                              
                            <input  type = "text"  class = "form-control" id= "vremarks"  name = "vremarks" />
                                    </td>
                                        </tr>
                
                    
                </table>
  <?php

}else{

?>
 <input  type = "hidden" name = "eventid" id = "eventid">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assined Date</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "assigneddate" id = "assigneddate"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Time</td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control" name = "assignedtime" id="assignedtime" value = ""   required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Dispatcher</td>
                            <td class="col-md-5">
                                <input  type = "text"  class = "form-control " id = "dispatcher" name = "dispatcher"    autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">No. of Vehicles</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "nov" id = "nov" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Vehicle</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "ac" id= "av" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Assigned Driver</td>
                            <td class="col-md-5"><input required type = "number" min = "" name = "ad" id= "ad" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Plate</td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "plate" id= "plate" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Remarks</td>
                            <td class="col-md-5">                              
                            <input  type = "text"  class = "form-control" id= "vremarks"  name = "vremarks" />
                                    </td>
                                        </tr>
                
                    
                </table>
<?php
}
?>

              
               <?php 
                
             
                  // echo ' <a id = "edit"  style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-primary"> Edit</a>';
                  // echo ' <input id = "save"  type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save Changes"> ';
                

               ?>

            </form>
  <?php
}
?>
  
  <!DOCTYPE html>
<html>
  <head>
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FAS | Calendar</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
    <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
    <script src="calendar/fullcalendar/lib/moment.min.js"></script>
    <script src="calendar/fullcalendar/fullcalendar.min.js"></script>
   
    <style>
  
  #calendar {
      width: 100%;
      padding:10px;
      margin: 0 auto;
      background-color:#ECEFF1;
  }
  
  .response {
      height: 60px;
  }
  
  .success {
      background: #cdf3cd;
      padding: 10px 60px;
      border: #c3e6c3 1px solid;
  }
    </style>
 <?php 

if ($username == 'charlesodi' || $username == 'itdummy1' || $username == 'mmmonteiro' || $username == 'jamonteiro' || $username == 'rlsegunial' || $username == 'masacluti' || $username == 'cvferrer' || $username == 'seolivar' || $username == 'magonzales') {

      include('test1.php');
}else{
  include('sidebar2.php');

}
 
  
 ?>
<?php include 'connection.php';?>

  <div class="content-wrapper">
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">GSS</li>
        <li class="active">Vehicle Request</li>
        <li class="active">Trip Schedule</li>
      </ol><br>
    
      <?php
if($_GET['flag'] == 1)
{
    ?>
    <script>
    $(document).ready(function(){
        displayMessage('Data has been successfully updated.');
      
    });</script>
    <?php
}
?>
  
<div id="openviewWeather">
      <a class="weatherwidget-io" href="https://forecast7.com/en/12d88121d77/philippines/" data-label_1="Philippines" data-label_2="Weather" data-font="Roboto" data-icons="Climacons Animated" data-theme="original" data-accent="rgba(1, 1, 1, 0.0)"></a>
  </div>
  
  <script>
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
  </script>
    <?php include 'vehicle_trip.php';?>
 &nbsp;
 &nbsp;
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
          <?php 
          if($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial')
          {
            echo  '<label id ="title">View Assigned Drivers</label>';
          }else{
            echo  '<label id ="title" >View Assigned Drivers</label>';
          }
          ?>  
         </h4>
         
          <button type="button" class="close" data-dismiss="modal">&times; 
          </button>
        </div>
        <div class="modal-body">
          <?php echo viewEvents2();?>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times; 
          </button>
        </div>
        <div class="modal-body">
          <?php echo viewEvents();?>
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>


        
    <br>

    </section>
  </div>


  <footer class="main-footer">
  <br>

    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
  </footer>
  <br>

  <div class="control-sidebar-bg"></div>
</div>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>

$('#title').html("View Assigned Vehicle");


$('#save').hide();
function test(){
$('#edit').show();

}
$("#edit").click(function(){
  $('#save').show();
$('#edit').hide();



$('#title').html("Edit Assigned Vehicle");
$('#assigneddate').prop("disabled", false); 
$('#assignedtime').prop("disabled", false); 
$('#dispatcher').prop("disabled", false); 
$('#nov').prop("disabled", false); 
$('#av').prop("disabled", false); 
$('#ad').prop("disabled", false); 
$('#plate').prop("disabled", false); 
$('#remarks').prop("disabled", false); 

});
$('#title').html("View Assigned Vehicle");

  function displayMessage(message)
 {
    $(".response").html("<div class='alert alert-success' role='alert' style = 'background-color:#ef9a9a;'>"+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    setInterval(function() { $(".alert").fadeOut(); }, 3000);
}
  $('#modal').click(function(){
    $('#myModal2').modal('show');   
    
  })
 




  
  
$(document).ready(function()
{

  
            $( "#all" ).prop( "checked", true );
            $( "#ReynaldoParale" ).prop( "checked", true );
            $( "#LouieBlanco" ).prop( "checked", true );
            $( "#JoachimLacdang" ).prop( "checked", true );
            $( "#MedelSaturno" ).prop( "checked", true );
            $( "#DanielNarciso" ).prop( "checked", true );
            
      
 /* 
            $(".datepicker1").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $("#datepicker1").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $(".datepicker1").datepicker().datepicker("setDate", new Date());
            $("#datepicker2").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $(".datepicker2").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

            $("#datepicker3").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $(".datepicker3").datepicker().datepicker("setDate", new Date()); */



})
$(document).ready(function() {
$("#all").click(function(){
    $('#all').not(this).prop('checked', this.checked);
    $('#ReynaldoParale').not(this).prop('checked', this.checked);
    $('#LouieBlanco').not(this).prop('checked', this.checked);
    $('#JoachimLacdang').not(this).prop('checked', this.checked);
    $('#MedelSaturno').not(this).prop('checked', this.checked);
    $('#DanielNarciso').not(this).prop('checked', this.checked);
   
});  

    
  
      $('#calendar').fullCalendar({
          header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
          },
          editable: false,
          eventLimit: true,
          selectable: true,
          selectHelper: true,

        select: function (allDay)  {
          $('#myModal').modal('show');
        },
        eventClick: function(event, element) {



         
          test();

       
            $('#title').html("View Assigned Drivers");

            $('#save').hide();
            $('#edit').hide();
          
       /*    $('#titletxtbox').prop("disabled", true); 
          $('#datepicker1').prop("disabled", true); 
          $('#datepicker2').prop("disabled", true); 
          $('#descriptiontxtbox').prop("disabled", true); 
          $('#venuetxtbox').prop("disabled", true); 
          $('#enptxtbox').prop("disabled", true); 
          $('#remarks').prop("disabled", true);  */

                $('#myModal').modal('show');
               
                $('#myModal').find('#eventid').val(event.id);
                $('#myModal').find('#assigneddate').val(event.assigneddate).format('MM/DD/YYYY');
                $('#myModal').find('#assignedtime').val(moment(event.assignedtime).format('H:i'));

                $('#myModal').find('#dispatcher').val(moment(event.dispatcher));
                $('#myModal').find('#nov').val(event.nov);
                $('#myModal').find('#av').val(event.av);
                $('#myModal').find('#ad').val(event.ad);
                $('#myModal').find('#plate').val(event.plate);
                $('#myModal').find('#vremarks').val(event.vremarks);
                
     
            },
          eventRender: function(calEvent, element, view) {
            
           var show_username, show_type = true, show_calendar = true;
          //  ===================
       

      
          if($('input[id=ReynaldoParale]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=LouieBlanco]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=JoachimLacdang]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=MedelSaturno]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=DanielNarciso]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }
          if($('input[id=ReynaldoParale]').is(':checked') && 
            $('input[id=LouieBlanco]').is(':checked') && 
            $('input[id=JoachimLacdang]').is(':checked') &&
            $('input[id=MedelSaturno]').is(':checked')&&
            $('input[id=DanielNarciso]').is(':checked')
           
            )
            
            {
            $( "#all" ).prop( "checked", true );
            }
// ===========================================================



      

          if($('input[id=all]').is(':checked') ){

            return ['0', calEvent.ad].indexOf($('#selectDivision').val()) >= 0 
          }else{      
            var types = $('#type_filter').val();    
            if (types && types.length > 0) 
            {
                if (types[0] == "all") 
                {
                    show_type = true;

                    return show_type;
                } else {
                    show_type = types.indexOf(calEvent.ad) >= 0;
                    return show_type;
                }
                return show_type;
            }
            return  filter(calEvent) ;
            }


            // ============================
            
      
          },
          
         
  
          events: [
                  <?php foreach($events as $event): 

                  /*   $start = explode(" ", $event['assigneddate']);
                 
                    if($start[1] == '00:00:00'){
                      $start = $start[0];
                    }else{
                      $start = $event['assigneddate'];
                    }
                    if($end[1] == '00:00:00'){
                      $end =  date('Y-m-d', strtotime("+1 day", strtotime($end[0])));


                    }else{
                     
                    } */

/* 
                  $enddate = str_replace('-', '/', $end);
                  $realenddate = date('Y-m-d',strtotime($enddate)); */

                  if($username1 == 'cvferrer' || $username1 == 'bosoltura' || $username1 == '' || $username1 == 'bosoltura' || $username1 == 'ctronquillo'|| $username1 == 'jamonteiro'|| $username1 == 'rlsegunial'){
                    if (TRUE) {
                      ?>
                      {
                        id: '<?php echo $event['id']; ?>',
                        assigneddate: '<?php echo $event['assigneddate']; ?>',
                       
                        assignedtime: '<?php echo $event['assignedtime']; ?>',
                        dispatcher: '<?php echo $event['dispatcher']; ?>',
                        nov: '<?php echo $event['nov']; ?>',
                        av: '<?php echo $event['av']; ?>',
                        ad: '<?php echo $event['ad']; ?>',
                        vremarks: '<?php echo preg_replace('/[^\w]/', ' ',$event['vremarks']); ?>',
                        plate:'<?php echo $event['plate'];?>',
                       
                    

                      },
                    <?php 
                    }
                  }else{

                    if (TRUE) {
                      ?>
                      {
                        id: '<?php echo $event['id']; ?>',
                        assigneddate: '<?php echo $event['assigneddate']; ?>',
                       
                        assignedtime: '<?php echo $event['assignedtime']; ?>',
                        dispatcher: '<?php echo $event['dispatcher']; ?>',
                        nov: '<?php echo $event['nov']; ?>',
                        av: '<?php echo $event['av']; ?>',
                        ad: '<?php echo $event['ad']; ?>',
                        vremarks: '<?php echo preg_replace('/[^\w]/', ' ',$event['vremarks']); ?>',
                        plate:'<?php echo $event['plate'];?>',

                    

                      },
                    <?php 
                    }
                  }
                  endforeach; ?>
                ]
      });

      $('.export').click(function(){
    var month = $('.select_month').val();

        // window.location ="export_calendar.php?month=&division=<?php echo $_GET['division'];?>"
      })
      // ==================================================
      $( ".filter" ).keyup(function() {
        if($('#type_filter').val() == '')
          {

           
            $( "#all" ).prop( "checked", true );
            $( "#ReynaldoParale" ).prop( "checked", true );
            $( "#LouieBlanco" ).prop( "checked", true );
            $( "#JoachimLacdang" ).prop( "checked", true );
            $( "#MedelSaturno" ).prop( "checked", true );
            $( "#DanielNarciso" ).prop( "checked", true );
          
          }else{
            $( "#all" ).prop( "checked", false );
            $( "#ReynaldoParaleord" ).prop( "checked", false );
            $( "#LouieBlanco" ).prop( "checked", false );
            $( "#JoachimLacdang" ).prop( "checked", false );
            $( "#MedelSaturno" ).prop( "checked", false );
            $( "#DanielNarciso" ).prop( "checked", false );
           
            
          }

       $('#calendar').fullCalendar('rerenderEvents');
   });
      // ===================================================
      $('#selectDivision').hide();
      
      // ===================================================
      $(".select_month").on("change", function(event) {
      $('#calendar').fullCalendar('changeView', 'month', this.value);
      $('#calendar').fullCalendar('gotoDate', "2020-"+this.value+"-1");
      });

   
      
  // $('.calFilter').on('change', function() {
  //     $('.calFilter').not(this).prop('checked', false);  
  // });
      $('input[type=radio][name=user_selector]').on('change', function() {
        $('#calendar').fullCalendar('rerenderEvents');
      });
      /* When a checkbox changes, re-render events */
      $('input:checkbox.calFilter').on('change', function() {
        $('#calendar').fullCalendar('rerenderEvents');
      });
    });

      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];;
  var date = new Date();
  var month = months[date.getMonth()];
  switch(month)
  {
    case 'January':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1" selected>January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'February':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2" selected>February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'March':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3" selected>March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'April':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4" selected>April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'May':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5" selected>May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'June':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6" selected>June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'July':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7" selected>July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'August':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8" selected>August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'September':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9" selected>September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'October':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10" selected>October</option><option value="11">November</option><option value="12">December</option></select>');
      break;
      case 'November':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11" selected>November</option><option value="12" >December</option></select>');
      break;
      case 'December':
        $("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12" selected>December</option></select>');
      break;
  }
//   var array = [];
//   var [a,b] = '';
//   $('input[type="checkbox"]').bind('click',function() {
//   if($(this).is(':checked')) {
//     [a,b] = [array.push($(this).val())];
//   }
// });

  $('#export').click(function(){   
    var values = [].filter.call(document.getElementsByName('offices[]'), function(c) {
    return c.checked;
  }).map(function(c) {
    return c.value;
  });
var a  = JSON.stringify(values);
var array = $.parseJSON(a);

// console.log(array);



    // 
  var getmonth = $(".select_month").val();
  var getYear = $("#selectYear").val();

    window.location = "export_calendar.php?office_id="+array+"&&month="+getmonth+"&&year="+getYear+"&date=<?php echo date("Y-m-d");?>&division=<?php echo $_GET['division'];?>"
  });
  

  

    function filter(calEvent) {
      var vals = [];
      $('input:checkbox.calFilter:checked').each(function() {
        vals.push($(this).val());
        // alert(vals.push($(this).val()));
      });
     
        return vals.indexOf(calEvent.ad) !== -1;

      
    }

</script>
<script>
var newEvent;
var editEvent;

$(document).ready(function() {
    

  
  //WEATHER GRAMATICALLY
  
  function retira_acentos(str) {
    var com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝRÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿr";
    var sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
    var novastr="";
    for(i=0; i<str.length; i++) {
      troca=false;
      for (a=0; a<com_acento.length; a++) {
        if (str.substr(i,1)==com_acento.substr(a,1)) {
          novastr+=sem_acento.substr(a,1);
          troca=true;
          break;
        }
      }
      if (troca==false) {
        novastr+=str.substr(i,1);
      }
    }
    return novastr.toLowerCase().replace( /\s/g, '-' );
  }
  
  //WEATHER THEMES
  
  document.getElementById('switchWeatherTheme').addEventListener('change', function(){
    
    var valueTheme = $(this).val();
    var widget = document.querySelector('.weatherwidget-io');
    widget.setAttribute('data-theme', valueTheme);
    __weatherwidget_init();
    
  });
  
  //WEATHER LOCATION
  var input = document.getElementById('searchTextField');
  var autocomplete = new google.maps.places.Autocomplete(input);
  
  google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    var newPlace = retira_acentos(place.name);
    
    var urlDataWeather = 'https://forecast7.com/en/'+ latitude.toFixed(2).replace(/\./g,'d').replace(/\-/g,'n') + longitude.toFixed(2).replace(/\./g,'d').replace(/\-/g,'n') + '/'+ newPlace +'/';
    
    alert(urlDataWeather);
    
    var weatherWidget = document.querySelector('.weatherwidget-io');
    weatherWidget.href = urlDataWeather;
    weatherWidget.dataset.label_1 = place.name;
    __weatherwidget_init();
    
    //document.getElementById('city2').value = place.name;
    //document.getElementById('cityLat').value = place.geometry.location.lat();
    //document.getElementById('cityLng').value = place.geometry.location.lng();
    //alert("This function is working!");
    //alert(place.name);
    // alert(place.address_components[0].long_name);

  });
  
});


</script>
</body>
</html>
