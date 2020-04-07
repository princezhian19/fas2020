<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html>
<title>FAS: Events Management Dashboard</title>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/png" href="dilg.png">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> </head>
  <link rel="stylesheet" href="_includes/sweetalert.css">
  
  <!-- CALENDAR -->
  <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
  <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
  <script src="calendar/fullcalendar/lib/moment.min.js"></script>
  <script src="calendar/fullcalendar/fullcalendar.min.js"></script>

  <style> .response { height: 60px; } .success { background: #cdf3cd; padding: 10px 60px; border: #c3e6c3 1px solid;} </style>

<body >
<div class="wrapper">
  <?php include('connection.php');?>
  <?php include('sidebar.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="home.php"><i class=""></i> Home</a></li>
          <li class="active">Add Events</li>
        </ol><br><br><br>
        <div class="row">
          <div class="col-md-12">
              <div class="box">
                  <div class="panel panel-defasult">
                  <form method="POST" enctype="multipart/form-data" class="myformStyle" autocomplete="off" id = "submit"> 
                  <div class = "response"></div>   
                      <div class="box-body"> 
                          <div>
                              <h1>Calendar of Activities: Adding Events</h1><br>
                          </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>Title</label>
                                        <input  autocomplete = "off"  id = "titletxtbox" class="form-control" name="titletxtbox" type="text"  >
                                            </div>
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>Description</label>
                                        <input required autocomplete = "off"  id="descriptiontxtbox" value="" class="form-control" name="descriptiontxtbox" type="text" >
                                            </div>
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>Start Date</label>
                                        <input required required type="text" id = "startdatetxtbox" name = "startdatetxtbox" placeholder = "Start Date" class="form-control datePicker1" value="" required placeholder="mm/dd/yyyy" >
                                            </div>
                                
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>End Date</label>
                                        <input required required type="text" id = "enddatetxtbox" name = "enddatetxtbox" placeholder = "End Date" class="form-control datePicker1" value="" required placeholder="mm/dd/yyyy" >
                                            </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>Venue</label>
                                        <input required  id = "venuetxtbox" autocomplete = "off" class="form-control" name="venuetxtbox" type="text" > 
                                            </div>
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>No. of Participants</label>
                                        <input required id = "enptxtbox" autocomplete = "off" class="form-control" name="enptxtbox" type="text" >
                                            </div>
                                <div class="form-group">
                                    <label><span style = "color:red;">*</span>Target Participants</label>
                                        <input required  id = "remarks" autocomplete = "off"  class="form-control" name="remarks" type="text" >
                                            </div>
                            </div>
                            </div>
                      </div>
                      <button class="btn btn-success btn-lg pull-right  sweet-14" style="float: right;" type = "button">Save</button>
                  </form>
              </div>
          </div>
        </div>
    </section>
  </div>
</div>
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
function displayMessage(message) {
  $(".response").html("<div class='alert' role='alert' style = 'background-color:#ef9a9a;'>"+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
setInterval(function() { $(".alert").fadeOut(); }, 3000);
}
    $( ".datePicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

   $('.sweet-14').click(function()
    {
        var title = $('#titletxtbox').val();
        var desc = $('#descriptiontxtbox').val();
        var start = $('#startdatetxtbox').val();
        var end = $('#enddatetxtbox').val();
        var venue = $('#venuetxtbox').val();
        var enp = $('#enptxtbox').val();
        var participants = $('#remarks').val();
        if(title== '' || desc == '' || start == '' || end == '' || venue == '' || enp == '' || participants == '')
        {
           displayMessage('Note: All fields with <b>(*)</b> are all required!');
        }else{
            swal({
            title: "Are you sure you want to save?",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
         var queryString = $('#submit').serialize();
           $.ajax({
           url:"calendar/add-event.php",
           method:"POST",
           data:$("#submit").serialize(),
           success:function(data)
           {
               setTimeout(function () {
               swal("Record saved successfully!");
               }, 3000);
           }
         });
         
         
     });
        }
     
   });



</script>
</body>
</html>
