<!DOCTYPE html>
<html>

<?php

$getid = $_GET['getid'];
echo $getid;

$servername = "localhost";

$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";

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
$view_query = mysqli_query($conn, "SELECT * FROM nta where id ='$getid' ");

while ($row = mysqli_fetch_assoc($view_query)) {
    $id = $row["id"];

    $datenta1 = $row["datenta"];
    $datenta = date('m/d/Y', strtotime($datenta1));

    $datereceived1 = $row["datereceived"];
    $datereceived = date('m/d/Y', strtotime($datereceived1));

    $accountno = $row["accountno"];
    $ntano = $row["ntano"];
    $saronumber = $row["saronumber"];
    $particular = $row["particular"];
    $amount = $row["amount"];
    $obligated = $row["obligated"];
    $balance = $row["balance"];
   
}
?>
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
    


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
        <li class="active">Update NTA</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="panel panel-default">
        <br>
      
            <h1 align="">&nbspUpdate NTA</h1>
            <div class="box-header with-border">
    
        <br>
      <li class="btn btn-success"><a href="@nta.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <!-- Start form -->
  <form class="" method='POST' action="@Functions/ntaupdatefunction.php" >

  <!-- getting ID for update function -->
  <input type="hidden" name="requestid" value = "<?php echo $getid;?>" >
    <!-- getting ID for update function -->
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">

                <label>Date NTA </label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input required type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' value="<?php echo $datenta ?>" name="datenta">
                    </div>
                    <br>

                    <label>Date Received </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input required type="text" class="form-control pull-right" id="datepicker2" placeholder='Enter Date' value="<?php echo $datereceived ?>" name="datereceived">
                    </div>
                    <br>
                    <!-- <label>Source No.</label>
                      <input  type="text" class="typeahead form-control" style="height: 35px;" id="saronumber" placeholder="Enter Source" name="saronumber">
                      <br> -->
                    
                </div>    
                
                <div class="col-md-6">

                    <label>NTA No</label>
                      <input required  type="text" class="form-control" style="height: 35px;" id="legalbasis" value="<?php echo $ntano ?>" placeholder="Enter NTA No" name="ntano">
                    <br>
                   
                    <label>SARO Number</label>
                    <input  type="text"  class="form-control" style="height: 35px;" id="ppa" placeholder="Enter SARO Number" value="<?php echo $saronumber ?>" name="saronumber">
                    <br>
                  
                   
                     
                    
                </div>
            </div>
        </div>
        
        <div class="class">
             <!-- ORS -->
            <div class="row">
                <div class="col-md-6">
                     
                    <label>Account No</label>
                      <input required  type="text" class="form-control" style="height: 35px;" id="fund" placeholder="Enter Account No" value="<?php echo $accountno ?>" name="accountno">
                    <br>
                   
                    
                </div>
                <div class="col-md-6">
                <label>Particular</label>
                    <input  type="text"   class="form-control" style="height: 35px;" id="expenseclass" placeholder="Enter Particular" value="<?php echo $particular ?>" name="particular">
                   


                </div>
               
            </div>
           
             
             <br>
           
            <div class="row">

          

                <div class="col-md-4">
                    <label>Amount</label>
                    <input required  type="number"  class="form-control" style="height: 40px;" id="amount" placeholder="Enter amount" value="<?php echo $amount ?>" name="amount">
                   
                </div>

                
             
                
                <div class="col-md-4">
                    <label>Obligated</label>
                    <input  type="text"   class="form-control" style="height: 40px;" id="obligated" placeholder="Enter Obligated" name="obligated" value="<?php echo $obligated ?>"  value="0">
                    
                </div>

                <div class="col-md-4">
                    <label>Balance</label>
                    <input  type="text"   class="form-control" style="height: 40px;" id="balance" value="<?php echo $balance ?>" name="balance" >
                </div>

            
            </div>
            <!-- END SARO -->
            <br>
            
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width: %;" class="btn btn-success">Update</button>
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
