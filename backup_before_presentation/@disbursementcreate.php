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
        <li class="active">Create Disbursement</li>
      </ol>
      <br>
      <br>
       
    <!-- Start Panel -->
    <div class="panel panel-default">
        <br>
      
            <h1 align="">&nbspCreate Disbursement</h1>
            <div class="box-header with-border">
    
        <br>
      <li class="btn btn-success"><a href="@disbursement.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <!-- Start form -->
  <form class="" type='GET' action="@Functions/dcreatefunction.php" >
        <!-- Start Menu -->
        <div class="class-bordered" >
            <div class="row">
                <div class="col-md-6">
                      <label>DVs no.</label>
                      <input  type="text" class="form-control" style="height: 35px;" id="" placeholder="Enter DV No." name="dv" required>
                      <br>
                      <label>ORS No.</label>
                      <input  type="text" class="typeahead form-control" style="height: 35px;" id="ors" placeholder="Search ORS Number" name="ors">
                      
                      <table class="table table-striped table-hover" id="main">
                      <tbody id="result">
                      </tbody>
                      </table>
                      <br>
                  <!-- Getting PO NUmber -->      
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            
            <script type="text/javascript">
              $(document).ready(function(){
                function load_data(query)
                {
                  $.ajax({
                    url:"@disbursementvalue.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data)
                    {
                      $('#result').html(data);
                    }
                  });
                }
                $('#ors').keyup(function(){
                  var search = $(this).val();
                  if(search != '')
                  {
                    load_data(search);
                  }
                  else
                  {
                    load_data();
                    document.getElementById('sr').value = "";
                    document.getElementById('ppa').value = "";
                    document.getElementById('uacs').value = "";
                    document.getElementById('payee').value = "";
                    document.getElementById('particular').value = "";
                    document.getElementById("amount").value = "";
                    
                  }
                });
              });
              function showRow(row)
              {
                var x=row.cells;
                document.getElementById("sr").value = x[1].innerHTML;
                document.getElementById("ppa").value = x[2].innerHTML;
                document.getElementById("uacs").value = x[3].innerHTML;
                document.getElementById("payee").value = x[4].innerHTML;
                document.getElementById("particular").value = x[5].innerHTML;
                document.getElementById("amount").value = x[6].innerHTML;
               
                
              }
            </script>

             <label>SR no.</label>
             <input  type="text" class="form-control" style="height: 35px;" id="sr" placeholder="Enter DV No." name="sr" readonly>
             <br>
             <label>PPA</label>
             <input  type="text" class="form-control" style="height: 35px;" id="ppa" placeholder="Enter DV No." name="ppa" readonly>
             <br>
             <label>UACS</label>
             <input  type="text" class="form-control" style="height: 35px;" id="uacs" placeholder="Enter DV No." name="uacs" readonly>
             <br>
             <label>Payee</label>
             <input  type="text" class="form-control" style="height: 35px;" id="payee" placeholder="Enter DV No." name="payee" readonly>
             <br>  
             <label>Particular</label>
             <input  type="text" class="form-control" style="height: 35px;" id="particular" placeholder="Enter DV No." name="particular" readonly>
             <br>  
             <label>Amount</label>
             <input  type="text" class="form-control" style="height: 35px;" id="amount" placeholder="Enter DV No." name="amount" readonly>
             <br>   
            </div>
            <div class="col-md-6">
                <label>Date Received</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" id="" placeholder='Enter Date' name="datereceived">
                    </div>
                    <br>
                    
                    <label>Time Received</label>
                    <br>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="time" class="form-control pull-right" id="" placeholder='Enter Date' name="timereceived">
        
                    </div>
                    <br>
                    <br>
                   
                   
            <label>Tax</label>
             <input  type="Number" class="form-control" style="height: 35px;" id="tax" placeholder="Enter Tax" name="tax">
             <br> 
             <label>GSIS</label>
             <input  type="Number" class="form-control" style="height: 35px;" id="gsis" placeholder="Enter GSIS" name="gsis">
             <br> 
             <label>PAG IBIG</label>
             <input  type="Number" class="form-control" style="height: 35px;" id="pagibig" placeholder="Enter Pag Ibig" name="pagibig">
             <br> 
             <label>PhilHealth</label>
             <input  type="Number" class="form-control" style="height: 35px;" id="philhealth" placeholder="Enter Phil Health" name="philhealth">
             <br>
             <label>Other Payables</label>
             <input  type="Number" class="form-control" style="height: 35px;" id="other" placeholder="Enter Phil Health" name="other">
             <br>  
             <label>Remarks</label>
             <input  type="text" class="form-control" style="height: 35px;" id="remarks" placeholder="Enter Remarks" name="remarks">
             <br>
             <label>Status</label>
             <select class="form-control select" style="width: 100%; height: 40px;" name="status" id="status" required >
             <option>Select Status</option>
             <option value = "Disbursed">Disbursed</option>
             <option value = "Pending">Pending</option>
             <!-- <option>Select Status</option> -->
 
             
             </select>
                

                    </div>
                    
                <!-- @Funtions/obsearchvalue.php -->
             
            </div>
           
           
                    
        </div>
        
        <div class="class">
            
            
        </div>
        <!-- End Menu -->
    <!-- End Panel -->
    <!-- Submit -->
    </div>
    &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width: %;" class="btn btn-success">Submit</button>
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
