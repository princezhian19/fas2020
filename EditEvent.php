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

$sql = "SELECT id, title, start, end, color, cancelflag FROM events where cancelflag = 0 and status = 1";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

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
  <!-- CALENDAR -->
  <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
  <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
  <script src="calendar/fullcalendar/lib/moment.min.js"></script>
  <script src="calendar/fullcalendar/fullcalendar.min.js"></script>
<style> .response { height: 60px; } .success { background: #cdf3cd; padding: 10px 60px; border: #c3e6c3 1px solid; } </style>
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
                        <td class="col-md-2"><span style = "color:red;">*</span>Title</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "titletxtbox" value = "<?php echo $row['title'];?>"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2"><span style = "color:red;">*</span>Start Date</td>
                            <td class="col-md-5">
                                <input required type="text" class = "form-control" name = "startdatetxtbox" placeholder = "Start Date" id="datepicker1" value = "<?php  echo date('F d, Y',strtotime($row['start']));?>" placeholder="mm/dd/yyyy"  required autocomplete = off  >
                                    </td>
                                        </tr>
                    <tr>
                        <td class="col-md-2">End Date</td>
                            <td class="col-md-5">
                                <input required type = "text" class = "form-control" name = "enddatetxtbox" placeholder = "End Date" id="datepicker2" value = "<?php  echo date('F d, Y',strtotime($row['end']));?>" /></td>
                                    </tr>
                    <tr>
                        <td class="col-md-2">Description</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "descriptiontxtbox" value = "<?php  echo $row['description'];?>" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2"><span style = "color:red;">*</span>Venue</td>
                            <td class="col-md-5"><input required type = "text" class = "form-control" name = "venuetxtbox" value = "<?php  echo $row['venue'];?>" /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2"><span style = "color:red;">*</span>Expected number of Participants</td>
                            <td class="col-md-5"><input required type = "number" min = "0" name = "enp" class = "form-control" value = "<?php  echo $row['enp'];?>"  /></td>
                                </tr>
                    <tr>
                        <td class="col-md-2"><span style = "color:red;">*</span>Target Participants</td>  
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
                            <td class="col-md-5"><input readonly type = "text" class = "form-control" placeholder = "Posted Date" id="datepicker3" name = "enddatetxtbox" value = "<?php  echo date('F d, Y',strtotime($row['posteddate']));?>" /></td>
                                </tr>
                   
                    
                </table>
                <button style = "text-align:center;" class = "btn btn-success"><i class = "fa fa-arrow-left"></i>&nbsp;<a href= "ViewCalendar.php" style = "color:#fff;decoration:none;">Back</a></button>
                <input type = "submit" style = "text-align:center;margin-left:5px;" class = "pull-right btn btn-success" value = "Save Changes"> 

            </form>
        <?php
    }
}
?>
<body >
<?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'magonzales' || $username == 'seolivar' || $username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'rdmiranda') { include('sidebar.php'); }else{ include('sidebar2.php'); }
 ?>
  <?php include('connection.php');?>

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="home.php"><i class=""></i> Home</a></li>
                    <li class="active">Events</li>
                        </ol>
        <div class="response"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="panel panel-defasult">
                            <div class="box-body"> 
                                <div>
                                    <h1>Calendar of Activities:Modifying of Events</h1><br>
                                </div>
                                <div class="well">
                                    <?php echo viewEvents();?>
                                </div>
                            </div>
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


</body>
</html>
<script>
$(document).ready(function(){
    $( "#datepicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    $( "#datepicker3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
});
</script>