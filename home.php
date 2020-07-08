<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$OFFICE_STATION = $_SESSION['OFFICE_STATION'];
$username = $_SESSION['username'];
  }
?>
<!DOCTYPE html>
<html>
<title>FAS | Dashboard</title>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<style>
table{
  width:100%;
}
table tr{ 
    font-family:'Cambria';
  }
  .table-header{
    color:black;
    background-color:#B0BEC5; 

  }
  td{
    padding:5px;
  }
  td.label-text{ 
    background-color:#B0BEC5; 

  }
  </style>
</head>

<div class="modal fade" id="welcome-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" style = "width:60%;">
    <div class="modal-content">
      <div class="modal-header" style = "background-color:#B0BEC5;">
        <h5 class="modal-title" id="exampleModalLabel" style = "font-weight:bold;text-align:center;font-size:30px;">HEALTH DECLARATION FORM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      <table border = 1>
        <tbody>
          <tr>
            <td>Name:</td>
            <td colspan = 3> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
            <td style = "width:20%">Mobile Number:</td>
            <td> <input type ="text" class = "form-control" /> </td>
            <td> Body Temp. </td>
            <td> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
            <td>Email Address:</td>
            <td> <input type ="text" class = "form-control" /> </td>
            <td> Nationality: </td>
            <td> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
            <td rowspan = 2>Current Residention Address:</td>
            <td rowspan = 2><textarea cols = 53 rows=3  style = "resize:none;"></textarea></td>
            <td rowspan = 2>Sex:<br><br>Age</td>
            <td> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
          <td><input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
            <td>Office/Unit:</td>
            <td colspan = 3> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
            <td>Reporting Dates/ Days at Regional Office:</td>
            <td colspan = 3> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
            <td>Did you have any of the following in the last 14 days: fever, cough, colds, sore throat, diarrhea or difficulty in breathing?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2><textarea cols = 65 rows=5  style = "resize:none;">Please provide details:</textarea></td>
          </tr>
          <tr>
            <td>Have you worked, visited or travelled to any foreign countries in the past 14 days?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2 rowspan = 2><textarea cols = 65 rows=6 style = "resize:none;">Please provide specific details on the name of places and date of visit: (i.e. June 2- Mc Donald’s, Panay Ave, SM Hypermarket – Centris)</textarea></td>
          </tr>
          <tr>
            <td>Have you worked, visited or travelled to other places in the Philippines in the past 7 days?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
          </tr>
          <tr>
          <td>Have you been in close contact with farm animals or exposed to wild animals in the past 14 days?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2><textarea cols = 65 rows=5  style = "resize:none;">Please provide details:</textarea></td>
          </tr>
          <tr>
          <td>Have you been exposed to a person with COVID-19 or person under investigation for COVID-19?</td>
            <td>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Yes</label>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">No</label>
            </div>
            </td>
            <td colspan = 2><textarea cols = 65 rows=5  style = "resize:none;">Please provide details:</textarea></td>
          </tr>
          <tr>
          <td colspan = 2><b>FOR WOMEN:</b><br> When was your last menstruation period? </td>
          <td colspan = 2> <input type ="text" class = "form-control" /> </td>
          </tr>
          <tr>
          <td style = "text-align:justify;" colspan = 5>Declaration:<br><br>
            The information I have given herein is true, correct and complete, I understand that failure to answer any question or any falsified response may have serious consequences. (Article 171 and 172 of the revised Penal Code of the Philippines).
            <span class = "pull-right" STYLE = "margin-left:50px;"> <br>_________________________________ <br>DATE</span>                                            
            <span class = "pull-right"> <br>_________________________________ <br>NAME AND SIGNATURE </span>                                            
          </td>
          </tr>

        </tbody>
      </table>
        <!-- <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
  $('#welcome-modal').modal('show');

});
</script>
<body class="hold-transition fixed skin-red-light sidebar-mini">
<div class="wrapper">
   <?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'magonzales' || $username == 'seolivar' || $username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'sglee') { 
    include('test1.php'); 
//     if($username == 'masacluti'){
//     ?>
    
//     <script>
// window.location.href = 'DTR.php?division=<?php echo $_GET['division']; ?>&username=<?php echo $username;?>';

// </script>

//     <?php
//     }
}else{ 

     if ($OFFICE_STATION == 1) {
  include('sidebar2.php');
           
        }else{
  include('sidebar3.php');
         
        } 
}
 ?>
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      <br>
      <br>
        <?php include('dash_board.php');?>
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
</div>

 <script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<script>
  $(function () {
    $('#example15').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aLengthMenu: [ [1, 10, 20, -1], [1, 10, 20, "All"] ],
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false,
      "pagingType": "simple",
      "language": {
      "paginate": {
      "previous": "<",
      "next":">"
}
}
    })
  })
</script>

