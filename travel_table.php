<?php
session_start();
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()

?>

<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">


<style>
th{
  color:blue;
  text-align:center;
}
/* .dataTables_wrapper .dataTables_paginate {
    float: left;
} */

</style>
</head>

<body>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="panel panel-defasult">
          <div class="box-body"> 
          
            <div>
                <h1>Monitoring of Travel Claim Request</h1><br>
           <a href = "CreateTravelClaim.php?ui=1" ><button class = "btn btn-md btn-success">Create</button></a><br><br><br>
                
            </div>
            
     
            
         
        
              <table id="example" class="table table-striped table-bordered table-responsive" style="width:;background-color: white;">
                    <thead>
                        <th>RO/TO/OB No.</th>
                        <th>TRAVEL DAYS</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>ORIGIN</th>
                        <th>DESTINATION</th>
                        <th>DISTANCE</th>
                        <th>VENUE</th>
                        <th style = "text-align:center;max-width:20%;">ACTION</th>
                    </thead>
                        
                        


                </table>
      


      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- Select2 -->
      <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
      <!-- InputMask -->
      <script src="plugins/input-mask/jquery.inputmask.js"></script>
      <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
      <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
      <!-- date-range-picker -->
      <script src="bower_components/moment/min/moment.min.js"></script>
      <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
      <!-- bootstrap datepicker -->
      <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <!-- bootstrap color picker -->
      <script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
      <!-- bootstrap time picker -->
      <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
      <!-- SlimScroll -->
      <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- iCheck 1.0.1 -->
      <script src="plugins/iCheck/icheck.min.js"></script>
      <!-- FastClick -->
      <script src="bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="dist/js/demo.js"></script>
      <!-- Page script -->



</div>
</div>


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>
