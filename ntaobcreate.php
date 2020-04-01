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
    


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../frontend/web/"><i class=""></i> Home</a></li>
        <li class="active">Create NTA Obligation</li>
      </ol>
      <br>
      <br>

    <!-- Start Panel -->
    <div class="panel panel-default">
        <br>
      
            <h1 align="">&nbspPayment</h1>
            <div class="box-header with-border">
    
        <br>
      <li class="btn btn-success"><a href="ntaobligation.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <!-- Start form -->
  <form class="" type='GET' action="@Functions/ntaobcreatefunction.php" >
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-7">
                <label>Account No.</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="" placeholder="Enter Account No." name="accountno" required>
                      <table class="table table-striped table-hover" id="main1">
                      <tbody id="result1">
                      </tbody>
                      </table>
                      <br>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@ntaobvalue1.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result1').html(data);
                    }
                  });
                }
                $('#accountno').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    load_data();
                    document.getElementById('accountno').value = "";
                  }
                });
              });
              function showRow1(row)
              {
                var x=row.cells;
                document.getElementById("accountno").value = x[0].innerHTML;
               
                
              }
            </script>


                      <label>DV No.</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="dvno" placeholder="Enter DV No." name="dvno" required>
                      <br>
                    
                      
                      <table class="table table-striped table-hover" id="main">
                      <tbody id="result">
                      </tbody>
                      </table>
                      <br>
                  <!-- Getting PO NUmber -->      
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script>
          $(document).ready(function(){
            $("#result").click(function(){
              $("#main").hide();
            });
          });
          </script>
            <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@ntaobvalue.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result').html(data);
                    }
                  });
                }
                $('#dvno').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    $("#main").show();
                    load_data();
                    document.getElementById('dvno').value = "";
                    document.getElementById('orsno').value = "";
                    document.getElementById('payee').value = "";
                    document.getElementById('particular').value = "";
                    document.getElementById('ppa').value = "";
                    document.getElementById('uacs').value = "";
                    document.getElementById("gross").value = "";
                    document.getElementById("totaldeduc").value = "";
                    document.getElementById("net").value = "";
                    
                  }
                });
              });
              function showRow(row)
              {
                var x=row.cells;
                document.getElementById("dvno").value = x[0].innerHTML;
                document.getElementById("orsno").value = x[1].innerHTML;
                document.getElementById("payee").value = x[2].innerHTML;
                document.getElementById("particular").value = x[3].innerHTML;
                document.getElementById("ppa").value = x[4].innerHTML;
                document.getElementById("uacs").value = x[5].innerHTML;
                document.getElementById("gross").value = x[6].innerHTML;
                document.getElementById("totaldeduc").value = x[7].innerHTML;
                document.getElementById("net").value = x[8].innerHTML;
                
              }
            </script>
             <label>ORS No.</label>
             <input readonly  type="text" class="typeahead form-control" style="height: 35px;" id="orsno" placeholder=" ORS Number" name="orsno">
             <br>
             <label>Payee</label>
             <input  type="text" class="form-control" style="height: 35px;" id="payee" placeholder=" Payee" name="payee" readonly>
             <br>  
             <label>Particular</label>
             <input  type="text" class="form-control" style="height: 35px;" id="particular" placeholder=" Particular" name="particular" readonly>
             <br>  
             <label>PPA</label>
             <input  type="text" class="form-control" style="height: 35px;" id="ppa" placeholder=" PPA" name="ppa" readonly>
             <br>
             <label>UACS</label>
             <input  type="text" class="form-control" style="height: 35px;" id="uacs" placeholder=" UACS" name="uacs" readonly>
             <br>
            
             <label>Gross</label>
             <input  type="text" class="form-control" style="height: 35px;" id="gross" placeholder=" Amount" name="gross" readonly>
             <br>  

             <label>Total Deductions</label>
             <input  type="text" class="form-control" style="height: 35px;" id="totaldeduc" placeholder=" Total Deduction" name="totaldeduc" readonly>
             <br>   

             <label>Net</label>
             <input  type="text" class="form-control" style="height: 35px;" id="net" placeholder=" Net" name="net" readonly>
             <br>   
            </div>

            <div class="col-md-5">

            <label>Date</label>
            <br>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker1" placeholder='Enter Date' name="date">
            </div>
            <br>
            <br> 
            

            <label>LDDAP-ADA/Check</label>
             <input  type="text" class="form-control" style="height: 35px;" id="lddap" placeholder="Enter LDDAP-ADA/Check" name="lddap">
             <br> 
             <br>
            <br> 
            
        

             <label>Remarks</label>
             <input  type="text" class="form-control" style="height: 80px;" id="remarks" placeholder="Enter Remarks" name="remarks">
             <br>
             
             <label>Status</label>
             <select class="form-control select" style="width: 100%; height: 40px;" name="status" id="status" required >
             <option value = "Paid">Paid</option>
             <option value = "Unpaid">Unpaid</option>
             <!-- <option value = "Pending">Pending</option> -->
             <!-- <option>Select Status</option> -->
 
             
             </select>
                
              <br>
              </div>


              <div class="col-md-3">
              

              </div>
                    
              
            </div>
           
           
                    
        </div>
        
        <div class="class">
            
            
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-success">Submit</button>
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
