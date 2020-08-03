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

    $duration1 = $row["duration"];
    $duration = date('m/d/Y', strtotime($duration1));


    $quarter = $row["quarter"];
  
   
}
?>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-wid, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
 

    <!-- Auto Complete -->

  
   

</head>

<?php 
  if ($username == 'charlesodi' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti' || $username == 'magonzales' || $username == 'seolivar' || $username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'rlsegunial') { include('test1.php'); }else{ include('sidebar2.php'); }
 ?>
 
    <body class="hold-transition skin-red-light fixed sidebar-mini">
<div class="wrapper">

  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
        <li class="active">Accounting</li>
        <li class="active">Edit NCA/NTA</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="box" style="border-style:groove">
        <br>
      
            <h1 align="">&nbspEdit NCA/NTA</h1>
            <div class="box-header with-border">
            <li class="btn btn-warning"><a href="nta.php" style="color:white;text-decoration: none;">Back</a></li>
        <br>
        <br>
        <br>
    
      <!-- Start form -->
  <form class="" method='POST' action="@Functions/ntaupdatefunction.php" >

  <!-- getting ID for update function -->
  <input type="hidden" name="requestid" value = "<?php echo $getid;?>" >

  <input type="hidden" name="quarter1" id="quarter1" value = "<?php echo $quarter;?>" >
    <!-- getting ID for update function -->
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">

                <label>Date NTA <span style = "color:red;">*</span> </label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon" style="border-style: groove;">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input required type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' value="<?php echo $datenta ?>" name="datenta" style="border-style: groove;">
                    </div>
                    <br>

                    <label>Date Received <span style = "color:red;">*</span> </label>
                    <div class="input-group date">
                        <div class="input-group-addon" style="border-style: groove;">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input required type="text" class="form-control pull-right" id="datepicker2" placeholder='Enter Date' value="<?php echo $datereceived ?>" name="datereceived" style="border-style: groove;">
                    </div>
                    <br>

                    <label>NTA No <span style = "color:red;">*</span></label>
                      <input required  type="text" class="form-control" style="height: 35px; border-style: groove;" id="legalbasis" value="<?php echo $ntano ?>" placeholder="Enter NTA No" name="ntano">
                    <br>
                   
                    <label>SARO Number</label>
                    <input  type="text"  class="form-control" style="height: 35px; border-style: groove;" id="ppa" placeholder="Enter SARO Number" value="<?php echo $saronumber ?>" name="saronumber">
                    <br>
                    
                    <label>Account No <span style = "color:red;">*</span></label>
                      <input required  type="text" class="form-control" style="height: 35px; border-style: groove;" id="fund" placeholder="Enter Account No" value="<?php echo $accountno ?>" name="accountno">
                    <br>

                 
                    <label>Particular <span style = "color:red;">*</span></label>
                    <input required  type="text"   class="form-control" style="height: 35px; border-style: groove;" id="expenseclass" placeholder="Enter Particular" value="<?php echo $particular ?>" name="particular">
                    <br>
                    
                    
                </div>    
                
                <div class="col-md-6">
                <label>NTA/NCA Quarters <span style = "color:red;">*</span></label>
                <select class="form-control select input" style="width: 100%; height: 35px;" name="quarter" id="quarter" required >
                <option value = "">Select Quarter</option>
                <option value = "1Q">1st Quarter</option>
                <option value = "2Q">2nd Quarter</option>
                <option value = "3Q">3rd Quarter</option>
                <option value = "4Q">4th Quarter</option>
                </select>
                <br>
                <label>NCA/NTA DURATION <span style = "color:red;">*</span> </label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon" style="border-style: groove;">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input readonly required value="" type="text" class="form-control pull-right" id="" placeholder='Enter Date' name="duration" style="border-style: groove;">
                    </div>
                    <br>
                    <label>Amount <span style = "color:red;">*</span></label>
                    <input required  type="number"  class="form-control" style="height: 35px; border-style: groove;" id="amount" placeholder="Enter amount" value="<?php echo $amount ?>" name="amount">
                    <br>
                    <label>Obligated</label>
                    <input  type="text"   class="form-control" style="height: 35px; border-style: groove;" id="obligated" placeholder="Enter Obligated" name="obligated" value="<?php echo $obligated ?>"  value="0">
                    <br>
                    <label>Balance</label>
                    <input  type="text"   class="form-control " style="height: 35px; border-style: groove; " id="balance" value="<?php echo $balance ?>" name="balance" >
                    
                </div>
            </div>
        </div>
        
        <div class="class">
             <!-- ORS -->
            <div class="row">
                <div class="col-md-6">
                     
                     

                   
                    
                </div>
                <div class="col-md-6">
               
                   


                </div>
               
            </div>
           
             
             <br>
           
         
            <!-- END SARO -->
            <br>
            
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-primary pull-right" style="margin-right:10px;">Save</button>
    <br>
    <br>
    <br>
    </div>
  </form>
   <br>
    <br>
    <br>
        
    <!--End Submit -->
  </div>

  <footer class="main-footer">
    <br>
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>DILG IV-A Regional Information and Communications Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
    </footer>

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


<script>
  $(document).ready(function() {
   
    var quarter1 = $("#quarter1").val();
   
    //  alert(quarter1);
    /* Select default value of select option */
    if(quarter1=='1stQuarter'){
      $("#quarter option[value=1stQuarter]").attr('selected', 'selected');
    }
    else if(quarter1=='2ndQuarter'){
      $("#quarter option[value=2ndQuarter]").attr('selected', 'selected');
    }
    else if(quarter1=='3rdQuarter'){
      $("#quarter option[value=3rdQuarter]").attr('selected', 'selected');
    }
    else if(quarter1=='4thQuarter'){
      $("#quarter option[value=4thQuarter]").attr('selected', 'selected');
    }
    else {
      $("#quarter option[value=]").attr('selected', 'selected');
    }
    /* Select default value of select option */
    /* LOADING of DATA TABLES */

  });

</script>

<script>
$(document).ready(function(){
  $("#quarter").change(function (){


    quarter = document.getElementById("quarter").value;
    var duration = $("input[name='duration']"); 

   
    if(quarter=='1Q'){
    duration.val('04/01/2020');
    }
    
    else if(quarter=='2Q'){
    duration.val('07/01/2020');
    }
    
    else if(quarter=='3Q'){
    duration.val('10/01/2020');
    }
    
    else if(quarter=='4Q'){
    duration.val('01/01/2021');
    }
    else{
      duration.val('');

    }
  

  });
});
</script>



</body>
</html>
