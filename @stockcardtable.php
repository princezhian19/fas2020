<?php
include('db.class.php'); // call db.class.php

?>


<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


</head>
<body>
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <br>
            
       
            <?php
           
            $sn = $_GET['getsn'];
           
            
            ?>
           
            
      
            
          
            <h1 align="">&nbspStocks</h1>
            <h1 align="">&nbspResult at Stock No. : <?php echo $sn; ?></h1>
             <div class="box-header with-border">
    </div>
    <br>
    <div class="class">
          
         <div class="col-md-1">
          &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="@stocks.php" style="color:white;text-decoration: none;">Back</a></li>
          </div>
          <div class="col-md-6">
         <!--  <form method = "POST" action = "@Functions/sarodateexport.php">
                    <div class="input-group date">
                        <div class="input-group-addon">
                        FROM   <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="" id="datepicker1" placeholder='Enter Date' name="datefrom" style="height: 35px; width: 200px">
                        <div class="input-group-addon">
                        TO <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="" id="datepicker2" placeholder='Enter Date' name="dateto" style="height: 35px; width: 200px">
                        &nbsp<button type="submit" name="submit" style="width:%; height: 35px" class="btn btn-success ">Filter/Export Data</button>
                    </div>
                    <br>
          </form> -->

          </div>
          <div class="col-md-4">
          <!-- <form method = "POST" action = "@sarosearch.php">
            <input  type="text" class="" style="height: 35px; width: 400px" id="" placeholder="Enter SARO Number" name="saronumber" > &nbsp
            &nbsp<button type="submit" name="submit" style="width:%; height: 35px" class="btn btn-success ">Search</button>
          </form> -->
          
          </div>

        <div class="col-md-1">
         
          <form method = "POST" action = "@Functions/stockcardexport.php">
            <input type="hidden" class="text" name="getsn" value="<?php echo $sn; ?>">
            &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width:%; height: 35px" class="btn btn-success ">Export All</button>
          </form>
        </div>
      </div>
      <br>
      <br>
      <br>

            <!-- table here -->

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        
                        <th width="0"></th>
                        <th width="800">DATE AS OF</th>
                        <th width="800">RECEIPT</th>
                        <th width="800">ISSUED</th>
                        <th width="800">BALANCE</th>
                        <th width="800">ACTION</th>
                        
                        <!-- <th width="0"></th> -->
                    </tr>
                </thead>
            
            <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            $stocksearch="";
            
          
            $sn = $_GET['getsn'];
           
            
        
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM old_stock  where sn = '$sn' order by id asc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $code = $row["code"];
                  $items = $row["items"];
                  $sn = $row["sn"];
                  $unit = $row["unit"];
                  $balanceone = $row["balanceone"];
                  $one = $row["one"];
                  $delivery = $row["delivery"];
                  $avail_balance = $row["avail_balance"];
                  $issue_month = $row["issue_month"];
                  $balancetwo = $row["balancetwo"];
                  $two = $row["two"];
                  $current_price = $row["current_price"];
                

                
                    
                    echo "<tr align = ''>
                    <td></td>
                    
                    <td>$balancetwo</td>
                    <td>$avail_balance</td>
                    <td>$issue_month</td>
                    <td>$two</td>
                    <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='UpdateStocks.php?id=$id' '> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                    </td>
                    
                    
                 

                    </tr>"; 
                }
                echo "</table>";
            ?>       
                
            </table>
            <div class="row">

                  <div class="col-md-1">

                  </div>
                  <div class="col-md-5">

                  </div>
                    <div class="col-md-5">

                


                  </div>

            </div>
         
      </div>
    </div>
    
</div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>
</div>
</div>

   
<div class="panel-footer"></div>
</div>
</div>



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



