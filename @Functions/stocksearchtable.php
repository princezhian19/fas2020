<?php
// /include('db.class.php'); // call db.class.php

?>


<!DOCTYPE html>
<html>
<head>
  <title>Stock Management System</title>

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
            $stocksearch="";
            if (isset($_POST['submit'])) 
            {
                
            $stocksearch = $_POST['stocksearch'];
           
            }
            ?>
      
            <h1 align="">&nbspStocks</h1>
            <h1 align="">&nbspResult at Stock No. : <?php echo $stocksearch; ?></h1>

             <div class="box-header with-border">

             <li class="btn btn-success"><a href="@stocks.php" style="color:white;text-decoration: none;">Back</a></li>
    </div>
    <br>
    <div class="class">
          
         <div class="col-md-6">
         <form method = "POST" action = "">
            
          </form>
          </div>

          <div class="col-md-1">
         
          </div>
          <div class="col-md-4">
          
          
          </div>

        <div class="col-md-1">
         
          <form method = "POST" action = "@Functions/obexportall.php">
            <!-- &nbsp&nbsp&nbsp<button type="submit" hdden name="submit" style="width:%; height: 35px" class="btn btn-success ">Export All</button> -->
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
                    <th width="100"></th>
                        <th width="800">STOCK NO.</th>
                        <th width="800">ITEMS</th>
                        <th width="800">UNIT OF MEASUREMENT</th>
                        <th width="800">BALANCE BEFORE</th>
                        <th width="800">DELIVERY</th>
                        <th width="800">AVAILABLE BALANCE</th>
                        <th width="800">ISSUE MONTH</th>
                        <th width="800">BALANCE AFTER</th>
                        <th width="800">CURRENT PRICE</th>
                    
                        <!-- <th width="0"></th> -->
                    </tr>
                </thead>
            
            <?php
            $servername = "localhost";
<<<<<<< HEAD
            $username = "root";
            $password = "";
=======
            $username = "fascalab_2020";
            $password = "7one@2019";
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
            $database = "fascalab_2020";
            
            $stocksearch="";
            $uacs="";
            if (isset($_POST['submit'])) 
            {
                
            $stocksearch = $_POST['stocksearch'];
           
            }
        
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM old_stock  where sn = '$stocksearch' group by sn order by id asc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $code = $row["code"];
                  $items = $row["items"];
                  $sn = $row["sn"];
                  $unit = $row["unit"];
                  $balanceone = $row["one"];
                  $one = $row["one"];
                  $delivery = $row["delivery"];
                  $avail_balance = $row["avail_balance"];
                  $issue_month = $row["issue_month"];
                  $balancetwo = $row["two"];
                  $two = $row["two"];
                  $current_price = $row["current_price"];
                

                
                    
                    echo "<tr align = ''>
                    <td></td>
                    <td><a href='@stockcard.php?getsn=$sn'>$sn</a></td>
                    <td>$items</td>
                    <td>$unit</td>
                    <td>$balanceone</td>
                    <td>$delivery</td>
                    <td>$avail_balance</td>
                    <td>$issue_month</td>
                    <td>$balancetwo</td>
                    <td>$current_price</td>
                  
                  
                    
                    <td></td>

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



