<?php session_start();
date_default_timezone_set('Asia/Manila');

if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
$division = $_GET['division'];
require_once 'calendar/sample/bdd.php';
require_once 'calendar/sample/dbaseCon.php';
require_once 'calendar/sample/sql_statements.php';

$sql = "SELECT DIVISION_M, id, title, start, end, description,venue, tblpersonneldivision.DIVISION_COLOR as 'color', cancelflag, office,enp,posteddate, remarks,UNAME 
FROM events 
inner join tblpersonneldivision on events.office = tblpersonneldivision.DIVISION_N
inner join tblemployeeinfo on events.postedby = tblemployeeinfo.EMP_N
where cancelflag = 0 and events.status = 1 ";
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
                        <td class="col-md-2" style ="font-weight:bold">Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "titletxtbox" id = "titletxtbox"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control datepicker1" name = "startdatetxtbox" id="datepicker1" value = "" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">End Date</td>
                            <td class="col-md-5">
                                <input  type = "text"  class = "form-control datepicker2" id = "datepicker2" name = "enddatetxtbox"  placeholder="mm/dd/yyyy"   autocomplete = off /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Description</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "descriptiontxtbox" id = "descriptiontxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "venuetxtbox" id= "venuetxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "number" min = "0" name = "enptxtbox" id= "enptxtbox" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "remarks" id= "remarks" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control" id= "postedby"  value="<?php echo $_SESSION['username'];?>"/>
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control datepicker3" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox"  /></td>
                                </tr>
                   
                    
                </table>
                <input type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save"> 

            </form>
        <?php
    
}

function getCurrentID()
{
    include 'connection.php';
    $sqlQuery = "SELECT ID FROM `events`  ORDER BY ID DESC LIMIT 1";
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

if($_SESSION['planningofficer'] == 1)
{
  ?>
  <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "titletxtbox" id = "titletxtbox" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input disabled type="text" class = "form-control datepicker1" name = "startdatetxtbox" id = "datepicker1" value = "" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">End Date</td>
                            <td class="col-md-5">
                                <input autocomplete ="off" disabled type = "text"  class = "form-control" name = "enddatetxtbox"  id="datepicker2" value = "" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Description</td>
                            <td class="col-md-5"><input disabled  type = "text" class = "form-control" name = "descriptiontxtbox" id = "descriptiontxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "venuetxtbox" id = "venuetxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "number" min = "0" name = "enptxtbox" id = "enptxtbox" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input disabled type = "text" class = "form-control" name = "remarks" id = "remarks" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control"  id = "postedby"/>
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox"  /></td>
                                </tr>
                   
                    
                </table>
  <?php

}else{

?>
  <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "titletxtbox" id = "titletxtbox" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input disabled type="text" class = "form-control datepicker1" name = "startdatetxtbox" id = "datepicker1" value = "" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">End Date</td>
                            <td class="col-md-5">
                                <input disabled type = "text" placeholder="mm/dd/yyyy" class = "form-control" name = "enddatetxtbox"  id="datepicker2" value = "" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Description</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "descriptiontxtbox" id = "descriptiontxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" name = "venuetxtbox" id = "venuetxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input disabled type = "number" min = "0" name = "enptxtbox" id = "enptxtbox" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input disabled type = "text" class = "form-control" name = "remarks" id = "remarks" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted By</td>
                            <td class="col-md-5">                              
                            <input disabled type = "text"  class = "form-control" id = "postedby" value = "" />
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2" style ="font-weight:bold">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox"  /></td>
                                </tr>
                   
                    
                </table>
<?php
}
?>

              
               <?php 
                
             
                  echo ' <a id = "edit"  style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-primary"> Edit</a>';
                  echo ' <input id = "save"  type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save Changes"> ';
                

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
 
  // if ($division == 14 || $division == 10 || $division == 11 || $division == 12 || $division == 13) {
  //     include('test1.php');
  //   }else{
  //     include('sidebar2.php');
  //   }
 ?>
<?php include 'connection.php';?>

  <div class="content-wrapper">
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Calendar of Activities</li>
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
    <?php include 'calendar_view.php';?>
 &nbsp;
 &nbsp;
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
          <?php 
          if($_SESSION['planningofficer'] == 1)
          {
            echo  '<label id ="title">View Activity</label>';
          }else{
            echo  '<label id ="title" >View Activity</label>';
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

$('#title').html("View Activity");


$('#save').hide();
function test(){
$('#edit').show();

}
$("#edit").click(function(){
  $('#save').show();
$('#edit').hide();



$('#title').html("Edit Activity");
$('#titletxtbox').prop("disabled", false); 
$('#datepicker1').prop("disabled", false); 
$('#datepicker2').prop("disabled", false); 
$('#descriptiontxtbox').prop("disabled", false); 
$('#venuetxtbox').prop("disabled", false); 
$('#enptxtbox').prop("disabled", false); 
$('#remarks').prop("disabled", false); 

});
$('#title').html("View Activity");

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
            $( "#ord" ).prop( "checked", true );
            $( "#fad" ).prop( "checked", true );
            $( "#lgcdd" ).prop( "checked", true );
            $( "#lgmed" ).prop( "checked", true );
            $( "#mbrtg" ).prop( "checked", true );
            $( "#pdmu" ).prop( "checked", true );

            $( "#addll" ).prop( "checked", true );
            $( "#cavite" ).prop( "checked", true );
            $( "#laguna" ).prop( "checked", true );
            $( "#batangas" ).prop( "checked", true );
            $( "#quezon" ).prop( "checked", true );
            $( "#rizal" ).prop( "checked", true );
            $( "#lucena" ).prop( "checked", true );
      
 
            $(".datepicker1").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $("#datepicker1").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $(".datepicker1").datepicker().datepicker("setDate", new Date());
            $("#datepicker2").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $(".datepicker2").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

            $("#datepicker3").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
            $(".datepicker3").datepicker().datepicker("setDate", new Date());



})
$(document).ready(function() {
$("#all").click(function(){
    $('#all').not(this).prop('checked', this.checked);
    $('#ord').not(this).prop('checked', this.checked);
    $('#fad').not(this).prop('checked', this.checked);
    $('#lgcdd').not(this).prop('checked', this.checked);
    $('#mbrtg').not(this).prop('checked', this.checked);
    $('#lgmed').not(this).prop('checked', this.checked);
    $('#pdmu').not(this).prop('checked', this.checked);
    $('#cavite').not(this).prop('checked', this.checked);
    $('#laguna').not(this).prop('checked', this.checked);
    $('#batangas').not(this).prop('checked', this.checked);
    $('#quezon').not(this).prop('checked', this.checked);
    $('#rizal').not(this).prop('checked', this.checked);
    $('#lucena').not(this).prop('checked', this.checked);
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

        select: function (start, end, allDay) {
          $('#myModal').modal('show');
        },
        eventClick: function(event, element) {



          if(event.office == <?php echo $_GET['division'];?>)
          {
          test();

          
          }else{
            $('#title').html("View Activity");

            $('#save').hide();
            $('#edit').hide();
          }
          $('#titletxtbox').prop("disabled", true); 
          $('#datepicker1').prop("disabled", true); 
          $('#datepicker2').prop("disabled", true); 
          $('#descriptiontxtbox').prop("disabled", true); 
          $('#venuetxtbox').prop("disabled", true); 
          $('#enptxtbox').prop("disabled", true); 
          $('#remarks').prop("disabled", true); 

                $('#myModal').modal('show');
               
                $('#myModal').find('#eventid').val(event.id);
                $('#myModal').find('#titletxtbox').val(event.title);
                $('#myModal').find('#datepicker1').val(moment(event.start).format('MM/DD/YYYY'));
if(event.end == '0000-00-00 00:00:00' || event.end == null || event.end == '1970-01-01 00:00:00')
{  
  $('#myModal').find('#datepicker2').val('');
}else{
  $('#myModal').find('#datepicker2').val(moment(event.end).subtract(1, "days").format('MM/DD/YYYY'));

}    
                // $('#myModal').find('#datepicker2').val(moment(event.end).format('MM/DD/YYYY'));
                $('#myModal').find('#datepicker3').val(moment(event.posteddate).format('MM/DD/YYYY'));
                $('#myModal').find('#descriptiontxtbox').val(event.description);
                $('#myModal').find('#remarks').val(event.remarks);
                $('#myModal').find('#postedby').val(event.postedby);
                $('#myModal').find('#venuetxtbox').val(event.venue);
                $('#myModal').find('#enptxtbox').val(event.enp);
                
     
            },
          eventRender: function(calEvent, element, view) {
            
           var show_username, show_type = true, show_calendar = true;
          //  ===================
       
      
          if($('input[id=ord]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=fad]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=lgcdd]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=mbrtg]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=lgmed]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }else if($('input[id=pdmu]').is(':checked')){
            $( "#all" ).prop( "checked", false );
          }
          if($('input[id=ord]').is(':checked') && 
            $('input[id=fad]').is(':checked') && 
            $('input[id=lgcdd]').is(':checked') &&
            $('input[id=mbrtg]').is(':checked')&&
            $('input[id=lgmed]').is(':checked')&&
            $('input[id=pdmu]').is(':checked')&&
            $('input[id=cavite]').is(':checked')&&
            $('input[id=batangas]').is(':checked')&&
            $('input[id=laguna]').is(':checked')&&
            $('input[id=rizal]').is(':checked')&&
            $('input[id=quezon]').is(':checked')&&
            $('input[id=lucena]').is(':checked')
            )
            
            {
            $( "#all" ).prop( "checked", true );
            }
// ===========================================================



      

          if($('input[id=all]').is(':checked') ){

            return ['0', calEvent.office].indexOf($('#selectDivision').val()) >= 0 
          }else{      
            var types = $('#type_filter').val();    
            if (types && types.length > 0) 
            {
                if (types[0] == "all") 
                {
                    show_type = true;

                    return show_type;
                } else {
                    show_type = types.indexOf(calEvent.title) >= 0;
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

                    $start = explode(" ", $event['start']);
                    $end = explode(" ", $event['end']);
                    if($start[1] == '00:00:00'){
                      $start = $start[0];
                    }else{
                      $start = $event['start'];
                    }
                    if($end[1] == '00:00:00'){
                      $end =  date('Y-m-d', strtotime("+1 day", strtotime($end[0])));


                    }else{
                      $end = $event['end'];
                    }


                  $enddate = str_replace('-', '/', $end);
                  $realenddate = date('Y-m-d',strtotime($enddate));

                  if($_SESSION['planningofficer'] == 1){
                    if (TRUE) {
                      ?>
                      {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $realenddate; ?>',
                        description: '<?php echo $event['description']; ?>',
                        venue: '<?php echo $event['venue']; ?>',
                        color: '<?php echo $event['color']; ?>',
                        office: '<?php echo $event['office']; ?>',
                        posteddate: '<?php echo $event['posteddate']; ?>',
                        remarks: '<?php echo preg_replace('/[^\w]/', ' ',$event['remarks']); ?>',
                        postedby:'<?php echo $event['UNAME'];?>',
                        enp: '<?php echo $event['enp']; ?>',
                    

                      },
                    <?php 
                    }
                  }else{

                    if (TRUE) {
                      ?>
                      {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo ''.$event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $realenddate; ?>',
                        description: '<?php echo $event['description']; ?>',
                        venue: '<?php echo $event['venue']; ?>',
                        color: '<?php echo $event['color']; ?>',
                        office: '<?php echo $event['office']; ?>',
                        posteddate: '<?php echo $event['posteddate']; ?>',
                        remarks: '<?php echo preg_replace('/[^\w]/', ' ',$event['remarks']); ?>',
                        postedby:'<?php echo $event['UNAME'];?>',
                        enp: '<?php echo $event['enp']; ?>',
                        

                    

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
            $( "#ord" ).prop( "checked", true );
            $( "#fad" ).prop( "checked", true );
            $( "#lgcdd" ).prop( "checked", true );
            $( "#lgmed" ).prop( "checked", true );
            $( "#mbrtg" ).prop( "checked", true );
            $( "#pdmu" ).prop( "checked", true );
            $( "#addll" ).prop( "checked", true );
            $( "#cavite" ).prop( "checked", true );
            $( "#laguna" ).prop( "checked", true );
            $( "#batangas" ).prop( "checked", true );
            $( "#quezon" ).prop( "checked", true );
            $( "#rizal" ).prop( "checked", true );
            $( "#lucena" ).prop( "checked", true );
          }else{
            $( "#all" ).prop( "checked", false );
            $( "#ord" ).prop( "checked", false );
            $( "#fad" ).prop( "checked", false );
            $( "#lgcdd" ).prop( "checked", false );
            $( "#lgmed" ).prop( "checked", false );
            $( "#mbrtg" ).prop( "checked", false );
            $( "#pdmu" ).prop( "checked", false );
            $( "#addll" ).prop( "checked", false );
            $( "#cavite" ).prop( "checked", false );
            $( "#laguna" ).prop( "checked", false );
            $( "#batangas" ).prop( "checked", false );
            $( "#quezon" ).prop( "checked", false );
            $( "#rizal" ).prop( "checked", false );
            $( "#lucena" ).prop( "checked", false );
            
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
     
        return vals.indexOf(calEvent.office) !== -1;

      
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
