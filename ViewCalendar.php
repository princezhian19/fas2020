<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

require_once 'calendar/sample/bdd.php';
require_once 'calendar/sample/dbaseCon.php';
require_once 'calendar/sample/sql_statements.php';

$sql = "SELECT id, title, start, end, tblpersonneldivision.DIVISION_COLOR as 'color', cancelflag, office FROM events inner join tblpersonneldivision on events.office = tblpersonneldivision.DIVISION_N where cancelflag = 0 and status = 1 ";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();
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
      background-color:#fff;
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
<?php include 'test1.php';?>
<?php include 'connection.php';?>

  <div class="content-wrapper">
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Calendar of Events</li>
      </ol><br>
   
    <?php include 'calendar_view.php';?>
 &nbsp;
 &nbsp;
    <br>

    </section>
  </div>


  <footer class="main-footer">
  <br>

    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communication Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
  </footer>
  <br>



  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function() {
  
      $('#calendar').fullCalendar({
          header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
          },
          editable: false,
          eventLimit: true, // allow "more" link when too many events
          selectable: true,
          selectHelper: true,
          eventRender: function(calEvent, element, view) {
            if (calEvent.office == "0") {
              // element.css('background-color', '#99FF99');
            } if (calEvent.office == "1" ) {
              // element.css('background-color', '#99FF99');
            }
            if (calEvent.office == "16") {
              // element.css('background-color', '#415eec');
            }
            if (calEvent.office == "17") {
              // element.css('background-color', '#D7CDD5');
            }
            if (calEvent.office == "7") {
              // element.css('background-color', '#D7CDD5');
            }
            if (calEvent.office == "18") {
              // element.css('background-color', '#D7CDD5');
            }
            if (calEvent.office == "9") {
              // element.css('background-color', '#D7CDD5');
            }
            if($('input[id=all]').is(':checked')){
              return ['0', calEvent.office].indexOf($('#selectDivision').val()) >= 0  

            }else{
              return filter(calEvent); // Only show if appropriate checkbox is checked

            }
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
                      $end = $end[0];
                    }else{
                      $end = $event['end'];
                    }


                  $enddate = str_replace('-', '/', $end);
                  $realenddate = date('Y-m-d',strtotime($enddate . "+1 days"));

                  if($_SESSION['planningofficer'] == 1){
                    if (TRUE) {
                      ?>
                      {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $realenddate; ?>',
                        color: '<?php echo $event['color']; ?>',
                        office: '<?php echo $event['office']; ?>',
                        url: 'ViewEvent.php?eventid=<?php echo $event['id']; ?>'

                      },
                    <?php 
                    }
                  }else{

                    if (TRUE) {
                      ?>
                      {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $realenddate; ?>',
                        color: '<?php echo $event['color']; ?>',
                        office: '<?php echo $event['office']; ?>'

                      },
                    <?php 
                    }
                  }
                  endforeach; ?>
                ]
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
    function filter(calEvent) {
      var vals = [];
      $('input:checkbox.calFilter:checked').each(function() {
        vals.push($(this).val());
      });
      return vals.indexOf(calEvent.office) !== -1;
    }

</script>

</body>
</html>
