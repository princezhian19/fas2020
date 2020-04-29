<?php
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
                <h1>Monitoring of ICT Technical Assistance Request</h1><br>
                <?php 
                ?>
            </div>
            <?php
include 'connection.php';
            $name = $_SESSION['username'];
            $query = "SELECT * from tblemployee where UNAME = '$name'";
            $result = mysqli_query($conn,$query);
            if($row = mysqli_fetch_array($result))
            {
              if($_GET['division'] != '10')
              {
                ?>
                <li class="btn btn-success">
                  <a href="requestForm.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Create Request</a>
                </li>
                <?php
              }else{
  
                ?>
                  <div class="well">
                    <div class="row">
                        <div class="col-md-2">
                              <?php include 'current_month.php';?>
                        </div>
                        <div class="col-md-2">
                              <select class="form-control " id="selectYear" style="width: 100%;">
                                <?php 
                                for($i= 2020; $i < 2021; $i++)
                                {
                                  echo '<option value='.$i.'>'.$i.'</option>';
                                }
                                ?>
                              </select>
                        </div>
                        <div class="col-md-2">
                          <ol style = "decoration:none;margin-left:-50px;"><button class="btn btn-success" id = "fml"> Export PML Report</button></ol>
                        </div>
                        <div class="col-md-2" style = "margin-left:-30px;">
                          <li class="btn btn-success"><a  href="#" style="color:white;text-decoration: none;" id = "psl">Export PSL Report</a></li>
                        </div>
  
                        <div class = "col-md-2" style = "float:right;margin-right:-30px;">
                          <li class="btn btn-success">
                          <a href="requestForm.php?division=<?php echo $_GET['division'];?>" style="color:white;text-decoration: none;">Create Request</a>
                          
                          </li>

                        </div>
                    </div>
                  </div>
                <?php
              }
            }
          
            
            ?>
        
              <table id="example" class="table table-striped table-bordered table-responsive" style="width:;background-color: white;">
                    <thead>
                        <th>CONTROL NO.</th>
                        <th>REQUESTED DATE</th>
                        <th>REQUESTED TIME</th>
                        <th>RECEIVED DATE</th>
                        <th>RECEIVED TIME</th>
                        <th>END USER</th>
                        <th>OFFICE</th>
                        <th>ISSUE/CONCERN</th>
                        <th>TYPE OF REQUEST</th>
                        <th>Assigned Person</th>
                        <th>STATUS</th>
                        <th style = "text-align:center;">ACTION</th>
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
      <script>
     
  $(function () {

  
    $('#fml').on('click', function()
    {
      var month = $('#selectMonth').val();
      var year = $('#selectYear').val();
      window.location = "_fmlReport.php?month="+month+"&&year="+year;
    });

    $('#psl').on('click', function()
    {
      var month = $('#selectMonth').val();
      var year = $('#selectYear').val();
      window.location = "_pslReport.php?month="+month+"&&year="+year;
    });


  });

        $(function () {
    //Initialize Select2 Elements

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


</div>
</div>


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>
