<?php 
session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
?>

<?php

$getid = $_GET['getid'];
//echo $getid;

$servername = "localhost";

$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";

$database = "fascalab_2020";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

// Getting values from id
$view_query = mysqli_query($conn, "SELECT * FROM saro where id ='$getid' ");

while ($row = mysqli_fetch_assoc($view_query)) {
  $id = $row["id"];  
  $date1 = $row["sarodate"];
  $d1 = date('m/d/Y', strtotime($date1));

  $saronumber = $row["saronumber"];
  $fund = $row["fund"];
  $legalbasis = $row["legalbasis"];
  $ppa = $row["ppa"];
  $expenseclass = $row["expenseclass"];
  $particulars = $row["particulars"];
  $uacs = $row["uacs"];
  $amount = $row["amount"];
  $obligated = $row["obligated"];
  $balance = $row["balance"];
  $group = $row["sarogroup"];
}
?>

<!DOCTYPE html>
<html>
<!-- <style>
  a:hover {
  color: blue;
}
  .p:hover {
  color: blue;
}
  span:hover {
  color: blue;
}
</style> -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <!-- Auto Complete -->
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="home.php"><i class=""></i> Home</a></li>
        <li class="active">Create SARO/SUB-ARO</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="panel panel-default">
        <br>
      
            <h1 align="">&nbspUpdate SARO</h1>
            <div class="box-header with-border">
    
        <br>
      <li class="btn btn-primary"><a href="saro.php" style="color:white;text-decoration: none;">Back</a></li> | 
      <a class="btn btn-success btn-s" href='@Functions/sofexport.php?getid=<?php echo $getid?>'> <i class='fa fa-fw fa-download'> </i>Export</a>

      <br>
      <br>
      <!-- Start form -->
  <form class="" method='POST' action="@Functions/saroupdatefunction.php" >
        <!-- Start Menu -->

   <!-- getting ID for update function -->
   <input type="hidden" name="requestid" value = "<?php echo $getid;?>" >
    <!-- getting ID for update function -->
    

        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">

                <label>Date</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="sarodate" value = "<?php echo $d1;?>">
                    </div>
                    <br>
                    <label>Source No. <label style="color: Red;" >*</label></label>
                      <input  type="text" class="typeahead form-control" style="height: 35px;" id="saronumber" placeholder="Enter Source" name="saronumber" value = "<?php echo $saronumber;?>">
                      <br>
                      <label>PPA</label>
                    <input  type="text"  class="form-control" style="height: 35px;" id="ppa" placeholder="Enter PPA" name="ppa" value = "<?php echo $ppa;?>">
                    <br>
                    
                </div>    
                
                <div class="col-md-6">
                    
                    <label>Fund</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="fund" placeholder="Enter Fund" name="fund" value = "<?php echo $fund;?>">
                    <br>
                    <label>Legal Basis</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="legalbasis" placeholder="Enter Legal Basis" name="legalbasis" value = "<?php echo $legalbasis;?>">
                    <br>
                  
                    <label>Particulars</label>
                    <input  type="text"   class="form-control" style="height: 35px;" id="particulars" placeholder="Enter Particulars" name="particulars" value = "<?php echo $particulars;?>">
                    <br>
                     
                    
                </div>
            </div>
        </div>
        <div class="well">
        <div class="class">
             <!-- ORS -->
            <div class="row">
                <div class="col-md-6">
                    <label>Expense Class</label>
                    <?php if ($expenseclass == 'MOOE'): ?>
                      <select  class="form-control" style="width: 100%; height: 40px;" name="expenseclass" id="expenseclass"  >
           
                    <option value = "MOOE">Maintenance and Other Operating Expenses</option>
                    <option value = "PS">Personnel Service</option>
                    <option value = "FE">Financial Expenses</option>
                    <option value = "CO">Capital Outlay</option>
                    </select>
                    <?php endif ?>
                    <?php if ($expenseclass == 'PS'): ?>
                      <select  class="form-control" style="width: 100%; height: 40px;" name="expenseclass" id="expenseclass"  >
           
                    <option value = "PS">Personnel Service</option>
                    <option value = "MOOE">Maintenance and Other Operating Expenses</option>
                    <option value = "FE">Financial Expenses</option>
                    <option value = "CO">Capital Outlay</option>
                    </select>
                    <?php endif ?>
                    <?php if ($expenseclass == 'FE'): ?>
                      <select  class="form-control" style="width: 100%; height: 40px;" name="expenseclass" id="expenseclass"  >
                    <option value = "FE">Financial Expenses</option>
                    <option value = "PS">Personnel Service</option>
                    <option value = "MOOE">Maintenance and Other Operating Expenses</option>
                    <option value = "CO">Capital Outlay</option>
                    </select>
                    <?php endif ?>
                    <?php if ($expenseclass == 'CO'): ?>
                      <select  class="form-control" style="width: 100%; height: 40px;" name="expenseclass" id="expenseclass"  >
                    <option value = "CO">Capital Outlay</option>
                    <option value = "FE">Financial Expenses</option>
                    <option value = "PS">Personnel Service</option>
                    <option value = "MOOE">Maintenance and Other Operating Expenses</option>
                    </select>
                    <?php endif ?>
                    
                    
                  <!--   <input  type="text"   class="form-control" style="height: 35px;" id="expenseclass" placeholder="Enter Expense Class" name="expenseclass"> -->
                    <br>
                </div>
                <div class="col-md-6">
              
                    
                    <label>UACS</label>
                    <input  type="text"   class="form-control" style="height: 35px;" id="uacs" placeholder="Enter UACS" name="uacs" value = "<?php echo $uacs;?>">
                    <br>
                   
                </div>
               
            </div>
           
             
             <br>
           
            <div class="row">

            <div class="col-md-3">
                    <label>Group</label>
                    <input  type="text"  class="form-control" style="height: 40px;" id="group" placeholder="" name="group" value = "<?php echo $group;?>">
                   
                </div>


                <div class="col-md-3">
                    <label>Amount <label style="color: Red;" >*</label></label>
                    <input  type="number"  class="form-control" style="height: 40px;" id="amount" placeholder="Enter amount" name="amount" value = "<?php echo $amount;?>">
                   
                </div>

              
                <div class="col-md-3">
                    <label>Obligated</label>
                    <input  type="text" readonly  class="form-control" style="height: 40px;" id="obligated" placeholder="" name="obligated" value = "<?php echo $obligated;?>">
                    
                </div>

                <div class="col-md-3">
                    <label>Balance</label>
                    <input  type="text" readonly  class="form-control" style="height: 40px;" id="balance" placeholder="0" name="balance" value = "<?php echo $balance;?>" >
                </div>

            
            </div>           
            <!-- END SARO -->
            <br> 
        </div>
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-primary">Update</button>
    <br>
    <br>
    </div>
  </form>
    <!--End Submit -->
  </div>

    </section>
  </div>
 
</div>

<script src="dist/js/demo.js">
</script>
<!-- <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> -->


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
    //Initialize Select2 Elements
    $('.select2').select2()

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

</body>
</html>