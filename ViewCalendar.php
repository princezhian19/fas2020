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

$sql = "SELECT id, title, start, end, color, cancelflag,office FROM events where cancelflag = 0 and status = 1 ";
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
<div class="content-wrapper">
    <section class="content-header">
     <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Calendar of Events</li>
      </ol><br>
      <?php include 'calendar_view.php';?>
    </section>
 
  </div>


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communication Technology Unit (RICTU) © 2019 All Right Reserved .</strong> All rights
    reserved.
  </footer>


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
  $(function () {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
	
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
    select: function(start, end) {
    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
    $('#ModalAdd').modal('show');
    },
    eventRender: function(event, element) {  
    element.find('.fc-time').hide();
    },
    eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
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
        url: 'ViewEvent.php?eventid=<?php echo $event['id']; ?>',

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
        office: '<?php echo $event['office']; ?>',

      },
    <?php 
    }
  }
  endforeach; ?>
    ], 
     eventRender: function eventRender( event, element, view ) {
        return ['0', event.office].indexOf($('#selectDivision').val()) >= 0
    }
  });
  $('#selectDivision').on('change',function(){
    $('#calendar').fullCalendar('rerenderEvents');
})




/*function edit(event){
  start = event.start.format('YYYY-MM-DD HH:mm:ss');
  if(event.end){
    end = event.end.format('YYYY-MM-DD HH:mm:ss');
  }else{
    end = start;
  }
  
  id =  event.id;
  
  Event = [];
  Event[0] = id;
  Event[1] = start;
  Event[2] = end;
  
  $.ajax({
   url: 'editEventDate.php',
   type: "POST",
   data: {Event:Event},
   success: function(rep) {
      if(rep == 'OK'){
        alert('Saved');
      }else{
        alert('Could not be saved. try again.'); 
      }
    }
  });
}*/

});
$("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');

$(".select_month").on("change", function(event) {
$('#calendar').fullCalendar('changeView', 'month', this.value);
$('#calendar').fullCalendar('gotoDate', "2020-"+this.value+"-1");

});
function displayMessage(message) {
  $(".response").html("<div class='success'>"+message+"</div>");
setInterval(function() { $(".success").fadeOut(); }, 1000);
}

</script>

</body>
</html>
