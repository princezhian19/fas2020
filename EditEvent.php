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
  <title>FAS | Edit Events</title>
  <link rel="shortcut icon" type="image/png" href="dilg.png">

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
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<script src="calendar/fullcalendar/lib/jquery.min.js"></script>
<script src="calendar/fullcalendar/lib/moment.min.js"></script>
<script src="calendar/fullcalendar/fullcalendar.min.js"></script>
    <style> .response {  } .success { background: #cdf3cd; padding: 10px 60px; border: #c3e6c3 1px solid;} </style>

  </head>



<body >
<?php 
function viewEvents()
{
    include 'connection.php';
    $sqlQuery = "SELECT * FROM events INNER JOIN tblemployee on events.postedby = tblemployee.EMP_N where events.id = ".$_GET['eventid']."";
    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    if ($row = mysqli_fetch_array($result)) {
        ?>
            <form method = "POST" action = "calendar/edit-event.php">
                <input  type = "hidden" name = "eventid" value = "<?php echo $row['id'];?>">
                <table class="table table-bordered"> 
                    <tr>
                        <td class="col-md-2">Event Title/Activity<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "titletxtbox" value = "<?php echo $row['title'];?>"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control" name = "startdatetxtbox" placeholder = "Start Date" id="datepicker1" value = "<?php  echo date('F d, Y',strtotime($row['start']));?>" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">End Date</td>
                            <td class="col-md-5">
                                <input  type = "text" class = "form-control" name = "enddatetxtbox" placeholder = "End Date" id="datepicker2" value = "<?php  echo date('F d, Y',strtotime($row['end']));?>" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Description</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "descriptiontxtbox" value = "<?php  echo $row['description'];?>" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "venuetxtbox" value = "<?php  echo $row['venue'];?>" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Expected number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "number" min = "0" name = "enp" class = "form-control" value = "<?php  echo $row['enp'];?>"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "targetparticipants" value = "<?php  echo $row['remarks'];?>" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control" value = "<?php  echo $row['UNAME'];?>"  />
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox" value = "<?php  echo date('F d, Y',strtotime($row['posteddate']));?>" /></td>
                                </tr>
                   
                    
                </table>
                <button style = "text-align:center;" class = "btn btn-success"><i class = "fa fa-arrow-left"></i>&nbsp;<a href= "ViewCalendar.php" style = "color:#fff;decoration:none;">Back</a></button>
                <input type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save"> 

            </form>
        <?php
    }
}
?>
  <?php include('connection.php');?>
  <?php include('test1.php');?>
  
  <div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Events</li>
                        </ol><br><br>
                        <div class="row">

          <div class="col-md-12">
          <div class = "response"></div>   

              <div class="box">
                  <div class="panel panel-defasult">
                      <div class="box-body"> 
                      <div class="col-md-6">
                      <h1>Calendar</h1>
                      </div>
                      <div class="col-md-6">
                      <h1>Edit Event/Activity</h1>

                      </div>
                              <div class = "col-md-6" id='calendar'></div>

                          <div class="well col-md-6" >
                        
                                    <?php echo viewEvents();?>
                                </div>
                       
                              
                            </div>
                            
                      </div>
                      
              </div>
          </div>
        </div>
    </section>
  </div>
    <footer class="main-footer">
        <BR>
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communication Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
  </footer>
  <br>

</div>
<?php
if($_GET['flag'] == 1)
{
    ?>
    <script>
    $(document).ready(function(){
        displayMessage('Data has been successfully updated.');
        setInterval(function() { window.location="ViewEvent.php?eventid=<?php echo $_GET['eventid'];?>"; }, 2000);
    });</script>
    <?php
}
?>
<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="_includes/sweetalert.min.js"></script>
<script>
function displayMessage(message)
 {
  $(".response").html("<div class='alert alert-success' role='alert' style = 'background-color:#ef9a9a;'>"+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    setInterval(function() { $(".alert").fadeOut(); }, 3000);
}
$(document).ready(function(){
    $( "#datepicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});


});
   


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
    ]
  });





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


</script>
</body>
</html>
