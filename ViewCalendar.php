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

$sql = "SELECT id, title, start, end, description,venue, tblpersonneldivision.DIVISION_COLOR as 'color', cancelflag, office,enp,remarks FROM events inner join tblpersonneldivision on events.office = tblpersonneldivision.DIVISION_N where cancelflag = 0 and status = 1 ";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

function viewEvents()
{
        ?>
            <form method = "POST" action = "calendar/add-event.php">
                <input  type = "hidden" name = "eventid" value = "<?php echo $row['id'];?>">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2">Event/Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "titletxtbox" id = "titletxtbox"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control" name = "startdatetxtbox" id="datepicker1" value = "" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">End Date</td>
                            <td class="col-md-5">
                                <input  type = "text" placeholder="mm/dd/yyyy" class = "form-control" name = "enddatetxtbox"  id="datepicker2" value = "" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Description</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "descriptiontxtbox" id = "descriptiontxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "venuetxtbox" id= "venuetxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "number" min = "0" name = "enptxtbox" id= "enptxtbox" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "remarks" id= "remarks" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control" value = "<?php echo $_SESSION['username'];?>"  />
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox"  /></td>
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

    <form method = "POST" action = "calendar/add-event.php">
                <input  type = "hidden" name = "eventid" value = "<?php echo $row['id'];?>">
                <table class="table table-bordered" style = "width:100%;"> 
                    <tr>
                        <td class="col-md-2">Event/Activity Title<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "titletxtbox" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Start Date<span style = "color:red;">*</span></td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control datepicker1" name = "startdatetxtbox"  value = "" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">End Date</td>
                            <td class="col-md-5">
                                <input  type = "text" placeholder="mm/dd/yyyy" class = "form-control" name = "enddatetxtbox"  id="datepicker2" value = "" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Description</td>
                            <td class="col-md-5"><input  type = "text" class = "form-control" name = "descriptiontxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Venue<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "venuetxtbox" value = "" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Expected Number of Participants<span style = "color:red;">*</span></td>
                            <td class="col-md-5"><input required type = "number" min = "0" name = "enptxtbox" class = "form-control" value = ""  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2">Target Participants<span style = "color:red;">*</span></td>  
                            <td class="col-md-5">
                            <input required type = "text" class = "form-control" name = "remarks" value = "" />
                                </td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Posted By</td>
                            <td class="col-md-5">                              
                            <input readonly type = "text"  class = "form-control" value = "<?php echo $_SESSION['username'];?>"  />
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">Posted Date</td>
                            <td class="col-md-5"><input disabled type = "text" class = "form-control" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox"  /></td>
                                </tr>
                   
                    
                </table>
                <input type = "submit" name = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save"> 

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
      <li class="active">Calendar of Activities</li>
      </ol><br>
   
    <?php include 'calendar_view.php';?>
 &nbsp;
 &nbsp;
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Event/Activity</h4>
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

<div class="modal fade" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Event/Activity</h4>
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
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
  $('#modal').click(function(){
    $('#myModal2').modal('show');   
  })
  
  $(document).ready(function(){
  
    
    $( ".datepicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $(".datepicker1").datepicker().datepicker("setDate", new Date());


  })
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

        select: function (start, end, allDay) {
          $('#myModal').modal('show');   
        },
        eventClick: function(event, element) {
                // Display the modal and set the values to the event values.
                $('#myModal').modal('show');
                $('#myModal').find('#titletxtbox').val(event.title);
                $('#myModal').find('#startdatetxtbox').val(event.start);
                $('#myModal').find('#descriptiontxtbox').val(event.description);
                $('#myModal').find('#venuetxtbox').val(event.venue);
                $('#myModal').find('#enptxtbox').val(event.enp);
                // $('#myModal').find('#ends-at').val(event.end);

            },
          eventRender: function(calEvent, element, view) {
      
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
                        description: '<?php echo $event['description']; ?>',
                        venue: '<?php echo $event['venue']; ?>',
                        color: '<?php echo $event['color']; ?>',
                        office: '<?php echo $event['office']; ?>',
                        enp: '<?php echo $event['enp']; ?>',
                    

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
                        description: '<?php echo $event['description']; ?>',
                        venue: '<?php echo $event['venue']; ?>',
                        color: '<?php echo $event['color']; ?>',
                        office: '<?php echo $event['office']; ?>',
                        enp: '<?php echo $event['enp']; ?>',
                        

                    

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
        // alert($(this).val());
      });
      return vals.indexOf(calEvent.office) !== -1;
    }

</script>

</body>
</html>
